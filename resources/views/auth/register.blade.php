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
                <form  action="{{ route('register') }}" method="post">
                    @csrf
                    <h1>Crear una cuenta</h1>
                    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
                        <input class="mb-2"  name="name" type="text" placeholder="Nombre de usuario" required />
                        <input class="mb-2"  name="email" type="email" placeholder="Correo electronico" required />
                        <input class="mb-2"  name="username" type="text" placeholder="Nombre de usuario" required />
                        <input class="mb-2"  name="password" type="password" placeholder="Contraseña" required />
                        <input class="mb-2"  name="password_confirmation" type="password" placeholder="Confirmar contraseña" required />
                        <button class="btn btn-primary mt-2" type="submit">Registrate</button>
                  </form>
            </div>
            <div class="col col-md-6 panel ">
                    <h2 class="mb-2">¿Ya tienes una cuenta?<br>
                        
                        Puedes acceder a ella dando click en el boton inicia sesion que esta aqui abajo
                    </h2>
                    <a class="btn btn-primary mt-2 fs-4 " href="{{ route('login') }}">Inicia sesion</a>
            </div>
        </div>
</div>

    </div>
  </div>
</div>
@endsection