@extends('admin.layout')

@section('content')

@include('includes.message')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Agregar seccion</h1>
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
                <h3 class="card-title">Guardar nueva seccion</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{ route('section.'.$route) }}" method="POST">
                    @csrf
                <div class="card-body">
                    <div class="form-group">
                    <label for="lapse">Seccion</label>
                   
                    <input type="text" name="section" value="{{ isset($section->name) ? $section->name : '' }}" class="form-control {{ $errors->has('section') ? ' is-invalid' : '' }}" placeholder="Introduce el seccion" required>

                    @if ($errors->has('section'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('section') }}</strong>
                            </span>
                        @endif
                    </div>

                    <input type="hidden" name="id" value="{{ isset($section->id) ? $section->id : '' }}">
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
                  <h3 class="card-title">Lista de secciones UFT</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-striped text-center">
                    <thead>
                      <tr>
                        <th >#</th>
                        <th>Seccion</th>
                        <th>Editar</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($sections as $section)
                            <tr>
                                <td>{{ $section->id }}</td>
                                <td>{{ $section->name }}</td>
                                <td>
                                  <a href="{{ route('section.show', $section->id) }}" class="btn btn-warning">Editar</a>
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
        <h5 class="modal-title" id="exampleModalLabel">¿Estas seguro de eliminar la escuela?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Se borraran todos los valores que incluyan a esta escuela!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a id="delete" href="{{ route('section.delete', '?') }}" class="btn btn-danger">Borrar definitivamente</a>
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
        var url = "{{ route('section.delete', 'temp') }}";
        //Aqui sustituyes la palabra temp por el valor de valorId
        url = url.replace('temp', valorId);

        $('#delete').attr('href', url);
      
  });

</script>
@endsection