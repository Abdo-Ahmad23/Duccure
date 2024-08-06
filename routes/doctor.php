<?php
use App\Http\Controllers\Backend\DoctorController;
use App\Http\Controllers\DoctorProfileController;
use Illuminate\Support\Facades\Route;


Route::get('doctor-login',[DoctorController::class,'login'])->name('doctor.login');
Route::post('doctor-check',[DoctorController::class,'check'])->name('doctor.check');
// register for doctor
Route::get('doctor-register',[DoctorController::class,'register'])->name('doctor.register');
Route::post('doctor-create',[DoctorController::class,'createDoctor'])->name('doctor.create');
Route::prefix('doctor')->middleware('doctor')->group(function(){
    Route::get('dashboard-doctor',[DoctorController::class,'newDashboard'])->name('doctor.dashboard');

    Route::get('doctor-appointments',[DoctorController::class,'doctorAppointments'])->name('doctor.appointments');


    Route::get('doctor-profile-setting',function(){
        return view('doctor.doctorProfileSettings');
    })->name('doctor.profile.setting');

    Route::post('logout', [DoctorController::class, 'logout'])->name('doctor.logout');


    Route::put('form-update', [DoctorProfileController::class, 'update'])->name('doctor.update.form');

    Route::post('accept-form',[DoctorController::class,'acceptForm'])->name('accept.form');
    Route::post('cancel-form',[DoctorController::class,'cancelForm'])->name('cancel.form');


});