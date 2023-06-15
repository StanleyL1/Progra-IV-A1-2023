<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DoctorPatient;

class UserController extends Controller
{

    public function getPatients($doctorId)
    {
        $patients = DoctorPatient::where('doctor_id', $doctorId)->with('patient')->get();
        return response()->json($patients);
    }
    public function getDoctors($patientId)
    {
        $doctors = DoctorPatient::where('patient_id', $patientId)->with('doctor')->get();
        return response()->json($doctors);
    }
}
