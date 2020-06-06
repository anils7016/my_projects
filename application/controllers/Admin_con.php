<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_con extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url','form');
		$this->load->library('session');
		$this->load->model('Admin_model');
		$this->load->library('form_validation');
		// $this->load->library('email');
		// $this->load->library('GCM');
		// $this->load->library('m_pdf');
		// $this->load->library('Ajax_pagination');
	}

	public function login()	{
		$email = $this->input->post("email");
		$password = $this->input->post("password");
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
		$this->form_validation->set_rules("password", "Password", "trim|required");
		if ($this->form_validation->run() == FALSE)	{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
			<span class="alert-inner--text"><strong> Oops ! </strong> Email Or Password Cant Empty ! </span>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
			$this->index();
		} else {
			$usr_result = $this->Admin_model->login($email, $password);
			if (is_array($usr_result)) {
				if($usr_result['table'] == 'admin') {
					$admin = 1;
					foreach($usr_result['data'] as $userdetail) {
						$sessiondata = array(
							'admin_name' => $userdetail['name'],
							'email' => $userdetail['email'],
							'is_admin' => $admin,
							'is_logged_in_admin' => TRUE
						);
						$this->session->set_userdata($sessiondata);
					}
					redirect("admin_con/index");
				} elseif($usr_result['table'] == 'agnc') {
					$admin = 2;
					foreach($usr_result['data'] as $userdetail) {
						$sessiondata = array(
							'agnc_id' => $userdetail['a_id'],
							'admin_name' => $userdetail['a_name'],
							'email' => $userdetail['a_email'],
							'is_admin' => $admin,
							'is_logged_in_admin' => TRUE
						);
						$this->session->set_userdata($sessiondata);
					}
					redirect("admin_con/index");
				} else {
					$admin = 3;
					foreach($usr_result['data'] as $userdetail) {
						$sessiondata = array(
							'frnch_id' => $userdetail['f_id'],
							'admin_name' => $userdetail['f_name'],
							'email' => $userdetail['f_email'],
							'is_admin' => $admin,
							'is_logged_in_admin' => TRUE
						);
						$this->session->set_userdata($sessiondata);
					}
					redirect("admin_con/index");
				}
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong> Oops ! </strong> Email Or Password Was Wrong ! </span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/index');
			}
		}
	}

	public function logout(){
		$this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('admin_name');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('is_admin');
		$this->session->unset_userdata('is_logged_in');
		redirect('admin_con/index');
	}

	public function category(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$this->load->view('admin/header');
			$this->load->view('admin/cat');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function banner(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$this->load->view('admin/header');
			$this->load->view('admin/banner');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function users(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$this->load->view('admin/header');
			$this->load->view('admin/user');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function index(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$this->load->view('admin/header');
			$this->load->view('admin/index');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}
	public function cat_add() {
		if(($this->session->userdata('admin_name')!="")) {
			$this->load->view('admin/header');
			$this->load->view('admin/add_cat');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function ban_add() {
		if(($this->session->userdata('admin_name')!="")) {
			$this->load->view('admin/header');
			$this->load->view('admin/add_ban');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function add_agency() {
		if(($this->session->userdata('admin_name')!="")) {
			$this->load->view('admin/header');
			$this->load->view('admin/add_agency');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function agency() {
		if(($this->session->userdata('admin_name')!="")) {
			$this->load->view('admin/header');
			$this->load->view('admin/agency');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function listing(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$this->load->view('admin/header');
			$this->load->view('admin/listing');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function add_listing(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$this->load->view('admin/header');
			$this->load->view('admin/add_listing');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function setting(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$this->load->view('admin/header');
			$this->load->view('admin/setting');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function cms_view(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$this->load->view('admin/header');
			$this->load->view('admin/page');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function comision(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$this->load->view('admin/header');
			$this->load->view('admin/comision');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function french_add(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$this->load->view('admin/header');
			$this->load->view('admin/add_french');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function agents(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$this->load->view('admin/header');
			$this->load->view('admin/agent');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function states(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$this->load->view('admin/header');
			$this->load->view('admin/state');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function french(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$this->load->view('admin/header');
			$this->load->view('admin/french');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function addcat(){
		if(($this->session->userdata('admin_name')!="")) {
			$title = $this->input->post("page-name");
			$active = $this->input->post("is-active");
			if ($_FILES["logo"]["name"] != '' ) {
				$pathToUpload = '/assets/img/';
				$img1 = $_FILES['logo']['name'];
				$mainimg1 = preg_replace("/[^a-zA-Z0-9.]/", "", $img1);
				$imageurl = base_url().$pathToUpload.$mainimg1;
				$imagepath = upload_url.$pathToUpload.$mainimg1;
				$image = $mainimg1;
				$imagetepath = $_FILES['logo']['tmp_name'];
				move_uploaded_file($imagetepath, $imagepath);
			} else {
				$imageurl = '';
			}

			$usr_result = $this->Admin_model->addcat($title, $active, $imageurl, $id = '');
			if($usr_result == 2) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Category Details Updated Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/cms_view');
			} elseif($usr_result == 1) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Category Sucessfully Added !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/category');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Warning ! </strong> Something Gonna Wrong !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/cms_view');
			}
		} else {
			$this->load->view('admin/login');
		}
	}

	public function addbanner(){
		if(($this->session->userdata('admin_name')!="")) {
			$active = $this->input->post("is-active");
			$id = $this->input->post("ban-id");
			if ($_FILES["logo"]["name"] != '' ) {
				$pathToUpload = '/assets/img/';
				$img1 = $_FILES['logo']['name'];
				$mainimg1 = preg_replace("/[^a-zA-Z0-9.]/", "", $img1);
				$imageurl = base_url().$pathToUpload.$mainimg1;
				$imagepath = upload_url.$pathToUpload.$mainimg1;
				$image = $mainimg1;
				$imagetepath = $_FILES['logo']['tmp_name'];
				move_uploaded_file($imagetepath, $imagepath);
			} else {
				$imageurl = '';
			}
			$usr_result = $this->Admin_model->addbanner($active, $imageurl, $id);
			if($usr_result == 2) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Banner Updated Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/banner');
			} elseif($usr_result == 1) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Banner Sucessfully Added !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/banner');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Warning ! </strong> Something Gonna Wrong !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/banner');
			}
		} else {
			$this->load->view('admin/login');
		}
	}

	public function update_setting() {
		$data = $this->Admin_model->update_setting();
		if($data == 1) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
			<span class="alert-inner--text"><strong>Success !</strong>  setting Updated Sucessfully !</span>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
			redirect('admin/setting');
		}else {
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
			<span class="alert-inner--text"><strong>Warning ! </strong> Something Gonna Wrong !</span>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
			redirect('admin/setting');
		}
	}
	public function user_status()	{
		$para = $this->input->post("sta");
		$page_id = $this->input->post("page");
		$page_data = $this->Admin_model->userstate($page_id,$para);
		if($page_data == 1) {
			if($para == 2) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  This User or Agent is Block Now !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				//redirect('admin_con/users', 'refresh');
			} elseif($para == 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  This Agent is User Now !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				//redirect('admin_con/users', 'refresh');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  This User is now Agent !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			}
			//redirect('admin_con/users', 'refresh');
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
			<span class="alert-inner--text"><strong>Warning ! </strong> Something Gonna Wrong !</span>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
			//redirect('admin_con/users', 'refresh');
		}
	}

	public function update_user()	{$para =2;
		$page_data = $this->Admin_model->userupdate();
		if($page_data == 1) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
			<span class="alert-inner--text"><strong>Success !</strong>  Details Updated Sucessfully !</span>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
			redirect('admin_con/users');
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
			<span class="alert-inner--text"><strong>Warning ! </strong> Something Gonna Wrong !</span>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
			redirect('admin_con/users');
		}
	}

	public function addcmspages(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$title = $this->input->post("page-name");
			$active = $this->input->post("is-active");
			$desc = $this->input->post("lng-desc");
			$pg_id = $this->input->post("page-id");

			$usr_result = $this->Admin_model->addpages($title, $desc, $active, $pg_id);
			if($usr_result == 2) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Page Details Updated Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/cms_view');
			} elseif($usr_result == 1) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Page Created Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/cms_view');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Warning ! </strong> Something Gonna Wrong !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/cms_view');
			}
		} else {
			$this->load->view('admin/login');
		}
	}

	public function addlisting(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$id = $this->input->post('cmp-id');
			if (isset($_FILES["logo"]) && $_FILES["logo"]["name"] != '' ) {
				$pathToUpload = '/assets/company';
				$img1 = $_FILES['logo']['name'];
				$mainimg1 = preg_replace("/[^a-zA-Z0-9.]/", "", $img1);
				$imageurl = base_url().$pathToUpload.$mainimg1;
				$imagepath = upload_url.$pathToUpload.$mainimg1;
				$image = $mainimg1;
				$imagetepath = $_FILES['logo']['tmp_name'];
				echo move_uploaded_file($imagetepath, $imagepath);
			} else {
				$img = $this->input->post('img');
				if(!empty($img)) {$imageurl = $img; } else { $imageurl = base_url().'assets/company/company.png'; }
			}
			$usr_result = $this->Admin_model->add_company($id,$imageurl); //print_r($usr_result);
			if($usr_result == 1) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Add Agency Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/agency');
			} elseif($usr_result == 2) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Agency Details Updated Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/agency');
			} elseif($usr_result ==  4) {
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Warning ! </strong> This Mobile Number Is registered With Another Company. Please Enter Another mobile number!</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/agency');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Warning ! </strong> Something Gonna Wrong !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/agency');
			}
		} else {
			$this->load->view('admin/login');
		}
	}

	public function addstate(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$id = $this->input->post('cmp-id');
			$usr_result = $this->Admin_model->add_state($id); //print_r($usr_result);
			if($usr_result == 1) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  State Added Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/states');
			} elseif($usr_result == 2) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  State Details Updated Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/states');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Warning ! </strong> Something Gonna Wrong !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/agency');
			}
		} else {
			$this->load->view('admin/login');
		}
	}

	public function addagency(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$id = $this->input->post('cmp-id');
			if (isset($_FILES["logo"]) && $_FILES["logo"]["name"] != '' ) {
				$pathToUpload = '/assets/company/';
				$img1 = $_FILES['logo']['name'];
				$mainimg1 = preg_replace("/[^a-zA-Z0-9.]/", "", $img1);
				$imageurl = base_url().'assets/company/'.$mainimg1;
				echo $imagepath = upload_url.$pathToUpload.$mainimg1;
				$image = $mainimg1;
				$imagetepath = $_FILES['logo']['tmp_name'];
				echo move_uploaded_file($imagetepath, $imagepath);
			} else {
				$img = $this->input->post('img');
				// echo $imageurl; exit;
				if(!empty($img)) {$imageurl = $img; } else { $imageurl = base_url().'assets/company/company.png'; }
			}//echo $imageurl; exit;
			$usr_result = $this->Admin_model->add_agency($id,$imageurl); //print_r($usr_result);
			if($usr_result == 1) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Add Listing Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/agency');
			} elseif($usr_result == 2) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Company Details Updated Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/agency');
			} elseif($usr_result ==  4) {
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Warning ! </strong> This Mobile Number Is registered With Another Company. Please Enter Another mobile number!</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/agency');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Warning ! </strong> Something Gonna Wrong !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/agency');
			}
		} else {
			$this->load->view('admin/login');
		}
	}

	public function addfrench(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$id = $this->input->post('cmp-id');
			if (isset($_FILES["logo"]) && $_FILES["logo"]["name"] != '' ) {
				$pathToUpload = '/assets/company/';
				$img1 = $_FILES['logo']['name'];
				$mainimg1 = preg_replace("/[^a-zA-Z0-9.]/", "", $img1);
				$imageurl = base_url().'assets/company/'.$mainimg1;
				$imagepath = upload_url.$pathToUpload.$mainimg1;
				$image = $mainimg1;
				$imagetepath = $_FILES['logo']['tmp_name'];
				move_uploaded_file($imagetepath, $imagepath);
			} else {
				$img = $this->input->post('img');
				// echo $imageurl; exit;
				if(!empty($img)) {$imageurl = $img; } else { $imageurl = base_url().'assets/company/company.png'; }
			}//echo $imageurl; exit;
			$usr_result = $this->Admin_model->add_french($id,$imageurl); //print_r($usr_result);
			if($usr_result == 1) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Add Listing Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/french');
			} elseif($usr_result == 2) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Company Details Updated Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/french');
			} elseif($usr_result ==  4) {
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Warning ! </strong> This Mobile Number Is registered With Another Company. Please Enter Another mobile number!</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/french');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Warning ! </strong> Something Gonna Wrong !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/french');
			}
		} else {
			$this->load->view('admin/login');
		}
	}

	public function aprove(){
		if(($this->session->userdata('admin_name')!="")) {
			$id = $this->input->post("id");
			$para = $this->input->post("para");
			$table = $this->input->post("table");
			$agent = $this->input->post("agent");
			$result = $this->Admin_model->aprv($table,$id,$para,$agent);
			print_r($result);
			if($result == 1) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Listing Was Approved !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				//redirect('Admin_con/questions');
			}if($result == 3) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Payment Successfully Completed !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				//redirect('Admin_con/review');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Answer Was Approved Or Disapproved !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				//$this->answers($para1);
			}
		} else {
			$this->load->view('admin/login');
		}
	}

	public function user_edit($id){
		if(($this->session->userdata('admin_name')!=""))
		{
			$para = array(
				'where'=> "and id = '$id'",
				'table'=>'users',
				'return'=>1
			);
			$page['com'] = $this->Admin_model->getdata($para);
			$this->load->view('admin/header');
			$this->load->view('admin/edit_user', $page);
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function french_edit($id){
		if(($this->session->userdata('admin_name')!=""))
		{
			$para = array(
				'where'=> "and f_id = '$id'",
				'table'=>'franchise',
				'return'=>1
			);
			$page['com'] = $this->Admin_model->getdata($para);
			$this->load->view('admin/header');
			$this->load->view('admin/edit_french', $page);
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function detial_page($tbl,$id){
		if(($this->session->userdata('admin_name')!=""))
		{
			if($tbl == 'agency') {
				$para = array(
					'where'=> "and a_id = '$id'",
					'select'=>'a_name,a_id',
					'table'=>'agency',
					'return'=>1
				);
				$page['com'] = $this->Admin_model->getdata($para);
				$this->load->view('admin/header');
				$this->load->view('admin/detail_agency', $page);
				$this->load->view('admin/footer');
			} elseif($tbl == 'agent') {
				$para = array(
					'where'=> "and agent_id = '$id'",
					'table'=>'manage_case',
					'return'=>1
				);
				$page['com'] = $this->Admin_model->getdata($para);
				$this->load->view('admin/header');
				$this->load->view('admin/detail_agent', $page);
				$this->load->view('admin/footer');
			} elseif($tbl == 'franchise') {
				$para = array(
					'where'=> "and f_id = '$id'",
					'table'=>'franchise',
					'select'=>'f_name,f_id',
					'return'=>1
				);
				$page['com'] = $this->Admin_model->getdata($para);
				$this->load->view('admin/header');
				$this->load->view('admin/detail_french', $page);
				$this->load->view('admin/footer');
			}
		} else {
			$this->load->view('admin/login');
		}
	}

	public function listing_edit($id){
		if(($this->session->userdata('admin_name')!=""))
		{
			$para = array(
				'where'=> "and cmp_id = '$id'",
				'table'=>'listing',
				'return'=>1
			);
			$page['com'] = $this->Admin_model->getdata($para);
			$this->load->view('admin/header');
			$this->load->view('admin/edit_listing', $page);
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}
	public function cms_edit($slug){
		if(($this->session->userdata('admin_name')!=""))
		{
			$para = array(
				'where'=> "and c_slug = '$slug'",
				'table'=>'cms',
				'return'=>1
			);
			$page['com'] = $this->Admin_model->getdata($para);
			$this->load->view('admin/header');
			$this->load->view('admin/edit_page', $page);
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function cat_edit($slug){
		if(($this->session->userdata('admin_name')!=""))
		{
			$para = array(
				'where'=> "and slug = '$slug'",
				'table'=>'category',
				'return'=>1
			);
			$page['com'] = $this->Admin_model->getdata($para);
			$this->load->view('admin/header');
			$this->load->view('admin/edit_cat', $page);
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function ban_edit($id){
		if(($this->session->userdata('admin_name')!=""))
		{
			$para = array(
				'where'=> "and id = '$id'",
				'table'=>'banner',
				'return'=>1
			);
			$page['com'] = $this->Admin_model->getdata($para);
			$this->load->view('admin/header');
			$this->load->view('admin/edit_ban', $page);
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function state_edit($id){
		if(($this->session->userdata('admin_name')!=""))
		{
			$para = array(
				'where'=> "and s_id = '$id'",
				'table'=>'state',
				'return'=>1
			);
			$page['com'] = $this->Admin_model->getdata($para);
			$this->load->view('admin/header');
			$this->load->view('admin/edit_state', $page);
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function agency_edit($id){
		if(($this->session->userdata('admin_name')!=""))
		{
			$para = array(
				'where'=> "and a_id = '$id'",
				'table'=>'agency',
				'return'=>1
			);
			$page['com'] = $this->Admin_model->getdata($para);
			$this->load->view('admin/header');
			$this->load->view('admin/edit_agency', $page);
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}


	public function getcity(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$st = $this->input->post('state');
			$data = $this->Admin_model->get_city($st);
			foreach($data as $city) { ?>
				<option value="<?= $city['c_id']; ?>"><?= $city['c_name']?></option>
			 <?php }
			// print_r($data);exit;
		} else {
			$this->load->view('admin/login');
		}
	}

	public function getfrench(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$st = $this->input->post('state');
			$data = $this->Admin_model->getfrench($st);
			foreach($data as $city) { ?>
				<option value="<?= $city['f_id']; ?>"><?= $city['f_name']?></option>
			 <?php }
			// print_r($data);exit;
		} else {
			$this->load->view('admin/login');
		}
	}

	public function add_students() {
		if(($this->session->userdata('admin_name')!="")) {
			$this->load->view('admin/header');
			$this->load->view('admin/add_students');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function students() {
		if(($this->session->userdata('admin_name')!="")) {
			$this->load->view('admin/header');
			$this->load->view('admin/students');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}
	public function addstudents(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$id = $this->input->post('cmp-id');
			$usr_result = $this->Admin_model->add_studets($id);
			if($usr_result == 1) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Add Student Profile Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/students');
			} elseif($usr_result == 2) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Students profile Updated Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/students');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Warning ! </strong> Something Gonna Wrong !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/students');
			}
		} else {
			$this->load->view('admin/login');
		}
	}

	public function students_edit($id){
		if(($this->session->userdata('admin_name')!=""))
		{
			$para = array(
				'where'=> "and id = '$id'",
				'table'=>'studednts_profile',
				'return'=>1
			);
			$page['com'] = $this->Admin_model->getdata($para);
			$this->load->view('admin/header');
			$this->load->view('admin/edit_students', $page);
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function add_country() {
		if(($this->session->userdata('admin_name')!="")) {
			$this->load->view('admin/header');
			$this->load->view('admin/add_country');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function country() {
		if(($this->session->userdata('admin_name')!="")) {
			$this->load->view('admin/header');
			$this->load->view('admin/country');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function addcountry(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$id = $this->input->post('cmp-id');
			if (isset($_FILES["image"]) && $_FILES["image"]["name"] != '' ) {
				$pathToUpload = '/assets/country/';
				$img1 = $_FILES['image']['name'];
				$mainimg1 = preg_replace("/[^a-zA-Z0-9.]/", "", $img1);
				$imageurl = base_url().'assets/country/'.$mainimg1;
				echo $imagepath = upload_url.$pathToUpload.$mainimg1;
				$image = $mainimg1;
				$imagetepath = $_FILES['image']['tmp_name'];
				echo move_uploaded_file($imagetepath, $imagepath);
			} else {
				$img = $this->input->post('img');
				// echo $imageurl; exit;
				if(!empty($img)) {$imageurl = $img; } else { $imageurl = base_url().'assets/country/country.png'; }
			}//echo $imageurl; exit;
			$usr_result = $this->Admin_model->add_country($id,$imageurl); //print_r($usr_result);
			if($usr_result == 1) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Add Country Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/country');
			} elseif($usr_result == 2) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Country Updated Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/country');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Warning ! </strong> Something Gonna Wrong !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/country');
			}
		} else {
			$this->load->view('admin/login');
		}
	}

	public function country_edit($id){
		if(($this->session->userdata('admin_name')!=""))
		{
			$para = array(
				'where'=> "and id = '$id'",
				'table'=>'country',
				'return'=>1
			);
			$page['com'] = $this->Admin_model->getdata($para);
			$this->load->view('admin/header');
			$this->load->view('admin/edit_country', $page);
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function add_associatecenters() {
		if(($this->session->userdata('admin_name')!="")) {
			$this->load->view('admin/header');
			$this->load->view('admin/add_associatecenters');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function associatecenters() {
		if(($this->session->userdata('admin_name')!="")) {
			$this->load->view('admin/header');
			$this->load->view('admin/associatecenters');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function addassociatecenters(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$id = $this->input->post('cmp-id');
			$imageurl = base_url().'assets/associatesCenters/associates.png';
			/*if (isset($_FILES["image"]) && $_FILES["image"]["name"] != '' ) {
				$pathToUpload = '/assets/associatesCenters/';
				$img1 = $_FILES['image']['name'];
				$mainimg1 = preg_replace("/[^a-zA-Z0-9.]/", "", $img1);
				$imageurl = base_url().'assets/associatesCenters/'.$mainimg1;
				echo $imagepath = upload_url.$pathToUpload.$mainimg1;
				$image = $mainimg1;
				$imagetepath = $_FILES['image']['tmp_name'];
				echo move_uploaded_file($imagetepath, $imagepath);
			} else {
				$img = $this->input->post('img');
				// echo $imageurl; exit;
				if(!empty($img)) {$imageurl = $img; } else { $imageurl = base_url().'assets/associatesCenters/associates.png'; }
			}*/
			if (isset($_FILES["certificate"]) && $_FILES["certificate"]["name"] != '' ) {
				$pathToUpload = '/assets/associatesCenters/';
				$img1 = $_FILES['certificate']['name'];
				$mainimg1 = preg_replace("/[^a-zA-Z0-9.]/", "", $img1);
				$certificateurl = base_url().'assets/associatesCenters/'.$mainimg1;
				echo $imagepath = upload_url.$pathToUpload.$mainimg1;
				$image = $mainimg1;
				$imagetepath = $_FILES['certificate']['tmp_name'];
				echo move_uploaded_file($imagetepath, $imagepath);
			} else {
				$pdf = $this->input->post('cert_pdf');
				// echo $certificateurl; exit;
				if(!empty($pdf)) {$certificateurl = $pdf; } else { $certificateurl = base_url().'assets/associatesCenters/certificate.pdf'; }
			}
			//echo $imageurl; exit;
			$usr_result = $this->Admin_model->add_associatecenters($id,$imageurl,$certificateurl); //print_r($usr_result);
			if($usr_result == 1) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Add Associate details Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/associatecenters');
			} elseif($usr_result == 2) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Associate details Updated Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/associatecenters');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Warning ! </strong> Something Gonna Wrong !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/associatecenters');
			}
		} else {
			$this->load->view('admin/login');
		}
	}

	public function associatecenters_edit($id){
		if(($this->session->userdata('admin_name')!=""))
		{
			$para = array(
				'where'=> "and id = '$id'",
				'table'=>'associate_center_details',
				'return'=>1
			);
			$page['com'] = $this->Admin_model->getdata($para);
			$this->load->view('admin/header');
			$this->load->view('admin/edit_associatecenters', $page);
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function add_office() {
		if(($this->session->userdata('admin_name')!="")) {
			$this->load->view('admin/header');
			$this->load->view('admin/add_office');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function ouroffices() {
		if(($this->session->userdata('admin_name')!="")) {
			$this->load->view('admin/header');
			$this->load->view('admin/ouroffices');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}
	public function addoffice(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$id = $this->input->post('cmp-id');
			$usr_result = $this->Admin_model->add_office($id);
			if($usr_result == 1) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Add Office Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/ouroffices');
			} elseif($usr_result == 2) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Office Updated Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/ouroffices');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Warning ! </strong> Something Gonna Wrong !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/ouroffices');
			}
		} else {
			$this->load->view('admin/login');
		}
	}

	public function office_edit($id){
		if(($this->session->userdata('admin_name')!=""))
		{
			$para = array(
				'where'=> "and id = '$id'",
				'table'=>'our_offices',
				'return'=>1
			);
			$page['com'] = $this->Admin_model->getdata($para);
			$this->load->view('admin/header');
			$this->load->view('admin/edit_office', $page);
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function add_staff() {
		if(($this->session->userdata('admin_name')!="")) {
			$this->load->view('admin/header');
			$this->load->view('admin/add_staff');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function staff() {
		if(($this->session->userdata('admin_name')!="")) {
			$this->load->view('admin/header');
			$this->load->view('admin/staff');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function addstaff(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$id = $this->input->post('cmp-id');
			if (isset($_FILES["image"]) && $_FILES["image"]["name"] != '' ) {
				$pathToUpload = '/assets/staff/';
				$img1 = $_FILES['image']['name'];
				$mainimg1 = preg_replace("/[^a-zA-Z0-9.]/", "", $img1);
				$imageurl = base_url().'assets/staff/'.$mainimg1;
				echo $imagepath = upload_url.$pathToUpload.$mainimg1;
				$image = $mainimg1;
				$imagetepath = $_FILES['image']['tmp_name'];
				echo move_uploaded_file($imagetepath, $imagepath);
			} else {
				$img = $this->input->post('img');
				// echo $imageurl; exit;
				if(!empty($img)) {$imageurl = $img; } else { $imageurl = base_url().'assets/staff/associates.png'; }
			}
			
			//echo $imageurl; exit;
			$usr_result = $this->Admin_model->add_staff($id,$imageurl); //print_r($usr_result);
			if($usr_result == 1) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Add staff Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/staff');
			} elseif($usr_result == 2) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  staff Updated Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/staff');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Warning ! </strong> Something Gonna Wrong !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/staff');
			}
		} else {
			$this->load->view('admin/login');
		}
	}

	public function staff_edit($id){
		if(($this->session->userdata('admin_name')!=""))
		{
			$para = array(
				'where'=> "and id = '$id'",
				'table'=>'staff',
				'return'=>1
			);
			$page['com'] = $this->Admin_model->getdata($para);
			$this->load->view('admin/header');
			$this->load->view('admin/edit_staff', $page);
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	// Experts
	public function add_experts() {
		if(($this->session->userdata('admin_name')!="")) {
			$this->load->view('admin/header');
			$this->load->view('admin/add_experts');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function experts() {
		if(($this->session->userdata('admin_name')!="")) {
			$this->load->view('admin/header');
			$this->load->view('admin/experts');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function addexperts(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$id = $this->input->post('cmp-id');
			if (isset($_FILES["image"]) && $_FILES["image"]["name"] != '' ) {
				$pathToUpload = '/assets/experts/';
				$img1 = $_FILES['image']['name'];
				$mainimg1 = preg_replace("/[^a-zA-Z0-9.]/", "", $img1);
				$imageurl = base_url().'assets/experts/'.$mainimg1;
				echo $imagepath = upload_url.$pathToUpload.$mainimg1;
				$image = $mainimg1;
				$imagetepath = $_FILES['image']['tmp_name'];
				echo move_uploaded_file($imagetepath, $imagepath);
			} else {
				$img = $this->input->post('img');
				// echo $imageurl; exit;
				if(!empty($img)) {$imageurl = $img; } else { $imageurl = base_url().'assets/experts/experts.png'; }
			}//echo $imageurl; exit;
			$usr_result = $this->Admin_model->add_experts($id,$imageurl); //print_r($usr_result);
			if($usr_result == 1) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Add Experet Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/experts');
			} elseif($usr_result == 2) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Experet Updated Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/experts');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Warning ! </strong> Something Gonna Wrong !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/experts');
			}
		} else {
			$this->load->view('admin/login');
		}
	}

	public function experts_edit($id){
		if(($this->session->userdata('admin_name')!=""))
		{
			$para = array(
				'where'=> "and id = '$id'",
				'table'=>'experts',
				'return'=>1
			);
			$page['com'] = $this->Admin_model->getdata($para);
			$this->load->view('admin/header');
			$this->load->view('admin/edit_experts', $page);
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	// connect us
	public function add_connectus() {
		if(($this->session->userdata('admin_name')!="")) {
			$this->load->view('admin/header');
			$this->load->view('admin/add_connectus');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function connectus() {
		if(($this->session->userdata('admin_name')!="")) {
			$this->load->view('admin/header');
			$this->load->view('admin/connectus');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}
	public function addconnectus(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$id = $this->input->post('cmp-id');
			$usr_result = $this->Admin_model->add_connectus($id);
			if($usr_result == 1) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Add Data Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/connectus');
			} elseif($usr_result == 2) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Data Updated Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/connectus');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Warning ! </strong> Something Gonna Wrong !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/connectus');
			}
		} else {
			$this->load->view('admin/login');
		}
	}

	public function connectus_edit($id){
		if(($this->session->userdata('admin_name')!=""))
		{
			$para = array(
				'where'=> "and id = '$id'",
				'table'=>'connect_us',
				'return'=>1
			);
			$page['com'] = $this->Admin_model->getdata($para);
			$this->load->view('admin/header');
			$this->load->view('admin/edit_connectus', $page);
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}	
	// admin module
	
	public function add_admin() {
		if(($this->session->userdata('admin_name')!="")) {
			$this->load->view('admin/header');
			$this->load->view('admin/add_admin');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

	public function admin() {
		if(($this->session->userdata('admin_name')!="")) {
			$this->load->view('admin/header');
			$this->load->view('admin/admin');
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}
	public function addadmin(){
		if(($this->session->userdata('admin_name')!=""))
		{
			$id = $this->input->post('cmp-id');
			$usr_result = $this->Admin_model->add_admin($id);
			if($usr_result == 1) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Admin Created Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/admin');
			} elseif($usr_result == 2) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Admin Updated Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/admin');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Warning ! </strong> Something Gonna Wrong !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('admin_con/admin');
			}
		} else {
			$this->load->view('admin/login');
		}
	}

	public function admin_edit($id){
		if(($this->session->userdata('admin_name')!=""))
		{
			$para = array(
				'where'=> "and admin_id = '$id'",
				'table'=>'admin',
				'return'=>1
			);
			$page['com'] = $this->Admin_model->getdata($para);
			$this->load->view('admin/header');
			$this->load->view('admin/edit_admin', $page);
			$this->load->view('admin/footer');
		} else {
			$this->load->view('admin/login');
		}
	}

    // Export CSV
	public function exportCsvStudents() {
        $storData = array();
	   /*$header = array('Full Name,Education,Completion Year,English Test, Age, Associate Name, Country Name, State Name, City Name,Email, Mobile, WhatsApp No, Created Date'); */
        $metaData[] = array('full_name' => 'FullName', 'education' => 'Education', 'completion_year' => 'CompletionYear', 'english_test' => 'EnglishTest', 'age' => 'Age', 'associate_name' => 'AssociateName', 'country_name' => 'CountryName', 'state_name' => 'StateName', 'city_name' => 'CityName', 'email' => 'Email', 'mobile' => 'Mobile', 'whatsapp_no' => 'WhatsAppNo', 'CreatedDate' => 'created_date');       
        //$this->customer->setStatus(1);
        $usersData = $this->Admin_model->exportCsvStudents();
        foreach($usersData as $key=>$element) {
            $storData[] = array(
                'full_name' => $element['full_name'],
                'education' => $element['education'],
                'completion_year' => $element['completion_year'],
                'english_test' => $element['english_test'],
                'age' => $element['age'],
                'associate_name' => $element['associate_name'],
                'country_name' => $element['country_name'],
                'state_name' => $element['state_name'],
                'city_name' => $element['city_name'],
                'email' => $element['email'],
                'mobile' => $element['mobile'],
                'whatsapp_no' => $element['whatsapp_no'],
                'created_date' => date("d-m-Y",strtotime($element['created_date'])),
            );
        }
        $data = array_merge($metaData,$storData);
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"student-report-".date('d-m-Y').".csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");
        $handle = fopen('php://output', 'w');
        foreach ($data as $data) {
            fputcsv($handle, $data);
        }
            fclose($handle);
        exit;
    }
    
    // Export CSV Associate
	public function exportCsvAssociate() {	
        $storData = array();
        $metaData[] = array('associate_name' => 'AssociateName', 'company_name' => 'CompanyName', 'state_name' => 'SateName', 'city_name' => 'CityName', 'category' => 'Category', 'email' => 'Email', 'mobile' => 'Mobile', 'image' => 'Image',  'certificate' => 'CertificateUrl', 'created_date' => 'CreatedDate');       
        //$this->customer->setStatus(1);
        $usersData = $this->Admin_model->exportCsvAssociate();
        foreach($usersData as $key=>$element) {
            $storData[] = array(
                'associate_name' => $element['associate_name'],
                'company_name' => $element['company_name'],
                'state_name' => $element['state_name'],
                'city_name' => $element['city_name'],
                'email' => $element['email'],
                'category' => $element['category'],
                'mobile' => $element['mobile'],
                'image' => $element['image'],
                'certificate' => $element['certificate'],
                'created_date' => date("d-m-Y",strtotime($element['created_date'])),
            );
        }
        $data = array_merge($metaData,$storData);
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"associate-centers-report-".date('d-m-Y').".csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");
        $handle = fopen('php://output', 'w');
        foreach ($data as $data) {
            fputcsv($handle, $data);
        }
            fclose($handle);
        exit;
    }


    // Export CSV Experts
	public function exportCsvExperts() {
        $storData = array();
        $metaData[] = array('expert_name' => 'ExpertName', 'image' => 'Image', 'created_date' => 'CreatedDate');       
        //$this->customer->setStatus(1);
        $usersData = $this->Admin_model->exportCsvExperts();
        foreach($usersData as $key=>$element) {
            $storData[] = array(
                'expert_name' => $element['expert_name'],
                'image' => $element['image'],
                'created_date' => date("d-m-Y",strtotime($element['created_date'])),
            );
        }
        $data = array_merge($metaData,$storData);
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"experts-report-".date('d-m-Y').".csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");
        $handle = fopen('php://output', 'w');
        foreach ($data as $data) {
            fputcsv($handle, $data);
        }
            fclose($handle);
        exit;
    }    
    
    function delete_single_user()  
  	{  
       $this->Admin_model->delete_single_user($_POST["delete_id"],$_POST["table_name"]);  
       $this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible fade show" role="alert">
				<span class="alert-inner--icon"><i class="ni ni-like-2"></i></span>
				<span class="alert-inner--text"><strong>Success !</strong>  Record Deleted Sucessfully !</span>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');   
  	}


}
?>
