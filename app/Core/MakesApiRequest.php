<?php
  namespace App\Core;

  use GuzzleHttp\Client;
  use App;
  	trait MakesApiRequest
	{



    public function setBaseUrl(){
      if (App::isLocale('en')) {
         $apiBaseUrl = "https://ghapi.bisa.com.gh/api";
         //$apiBaseUrl = "http://localhost:8090/api";
      }elseif(App::isLocale('fr')){
		 $apiBaseUrl = "https://frapi.bisa.fr/api";

      }else{
         $apiBaseUrl = "https://ghapi.bisa.com.gh/api";
      }
      return $apiBaseUrl;
    }

    protected $token = '5c20d216f981585fe92e';
     //$apiBaseUrl = $this->setBaseUrl();

		public function useRoles($data){
			$baseUrl = $this->setBaseUrl();
			$url =  $baseUrl.'/user/roles/'.$data.'/?token='.$this->token;

			 $client = new Client();
			 $response = $client->request('GET', $url);
			 $responseData = json_decode($response->getBody()); // returns object

			 return $responseData;

		}

		public function addAnonymousUser($data){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/user/anoymous-signup/';
			$headers = [ "Content-Type" => "application/json"];
			$client = new Client();

			$response = $client->request('POST', $endPoint, [
				'json' => $data
			]);

			$responseData = $response->getBody();
			return json_decode($responseData);
		}


		// Users
		public function getUserQuestions($id){
			$baseUrl = $this->setBaseUrl();
			$userId = $id;
			$endPoint = $baseUrl.'/user/'.$userId.'/get-questions/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}

		public function getQuetionResponses($userId,$quesId){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/user/'.$userId.'/get-question-details/'.$quesId.'/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData->data;
		}

		public function getReponseCount($flag,$userId,$quesId){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/patient/response/'.$flag.'/'.$userId.'/'.$quesId.'/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}

		public function getReponseCountAll(){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/patient/response/unread/all/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}

		public function fetchUnreadQuestions(){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/patient/response/unread/all/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}

		public function userUnreadMessages($userId){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/response/unread/'.$userId.'/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}

		public function countAllUnreadQuestions(){
			$param = 'all';
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/patient/questions/unread/'.$param.'/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}

		public function getQuestionCategories(){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/questions/get-categories/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}

		public function userQuestionReply($responder,$quesId,$questionContent,$responderType,$patientId){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/user/reply-question';
			$headers = [ "Content-Type" => "application/json"];
			$client = new Client();



			$response = $client->request('POST', $endPoint, [
				'json' => [
					'userId' => $responder,
          "patientId"=>$patientId,
					'questionContent' => $questionContent,
					'questionId' => $quesId,
					'mediaUrl'=>'n/a',
					"fileType"=>"n/a",
					"fileExtention"=>"n/a",
					'responderType'=>$responderType,
					'token' => $this->token
				]
			]);

			$responseData = $response->getBody();
			return $responseData;
		}

		public function userQuestionMediaUpload($responder,$quesId,$questionContent,$mediaUrl,$fileType,$extension,$responderType){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/user/reply-question/';
			$headers = [ "Content-Type" => "application/json"];
			$client = new Client();
			try{
				$response = $client->request('POST', $endPoint, [
					'json' => [
						'userId' => $responder,
						'questionContent' => $questionContent,
						'mediaUrl'=>$mediaUrl,
						'questionId' => $quesId,
						'fileType'=>$fileType,
						'fileExtension'=>$extension,
						'responderType'=>$responderType,
						'token' => $this->token
					]
				]);

				$responseData = $response->getBody();
				return $responseData;

			}catch (GuzzleHttp\Exception\ClientException $e) {
					$response = $e->getResponse();
					$responseBodyAsString = $response->getBody()->getContents();
					return $responseBodyAsString;
				}

		}

		public function submitQuestion($data){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/user/submit-question/';
			$headers = [ "Content-Type" => "application/json"];
			$client = new Client();
			$data['token'] = $this->token;
			$response = $client->request('POST', $endPoint, [
				'json' => $data
			]);

			$responseData = json_decode($response->getBody());
			return $responseData;
		}

    public function closeCurrentQuestionThread($questionId){
      $data =  ['questionId'=>$questionId, 'closeQuestion'=>'yes'];
      $baseUrl = $this->setBaseUrl();
      $endPoint = $baseUrl.'/question/close-current-question';
      $headers = [ "Content-Type" => "application/json"];
      $client = new Client();
      $data['token'] = $this->token;
      $response = $client->request('POST', $endPoint, [
        'json' => $data
      ]);

      $responseData = json_decode($response->getBody());
      return $responseData;
    }

		public function countAllArticles(){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/articles/fetch/all/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}

		public function fetchAllHospitals(){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/pharmacies/fetch/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}

		public function fetchAllPharmacies(){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/hospital/fetch/all/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}

		public function latestArticles(){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/articles/fetch/latest/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}

		public function fetchArticleCategories(){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/articles/get-categories/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}

		public function fetchArticleCategoriesWithArticleCount(){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/articles/get-categories/with-count/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}

    public function articleStatsWithData(){
      $baseUrl = $this->setBaseUrl();
      $endPoint = $baseUrl.'/fetch/articles/bycategory/?token='.$this->token;
      $client = new Client();
      $response = $client->request('GET', $endPoint);
      $responseData = json_decode($response->getBody());
      return $responseData;
    }

		public function fetchArticlesByCateggory($category){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/articles/get-articles-by-category/'.$category.'/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}

		public function fetchArticleById($id){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/article/fetch/'.$id.'/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}

		public function fetchAllUserQuestions($page=null){
			$baseUrl = $this->setBaseUrl();
			$pageNumber = $page;
			if($pageNumber == null){
				$endPoint = $baseUrl.'/users/fetch-all-questions/?token='.$this->token;
			}else{
				$endPoint = $baseUrl.'/users/fetch-all-questions/?page='.$pageNumber.'&token='.$this->token;
			}

			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = $response->getBody();
			return $responseData;
		}

		public function countAllUserQuestions(){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/patient/questions/unread/all/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}

		public function countUserReadResponses($userId){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/patient/response/read/'.$userId.'/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData->messageCount;
		}


		public function hospitalList(){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/hospital/fetch/all/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}

		public function bookAppointment($data){
		    $baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/patient/bookappointment';
			$headers = [ "Content-Type" => "application/json"];
			$client = new Client();

			$response = $client->request('POST', $endPoint, [
				'json' => $data
			]);

			$responseData = json_decode($response->getBody());
			return $responseData;
		}



		public function addNewPatient($data){
		    $baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/patient/signup';
			$headers = [ "Content-Type" => "application/json"];
			$client = new Client();

			$response = $client->request('POST', $endPoint, [
				'json' => $data
			]);

			$responseData = json_decode($response->getBody());
			return $responseData;
		}

		public function verifyAccount($data){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/user/verify-code/';
			$headers = [ "Content-Type" => "application/json"];
			$client = new Client();

			$response = $client->request('POST', $endPoint, [
				'json' => $data
			]);

			$responseData = $response->getBody();
			return $responseData;
		}


		public function changePassword($data){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/user/update-credentials';
			$headers = [ "Content-Type" => "application/json"];
			$client = new Client();

			$response = $client->request('POST', $endPoint, [
				'json' => $data
			]);

			$responseData = $response->getBody();
			return json_decode($responseData);
		}

		public function updateUserImage($data){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/user/update-profileimage';
			$headers = [ "Content-Type" => "application/json"];
			$client = new Client();

			$response = $client->request('POST', $endPoint, [
				'json' => $data
			]);

			$responseData = $response->getBody();
			return json_decode($responseData);
		}

			public function updatePatientData($data){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/patient/update';
			$headers = [ "Content-Type" => "application/json"];
			$client = new Client();

			$response = $client->request('POST', $endPoint, [
				'json' => $data
			]);

			$responseData = $response->getBody();
			return json_decode($responseData);
		}


		public function getCoronaData($country=null){
			try{
				$baseUrl = 'https://corona.lmao.ninja/v2/countries/'.$country;
				$endPoint = $baseUrl;
				$client = new Client();
				$response = $client->request('GET', $endPoint);
				$responseData = json_decode($response->getBody());
				if(!empty($responseData)){
					return $responseData;
				}else{
					return null;
				}
				}catch(\Exception $e){
					return null;
				}
		}

		public function fetchPatientDetails($id){
			$patientId = $id;
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/patient/fetch/'.$patientId.'/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}


		public function fetchAppointByPatientId($userId){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/appointments/'.$userId.'/all/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}


    public function fetchDoctorDetails($id){
			$doctorId = $id;
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/doctor/fetch/'.$doctorId.'/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}


		public function fetchHospitals(){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/hospital/fetch/all/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}

		public function fetchFaqCategory(){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/faq/category/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}


		public function fetchFaqList($catId){
			$baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/faq/'.$catId.'/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
		}


    public function getQuestionDailyCount(){
      $baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/question/today/?token='.$this->token;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;
    }

    public function checkPasswordRestCode($code){
      $baseUrl = $this->setBaseUrl();
			$endPoint = $baseUrl.'/user/rest-code/'.$code;
			$client = new Client();
			$response = $client->request('GET', $endPoint);
			$responseData = json_decode($response->getBody());
			return $responseData;

    }


    public function initiateUserPassword($data){
    $baseUrl = $this->setBaseUrl();
    $endPoint = $baseUrl.'/user/request-password-reset';
    $headers = [ "Content-Type" => "application/json"];
    $client = new Client();
    $response = $client->request('POST', $endPoint, [
      'json' => $data
    ]);

    $responseData = $response->getBody();
    return json_decode($responseData);
   }

   public function updateDoctorDetails($data){
   $baseUrl = $this->setBaseUrl();
   $endPoint = $baseUrl.'/doctor/update/';
   $headers = [ "Content-Type" => "application/json"];
   $client = new Client();
   $response = $client->request('POST', $endPoint, [
     'json' => $data
   ]);

   $responseData = $response->getBody();
   return json_decode($responseData);
  }



   public function changePasswordWithoutToken($data){
     $baseUrl = $this->setBaseUrl();
     $endPoint = $baseUrl.'/user/change-credentials';
     $headers = [ "Content-Type" => "application/json"];
     $client = new Client();
     $response = $client->request('POST', $endPoint, [
       'json' => $data
     ]);

     $responseData = $response->getBody();
     return json_decode($responseData);
   }

   public function fetchAppointmentByHospitalId($hospitalId){
       $baseUrl = $this->setBaseUrl();
       $endPoint = $baseUrl.'/hospital/appointments/'.$hospitalId.'?token='.$this->token;
       $client = new Client();
       $response = $client->request('GET', $endPoint);
       $responseData = json_decode($response->getBody());
       return $responseData;
   }

   public function fetchPharmacies(){
    	$baseUrl = $this->setBaseUrl();
    	$endPoint = $baseUrl.'/pharmacies/fetch/?token='.$this->token;
    	$client = new Client();
    	$response = $client->request('GET', $endPoint);
    	$responseData = json_decode($response->getBody());
    	return $responseData;
  }

  public function fetchQuestionsStatsCatByYear($startDate,$endDate){
     $baseUrl = $this->setBaseUrl();
     $endPoint = $baseUrl.'/admin/question-category-by-year/'.$startDate.'/'.$endDate.'?token='.$this->token;
     $client = new Client();
     $response = $client->request('GET', $endPoint);
     $responseData = json_decode($response->getBody());
     return $responseData;
   }

   public function fetchQuestionCountByMonth($startDate,$endDate){
      $baseUrl = $this->setBaseUrl();
      $endPoint = $baseUrl.'/admin/question-count-by-month/'.$startDate.'/'.$endDate.'?token='.$this->token;
      $client = new Client();
      $response = $client->request('GET', $endPoint);
      $responseData = json_decode($response->getBody());
      return $responseData;
    }

    public function userCount(){
       $baseUrl = $this->setBaseUrl();
       $endPoint = $baseUrl.'/admin/user-count?token='.$this->token;
       $client = new Client();
       $response = $client->request('GET', $endPoint);
       $responseData = json_decode($response->getBody());
       return $responseData;
     }


     public function responseStats($startDate,$endDate){
       $baseUrl = $this->setBaseUrl();
       $endPoint = $baseUrl.'/admin/response-stats/'.$startDate.'/'.$endDate.'?token='.$this->token;
       $client = new Client();
       $response = $client->request('GET', $endPoint);
       $responseData = json_decode($response->getBody());
       return $responseData;
     }

     public function fetchDoctorsQuestionList($doctorId){

     }


	}
?>
