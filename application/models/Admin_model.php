<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class Admin_model extends CI_model {
		public function login($email, $password){
			$password = base64_encode($password);
			$this->db->where("email",$email);
			$this->db->where("password",$password);
			$query=$this->db->get('admin');
			$count = $query->num_rows();
			$return = array();
			if($count == 1){
				$return['table'] = 'admin';
				$return['data'] = $query->result_array(); return $return;
			} else {
				$agncy = $this->db->get_where('agency',array('a_email'=>$email,'password'=>$password))->num_rows();
				if($agncy == 1) {
					 $return['data'] = $this->db->get_where('agency',array('a_email'=>$email,'password'=>$password))->result_array();
					 $return['table'] = 'agnc'; return $return;
				} else {
					$frnch = $this->db->get_where('franchise',array('f_email'=>$email,'password'=>$password))->num_rows();
					if($frnch == 1) {
						$return['data'] = $this->db->get_where('franchise',array('f_email'=>$email,'password'=>$password))->result_array();
						$return['table'] = 'frnc'; return $return;
					} else { return 1; }
				}
			}
		}

		public function addpages($pg_title, $pg_desc, $active, $pg_id){
			if($pg_title != "") {
				if(!empty($pg_id)){
					$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $pg_title)));
					$data=array(
					'c_name'=>$pg_title,
					'c_slug'=>$slug,
					'c_desc'=>$pg_desc,
					'status'=>$active,
					'created_on'=>date('Y-m-d')
					);
					$this->db->where('c_id', $pg_id);
					$this->db->update('cms',$data);
					//echo $this->db->last_query();exit;
					return 2;
				} else {
					$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $pg_title)));
					$data=array(
					'c_name'=>$pg_title,
					'c_slug'=>$slug,
					'c_desc'=>$pg_desc,
					'status'=>1,
					'created_on'=>date('Y-m-d')
					);
					$this->db->insert('cms',$data);
					$returns = $data;
					return 1;
				}
			} else {
				return 3;
			}
		}

		public function userupdate() {
			$name = $this->input->post('name');
			$email = $this->input->post('e-mail');
			$discount = $this->input->post('discount');
			$id = $this->input->post('com-id');
			$frnch = $this->input->post('frnch');
			$agncy = $this->input->post('agncy');
			$data = array('name'=>$name,'email'=>$email,'discount'=>$discount,'agency_id'=>$agncy,'franchise_id'=>$frnch);
			$this->db->where('id',$id);
			return $this->db->update('users',$data);
		}
		public function addcat($pg_title, $active, $imageurl, $pg_id){
			if($pg_title != "") {
				if(!empty($pg_id)){
					$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $pg_title)));
					$data=array(
					'name'=>$pg_title,
					'slug'=>$slug,
					'icon'=>$imageurl,
					'status'=>$active,
					);
					$this->db->where('id', $pg_id);
					$this->db->update('category',$data);
					return 2;
				} else {
					$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $pg_title)));
					$data=array(
						'name'=>$pg_title,
						'slug'=>$slug,
						'icon'=>$imageurl,
						'status'=>1,
					);
					$this->db->insert('category',$data);
					$returns = $data;
					return 1;
				}
			} else {
				return 3;
			}
		}

		public function get_city($para) {
			return $this->db->get_where('city',array('c_state'=>$para))->result_array();
		}

		public function getfrench($para) {
			$this->db->select('f_id,f_name');
			return $this->db->get_where('franchise',array('agency_id'=>$para))->result_array();
		}

		public function update_setting(){
			$role = $this->session->userdata('is_admin');
			if($role == 1) {
				$post = $this->input->post();
				$count = count($post);
				$por[] = $post;
				// echo $count; print_r($por);
				foreach($por as $key => $data) {
				// print_r($data);
				// echo $data['para'][$key];
					$ary = array('s_para'=>$data['para'][$key],'s_desc'=>$data['desc'][$key]);//print_r($ary);
					$this->db->where('s_id',$data['setting'][$key]);
					$this->db->update('setting',$ary);
				} return 1;
			} else {
				$para = $this->input->post('para');
				$setting = $this->input->post('setting');
				$this->db->where('f_id',$setting);
				return $this->db->update('franchise',array('agent_discount'=>$para));
			}
		}
		public function addbanner($active, $imageurl, $pg_id){
			if($imageurl != "") {
				if(!empty($pg_id)){
					$data=array(
					'banner'=>$imageurl,
					'status'=>$active,
					);
					$this->db->where('id', $pg_id);
					$this->db->update('banner',$data);
					return 2;
				} else {
					$data=array(
						'banner'=>$imageurl,
						'status'=>1,
					);
					$this->db->insert('banner',$data);
					$returns = $data;
					return 1;
				}
			} else {
				return 3;
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
			if(array_key_exists('order', $array)){
				if((array_key_exists('order', $array)) && (array_key_exists('order_type', $array))){
					$this->db->order_by($array['order'],$array['order_type']);
				} else {
					$this->db->order_by($array['order']);
				}
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
			if(array_key_exists('query', $array)) {
				$result = $this->db->query($array['query']);
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

		public function getcmspages($para){
			if(!empty($para)){
				$data = array('cp_status' => 1,'cp_id' => $para);
				return $this->db->get_where('cms_pages',$data)->row();
			} else {
				$data = array('cp_status' => 1);
				return $this->db->get_where('cms_pages',$data)->result_array();
			}

		}

		public function getcompanies($para){
			if(!empty($para)){
				$data = array('status' => 1,'cmp_id' => $para);
				return $this->db->get_where('listing_companies',$data)->row();
			} else {
				$data = array('status' => 1);
				return $this->db->get_where('listing_companies',$data)->result_array();
			}

		}

		public function userstate($id,$para){
			if($para == 1) {
				$this->db->select('s_para');
				$balance = $this->db->get_where('setting', array('s_id'=>4,'status'=>1))->row()->s_para;
				$this->db->select('s_para');
				$daily_limit = $this->db->get_where('setting', array('s_id'=>3,'status'=>1))->row()->s_para;
				$role = $this->session->userdata('is_admin');
				if($role == 1) {
					$this->db->select('s_para');
					$a_discount = $this->db->get_where('setting', array('s_id'=>1,'status'=>1))->row()->s_para;
					$data = array('type'=>$para,'balance'=>$balance,'daily_limit'=>$daily_limit,'discount'=>$a_discount);
					$this->db->where('id',$id);
					$this->db->update('users',$data);
				} else {
					$f_id = $this->session->userdata('frnch_id');
					$this->db->select('agent_discount');
					$f_discount = $this->db->get_where('franchise',array('f_id'=>$f_id))->row()->agent_discount;
					$data = array('type'=>$para,'balance'=>$balance,'daily_limit'=>$daily_limit,'discount'=>$f_discount);
					$this->db->where('id',$id);
					$this->db->update('users',$data);
				}
				// $this->db->select('s_para');
		    // $bal = $this->db->get_where('setting', array('s_id'=>4,'status'=>1))->row()->s_para;
				// $this->db->select('s_para');
		    // $limit = $this->db->get_where('setting', array('s_id'=>3,'status'=>1))->row()->s_para;
				// $this->db->select('s_para');
		    // $dis = $this->db->get_where('setting', array('s_id'=>1,'status'=>1))->row()->s_para;
				// $data = array('type'=>$para,'balance'=>$bal,'daily_limit'=>$limit,'discount'=>$dis);

				// $this->db->where('id',$id);
				// $this->db->update('users',$data);
			} else {
				$data = array('type'=>$para,'balance'=>0,'daily_limit'=>0,'discount'=>0);
				$this->db->where('id',$id);
				$this->db->update('users',$data);
			}
			return 1;
		}

		public function aprv($tbl,$id,$actn,$agent){
			if($tbl == 'listing'){
					/* approve listing */
					$this->db->where('cmp_id',$id);
					$data = array('status'=>$actn);
					$this->db->update('listing',$data);
					/* get agent info */
					$this->db->select('balance,daily_limit,commission,discount');
					$main_bal = $this->db->get_where('users', array('id'=>$agent))->row();
					$a_balance = $main_bal->balance;
					$a_limit = $main_bal->daily_limit;
					$a_discount = $main_bal->discount;
					$a_commission = $main_bal->commission;
					/* get commission of franchise or agent */
					$this->db->select('s_para');
					$charge = $this->db->get_where('setting', array('s_id'=>2,'status'=>1))->row()->s_para;
					$commision = $charge - ($charge * ($a_discount / 100));
					$dis_amount = $charge - $commision;
					$this->db->set('commission', "commission+'$dis_amount'", FALSE);
					$this->db->set('balance', "balance-'$charge'", FALSE);
					$this->db->set('daily_limit', 'daily_limit-1', FALSE);
					$this->db->where('id',$agent);
					$this->db->update('users');
					/* agent transaction entry */
					$this->db->select('agency_id,franchise_id');
					$data = $this->db->get_where('users',array('id'=>$agent))->row();
					if(!empty($data->agency_id)) {$agn = $data->agency_id; } else {$agn = 0; }
					if(!empty($data->franchise_id)) {$frn = $data->franchise_id; } else {$frn = 0; }
					$count = $this->db->get_where('manage_case',array('agent_id'=>$agent,'listing_id'=>$id))->num_rows();//echo $this->db->last_query();exit;
					if($count == 1) {
						/* agent transaction entry  update*/
						$count = $this->db->get_where('manage_case',array('agent_id'=>$agent,'listing_id'=>$id))->result_array();
						$data1 = array('listing_id'=>$id,'agency_id'=>$agent,'agency_id'=>$agn,'franchise_id'=>$frn,'created_on'=>date('Y-m-d'),'comission'=>$dis_amount);
						$ary = array('agent_id'=>$agent,'listing_id'=>$id);
						$this->db->where($ary);
						$this->db->update('manage_case',$data1);
					} else {
					/* agent transaction entry insert*/
						$data2 = array('listing_id'=>$id,'agent_id'=>$agent,'agency_id'=>$agn,'franchise_id'=>$frn,'created_on'=>date('Y-m-d'),'comission'=>$dis_amount);
					$this->db->insert('manage_case',$data2);
					}
					/*// $role = $this->session->userdata('is_admin');
				// if($role == 1) {
					// $this->db->select('s_para');
					// $admin_discount = $this->db->get_where('setting', array('s_id'=>1,'status'=>1))->row()->s_para;

						// echo $this->db->last_query();
						// if($admin_discount != $a_discount){
					// } else {
						// $commision = $charge - ($charge * ($admin_discount / 100));
						// $dis_amount = $charge - $commision;
						// $this->db->set('commission', 'commission'+$dis_amount, FALSE);
						// $this->db->set('balance', 'balance'- $charge, FALSE);
						// $this->db->set('daily_limit', 'daily_limit'- 1, FALSE);
						// $this->db->where('id',$agent);
						// $this->db->update('users');
					// }
				// } else {

				// }
				exit;
				// $data = array('listing_id'=>$id,'agency_id'=>$agent,'agency_id'=>$agn,'franchise_id'=>$frn);
				// $this->db->insert('manage_case',$data);

				$this->db->where('cmp_id',$id);
				$data = array('status'=>$actn);
				$this->db->update('listing',$data);
				// echo $this->db->last_query();
				$this->db->select('balance,daily_limit,commission,discount');
				$balance = $this->db->get_where('users', array('id'=>$agent))->row();

				$this->db->select('s_para');
		    $charge = $this->db->get_where('setting', array('s_id'=>2,'status'=>1))->row()->s_para;
				// $this->db->select('s_para');
		    // $dis = $this->db->get_where('setting', array('s_id'=>1,'status'=>1))->row()->s_para;
				// echo $this->db->last_query();
				// print_r($balance);
				$total = $charge - ($charge * ($balance->discount / 100));
		    $dis_amount = $charge - $total;
				$commision = $balance->commission + $dis_amount;
				$final = $balance->balance - $charge;
				$limit = $balance->daily_limit - 1;
				$this->db->where('id', $agent);
				$data1 = array('balance'=>$final,'daily_limit'=>$limit, 'commission'=>$commision);
				$this->db->update('users',$data1);
				// echo $this->db->last_query();*/
					return 1;
			}elseif($tbl == 'manage_case'){
				$this->db->where('m_id',$id);
				$data = array('status'=>$actn);
				$this->db->update('manage_case',$data);
				return 3;
			} else {
				$this->db->where('a_id',$id);
				$data = array('status'=>$actn);
				$this->db->update('answers',$data);
				return 2;
			}
		}

		public function add_company($id,$logo) {
			$mobile = $this->input->post("mobile");
			$title = $this->input->post("com-name");
			$owner = $this->input->post("owner-name");
			$status = $this->input->post("is-active");if(empty($status)){$status = 0;}
			$address = $this->input->post("add");
			$email = $this->input->post("e-mail");
			$lat = $this->input->post("lat");
			$long = $this->input->post("long");
			$category = $this->input->post("category");
			if(!empty($title)){
				if($id == 0) {
					$this->db->where('mobile',$mobile);
					$count = $this->db->get('listing')->num_rows();
					if($count == 0) {
						$data = array(
							'title'=>$title,
							'image'=>$logo,
							'owner'=>$owner,
							'address'=>$address,
							'mobile'=>$mobile,
							'email'=>$email,
							'latitude'=>$lat,
							'longitude'=>$long,
							'created_date'=>date('Y-m-d'),
							'status'=>$status,
							'agent_id'=>0,
							'cat_id'=>$category
							);
							$this->db->insert('listing',$data);
							return 1;
					} else { return 4;}
				} else {
					$data = array(
						'title'=>$title,
						'image'=>$logo,
						'owner'=>$owner,
						'address'=>$address,
						'mobile'=>$mobile,
						'email'=>$email,
						'latitude'=>$lat,
						'longitude'=>$long,
						'status'=>$status,
						'cat_id'=>$category
						);
						$this->db->where('cmp_id',$id);
						$this->db->update('listing',$data);
						return 2;
				}
			} else { return 3; }
		}

		public function add_state($id) {
			$title = $this->input->post("page-name");
			$status = $this->input->post("is-active");if(empty($status)){$status = 0;}
			if(!empty($title)){
				if($id == 0) {
					$data = array(
						's_name'=>$title,
						's_desc'=>$status,
						);
					$this->db->insert('state',$data);
					return 1;
				} else {
					$data = array(
						's_name'=>$title,
						's_desc'=>$status,
						);
						$this->db->where('s_id',$id);
						$this->db->update('state',$data);
						return 2;
				}
			} else { return 3; }
		}

		public function add_agency($id,$logo) {
			$mobile = $this->input->post("mobile");
			$title = $this->input->post("com-name");
			$owner = $this->input->post("owner-name");
			$status = $this->input->post("is-active");
			if(empty($status)){ $status = 0; }
			$address = $this->input->post("add");
			$email = $this->input->post("e-mail");
			$category = $this->input->post("category");
			$discount = $this->input->post("dis");
			if(!empty($discount)){ $discount = $discount; } else {
				$discount = $this->db->get_where('setting',array('s_id'=>5))->row()->s_para;
				}
			$pass = base64_encode($this->input->post("pass"));
			if(!empty($title)){
				if($id == 0) {
					$this->db->where('a_mobile',$mobile);
					$count = $this->db->get('agency')->num_rows();
					if($count == 0) {
						$data = array(
							'a_name'=>$title,
							'image'=>$logo,
							'a_owner'=>$owner,
							'a_address'=>$address,
							'a_mobile'=>$mobile,
							'a_email'=>$email,
							'created_date'=>date('Y-m-d'),
							'status'=>$status,
							'state'=>$category,
							'discount'=>$discount,
							'password'=>$pass
							);
							$this->db->insert('agency',$data);
							return 1;
					} else { return 4;}
				} else {
					$data = array(
						'a_name'=>$title,
						'image'=>$logo,
						'a_owner'=>$owner,
						'a_address'=>$address,
						'a_mobile'=>$mobile,
						'a_email'=>$email,
						'status'=>$status,
						'state'=>$category,
						'discount'=>$discount,
						'password'=>$pass
						);
						$this->db->where('a_id',$id);
						$this->db->update('agency',$data);
						return 2;
				}
			} else { return 3; }
		}

		public function add_french($id,$logo) {
			$mobile = $this->input->post("mobile");
			$title = $this->input->post("com-name");
			$owner = $this->input->post("owner-name");
			$status = $this->input->post("is-active");if(empty($status)){$status = 0;}
			$address = $this->input->post("add");
			$email = $this->input->post("e-mail");
			$category = $this->input->post("category");
			$discount = $this->input->post("dis");
			if(empty($discount)){ $discount = 0; } else {
				$discount = $this->db->get_where('setting',array('s_id'=>6))->row()->s_para;
				}
			$city = $this->input->post("city");
			$agncy = $this->input->post("agncy");
			$pass = base64_encode($this->input->post("pass"));
			if(!empty($title)){
				if($id == 0) {
					$this->db->where('f_mobile',$mobile);
					$count = $this->db->get('franchise')->num_rows();
					if($count == 0) {
					// INSERT INTO `franchise`(`f_id`, `f_name`, `f_address`, `f_owner`, `f_mobile`, `f_email`, `created_date`, `status`, `agency_id`, `state`, `city`, `discount`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12])
						$data = array(
							'f_name'=>$title,
							'image'=>$logo,
							'f_owner'=>$owner,
							'f_address'=>$address,
							'f_mobile'=>$mobile,
							'f_email'=>$email,
							'created_date'=>date('Y-m-d'),
							'status'=>$status,
							'state'=>$category,
							'city'=>$city,
							'discount'=>$discount,
							'agency_id'=>$agncy,
							'password'=>$pass
							);
							$this->db->insert('franchise',$data);
							return 1;
					} else { return 4;}
				} else {
					$data = array(
						'f_name'=>$title,
						'image'=>$logo,
						'f_owner'=>$owner,
						'f_address'=>$address,
						'f_mobile'=>$mobile,
						'f_email'=>$email,
						'status'=>$status,
						'state'=>$category,
						'city'=>$city,
						'discount'=>$discount,
						'agency_id'=>$agncy,
						'password'=>$pass
						);
						$this->db->where('f_id',$id);
						$this->db->update('franchise',$data);
						return 2;
				}
			} else { return 3; }
		}

		public function deltecmspages($para){
			$this->db->where('cp_id',$para)->delete('cms_pages');return 2;
		}

		public function add_studets($id) {
			//print_r($this->input->post()); exit;
			$full_name = $this->input->post("full_name");
			$education = $this->input->post("education");
			$english_test = $this->input->post("english_test");
			$completion_year = $this->input->post("completion_year");
			$status = $this->input->post("is-active");if(empty($status)){$status = 0;}
			$age = $this->input->post("age");
			$email = $this->input->post("email");
			$associate_id = $this->input->post("associate_id");
			$country = $this->input->post("country");
			$state = $this->input->post("state");
			$city = $this->input->post("city");
			$mobile = $this->input->post("mobile");
			$whatsapp_no = $this->input->post("whatsapp_no");
			if(!empty($full_name)){
				if($id == 0) {
						$data = array(
							'full_name'=>$full_name,
							'education'=>$education,
							'english_test'=>$english_test,
							'completion_year'=>$completion_year,
							'age'=>$age,
							'associate_id'=>$associate_id,
							'country'=>$country,
							'state'=>$state,
							'city'=>$city,
							'email'=>$email,
							'mobile'=>$mobile,
							'Whatsapp_no'=>$whatsapp_no,
							'status'=>$status,
							'created_date'=>date('Y-m-d')
							);
						
							$this->db->insert('studednts_profile',$data);
							return 1;
				} else {
					$data = array(
						'full_name'=>$full_name,
						'education'=>$education,
						'english_test'=>$english_test,
						'completion_year'=>$completion_year,
						'age'=>$age,
						'associate_id'=>$associate_id,
						'country'=>$country,
						'state'=>$state,
						'city'=>$city,
						'email'=>$email,
						'mobile'=>$mobile,
						'whatsapp_no'=>$whatsapp_no,
						'status'=>$status
						);
						$this->db->where('id',$id);
						$this->db->update('studednts_profile',$data);
						return 2;
				}
			} else { return 3; }
		}

		public function add_country($id,$image) {
			$name = $this->input->post("name");
			$status = $this->input->post("is-active");if(empty($status)){$status = 0;}
			//if(empty($status)){ $status = 0; }
			if(!empty($name)){
				if($id == 0) {
					$data = array(
					'name'=>$name,
					'image'=>$image,
					'status'=>$status,
					);
					$this->db->insert('country',$data);
					return 1;
				} else {
					$data = array(
						'name'=>$name,
						'image'=>$image,
						'status'=>$status,
						);
						$this->db->where('id',$id);
						$this->db->update('country',$data);
						return 2;
				}
			} else { return 3; }
		}

		public function add_associatecenters($id,$image,$pdf) {
			$associate_name = $this->input->post("associate_name");
			$company_name = $this->input->post("company_name");
			$state = $this->input->post("state");
			$city = $this->input->post("city");
			$associate_category = $this->input->post("associate_category");
			$mobile = $this->input->post("mobile");
			$email = $this->input->post("email");
			$status = $this->input->post("is-active");if(empty($status)){$status = 0;}
			//if(empty($status)){ $status = 0; }
			if(!empty($associate_name)){
				if($id == 0) {
					$data = array(
						'associate_name'=>$associate_name,
						'company_name'=>$company_name,
						'state'=>$state,
						'city'=>$city,
						'category'=>$associate_category,
						'mobile'=>$mobile,
						'email'=>$email,
						'image'=>$image,
						'certificate'=>$pdf,
						'status'=>$status,
						'created_date'=>date('Y-m-d')
						);
						$this->db->insert('associate_center_details',$data);
						return 1;
				} else {
					$data = array(
						'associate_name'=>$associate_name,
						'company_name'=>$company_name,
						'state'=>$state,
						'city'=>$city,
						'category'=>$associate_category,
						'mobile'=>$mobile,
						'email'=>$email,
						'image'=>$image,
						'certificate'=>$pdf,
						'status'=>$status,
						'created_date'=>date('Y-m-d')
						);
						$this->db->where('id',$id);
						$this->db->update('associate_center_details',$data);
						return 2;
				}
			} else { return 3; }
		}

		public function add_office($id) {
			$office_address = $this->input->post("office_address");
			$city = $this->input->post("city");
			$state = $this->input->post("state");
			$office_head = $this->input->post("office_head");
			$status = $this->input->post("is-active");if(empty($status)){$status = 0;}
			$office_phone = $this->input->post("office_phone");
			$office_email = $this->input->post("office_email");
			if(!empty($office_address)){
				if($id == 0) {
					$data = array(
						'office_address'=>$office_address,
						'office_email'=>$office_email,
						'office_phone'=>$office_phone,
						'city'=>$city,
						'state'=>$state,
						'office_head'=>$office_head,
						'status'=>$status,
						'created_date'=>date('Y-m-d')
						);
						$this->db->insert('our_offices',$data);
						return 1;
				} else {
					$data = array(
						'office_address'=>$office_address,
						'state'=>$state,
						'city'=>$city,
						'office_head'=>$office_head,
						'office_email'=>$office_email,
						'office_phone'=>$office_phone,
						'status'=>$status,
						);
						$this->db->where('id',$id);
						$this->db->update('our_offices',$data);
						return 2;
				}
			} else { return 3; }
		}

		public function add_staff($id,$image) {
			$member_name = $this->input->post("member_name");
			$office_id = $this->input->post("office_id");
			$designation = $this->input->post("designation");
			$mobile = $this->input->post("mobile");
			$whatsapp_no = $this->input->post("whatsapp_no");
			$date_of_birth = $this->input->post("date_of_birth");
			$gender = $this->input->post("gender");
			$permanent_address = $this->input->post("permanent_address");
			$about = $this->input->post("about");
			$status = $this->input->post("is-active");if(empty($status)){$status = 0;}
			if(!empty($member_name)){
				if($id == 0) {
					$data = array(
						'member_name'=>$member_name,
						'office_id'=>$office_id,
						'designation'=>$designation,
						'mobile'=>$mobile,
						'whatsapp_no'=>$whatsapp_no,
						'date_of_birth'=>date("Y-m-d",strtotime($date_of_birth)),
						'gender'=>$gender,
						'permanent_address'=>$permanent_address,
						'about'=>$about,
						'image'=>$image,
						'status'=>$status,
						'created_date'=>date('Y-m-d')
						);
						$this->db->insert('staff',$data);
						return 1;
				} else {
					$data = array(
						'member_name'=>$member_name,
						'office_id'=>$office_id,
						'designation'=>$designation,
						'mobile'=>$mobile,
						'whatsapp_no'=>$whatsapp_no,
						'date_of_birth'=>date("Y-m-d",strtotime($date_of_birth)),
						'gender'=>$gender,
						'permanent_address'=>$permanent_address,
						'about'=>$about,
						'image'=>$image,
						'status'=>$status
						);
						$this->db->where('id',$id);
						$this->db->update('staff',$data);
						return 2;
				}
			} else { return 3; }
		}

		// Experts
		public function add_experts($id,$image) {
			$expert_name = $this->input->post("expert_name");
			$status = $this->input->post("is-active");if(empty($status)){$status = 0;}
			//if(empty($status)){ $status = 0; }
			if(!empty($expert_name)){
				if($id == 0) {
					$data = array(
					'expert_name'=>$expert_name,
					'image'=>$image,
					'status'=>$status,
					'created_date'=>date("Y-m-d"),
					);
					$this->db->insert('experts',$data);
					return 1;
				} else {
					$data = array(
						'expert_name'=>$expert_name,
						'image'=>$image,
						'status'=>$status,
						);
						$this->db->where('id',$id);
						$this->db->update('experts',$data);
						return 2;
				}
			} else { return 3; }
		}

		// Coonect us
		public function add_connectus($id) {
			$office_address = $this->input->post("office_address");
			$contact_no = $this->input->post("contact_no");
			$mobile = $this->input->post("mobile");
			$whatsapp_no = $this->input->post("whatsapp_no");
			$email_1 = $this->input->post("email_1");
			$email_2 = $this->input->post("email_2");
			$website = $this->input->post("website");
			$location = $this->input->post("location");
			$status = $this->input->post("is-active");if(empty($status)){$status = 0;}
			//if(empty($status)){ $status = 0; }
			if(!empty($office_address)){
				if($id == 0) {
					$data = array(
					'office_address'=>$office_address,
					'contact_no'=>$contact_no,
					'mobile'=>$mobile,
					'whatsapp_no'=>$whatsapp_no,
					'email_1'=>$email_1,
					'email_2'=>$email_2,
					'website'=>$website,
					'location'=>$location,
					'status'=>$status,
					'created_date'=>date("Y-m-d"),
					);
					$this->db->insert('connect_us',$data);
					return 1;
				} else {
					$data = array(
						'office_address'=>$office_address,
						'contact_no'=>$contact_no,
						'mobile'=>$mobile,
						'whatsapp_no'=>$whatsapp_no,
						'email_1'=>$email_1,
						'email_2'=>$email_2,
						'website'=>$website,
						'location'=>$location,
						'status'=>$status,
						'created_date'=>date("Y-m-d"),
						);
						$this->db->where('id',$id);
						$this->db->update('connect_us',$data);
						return 2;
				}
			} else { return 3; }
		}
		
		//admin module
		// admin create
		public function add_admin($id) {
			$name = $this->input->post("name");
			$email = $this->input->post("email");
			$password = base64_encode($this->input->post("password"));
			$is_admin = 1;
			$status = $this->input->post("is-active");if(empty($status)){$status = 0;}
			if(!empty($name)){
				if($id == 0) {
					$data = array(
						'name'=>$name,
						'email'=>$email,
						'password'=>$password,
						'is_admin'=>$is_admin,
						'status'=>$status,
						);
						$this->db->insert('admin',$data);
						return 1;
				} else {
					$data = array(
						'name'=>$name,
						'email'=>$email,
						'password'=>$password,
						'is_admin'=>$is_admin,
						'status'=>$status,
						);
						$this->db->where('admin_id',$id);
						$this->db->update('admin',$data);
						return 2;
				}
			} else { return 3; }
		}
		
		// export student report	
		public function exportCsvStudents(){
			$response = array();
		    // Select record
		    $this->db->select('s.full_name,s.education,s.completion_year,s.english_test,s.age,a.associate_name,c.name as country_name,state.s_name as state_name,city.c_name as city_name,s.email,s.mobile,s.whatsapp_no,s.created_date')
			         ->from('studednts_profile s')
			         ->join('associate_center_details a', 's.associate_id = a.id','left')
			         ->join('countries c', 's.country = c.id','left')
			         ->join('state', 's.state = state.s_id','left')
			         ->join('city', 's.city = city.c_id','left');
			$qry = $this->db->get();
		    $response = $qry->result_array();
		 	return $response;
		}
		
		// export Associate report	
		public function exportCsvAssociate(){
			$response = array();
		    // Select record
		    $this->db->select('a.associate_name,a.company_name,state.s_name as state_name ,city.c_name as city_name ,a.category,a.mobile,a.email,a.image,a.certificate,a.created_date')
			         ->from('associate_center_details a')
			         ->join('state', 'a.state = state.s_id','left')
			         ->join('city', 'a.city = city.c_id','left');
			$qry = $this->db->get();
		    $response = $qry->result_array();
		 	return $response;
		}
		// export Expert report	
		public function exportCsvExperts(){
			$response = array();
		    // Select record
		    $this->db->select('expert_name, image, created_date')
			         ->from('experts');
			$qry = $this->db->get();
		    $response = $qry->result_array();
		 	return $response;
		}
		// Delete record
		function delete_single_user($delete_id, $table_name)  
      	{  
           if(isset($_POST['field_name'])){
           	 $field_name = $_POST['field_name'];
           }else{
           	 $field_name = "id";
           }
           $this->db->where($field_name, $delete_id); 
           $this->db->delete($table_name);  
           //DELETE FROM users WHERE id = '$user_id'  
      	}  		
  		
		
	}
?>
