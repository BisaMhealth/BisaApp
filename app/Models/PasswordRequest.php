<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordRequest extends Model
{
    protected $table = 'password_requests';

    protected $primaryKey = 'uid';
}
