<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    public $table = 'devices';

    public $primaryKey = 'rec_id';

    public $incrementing = true;
}
