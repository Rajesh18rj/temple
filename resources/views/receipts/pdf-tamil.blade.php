
<!DOCTYPE html>
<html lang="ta">
<head>
    <meta charset="UTF-8">
    <title>Receipt {{ $receipt->receipt_number }}</title>

    <style>
        @page {
            margin: 7mm 9mm;
        }

        * {
            box-sizing: border-box;
        }

        html, body {
            margin: 0;
            padding: 0;
            font-family: notosanstamil, sans-serif;
            color: #18213d;
            font-size: 8pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Header */
        .header {
            width: 100%;
            border-bottom: 2px solid #6d28d9;
            padding-bottom: 2mm;
        }

        .header-table {
            page-break-inside: avoid;
        }

        .header-table td {
            vertical-align: middle;
            padding: 0;
        }

        .logo {
            width: 16mm;
            height: 16mm;
        }

        .trust-name {
            color: #6d28d9;
            font-size: 14pt;
            font-weight: bold;
        }

        .subtitle {
            color: #64748b;
            font-size: 8pt;
            margin-top: 1mm;
        }

        .meta {
            text-align: right;
            font-size: 7.5pt;
            line-height: 1.4;
            white-space: nowrap;
        }

        /* Section headings */
        .section-title {
            margin: 2mm 0 1.5mm;
            color: #64748b;
            font-size: 8pt;
            font-weight: normal;
        }

        /* Donor information */
        .donor-table {
            page-break-inside: avoid;
        }

        .donor-table td {
            width: 25%;
            border: 1px solid #e2e8f0;
            padding: 1.5mm 2mm;
            vertical-align: top;
        }

        .label {
            color: #64748b;
            font-size: 6.5pt;
        }

        .value {
            margin-top: 0.5mm;
            font-size: 8pt;
            word-wrap: break-word;
        }

        /* Donation details */
        .donation-table {
            page-break-inside: auto;
        }

        .donation-table th {
            background-color: #f5f3ff;
            color: #475569;
            text-align: left;
            padding: 1.5mm 2mm;
            border: 1px solid #e2e8f0;
            font-size: 7.5pt;
        }

        .donation-table td {
            padding: 1.5mm 2mm;
            border-bottom: 1px solid #e2e8f0;
            font-size: 8pt;
            vertical-align: top;
        }

        .amount {
            text-align: right;
            white-space: nowrap;
        }

        .parent-category {
            color: #64748b;
            font-size: 7pt;
        }

        .child-category {
            font-size: 8pt;

        }

        .total-row td {
            background-color: #f5f3ff;
            font-weight: normal;
            border-top: 1px solid #ddd6fe;
        }

        .total-value {
            color: #6d28d9;
            font-size: 10pt;
        }

        /* Footer */
        .footer {
            margin-top: 2mm;
            text-align: center;
            color: #64748b;
            font-size: 7.5pt;
        }

        .computer-generated {
            margin-top: 1.5mm;
            font-size: 7pt;
            color: #64748b;
            font-style: italic;
        }

        .tamil-text {
            font-weight: normal;
        }
    </style>
</head>

<body>

{{-- TRUST HEADER --}}
<div class="header">
    <table class="header-table">
        <tr>
            <td style="width: 19mm;">
                @if($logoData)
                    <img class="logo" src="{{ $logoData }}" alt="Trust Logo">
                @endif
            </td>

            <td style="width: 57%;">
                <div class="trust-name">
                    SRI VEERA BAIYAMMAL PUBLIC TRUST
                </div>

                <div class="subtitle">
                    நன்கொடை ரசீது
                </div>
            </td>

            <td class="meta">
                <strong>Receipt No:</strong>
                {{ $receipt->receipt_number }}
                <br>

                <strong>Date:</strong>
                {{ $receipt->date ? $receipt->date->format('d M Y') : '-' }}
                <br>

                <strong>Time:</strong>
                {{ $receipt->created_at ? $receipt->created_at->format('h:i A') : '-' }}
            </td>
        </tr>
    </table>
</div>

{{-- DONOR INFORMATION --}}
<div class="section-title">
    நன்கொடையாளர் விவரங்கள் / DONOR INFORMATION
</div>

<table class="donor-table">
    <tr>
        <td>
            <div class="label">பெயர் / NAME</div>
            <div class="value">{{ $receipt->name ?: '-' }}</div>
        </td>

        <td>
            <div class="label">கைபேசி எண் / MOBILE</div>
            <div class="value">{{ $receipt->mobile ?: '-' }}</div>
        </td>

        <td>
            <div class="label">முகவரி / ADDRESS</div>
            <div class="value">{{ $receipt->address ?: '-' }}</div>
        </td>

        <td>
            <div class="label">ஊர் / CITY</div>
            <div class="value">{{ $receipt->city?->name ?? '-' }}</div>
        </td>
    </tr>
</table>

{{-- DONATION DETAILS --}}
<div class="section-title">
    நன்கொடை விவரங்கள் / DONATION DETAILS
</div>

@php
    $total = 0;
@endphp

<table class="donation-table">
    <thead>
    <tr>
        <th style="width: 8%;">#</th>

        <th>
            <span class="tamil-text">வகை</span> / CATEGORY
        </th>

        <th style="width: 25%; text-align: right;">
            <span class="tamil-text">தொகை</span> / AMOUNT
        </th>
    </tr>
    </thead>

    <tbody>
    @forelse($receipt->receiptDetails as $detail)
        @php
            $total += (float) $detail->amount;
            $category = $detail->category;
            $parent = $category?->parent;
        @endphp

        <tr>
            <td>{{ $loop->iteration }}</td>

            <td>
                @if($parent)
                    <div class="parent-category">
                        {{ $parent->name }}
                    </div>

                    <div class="child-category">
                        - {{ $category?->name ?? 'Category' }}
                    </div>
                @else
                    <div class="child-category">
                        {{ $category?->name ?? 'Category' }}
                    </div>
                @endif
            </td>

            <td class="amount">
                ₹{{ number_format((float) $detail->amount, 2) }}
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3" style="text-align: center;">
                நன்கொடை விவரங்கள் இல்லை / No donation details found.
            </td>
        </tr>
    @endforelse

    <tr class="total-row">
        <td colspan="2" class="amount">
            மொத்தம் / TOTAL AMOUNT
        </td>

        <td class="amount total-value">
            ₹{{ number_format($total, 2) }}
        </td>
    </tr>
    </tbody>
</table>


<div class="footer">
    <div>நன்கொடைக்கு நன்றி / Thank you for your contribution.</div>
    <div class="computer-generated">
        This is a computer-generated bill.
    </div>
</div>

</body>
</html>
