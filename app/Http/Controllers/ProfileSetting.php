<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Correctly import the Auth facade
use Carbon\Carbon;

class ProfileSetting extends Controller
{


    function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'second_name' => 'string|max:255',
            //     'date_of_birth' => 'date',
                'blood_group' => 'string',
                'mobile' => 'string',
                'address' => 'string|max:255',
                'city' => 'string|max:255',
                'state' => 'string|max:255',
                'zip_code' => 'numeric',
                'country' => 'string|max:255',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:9048|required',
        ]);


        $patient = $request->except('image');
        if ($request->hasFile('image')) {
            /// upload file -> change image name ->
            $image = $request->image;
            $oldimagename = $image->getClientOriginalName();
            $newimagename = uniqid() . $oldimagename;
            $image->move('images', $newimagename);

            $imgUrl = "images/$newimagename";
            $patient['image'] = $imgUrl;
        }
        try {
            $dateOfBirth = Carbon::createFromFormat('d/m/Y', $request->date_of_birth);
        } catch (\Exception $e) {
            return back()->withErrors(['date_of_birth' => 'Invalid date format.']);
        }
        $patient['date_of_birth'] = $dateOfBirth;
        // dd($patient);
        $mynewpatient = Patient::find(Auth::guard('patient')->user()->id);
        $mynewpatient->update($patient);
        // $mynewpatient->save();
        // dd($mynewpatient);
        // go to model / update / route index
        $dateOfBirth = $request->date_of_birth; // Replace with the actual date of birth
        // $age = $this->calculateAge($dateOfBirth);
        // session()->flash('age', $age);
        return redirect()->route('patientProfileSettings');
        // return redirect()->route('patientDashboard');


    }



}