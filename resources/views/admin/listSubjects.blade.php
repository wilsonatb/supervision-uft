@extends('admin.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Listado de Materias</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <div class="row">
        <div class="col-12">


          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Seleciona una materia para ver su reporte</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Escuela</th>
                  <th>Codigo</th>
                  <th>Nombre</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($subjects as $subject)
                    <tr>
                        <td>{{ $subject->id }}</td>
                        <td>{{ $subject->school->name }}</td>
                        <td>{{ $subject->code }}</td>
                        <td>{{ $subject->name }}</td>
                        <td>
                            <div class="btn-group-sm text-center" role="group" aria-label="Basic example">
                              <div class="btn-group-sm text-center" role="group" aria-label="Basic example">
                                @if(Auth::user()->hasRole('admin'))
                                    @php($role = 'admin')
                                    <a href="{{ route('parameters.subjectReportAdmin', $subject->id) }}" class="btn btn-warning">Ver</a>
                                @else
                                    @php($role = 'director')
                                    <a href="{{ route('parameters.subjectReport', $subject->id) }}" class="btn btn-warning">Ver</a>
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
                  <th>Escuela</th>
                  <th>Codigo</th>
                  <th>Nombre</th>
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