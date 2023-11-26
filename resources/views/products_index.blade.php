@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
<!-- <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1></h1>
        </div>
  </section> -->

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Produk</h3>
        </div>
    </div>
    <div class="card-body">
        @if($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
        @endif
        <div class="mb-3">
            <a href="{{ route('products.create') }}" class="btn btn-success mr-2">Tambah Data</a>
            <a href="{{ url('products/pdf') }}" class="btn btn-warning">Unduh PDF</a>
        </div>
        <tr>
        @if (Auth::user()->role == 'admin')
            <!-- <form action="{{ route('products.index') }}" method="get">
          <div class="input-group mb-3">
            <input type="search" name="search" class="form-control" placeholder="Masukkan Nama Barang" value="{{ $vcari }}">
            <button type="submit" class="btn btn-outline-primary mr-1"><i class="fa fa-search"></i></button>
            <a href="{{ url('products') }}">
                <button type="button" class="btn btn-outline-danger "><i class="fa fa-undo"></i></button>
            </a>
        </div>
    </form> -->
@endif
<!-- <table id="myTable" class="table table-striped table-bordered"> -->
<table id="myTable" class="table table-striped table-bordered" style="background-color: #d8bfd8;">
    <thead>
        <tr class="bg-dark">
            <th>Thumbnail</th>
            <th>Nama Produk</th>
            <th>Size</th>
            <th>Jenis</th>
            <th>Harga Produk</th>
            <th>Tanggal</th>
            @if (Auth::user()->role == 'admin')
            <th>Aksi</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @if(count($productsM) > 0)
        @foreach ($productsM as $products)
        <tr>
            <td>
                @if ($products->image)
                <a href="{{ asset('images/product/' . $products->image) }}" target="_blank">
            <img src="{{ asset('images/product/' . $products->image) }}" alt="Product Image" width="50">
        </a>
                @else
                No Image
                @endif
            </td>
            <td>{{ $products->nama_produk}}</td>
            <td>{{ $products->size}}</td>
            <td>{{ $products->jenis}}</td>
            <td>{{ $products->harga_produk}}</td>
            <td>{{ $products->created_at}}</td>
            <td>
                <div class="btn-group">
                    @if (Auth::user()->role == 'admin')
                    <a href="{{ route('products.edit', $products->id) }}" class="btn btn-sm btn-outline-dark mr-1">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="{{ route('products.destroy', $products->id )}}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-outline-danger mr-1"
                            onclick="return confirm('Konfirmasi Hapus Data !?')">
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
            <td colspan="6">Data Tidak Ditemukan</td>
        </tr>
        @endif
    </tbody>
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
