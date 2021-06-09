<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';

    protected $primaryKey = 'admin_id';

    protected $hidden = [
        'admin_password',
    ];
    protected $appends = ['role_name'];
   
    public function getRoleNameAttribute()
    {
        $statusName = '';
        $getStatus = $this->role;
        if ($getStatus == 0) {
            $statusName = 'Administrator';
        } elseif ($getStatus == 1) {
            $statusName = 'Marketer';
        }
     
        elseif($getStatus == 2) {
            $statusName = 'Publisher';
        }
        return $this->attributes['role_name'] = $statusName;
    }
}
