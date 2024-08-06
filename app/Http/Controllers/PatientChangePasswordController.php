<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;

class PatientChangePasswordController extends Controller
{
    function showChangePasswordForm(){
        return view('patient.changePassword');

    }


    function changePassword(Request $request){
        $request->validate([
            // 'current_password' => 'required',
            // 'new_password' => 'required|string|confirmed',
            // 'new_check_password' => 'required|string|confirmed',

        ]);
        // dd($request->new_password,$request->new_check_password);
        $patient = Auth::guard('patient')->user();

        if (!Hash::check($request->current_password, $patient->password)) {
            return back()->withErrors(['current_password' => 'The current password does not match our records.']);
        }

        if ($request->new_password!=$request->new_check_password) {
            return back()->withErrors(['new_password' => 'The current password does not match you new check password.']);
        }

        // dd($patient->id);

        $patient->password = Hash::make($request->new_password);
        // $patient->password = Hash::make($request->new_password);
        $patient->save();
        // dd($patient->password,Hash::make($request->new_password));

        return redirect()->route('patient.change-password.form')->with('status', 'Password changed successfully!');

    }
}
