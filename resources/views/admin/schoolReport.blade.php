@extends('admin.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Reporte del escuela {{ $user->name }}</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <ul class="list-group list-group-horizontal">
          <li class="list-group-item"><i class="fas fa-user"></i> <strong>Jefe:</strong> {{ $user->school_name }}</li>
          <li class="list-group-item"><i class="fas fa-id-card"></i> <strong>Cedula:</strong> {{ $user->document }}</li>
          <li class="list-group-item"><i class="far fa-envelope"></i> <strong>Correo:</strong> {{ $user->email }}</li>
          <li class="list-group-item"><i class="fas fa-phone"></i> <strong>Telefono:</strong> {{ $user->phone }}</li>
        </ul>
      </div>
      <!-- /.content-header -->

      <div class="row">
        <div class="col">


          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Reportes</h3>
            </div>@include('includes.message')
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped table-responsive text-center">
                <thead>
                <tr>
                  <th>Docente</th>
                  <th>Cedula</th>
                  
                  <th>Decanato</th>
                  <th>Seccion</th>
                  <th>Lapso</th>
                  <th>Corte</th>
                  {{-- <th>Unidad</th> --}}
                  <th>Perfil</th>
                  <th>Foro de Informacion</th>
                  <th>Bienvenida al curso</th>
                  <th>Video de Bienvenida</th>
                  <th>Carpeta</th>
                  <th>Foro de Informacio</th>
                  <th>Foro de dudas</th>
                  <th>Entrega de nota</th>
                  <th>Uso de Zoom</th>
                  <th>Interaccion</th>
                  <th>Realimentacion</th>
                  <th>notas finales del corte</th>
                  <th>Actualizo contenido</th>
                  <th>Extracatedra</th>
                  <th>Cumple lineamientos </th>
                  <th>Comentario</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($parameters as $key)
                    <tr>
                        <td>{{ $key->user->name }} {{ $key->user->lastname }}</td>
                        <td>{{ $key->user->document }}</td>
                 
                        <td>{{ $key->decan->name }}</td>
                        <td>{{ $key->section->name }}</td>
                        <td>{{ $key->lapse->lapse }} <strong style="font-size: 10px">{{ $key->lapse->date_range }}</strong></td>
                        <td>{{ $key->stage->stage }}</td>
                        {{-- <td>{{ $key->unit }}</td> --}}
                        <td>{{ $key->perfil }}</td>
                        <td>{{ $key->forum_info }}</td>
                        <td>{{ $key->welcome_course  }}</td>
                        <td>{{ $key->welcome_video }}</td>
                        <td>{{ $key->folder }}</td>
                        <td>{{ $key->forum_info_use }}</td>
                        <td>{{ $key->forum_doubts }}</td>
                        <td>{{ $key->delivery_notes }}</td>
                        <td>{{ $key->tools_use }}</td>
                        <td>{{ $key->interaction }}</td>
                        <td>{{ $key->feedback }}</td>
                        <td>{{ $key->final_notes }}</td>
                        <td>{{ $key->updated }}</td>
                        <td>{{ $key->extracathedral }}</td>
                        <td>{{ $key->accomplish }}</td>
                        <td>{{ $key->comments }}</td>
                      </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Docente</th>
                    <th>cedula</th>
                    
                  <th>Decanato</th>
                    <th>Seccion</th>
                  <th>lapso</th>
                  <th>Corte</th>
                  {{-- <th>Unidad</th> --}}
                  <th>Perfil</th>
                  <th>Foro de Informacion</th>
                  <th>Bienvenida al curso</th>
                  <th>Video de Bienvenida</th>
                  <th>Carpeta</th>
                  <th>Foro de Informacio</th>
                  <th>Foro de dudas</th>
                  <th>Entrega de nota</th>
                  <th>Uso de Zoom</th>
                  <th>Interaccion</th>
                  <th>Realimentacion</th>
                  <th>Notas finales del corte</th>
                  <th>Actualizo contenido</th>
                  <th>Extracatedra</th>
                  <th>Cumple lineamientos </th>
                  <th>Comentario</th>
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