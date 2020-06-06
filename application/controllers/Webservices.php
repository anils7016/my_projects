<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webservices extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('webservices_model');
		$this->load->library('email');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library('GCM');
	}
	public function getotp1(){
		$mobile = $this->input->get('mobile');
		$otp = mt_rand(100000, 999999);
		$sender = 'HONHOF';
		$message = "OTP is".$otp." for your HoponHopoff App";
					$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "http://control.msg91.com/api/sendotp.php?authkey=171581Ag2vm2wkQ95bf3ee75&message=".$message."&sender=".$sender."&mobile=".$mobile."&otp=".$otp,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => "",
			  CURLOPT_SSL_VERIFYHOST => 0,
			  CURLOPT_SSL_VERIFYPEER => 0,
			));
			//.echo "http://control.msg91.com/api/sendotp.php?authkey=171581Ag2vm2wkQ95bf3ee75&message=".$message."&sender=".$sender."&mobile=".$mobile."&otp=".$otp;
			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {
			  echo $response;
			}
	// 	$mobile = $this->input->get('mobile');
	// 	$code = $this->input->get('code');
	// 	$curl = curl_init();
    //      // echo "http://control.msg91.com/api/sendotp.php?authkey=171581ATLpGpbHzil599fa2a9&message=".$message."&sender=".$sender."&mobile=".$mobile."&otp=".$otp;
    //     // http://control.msg91.com/api/sendotp.php?authkey=171581ATLpGpbHzil599fa2a9&message=OTP IS 123456 for your App&sender=ARNDME&mobile=919898283528&otp=123456
	// 	curl_setopt_array($curl, array(
    //         CURLOPT_URL =>"http://control.msg91.com/api/sendotp.php?authkey=171581ATLpGpbHzil599fa2a9&message=".$message."&sender=".$sender."&mobile=".$mobile."&otp=".$otp,
	// 		CURLOPT_RETURNTRANSFER => true,
	// 		CURLOPT_ENCODING => "",
	// 		CURLOPT_MAXREDIRS => 10,
	// 		CURLOPT_TIMEOUT => 30,
	// 		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	// 		CURLOPT_CUSTOMREQUEST => "POST",
	// 		CURLOPT_POSTFIELDS => "",
	// 		CURLOPT_SSL_VERIFYHOST => 0,
	// 		CURLOPT_SSL_VERIFYPEER => 0,
	// 	));
	//
	// 	$response = curl_exec($curl);echo $curl;echo $err = curl_error($curl);
	// 	$decod = json_decode($response); //print_r($decod);exit;
        $arr = array();
		if(!empty($decod) && $decod->type == 'success'){
			$result = $this->webservices_model->registercheck($mobile,$otp,$code);
			if(!empty($result)){
				$ars= array(
					"mobile"=>$result['mobile'],
					"otp"=>$result['otp']
				);
				$arra = $arr;
				$ars['status'] = "100";
				echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
			}
			else{
				$arra = $arr;
				$ars['status'] = "101";
				echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
			}
		}
		else{
			$arra = $arr;
			$ars['status'] = "101";
			$ars['user'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
	}
	public function getotp(){
		$mobile = $this->input->get('mobile');
		$curl = curl_init();
		$otp = mt_rand(100000, 999999);
		// $sender = 'ARNDME';
		// $message = "OTP ".$otp." for your Knowleddge Hub Global App";
		// curl_setopt_array($curl, array(
		// 	CURLOPT_URL => "http://control.msg91.com/api/sendotp.php?authkey=244868A6wDgf2T5bd42a27&message=".$message."&sender=".$sender."&mobile=".$mobile."&otp=".$otp,
		// 	CURLOPT_RETURNTRANSFER => true,
		// 	CURLOPT_ENCODING => "",
		// 	CURLOPT_MAXREDIRS => 10,
		// 	CURLOPT_TIMEOUT => 30,
		// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		// 	CURLOPT_CUSTOMREQUEST => "POST",
		// 	CURLOPT_POSTFIELDS => "",
		// 	CURLOPT_SSL_VERIFYHOST => 0,
		// 	CURLOPT_SSL_VERIFYPEER => 0,
		// ));
		//
		// $response = curl_exec($curl);
		// $decod = json_decode($response);
		// if(!empty($decod) && $decod->type == 'success'){
			$result = $this->webservices_model->registercheck($mobile,$otp);
			$arr = array();
			if(!empty($result)){
				$ars= array(
					"mobile"=>$result['mobile'],
					"otp"=>$result['otp']
				);
				$arra = $arr;
				$ars['status'] = "100";
				echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
			}
			else{
				$arra = $arr;
				$ars['status'] = "101";
				echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
			}
		// }
		// else{
		// 	$arra = $arr;
		// 	$ars['status'] = "101";
		// 	$ars['user'] = $arra;
		// 	echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		// }
	}
    
    	public function sendotp(){
		$mobile = $this->input->get('mobile');
		$curl = curl_init();
		$otp = mt_rand(100000, 999999);
		$sender = 'KHGIND';
		$message = $otp;
		//$message = "OTP ".$otp." for your Knowleddge Hub Global App";
		$ars=array();
		$arr=array();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "http://control.msg91.com/api/sendotp.php?authkey=327403ACQD81Zv75ea5856dP1&message=".$message."&sender=".$sender."&mobile=".$mobile."&otp=".$otp,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "",
			CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_SSL_VERIFYPEER => 0,
		));
		
		$response = curl_exec($curl);
		$decod = json_decode($response);
		//print_r($decod); exit;
		if(!empty($decod) && $decod->type == 'success'){
			
			$ars= array(
				//"mobile"=>$result['mobile'],
				"otp"=>$otp
			);
			//$arra = $arr;
			$arra = $decod;
			$ars['status'] = "100";
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
		else{
			$arra = $arr;
			$ars['status'] = "101";
			$ars['user'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
	}

	public function verifyotp(){
		$mobile = $this->input->get('mobile');
		$otp = $this->input->get('otp');
		// $curl = curl_init();
		// curl_setopt_array($curl, array(
		// 	CURLOPT_URL => "http://control.msg91.com/api/verifyRequestOTP.php?authkey=244868A6wDgf2T5bd42a27&mobile=".$mobile."&otp=".$otp,
		// 	CURLOPT_RETURNTRANSFER => true,
		// 	CURLOPT_ENCODING => "",
		// 	CURLOPT_MAXREDIRS => 10,
		// 	CURLOPT_TIMEOUT => 30,
		// 	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		// 	CURLOPT_CUSTOMREQUEST => "POST",
		// 	CURLOPT_POSTFIELDS => "",
		// 	CURLOPT_SSL_VERIFYHOST => 0,
		// 	CURLOPT_SSL_VERIFYPEER => 0,
		// ));
		//
		// $response = curl_exec($curl);
		// $decod = json_decode($response);
		// if(!empty($decod) && $decod->type == 'success'){
			$result = $this->webservices_model->getuserbymobile($mobile);
			if(!empty($result)){
				$ars['status'] = "100";
				$ars['mobile'] = $result->mobile;
				$ars['otp'] = $result->otp;
				$ars['user_id'] = $result->id;
				$ars['name'] = $result->name;
				$ars['email'] = $result->email;
				$ars['profile'] = $result->profile;
				$ars['type'] = $result->type;
			}
			else{
				$ars['status'] = "101";
			}
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		// }
		// else{
		// 	$ars['status'] = "101";
		// 	echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		// }
		// $err = curl_error($curl);

		// curl_close($curl);
	}

	public function editprofile() {
		// echo $uid = $this->input->post('uid');exit;
		$result = $this->webservices_model->updateprofile();
		//print_r($result);exit;
		if(is_array($result))	{
			$arr['status'] = "100";
			$arr['data'] = $result;
			echo str_replace('</', '<\/', json_encode($arr, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
			exit;
		}	elseif($result=='2') {
		  $response['status']="101";
			print json_encode($response);
		  // $arr['data'] = $response;
		  exit;
		  }	else {
		  $response['status']="102";
			print json_encode($response);
		  //$data['user']=$response;
		  // $arr['data'] = $response;
		  //print json_encode($data);
		  exit;
		  }
	}

	public function listing(){
		$lat = $this->input->get('latitude');
		$lang = $this->input->get('langitude');
		$cat = $this->input->get('category');
		$result = $this->webservices_model->getlisting($lat,$lang,$cat);
		$ars = array();
		$arra = array();
		if(!empty($result)){
			foreach($result as $data){
				$lat1 = $lat;
				$lon1 = $lang;

				$lat2 = $data['latitude'];
				$lon2 = $data['longitude'];
				$theta = $lon1 - $lon2;
				$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
				$dist = acos($dist);
				$dist = rad2deg($dist);
				$miles = $dist * 60 * 1.1515;
				$distance = intval($miles * 1.609344). ' KM';


				$arra[] = array(
					'id' => $data['cmp_id'],
					'title' => $data['title'],
					'image' => $data['image'],
					'mobile' => $data['mobile'],
					'distance' => "$distance"
				);
			}
			$ars['status'] = "100";
			$ars['user'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
		else{
			$ars['status'] = "101";
			$ars['user'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
	}

	public function agentpendinglisting(){
		$agent = $this->input->get('agentid');
		$result = $this->webservices_model->pendinglisting($agent);
		$ars = array();
		$arra = array();
		if(!empty($result)){
			foreach($result as $data){
				$arra[] = array(
					'id' => $data['cmp_id'],
					'title' => $data['title'],
					'image' => $data['image'],
				);
			}
			$ars['status'] = "100";
			$ars['data'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
		else{
			$ars['status'] = "101";
			$ars['data'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
	}

	public function agentapprovelisting(){
		$agent = $this->input->get('agentid');
		$result = $this->webservices_model->approvelisting($agent);
		$ars = array();
		$arra = array();
		if(!empty($result)){
			foreach($result as $data){
				$arra[] = array(
					'id' => $data['cmp_id'],
					'title' => $data['title'],
					'image' => $data['image'],
				);
			}
			$ars['status'] = "100";
			$ars['data'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
		else{
			$ars['status'] = "101";
			$ars['data'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
	}

	public function makeagent(){
		$userid = $this->input->get('uid');
		$result = $this->webservices_model->becomeagent($userid);
		if($result == 1) {
			$ars['status'] = "100";
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
		else{
			$ars['status'] = "101";
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
	}

	public function listingsearch(){
		$keyword = $this->input->get('keyword');
		$result = $this->webservices_model->search($keyword);
		$ars = array();
		$arra = array();
		if(!empty($result)){
			foreach($result as $data){
				$arra[] = array(
					'id' => $data['cmp_id'],
					'title' => $data['title'],
					'image' => $data['image'],
				);
			}
			$ars['status'] = "100";
			$ars['data'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
		else{
			$ars['status'] = "101";
			$ars['data'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
	}

	public function addlisting(){
		$result = $this->webservices_model->addlisting();
		$ars =array();
		if($result == 1){
			$ars['status'] = "100";
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		} else {
			$ars['status'] = "101";
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
	}

	public function date(){
		$agent = $this->input->get('agentid');
		$date = $this->input->get('date');
		$result = $this->webservices_model->datelisting($agent,$date);
		$ars = array();
		$arra = array();
		if(!empty($result['listing'])){
			foreach($result['listing'] as $data){
				$arra[] = array(
					'id' => $data['cmp_id'],
					'title' => $data['title'],
					'image' => $data['image'],
				);
			}
			$ars['status'] = "100";
			$ars['balance'] = $result['remaining'];
			$ars['discount'] = $result['commission'];
			$ars['data'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		} else {
			$ars['status'] = "101";
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
	}

	public function adrating(){
		// listid,userid,rating,title,review
		$listid = $this->input->get('listid');
		$userid = $this->input->get('userid');
		$title = $this->input->get('title');
		$rating = $this->input->get('rating');
		$review = $this->input->get('review');
		$result = $this->webservices_model->insertrating($listid, $userid, $title, $rating, $review);
		$ars = array();
		if($result == 1){
			$ars['status'] = "100";
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		} else {
			$ars['status'] = "101";
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
	}

	public function cmspage(){
		$slug = $this->input->get('slug');
		$result = $this->webservices_model->getcmspage($slug);
		$arra = array();
		if(!empty($result)){
			foreach($result as $data){
				$arra[] = array(
					'name' => $data['c_name'],
					'slug' => $data['c_slug'],
					'description' => $data['c_desc']
				);
			}
			$ars['status'] = "100";
			$ars['user'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
		else{
			$ars['status'] = "101";
			$ars['user'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
	}

	public function subdetails(){
		$slug = $this->input->get('listid');
		$result = $this->webservices_model->subdetails($slug);
		$arra = array();
		if(!empty($result)){
			foreach($result as $data){
			if(empty($data['rating'])) { $rating = 0; } else{ $rating = $data['rating'];}
				$arra[] = array(
					'name' => $data['title'],
					'email' => $data['email'],
					'image' => $data['image'],
					'owner' => $data['owner'],
					'address' => $data['address'],
					'mobile' => $data['mobile'],
					'latitude' => $data['latitude'],
					'longitude' => $data['longitude'],
					'rating' => $rating
				);
			}
			$ars['status'] = "100";
			$ars['user'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
		else{
			$ars['status'] = "101";
			$ars['user'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
	}

	public function notificationlist(){
		//$slug = $this->input->get('listid');
		$result = $this->webservices_model->noti_list();// print_r($result);exit;
		$arra = array();
		if(!empty($result)){
			foreach($result as $data){
				$arra[] = array(
					'id' => $data['n_id'],
					'title' => $data['title'],
					'desc' => $data['n_desc'],
					'date_time' => $data['created_on'],
				);
			}
			$ars['status'] = "100";
			$ars['user'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
		else{
			$ars['status'] = "101";
			$ars['user'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
	}

	public function homepage(){
		$banners = $this->webservices_model->getbannerlist();
		$categories = $this->webservices_model->getcategorylist();
		$ars = array();
		if(!empty($banners)){
			foreach($banners as $data){
				$arra['banner'][] = array(
					'id'=>$data['id'],
					'banner'=>$data['banner']
				);
			}
		}
		if(!empty($categories)){
			foreach($categories as $data){
				$arra['categories'][] = array(
					'id'=>$data['id'],
					'name'=>$data['name'],
					'icon'=>$data['icon']
				);
			}
		}

		$ars['status'] = "100";
		$ars['user'] = $arra;
		echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
	}

	public function adrating2(){
		// listid,userid,rating,title,review
		$listid = $this->input->get('listid');
		$userid = $this->input->get('userid');
		$title = $this->input->get('title');
		$rating = $this->input->get('rating');
		$review = $this->input->get('review');
		$result = $this->webservices_model->insertrating($listid, $userid, $title, $rating, $review);
		$ars = array();
		if($result == 1){
			$ars['status'] = "100";
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		} else {
			$ars['status'] = "101";
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
	}

	public function expertlist(){
		$result = $this->webservices_model->expertListing();
		$result_count = $this->webservices_model->expertCount();
		
		$ars= array();
		if(!empty($result)){
			/*foreach($result as $data){
				$arra[] = array(
					'name' => $data['title'],
					'email' => $data['email'],
					'image' => $data['image'],
				);
			}*/
			$ars['status'] = "100";
			$ars['total_records'] = $result_count;
			$ars['expertlist'] = $result;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
		else{
			$ars['status'] = "101";
			$ars['user'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
	}

	// 
	public function addfreeassessment(){
		$result = $this->webservices_model->addfreeassessment();
		$ars =array();
		$arra =array();
		$result =1;
		if($result == 1){
			$full_name = $this->input->post("full_name");
			$age = $this->input->post("age");
			$education = $this->input->post("education");
			$country ="";
			if($education =="10th" && ($age >=17 && $age <=35 )){
				$country = ['Malta', 'Latvia', 'Singapore', 'Mauritius', 'Fiji'];
			} 
			if($education =="Diploma" && ($age >=17 && $age <=35 )){
				$country = ['Malta', 'Latvia', 'Singapore', 'Mauritius', 'Fiji'];
			}
			if($education=="Diploma 2/3 Years" && ($age >=17 && $age <=35 )){
				$country = ['Poland', 'Malta', 'Latvia', 'Lithuania', 'France', 'Switzerland', 'Singapore', 'Mauritius', 'Fiji'];
			}
			if($education=="12th" && ($age >=17 && $age <=23 )){
				$country = ['USA', 'Canada', 'Australia', 'Poland', 'Malta', 'Latvia', 'Lithuania', 'France', 'Switzerland', 'Singapore', 'Mauritius', 'Fiji'];
			}
			if($education=="12th" && ($age >=24 && $age <=35 )){
				$country = ['Malta', 'Latvia', 'Singapore', 'Mauritius', 'Fiji'];
			}
			if($education=="Bachelor Degree" && ($age >=19 && $age <=35 )){
				$country = ['USA', 'Canada', 'Australia', 'Malta', 'Latvia', 'Singapore', 'Mauritius', 'Fiji'];
			}
			if($education=="Master Degree" && ($age >=22 && $age <=35 )){
				$country = ['USA', 'Canada', 'Australia', 'Malta', 'Latvia', 'Singapore', 'Mauritius', 'Fiji'];
			}
			$result_country = $this->webservices_model->countryListing($country);
			foreach($result_country as $data){
				$arra[] = array(
					'id' => $data['id'],
					'name' => $data['name'],
					'image' => $data['image'],
				);
			}
				$studednt[] = array(
					'full_name' => $full_name,
					'name' => $age,
					'education' => $education,
				);
			//name, age ,education
			$ars['status'] = "100";
			$ars['countrylist'] = $arra;
			$ars['studentlist'] = $studednt;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		} else {
			$ars['status'] = "101";
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
	}

	// banner list
		public function bannerlist(){
		$result = $this->webservices_model->bannerListing();
		$arra = array();
		if(!empty($result)){
			$ars['status'] = "100";
			$ars['bannerlist'] = $result;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
		else{
			$ars['status'] = "101";
			$ars['user'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
	}
	
	public function officelist(){
		$result = $this->webservices_model->officeListing();
		$arra = array();
		if(!empty($result)){
			$ars['status'] = "100";
			$ars['officetlist'] = $result;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
		else{
			$ars['status'] = "101";
			$ars['user'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
	}
	
	public function statelist(){
		$result = $this->webservices_model->stateListing();
		$arra = array();
		if(!empty($result)){
			$ars['status'] = "100";
			$ars['statelist'] = $result;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
		else{
			$ars['status'] = "101";
			$ars['user'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
	}

	public function citylist(){
		$result = $this->webservices_model->cityListing();
		$arra = array();
		if(!empty($result)){
			$ars['status'] = "100";
			$ars['citylist'] = $result;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
		else{
			$ars['status'] = "101";
			$ars['user'] = $arra;
			echo str_replace('</', '<\/', json_encode($ars, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
		}
	}

}
?>
