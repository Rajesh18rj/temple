<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\ReceiptsExport;
use Maatwebsite\Excel\Facades\Excel;


class ReceiptController extends Controller
{
    public function index(Request $request)
    {
        $query = Receipt::with('city');

        // Mobile search
        if ($request->filled('mobile')) {
            $query->where('mobile', 'like', '%' . $request->mobile . '%');
        }

        // City filter
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        // From date
        if ($request->filled('from_date')) {
            $query->whereDate('date', '>=', $request->from_date);
        }

        // To date
        if ($request->filled('to_date')) {
            $query->whereDate('date', '<=', $request->to_date);
        }

        $receipts = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $cities = City::where('status', true)
            ->orderBy('name')
            ->get();

        return view('receipts.index', compact(
            'receipts',
            'cities'
        ));
    }

    public function downloadExcel(Request $request)
    {
        $query = Receipt::query();

        // Mobile filter
        if ($request->filled('mobile')) {
            $query->where(
                'mobile',
                'like',
                '%' . $request->mobile . '%'
            );
        }

        // City filter
        if ($request->filled('city_id')) {
            $query->where(
                'city_id',
                $request->city_id
            );
        }

        // From date
        if ($request->filled('from_date')) {
            $query->whereDate(
                'date',
                '>=',
                $request->from_date
            );
        }

        // To date
        if ($request->filled('to_date')) {
            $query->whereDate(
                'date',
                '<=',
                $request->to_date
            );
        }

        return Excel::download(
            new ReceiptsExport($query),
            'receipts-' . now()->format('Y-m-d') . '.xlsx'
        );
    }

    public function downloadAllExcel()
    {
        return Excel::download(
            new ReceiptsExport(),
            'all-receipts-' . now()->format('Y-m-d') . '.xlsx'
        );
    }

    public function create()
    {
        $cities = City::where('status', true)
            ->orderBy('name')
            ->get();

        return view('receipts.create', compact('cities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'mobile' => 'nullable|string|max:20',
            'city_id' => 'required|exists:cities,id',
            'address' => 'nullable|string',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('receipts', 'public');
        }

        $receipt = Receipt::create([
            'name' => $request->name,
            'image' => $imagePath,
            'mobile' => $request->mobile,
            'city_id' => $request->city_id,
            'address' => $request->address,
            'date' => now()->toDateString(),
            'receipt_type' => 'walk_in'
        ]);

        $receipt->update([
            'receipt_number' => $receipt->date->format('Ymd')
                . '-'
                . str_pad($receipt->id, 3, '0', STR_PAD_LEFT),
        ]);

        return redirect()
            ->route('receipts.details', $receipt)
            ->with('success', 'Receipt created successfully.');
    }





    public function downloadPdf(Receipt $receipt)
    {
        $receipt->load([
            'city',
            'receiptDetails.category.parent',
        ]);

        $fontPath = resource_path('fonts/NotoSansTamil-Regular.ttf');

        if (!is_file($fontPath)) {
            abort(500, 'Tamil font not found: resources/fonts/NotoSansTamil-Regular.ttf');
        }

        $tempDir = storage_path('app/mpdf-temp');

        if (!is_dir($tempDir) && !mkdir($tempDir, 0755, true) && !is_dir($tempDir)) {
            abort(500, 'Unable to create the mPDF temporary directory.');
        }

        $config = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A5-L',
            'margin_left' => 9,
            'margin_right' => 9,
            'margin_top' => 7,
            'margin_bottom' => 7,
            'default_font' => 'notosanstamil',
            'autoScriptToLang' => true,
            'autoLangToFont' => true,
            'tempDir' => $tempDir,

            'fontDir' => array_merge($config['fontDir'], [
                resource_path('fonts'),
            ]),

            'fontdata' => $fontConfig['fontdata'] + [
                    'notosanstamil' => [
                        'R' => 'NotoSansTamil-Regular.ttf',
                        'B' => 'NotoSansTamil-Bold.ttf',

                    ],
                ],

        ]);
        $logoPath = public_path('images/Logo.png');
        $logoData = null;

        if (is_file($logoPath)) {
            $logoData = 'data:image/png;base64,' .
                base64_encode(file_get_contents($logoPath));
        }

        $html = view('receipts.pdf-tamil', [
            'receipt' => $receipt,
            'logoData' => $logoData,
        ])->render();

        $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::DEFAULT_MODE);

        $pdfContent = $mpdf->Output(
            'receipt-' . $receipt->receipt_number . '.pdf',
            'S'
        );

        return response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' =>
                'attachment; filename="receipt-' .
                $receipt->receipt_number . '.pdf"',
        ]);
    }


    public function edit(Receipt $receipt)
    {
        $receipt->load('receiptDetails.category');

        $categories = Category::with([
            'subcategories' => function ($query) {
                $query->orderBy('display_order')
                    ->orderBy('name');
            }
        ])
            ->whereNull('parent_id')
            ->orderBy('display_order')
            ->orderBy('name')
            ->get();

        $cities = City::where('status', true)
            ->orderBy('name')
            ->get();

        return view('receipts.edit', compact(
            'receipt',
            'categories',
            'cities'
        ));
    }


    public function update(Request $request, Receipt $receipt)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'mobile' => [
                'nullable',
                'string',
                'max:20'
            ],

            'city_id' => 'required|exists:cities,id',

            'address' => [
                'nullable',
                'string',
                'max:1000'
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120'
            ],

            'categories' => [
                'required',
                'array',
                'min:1'
            ],

            'categories.*' => [
                'required',
                'exists:categories,id'
            ],

            'amounts' => [
                'nullable',
                'array'
            ],

            'amounts.*' => [
                'nullable',
                'numeric',
                'min:0'
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Update Receipt
        |--------------------------------------------------------------------------
        */

        $receipt->name = $request->name;
        $receipt->mobile = $request->mobile;
        $receipt->city_id = $request->city_id;
        $receipt->address = $request->address;


        /*
        |--------------------------------------------------------------------------
        | Payment Proof
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            // Delete old image
            if ($receipt->image) {
                $oldImage = storage_path(
                    'app/public/' . $receipt->image
                );

                if (is_file($oldImage)) {
                    unlink($oldImage);
                }
            }

            // Store new image
            $receipt->image = $request
                ->file('image')
                ->store('receipts', 'public');
        }


        $receipt->save();


        /*
        |--------------------------------------------------------------------------
        | Update Receipt Details
        |--------------------------------------------------------------------------
        */

        // Remove existing details
        $receipt->receiptDetails()->delete();


        foreach ($request->categories as $categoryId) {

            $category = Category::findOrFail($categoryId);

            /*
            |--------------------------------------------------------------------------
            | Fixed Amount / Manual Amount
            |--------------------------------------------------------------------------
            */

            if ($category->amount !== null) {

                // Fixed category amount
                $amount = $category->amount;

            } else {

                // Manual amount category
                $amount = $request->amounts[$categoryId] ?? null;

                if ($amount === null || $amount === '') {

                    return back()
                        ->withInput()
                        ->withErrors([
                            "amounts.$categoryId" =>
                                "Please enter an amount for {$category->name}."
                        ]);
                }
            }


            $receipt->receiptDetails()->create([
                'category_id' => $category->id,
                'amount' => $amount,
            ]);
        }


        return redirect()
            ->route('receipts.view', $receipt)
            ->with('success', 'Receipt updated successfully.');
    }

    public function destroy(Receipt $receipt)
    {
        $receipt->delete();

        return redirect()
            ->route('receipts.index')
            ->with('success', 'Receipt deleted successfully.');
    }
}
