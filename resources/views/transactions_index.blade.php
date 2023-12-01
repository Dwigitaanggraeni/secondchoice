@extends('adminlte')
@section('content')

<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Transaksi</h3>
        </div>
    </div>

    <div class="card-body">
        @if($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
        @endif

        <div class="mb-3">
            <a href="{{ route('transactions.create') }}" class="btn btn-success mr-2">Tambah Data Transaksi</a>
            <!-- Button to trigger modal -->
            <button class="btn btn-warning" data-toggle="modal" data-target="#downloadModal">Unduh PDF</button>
        </div>

        <table id="myTable" class="table table-striped table-bordered" style="background-color: #d8bfd8;">
            <thead>
                <tr class="bg-dark">
                    <th>Nomor Unik</th>
                    <th>Nama Pelanggan</th>
                    <th>Nama Produk</th>
                    <th>Total Belanja</th>
                    <th>Uang Bayar</th>
                    <th>Uang Kembali</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactionsM as $transaction)
                <tr>
                    <td>{{ $transaction->nomor_unik }}</td>
                    <td>{{ $transaction->nama_pelanggan }}</td>
                    <td>
                        @foreach ($transaction->details as $detail)
                        {{ $detail->product_name }} - {{ $detail->buying_price }}
                        <br>
                        @endforeach
                    </td>
                    <td>{{ $transaction->total_belanja }}</td>
                    <td>{{ $transaction->uang_bayar }}</td>
                    <td>{{ $transaction->uang_kembali }}</td>
                    <td>{{ $transaction->created_at }}</td>
                    <td>
                        <div class="btn-group">
                            @if (Auth::user()->role == 'kasir')
                            <a href="{{ route('mtransactions.downloadSingle', ['id' => $transaction->id]) }}"
                                class="btn btn-sm btn-outline-primary">
                                <i class="fa fa-print"></i>
                            </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="downloadModal" tabindex="-1" role="dialog" aria-labelledby="downloadModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="downloadModalLabel">Unduh PDF</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Pilih opsi unduhan:</p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="downloadOption" id="downloadAll" checked>
                    <label class="form-check-label" for="downloadAll">
                        Semua Transaksi
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="downloadOption" id="downloadByDate">
                    <label class="form-check-label" for="downloadByDate">
                        Transaksi Berdasarkan Tanggal
                    </label>
                </div>
                <div class="form-group mt-3" id="datePickerContainer" style="display: none;">
                    <label for="datepickerFrom">Dari Tanggal:</label>
                    <input type="date" id="datepickerFrom" class="form-control">

                    <label for="datepickerTo" class="mt-2">Sampai Tanggal:</label>
                    <input type="date" id="datepickerTo" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="downloadBtn">Unduh</button>
            </div>
        </div>
    </div>
</div>

<!-- Script to handle modal interactions -->
<script>
$(document).ready(function() {
    // Show/hide date picker based on selected option
    $('input[name="downloadOption"]').change(function() {
        if ($(this).attr('id') === 'downloadByDate') {
            $('#datePickerContainer').show();
        } else {
            $('#datePickerContainer').hide();
        }
    });

    // Handle download button click
    $('#downloadBtn').click(function() {
        var selectedOption = $('input[name="downloadOption"]:checked').attr('id');

        if (selectedOption === 'downloadAll') {
            // Direct to the URL for "Semua Transaksi"
            window.location.href = "{{ url('mtransactions/download-pdf') }}";
            return;
        }

        if (selectedOption === 'downloadByDate') {
            var selectedFromDate = $('#datepickerFrom').val();
            var selectedToDate = $('#datepickerTo').val();

            // Validate start and end dates
            if (!selectedFromDate || !selectedToDate) {
                alert('Please select both start and end dates.');
                return;
            }

            // Convert dates to Date objects for comparison
            var startDate = new Date(selectedFromDate);
            var endDate = new Date(selectedToDate);

            // Validate that end date is greater than start date
            if (startDate >= endDate) {
                alert('End date should be greater than start date.');
                return;
            }

            // Redirect to the downloadPdfByDate endpoint with parameters
            window.location.href = "{{ route('mtransactions.downloadPdfByDate') }}?start_date=" +
                selectedFromDate + "&end_date=" + selectedToDate;
        }

        // You can perform actions based on the selected option and date range here

        // Close the modal
        $('#downloadModal').modal('hide');
    });
});
</script>




@endsection