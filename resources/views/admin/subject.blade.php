@extends('admin.layout')

@section('content')
    <!-- Content Header (Page header) -->
    @include('includes.message')
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Agregar materia</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Guardar nueva materia</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" action="{{ route('subject.save') }}" method="POST">
                    @csrf
                <div class="card-body">
                    <!-- select -->
                    <div class="form-group">
                        <label>Escuela</label>
                        <select class="form-control" name="school_id">
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}">{{ $school->name }}</option>
                            @endforeach
                        </select>
                      </div>
                    <div class="form-group">
                    <label for="lapse">Materia</label>
                    <input type="text" name="subject" class="form-control" placeholder="Introduce la materia" required>
                    </div>
                    <div class="form-group">
                        <label for="lapse">Codigo</label>
                        <input type="text" name="code" class="form-control {{ $errors->has('code') ? ' is-invalid' : '' }}" placeholder="Introduce el codigo" required>

                        @if ($errors->has('code'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('code') }}</strong>
                            </span>
                        @endif
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
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Lista de Materias</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>Id</th>
                        <th>Codigo</th>
                        <th>Escuela</th>
                        <th>Materia</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subjects as $subject)
                            <tr>
                              <td>{{ $subject->id }}</td>
                                <td>{{ $subject->code }}</td>
                                <td>{{ $subject->school->name }}</td>
                                <td>{{ $subject->name }}</td>
                                <td>
                                  <div class="btn-group-sm text-center" role="group" aria-label="Basic example">
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
                        <th>Codigo</th>
                        <th>Escuela</th>
                        <th>Materia</th>
                        <th>Eliminar</th>
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
        <h5 class="modal-title" id="exampleModalLabel">¿Estas seguro de eliminar la materia?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Se borraran todos los valores que incluyan a esta materia!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a id="delete" href="{{ route('subject.delete', '?') }}" class="btn btn-danger">Borrar definitivamente</a>
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
        var url = "{{ route('subject.delete', 'temp') }}";
        //Aqui sustituyes la palabra temp por el valor de valorId
        url = url.replace('temp', valorId);

        $('#delete').attr('href', url);
      
  });

</script>
@endsection