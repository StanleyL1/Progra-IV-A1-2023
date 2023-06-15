<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Norris</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <script src="https://kit.fontawesome.com/b57616fca1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <script src="https://alcdn.msauth.net/browser/2.30.0/js/msal-browser.js"></script>
    <meta name="google-signin-client_id" content="918911739694-hruh3bkohbgntm7aguhesiipupf199aa.apps.googleusercontent.com">

    <style>
        .img-mediano {
            width: 50%;
            max-width: 500px;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            line-height: 1.4;
            background-color: #e5e7e9;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('Norris') }}">Norris</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('Norris') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('asociados') }}">Asociados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Quienes somos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Preguntas frecuentes</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16" style="vertical-align: middle;">
                                <path fill-rule="evenodd" d="..."></path>
                                <path fill-rule="evenodd" d="..."></path>
                            </svg>
                            Iniciar Sesion
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16" style="vertical-align: middle;">
                                <path d="..."></path>
                                <path fill-rule="evenodd" d="..."></path>
                            </svg>
                            Registrate
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="fb-root"></div>
    @yield('content')
    <footer class="footer text-center fixed-bottom mt-5">
        <div class="container">
            <p>&copy; 2023 Norris. Todos los derechos reservados.</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Inicio</a></li>
                <li class="list-inline-item"><a href="#">Asociados</a></li>
                <li class="list-inline-item"><a href="#">Quiénes somos</a></li>
                <li class="list-inline-item"><a href="#">Preguntas frecuentes</a></li>
            </ul>
        </div>
    </footer>
    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
