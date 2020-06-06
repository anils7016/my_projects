<?php
date_default_timezone_set('Asia/Kolkata');
class Webservices_model extends CI_Model {
  public function registercheck($mobile,$otp){
    $this->db->select('id');
    $this->db->where('mobile',$mobile);
    $query=$this->db->get("users");
    $return = $query->num_rows();
    $count = $return;
    if($count!=0){
      $data=array(
        'mobile'=>$mobile,
        'otp'=>$otp

      );
      $this->db->where('mobile',$mobile);
      $this->db->update('users',$data);
      return $data;
    }
    else
    {
      $data=array(
        'mobile'=>$mobile,
        'otp'=>$otp,
        'created_date'=>date('Y-m-d'),
        'profile'=>'http://livetestprojects.review/aroundme/assets/profile/def-image.png'

      );
      $this->db->insert('users',$data);
      return $data;
    }
  }
  public function getlisting($lat,$lang,$cat){
    $query = $this->db->query('SELECT m.cmp_id , m.title , m.image , m.mobile , m.latitude , m.longitude	, ( ACOS( COS( RADIANS( '.$lat.'  ) ) * COS( RADIANS( m.latitude ) ) * COS( RADIANS( m.longitude ) - RADIANS( '.$lang.' ) ) + SIN( RADIANS( '.$lat.'  ) ) * SIN( RADIANS( m.latitude ) ) ) * 6371 ) AS distance_in_km FROM listing m where m.cat_id = '.$cat.' HAVING distance_in_km <= 100 ORDER BY distance_in_km ASC LIMIT 12');

    $result = $query->result_array();
    return $result;
  }

  public function search($keyword){
    $query = $this->db->query("SELECT title,image,cmp_id FROM listing WHERE status != 0 AND (title LIKE '%".$keyword."%') ORDER BY CASE WHEN title = '".$keyword."' THEN 0 WHEN title LIKE '".$keyword."%' THEN 2 WHEN title LIKE '%".$keyword."%' THEN 3 WHEN title LIKE '%.".$keyword."' THEN 4 ELSE 5 END, title ASC");
    return $result = $query->result_array();
  }

  public function datelisting($agent,$date){
    if($date == 0) {
       $date = date('m');
    }
    $count = $this->db->query("SELECT count(*) as cnt from listing where agent_id = '$agent' and status = 1")->row()->cnt;
    $this->db->select('s_para');
    $charge = $this->db->get_where('setting', array('s_id'=>2))->row()->s_para;
    $this->db->select('s_para');
    $discount = $this->db->get_where('setting', array('s_id'=>1))->row()->s_para;
    $this->db->select('balance');
    $remaining = $this->db->get_where('users', array('id'=>$agent))->row()->balance;
    $total = $charge - ($charge * ($discount / 100));
    $dis_amount = $charge - $total;
    $commision = $count * $dis_amount;
    $result['remaining'] = $remaining;
    $result['commission'] = $commision;
    $query = $this->db->query("SELECT cmp_id,title,image FROM listing WHERE status = 1 AND agent_id = '$agent' AND MONTH(created_date) ='$date'");
    $result['listing'] = $query->result_array();
    return $result;
  }
  public function getuserbymobile($mobile) {
    $this->db->select('*');
    $this->db->where('mobile', $mobile);
    $querys = $this->db->get('users');
    $returns = $querys->row();
    return $returns;
  }

  public function becomeagent($id) {
    $this->db->where('id', $id);
    return $this->db->update('users', array('type'=>3));
  }

  public function updateprofile() {
    //uid,name,email,address,propic
    $uid = $this->input->post('uid');
    $name = $this->input->post('name');
    $eml = $this->input->post('email');
    $adrs = $this->input->post('adress');
    $query = $this->db->get_where('users', array('id'=>$uid));
    $user = $query->result();
    // print_r($user);exit;
    $return = $query->num_rows();
    if($return == 1) {
      // $
      if(isset($_FILES['propic'])) {
        $pathToUpload = $_SERVER['DOCUMENT_ROOT'].'/aroundme/assets/profile/';
        $img1 = $_FILES['propic']['name'];
        $mainimg1 = preg_replace("/[^a-zA-Z0-9.]/", "", $img1);
        $imageurl = base_url().'assets/profile/'.$mainimg1;
        $imagepath = $pathToUpload.$mainimg1;
        $image = $mainimg1;
        $imagetepath = $_FILES['propic']['tmp_name'];
        move_uploaded_file($imagetepath, $imagepath);
      } else {
        $imageurl="";
      }
      $data=array(
        'name'=> $name,
        'email'=> $eml,
        'profile'=> $imageurl,
      );

      $this->db->where('id', $uid);
      $this->db->update('users',$data);
      return $data;
    } else {
      return 2;
    }
  }
  public function insertrating($listid, $userid, $title, $rating, $review) {
    $data = array(
      'user_id'=>$userid,
      'cmp_id'=>$listid,
      'rating'=>$rating,
      'title'=>$title,
      'review'=>$review,
      'status'=>0,
      'created_on'=>date('Y-m-d')
    );
    $this->db->insert('user_rating',$data);
    return 1;
  }
  public function addlisting(){
    // catid,cmpname, logo,mobile, email, agentid,address,lat,long
    $catid = $this->input->post('catid');
		$cmpname = $this->input->post('cmpname');
		$mobile = $this->input->post('mobile');
		$email = $this->input->post('email');
		$owner = $this->input->post('owner');
		$agentid = $this->input->post('agentid');
		$address = $this->input->post('address');
		$lat = $this->input->post('lat');
		$long = $this->input->post('long');
    if(isset($_FILES['logo'])) {
      $pathToUpload = $_SERVER['DOCUMENT_ROOT'].'/aroundme/assets/company/';
      $img1 = $_FILES['logo']['name'];
      $mainimg1 = preg_replace("/[^a-zA-Z0-9.]/", "", $img1);
      $imageurl = base_url().'assets/company/'.$mainimg1;
      $imagepath = $pathToUpload.$mainimg1;
      $image = $mainimg1;
      $imagetepath = $_FILES['logo']['tmp_name'];
      move_uploaded_file($imagetepath, $imagepath);
    } else {
      $imageurl="";
    }
    $data = array(
      'cat_id'=>$catid,
      'title'=>$cmpname,
      'image'=>$imageurl,
      'owner'=>$owner,
      'address'=>$address,
      'mobile'=>$mobile,
      'email'=>$email,
      'agent_id'=>$agentid,
      'latitude'=>$lat,
      'longitude'=>$long,
      'created_date'=>date('Y-m-d'),
      'status'=>0
    );
    $this->db->insert('listing',$data);
    return 1;
  }
  public function allcategory() {
    $this->db->select('*');
    $this->db->where('mc_status','1');
    $query = $this->db->get('');
    $ret = $query->result_array();
    return $ret;
  }

