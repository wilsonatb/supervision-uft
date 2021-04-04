@extends('admin.layout')

@section('content')

@include('includes.message')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Panel de control</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

    @if(Auth::user()->hasRole('admin'))
    <div>Acceso como administrador</div>
    @elseif(Auth::user()->hasRole('director'))
    <div>Acceso como director</div>
    @elseif(Auth::user()->hasRole('operativo'))
    <div>No tienes permisos</div>
    @endif
@endsection