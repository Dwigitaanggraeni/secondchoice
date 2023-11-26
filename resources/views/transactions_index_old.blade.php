@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
<!-- <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Second</h1>
        </div>
  </section> -->

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
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
        <table class="table table-striped table-bordered">
          <tr>

          @if (Auth::user()->role == 'owner')
          <form action="{{ route('transactions.index') }}" method="get">
          <div class="input-group">
            <input type="search" name="search" class="form-control" placeholder="Search" value="{{$vcari}}">
            <button type="submit" class="btn btn-outline-primary mr-1"><i class="fa fa-search"></i></button>
  
            <a href="{{ route('transactions.index')}}">
              <button type="button" class="btn btn-outline-danger"><i class="fa fa-undo"></i></button>
          </div>
          </form>
          @endif
          <br>
      
            
         
  <tr class="bg-dark">
  <th>Nomor Unik</th>
  <th>Nama Pelanggan</th>
  <th>Nama Produk</th>
  <th>Harga Produk</th>
  <th>Uang Bayar</th>
  <th>Uang Kembali</th>
  <th>Tanggal</th>
  <th>Aksi</th>

</tr>
@if(count($transactionsM) > 0)
@foreach ($transactionsM as $data)
<tr>
  <td>{{ $data->nomor_unik}}</td>
  <td>{{ $data->nama_pelanggan}}</td>
  <td>{{ $data->nama_produk}}</td>
  <td>{{ $data->harga_produk}}</td>
  <td>{{ $data->uang_bayar}}</td>
  <td>{{ $data->uang_kembali}}</td>
  <td>{{ $data->created_at}}</td>
  <td>
  <div class="btn-group">
  @if (Auth::user()->role == 'kasir')
    <a href="{{ route('transactions.edit', $data->id_trans) }}" class="btn btn-sm btn-outline-dark">
        <i class="fa fa-edit"></i>
    </a>
    
    <a href="{{ route('transactions.pdf', $data->id_trans) }}" class="btn btn-sm btn-outline-primary">
        <i class="fa fa-print"></i>
    </a>
    

    <form action="{{ route('transactions.delete', $data->id_trans) }}" method="POST">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Konfirmasi Hapus Data !?')">
            <i class="fa fa-trash"></i>
        </button>
    </form>
    @endif

    

</div>

  </td>
</tr>
@endforeach
@else
<tr>
  <td colspan="8">Data Tidak Ditemukan</td> 
</tr>
@endif
       </table>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection