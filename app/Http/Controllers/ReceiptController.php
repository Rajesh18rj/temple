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
            ->paginate(20)
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
        $receipt->load('receiptDetails.category');

        if (!extension_loaded('gd') || !function_exists('imagettftext')) {
            abort(
                500,
                'PHP GD with FreeType support is required. Enable the GD extension.'
            );
        }

        $font = base_path(
            'vendor/dompdf/dompdf/lib/fonts/DejaVuSans.ttf'
        );

        $bold = base_path(
            'vendor/dompdf/dompdf/lib/fonts/DejaVuSans-Bold.ttf'
        );

        if (!is_file($font) || !is_file($bold)) {
            abort(
                500,
                'DomPDF DejaVu font files were not found.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | IMAGE SIZE
        |--------------------------------------------------------------------------
        | Half A4 ratio
        |
        | 210mm × 148.5mm
        |
        */

        $w = 1600;
        $h = 1131;

        $im = imagecreatetruecolor($w, $h);

        imageantialias($im, true);

        /*
        |--------------------------------------------------------------------------
        | COLORS
        |--------------------------------------------------------------------------
        */

        $white = imagecolorallocate(
            $im,
            255,
            255,
            255
        );

        $ink = imagecolorallocate(
            $im,
            24,
            33,
            61
        );

        $muted = imagecolorallocate(
            $im,
            100,
            116,
            139
        );

        $softMuted = imagecolorallocate(
            $im,
            148,
            163,
            184
        );

        $line = imagecolorallocate(
            $im,
            219,
            226,
            234
        );

        $purple = imagecolorallocate(
            $im,
            109,
            40,
            217
        );

        $lightPurple = imagecolorallocate(
            $im,
            247,
            245,
            255
        );

        $totalPurple = imagecolorallocate(
            $im,
            245,
            243,
            255
        );

        imagefill(
            $im,
            0,
            0,
            $white
        );

        /*
        |--------------------------------------------------------------------------
        | TEXT HELPER
        |--------------------------------------------------------------------------
        */

        $text = function (
            string $value,
            int    $x,
            int    $baseline,
            int    $size = 19,
            bool   $isBold = false,
            ?int   $color = null
        ) use (
            $im,
            $font,
            $bold,
            $ink
        ): void {

            imagettftext(
                $im,
                $size,
                0,
                $x,
                $baseline,
                $color ?? $ink,
                $isBold ? $bold : $font,
                $value
            );
        };

        /*
        |--------------------------------------------------------------------------
        | RIGHT ALIGNED TEXT
        |--------------------------------------------------------------------------
        */

        $rightText = function (
            string $value,
            int    $rightX,
            int    $baseline,
            int    $size = 19,
            bool   $isBold = false,
            ?int   $color = null
        ) use (
            $im,
            $font,
            $bold,
            $ink
        ): void {

            $file = $isBold
                ? $bold
                : $font;

            $box = imagettfbbox(
                $size,
                0,
                $file,
                $value
            );

            $width = $box[2] - $box[0];

            imagettftext(
                $im,
                $size,
                0,
                $rightX - $width,
                $baseline,
                $color ?? $ink,
                $file,
                $value
            );
        };

        /*
        |--------------------------------------------------------------------------
        | TEXT WRAP
        |--------------------------------------------------------------------------
        */

        $wrap = function (
            string $value,
            int    $maxWidth,
            int    $size = 18,
            bool   $isBold = false
        ) use (
            $font,
            $bold
        ): array {

            $file = $isBold
                ? $bold
                : $font;

            $words = preg_split(
                '/\s+/u',
                trim($value)
            ) ?: [];

            $lines = [''];

            foreach ($words as $word) {

                $index = count($lines) - 1;

                $candidate = trim(
                    $lines[$index] . ' ' . $word
                );

                $box = imagettfbbox(
                    $size,
                    0,
                    $file,
                    $candidate
                );

                $width = $box[2] - $box[0];

                if (
                    $width > $maxWidth &&
                    $lines[$index] !== ''
                ) {

                    $lines[] = $word;

                } else {

                    $lines[$index] = $candidate;
                }
            }

            return $lines;
        };

        /*
        |--------------------------------------------------------------------------
        | CONTENT WIDTH
        |--------------------------------------------------------------------------
        */

        $left = 65;

        $rightEdge = $w - 65;

        $contentWidth = $rightEdge - $left;

        /*
        |--------------------------------------------------------------------------
        | HEADER
        |--------------------------------------------------------------------------
        */

        $text(
            'TEMPLE RECEIPT',
            $left,
            102,
            32,
            true,
            $purple
        );


        $rightText(
            'Receipt No: ' . $receipt->receipt_number,
            $rightEdge,
            75,
            18,
            true,
            $ink
        );

        $rightText(
            'Date: ' .
            (
            $receipt->date
                ? $receipt->date->format('d M Y')
                : '-'
            ),
            $rightEdge,
            108,
            17,
            false,
            $muted
        );

        /*
        |--------------------------------------------------------------------------
        | PURPLE DIVIDER
        |--------------------------------------------------------------------------
        */

        imagefilledrectangle(
            $im,
            $left,
            147,
            $rightEdge,
            150,
            $purple
        );

        /*
        |--------------------------------------------------------------------------
        | DONOR INFORMATION
        |--------------------------------------------------------------------------
        */

        $text(
            'DONOR INFORMATION',
            $left,
            187,
            17,
            true,
            $muted
        );

        $donorTop = 205;

        $donorBottom = 296;

        imagerectangle(
            $im,
            $left,
            $donorTop,
            $rightEdge,
            $donorBottom,
            $line
        );

        /*
        | 30% Name
        | 25% Mobile
        | 45% Address
        */

        $nameEnd =
            $left +
            (int)($contentWidth * 0.30);

        $mobileEnd =
            $nameEnd +
            (int)($contentWidth * 0.25);

        imageline(
            $im,
            $nameEnd,
            $donorTop,
            $nameEnd,
            $donorBottom,
            $line
        );

        imageline(
            $im,
            $mobileEnd,
            $donorTop,
            $mobileEnd,
            $donorBottom,
            $line
        );

        /*
        | Labels
        */

        $text(
            'NAME',
            $left + 17,
            233,
            12,
            true,
            $softMuted
        );

        $text(
            'MOBILE',
            $nameEnd + 17,
            233,
            12,
            true,
            $softMuted
        );

        $text(
            'ADDRESS',
            $mobileEnd + 17,
            233,
            12,
            true,
            $softMuted
        );

        /*
        | Name
        */

        $nameLines = $wrap(
            (string)$receipt->name,
            $nameEnd - $left - 34,
            18,
            true
        );

        foreach (
            array_slice($nameLines, 0, 2)
            as $i => $lineText
        ) {

            $text(
                $lineText,
                $left + 17,
                264 + ($i * 22),
                18,
                true,
                $ink
            );
        }

        /*
        | Mobile
        */

        $text(
            (string)(
            $receipt->mobile ?: '-'
            ),
            $nameEnd + 17,
            264,
            18,
            true,
            $ink
        );

        /*
        | Address
        */

        $addressLines = $wrap(
            (string)(
            $receipt->address ?: '-'
            ),
            $rightEdge - $mobileEnd - 34,
            17,
            true
        );

        foreach (
            array_slice($addressLines, 0, 2)
            as $i => $lineText
        ) {

            $text(
                $lineText,
                $mobileEnd + 17,
                264 + ($i * 21),
                17,
                true,
                $ink
            );
        }

        /*
        |--------------------------------------------------------------------------
        | DONATION DETAILS
        |--------------------------------------------------------------------------
        */

        $text(
            'DONATION DETAILS',
            $left,
            337,
            17,
            true,
            $muted
        );

        $tableTop = 354;

        $headerBottom = 405;

        $rowHeight = 48;

        /*
        | Header background
        */

        imagefilledrectangle(
            $im,
            $left,
            $tableTop,
            $rightEdge,
            $headerBottom,
            $lightPurple
        );

        /*
        | Table border
        */

        imagerectangle(
            $im,
            $left,
            $tableTop,
            $rightEdge,
            $headerBottom,
            $line
        );

        /*
        | Amount column starts here
        */

        $amountStart =
            $rightEdge - 370;

        /*
        | Table headers
        */

        $text(
            '#',
            $left + 20,
            388,
            14,
            true,
            $muted
        );

        $text(
            'CATEGORY',
            $left + 145,
            388,
            14,
            true,
            $muted
        );

        $rightText(
            'AMOUNT',
            $rightEdge - 18,
            388,
            14,
            true,
            $muted
        );

        /*
        |--------------------------------------------------------------------------
        | DONATION ROWS
        |--------------------------------------------------------------------------
        */

        $details =
            $receipt->receiptDetails;

        /*
        | Keep the half-page compact.
        */

        if ($details->count() > 8) {

            imagedestroy($im);

            abort(
                422,
                'This half-A4 receipt supports up to 8 donation items.'
            );
        }

        $rowY =
            $headerBottom;

        $total = 0;

        foreach (
            $details as $index => $detail
        ) {

            $total +=
                (float)$detail->amount;

            $nextY =
                $rowY + $rowHeight;

            /*
            | Row separator
            */

            imageline(
                $im,
                $left,
                $nextY,
                $rightEdge,
                $nextY,
                $line
            );

            /*
            | Number
            */

            $text(
                (string)($index + 1),
                $left + 20,
                $rowY + 31,
                17,
                false,
                $ink
            );

            /*
            | Category
            */

            $category =
                (string)(
                    $detail->category->name
                    ?? 'Category'
                );

            $categorySize = 17;

            while ($categorySize > 11) {

                $box = imagettfbbox(
                    $categorySize,
                    0,
                    $font,
                    $category
                );

                if (
                    ($box[2] - $box[0])
                    <= ($amountStart - $left - 180)
                ) {
                    break;
                }

                $categorySize--;
            }

            $text(
                $category,
                $left + 145,
                $rowY + 31,
                $categorySize,
                false,
                $ink
            );

            /*
            | Amount
            */

            $rightText(
                '₹' .
                number_format(
                    (float)$detail->amount,
                    2
                ),
                $rightEdge - 18,
                $rowY + 31,
                17,
                true,
                $ink
            );

            $rowY =
                $nextY;
        }

        /*
        |--------------------------------------------------------------------------
        | TOTAL
        |--------------------------------------------------------------------------
        */

        $totalHeight = 55;

        imagefilledrectangle(
            $im,
            $left,
            $rowY,
            $rightEdge,
            $rowY + $totalHeight,
            $totalPurple
        );

        imagerectangle(
            $im,
            $left,
            $rowY,
            $rightEdge,
            $rowY + $totalHeight,
            $line
        );

        $rightText(
            'Total Amount',
            $amountStart - 20,
            $rowY + 35,
            17,
            true,
            $muted
        );

        $rightText(
            '₹' .
            number_format(
                $total,
                2
            ),
            $rightEdge - 18,
            $rowY + 36,
            23,
            true,
            $purple
        );

        /*
        |--------------------------------------------------------------------------
        | SIGNATURES
        |--------------------------------------------------------------------------
        */

        $signatureY = 1010;

        /*
        | Donor line
        */

        imageline(
            $im,
            130,
            $signatureY,
            570,
            $signatureY,
            $muted
        );

        /*
        | Authorized line
        */

        imageline(
            $im,
            1030,
            $signatureY,
            1470,
            $signatureY,
            $muted
        );

        $text(
            'Donor Signature',
            274,
            $signatureY + 32,
            15,
            true,
            $muted
        );

        $text(
            'Authorized Signature',
            1100,
            $signatureY + 32,
            15,
            true,
            $muted
        );

        /*
        |--------------------------------------------------------------------------
        | FOOTER
        |--------------------------------------------------------------------------
        */

        $text(
            'Thank you for your contribution.',
            605,
            1085,
            13,
            false,
            $muted
        );

        /*
        |--------------------------------------------------------------------------
        | IMAGE → PNG
        |--------------------------------------------------------------------------
        */

        ob_start();

        imagepng(
            $im,
            null,
            6
        );

        $png =
            ob_get_clean();

        imagedestroy($im);

        $image =
            'data:image/png;base64,' .
            base64_encode($png);

        /*
        |--------------------------------------------------------------------------
        | HALF-A4 PDF
        |--------------------------------------------------------------------------
        */

        $pdf = Pdf::loadView(
            'receipts.pdf',
            compact('image')
        )->setPaper([
            0,
            0,
            595.2756,
            420.9449
        ]);

        return $pdf->download(
            'receipt-' . $receipt->receipt_number . '.pdf'
        );
    }

    public function edit(Receipt $receipt)
    {
        $receipt->load('receiptDetails.category');

        $categories = Category::orderBy('display_order')
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
