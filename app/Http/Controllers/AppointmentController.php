<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class AppointmentController extends Controller
{
    public function makeAppointment(Request $request)
    {
        $request->validate([
            // 'doctor_id' => 'required|exists:doctors,id',
            // 'patient_id' => 'required|exists:patients,id',
        ]);

        Appointment::create([
            'doctor_id' => $request->doctorId,
            'patient_id' => Auth::guard('patient')->user()->id,
            'status' => 'pending',
        ]);
        // dd(Appointment::all()->)

         return redirect()->back()->with('status', 'Appointment request sent!');
    }
}