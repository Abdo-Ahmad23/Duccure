<?php

namespace App\Models;

// use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Doctor extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guard = 'doctor';
    protected $fillable = [
        'first_name',
        'second_name',
        'email',
        'username',
        'country',
        'phone_number',
        'bio',
        'pricing',
        'password',

    ];

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'appointments')->withPivot('appointment_date', 'status')->withTimestamps();
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

}