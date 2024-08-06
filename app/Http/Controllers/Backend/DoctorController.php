<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class DoctorController extends Controller
{
    function login()
    {
        return view('doctor.login');
    }
    function check(Request $request)
    {

        $request->validate([
            'first_name' => 'string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:4',
        ]);
        $check = $request->all();
        if (Auth::guard('doctor')->attempt(['email' => $check['email'], 'password' => $check['password']])) {
            return redirect()->route('doctor.dashboard');
        } else {
            return redirect()->back()->with('error', 'Your Credintal is invalid');
        }
    }
    function register()
    {
        return view('doctor.register');
    }
    protected function createDoctor(Request $request)
    {
        $request->validate([
            'first_name' => 'min:4|required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:4',
        ]);

        Doctor::create([
            'first_name' => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('doctor.login');

    }
    function newDashboard()
    {
        $doctor = Doctor::find(Auth::guard('doctor')->user()->id);
        // dd()

        $appointments = $doctor->appointments()->with('patient')->get();
        // $doctor = Doctor::find(1);
        $patientCount = $doctor->patients()->count();
        // dd($patientCount);
        $appointmentCount = $doctor->appointments()->count();
        return view('doctor.doctorDashboard', compact('appointments','patientCount','appointmentCount'));

        // return view('doctor.doctorDashboard');
    }
    function doctorAppointments(){

        $doctor = Doctor::find(Auth::guard('doctor')->user()->id);
        // dd()

        $appointments = $doctor->appointments()->with('patient')->get();
        return view('doctor.appointments', compact('appointments'));
        // return view('doctor.appointments');
    }
    function acceptForm(Request $request){
        $id=$request->appointmentId;
        $appointment = Appointment::where('id', $id)
        ->where('doctor_id', Auth::guard('doctor')->user()->id)
        ->firstOrFail();

    $appointment->status = 'accepted';
    // dd($appointment->status);
    $appointment->save();
    $doctor = Doctor::find(Auth::guard('doctor')->user()->id);
        // dd()

    $appointments = $doctor->appointments()->with('patient')->get();
    // dd($appointment->status);
    // return view('doctor.doctorDashboard');
    return redirect()->route('doctor.dashboard',compact('appointments'))->with('status', 'Appointment accepted!');

    }
    function cancelForm(Request $request){
        $id=$request->appointmentId;
        $appointment = Appointment::where('id', $id)
        ->where('doctor_id', Auth::guard('doctor')->user()->id)
        ->firstOrFail();

    $appointment->status = 'rejected';
    $appointment->save();
    $doctor = Doctor::find(Auth::guard('doctor')->user()->id);
        // dd()

    $appointments = $doctor->appointments()->with('patient')->get();
    // dd($appointment->status);
    // return view('doctor.doctorDashboard');
    return redirect()->route('doctor.dashboard',compact('appointments'))->with('status', 'Appointment cancelled!');

    }
    public function logout()
    {
        Auth::guard('doctor')->logout();
        return redirect()->route('doctor.login');
    }
}