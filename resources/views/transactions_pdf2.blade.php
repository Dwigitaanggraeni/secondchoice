<h1>Daftar Transaksi</h1>
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
</table>