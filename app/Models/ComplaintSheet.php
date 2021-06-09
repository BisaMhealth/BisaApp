<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplaintSheet extends Model
{
    public $table = 'complaint_sheet';

    public $primaryKey = 'complaint_id';

    public $incrementing = true;
}
