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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Actualizar datos</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.updateDirector') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name }}" required autofocus>

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
                                <input id="lastname" type="text" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" name="lastname" value="{{ $user->lastname }}" required autofocus>

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
                                <input id="document" type="text" class="form-control{{ $errors->has('document') ? ' is-invalid' : '' }}" name="document" value="{{ $user->document }}" required>

                                @if ($errors->has('document'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('document') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Telefono</label>
                            

                            <div class="col-md-6">
                                <input id="phone" type="tel" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone"  pattern="^[0-9]*$" title="Ingrese solo numeros" required value="{{ $user->phone }}">

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" disabled pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{8,}$">

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" disabled pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])\w{8,}$">

                                <small>
                                    <input type="checkbox" id="pass" class="pass" onChange="updatePass()" />
                                    <label class="text">cambiar contraseña</label>
                                </small>
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
                                    Actualizar
                                </button>
                            </div>
                        </div>

                        <input type="hidden" name="id" value="{{ $user->id }}">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    

$('#pswd_info').hide();

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
    }
</script>
@endsection
