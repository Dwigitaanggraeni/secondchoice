@extends('adminlte')
 @section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Peserta Didik Pages</h1>
          </div>
        </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tambah Data Peserta Didik</h3>
        </div>


        <!-- /.card-body -->
        <div class="card-body">
          <a href="{{route('users.index')}}" class="btn btn-default">Kembali</a>
          <br><br>
           <form action="{{route('users.store')}}" method="POST">
            @csrf
            <div class="form-group">
                <label >Nama lengkap</label>
                <input name="name" type="text" class="form-control" placeholder="Nama Lengkap">
                @error('name')
                <p>{{$message}}</p>     
                @enderror
            </div>
            <div class="form-group">
                <label >Username</label>
                <input name="username" type="text" class="form-control" placeholder="Username">
                @error('username')
                <p>{{$message}}</p>     
                @enderror
            </div>
            <div class="form-group">
                <label >Password</label>
                <input name="password" type="password" class="form-control" placeholder="Password">
                @error('password')
                <p>{{$message}}</p>     
                @enderror
            </div>
            <div class="form-group">
                <label >Ulangi Password</label>
                <input name="password_confirm" type="password" class="form-control" placeholder="Ulangi Password">
                @error('password_confirm')
                <p>{{$message}}</p>     
                @enderror
            </div>
            <div class="form-group">
                <label >Pilih Role</label>
               <select name="role" class="form-control" id="">
                <option value="">---Pilih Role---</option>
                <option value="owner">Owner</option>
                <option value="kasir">Kasir</option>
                <option value="admin">Admin</option>
               </select>
                @error('role')
                <p>{{$message}}</p>     
                @enderror
            </div>
             
    
        
      <input type="submit" name="submit"class="btn btn-primary" value="Tambah"/>

    </form>
      </div>

      
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  @endsection('content')