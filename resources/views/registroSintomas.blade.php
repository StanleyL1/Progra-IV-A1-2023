
@extends('layouts.appweb')
@section('content')
<div class="container">
        <div class="card1">
          <div class="card-body">
            <h2>Registro de Síntomas</h2>
            <div class="form-container">
              <div class="row">
                <div class="aling-items-start  col col-md-10">
                  <p class="subtitle">
                    Registro de Sintomas
                  </p>
                </div>
                <div class="col col-md-2 mt-2">
                  <a class="btn btn-dark" href="/historialSintomas">Historial</a>
                </div>
              </div>
                <br><br>
                <form action="{{ route('sintPaciente') }}" method="POST" class="  text-start justify-content-start" style="display: block;">
                  @csrf
                    <div class="form-group">
                  <label class="range1" for="rangeSlider1">¿Cómo calificaría su dificultad para respirar en una escala del 1 al 10</label>
                  <div class="sub1">Siendo 1 sin dificultad y 10 la maxima dificultad</div>
                  <div class="slider-container">
                    <input type="range" class="form-control-range slider" id="rangeSlider1" min="0" max="10" name="dificultad_respirar">
                    <div class="counter">0</div>
                  </div>
                </div>
            
                <div class="form-group">
                  <label class="range2" for="rangeSlider2">¿Ha tenido tos? ¿Es seca o productiva (con flema)?</label>
                  <div class="sub2">Siendo su tos en una escala del 1 al 10, siendo 1 leve y 10 tos extrema</div>
                  <div class="slider-container">
                    <input type="range" class="form-control-range slider" id="rangeSlider2" min="0" max="10" name="tos">
                    <div class="counter">0</div>
                  </div>
                </div>
            
                <div class="form-group">
                  <label class="range3" for="rangeSlider3">¿Como calificaría su nivel de fatiga en una escala del 1 al 10?</label>
                  <div class="sub3">sin fatiga 1 y 10 extrema fatiga</div>
                  <div class="slider-container">
                    <input type="range" class="form-control-range slider" id="rangeSlider3" min="0" max="10" name="nivel_fatiga">
                    <div class="counter">0</div>
                  </div>
                </div>
            
                <div class="form-group">
                  <label class="in1" for="input1">¿Que activad estaba realizando cuando comenzo a experimentar estos sintomas?</label>
                  <div class="input-container">
                    <input placeholder="Escriba aqui" type="text" class="form-control input" id="input1" name="actividad_inicio_sintomas">
                  </div>
                </div>
            
                <div class="form-group">
                  <label class="in2" for="input2">¿Ha tenido que usar medicina de rescate (como un inhalador de accíon síntomas?)</label>
                  <div class="input-container">
                    <input placeholder="Escriba aqui" type="text" class="form-control input" id="input2" name="medicina_rescate_usada">
                  </div>
                </div>
            
                <div class="form-group">
                  <label class="range4" for="rangeSlider4">¿Ha tenido dolor de cabeza?</label>
                  <div class="sub4">¿Como calificaría su dolor de cabeza en una escala del 1 al 10, siendo 1 dolor leve
                    y 10 dolor extremo?
                  </div>
                  <div class="slider-container">
                    <input  type="range" class="form-control-range slider" id="rangeSlider4" min="0" max="10" name="nivel_dolor_cabeza">
                    <div class="counter">0</div>
                  </div>
                </div>

                <div class="form-group">
                    <label class="range5" for="rangeSlider5">¿Ha tenido fiebre?</label>
                    <div class="sub5">¿Cual fue la temperatura mas alta que registro?
                    </div>
                    <div class="slider-container">
                      <input type="range" class="form-control-range slider" id="rangeSlider5" min="0" max="10" name="temperatura_mas_alta">
                      <div class="counter">0</div>
                    </div>
                  </div>

                <div class="form-group">
                  <label class="in3" for="input3">¿Hay alguna otra informacion que le gustaria agregar?</label>
                  <div class="input-container">
                    <input placeholder="Escriba aqui" type="text" class="form-control input" id="input3" name="informacion_adicional">
                  </div>
                </div>
              </div>
              <div class="">
                <button type="submit" class="btn btn-dark">Enviar</button>
              </div>
            </form>
          </div>
        </div>
</div>
              <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
              <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
              <script>
                $(document).ready(function() {
                    var rangeSliders = document.querySelectorAll('.slider');
                    var counters = document.querySelectorAll('.counter');
            
                    var updateCounter = function(slider, counter) {
                        counter.textContent = slider.value;
                        slider.nextElementSibling.value = slider.value; // Actualiza el valor del input
                    };
            
                    rangeSliders.forEach(function(slider, index) {
                        updateCounter(slider, counters[index]);
            
                        slider.addEventListener('input', function() {
                            updateCounter(slider, counters[index]);
                        });
                    });
                });
            </script>
            

              
@endsection
@section('scripts')

@endsection