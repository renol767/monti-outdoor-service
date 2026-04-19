<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->order_number }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #333;
            font-size: 14px;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            margin: auto;
            min-height: 1040px; /* Approximate A4 body */
            position: relative;
        }
        .header {
            width: 100%;
            border-bottom: 2px solid #ea580c;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header img {
            max-height: 50px;
        }
        .header table {
            width: 100%;
        }
        .company-info {
            font-size: 12px;
            color: #555;
            line-height: 1.4;
        }
        .invoice-details {
            text-align: right;
        }
        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            color: #111;
            margin: 0 0 5px 0;
        }
        .meta-info {
            font-size: 13px;
        }
        .meta-info span.label {
            color: #666;
            display: inline-block;
            width: 120px;
        }
        .meta-info span.value {
            font-weight: bold;
        }
        .status-badge {
            background-color: #22c55e;
            color: white;
            padding: 3px 10px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 12px;
            text-transform: uppercase;
        }
        
        .info-section {
            width: 100%;
            margin-bottom: 40px;
        }
        .info-section table {
            width: 100%;
        }
        .info-section td {
            vertical-align: top;
            width: 50%;
        }
        .info-title {
            font-size: 14px;
            font-weight: bold;
            color: #666;
            margin-bottom: 8px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            display: inline-block;
        }
        .info-content p {
            margin: 2px 0;
            font-size: 14px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table th {
            background-color: #f8fafc;
            color: #334155;
            font-weight: bold;
            text-align: left;
            padding: 10px;
            border-bottom: 2px solid #cbd5e1;
            font-size: 13px;
        }
        .items-table td {
            padding: 10px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
        }
        .text-right {
            text-align: right !important;
        }
        .text-center {
            text-align: center !important;
        }
        
        .totals-section {
            width: 100%;
            margin-bottom: 40px;
        }
        .totals-table {
            width: 40%;
            float: right;
            border-collapse: collapse;
        }
        .totals-table td {
            padding: 6px 10px;
            font-size: 14px;
        }
        .totals-table .label {
            color: #666;
            text-align: right;
        }
        .totals-table .value {
            text-align: right;
            font-weight: bold;
        }
        .grand-total {
            font-size: 18px !important;
            color: #ea580c !important;
            border-top: 2px solid #e2e8f0;
            padding-top: 10px !important;
        }

        .participants-section {
            clear: both;
            margin-top: 50px;
        }
        .participants-table {
            width: 100%;
            border-collapse: collapse;
        }
        .participants-table th {
            background-color: #f1f5f9;
            padding: 8px;
            text-align: left;
            font-size: 12px;
            color: #475569;
        }
        .participants-table td {
            padding: 8px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
        }
        
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #888;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        
        .watermark {
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.05;
            z-index: -1;
            width: 400px;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Watermark -->
        <!-- Fallback if public path isn't working for dompdf, but typically it resolves. Using a base64 would be safer but let's assume standard path works or skip image if it fails -->

        <div class="header">
            <table>
                <tr>
                    <td style="width: 50%; vertical-align: top;">
                        <span style="font-size: 24px; font-weight: bold; color: #ea580c;">Monti Outdoor</span>
                        <div class="company-info" style="margin-top: 5px;">
                            Jalan Example No 123, Jakarta<br>
                            DKI Jakarta, Indonesia<br>
                            +62 811-9696-9119
                        </div>
                    </td>
                    <td style="width: 50%; vertical-align: top;" class="invoice-details">
                        <div class="invoice-title">INVOICE</div>
                        <div style="font-size: 16px; color: #555; margin-bottom: 15px;">#{{ $order->order_number }}</div>
                        
                        <div class="meta-info">
                            <div><span class="label">Tanggal:</span> <span class="value">{{ $order->created_at->format('d M Y, H:i') }}</span></div>
                            <div><span class="label">Jadwal Trip:</span> <span class="value">{{ $order->departure->start_date->format('d M Y') }}</span></div>
                            <div style="margin-top: 5px;"><span class="label">Status:</span> <span class="status-badge">LUNAS</span></div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="info-section">
            <table>
                <tr>
                    <td>
                        <div class="info-title">Ditagihkan Kepada:</div>
                        <div class="info-content">
                            <p style="font-weight: bold; color: #111;">{{ $order->user->name ?? 'User' }}</p>
                            <p>{{ $order->user->email ?? '-' }}</p>
                            <p>{{ $order->user->phone ?? '-' }}</p>
                        </div>
                    </td>
                    <td>
                        <div class="info-title">Informasi Trip:</div>
                        <div class="info-content">
                            <p style="font-weight: bold; color: #111;">{{ $order->departure->tripTemplate->title ?? 'Trip Dihapus' }}</p>
                            <p><strong>Variant:</strong> {{ $order->variant->name ?? 'Default' }}</p>
                            <p><strong>Jumlah Pax:</strong> {{ $order->pax_count }} Orang</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 35%">Item</th>
                    <th style="width: 25%">Keterangan</th>
                    <th class="text-center" style="width: 10%">Qty</th>
                    <th class="text-right" style="width: 15%">Harga Satuan</th>
                    <th class="text-right" style="width: 15%">Total</th>
                </tr>
            </thead>
            <tbody>
                <!-- Trip Base Item -->
                <tr>
                    <td>Paket Perjalanan</td>
                    <td>{{ $order->variant->name ?? 'Trip' }}</td>
                    <td class="text-center">{{ $order->pax_count }}</td>
                    <td class="text-right">Rp {{ number_format($order->variant->base_price ?? 0, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format(($order->variant->base_price ?? 0) * $order->pax_count, 0, ',', '.') }}</td>
                </tr>
                
                <!-- Addons Items Jika Ada -->
                @if($order->addons && $order->addons->count() > 0)
                    @foreach($order->addons as $addon)
                    <tr>
                        <td>Add-on Extra</td>
                        <td>{{ $addon->addon_name }}</td>
                        <td class="text-center">{{ $addon->quantity }}</td>
                        <td class="text-right">Rp {{ number_format($addon->unit_price, 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($addon->total_price, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                @endif
                
                <!-- Diskon Jika Ada -->
                @if($order->discount_amount > 0)
                <tr>
                    <td colspan="2"><span style="background: #e2e8f0; padding: 2px 6px; border-radius: 4px; font-size: 12px; color: #475569;">Diskon</span></td>
                    <td class="text-center">-</td>
                    <td class="text-right">-</td>
                    <td class="text-right" style="color: #16a34a;">- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</td>
                </tr>
                @endif
            </tbody>
        </table>

        <!-- Totals Section using Float Right table approach -->
        <div class="totals-section clearfix">
            <table class="totals-table">
                <tr>
                    <td class="label">Subtotal:</td>
                    <td class="value">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="label">Addons:</td>
                    <td class="value">Rp {{ number_format($order->addons_total ?? 0, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="label">Diskon:</td>
                    <td class="value" style="color: #16a34a;">- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td class="label grand-total" style="vertical-align: bottom; padding-bottom: 2px;">Total Tagihan:</td>
                    <td class="value grand-total">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div class="participants-section">
            <div class="info-title">Daftar Partisipan</div>
            <table class="participants-table">
                <thead>
                    <tr>
                        <th style="width: 5%">No</th>
                        <th style="width: 35%">Nama Lengkap</th>
                        <th style="width: 25%">No. Telepon / WA</th>
                        <th style="width: 35%">ID / KTP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->participant_name }}</td>
                        <td>{{ $item->participant_phone ?? '-' }}</td>
                        <td>{{ $item->participant_id_number ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="footer">
            <p>Terima kasih atas pesanan Anda.</p>
            <p>Invoice ini diterbitkan oleh sistem komputer secara otomatis dan sah meskipun tanpa tanda tangan fisik.</p>
        </div>
    </div>
</body>
</html>
