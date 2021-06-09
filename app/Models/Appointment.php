<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'patient_appointment';

    protected $primaryKey = 'appointment_id';
}
