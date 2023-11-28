<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
        }

        .receipt {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            border: 2px solid #000;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .item-label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        .item-value {
            display: block;
            margin-bottom: 10px;
        }

        .products {
            margin-top: 10px;
            text-align: left;
        }

        .product-item {
            margin-bottom: 5px;
        }

        .total {
            font-weight: bold;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="receipt">
        <div class="header">Struk Transaksi</div>
        <div class="item-label">Nomor Unik:</div>
        <div class="item-value">{{ $transactionsM->nomor_unik }}</div>

        <div class="item-label">Nama Pelanggan:</div>
        <div class="item-value">{{ $transactionsM->nama_pelanggan }}</div>

        <div class="item-label">Nama Produk:</div>
        <div class="products">
            @foreach ($transactionsM->details as $detail)
            <div class="product-item">{{ $detail->product_name }} - {{ $detail->buying_price }}</div>
            @endforeach
        </div>

        <div class="item-label">Total Belanja:</div>
        <div class="item-value">{{ $transactionsM->total_belanja }}</div>

        <div class="item-label">Uang Bayar:</div>
        <div class="item-value">{{ $transactionsM->uang_bayar }}</div>

        <div class="item-label">Uang Kembali:</div>
        <div class="item-value">{{ $transactionsM->uang_kembali }}</div>

        <div class="item-label">Tanggal:</div>
        <div class="item-value">{{ $transactionsM->created_at }}</div>

        <div class="total">Total: {{ $transactionsM->total_belanja }}</div>
    </div>
</body>

</html>