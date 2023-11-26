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
            <a href="{{ url('transactions/pdf2') }}" class="btn btn-warning">Unduh PDF</a>
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
                    <!-- <th>Aksi</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach ($transactionsM as $transaction)
                    <tr>
                        <td>{{ $transaction->nomor_unik }}</td>
                        <td>{{ $transaction->nama_pelanggan }}</td>
                        <td>
                            @foreach ($transaction->details as $detail)
                                {{ $detail->product->nama_produk }} - {{ $detail->product->harga_produk }}
                                <br>
                            @endforeach
                        </td>
                        <td>{{ $transaction->total_belanja }}</td>
                        <td>{{ $transaction->uang_bayar }}</td>
                        <td>{{ $transaction->uang_kembali }}</td>
                        <td>{{ $transaction->created_at }}</td>
                        <!-- <td>
                            <div class="btn-group">
                                @if (Auth::user()->role == 'kasir')
                                    <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-sm btn-outline-dark">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ route('transactions.pdf', $transaction->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fa fa-print"></i>
                                    </a>
                                    <form action="{{ route('transactions.delete', $transaction->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Konfirmasi Hapus Data !?')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td> -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

@endsection
