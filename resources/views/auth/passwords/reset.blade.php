@extends('layouts.app')

@section('content')
  <!-- jQuery -->
  <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.request') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{8,}$" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

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

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
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
