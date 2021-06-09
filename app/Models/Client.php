<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public $table = 'clients';

    public $primaryKey = 'client_id';

    public $incrementing = true;
}
