<?php

namespace App\Services;

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Database;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Exception\Auth\EmailExists as FirebaseEmailExists;
use Kreait\Firebase\Messaging\CloudMessage;
use Exception;
use Kreait\Firebase\Messaging\Notification;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
class FirebaseService
{
    public function __construct()
    {
          $serviceAccount = ServiceAccount::fromArray([
            "type" => "service_account",
            "project_id" => config('services.firebase.project_id'),
            "private_key_id" => config('services.firebase.private_key_id'),
            "private_key" => config('services.firebase.private_key'),
            "client_email" => config('services.firebase.client_email'),
            "client_id" => config('services.firebase.client_id'),
            "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
            "token_uri" => "https://oauth2.googleapis.com/token",
            "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
            "client_x509_cert_url" => config('services.firebase.client_x509_cert_url')
        ]);

        $this->firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri(config('services.firebase.database_url'))
            ->create();
    }




    public function processFCMNotification($token,$content,$doctor,$questionId){
    	$deviceToken= $token;
    	$title = $doctor;
    	$questionContent = $content;

      $imageUrl = "https://res.cloudinary.com/dzh1cgxjd/image/upload/v1587755250/questions_media/logo-gh_oxpbnx.png";
    	$messaging = $this->firebase->getMessaging();

      $message = CloudMessage::fromArray([
        'token' => $deviceToken,
        'notification' => [/* Notification data as array */
          'title'=>'Reply from '.$doctor,
          'questionId'=>$questionId,
          'body'=>$content,
          'icon'=>'https://res.cloudinary.com/dzh1cgxjd/image/upload/v1587755250/questions_media/logo-gh_oxpbnx.png'
          ], // optional
        'data' => [/* data array */
          'title'=>'Reply from '.$doctor,
          'questionId'=>$questionId,
          'body'=>$content
        ], // optional
    ]);

    	$response = $messaging->send($message);

        return $response;

    }


   public function processNotification($token,$questionId,$patientId,$questionAsked,$doctor,$results) {

         $deviceToken=$token;
         $title = $doctor;
         $questionContent = $questionAsked;

          $json_data = '{
             "to" : "'.$deviceToken.'",

             "data" : {
             "body" : "'.$results.'",
             "title" : "'.$doctor.'",
             "patient_id" : '.$patientId.',
             "question_id" : '.$questionId.',
             "click_action": "OPEN_DOC_CHAT",
             "question" : "'.$questionAsked.'"
             "content_available" : true,
             "priority" : "high",
             "sound": "default",
             }
            }';

            $data = $json_data;
            //FCM API end-point
            $url = 'https://fcm.googleapis.com/fcm/send';
            //api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
            $server_key = 'AAAAQR1WzTk:APA91bF_f9UpU-A44QMKxmeO4Tfpi_G_D399p8mOV1Cs72OOLJrgGMeYDZifrcqfRiW-TVFeG10in0lruXLh4kvIPjcwfGjnY_BY2_EavFGkkBzAV7noPtFnwSQ29hG0xZtWNlEssCXz';
            //header with content_type api key
            $headers = array(
                'Content-Type:application/json',
                'Authorization:key='.$server_key
            );
            //CURL request to route notification to FCM connection server (provided by Google)
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('Oops! FCM Send Error: ' . curl_error($ch));
            }


            curl_close($ch);
            return $result;

    }

    // $data = [
    //      'first_key' => 'First Value',
    //      'second_key' => 'Second Value',
    //   ];
    // $message = CloudMessage::withTarget('token', $deviceToken)
    // ->withNotification(['title' => $title, 'body' =>$questionContent,'image' => $imageUrl])->withData($data);





    /**
     * Verify password agains firebase
     * @param $email
     * @param $password
     * @return bool|string
     */
    public function verifyPassword($email, $password)
    {
        try {
            $response = $this->firebase->getAuth()->verifyPassword($email, $password);
            return $response->uid;

        } catch(FirebaseEmailExists $e) {
            logger()->info('Error login to firebase: Tried to create an already existent user');
        } catch(Exception $e) {
            logger()->error('Error login to firebase: ' . $e->getMessage());
        }
        return false;
    }
}

?>
