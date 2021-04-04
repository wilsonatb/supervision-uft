@extends('admin.layout')

@section('content')
    <!-- Content Header (Page header) -->

    @include('includes.message')
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Agregar periodo academico</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Guardar nuevo lapso</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                
                  <form role="form" action="{{ route('lapse.'.$route) }}" method="POST">
                    @csrf

                    <input type="hidden" name="id" value="{{ isset($lapse->id) ? $lapse->id : '' }}">
                <div class="card-body">
                    <div class="form-group">
                    <label for="lapse">Lapso academico</label>
                    <input type="text" name="lapse" class="form-control" value="{{ isset($lapse->lapse) ? $lapse->lapse : '' }}" placeholder="Introduce el lapso" required>
                    </div>

                    <div class="form-group">
                      <label>Fecha de inicio - fin</label>
    
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">
                            <i class="far fa-calendar-alt"></i>
                          </span>
                        </div>
                        <input type="text" value="{{ isset($lapse->date_range) ? $lapse->date_range : '' }}" class="form-control float-right" name="date_range" id="date_range">
                      </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-uft">Guardar</button>
                </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Lista de lapsos academicos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped text-center">
                    <thead>
                      <tr>
                        <th >#</th>
                        <th>Lapso</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($lapses as $lapse)
                            <tr>
                                <td>{{ $lapse->id }}</td>
                                <td>{{ $lapse->lapse }}</td>
                                <td>{{ $lapse->date_range }}</td>
                                <td>
                                  <a href="{{ route('lapse.show', $lapse->id) }}" class="btn btn-warning">Editar</a>
                                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                    Borrar
                                  </button>
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
        <h5 class="modal-title" id="exampleModalLabel">¿Estas seguro de eliminar el lapso?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Se borraran todos los valores que incluyan a esta lapso!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a id="delete" href="{{ route('lapse.delete', '?') }}" class="btn btn-danger">Borrar definitivamente</a>
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
        var url = "{{ route('lapse.delete', 'temp') }}";
        //Aqui sustituyes la palabra temp por el valor de valorId
        url = url.replace('temp', valorId);

        $('#delete').attr('href', url);
      
  });

</script>
      
@endsection