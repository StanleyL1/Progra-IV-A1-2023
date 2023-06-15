<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\UserAsociates;
use App\Models\DoctorPatient;
class RegisterController extends Controller
{

    public function show(){
        return view('auth.register');   
    }

    
    public function register(RegisterRequest $request){
        $user = User::create($request->validated());
    
        // Asignar el paciente a un médico
        $doctor = UserAsociates::withCount('patients')
            ->having('patients_count', '<', 10)
            ->orderBy('patients_count', 'asc')
            ->first();
    
        if ($doctor) {
            DB::table('doctor_patient')->insert([
                'doctor_id' => $doctor->id,
                'doctorName' => $doctor->name, // Asegúrate de que 'name' es el nombre correcto del campo
                'patient_id' => $user->id,
                'patientName' => $user->name // Asegúrate de que 'name' es el nombre correcto del campo
            ]);
        }
    
        return redirect('/login')->with('success',"Cuenta creada correctamente");
    }
    
    
}

