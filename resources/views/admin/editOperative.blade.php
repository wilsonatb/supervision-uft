@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
@include('includes.message')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Editar datos de {{ $user->name }} {{ $user->lastname }}</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
<div class="">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">Actualizar datos</div>

                <div class="card-body">
                    @if(Auth::user()->hasRole('admin'))
                        @php($role = 'admin')
                        <form method="POST" action="{{ route('user.updateOperativeAdmin') }}">
                    @else
                        @php($role = 'director')
                        <form method="POST" action="{{ route('user.updateOperative') }}">
                    @endif
                    
                        @csrf
                        
                        <input type="hidden" name="role" value="{{ $role }}">
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class="col-md-3 col-form-label text-md-right">{{ __('Lastname') }}</label>

                            <div class="col-md">
                                <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ $user->lastname }}" required autofocus>

                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="document" class="col-md-3 col-form-label text-md-right">Cédula</label>

                            <div class="col-md">
                                <input id="document" type="text" class="form-control{{ $errors->has('document') ? ' is-invalid' : '' }}" name="document" value="{{ $user->document }}" required>

                                @if ($errors->has('document'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('document') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-3 col-form-label text-md-right">Telefono</label>

                            <div class="col-md">
                                <input id="phone" type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone"  pattern="^[0-9]*$" title="Ingrese solo numeros" required value="{{ $user->phone }}">

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- select -->
                        <div class="form-group row">
                            <label for="subject_id" class="col-md-3 col-form-label text-md-right">Materias</label>
                                <div class="col-md">
                                <select class="form-control select2 {{ $errors->has('subject_id') ? ' is-invalid' : '' }}" multiple="multiple" name="subject_id[]" id="subjects" disabled>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->code }} - {{ $subject->school->name }} - {{ $subject->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('subject_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('decan_id') }}</strong>
                                </span>
                            @endif
                                <small>
                                    <input type="checkbox" id="sub" class="sub" onChange="updateSub()" />
                                    <label class="text">Agregar materias</label>
                                </small>
                            </div>
                        </div>

                        <div class="form-group row">
                           
                            <div class="col-md">
                                <input id="password" type="hidden" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{8,}$" class="form-control" value="Admin1234$" name="password" disabled>

                               
                            </div>
                        </div>

                        <div class="form-group row">
                         

                            <div class="col-md">
                                <input id="password-confirm" type="hidden" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{8,}$" class="form-control" name="password_confirmation" value="Admin1234$" disabled>

                               
                            </div>
                        </div>

                       

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Actualizar
                                </button>
                            </div>
                        </div>

                        <input type="hidden" name="id" value="{{ $user->id }}">

                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
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
                        <th>Materia</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->subjects as $subject)
                            <tr>
                                <td>{{ $subject->id }}</td>
                                <td>{{ $subject->code }}</td>
                                <td>{{ $subject->name }}</td>
                                <td><div class="btn-group-sm text-center" role="group" aria-label="Basic example">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                        Borrar
                                    </button>
                                  </div></td>
                            </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Codigo</th>
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
</div>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">¿Esta seguro de eliminar la materia del docente?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Se borraran de manera permanete <strong>TODOS</strong> los datos usados con este docente y esta materia!
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <a id="delete" href="" class="btn btn-danger">Borrar definitivamente</a>
            </div>
          </div>
        </div>
      </div>

<script>

$('#pswd_info').hide();

$('#password,#password-confirm').keyup(function() {
    // set password variable
    var password = $(this).val();
    var p1 = document.getElementById("password").value;
    var p2 = document.getElementById("password-confirm").value;
    var noValido = / /;


    //validar longitud contraseña
    if ( password.length < 8 ) {
        $('#length').removeClass('text-success').addClass('text-danger');
    } else {
        $('#length').removeClass('text-danger').addClass('text-success');
    }
    //validar letra
    if ( password.match(/[A-z]/) ) {
        $('#letter').removeClass('text-danger').addClass('text-success');
    } else {
        $('#letter').removeClass('text-success').addClass('text-danger');
    }

    //validar letra mayúscula
    if ( password.match(/[A-Z]/) ) {
        $('#capital').removeClass('text-danger').addClass('text-success');
    } else {
        $('#capital').removeClass('text-success').addClass('text-danger');
    }

    //validar numero
    if ( password.match(/\d/) ) {
        $('#number').removeClass('text-danger').addClass('text-success');
    } else {
        $('#number').removeClass('text-success').addClass('text-danger');
    }

    if(p1 != "" && p2 != ""){

      //validar confirmación contraseña
      if (p1.length == 0 || p2.length == 0) {
        $('#null').removeClass('text-success').addClass('text-danger');
      } else {
        $('#null').removeClass('text-danger').addClass('text-success');
      }

      //validar contraseñas cohincidan
      if (p1 != p2) {
        $('#match').removeClass('text-success').addClass('text-danger');
      } else {
        $('#match').removeClass('text-danger').addClass('text-success');
      }

      if(noValido.test(p1 || p2)){ // se chequea el regex de que el string no tenga espacio
        $('#blank').removeClass('text-success').addClass('text-danger');
      } else {
        $('#blank').removeClass('text-danger').addClass('text-success');
      }
    }

  }).focus(function() {
      $('#pswd_info').show();
  }).blur(function() {
    $('#pswd_info').hide();
  });
    function updatePass(){
        var password1,password2,check;

        password1=document.getElementById("password");
        password2=document.getElementById("password-confirm");
        check=document.getElementById("pass");

        if(check.checked==true) // Si la checkbox de mostrar contraseña está activada
        {
            password1.required = true;
            password2.required = true;
            password1.disabled = false;
            password2.disabled = false;
        }
        else // Si no está activada
        {
            password1.required = false;
            password2.required = false;
            password1.disabled = true;
            password2.disabled = true;
        }
    }
    
    function updateSub(){
        var sub, check;

        sub=document.getElementById("subjects");
        check=document.getElementById("sub");

        if(check.checked==true) // Si la checkbox de mostrar contraseña está activada
        {
            sub.required = true;
            sub.disabled = false;
        }
        else // Si no está activada
        {
            sub.required = false;
            sub.disabled = true;
        }
    }

    /*  Script para capturar el id de la tabla y colocarlo en el la ruta deseada  */
    $("#example1 tbody tr").on("click", function(event){
        var valorId = $(this).find("td:first-child").html();  
          //Aqui se toma la route de laravel con un id llamado 'temp'
          //Nota el uso de comillas dobles y simples
          var url = "{{ route('user.deleteSubjectOpe', ['user_id' => $user->id,'id' => 'temp']) }}";
          //Aqui sustituyes la palabra temp por el valor de valorId
          url = url.replace('temp', valorId);

          $('#delete').attr('href', url);
        
    });
</script>
@endsection
