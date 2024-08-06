<?php
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Backend\PatientController;
use App\Http\Controllers\PatientChangePasswordController;
use App\Http\Controllers\ProfileSetting;
use Illuminate\Support\Facades\Route;


Route::get('patient-register',[PatientController::class,'register'])->name('patientRegister');
Route::post('patient-create',[PatientController::class,'createPatient'])->name('create_patient');

Route::get('patient-login',[PatientController::class,'login'])->name('patientLogin');
Route::post('patient-check',[PatientController::class,'check'])->name('check_patient');
Route::prefix('patient')->middleware('patient')->group(function(){
    Route::get('dashboard-patient',[PatientController::class,'newDashboard'])->name('dashboardPatient');
    Route::post('logout', [PatientController::class, 'logout'])->name('patientLogout');

    Route::get('patient-change-password',function (){
        return view('patient.changePassword');
    })->name('patientChangePassword');

    Route::get('patient-doctors',[PatientController::class,'goToDoctors'])->name('patientDoctors');

    // Route::get('patient-dashboard',function (){
    //     return view('patient.patientDashboard');
    // })->name('patientDashboard');

    Route::get('patient-profile',function (){
        return view('patient.patientProfileSettings');
    })->name('patientProfileSettings');

    Route::put('form-update', [ProfileSetting::class, 'update'])->name('form.update');

    Route::get('/patient/change-password', [PatientChangePasswordController::class, 'showChangePasswordForm'])->name('patient.change-password.form');

    Route::put('/patient/change-password', [PatientChangePasswordController::class, 'changePassword'])->name('patient.change-password');

    Route::get('side-bar',function(){
        return view('patient.layouts.sidebar');
    })->name('patient.sidebar');
    Route::post('send-doctor-id',[PatientController::class,'sendId'])->name('send.doctor.id');

    Route::post('make-appointment',[AppointmentController::class,'makeAppointment'])->name('make.appointment');
    Route::post('cancel-appointment',[PatientController::class,'cancelAppointment'])->name('cancel.appointment');


});