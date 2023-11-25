<!-- <!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: "Courier New", monospace;
            text-align: center;
        }

        h1 {
            text-align: center;
        }

        .list-container {
            width: 50%;
            margin: 0 auto;
        }

        .list {
            border: 2px solid #000;
            padding: 20px;
            margin-bottom: 20px;
        }

        .list-item {
            display: flex;
            justify-content: space-between;
        }

        .item-label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Struk Produk</h1>

    <div class="list-container">
        @foreach($productsM as $data)
        <div class="list">
            <div class="list-item">
                <span class="item-label">Nama Produk:</span>
                <span>{{ $data->nama_produk }}</span>
            </div>
            <div class="list-item">
                <span class="item-label">Harga Produk:</span>
                <span>{{ $data->harga_produk }}</span>
            </div>
        </div>
        @endforeach
    </div>
</body>
</html> -->
