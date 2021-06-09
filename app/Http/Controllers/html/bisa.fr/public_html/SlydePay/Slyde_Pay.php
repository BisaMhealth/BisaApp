<?php
Class SlydePay{


	public function createInvoice(){

		//$conn = new mysqli('localhost', 'root', '#4kLxMzGurQ7Z~', 'ustream');


        $ref = "MCC";
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';


		$create_invoice_request = array(
          'emailOrMobileNumber' => 'support@mobilecontent.com.gh',
		  'merchantKey'=> '1545123721622',
		  'amount'=> 0.01,
		  'orderCode'=> $ref.substr(str_shuffle($permitted_chars), 0, 7), //'http://louis.requestcatcher.com/',
		  'orderItems'=> array( 
		  	                   $arrayName = array("itemCode"=> "qwerty", "itemName" => "RFC", "unitPrice" => 20, "quantity" => 2, "subTotal" => 40), 
		  	                   $arrayName = array("itemCode" => "qwerty", "itemName" => "RFC", "unitPrice" => 20, "quantity" => 2, "subTotal" => 40) 
		  	                ),
		);

        
        
		//API Keys
        
		//$clientId = 'nQjNGkw';
		//$clientSecret = '553548c3-c96d-4cb5-a81c-7e354dff845c';
		//$basic_auth_key =  'Basic ' . base64_encode($clientId . ':' . $clientSecret);
		$request_url = 'https://app.slydepay.com.gh/api/merchant/invoice/create';
		$create_invoice_request = json_encode($create_invoice_request);

		$ch =  curl_init($request_url);  
				curl_setopt( $ch, CURLOPT_POST, true );  
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $create_invoice_request);  
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );  
				curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
				    //'Authorization: '.$basic_auth_key,
				    'Cache-Control: no-cache',
				    'Content-Type: application/json',
				  ));

		$result = curl_exec($ch); 
	    $json = json_decode($result, true);

	    $success = json_encode($json['success']);
		if($success == "true"){

			//echo "true";
			//echo $json["result"]["payToken"];

			$orderCode = $json["result"]["orderCode"];
            $paymentCode = $json["result"]["paymentCode"];
            $payToken = $json["result"]["payToken"];
            $description = $json["result"]["description"];
            $qrCodeUrl = $json["result"]["qrCodeUrl"];
            $full_discount_amount = $json["result"]["fullDiscountAmount"];
            $error_message = $json["errorMessage"];
            $error_code = $json["errorCode"];
       
            /*
			$query_track_card_pay = "INSERT INTO track_card_pay(`track_visa_pay_id`, `order_code`, `payment_code`, `pay_token`, `description`, `qrCodeUrl`, `full_discount_amount`, `error_message`, `error_code`) VALUES(null, '".$orderCode."', '".$paymentCode."', 
				'".$payToken."','".$description."', '".$qrCodeUrl."', '".$full_discount_amount."',
				'".$error_message."', '".$error_code."')";
            mysqli_query($conn, $query_track_card_pay);
            */

            //header("Location: https://app.slydepay.com/paylive/detailsnew.aspx?pay_token=".$payToken);

            //"https://app.slydepay.com/paylive/detailsnew.aspx?pay_token=".$payToken;
            echo $payToken;

		}elseif($success == "false"){

			echo "false";
		}
		$err = curl_error($ch);
		curl_close($ch);
		
	}
}


$obj = new SlydePay;
$obj->createInvoice();
?>