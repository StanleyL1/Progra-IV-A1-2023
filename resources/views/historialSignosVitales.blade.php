@extends('layouts.appweb')

@section('content')
<div class="container">
    <p class="h2 mt-5">Historial de Signos Vitales</p>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Frecuencia Respiratorio</th>
                <th>Frecuencia Cardiaca</th>
                <th>Presion Arterial</th>
            </tr>
        </thead>
        <tbody>
            @foreach($signosVitales as $signoVital)
                <tr>
                    <td>{{ $signoVital->created_at }}</td>
                    <td>{{ $signoVital->frecuencia_respiratoria }}</td>
                    <td>{{ $signoVital->frecuencia_cardiaca }}</td>
                    <td>{{ $signoVital->frecuencia_arterial }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $signosVitales->links() }}
</div>
@endsection
