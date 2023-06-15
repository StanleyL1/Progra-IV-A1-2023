<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserAsociates extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user_asociates';
    
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'address',    // new field
        'city',       // new field
        'zip_code',   // new field
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function patients()
    {
        return $this->belongsToMany(User::class, 'doctor_patient', 'doctor_id', 'patient_id');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
