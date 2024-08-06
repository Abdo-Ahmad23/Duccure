<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorProfileController extends Controller
{
    function update(Request $request){


        $request->validate([
            'first_name' => 'required|string|max:255',
            'second_name' => 'string|max:255',
                'pricing' => 'numeric',
                'bio' => 'string',
                'country' => 'string|max:255|required',
                'phone_number' => 'string|max:255',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:9048|required',
        ]);
        $doctor = $request->except('image');
        if ($request->hasFile('image')) {
            /// upload file -> change image name ->
            $image = $request->image;
            $oldimagename = $image->getClientOriginalName();
            $newimagename = uniqid() . $oldimagename;
            $image->move('images', $newimagename);

            $imgUrl = "images/$newimagename";
            $doctor['image'] = $imgUrl;
        }
        // dd($doctor['image']);

        // dd($doctor);
        $mynewdoctor = Doctor::find(Auth::guard('doctor')->user()->id);
        $mynewdoctor->update($doctor);
        $mynewdoctor->image=$doctor['image'];
        $mynewdoctor->save();
        // dd($mynewdoctor);

        return redirect()->route('doctor.profile.setting')->with('success', 'Doctor data updated successfully.');



    }
}