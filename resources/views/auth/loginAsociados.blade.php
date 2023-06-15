@extends('layouts.sitio')

@section('content')
<div class="container row justify-content-md-center">
  <div class="col col-md col-md-2"></div>
  <div class="col col-md col-md-8 mb-3">
      <!-- Formulario de registro -->
      <div class="container">
        <div class="row">

            <div class="col col-md-6 contenedor">
                <form  action="{{ route('loginAsociados') }}" method="post">
                    @csrf
                    <h1>Crear una cuenta</h1>
                    @if($errors->has('login_error'))
    <div class="alert alert-danger">
        {{ $errors->first('login_error') }}
    </div>
@endif
                        <input class="mb-2"  name="username" type="text" placeholder="Nombre de usuario" required />
                        <input class="mb-2"  name="password" type="password" placeholder="Contraseña" required />
                        <a href="">Olvidastes tu contraseña?</a>
                        <button class="btn btn-primary mt-2" type="submit">inicia Sesion</button>
                  </form>
            </div>
            <div class="col col-md-6 panel ">
                    <h2 class="mb-2">¿Aun no eres asociado?<br>
                        
                        Puedes ver nuestros planes de asociados aqui
                    </h2>
                    <a href="{{ route('asociados') }}"  class="btn btn-primary mt-2 fs-4 ">Asociate</a>
            </div>
        </div>
</div>


  </div>
</div>
@endsection