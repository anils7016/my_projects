<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {

	 public function __construct()
	{
		parent::__construct();
		$this->load->model('back_model');		
		$this->load->library('email');
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper('url');
	}	
	
	public function index()
	{
		if(($this->session->userdata('admin_name')!=""))
		{
			$this->welcome();
		}
		else{
			$this->login_view();
		}
		
	}
	
	public function login_view()
	{
	   $this->load->view('backend/login');
	}
	
	public function login(){
		$email = $this->input->post("email");
          $password = $this->input->post("password");
		  //$type = $this->input->post("type");

          //set validations
		  $this->form_validation->set_rules("email", "Email", "trim|required|valid_email");
          $this->form_validation->set_rules("password", "Password", "trim|required");
		  //$this->form_validation->set_rules("type", "Type", "trim|required");

          if ($this->form_validation->run() == FALSE)
          {
               //validation fails
               $this->login_view();
          }
          else
          {
					//validation succeeds
					//check if username and password is correct
                    $usr_result = $this->back_model->login($email, $password/*, $type*/);
				
					if (is_array($usr_result)) //active user record is present
                    {
						
						foreach($usr_result as $userdetail)
						{
							$sessiondata = array(
                              'admin_id' => $userdetail['admin_id'],
							  'admin_name' => $userdetail['name'],
							  'email' => $userdetail['email'],
							  'is_admin' => $userdetail['is_admin'],
                              'is_logged_in' => TRUE
                         );                         
						 $this->session->set_userdata($sessiondata);
						 redirect("backend/welcome");
						 }
                    }
                    else
                    {
						 $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid email or password!</div>');
                         redirect('backend/login');
                    }
          }
	}
	
	public function logout(){
		$this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('admin_name');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('is_admin');
		$this->session->unset_userdata('is_logged_in');
		redirect('backend');
	}
	
	public function update_category(){
		$user = $this->back_model->update_category();
		//if((!empty($user)) || $user == 1){
			if($user == 1){
				$this->session->set_flashdata('msg', '<div class="alert alert-success">
	  		<strong>WOW !</strong>Updated Successfully.</div>');
				//print_r($user);exit;
				redirect('backend/category');

		}  else{
			$this->session->set_flashdata('msg', '<div class="alert alert-danger">  <strong>Oops!</strong>Update Failed.</div>');
			redirect('backend/category');
		}
		}
	
	public function edit_category(){
		if(($this->session->userdata('admin_name')!=""))
		{ 
			$id = $this->uri->segment(3);
			$data['data'] = $this->back_model->getcategorybyid($id);
			$this->load->view('backend/header');
			$this->load->view('backend/edit-category', $data);
			$this->load->view('backend/footer');
		}
	else{
		  $this->load->view('login');		   		   
	}
		}
	public function category(){
		if(($this->session->userdata('admin_name')!=""))
		{
		$this->load->view('backend/header');
		$this->load->view('backend/category');
		$this->load->view('backend/footer');
		}
		else{
			$this->login_view();
		}
		}
	public function welcome(){
		if(($this->session->userdata('admin_name')!=""))
		{
		$this->load->view('backend/header');
		$this->load->view('backend/dashboard');
		$this->load->view('backend/footer');
		}
		else{
			$this->login_view();
		}
	}
}
