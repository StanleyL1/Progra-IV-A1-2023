<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SintomasPaciente extends Model
{
    use HasFactory;

    protected $table = 'sintomas_paciente';

    protected $fillable = [
        'id_usuario',
        'dificultad_respirar',
        'tos',
        'nivel_fatiga',
        'actividad_inicio_sintomas',
        'medicina_rescate_usada',
        'nivel_dolor_cabeza',
        'temperatura_mas_alta',
        'informacion_adicional',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}