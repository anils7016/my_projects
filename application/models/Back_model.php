<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Back_model extends CI_model {
	 public function __construct()
	{
		parent::__construct();
	}	
		public function pagedetail($para){
			$this->db->like('cp_term', $para, 'both');
			return $this->db->get_where('cms_pages',array('cp_status' => 1))->result();
		}

		public function adduserdetail(){
			$name = $this->input->post('name');
			$direct = $this->input->post('r_redirect');
			$email = $this->input->post('email');
			$facebookid = $this->input->post('facebookid');
			$password = $this->input->post('password');
			$password = hash('sha512',$password);
			$this->db->select('email');
			$data = $this->db->get_where('users', array('email'=>$email));
			$count = $data->num_rows();
			if($count==0){
				if($name!=''){
					$data=array(
					'name'=>$name,
					'email'=>$email,
					'password'=>$password,
					'facebook_id'=>$facebookid,
					'status'=>1,
					);
					$this->db->insert('users',$data);
					if(!empty($direct)){
						return $direct;
					} else{
						return 1;
					}
				} else {
					return 2;
				}
			} else {
				return 3;
			}
		}
	public function update_category(){
		$pathToUpload = '/assets/img/';
		$status = $this->input->post('status');
		$id = $this->input->post('id');
		if($status == ''){$status = 0;}
		
		if ($_FILES["upload"]["name"] != '' ) {
				$img1 = $_FILES['upload']['name'];
			$mainimg1 = preg_replace("/[^a-zA-Z0-9.]/", "", $img1);
			$imageurl = base_url().$pathToUpload.$mainimg1;
			$imagepath = upload_url.$pathToUpload.$mainimg1;
			$image = $mainimg1;
			$imagetepath = $_FILES['upload']['tmp_name'];
			move_uploaded_file($imagetepath, $imagepath);
				}
			else{	
			$imageurl=$this->input->post('hid_upload');
			//echo 'isset';exit;
			}
			
		$data=array(		
			'name'=>$this->input->post('title'),		
			'icon'=>$imageurl,		
			'status'=>$status
			
		);
 	    //print_r($data);exit;	
		$this->db->where('id',$id);
		$this->db->update('category',$data);		
		$return = '1';
		return $return;
	}	
	public function getcategorybyid($id){
		$this->db->select('*'); 
		$this->db->where('id',$id);
		$query = $this->db->get('category');  
		$return = $query->row();
		return $return;
		}
		
		
		
		public function add_question(){
			$que = $this->input->post('p_que');
			$cmp_id = $this->input->post('cmp_id');
			$user = $this->session->userdata('usr_id');
				if($que!=''){
					$data=array(
					'user_id'=>$user,
					'main_id'=>$cmp_id,
					'que'=>$que,
					'status'=>1,
					);
					$this->db->insert('questions',$data);
					return $data;
				} else {
					return 2;
				}
		}
		public function add_answer(){
			$ans = $this->input->post('a_que');
			$que_id = $this->input->post('que_id');
			$cmp_id = $this->input->post('cmp_id');
			$user = $this->session->userdata('usr_id');
				if($ans!=''){
					$data=array(
					'q_id'=>$que_id,
					'user_id'=>$user,
					'main_id'=>$cmp_id,
					'answer'=>$ans,
					'status'=>1,
					);
					$this->db->insert('answers',$data);
					return $data;
				} else {
					return 2;
				}
		}

		public function addprogram(){
			$p_name = $this->input->post('p_name');
			$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $p_name)));
			$url = $this->input->post('p_url');
			$email = $this->input->post('e_mail');
			$s_date = $this->input->post('s_date');
			$f_url = $this->input->post('f_url');
			$desc = $this->input->post('desc');
			$p_min = $this->input->post('p_min');
			$p_max = $this->input->post('p_max');
			$r_bonus = $this->input->post('r_bonus');
			$intrst = $this->input->post('intrst');
			$form = $this->input->post('t_form');
			if($form==1){
				$perform = 1;
			} else {
				$perform = 0;
			}
			$coin = $this->input->post('coin');

			//$password = hash('sha512',$password);
			$this->db->select('cmp_email');
			$data = $this->db->get_where('listing_companies', array('cmp_email'=>$email));
			$count = $data->num_rows();
			if($count==0){
				if($p_name!=''){
					if (isset($_FILES['c_file'])) {
							$pathToUpload = $_SERVER['DOCUMENT_ROOT'] . '/hype/assets/company/';
							$img1 = $_FILES['c_file']['name'];
							$mainimg1 = preg_replace("/[^a-zA-Z0-9.]/", "", $img1);
							$imageurl = base_url() . 'assets/company/' . $mainimg1;
							$imagepath = $pathToUpload . $mainimg1;
							$image = $mainimg1;
							$imagetepath = $_FILES['c_file']['tmp_name'];
							move_uploaded_file($imagetepath, $imagepath);
					} else {
							$imageurl = "";
					}
					$data=array(
					'cmp_name'=>$p_name,
					'cmp_slug'=>$slug,
					'cmp_email'=>$slug,
					'start_date'=>$email,
					'cmp_logo'=>$imageurl,
					'cmp_admin_rating'=>0,
					'cmp_desc'=>$desc,
					'bounty'=>$f_url,
					'min_invest'=>$p_min,
					'max_invest'=>$p_max,
					'bonus'=>$r_bonus,
					'intrest'=>$intrst,
					'top_perform'=>$perform,
					'bonus'=>$r_bonus,
					'active'=>0
					);

					$this->db->insert('listing_companies',$data);
					$cmpid = $this->db->insert_id();
					foreach ($coin as  $value1) {
						$slug1 = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $value1)));
						$data1 = array('cmp_id'=>$cmpid,'c_name'=>$value1,'c_slug'=>$slug1,'c_status'=>1);
						$this->db->insert('currency',$data1);
					}
						return 1;

				} else {
					return 2;
				}
			} else {
				return 3;
			}
		}

		public function insertdata($name,$rate2,$email,$desc,$cmp_id,$user){
				if($name!=''){
					$data=array(
					'main_id'=>$cmp_id,
					'user_id'=>$user,
					'rating'=>$rate2,
					'title'=>$name,
					'review'=>$desc,
					'created_date'=>date('Y-m-d'),
					'status'=>1,
					);
					$this->db->insert('user_rating',$data);
					return 1;
				} else {
					return 2;
				}

		}

		public function getdata($array = array()){

			$where = '1=1 ';
			if(array_key_exists('select', $array)){
				$this->db->select($array['select']);
			} else {
				$this->db->select('*');
			}
			if(array_key_exists('limit', $array)){
				$this->db->limit($array['limit']);
			}
			if(array_key_exists('like', $array)){
				$this->db->like($array['like']['column'],$array['like']['value'],$array['like']['type']);
			}
			if((array_key_exists('get_where_table', $array)) && (array_key_exists('get_where_con', $array))) {
				$result = $this->db->get_where($array['get_where_table'], $array['get_where_con']);
			} elseif(array_key_exists('where', $array)){
				$where .= $array['where'];
				$this->db->where($where);
			}
			if((array_key_exists('innerjointable', $array)) && (array_key_exists('innerquery', $array))) {
					 $this->db->join($array['innerjointable'], $array['innerquery'], 'inner');
			}
			if(array_key_exists('group_by', $array)) {
			$this->db->group_by($array['group_by']);
			}
			if((!array_key_exists('get_where', $array)) && (array_key_exists('table', $array))){
				$result = $this->db->get($array['table']);

			}
			if(array_key_exists('return', $array)){
				if($array['return']=='result'){

					return $result->result();
				} else {
					if(array_key_exists('para', $array)){
						$para = $array['para'];
						$para = explode(',',$para);
						$make = array();
						$returns = $querys->row();
						foreach($para as $dat){
							$make[] = $returns->$dat;
						}
							return $make;
						} else {
							return $result->row();
						}
				}
				//echo $this->db->last_query();
			} else {
				return $result->result_array();
			}
		}

		public function login_user(){
			$eml = $this->input->post('e_mail');
			$ps = $this->input->post('pass_word');
			$re = $this->input->post('l_redirect');
			$this->db->select('user_id');
			$data = $this->db->get_where('users', array('email'=>$eml,'password'=>hash('sha512',$ps), 'status'=>1));
			$count = $data->num_rows();
			if ($count==1) {
				$data1 = $data->row();
				$result['login'] =  $this->db->get_where('users',array('user_id'=>$data1->user_id))->result_array();
				if(!empty($re)){
					$result['redirect'] = $re;
				}
				return $result;
			} else{
				return 2;
			}
		} 
	function login($email,$password)
	 {
		 $password = base64_encode($password);
		 $this->db->select('*'); 
		$this->db->where('email',$email);   
		$this->db->where('password',$password);
		$this->db->where('status','1');
		$query = $this->db->get('admin');  
		$return = $query->num_rows();  
		$count = $return; 
		if($count!="0"){ 
		$return = $query->result_array();
		return $return;
			
		}  
		else{
			return 1;
		}
	 }
	
	public function categorylist(){
		$this->db->select('*'); 
		$query = $this->db->get('category');  
		$return = $query->result_array();
		return $return;
		}
	}
	?>
