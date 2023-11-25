@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Second Chois</h1>
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

      <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nomor Unik</label>
            <input name="nomor_unik" type="number" class="form-control" placeholder="..." value="{{ random_int(1000000000, 9999999999); }}"
            readonly >
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
        <div class="form-group">
            <label>Nama Produk + Harga</label>
            <select name="id_produk" class="form-control" required>
                <option value="">- Pilih Produk -</option>
                @foreach ($productsM as $data)
                <option value="{{ $data->id }}">
                    {{ $data->nama_produk }} - {{ $data->harga_produk}}
                </option>
                @endforeach
            </select>
            @error('id_produk')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="form-group">
            <label>Uang Bayar</label>
            <input name="uang_bayar" type="number" class="form-control" placeholder="...">
            @error('uang_bayar')
                <p>{{ $message }}</p>
            @enderror
          </div>

        <!-- <div class="form-group">
            <label>Uang Kembali</label>
            <input name="uang_kembali" type="text" class="form-control" placeholder="...">
            @error('uang_kembali')
                <p>{{ $message }}</p>
            @enderror
        </div>
         -->
      
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