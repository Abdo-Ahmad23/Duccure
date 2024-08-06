<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Patient extends Authenticatable
{
   use HasApiTokens, HasFactory, Notifiable;
   protected $guard = 'patient';
protected $fillable = [
    'first_name',
    'second_name',
    'date_of_birth',
    'blood_group',
    'mobile',
    'address',
    'city',
    'state',
    'zip_code',
    'country',
    'email',
    'image',
    'password',
    ];
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'appointments')->withPivot('appointment_date', 'status')->withTimestamps();
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}