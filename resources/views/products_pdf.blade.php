<!-- products_pdf.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Products PDF</title>
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

    <h1>Daftar Produk</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Size</th>
                <th>Jenis</th>
                <th>Harga Produk</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productsM as $data)
                <tr>
                    <td>{{ $data->nama_produk }}</td>
                    <td>{{ $data->size }}</td>
                    <td>{{ $data->jenis }}</td>
                    <td>{{ $data->harga_produk }}</td>
                    <td>{{ $data->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
