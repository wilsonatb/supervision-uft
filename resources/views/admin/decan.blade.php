@extends('admin.layout')

@section('content')

@include('includes.message')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Agregar decanato</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <div class="row">
        <!-- left column -->
        <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Guardar nuevo decanato</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @if ($edit == 'true')
                <form role="form" action="{{ route('decan.update') }}" method="POST">
                @else
                <form role="form" action="{{ route('decan.save') }}" method="POST">
                @endif
                
                    @csrf

                    <input type="hidden" name="id" value="{{ isset($decan->id) ? $decan->id : '' }}">

                <div class="card-body">
                    <div class="form-group">
                    <label for="decan">Decanato</label>
                    <input type="text" name="decan" value="{{ isset($decan->name) ? $decan->name : '' }}" class="form-control {{ $errors->has('decan') ? ' is-invalid' : '' }}" placeholder="Introduce el decanato" required>

                    @if ($errors->has('decan'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('decan') }}</strong>
                            </span>
                        @endif
                    </div>
                
                  <div class="form-group">
                  <label for="decan_name">Nombre decano</label>
                  <input type="text" name="decan_name" value="{{ isset($decan->decan_name) ? $decan->decan_name : '' }}" class="form-control" placeholder="Introduce el nombre" required>
                  </div>
              
                <div class="form-group">
                <label for="document">Cedula</label>
                <input type="text" name="document" value="{{ isset($decan->document) ? $decan->document : '' }}" class="form-control" placeholder="Introduce la cedula" required>
                </div>
            
              <div class="form-group">
              <label for="phone">Telefono</label>
              <input type="tel" pattern="^[0-9]*$" value="{{ isset($decan->phone) ? $decan->phone : '' }}" name="phone" class="form-control" placeholder="Introduce el telefono" required>
              </div>
          
            <div class="form-group">
            <label for="email">Correo</label>
            <input type="email" name="email" value="{{ isset($decan->email) ? $decan->email : '' }}" class="form-control" placeholder="Introduce el correo" required>
            </div>
        </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-uft">Guardar</button>
                </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-8">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Lista de decanatos UFT</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped text-center">
                    <thead>
                      <tr>
                        <th >#</th>
                        <th>Decanato</th>
                        <th>Decano</th>
                        <th>Cedula</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($decans as $decan)
                            <tr>
                                <td>{{ $decan->id }}</td>
                                <td>{{ $decan->name }}</td>
                                <td>{{ $decan->decan_name }}</td>
                                <td>{{ $decan->document }}</td>
                                <td>{{ $decan->phone }}</td>
                                <td>{{ $decan->email }}</td>
                                <td>
                                  <div class="btn-group-sm text-center" role="group" aria-label="Basic example">
                                      <a href="{{ route('decan.edit', $decan->id) }}" class="btn btn-warning">Editar</a>
                                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                        Borrar
                                      </button>
                                    </div>
                              </td>
                            </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
        </div>
      </div>
 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">¿Estas seguro de eliminar el decanato?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Se borraran todos los valores que incluyan a esta decanato!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a id="delete" href="{{ route('decan.delete', '?') }}" class="btn btn-danger">Borrar definitivamente</a>
      </div>
    </div>
  </div>
</div>

 {{-- Script para capturar el id de la tabla y colocarlo en el la ruta deseada --}}
<script>
  $(".table tbody tr").on("click", function(event){
      var valorId = $(this).find("td:first-child").html();  
        //Aqui se toma la route de laravel con un id llamado 'temp'
        //Nota el uso de comillas dobles y simples
        var url = "{{ route('decan.delete', 'temp') }}";
        //Aqui sustituyes la palabra temp por el valor de valorId
        url = url.replace('temp', valorId);

        $('#delete').attr('href', url);
      
  });

</script>

@endsection