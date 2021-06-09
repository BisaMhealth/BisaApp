<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionResponse extends Model
{
    protected $table = 'question_responses';

    protected $primaryKey = 'question_response_id';

    protected $appends = ['sender'];
    public function getSenderAttribute()
    {
        $name = '';

        $respondedtype = $this->responder_type;
        if ($respondedtype == 'doctor') {
            $getResponse = Doctor::where('doctor_id', $this->responder_id)->first();
            if (!empty($getResponse)) {
                $name = $getResponse->first_name . ' ' . $getResponse->last_name;
            }
        } elseif ($respondedtype == 'user') {

            $getResponse = Patient::where('user_id', $this->responder_id)->first();
            if (!empty($getResponse)) {
                $name = $getResponse->first_name . ' ' . $getResponse->last_name;

            }
        }

        return $this->attributes['sender'] = $name;

    }
}