  public function getcmspage($slug){
    return $this->db->get_where('cms', array('status'=>1,'c_slug'=>$slug))->result_array();
  }

  public function pendinglisting($id){
    return $this->db->get_where('listing', array('status'=>0,'agent_id'=>$id))->result_array();
  }

  public function approvelisting($id){
    return $this->db->get_where('listing', array('status'=>1,'agent_id'=>$id))->result_array();
  }

  public function getbannerlist() {
    return $this->db->get_where('banner', array('status'=>1))->result_array();
  }

  public function subdetails($id){
    return $this->db->get_where('listing', array('status'=>1,'cmp_id'=>$id))->result_array();
  }

  public function noti_list(){
    $this->db->order_by("created_on", "desc");
    $this->db->limit(5);
    return $this->db->get_where('notification', array('status'=>1))->result_array();
  }

  public function getcategorylist(){
    $this->db->select('*');
    $this->db->where('status', '1');
    $querys = $this->db->get('category');
    $returns = $querys->result_array();
    return $returns;
  }

  public function addfreeassessment(){
    $full_name = $this->input->post("full_name");
    $education = $this->input->post("education");
    $english_test = $this->input->post("english_test");
    $completion_year = $this->input->post("completion_year");
    $status = $this->input->post("is-active");if(empty($status)){$status = 0;}
    $age = $this->input->post("age");
    $email = $this->input->post("email");
    $category = $this->input->post("category");
    $state = $this->input->post("state");
    $city = $this->input->post("city");
    $mobile = $this->input->post("mobile");
    $whatsapp_no = $this->input->post("whatsapp_no");
    
    $data = array(
      'full_name'=>$full_name,
      'education'=>$education,
      'english_test'=>$english_test,
      'completion_year'=>$completion_year,
      'age'=>$age,
      'state'=>$state,
      'city'=>$city,
      'email'=>$email,
      'mobile'=>$mobile,
      'Whatsapp_no'=>$whatsapp_no,
      'created_date'=>date('Y-m-d H:i:s'),
      'status'=>$status
    );
    $this->db->insert('studednts_profile',$data);
    return 1;
  }

  public function countryListing($countryName){
    $this->db->select('*');
    $this->db->where_in('name', $countryName);
    $this->db->where('status', '1');
    $this->db->order_by('name','ASC');
    $querys = $this->db->get('country');
    $returns = $querys->result_array();
    return $returns;
  }

  public function expertListing(){
    $this->db->select('*');
    $this->db->where('status', '1');
    $limit = "10";
    $offset = "0";
    $limit = $this->input->post('limit');
    if($this->input->post('offset')!==''){
      $offset = $this->input->post('offset');
      $offset = $limit*$offset;
    }else{
      $offset = 0;
    }
    if ($limit !== "" && $offset !== "") {
        $this->db->limit($limit, $offset);
    }
    $querys = $this->db->get('experts');
    $returns = $querys->result_array();
    return $returns;
  }

  public function expertCount(){
    $this->db->select('*');
    $this->db->where('status', '1');
    $querys = $this->db->get('experts');
    $returns = $querys->num_rows();
    return $returns;
  }
  
  // banner list 
  public function bannerListing(){
    $this->db->select('*');
    $this->db->where('status', '1');
    $querys = $this->db->get('banner');
    $returns = $querys->result_array();
    return $returns;
  } 
  
    // office listing
  public function officeListing(){
    $this->db->select('*');
    $this->db->where('status', '1');
    //$limit = "10";
    $limit = $this->input->post('limit');
    $offset = $this->input->post('offset');
    if ($limit !== "" && $offset !== "") {
        $this->db->limit($limit, $offset);
    }
    $querys = $this->db->get('our_offices');
    $returns = $querys->result_array();
    return $returns;
  }
  
  // state listing
  public function stateListing(){
    $this->db->select('*');
    
    $querys = $this->db->get('state');
    $returns = $querys->result_array();
    return $returns;
  }

  // city listing
  public function cityListing(){
    if(isset($_GET['state_id']) ){
      $state_id = $_GET['state_id'];
    }else{
      $state_id = 0;
    }
    $this->db->select('*');
    $this->db->where('c_state', $state_id);
    $querys = $this->db->get('city');
    $returns = $querys->result_array();
    return $returns;
  }

}
?>
