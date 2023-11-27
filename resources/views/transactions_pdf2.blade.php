<!-- <h1>Daftar Transaksi</h1>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
<tr>
  <th>Nomor Unik</th>
  <th>Nama Pelanggan</th>
  <th>Nama Produk</th>
  <th>Harga Produk</th>
  <th>Uang Bayar</th>
  <th>Uang Kembali</th>
  <th>Tanggal</th>

</tr>
@foreach ($transactionsM as $data)
<tr>
  <td>{{ $data->nomor_unik}}</td>
  <td>{{ $data->nama_pelanggan}}</td>
  <td>{{ $data->nama_produk}}</td>
  <td>{{ $data->harga_produk}}</td>
  <td>{{ $data->uang_bayar}}</td>
  <td>{{ $data->uang_kembali}}</td>
  <td>{{ $data->created_at}}</td>
@endforeach
</table> -->
<!-- transactions_pdf2.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Transactions PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>

    <h2>Daftar Transaksi</h2>

    <table>
        <thead>
            <tr>
                <th>Nomor Unik</th>
                <th>Nama Pelanggan</th>
                <th>Nama Produk</th>
                <th>Total Belanja</th>
                <th>Uang Bayar</th>
                <th>Uang Kembali</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactionsM as $transaction)
                <tr>
                    <td>{{ $transaction->nomor_unik }}</td>
                    <td>{{ $transaction->nama_pelanggan }}</td>
                    <td>
                        @foreach ($transaction->details as $detail)
                            {{ $detail->product->nama_produk }} - {{ $detail->product->harga_produk }}<br>
                        @endforeach
                    </td>
                    <td>{{ number_format($transaction->total_belanja, 2) }}</td>
                    <td>{{ number_format($transaction->uang_bayar, 2) }}</td>
                    <td>{{ number_format($transaction->uang_kembali, 2) }}</td>
                    <td>{{ $transaction->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
