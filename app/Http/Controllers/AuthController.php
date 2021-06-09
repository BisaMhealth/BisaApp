<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\AppMail;
use App\Helpers\CustomMailer;
use App\Helpers\HelperFunctions;

use App\Models\Admin;
use App\Models\User;
use App\Models\Doctor;
use App\Models\UserHealthInfo;
use App\Models\PasswordRequest;

class AuthController extends Controller
{
    /**
     * Render the login page
     */
    public function renderLoginPage()
    {
        return view('welcome');
    }

    /**
     * Render admin login page
     */
    public function renderAdminLoginPage()
    {
        return view('admin_views.login');
    }

    /**
     * Render user signup page
     */
    public function renderSignupPage()
    {
        return view('user_views.signup');
	}


	/**
	 * Render anonymous signup page
	 */
	public function renderAnonymousSignupPage()
	{
		return view('user_views.anonymous-signup');
	}

    /**
     * Render admin signup page
     */
    public function renderAdminSignupPage()
    {
        return view('admin_views.signup');
    }

    /**
     * Render forgot password page
     */
    public function renderForgotPasswordPage()
    {
        return view('forgot_password');
    }


    /**
	 * Requests new user password
	 */
    public function renderForgotPasswordResetPage(Request $request)
    {
        return view('reset_password', ['code' => $request->code]);
    }


    /**
     * Create admin account
     *
     * @param Illuminate\Http\Request
     */

    public function createAdminAccount(Request $request)
    {
    	if (Doctor::where('email', $request->adminEmail)->exists() || Doctor::where('username', $request->adminEmail)->exists() || Admin::where('admin_email', $request->adminEmail)->exists()) {
    		$response_message =  array('success' => false, 'message' => 'Email address already exists' );
    		return response()->json($response_message);
    	} else {
			if (User::where('username', $request->adminUsername)->exists() || Doctor::where('username', $request->adminUsername)->exists() || Admin::where('admin_username', $request->adminUsername)->exists()) {
				$response_message =  array('success' => false, 'message' => 'Username already exists' );
				return response()->json($response_message);
			} else {
				$hashedPassword = password_hash($request->adminPassword, PASSWORD_DEFAULT);
				$admin = new Admin();

				$admin->admin_username = $request->adminUsername;
				$admin->admin_password = $hashedPassword;
				$admin->admin_email = $request->adminEmail;

				if ($admin->save()) {
					$response_message =  array('success' => true, 'message' => 'Signup successful' );
					return response()->json($response_message);
				} else {
					$response_message =  array('success' => false, 'message' => 'Unable to signup' );
					return response()->json($response_message);
				}
			}
    	}
    }


    /**
     * Create anonymous user account
     *
     * @param Illuminate\Http\Request
     */
    public function createAnonymousUserAccount(Request $request)
    {
        if (User::where('username', $request->username)->exists() || Doctor::where('username', $request->username)->exists() || Admin::where('admin_username', $request->username)->exists()) {
            $response_message =  array('success' => false, 'message' => "Username already taken");
            return response()->json($response_message);
        } else {
            $hashedPassword = password_hash($request->userPassword, PASSWORD_DEFAULT);
            $user = new User();
            $userToken = substr(md5(time()),0, 20);

            $user->username = $request->username;
            $user->password = $hashedPassword;
            $user->active = 1;
            $user->token = $userToken;

            if ($user->save()) {
                session_start();
                $_SESSION['user_id'] = $user->user_id;
                $_SESSION['user_logged_in'] = true;
                $_SESSION['username'] = 'anonymous';

                $response_message =  array('success' => true, 'message' => 'Signup successful', 'userType' => 'anonymous', 'userToken'=> $userToken );
                return response()->json($response_message);
            } else {
                $response_message =  array('success' => false, 'message' => 'Unable to signup' );
                return response()->json($response_message);
            }
        }
    }


