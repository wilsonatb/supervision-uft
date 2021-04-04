@extends('admin.layout')

@section('content')
    <!-- Content Header (Page header) -->
    @include('includes.message')
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Agregar Escuela</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <div class="row">
        <!-- left column -->
        <div class="col-md-3">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Guardar nuevo escuela</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @if ($edit == 'true')
                <form role="form" action="{{ route('school.edit') }}" method="POST">
                @else
                <form role="form" action="{{ route('school.save') }}" method="POST">
                @endif
                
                    @csrf

                    <input type="hidden" name="id" value="{{ isset($school->id) ? $school->id : '' }}">

                <div class="card-body">
                    <!-- select -->
                    <div class="form-group">
                        <label>Decanato</label>
                        <select class="form-control" name="decan_id">
                            @foreach($decans as $decan)
                                <option value="{{ $decan->id }}">{{ $decan->name }}</option>
                            @endforeach
                        </select>
                      </div>
                    <div class="form-group">
                    <label for="lapse">Escuela</label>
                    <input type="text" name="school" class="form-control" value="{{ isset($school->name) ? $school->name : '' }}" placeholder="Introduce la escuela" required>
                    </div>
                    <div class="form-group">
                        <label for="lapse">Codigo</label>
                        <input type="text" name="code" class="form-control {{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="Introduce el codigo" value="{{ isset($school->code) ? $school->code : '' }}" required>

                        @if ($errors->has('code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('code') }}</strong>
                            </span>
                        @endif
                        </div>

                        <div class="form-group">
                          <label for="school_name">Nombre Jefe</label>
                          <input type="text" name="school_name" value="{{ isset($school->school_name) ? $school->school_name : '' }}" class="form-control" placeholder="Introduce el nombre" required>
                          </div>
                      
                        <div class="form-group">
                        <label for="document">Cedula</label>
                        <input type="text" name="document" value="{{ isset($school->document) ? $school->document : '' }}" class="form-control" placeholder="Introduce la cedula" required>
                        </div>
                    
                      <div class="form-group">
                      <label for="phone">Telefono</label>
                      <input type="tel" pattern="^[0-9]*$" value="{{ isset($school->phone) ? $school->phone : '' }}" name="phone" class="form-control" placeholder="Introduce el telefono" required>
                      </div>
                  
                    <div class="form-group">
                    <label for="email">Correo</label>
                    <input type="email" name="email" value="{{ isset($school->email) ? $school->email : '' }}" class="form-control" placeholder="Introduce el correo" required>
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
        <div class="col-md-9">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Lista de Escuelas</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Id</th>
                        <th>Codigo</th>
                        <th>Decanato</th>
                        <th>Escuela</th>
                        <th>Jefe</th>
                        <th>Cedula</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Editar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($schools as $school)
                            <tr>
                              <td>{{ $school->id }}</td>
                                <td>{{ $school->code }}</td>
                                <td>{{ $school->decan->name }}</td>
                                <td>{{ $school->name }}</td>
                                <td>{{ $school->school_name }}</td>
                                <td>{{ $school->document }}</td>
                                <td>{{ $school->phone }}</td>
                                <td>{{ $school->email }}</td>
                                <td>
                                  <div class="btn-group-sm text-center" role="group" aria-label="Basic example">
                                    <a href="{{ route('school.show', $school->id) }}" class="btn btn-warning">Editar</a>
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
                      <th>Codigo</th>
                      <th>Decanato</th>
                      <th>Escuela</th>
                      <th>Jefe</th>
                        <th>Cedula</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Editar</th>
                    </tr>
                    </tfoot>
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
        <a id="delete" href="{{ route('school.delete', '?') }}" class="btn btn-danger">Borrar definitivamente</a>
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
        var url = "{{ route('school.delete', 'temp') }}";
        //Aqui sustituyes la palabra temp por el valor de valorId
        url = url.replace('temp', valorId);

        $('#delete').attr('href', url);
      
  });

</script>
@endsection