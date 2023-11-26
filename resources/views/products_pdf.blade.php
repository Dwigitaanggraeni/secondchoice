<h1>Daftar Produk</h1>
<table width="100%" border="1" cellpadding="5" cellspacing="0">
          <tr>
          <th>Nama Produk</th>
  <th>Size</th>
  <th>Jenis</th>
  <th>Harga Produk</th>
  <th>Tanggal</th>
          </tr>
          @foreach($productsM as $data)
              <tr>
                <td>{{ $data->nama_produk}}</td>
                <td>{{ $data->harga_produk}}</td>
                <td>{{ $data->created_at}}</td>
              </tr>
          @endforeach
        </table>