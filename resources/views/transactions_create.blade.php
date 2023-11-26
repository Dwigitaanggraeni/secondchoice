@extends('adminlte')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Data Transaksi</h1>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Data Transaksi</h3>
        </div>
        <div class="card-body">
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
                <div class="form-group product-row">
                    <label for="id_produk">Nama Produk + Harga</label>
                    <div class="card-deck">
                        @foreach ($productsM as $data)
                            <div class="card" style="width: 18rem;">
                                <img src="{{ asset('images/product/' . $data->image) }}" class="card-img-top"
                                    alt="{{ $data->nama_produk }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $data->nama_produk }}</h5>
                                    <p class="card-text">Harga: {{ $data->harga_produk }}</p>
                                    <input type="checkbox" name="id_produk[]" value="{{ $data->id }}"
                                        data-harga="{{ $data->harga_produk }}" style="margin-top: 10px;"> Pilih
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        <button type="button" class="btn btn-primary" id="prevPage">Previous</button>
                        <button type="button" class="btn btn-primary" id="nextPage">Next</button>
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
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        var pageSize = 4;

        updateDisplay();

        $('#nextPage').click(function () {
            updateDisplay('next');
        });

        $('#prevPage').click(function () {
            updateDisplay('prev');
        });

        function updateDisplay(action) {
            var startIndex;
            var endIndex;

            if (action === 'next') {
                startIndex = $('.card-deck .card:visible:last').index() + 1;
            } else if (action === 'prev') {
                startIndex = $('.card-deck .card:visible:first').index() - pageSize;
            } else {
                startIndex = 0;
            }

            startIndex = Math.max(startIndex, 0);

            endIndex = startIndex + pageSize;

            // Dynamically create invisible cards to fill the remaining space
            var remaining = pageSize - (endIndex - startIndex);
            if (remaining > 0) {
                var invisibleCards = createInvisibleCards(remaining);
                $('.card-deck').append(invisibleCards);
            }

            $('.card-deck .card').hide();
            $('.card-deck .card').slice(startIndex, endIndex + remaining).show();

            // Enable/disable Previous button based on the condition
            $('#prevPage').prop('disabled', startIndex === 0);
        }

        // Event listener for checkbox change
        $('.product-row').on('change', 'input[type="checkbox"]', function () {
            calculateTotal();
        });
    });

    // Function to create invisible cards
    function createInvisibleCards(count) {
        var invisibleCards = '';

        for (var i = 0; i < count; i++) {
            invisibleCards += '<div class="card card-invisible"></div>';
        }

        return invisibleCards;
    }

    // Function to calculate the total amount
    function calculateTotal() {
        var total = 0;

        $('.product-row input:checked').each(function () {
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

    // Initial calculation when the page loads
    calculateTotal();
</script>   

@endsection