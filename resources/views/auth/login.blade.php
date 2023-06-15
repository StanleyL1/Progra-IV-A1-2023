@extends('layouts.sitio')

@section('content')
<div class="container row justify-content-md-center">
  <div class="col col-md col-md-2"></div>
  <div class="col col-md col-md-8 mb-3">
    <div  class="">
      <!-- Formulario de registro -->
      <div class="container">
        <div class="row">

            <div class="col col-md-6 contenedor">
                <form  action="{{ route('login') }}" method="post">
                    @csrf
                    <h1>Crear una cuenta</h1>
                    @if ($errors->has('login_error'))
        <div class="alert alert-danger">
            {{ $errors->first('login_error') }}
        </div>
    @endif
                        <input class="mb-2"  name="username" type="text" placeholder="Nombre de usuario" required />
                        <input class="mb-2"  name="password" type="password" placeholder="Contraseña" required />
                        <a href="">Olvidastes tu contraseña?</a>
                        <div class="btn-group">
                          <button id="googleSignUpButton" class="btn btn-dark mt-2" type="button"><i class="fa-brands fa-google fa-lg"></i></button>
                          <button id="facebookSignUpButton" class="btn btn-dark mt-2" type="button"><i class="fa-brands fa-facebook fa-lg"></i></button>
                          <button id="" class="btn btn-dark mt-2" type="button"><i class="fa-brands fa-microsoft fa-lg"></i></button>
                        </div>

                        <button class="btn btn-primary mt-2" type="submit">Inicia Sesion</button>
                  </form>
            </div>
            <div class="col col-md-6 panel ">
                    <h2 class="mb-2">¿Aun no ti enes una cuenta?<br>
                        
                        Crearla  dando click en el boton Registrate que esta aqui abajo
                    </h2>
                    <a class="btn btn-primary mt-2 fs-4 " href="{{ route('register') }}">Registrate</a>
            </div>
        </div>
</div>

    </div>
  </div>
</div>
@endsection