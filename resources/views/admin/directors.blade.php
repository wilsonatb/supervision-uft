@extends('admin.layout')

@section('content')

@include('includes.message')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Listado de usuarios directores</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <div class="row">
        <div class="col-12">


          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Editar y eliminar</h3>
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
                                <a href="{{ route('user.updateShowDirector', $user->id) }}" class="btn btn-warning">Editar</a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                    Borrar
                                </button>
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

      <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Estas seguro de eliminar al usuario?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Se borraran todos los valores que incluyan a este usuario!
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <a id="delete" href="{{ route('user.deleteDirector', '?') }}" class="btn btn-danger">Borrar definitivamente</a>
        </div>
      </div>
    </div>
  </div>

   {{-- Script para capturar el id de la tabla y colocarlo en el la ruta deseada --}}
  <script>
    $("#example1 tbody tr").on("click", function(event){
        var valorId = $(this).find("td:first-child").html();  
          //Aqui se toma la route de laravel con un id llamado 'temp'
          //Nota el uso de comillas dobles y simples
          var url = "{{ route('user.deleteDirector', 'temp') }}";
          //Aqui sustituyes la palabra temp por el valor de valorId
          url = url.replace('temp', valorId);

          $('#delete').attr('href', url);
        
    });

  </script>

    @if(Auth::user()->hasRole('admin'))
    
@else
    <div>Acceso usuario</div>
@endif
@endsection