@extends('adminlte')
@section('content')
<!-- Content Header (Page header) -->
<!-- <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Pet shop Lontar</h1>
        </div>
        
      </div>
    </div>
  </section> -->

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Pengguna</h3>
        </div>
   
      </div>
      <div class="card-body">
        @if($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
        @endif
        <a href="{{ route('users.create') }}" class="btn btn-success">Tambah Data</a>
        <br><br>
        <table id="myTable" class="table table-striped table-bordered" style="background-color: #d8bfd8;">
        <thead>
<tr class="bg-dark">
  <th>Nama Lengkap</th>
  <th>Username</th>
  <th>Role</th>
  @if (Auth::user()->role == 'admin')
  <th>Aksi</th>
  @endif
</tr>
</thead>
@if(count($usersM) > 0)
@foreach ($usersM as $data)
<tr>
  <td>{{ $data->name}}</td>
  <td>{{ $data->username}}</td>
  <td>{{ $data->role}}</td>
  <td>
  <div class="btn-group">
  @if (Auth::user()->role == 'admin')
    <a href="{{ route('users.edit', $data->id) }}" class="btn btn-sm btn-outline-dark mr-1"><i class="fa fa-edit"></i></a>
    <form action="{{ route('users.destroy', $data->id) }}" method="POST">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-sm btn-outline-danger mr-1" onclick="return confirm('Konfirmasi Hapus Data !?')"><i class="fa fa-trash"></i></button>
    </form>
    <a href="{{ route('users.changepassword', $data->id) }}" class="btn btn-sm btn-outline-primary "><i class="fa fa-lock"></i></a>
</div>
@endif

  </td>
</tr>
@endforeach
@else
<tr>
  <td colspan="5">Data Tidak Ditemukan</td> 
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