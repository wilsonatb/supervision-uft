@extends('admin.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Listado de Docentes</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <div class="row">
        <div class="col-12">


          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Seleciona un docente para ver su reporte</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Nombre</th>
                  <th>Apellido</th>
                  <th>Cédula</th>
                  <th>Correo</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($users->users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->lastname }}</td>
                        <td>{{ $user->document }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <div class="btn-group-sm text-center" role="group" aria-label="Basic example">
                              @if(Auth::user()->hasRole('admin'))
                                  @php($role = 'admin')
                                  <a href="{{ route('parameters.operativeReportAdmin', $user->id) }}" class="btn btn-warning">Ver</a>
                              @else
                                  @php($role = 'director')
                                  <a href="{{ route('parameters.operativeReport', $user->id) }}" class="btn btn-warning">Ver</a>
                              @endif
                                
                                <!-- Button trigger modal -->
                              </div>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Cédula</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

@endsection