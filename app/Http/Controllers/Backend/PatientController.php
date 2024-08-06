<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function login()
    {
        return view('patient.login');
    }
    function sendId(Request $request)
    {
        $doctorId = $request->doctorId;
        $specificDoctor = Doctor::find($doctorId);
        return view('patient.doctor-profile', compact('specificDoctor'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {
        $request->validate([
            'first_name' => 'string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string',
        ]);
        $check = $request->all();
        // dd(Auth::guard('patient')->user());

        if (Auth::guard('patient')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            return redirect()->route('dashboardPatient');
        } else {
            return redirect()->back()->with('error', 'Your Credintal is invalid');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function register()
    {
        return view('patient.register');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    protected function createPatient(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:patients,email',
            'password' => 'required|string',
        ]);
        $patient = Patient::create([
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'specialization' => $request->specialization,
        ]);
        return redirect()->route('patientLogin');
    }
    function newDashboard()
    {

        $id = Auth::guard('patient')->user()->id;
        $patient = Patient::find($id);
        $appointments = $patient->appointments()->with('doctor')->get();
        // $chk = Appointment::all();
        // dd($appointments);
        return view('patient.patientDashboard', compact('appointments'));

    }
    public function cancelAppointment(Request $request)
    {
        $id = $request->appointmentId;
        $appointment = Appointment::where('id', $id)
            ->where('patient_id', Auth::guard('patient')->user()->id)
            ->firstOrFail();

        $appointment->delete();
        $appointments = Appointment::all();
        return view('patient.patientDashboard', compact('appointments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard('patient')->logout();
        return redirect()->route('patientLogin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    function goToDoctors()
    {
        $doctors = Doctor::all();
        return view('patient.doctors', compact('doctors'));
    }
    function showAppointments()
    {
        $id = Auth::guard('patient')->user()->id;
        $patient = Patient::find($id);

        if ($patient) {
            $appointments = $patient->appointments()->with('doctor')->get();
            return view('patient.appointments', compact('appointments'));
        }
    }


}