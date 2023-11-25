@extends('adminlte')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Petshop Lontar</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Data Transaksi</h3>
        </div>
        <div class="card-body">
            <a href="{{ route('transactions.index') }}" class="btn btn-default">Kembali</a>
            <br><br>

            <form action="{{ route('mtransactions.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nomor Unik</label>
                    <input name="nomor_unik" type="number" class="form-control" placeholder="..."
                        value="{{ random_int(1000000000, 9999999999); }}" readonly>
                    @error('nomor_unik')
                    <p>{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nama Pelanggan</label>
                    <input name="nama_pelanggan" type="text" class="form-control" placeholder="...">
                    @error('nama_pelanggan')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Dynamic Product Selection Field -->
                <div id="productContainer">
                    <div class="form-group product-row">
                        <label>Nama Produk + Harga</label>
                        <div class="input-group">
                            <select name="id_produk[]" class="form-control product-select" required>
                                <option value="">- Pilih Produk -</option>
                                @foreach ($productsM as $data)
                                <option value="{{ $data->id }}" data-harga="{{ $data->harga_produk }}">
                                    {{ $data->nama_produk }} - {{ $data->harga_produk}}
                                </option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-success addProduct">+</button>
                                <button type="button" class="btn btn-danger removeProduct">-</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Total Harga</label>
                    <input name="total_harga" type="text" class="form-control" id="totalHarga" readonly>
                </div>

                <div class="form-group">
                    <label>Uang Bayar</label>
                    <input name="uang_bayar" type="number" class="form-control" placeholder="..."
                        oninput="calculateChange()" id="uangBayar">
                    @error('uang_bayar')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Uang Kembali</label>
                    <input name="uang_kembali" type="text" class="form-control" placeholder="..." readonly
                        id="uangKembali">
                    @error('uang_kembali')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <input type="submit" name="submit" class="btn btn-success" value="Tambah">
            </form>
        </div>

        <!-- /.card-body -->
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    // Counter to keep track of product rows
    var productCounter = 1;

    // Function to add a new product selection field
    function addProductField() {
        // Clone the original product row
        var clonedRow = $('.product-row:first').clone();

        // Increment the product counter
        productCounter++;

        // Update the name and id attributes of the cloned dropdown
        clonedRow.find('select[name="id_produk[]"]').attr('name', 'id_produk[' + productCounter + ']');
        clonedRow.find('select[name="id_produk[]"]').attr('id', 'id_produk_' + productCounter);

        // Append the cloned row to the container
        $('#productContainer').append(clonedRow);
    }

    // Function to remove the last product selection field
    function removeProductField() {
        if (productCounter > 1) {
            $('#productContainer .product-row:last').remove();
            productCounter--;
        }
    }

    // Add event listener for the "+" button
    $(document).on('click', '.addProduct', function () {
        addProductField();
    });

    // Add event listener for the "-" button
    $(document).on('click', '.removeProduct', function () {
        removeProductField();
        calculateTotal();
    });

    // Add event listener for product selection change
    $(document).on('change', '.product-select', function () {
        calculateTotal();
    });

// Function to calculate the total amount
function calculateTotal() {
        var total = 0;

        $('.product-select').each(function () {
            var harga = $(this).find(':selected').data('harga');
            if (harga) {
                total += parseFloat(harga);
            }
        });

        // Display the total in the total_harga field
        $('#totalHarga').val(total.toFixed(2));

        // Recalculate the change when the total is updated
        calculateChange();
    }

    // Function to calculate the change
    function calculateChange() {
        var totalHarga = parseFloat($('#totalHarga').val());
        var uangBayar = parseFloat($('#uangBayar').val());

        // Check if the input values are valid numbers
        if (!isNaN(totalHarga) && !isNaN(uangBayar)) {
            var uangKembali = uangBayar - totalHarga;

            // Set uangKembali field to empty if it's 0 or more
            $('#uangKembali').val(uangKembali >= 0 ? uangKembali.toFixed(2) : '');

            // Change color based on the condition
            $('#uangKembali').css('color', uangKembali >= 0 ? 'green' : 'red');

            // Enable/disable the Tambah button based on the condition
            $('#tambahButton').prop('disabled', uangKembali < 0);
        } else {
            // Display an empty string and set color to black if the input values are not valid numbers
            $('#uangKembali').val('');
            $('#uangKembali').css('color', 'black');

            // Disable the Tambah button if the input values are not valid numbers
            $('#tambahButton').prop('disabled', true);
        }
    }

    // Initial calculation when the page loads
    calculateTotal();

</script>

@endsection