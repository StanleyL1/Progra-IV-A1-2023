<!-- historialSintomas.blade.php -->

@extends('layouts.appweb')

@section('content')
<div class="container">
    <p class="h2 mt-5">Historial de Síntomas</p>
    <table class="table mb-5 mt-3">
        <thead>
            <tr>
            <th>Fecha</th>

                <th>Dificultad para respirar</th>
                <th>Tos</th>
                <th>Nivel de fatiga</th>
                <th>Actividad al inicio de los síntomas</th>
                <th>Medicina de rescate usada</th>
                <th>Nivel de dolor de cabeza</th>
                <th>Temperatura más alta</th>
                <th>Información adicional</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sintomas as $sintoma)
                <tr>
                <td>{{ $sintoma->created_at }}</td>

                    <td>{{ $sintoma->dificultad_respirar }}</td>
                    <td>{{ $sintoma->tos }}</td>
                    <td>{{ $sintoma->nivel_fatiga }}</td>
                    <td>{{ $sintoma->actividad_inicio_sintomas }}</td>
                    <td>{{ $sintoma->medicina_rescate_usada }}</td>
                    <td>{{ $sintoma->nivel_dolor_cabeza }}</td>
                    <td>{{ $sintoma->temperatura_mas_alta }}</td>
                    <td>{{ $sintoma->informacion_adicional }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $sintomas->links() }}
</div>
@endsection
