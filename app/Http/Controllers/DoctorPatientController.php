<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\DoctorPatient;
use Exception;

class DoctorPatientController extends Controller
{
    public function assignDoctorToPatient($patientId) {
        // Find the doctor with the least patients
        $doctorId = DoctorPatient::groupBy('doctor_id')
            ->select('doctor_id', DB::raw('count(*) as total'))
            ->orderBy('total', 'asc')
            ->first()
            ->doctor_id;
    
        // Assign this doctor to the patient
        DB::table('doctor_patient')->insert([
            'doctor_id' => $doctorId,
            'patient_id' => $patientId
        ]);
    
        return $doctorId;
    }

    public function getAssignedDoctor($patientId) {
        $doctorPatient = DoctorPatient::where('patient_id', $patientId)->first();
        if ($doctorPatient) {
            return response()->json([
                'doctorId' => $doctorPatient->doctor_id,
                'doctorName' => $doctorPatient->doctor_name, // Asegúrate de que 'doctor_name' es el nombre correcto del campo
                'patientName' => $doctorPatient->patient_name // Asegúrate de que 'patient_name' es el nombre correcto del campo
            ]);
        } else {
            // Maneja el caso en que el paciente no tiene un médico asignado
        }
    }
}
