@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Second Choice</h1>
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Tambah Data Produk</h3>
      </div>
      <div class="card-body">
        <a href="{{ route('products.index') }}" class="btn btn-default">Kembali</a>
        <br><br>

      <!-- <form action="{{ route('products.store') }}" method="POST"> -->
      <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Image:</strong>
                <input type="file" name="image" class="form-control-file" id="image" accept="image/*">

                @error('image')
                <p>{{ $message }}</p>
            @enderror
            </div>
        </div>
        <div class="form-group">
            <label>Nama Produk</label>
            <input name="nama_produk" type="text" class="form-control" placeholder="...">
            @error('nama_produk')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
                <label >Pilih Size</label>
               <select name="size" class="form-control" id="">
                <option value="">---Pilih Size---</option>
                <option value="XS">XS</option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
                <option value="XXL">XXL</option>
               </select>
                @error('size')
                <p>{{$message}}</p>     
                @enderror
            </div>
        <div class="form-group">
                <label >Pilih jenis</label>
               <select name="jenis" class="form-control" id="">
                <option value="">---Pilih jenis---</option>
                <option value="pans">Pans</option>
                <option value="knitware">Knitware</option>
                <option value="crewneck">Crewneck</option>
                <option value="hoodie">Hoodie</option>
                <option value="jacket">jacket</option>
               </select>
                @error('jenis')
                <p>{{$message}}</p>     
                @enderror
            </div>
        <div class="form-group">
            <label>Harga Produk</label>
            <input name="harga_produk" type="number" class="form-control" placeholder="...">
            @error('harga_produk')
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
@endsection