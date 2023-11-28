@extends('adminlte')
@section('content')

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Data Transaksi</h3>
        </div>
        <div class="card-body">
            <br><br>

            <form action="{{ route('mtransactions.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nomor Unik</label>
                    <input name="nomor_unik" type="number" class="form-control" placeholder="..." value="{{ random_int(1000000000, 9999999999); }}" readonly>
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
                <div id="productContainer" class="form-group">
                    <label>Nama Produk + Harga</label>
                    <div class="row">
                        @foreach ($productsM as $data)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                @if ($data->image)
                                <img src="{{ asset('images/product/' . $data->image) }}" class="card-img-top" alt="Product Image" style="width: 100%; height: 150px; object-fit: cover;">
                                @else
                                <div class="ui-avatar" style="width: 100%; height: 150px; background-color: #ccc; display: flex; align-items: center; justify-content: center;">
                                    {{ $data->nama_produk }}
                                </div>
                                @endif
                                <div class="card-body">
                                    <input type="checkbox" name="id_produk[]" class="form-check-input product-select" value="{{ $data->id }}" data-harga="{{ $data->harga_produk }}">
                                    <label class="form-check-label">
                                        {{ $data->nama_produk }} - {{ $data->harga_produk}}
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <label>Total Harga</label>
                    <input name="total_harga" type="text" class="form-control" id="totalHarga" readonly>
                </div>

                <div class="form-group">
                    <label>Uang Bayar</label>
                    <input name="uang_bayar" type="number" class="form-control" placeholder="..." oninput="calculateChange()" id="uangBayar">
                    @error('uang_bayar')
                    <p>{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Uang Kembali</label>
                    <input name="uang_kembali" type="text" class="form-control" placeholder="..." readonly id="uangKembali">
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

    // Add event listener for product selection change
    $(document).on('change', '.product-select', function() {
        calculateTotal();
    });

    // Function to calculate the total amount
    function calculateTotal() {
        var total = 0;

        $('.product-select:checked').each(function() {
            var harga = $(this).data('harga');
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
        } else {
            // Display an empty string and set color to black if the input values are not valid numbers
            $('#uangKembali').val('');
            $('#uangKembali').css('color', 'black');
        }
    }
</script>

@endsection