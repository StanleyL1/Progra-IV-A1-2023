@extends('layouts.appweb')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Historial de signos vitales
                </div>
                <div class="card-body">
                    <form action="{{ route('singPaciente') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="frecuencia_respiratoria"><strong>Ingrese su frecuencia respiratoria de hoy:</strong></label>
                            <input type="number" class="form-control" id="frecuencia_respiratoria" name="frecuencia_respiratoria" required>
                        </div>
                        <div class="form-group">
                            <label for="frecuencia_cardiaca"><strong>Ingrese su frecuencia cardiaca de hoy:</strong></label>
                            <input type="number" class="form-control" id="frecuencia_cardiaca" name="frecuencia_cardiaca" required>
                        </div>
                        <div class="form-group">
                            <label for="frecuencia_arterial"><strong>Ingrese su frecuencia arterial de hoy:</strong></label>
                            <input type="number" class="form-control" id="frecuencia_arterial" name="frecuencia_arterial" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
