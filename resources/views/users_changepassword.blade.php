@extends('adminlte')
 @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users Pages</h1>
          </div>
        </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tambah Data Users</h3>
        </div>


        <!-- /.card-body -->
        <div class="card-body">
          <a href="{{route('users.index')}}" class="btn btn-default">Kembali</a>
          <br><br>
           <form action="{{route('users.change', $data->id)}}" method="POST">
            @csrf
            @method('put')
            <div class="form-group">
                <label >Username</label>
                <input name="username" type="text" class="form-control" placeholder="..." value="{{ $data->username }}" readonly>
                @error('username')
                <p>{{$message}}</p>     
                @enderror
            </div>
            <!-- <div class="form-group">
                <label >Password lama</label>
                <input name="password_old" type="password" class="form-control" placeholder="...">
                @error('password_old')
                <p>{{$message}}</p>     
                @enderror
            </div> -->
            <div class="form-group">
                <label >Password Baru</label>
                <input name="password_new" type="password" class="form-control" placeholder="...">
                @error('password_new')
                <p>{{$message}}</p>     
                @enderror
            </div>
            <div class="form-group">
                <label >Ulangi Password Baru</label>
                <input name="password_confirm" type="password" class="form-control" placeholder="...">
                @error('password_confirm')
                <p>{{$message}}</p>     
                @enderror
            </div>
        
      <input type="submit" name="submit"class="btn btn-primary" value="Simpan"/>

    </form>
      </div>

      
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection('content')