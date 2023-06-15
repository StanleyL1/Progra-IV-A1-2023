<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SintomasPaciente;
use App\Http\Requests\StoreSymptomRequest;
class SintomasPacienteController extends Controller
{
    public function store(Request $request)
    {
        $sintomasPaciente = new SintomasPaciente;
    
        $sintomasPaciente->id_usuario = $request->user()->id; // Asegúrate de que el ID del usuario se guarda en la sesión cuando el usuario inicia sesión
        $sintomasPaciente->dificultad_respirar = $request->input('dificultad_respirar');
        $sintomasPaciente->tos = $request->input('tos');
        $sintomasPaciente->nivel_fatiga = $request->input('nivel_fatiga');
        $sintomasPaciente->actividad_inicio_sintomas = $request->input('actividad_inicio_sintomas');
        $sintomasPaciente->medicina_rescate_usada = $request->input('medicina_rescate_usada');
        $sintomasPaciente->nivel_dolor_cabeza = $request->input('nivel_dolor_cabeza');
        $sintomasPaciente->temperatura_mas_alta = $request->input('temperatura_mas_alta');
        $sintomasPaciente->informacion_adicional = $request->input('informacion_adicional');
    
        $sintomasPaciente->save();
    
        return view('homeNorris');
    }

    public function showSintomasHistorial()
    {
        $sintomas = SintomasPaciente::where('id_usuario', auth()->user()->id)->paginate(10);
        return view('historialSintomas', ['sintomas' => $sintomas]);
    }
  


        
    }
    
    
