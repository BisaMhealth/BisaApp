<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Hospital;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserManagementController extends Controller
{
    use ResponseTrait;

    public function Admins()
    {
        $getAdmins = Admin::all();
        return $this->successResponse('', $getAdmins);
    }
    public function Hospitals()
    {
        $getAdmins = Hospital::all();
        return $this->successResponse('', $getAdmins);
    }
    public function RegisterAdmin(Request $request)
    {

        try {
            $rules = [
                'first_name' => 'required',
                'admin_email' => 'required|unique:admins,admin_email',
                'admin_username' => 'required|unique:admins,admin_username',
                'phone' => 'required',
                'admin_password' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return $this->validationResponse($errors);
            }

            $newRecord = new Admin();
            $newRecord->first_name = $request->first_name;
            $newRecord->last_name = $request->last_name;
            $newRecord->admin_email = $request->admin_email;
            $newRecord->admin_username = $request->admin_username;
            $newRecord->phone = $request->phone;
            $newRecord->role = $request->role;
            $newRecord->admin_type = 'admin';
            $newRecord->country = 'Ghana';
            $newRecord->gender = $request->gender;
            $newRecord->admin_password = Hash::make($request->admin_password);

            if ($newRecord->save()) {
                return $this->successResponse('Admin account created successfully');
            }
            return $this->errorResponse('Failed to process your request');
        } catch (Exception $e) {

            return $this->errorResponse($e);
        }
    }
    public function RegisterHospital(Request $request)
    {

       // try {
            $rules = [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',

            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return $this->validationResponse($errors);
            }

            $newRecord = new Hospital();
            $newRecord->hospital_name = $request->name;
            $newRecord->address = $request->address;
            $newRecord->phone = $request->phone;
            $newRecord->email = $request->email;
            $newRecord->category = $request->category;
            $newRecord->speciality = $request->speciality;
            $newRecord->other_details = $request->other_details;
            $newRecord->country = 'GH';
            $newRecord->enabled = $request->enabled ?: 1;

            if ($newRecord->save()) {
                return $this->successResponse('Hospital account created successfully');
            }
            return $this->errorResponse('Failed to process your request');
      //  } catch (Exception $e) {

       //     return $this->errorResponse($e);
      //  }
    }
}
