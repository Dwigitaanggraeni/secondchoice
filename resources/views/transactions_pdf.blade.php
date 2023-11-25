<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: "Courier New", monospace;
            text-align: center; /* Mengatur konten ke tengah */
        }

        h1 {
            text-align: center;
        }

        .invoice {
            width: 50%; /* Lebar invoice */
            margin: 0 auto; /* Mengatur posisi ke tengah */
            border: 2px solid #000; /* Garis border untuk invoice */
            padding: 20px; /* Ruang dalam di sekitar invoice */
        }

        .invoice-item {
            margin-bottom: 20px;
            text-align: left; /* Konten item invoice rata kiri */
        }

        .item-label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Struk Transaksi</h1>

    @foreach($transactionsM as $data)
    <div class="invoice">
        <div class="invoice-item">
            <span class="item-label">Nomor Unik:</span> {{ $data->nomor_unik }}
        </div>
        <div class="invoice-item">
            <span class="item-label">Nama Pelanggan:</span> {{ $data->nama_pelanggan }}
        </div>
        <div class="invoice-item">
            <span class="item-label">Nama Produk:</span> {{ $data->nama_produk }}
        </div>
        <div class="invoice-item">
            <span class="item-label">Harga Produk:</span> {{ $data->harga_produk }}
        </div>
        <div class="invoice-item">
            <span class="item-label">Uang Bayar:</span> {{ $data->uang_bayar }}
        </div>
        <div class="invoice-item">
            <span class="item-label">Uang Kembali:</span> {{ $data->uang_kembali }}
        </div>
        <div class="invoice-item">
            <span class="item-label">Tanggal:</span> {{ $data->created_at }}
        </div>
    </div>
    @endforeach
</body>
</html>
