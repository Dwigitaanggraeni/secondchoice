@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Petshop Lontar</h1>
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Edit User</h3>
      </div>
      <div class="card-body">
        <a href="{{ route('users.index') }}" class="btn btn-default">Kembali</a>
        <br><br>

        <form action="{{ route('users.update', $users->id) }}" method="POST">
        @csrf
        @method('put')

       <div class="form-group">
            <label>Nama Lengkap</label>
            <input name="name" type="text" class="form-control" placeholder="..."value="{{ $users->name }}">
            @error('name')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Username</label>
            <input name="username" type="text" class="form-control" placeholder="..."value="{{ $users->username }}" readonly>
            @error('username')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <!-- <div class="form-group">
            <label>Password</label>
             <input name="password" type="password" 
             {{-- class="form-control" placeholder="...">
            @error('password')
                <p>{{ $message }}</p>
            @enderror
        </div> --}} -->

      <div class="form-group">
        <label>Roles</label>
        <select name="role" class="form-control"> 
          <option>- Pilih Role -</option>
          <option value="kasir">Kasir</option>
          <option value="owner">Owner</option>
          <option value="admin">Admin</option>
      </select>
        @error('role')
            <p>{{ $message }}</p>
        @enderror
    </div>

        <input type="submit" name="submit" class="btn btn-success"  value="Edit">
      </form>
    </div>
      <!-- /.card-body -->
      <div class="card-footer">
        Footer
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
@endsection