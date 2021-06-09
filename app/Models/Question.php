<?php

namespace App\Models;
use Crypt;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $primaryKey = 'question_id';

    protected $appends = ['hsender','sender', 'category'];
    public function getSenderAttribute()
    {
        $patient_id = $this->patient_id;
        $name = '';
        $getPatient = Patient::where('user_id', $patient_id)->first();
        if ($getPatient) {
            $name = $getPatient->first_name . ' ' . $getPatient->last_name;
        }
        return $this->attributes['sender'] = $name;

    }
    public function getHsenderAttribute()
    {
        $patient_id = $this->patient_id;
        $name = '';
        $getPatient = Patient::where('user_id', $patient_id)->first();
        if ($getPatient) {
            $name = $getPatient->first_name . ' ' . $getPatient->last_name;
        }
        $hashed = Crypt::encrypt($name);
        $hhashed =  substr($hashed, 0, 10);
        return $this->attributes['hsender'] = $hhashed;

    }
    public function getCategoryAttribute()
    {
        $id = $this->question_cat_id;
        $name = '';
        $category = QuestionCategory::where('category_id', $id )->first();
        if ($category) {
            $name = $category->category_name ;
        }
        return $this->attributes['sender'] = $name;

    }

}