    /**
     * Create user account
     */
    public function createUserAccount(Request $request)
    {
        if (User::where('username', $request->username)->exists() || Doctor::where('username', $request->username)->exists() || Admin::where('admin_username', $request->username)->exists()) {
            $response_message =  array('success' => false, 'message' => "Username already taken");
            return response()->json($response_message);
        } else {
            if (User::where('email', $request->userEmail)->exists() || Doctor::where('email', $request->userEmail)->exists() || Admin::where('admin_email', $request->userEmail)->exists()) {
                $response_message =  array('success' => false, 'message' => "Email address already taken");
                return response()->json($response_message);
            } else {
                $hashedPassword = password_hash($request->userPassword, PASSWORD_DEFAULT);
                $user = new User();
                $userToken = substr(md5(time()),0, 20);

                $user->first_name = $request->userFirstName;
                $user->last_name = $request->userLastName;
                $user->username = $request->username;
                $user->email = $request->userEmail;
                $user->phone = $request->userPhone;
                $user->password = $hashedPassword;
                $user->gender = $request->userGender;
                $user->date_of_birth = $request->userDateofBirth;
                $user->country = $request->userCountry;
                $user->type = 'known';
                $user->active = 1;
                $user->token = $userToken;

                if ($user->save()) {
                    $userHealthInfo = new UserHealthInfo();
                    $userHealthInfo->uid = $user->user_id;
                    $userHealthInfo->height = "n/a";
                    $userHealthInfo->weight = "n/a";
                    $userHealthInfo->health_conditions = "n/a";
                    $userHealthInfo->allergies = "n/a";
                    $userHealthInfo->current_medication = "n/a";
                    $userHealthInfo->other_notes = "n/a";
                    $userHealthInfo->save();

                    session_start();
                    $_SESSION['user_id'] = $user->user_id;
                    $_SESSION['user_logged_in'] = true;
                    $_SESSION['username'] = $request->username;

                    $mailSubject = "Account Signup";
                    $mailData = array('username' => $request->userFirstName, 'text' => 'Welcome to Bisa Fr');
                    \Mail::to($request->userEmail)->send(new AppMail($mailData, "Welcome To Bisa Fr"));

                    $response_message =  array('success' => true, 'message' => 'Signup successful', 'userType' => 'anonymous', 'userToken'=> $userToken );
                    return response()->json($response_message);
                } else {
                    $response_message =  array('success' => false, 'message' => 'Unable to signup' );
                    return response()->json($response_message);
                }
            }
        }
    }


    /**
     * Perform admin login
     *
     * @param Illuminate\Http\Request
     */
    public function loginUserAccount(Request $request)
    {
		$userEmail = $request->userEmail;
		$userPassword = $request->userPassword;

    	$adminEmailRequest = Admin::where('admin_email', $userEmail)->get();

    	if (count($adminEmailRequest) > 0 ) {
    		$hashedPassword = $adminEmailRequest[0]['admin_password'];
    		if (password_verify($userPassword, $hashedPassword)) {
    			session_start();
    			$_SESSION['admin_id'] = $adminEmailRequest[0]['admin_id'];
    			$_SESSION['admin_email'] = $adminEmailRequest[0]['admin_email'];
    			$_SESSION['admin_username'] = $adminEmailRequest[0]['admin_username'];
    			$_SESSION['admin_type'] = $adminEmailRequest[0]['admin_type'];

				$userType = $adminEmailRequest[0]['admin_type'];
    			$response_message =  array('success' => true, 'message' => 'Login successful', 'userType' => $userType);
    			return response()->json($response_message);
    		} else {
    			$response_message =  array('success' => false, 'message' => "Wrong email or password");
    			return response()->json($response_message);
    		}

    	} else {
            
            $usernameRequest = User::where('username', $request->userEmail)->orWhere('email', $request->userEmail)->first();
            
            if ($usernameRequest) {
        		$hashedPassword = $usernameRequest['password'];
        		if (password_verify($userPassword, $hashedPassword)) {
        			session_start();
        			$_SESSION['user_id'] = $usernameRequest['user_id'];
                    $_SESSION['user_logged_in'] = true;

        			$userType = $usernameRequest['type'];
                    if ($userType != 'anonymous') {
                        $_SESSION['username'] = $usernameRequest['username'];
                    } else  {
                        $_SESSION['username'] = 'anonymous';
                    }

        			$response_message =  array('success' => true, 'message' => 'Signup successful', 'userType' => $userType);
        			return response()->json($response_message);
        		} else {
        			$response_message =  array('success' => false, 'message' => "Wrong username or password");
        			return response()->json($response_message);
        		}
        	} else {
                
                $doctorRequest = Doctor::where('email', $request->userEmail)->orWhere('username', $request->userEmail)->first();
                
                if ($doctorRequest) {
            		$hashedPassword = $doctorRequest['password'];
            		if (password_verify($userPassword, $hashedPassword)) {
            			session_start();
            			$_SESSION['doctor_id'] = $doctorRequest['doctor_id'];
                        $_SESSION['doctor_username'] = $doctorRequest['username'];
                        $_SESSION['thumbnail'] = $doctorRequest['thumbnail'];

                        $userType = 'doctor';

            			$response_message =  array('success' => true, 'message' => 'Signup successful', 'userType' => $userType);
            			return response()->json($response_message);
            		} else {
            			$response_message =  array('success' => false, 'message' => "Wrong username or password");
            			return response()->json($response_message);
            		}
            	} else {
            		$response_message =  array('success' => false, 'message' => "Wrong username or password" );
            		return response()->json($response_message);
            	}
        	}
    	}
	}


