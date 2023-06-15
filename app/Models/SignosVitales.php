<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignosVitales extends Model
{
    use HasFactory;

    protected $table = 'signos_vitales';

    protected $fillable = [
        'user_id',
        'frecuencia_respiratoria',
        'frecuencia_cardiaca',
        'frecuencia_arterial',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
