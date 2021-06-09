<?php
namespace App\Helpers;

use Twilio\Rest\Client;

class CustomSMS
{
    /**
     * Send SMS
     */
    public function sendSMS(string $clientPhoneNumber, string $message)
    {
        $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        $phoneNumber = config('app.twilio')['TWILIO_PHONE_NUMBER'];

        $client = new Client($accountSid, $authToken);

        try {
            $result = $client->messages->create(
                // the number you'd like to send the message to
                "$clientPhoneNumber",
                array(
                    // A Twilio phone number you purchased at twilio.com/console
                    'from' => "BISA",
                    // the body of the text message you'd like to send
                    'body' => $message
                )
            );

            if ($result) {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