    /**
	 * Requests new user password
	 */
    public function requestNewUserPassword(Request $request)
    {
        if (User::where('email', $request->userEmail)->exists()) {
            $user = User::where('email', $request->userEmail)->first();
            $userId = $user['user_id'];
            $username = $user['first_name'];
        } else {
            if (Admin::where('admin_email',$request->userEmail)->exists()) {
                $user = Admin::where('admin_email', $request->userEmail)->first();
                $userId = $user['admin_id'];
                $username = $user['admin_username'];
            } else {
                if (Doctor::where('email',$request->userEmail)->exists()) {
                    $user = Doctor::where('email', $request->userEmail)->first();
                    $userId = $user['doctor_id'];
                    $username = $user['first_name'];
                } else {
                    $response_message =  array('success' => false, 'message' => "The email address does not exist");
                    return response()->json($response_message);
                }
            }
        }

        $code = substr(md5(time() + rand()), 0, 30);
        $helperFunction = new HelperFunctions();
        $serverName = $helperFunction->getBaseUrl();
        $requestLink = $serverName."/reset-password?code=$code";
        $mailText = "<a href='$requestLink'>$requestLink</a>";

        $mailer = new CustomMailer();
        $mailer->sendPasswordResetEmail($request->userEmail, $username, $requestLink);
        $passwordRequest = new PasswordRequest();
        $passwordRequest->uid = $userId;
        $passwordRequest->email = $request->userEmail;
        $passwordRequest->code = $code;
        $passwordRequest->save();

        $response_message =  array('success' => true, 'message' => "A password reset link has been sent to $request->userEmail");
        return response()->json($response_message);
    }


    /**
	 * Reset password
	 */
    public function resetPassword(Request $request)
    {
        $resetCode = $request->resetCode;
        $resetPassword = $request->resetPassword;
        $resetPasswordConf = $request->resetPasswordConf;

        if (PasswordRequest::where('code', $resetCode)->exists()) {
            $passwordRequest = PasswordRequest::where('code', $resetCode)->latest()->first();
            $email = $passwordRequest->email;

            if (User::where('email', $email)->exists()) {
                $user = User::where('email', $email)->first();
                $userId = $user['user_id'];

                $hashedPassword = password_hash($resetPassword, PASSWORD_DEFAULT);
                $newUser = User::find($userId);
                $newUser->password = $hashedPassword;
                $newUser->save();

                $passwordRequest->delete();

                $response_message =  array('success' => true, 'message' => "Password changed successfully");
                return response()->json($response_message);
            } else {
                if (Admin::where('admin_email',$email)->exists()) {
                    $admin = Admin::where('admin_email', $email)->first();
                    $adminId = $admin['admin_id'];

                    $hashedPassword = password_hash($resetPassword, PASSWORD_DEFAULT);
                    $newAdmin = Admin::find($adminId);
                    $newAdmin->admin_password = $hashedPassword;
                    $newAdmin->save();

                    $passwordRequest->delete();

                    $response_message =  array('success' => true, 'message' => "Password changed successfully");
                    return response()->json($response_message);
                } else {
                    if (Doctor::where('email',$email)->exists()) {
                        $doctor = Doctor::where('email', $email)->first();
                        $doctorId = $doctor['doctor_id'];

                        $hashedPassword = password_hash($resetPassword, PASSWORD_DEFAULT);
                        $newDoctor = Doctor::find($adminId);
                        $newDoctor->password = $hashedPassword;
                        $newDoctor->save();

                        $passwordRequest->delete();

                        $response_message =  array('success' => true, 'message' => "Password changed successfully");
                        return response()->json($response_message);
                    } else {
                        $response_message =  array('success' => false, 'message' => "Invalid or expired token");
                        return response()->json($response_message);
                    }
                }
            }
        } else {
            $response_message =  array('success' => false, 'message' => 'Invalid reset token' );
            return response()->json($response_message);
        }
    }


	/**
	 * Logout admin
	 */
	public function logoutAdminAccount()
	{
		session_start();
    	unset($_SESSION['admin_id']);
        unset($_SESSION['admin_email']);
    	return redirect('/');
	}

    /**
	 * Logout user
	 */
    public function logoutUser()
    {
        session_start();
    	unset($_SESSION['user_id']);
    	return redirect('/');
    }

    /**
	 * Logout doctor
	 */
    public function logoutDoctor()
    {
        session_start();
    	unset($_SESSION['doctor_id']);
    	return redirect('/');
    }
}
