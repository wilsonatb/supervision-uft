@extends('admin.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Listado de escuelas</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <div class="row">
        <div class="col-12">


          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Seleciona una escuela para ver su reporte</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Codigo</th>
                  <th>Escuela</th>
                  <th>Jefe</th>
                  <th>Cedula</th>
                  <th>Telefono</th>
                  <th>Correo</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($schools as $school)
                    <tr>
                        <td>{{ $school->id }}</td>
                        <td>{{ $school->code }}</td>
                        <td>{{ $school->name }}</td>
                        <td>{{ $school->school_name }}</td>
                        <td>{{ $school->document }}</td>
                        <td>{{ $school->phone }}</td>
                        <td>{{ $school->email }}</td>
                        <td>
                            <div class="btn-group-sm text-center" role="group" aria-label="Basic example">
                              <div class="btn-group-sm text-center" role="group" aria-label="Basic example">
                                @if(Auth::user()->hasRole('admin'))
                                    @php($role = 'admin')
                                    <a href="{{ route('parameters.schoolReportAdmin', $school->id) }}" class="btn btn-warning">Ver</a>
                                @else
                                    @php($role = 'director')
                                    <a href="{{ route('parameters.schoolReport', $school->id) }}" class="btn btn-warning">Ver</a>
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
                    <th>Codigo</th>
                    <th>Escuela</th>
                    <th>Jefe</th>
                    <th>Cedula</th>
                    <th>Telefono</th>
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