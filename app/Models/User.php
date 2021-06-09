<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Core\GlobalService;


class User extends Model
{
    protected $table = 'sys_users';

    protected $primaryKey = 'user_id';

    use GlobalService;
    /**
     * Get the health info record associated with the user.
     */
    public function healthRecords()
    {
        return $this->hasOne('App\Models\UserHealthInfo', 'user_id', 'uid');
    }

    public function createUser($userName,$email,$password,$role,$userId,$token,$userStatus= null,$verificationCode, $source){
        $user = new User();
        $now = $this->longDate();
        $recordId =  $userId;
        $user->username  = $userName;
        $user->email  = $email;
        $user->password =$password;
        $user->active = 1;
        $user->role = $role;
        $user->user_code = $userId ;
        $user->type = $role ;
        $user->remember_token =  $verificationCode;
        $user->token = $token;
        $created_at =  $now;
        $user->source = $source;

        if($user->save()){
            return "01";
        }else{
            return  "05";
        }

    }







}
