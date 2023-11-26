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
            <h3 class="card-title">Daftar Activity</h3>
        </div>

        <div class="card-body">
            
            @if($message = Session::get('success'))
            <div class="alert alert-success">{{ $message }}</div>
            @endif
            <br>
            <table id="myTable" class="table table-striped table-bordered" style="background-color: #d8bfd8;">
            <thead>
                <tr>
                    <th style="text-align: center; vertical-align: middle;">Nama User</th>
                    <th style="text-align: center; vertical-align: middle;">Activity</th>
                    <th style="text-align: center; vertical-align: middle;">Tanggal & Waktu</th>
                </tr>
                </thead>
                @if(count($LogM) > 0)
                @foreach ($LogM as $data)
                <tr>
                    <td style="text-align: center; vertical-align: middle;">{{ $data->name }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $data->activity }}</td>
                    <td style="text-align: center; vertical-align: middle;">{{ $data->created_at }}</td>
                </tr>
                @endforeach
                @else
                <tr>
                    
                    <td colspan="3" style="text-align: center; vertical-align: middle;">Data Tidak Ditemukan</td>
                </tr>

                @endif
            </table>

        </div>
        <!-- /.card-body -->
        <div class="text-right">
        {{ $LogM->links() }}
    </div>
        

        <div class="card-footer">
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection