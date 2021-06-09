<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctors';

    protected $primaryKey = 'doctor_id';
    protected $appends = ['hospital','status_name'];
    public function getHospitalAttribute()
    {
        $id = $this->hospital_id;
        $name = '';
        $getRecord = Hospital::where('hospital_id', $id)->first();
        if ($getRecord) {
            $name = $getRecord->hospital_name;
        }
        return $this->attributes['hospital'] = $name;

    }

    public function getStatusNameAttribute()
    {
        $statusName = '';
        $getStatus = $this->active;
        if ($getStatus == 0) {
            $statusName = 'Inactive';
        } elseif ($getStatus == 1) {
            $statusName = 'Active';
        }
        return $this->attributes['status_name'] =  $statusName;
    }
}
