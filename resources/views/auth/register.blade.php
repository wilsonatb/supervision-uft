@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            
            @php
                $urls = $_SERVER["REQUEST_URI"];
                $url = explode("registro", $urls);
            @endphp
            
            
            @if($url[1] == '-operativo.admin/true')

                <h1 class="m-0 text-dark">Registro de docentes </h1>

            @else

            @if(Auth::user()->hasRole('admin'))
                <h1 class="m-0 text-dark">Registro de directores</h1>
            @elseif(Auth::user()->hasRole('director'))
                <h1 class="m-0 text-dark">Registro de docentes</h1>
            @endif

            @endif
          
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Lastname') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ old('lastname') }}" required autofocus>

                                @if ($errors->has('lastname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="document" class="col-md-4 col-form-label text-md-right">Cédula</label>

                            <div class="col-md-6">
                                <input id="document" type="text" class="form-control{{ $errors->has('document') ? ' is-invalid' : '' }}" name="document" value="{{ old('document') }}" required>

                                @if ($errors->has('document'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('document') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Telefono</label>

                            <div class="col-md-6">
                                <input id="phone" type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" pattern="^[0-9]*$" title="Ingrese solo numeros" required>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        @if($url[1] == '-operativo.admin/true')

                            <!-- select -->
                            <div class="form-group row">
                                <label for="subject_id" class="col-md-4 col-form-label text-md-right">Materias</label>
                                    <div class="col-md-6">
                                    <select class="form-control select2 {{ $errors->has('subject_id') ? ' is-invalid' : '' }}" multiple="multiple" name="subject_id[]" required>
                                        @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->code }} - {{ $subject->school->name }} - {{ $subject->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('subject_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('decan_id') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <input type="hidden" name="subject_enable" value="true">

                        @else

                        @if(Auth::user()->hasRole('director'))
                            <!-- select -->
                            <div class="form-group row">
                                <label for="subject_id" class="col-md-4 col-form-label text-md-right">Materias</label>
                                    <div class="col-md-6">
                                    <select class="form-control select2 {{ $errors->has('subject_id') ? ' is-invalid' : '' }}" multiple="multiple" name="subject_id[]" required>
                                        @foreach($subjects as $subject)
                                            <option value="{{ $subject->id }}">{{ $subject->code }} - {{ $subject->school->name }} - {{ $subject->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('subject_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('decan_id') }}</strong>
                                    </span>
                                @endif
                                </div>
                            </div>
                            <input type="hidden" name="subject_enable" value="true">
                        @else
                            <input type="hidden" name="subject_enable" value="false">
                        @endif

                        @endif

                        

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        
                        @if($docente_pass == false)
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{8,}$" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            
                            <div class="col-md-6">
                                <input id="password-confirm" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{8,}$" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                          <div class="jumbotron jumbotron-fluid" id="pswd_info">
                            <div class="container">
                                <h4>La contraseña debe cumplir los siguientes requerimientos:</h4>
                                <ul>
                                  <li id="letter" class="text-danger">Al menos <strong>una letra</strong></li>
                                  <li id="capital" class="text-danger">Al menos <strong>una letra mayúscula</strong></li>
                                  <li id="number" class="text-danger">Al menos <strong>un número</strong></li>
                                  <li id="length" class="text-danger">Al menos <strong>8 carácteres</strong></li>
                                  <li id="null" class="text-danger">Debe <strong>confirmar la contraseña</strong></li>
                                  <li id="match" class="text-danger">Las contraseñas <strong>deben cohincidir</strong></li>
                                  <li id="blank" class="text-danger">Las contraseñas <strong>no deben tener espacios</strong></li>
                                </ul>
                            </div>
                          </div>
                          @else
                          <div class="form-group row">
                            

                            <div class="col-md-6">
                                <input id="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{8,}$" type="hidden" class="form-control" name="password" value="Admin1234$" required>

                                
                            </div>
                        </div>

                        <div class="form-group row">
                          
                            
                            <div class="col-md-6">
                                <input id="password-confirm" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{8,}$" type="hidden" class="form-control" value="Admin1234$" name="password_confirmation" required>
                            </div>
                        </div>
                        @endif
                        
            
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        

                        @if($url[1] == '-operativo.admin/true')

                        <input type="hidden" name="role" value="operativo">

                        @else

                        @if(Auth::user()->hasRole('admin'))
                            <input type="hidden" name="role" value="director">
                        @elseif(Auth::user()->hasRole('director'))
                            <input type="hidden" name="role" value="operativo">
                        @endif

                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        // Obtener url para identificar si es admin o no la ruta
    var pathname = window.location.pathname;
    var separa = pathname.split(".");

    if (separa[1] == 'admin') {
        var admin = 'admin';
    } else {
        var admin = '';
    }

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
})
</script>
@endsection
