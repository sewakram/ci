<?php
   defined('BASEPATH') OR exit('No direct script access allowed');

	class Administrator extends CI_Controller{
				public function __construct()
        {
                parent::__construct();
                $this->isUserLoggedin();
        }

        public function isUserLoggedin()
        {
        	if($this->session->userdata('login')) {
				if($this->session->userdata('role') == 3 || empty($this->session->userdata('role')))
				{
					redirect('publisher/dashboard');
				}
			}
        }

		public function view($page = 'index'){
			if($this->session->userdata('login')) {
    			redirect('administrator/dashboard');
   			}

			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
				show_404();
			}
			$data['title'] = ucfirst($page);
			$data['logo']=$this->Administrator_Model->get_siteconfiguration();
			// echo "<pre>";print_r($data);exit;
			$this->load->view('administrator/header-script');
			//$this->load->view('administrator/header');
			//$this->load->view('administrator/index');
			$this->load->view('administrator/'.$page, $data);
			$this->load->view('administrator/footer');
		}

		public function home($page = 'home'){
			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
				show_404();
			}
			$data['title'] = ucfirst($page);
			$data['active'] = 'dashboard';
			$this->load->view('administrator/header-script');
			$this->load->view('administrator/header');
			$this->load->view('administrator/header-bottom', $data);
			$this->load->view('administrator/'.$page, $data);
			$this->load->view('administrator/footer');
		}

		public function dashboard($page = 'dashboard'){
		   if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    show_404();
		   }
		   // print_r($this->session->userdata());die();
		   $data['title'] = ucfirst($page);
		   $data['active'] = 'dashboard';
		   $data['publishers']=$this->Administrator_Model->users_count(3);
		   $data['users']=$this->Administrator_Model->users_count(2);
		   $data['magazines']=$this->Administrator_Model->magazines_count();
		   $data['articalst']=$this->Administrator_Model->articals_totalcount();
		   $data['ordersdata']=$this->Administrator_Model->get_transactions_count();
		   $data['earning']=$this->Administrator_Model->get_earning();
		   // echo "<pre>";print_r($data);exit;
			// echo "<pre>";print_r($data);exit;
			// $data['categories']=$this->Administrator_Model->categories_count();
		   $this->load->view('administrator/header-script');
		   $this->load->view('administrator/header');
		  $this->load->view('administrator/header-bottom', $data);
		   $this->load->view('administrator/'.$page, $data);
		   $this->load->view('administrator/footer');
		}

	 

	  // Log in Admin
		public function adminLogin(){
			$data['title'] = 'Admin Login';

			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() === FALSE){
				//$data['title'] = ucfirst($page);
				$this->load->view('administrator/header-script');
				//$this->load->view('administrator/header');
				//$this->load->view('administrator/header-bottom');
				$this->load->view('administrator/index', $data);
				$this->load->view('administrator/footer');
			}else{
				// get email and Encrypt Password
				$email = $this->input->post('email');
				$encrypt_password = md5($this->input->post('password'));

				$user_id = $this->Administrator_Model->adminLogin($email, $encrypt_password);
				$sitelogo = $this->Administrator_Model->update_siteconfiguration(1);

				if ($user_id && $user_id->role_id == 1) {
					//Create Session
					$user_data = array(
								'user_id' => $user_id->id,
				 				'username' => $user_id->username,
				 				'email' => $user_id->email,
				 				'login' => true,
				 				'role' => $user_id->role_id,
				 				'image' => $user_id->image,
				 				'site_logo' => $sitelogo['logo_img']
				 	);

				 	$this->session->set_userdata($user_data);

					//Set Message
					$this->session->set_flashdata('success', 'Welcome to administrator Dashboard.');
					redirect('administrator/dashboard');
				}else if ($user_id && $user_id->role_id == 3) {
					//Create Session
					$user_data = array(
								'user_id' => $user_id->id,
				 				'username' => $user_id->username,
				 				'email' => $user_id->email,
				 				'login' => true,
				 				'role' => $user_id->role_id,
				 				'image' => $user_id->image,
				 				'site_logo' => $sitelogo['logo_img']
				 	);
					// echo "<pre>"; print_r($user_data);exit;
				 	$this->session->set_userdata($user_data);

					//Set Message
					$this->session->set_flashdata('success', 'Welcome to publisher Dashboard.');
					redirect('publisher/dashboard');
				}else{
					$this->session->set_flashdata('danger', 'Login Credential in invalid!');
					redirect('administrator/index');
				}
				
			}
		}

				// log admin out
		public function logout(){
			// unset user data
			$this->session->unset_userdata('login');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('role_id');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('image');
			$this->session->unset_userdata('site_logo');

			//Set Message
			$this->session->set_flashdata('success', 'You are logged out.');
			redirect(base_url().'administrator/index');
		}

		public function forget_password($page = 'forget-password'){
			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
				show_404();
			}
			$data['title'] = ucfirst($page);
			$this->load->view('administrator/header-script');
			//$this->load->view('administrator/header');
			//$this->load->view('administrator/header-bottom');
			$this->load->view('administrator/'.$page, $data);
			$this->load->view('administrator/footer');
		}

		public function add_publisher($page = 'add-publisher')
		{	

			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    show_404();
		   }
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}

			$data['title'] = 'Create Publisher';
			$data['active'] = 'publisher';
			$data['countrys'] = $this->Administrator_Model->getcountry();
			// echo "<pre>";print_r($data);exit;
			//$data['add-user'] = $this->Administrator_Model->get_categories();

			$this->form_validation->set_rules('firstname', 'First Name', 'required');
			$this->form_validation->set_rules('lastname', 'Last Name', 'required');
			$this->form_validation->set_rules('publisher', 'Company Name', 'required');
			$this->form_validation->set_rules('magNo', 'No of Magazines', 'required');
			$this->form_validation->set_rules('country', 'Country', 'required');
			$this->form_validation->set_rules('address1', 'Address Line', 'required');
			$this->form_validation->set_rules('zip', 'Zip/Postal Code', 'required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			// $this->form_validation->set_rules('email', 'Email', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom', $data);
		   		 $this->load->view('administrator/'.$page, $data);
		  		 $this->load->view('administrator/footer');
			}else{
				
				$ok=$this->Administrator_Model->add_publisher();
				if($ok){
						$this->load->library('email');
						$htmlContent = file_get_contents(APPPATH.'views/publisher/emailtemplate/register_publisher.html');
						$this->email->from($this->config->item('admin_email'), 'Idondza Admin');
						$this->email->to($this->input->post('email'));
						$this->email->subject('Publisher Registration Successfull');
						$variables = array();
						$variables['admin_user'] = $this->input->post('firstname');
						$variables['publi_email'] = $this->input->post('email');
						$variables['publi_pass'] = $this->input->post('password');
						$variables['post_copy_year'] = date('Y');
						$variables['post_sitename'] = 'Idondza';
						foreach($variables as $x => $value) {

						$htmlContent=str_replace($x,$value,$htmlContent);

						}
						$this->email->message($htmlContent);

						// $this->email->send();
						if($this->email->send()){
						$this->session->set_flashdata("success","Email sent successfully."); 
						}else {
						$this->session->set_flashdata("error","Error in sending Email.".$this->email->print_debugger()); exit;
						}
					}
				
				//Set Message
				$this->session->set_flashdata('success', 'User has been created Successfull.');
				redirect('administrator/publishers/list_publisher');
			}
			
		}

		public function add_user($page = 'add-user')
		{
			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    show_404();
		   }
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}

			$data['title'] = 'Create User';

			//$data['add-user'] = $this->Administrator_Model->get_categories();

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('administrator/'.$page, $data);
		  		 $this->load->view('administrator/footer');
			}else{
				//Upload Image
				$config['upload_path'] = './assets/images/users';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload()){
					$errors =  array('error' => $this->upload->display_errors());
					$post_image = 'noimage.jpg';
				}else{
					$data =  array('upload_data' => $this->upload->data());
					$post_image = $_FILES['userfile']['name'];
				}
				$password = md5('Test@123');
				$ok=$this->Administrator_Model->add_user($post_image,$password);
				if($ok){
						$this->load->library('email');
						$htmlContent = file_get_contents(APPPATH.'views/publisher/emailtemplate/register_publisher.html');
						$this->email->from($this->config->item('admin_email'), 'Idondza Admin');
						$this->email->to($this->input->post('email'));
						$this->email->subject('Registration Successfull By Admin');
						$variables = array();
						$variables['admin_user'] = $this->input->post('name');
						$variables['publi_email'] = $this->input->post('email');
						$variables['publi_pass'] = 'Test@123';
						$variables['post_copy_year'] = date('Y');
						$variables['post_sitename'] = 'Idondza';
						$variables['site_logo_img1'] = $this->config->item('logo');
						foreach($variables as $x => $value) {

						$htmlContent=str_replace($x,$value,$htmlContent);

						}
						$this->email->message($htmlContent);

						// $this->email->send();
						if($this->email->send()){
						$this->session->set_flashdata("success","Email sent successfully."); 
						}else {
						$this->session->set_flashdata("danger","Error in sending Email.".$this->email->print_debugger()); exit;
						}
				}

				//Set Message
				$this->session->set_flashdata('success', 'User has been created Successfull.');
				redirect('administrator/users');
			}
			
		}

		// Check user name exists
		public function check_username_exists($username){
			$this->form_validation->set_message('check_username_exists', 'That username is already taken, Please choose a different one.');

			if ($this->User_Model->check_username_exists($username)) {
				return true;
			}else{
				return false;
			}
		}


		// Check Email exists
		public function check_email_exists($email){
			$this->form_validation->set_message('check_email_exists', 'This email is already registered.');

			if ($this->User_Model->check_email_exists($email)) {
				return true;
			}else{
				return false;
			}
		}

		public function list_publisher($offset = 0)
		{
			// Pagination Config
			$config['base_url'] = base_url(). 'administrator/publishers/list_publisher/';
			$config['total_rows'] = $this->db->count_all('users');
			$config['per_page'] = 3;
			$config['uri_segment'] = 3;
			$config['attributes'] = array('class' => 'paginate-link');
			
			// Init Pagination
			$this->pagination->initialize($config);

			$data['title'] = 'Latest Publisher';
			$data['active'] = 'publisher';
			$data['publishers'] = $this->Administrator_Model->get_publishers(FALSE, false, false);

				// echo "<pre>";print_r($data);exit;
			 	$this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom', $data);
		   		 $this->load->view('administrator/list-publisher', $data);
		  		$this->load->view('administrator/footer');
		}

		public function users($offset = 0)
		{
			// Pagination Config
			$config['base_url'] = base_url(). 'administrator/users/';
			$config['total_rows'] = $this->db->count_all('users');
			$config['per_page'] = 3;
			$config['uri_segment'] = 3;
			$config['attributes'] = array('class' => 'paginate-link');

			// Init Pagination
			$this->pagination->initialize($config);

			$data['title'] = 'Latest Users';
			$data['active'] = 'users';
			$data['users'] = $this->Administrator_Model->get_users(FALSE, FALSE, false);

			 	$this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		$this->load->view('administrator/header-bottom', $data);
		   		 $this->load->view('administrator/users', $data);
		  		$this->load->view('administrator/footer');
		}

		public function delpub($id)
		{
			
			//$table = $this->input->post('table');
			$this->Administrator_Model->deletepub($id);       
			$this->session->set_flashdata('success', 'Data has been deleted Successfully.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}

		public function delete($id)
		{
			$table = base64_decode($this->input->get('table'));
			//$table = $this->input->post('table');
			if($table == 'issues'){
					$magazines = $this->Administrator_Model->get_single_issue($id);		
					unlink(FCPATH.'assets/images/magzines/cover/'.$magazines['cover']);		
					$preview_magazine = explode(', ', $magazines['preview']);		
						for($i = 0; $i < count($preview_magazine); $i++){		
							unlink(FCPATH.'assets/images/magzines/preview/'.$preview_magazine[$i]);		
						}		
					$paid_magazine = explode(', ', $magazines['paid']);		
						for($i = 0; $i < count($paid_magazine); $i++){		
							unlink(FCPATH.'assets/images/magzines/paid_magzine/'.$paid_magazine[$i]);		
					}
			}

			if($table == 'posts')
			{
				$post = $this->Administrator_Model->get_single_post($id);
				unlink(FCPATH.'assets/images/posts/'.$post['post_image']);	
			}

			if($table == 'add_magazines')		
			{		
				$issues = $this->Administrator_Model->get_single_issue_by_mid($id);

				 // echo "<pre>";print_r(sizeof($issues));die();
				if(sizeof($issues)>0){
					$this->session->set_flashdata('danger', 'Please deleted issues.');
					header('Location: ' . $_SERVER['HTTP_REFERER']);
						// $magazines = $this->Administrator_Model->get_single_magazines($id);		
						// unlink(FCPATH.'assets/images/magzines/cover/'.$magazines['cover']);		
						// $preview_magazine = explode(', ', $magazines['preview']);		
						// for($i = 0; $i < count($preview_magazine); $i++){		
						// unlink(FCPATH.'assets/images/magzines/preview/'.$preview_magazine[$i]);		
						// }		
						// $paid_magazine = explode(', ', $magazines['paid']);		
						// for($i = 0; $i < count($paid_magazine); $i++){		
						// unlink(FCPATH.'assets/images/magzines/paid_magzine/'.$paid_magazine[$i]);		
						// }
				}
				else{
					$this->Administrator_Model->delete($id,$table);       
					$this->session->set_flashdata('success', 'Data has been deleted Successfully.');
					header('Location: ' . $_SERVER['HTTP_REFERER']);
				}
						
			}else{
				$this->Administrator_Model->delete($id,$table);       
				$this->session->set_flashdata('success', 'Data has been deleted Successfully.');
				header('Location: ' . $_SERVER['HTTP_REFERER']);
			}
			
		}
		public function enable($id)
		{
			$table = base64_decode($this->input->get('table'));
			//$table = $this->input->post('table');
			$ok=$this->Administrator_Model->enable($id,$table);   
			if($table=='users' && $ok==1)
			{
						$single=$this->Administrator_Model->get_user($id);
						
						$this->load->library('email');
						$htmlContent = file_get_contents(APPPATH.'views/publisher/emailtemplate/active.html');
						$this->email->from($this->config->item('admin_email'), 'Idondza Admin');
						$this->email->to($single['email']);
						$this->email->subject('Account Activated!');
						$variables = array();

						$variables['admin_user'] = $single['name'];

						$variables['post_siteemail'] = $this->config->item('admin_email');
						$variables['post_copy_year'] = date('Y');
						$variables['post_sitename'] = 'Idondza';
						foreach($variables as $x => $value) {

						$htmlContent=str_replace($x,$value,$htmlContent);

						}
						$this->email->message($htmlContent);

						// $this->email->send();
						if($this->email->send()){
						$this->session->set_flashdata("success","Email sent successfully."); 
						}else {
						$this->session->set_flashdata("error","Error in sending Email.".$this->email->print_debugger()); exit;
						}
				}     
			$this->session->set_flashdata('success', 'Desabled Successfully.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		public function desable($id)
		{
			$table = base64_decode($this->input->get('table'));
			//$table = $this->input->post('table');
			$ok=$this->Administrator_Model->desable($id,$table);
			// print_r($ok);die();
			if($table=='users' && $ok==1)
			{
						$single=$this->Administrator_Model->get_user($id);
						
						$this->load->library('email');
						$htmlContent = file_get_contents(APPPATH.'views/publisher/emailtemplate/desible.html');
						$this->email->from($this->config->item('admin_email'), 'Idondza Admin');
						$this->email->to($single['email']);
						$this->email->subject('Account Suspended');
						$variables = array();

						$variables['admin_user'] = $single['name'];

						$variables['post_siteemail'] = $this->config->item('admin_email');
						$variables['post_copy_year'] = date('Y');
						$variables['post_sitename'] = 'Idondza';
						foreach($variables as $x => $value) {

						$htmlContent=str_replace($x,$value,$htmlContent);

						}
						$this->email->message($htmlContent);

						// $this->email->send();
						if($this->email->send()){
						$this->session->set_flashdata("success","Email sent successfully."); 
						}else {
						$this->session->set_flashdata("error","Error in sending Email.".$this->email->print_debugger()); exit;
						}
				}       
			$this->session->set_flashdata('success', 'Enabled Successfully.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}

		public function update_user($id = NULL)
		{
			$data['user'] = $this->Administrator_Model->get_user($id);
			
			if (empty($data['user'])) {
				show_404();
			}
			$data['title'] = 'Update User';

			$this->load->view('administrator/header-script');
	 	 	 $this->load->view('administrator/header');
	  		 $this->load->view('administrator/header-bottom');
	   		 $this->load->view('administrator/update-user', $data);
	  		$this->load->view('administrator/footer');
		}

		public function update_publisher($id = NULL)
		{
			$data['publisher'] = $this->Administrator_Model->get_publisher($id);
			// echo "<pre>";print_r($data);exit;
			if (empty($data['publisher'])) {
				show_404();
			}
			$data['title'] = 'Update publisher';
			$data['active'] = 'publisher';
			$data['countrys'] = $this->Administrator_Model->getcountry();
			$this->load->view('administrator/header-script');
	 	 	 $this->load->view('administrator/header');
	  		 $this->load->view('administrator/header-bottom', $data);
	   		 $this->load->view('administrator/update-publisher', $data);
	  		$this->load->view('administrator/footer');
		}

		public function view_publisher($id = NULL)
		{
			$data['publisher'] = $this->Administrator_Model->get_publisher($id);
			// echo "<pre>";print_r($data);exit;
			if (empty($data['publisher'])) {
				show_404();
			}
			$data['title'] = 'View publisher';
			$data['active'] = 'publisher';
			$data['countrys'] = $this->Administrator_Model->getcountry();
			$this->load->view('administrator/header-script');
			$this->load->view('administrator/header');
			$this->load->view('administrator/header-bottom', $data);
			$this->load->view('administrator/view-publisher', $data);
			$this->load->view('administrator/footer');
		}

		public function update_publisher_data($page = 'update-publisher')
		{
			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    show_404();
		   }
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}

			$data['title'] = 'Update Publisher';
			$data['active'] = 'publisher';
			// $data['add-user'] = $this->Administrator_Model->get_categories();

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('publisher', 'Company Name', 'required');
			$this->form_validation->set_rules('magNo', 'No of Magazines', 'required');
			$this->form_validation->set_rules('country', 'Country', 'required');
			$this->form_validation->set_rules('contact', 'Contact Number', 'required');
			$this->form_validation->set_rules('address', 'Address', 'required');
			$this->form_validation->set_rules('hear', 'How did you hear about us', 'required');
			$this->form_validation->set_rules('zipcode', 'Zip/Postal Code', 'required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom', $data);
		   		 $this->load->view('administrator/'.$page, $data);
		  		 $this->load->view('administrator/footer');
			}else{
				//Upload Image
				
				// $config['upload_path'] = './assets/images/users';
				// $config['allowed_types'] = 'gif|jpg|png|jpeg';
				// $config['max_size'] = '2048';
				// $config['max_width'] = '2000';
				// $config['max_height'] = '2000';

				// $this->load->library('upload', $config);

				// if(!$this->upload->do_upload()){
				// 	$id = $this->input->post('id');
				// 	$data['img'] = $this->Administrator_Model->get_user($id);
				// 	$errors =  array('error' => $this->upload->display_errors());
				// 	$post_image = $data['img']['image'];
				// }else{
				// 	$data =  array('upload_data' => $this->upload->data());
				// 	$post_image = $_FILES['userfile']['name'];
				// }

				$this->Administrator_Model->update_publisher_data();

				//Set Message
				$this->session->set_flashdata('success', 'User has been Updated Successfull.');
				redirect('administrator/publishers/list_publisher');
			}
			
		}

		public function update_user_data($page = 'update-user')
		{
			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    show_404();
		   }
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}

			$data['title'] = 'Update User';

			//$data['add-user'] = $this->Administrator_Model->get_categories();

			$this->form_validation->set_rules('name', 'Name', 'required');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('administrator/'.$page, $data);
		  		 $this->load->view('administrator/footer');
			}else{
				//Upload Image
				
				$config['upload_path'] = './assets/images/users';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload()){
					$id = $this->input->post('id');
					$data['img'] = $this->Administrator_Model->get_user($id);
					$errors =  array('error' => $this->upload->display_errors());
					$post_image = $data['img']['image'];
				}else{
					$data =  array('upload_data' => $this->upload->data());
					$post_image = $_FILES['userfile']['name'];
				}

				$this->Administrator_Model->update_user_data($post_image);

				//Set Message
				$this->session->set_flashdata('success', 'User has been Updated Successfull.');
				redirect('administrator/users');
			}
			
		}


		public function create_product_category()
		{
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}
			
			$data['title'] = 'Create Category';
			$data['active'] = 'category';
			$this->form_validation->set_rules('name', 'Category Name', 'required');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom', $data);
		   		 $this->load->view('administrator/add-product-category', $data);
		  		 $this->load->view('administrator/footer');
			}else{
				$this->Administrator_Model->create_product_category();

				//Set Message
				$this->session->set_flashdata('category_created', 'Your category has been created.');
				redirect('administrator/magazine-categories');
			}
		}
		public function product_categories()
		{
			$data['title'] = 'Product Categories';
			$data['active'] = 'category';
			$data['product_categories'] = $this->Administrator_Model->product_categories();

			 	$this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom', $data);
		   		 $this->load->view('administrator/product-categories', $data);
		  		 $this->load->view('administrator/footer');
		}

		public function update_product_category($id = NULL)
		{

			$data['productcategory'] = $this->Administrator_Model->update_product_category($id);
			// print_r($data['productcategory']);exit;
			
			if (empty($data['productcategory'])) {
				show_404();
			}
			$data['title'] = 'Update Product Category';
			$data['active'] = 'category';
			$this->load->view('administrator/header-script');
	 	 	 $this->load->view('administrator/header');
	  		 $this->load->view('administrator/header-bottom', $data);
	   		 $this->load->view('administrator/update-product-category', $data);
	  		$this->load->view('administrator/footer');
		}

		public function update_product_category_data()
		{
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}
			$data['title'] = 'Update Product Category';
			$this->form_validation->set_rules('name', 'Category Name', 'required');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('administrator/update-product-category', $data);
		  		 $this->load->view('administrator/footer');
			}else{
				$this->Administrator_Model->update_product_category_data();

				//Set Message
				$this->session->set_flashdata('success', 'Your category has been Updated Successfully.');
				redirect('administrator/magazine-categories');
			}
		}

		public function create_product($page = 'add-product')
		{
			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    show_404();
		   }
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}

			$data['product_categories'] = $this->Administrator_Model->product_categories();
			
			$data['title'] = 'Create Product';

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('sku', 'SKU', 'required|callback_check_sku_exists');
			$this->form_validation->set_rules('price', 'Price', 'required');
			if (empty($_FILES['userfile']['name'])){
    		$this->form_validation->set_rules('userfile', 'Document', 'required');
			}
			$this->form_validation->set_rules('description', 'Product Description', 'required');
			$this->form_validation->set_rules('quantity', 'Quantity', 'required');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('administrator/'.$page, $data);
		  		 $this->load->view('administrator/footer');
			}else{
				//Upload Image
				$config['upload_path'] = './assets/images/products';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload()){
					$errors =  array('error' => $this->upload->display_errors());
					$post_image = 'noimage.jpg';
				}else{
					$data =  array('upload_data' => $this->upload->data());
					$post_image = $_FILES['userfile']['name'];
				}
				$dataID = $this->Administrator_Model->create_product($post_image);

				//$dataID = 1; 
				if (!empty($_FILES['imgFiles']['name'])){
				$multipleUpload =  $this->multipleImageUpload($_FILES['imgFiles'],$dataID);
				}
				//Set Message
				$this->session->set_flashdata('success', 'Product has been Added Successfull.');
				redirect('administrator/products');
			}
			
		}

	public function multipleImageUpload($images,$dataID){
		$images == $_FILES['imgFiles'];
        $data = array();
        if(!empty($_FILES['imgFiles']['name'])){
            $filesCount = count($_FILES['imgFiles']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['userFile']['name'] = $_FILES['imgFiles']['name'][$i];
                $_FILES['userFile']['type'] = $_FILES['imgFiles']['type'][$i];
                $_FILES['userFile']['tmp_name'] = $_FILES['imgFiles']['tmp_name'][$i];
                $_FILES['userFile']['error'] = $_FILES['imgFiles']['error'][$i];
                $_FILES['userFile']['size'] = $_FILES['imgFiles']['size'][$i];

                $uploadPath = './assets/images/products_multiple/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'gif|jpg|png';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('userFile')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                     $uploadData[$i]['product_id'] = $dataID;
                   /* $uploadData[$i]['created'] = date("Y-m-d H:i:s");
                    $uploadData[$i]['modified'] = date("Y-m-d H:i:s");*/
                }
            }
            
            if(!empty($uploadData)){
                //Insert file information into the database
                $insert = $this->Administrator_Model->insertproductsmultipleImages($uploadData);
                return $insert;
               /* $statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
                $this->session->set_flashdata('success',$statusMsg);*/
            }
        }
    }
		// Check Product SKU  exists
		public function check_sku_exists($sku){
			$this->form_validation->set_message('check_sku_exists', 'That SKU is already taken, Please choose a different one.');

			if ($this->Administrator_Model->check_sku_exists($sku)) {
				return true;
			}else{
				return false;
			}
		}

		public function get_products()
		{
			$data['products'] = $this->Administrator_Model->get_products();
			
			if (empty($data['products'])) {
				show_404();
			}
			$data['title'] = 'List products';

			$this->load->view('administrator/header-script');
	 	 	 $this->load->view('administrator/header');
	  		 $this->load->view('administrator/header-bottom');
	   		 $this->load->view('administrator/products', $data);
	  		$this->load->view('administrator/footer');
		}

		public function update_products($id = NULL)
		{
			$data['product_categories'] = $this->Administrator_Model->product_categories();
			$data['productsDetails'] = $this->Administrator_Model->update_products($id);
			$productId = $data['productsDetails']['id'];
			$data['productImages'] = $this->Administrator_Model->product_images($productId);
			
			if (empty($data['productsDetails'])) {
				show_404();
			}
			$data['title'] = 'Update Details';

			$this->load->view('administrator/header-script');
	 	 	 $this->load->view('administrator/header');
	  		 $this->load->view('administrator/header-bottom');
	   		 $this->load->view('administrator/update-products', $data);
	  		$this->load->view('administrator/footer');
		}


		public function update_products_data($page = 'update-product')
		{

			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    show_404();
		   }
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}
			$data['title'] = 'Update Product';

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('price', 'Price', 'required');
			$this->form_validation->set_rules('description', 'Product Description', 'required');
			$this->form_validation->set_rules('quantity', 'Quantity', 'required');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('administrator/'.$page, $data);
		  		 $this->load->view('administrator/footer');

			}else{
				//Upload Image
				$config['upload_path'] = './assets/images/products';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload()){
					$errors =  array('error' => $this->upload->display_errors());
					$data['productsDetails'] = $this->Administrator_Model->update_products($this->input->post('id'));
					$post_image = $data['productsDetails']['image'];
				}else{
					$data =  array('upload_data' => $this->upload->data());
					$post_image = $_FILES['userfile']['name'];
				}
				$dataID = $this->Administrator_Model->update_products_data($post_image);

				//$dataID = 1; 
				if (!empty($_FILES['imgFiles']['name'])){
				$multipleUpload =  $this->multipleImageUpload($_FILES['imgFiles'],$this->input->post('id'));
				}
				//Set Message
				$this->session->set_flashdata('success', 'Product has been Updated Successfull.');
				redirect('administrator/products');
			}
		}

		public function create_faq_category()
		{
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}

			$data['title'] = 'Create FAQ Category';
			$this->form_validation->set_rules('name', 'FAQ Category Name', 'required');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('administrator/add-faq-category', $data);
		  		 $this->load->view('administrator/footer');
			}else{
				$this->Administrator_Model->create_faq_category();
				//Set Message
				$this->session->set_flashdata('success', 'category has been created successfully.');
				redirect('administrator/faq-categories');
			}
		}
		public function faq_categories()
		{
			$data['title'] = 'FAQ Categories';
			$data['faq_categories'] = $this->Administrator_Model->faq_categories();

			 	$this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('administrator/faq-categories', $data);
		  		 $this->load->view('administrator/footer');
		}

		public function update_faq_category($id = NULL)
		{

			$data['faqcategory'] = $this->Administrator_Model->update_faq_category($id);

			$data['title'] = 'Update FAQ Category';

			$this->load->view('administrator/header-script');
	 	 	 $this->load->view('administrator/header');
	  		 $this->load->view('administrator/header-bottom');
	   		 $this->load->view('administrator/update-faq-category', $data);
	  		$this->load->view('administrator/footer');
		}

		public function update_faq_category_data()
		{
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}
			$data['title'] = 'Update FAQ Category';
			$this->form_validation->set_rules('name', 'Category Name', 'required');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('administrator/update-faq-category', $data);
		  		 $this->load->view('administrator/footer');
			}else{
				$this->Administrator_Model->update_faq_category_data();
				//Set Message
				$this->session->set_flashdata('success', 'Your category has been Updated Successfully.');
				redirect('administrator/faq-categories');
			}
		}

		//########################## functions start of faq ##############################

		public function create_faq($page = 'add-faq')
		{
			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    show_404();
		   }
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}

			$data['faq_categories'] = $this->Administrator_Model->faq_categories();
			
			$data['title'] = 'Create FAQ';

			$this->form_validation->set_rules('question', 'Question', 'required');
			$this->form_validation->set_rules('answer', 'Answer', 'required');
			$this->form_validation->set_rules('faq_cat_id', 'FAQ Category Name', 'required');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('administrator/'.$page, $data);
		  		 $this->load->view('administrator/footer');
			}else{
				 $this->Administrator_Model->create_faq();
				//Set Message
				$this->session->set_flashdata('success', 'FAQ has been Added Successfull.');
				redirect('administrator/faqs');
			}
			
		}

	

		public function get_faqs($page = 'faqs')
		{
			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    	show_404();
		   	}

			$data['faqs'] = $this->Administrator_Model->get_faqs();

			$data['title'] = 'List FAQS';

			$this->load->view('administrator/header-script');
	 	 	$this->load->view('administrator/header');
	  		$this->load->view('administrator/header-bottom');
	   		$this->load->view('administrator/faqs', $data);
	  		$this->load->view('administrator/footer');
		}

		public function update_faqs($id = NULL)
		{
			$data['faq_categories'] = $this->Administrator_Model->faq_categories();
			$data['faqsDetails'] = $this->Administrator_Model->update_faqs($id);
			
			$data['title'] = 'Update Details';

			$this->load->view('administrator/header-script');
	 	 	$this->load->view('administrator/header');
	  		$this->load->view('administrator/header-bottom');
	   		$this->load->view('administrator/update-faqs', $data);
	  		$this->load->view('administrator/footer');
		}


		public function update_faqs_data($page = 'update-faqs')
		{

			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    show_404();
		   }
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}
			$data['title'] = 'Update faq';

			$this->form_validation->set_rules('question', 'Question', 'required');
			$this->form_validation->set_rules('answer', 'Answer', 'required');
			$this->form_validation->set_rules('faq_cat_id', 'FAQ Category Name', 'required');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('administrator/'.$page, $data);
		  		 $this->load->view('administrator/footer');
			}else{
				
				 $this->Administrator_Model->update_faq_data();
				//Set Message
				$this->session->set_flashdata('success', 'FAQ has been Updated Successfull.');
				redirect('administrator/faqs');
			}
		}

		//sco pages start
		public function get_scopages($page = 'scopages')
		{
			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    	show_404();
		   	}

			$data['scopages'] = $this->Administrator_Model->get_scopages();

			$data['title'] = 'List SCO pages';

			$this->load->view('administrator/header-script');
	 	 	$this->load->view('administrator/header');
	  		$this->load->view('administrator/header-bottom');
	   		$this->load->view('administrator/scopages', $data);
	  		$this->load->view('administrator/footer');
		}

		public function update_scopages($id = NULL)
		{
			$data['scopages'] = $this->Administrator_Model->update_scopages($id);
			
			$data['title'] = 'Update Details';

			$this->load->view('administrator/header-script');
	 	 	$this->load->view('administrator/header');
	  		$this->load->view('administrator/header-bottom');
	   		$this->load->view('administrator/update-scopages', $data);
	  		$this->load->view('administrator/footer');
		}


		public function update_scopages_data($page = 'update-scopages')
		{

			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    show_404();
		   }
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}
			$data['title'] = 'Update SCO Details';

			$this->form_validation->set_rules('title', 'Title', 'required');
			/*$this->form_validation->set_rules('answer', 'Answer', 'required');
			$this->form_validation->set_rules('faq_cat_id', 'FAQ Category Name', 'required');*/

			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('administrator/'.$page, $data);
		  		 $this->load->view('administrator/footer');
			}else{
				
				 $this->Administrator_Model->update_scopages_data();
				//Set Message
				$this->session->set_flashdata('success', 'SCO Details has been Updated Successfull.');
				redirect('administrator/scopages');
			}
		}

		//social links
		public function get_sociallinks($page = 'sociallinks')
		{
			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    	show_404();
		   	}

			$data['sociallinks'] = $this->Administrator_Model->get_sociallinks();

			$data['title'] = 'sociallinks';

			$this->load->view('administrator/header-script');
	 	 	$this->load->view('administrator/header');
	  		$this->load->view('administrator/header-bottom');
	   		$this->load->view('administrator/sociallinks', $data);
	  		$this->load->view('administrator/footer');
		}

		public function update_sociallinks($id = NULL)
		{
			$data['sociallinks'] = $this->Administrator_Model->update_sociallinks($id);
			
			$data['title'] = 'Update sociallinks';

			$this->load->view('administrator/header-script');
	 	 	$this->load->view('administrator/header');
	  		$this->load->view('administrator/header-bottom');
	   		$this->load->view('administrator/update-sociallinks', $data);
	  		$this->load->view('administrator/footer');
		}


		public function update_sociallinks_data($page = 'update-sociallinks')
		{

			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    show_404();
		   }
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}
			$data['title'] = 'Update sociallinks';

			$this->form_validation->set_rules('link', 'Link', 'required');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('administrator/'.$page, $data);
		  		 $this->load->view('administrator/footer');
			}else{
				
				 $this->Administrator_Model->update_sociallinks_data();
				//Set Message
				$this->session->set_flashdata('success', 'sociallinks Details has been Updated Successfull.');
				redirect('administrator/sociallinks');
			}
		}


		// sliders
		public function create_slider($page = 'add-slider')
		{
			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    show_404();
		   }
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}

			$data['title'] = 'Create Sliders Image';

			//$data['add-user'] = $this->Administrator_Model->get_categories();

			$this->form_validation->set_rules('title', 'Title', 'required');
			if (empty($_FILES['userfile']['name'])){
    		$this->form_validation->set_rules('userfile', 'Document', 'required');
			}

			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('administrator/'.$page, $data);
		  		 $this->load->view('administrator/footer');
			}else{
				//Upload Image
				$config['upload_path'] = './assets/images/sliders';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload()){
					$errors =  array('error' => $this->upload->display_errors());
					$post_image = 'noimage.jpg';
				}else{
					$data =  array('upload_data' => $this->upload->data());
					$post_image = $_FILES['userfile']['name'];
				}
				$this->Administrator_Model->create_slider($post_image);

				//Set Message
				$this->session->set_flashdata('success', 'Slider Image has been created Successfull.');
				redirect('administrator/sliders');
			}
			
		}


		public function get_sliders()
		{
			$data['sliders'] = $this->Administrator_Model->get_sliders();

			$data['title'] = 'Sliders';

			$this->load->view('administrator/header-script');
	 	 	$this->load->view('administrator/header');
	  		$this->load->view('administrator/header-bottom');
	   		$this->load->view('administrator/sliders', $data);
	  		$this->load->view('administrator/footer');
		}

		

		public function update_slider($id = NULL)
		{
			$data['sliders'] = $this->Administrator_Model->get_slider_data($id);
			$data['title'] = 'Update Slider';

			$this->load->view('administrator/header-script');
	 	 	 $this->load->view('administrator/header');
	  		 $this->load->view('administrator/header-bottom');
	   		 $this->load->view('administrator/update-slider', $data);
	  		$this->load->view('administrator/footer');
		}

		public function update_slider_data($page = 'update-slider')
		{
			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    show_404();
		   }
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}
			$data['title'] = 'Update Slider';

			$this->form_validation->set_rules('title', 'Title', 'required');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('administrator/'.$page, $data);
		  		 $this->load->view('administrator/footer');
			}else{
				//Upload Image
				
				$config['upload_path'] = './assets/images/sliders';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload()){
					$id = $this->input->post('id');
					$data['img'] = $this->Administrator_Model->get_slider_data($id);
					$errors =  array('error' => $this->upload->display_errors());
					$post_image = $data['img']['image'];
				}else{
					$data =  array('upload_data' => $this->upload->data());
					$post_image = $_FILES['userfile']['name'];
				}

				$this->Administrator_Model->update_slider_data($post_image);

				//Set Message
				$this->session->set_flashdata('success', 'Slider Images has been Updated Successfull.');
				redirect('administrator/sliders');
			}
			
		}

		// blogs functions start
		public function add_blog($page = 'add-blog')
		{
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}

			$data['title'] = 'Add Blog';
			$data['active'] = 'blog';
			$data['categories'] = $this->Post_Model->get_categories();

			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('body', 'Body', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('administrator/header-script');
			   	$this->load->view('administrator/header');
			   	$this->load->view('administrator/header-bottom',$data);
			   	$this->load->view('administrator/'.$page, $data);
			   	$this->load->view('administrator/footer');	
			}else{
				//Upload Image
				$config['upload_path'] = './assets/images/posts';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '6000';
				$config['max_width'] = '6000';
				$config['max_height'] = '10024';
				$fileExt = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
				$postimg = time().'_'.rand().'.'.$fileExt;
				$config['file_name'] = $postimg;
				$this->load->library('upload', $config);

				if(!$this->upload->do_upload()){
					$errors =  array('error' => $this->upload->display_errors());
					$post_image = 'noimage.png';
				}else{
					$data =  array('upload_data' => $this->upload->data());
					$post_image = $postimg;
					$this->load->library('image_lib');
					$image_data =   $this->upload->data();

		            $configer =  array(
		              'image_library'   => 'gd2',
		              'source_image'    =>  $image_data['full_path'],
		              'maintain_ratio'  =>  TRUE,
		              'width'           =>  350,
		              'height'          =>  300,
		            );
		            $this->image_lib->clear();
		            $this->image_lib->initialize($configer);
		            $this->image_lib->resize();
				}
				$this->Administrator_Model->create_blog($post_image);

				//Set Message
				$this->session->set_flashdata('post_created', 'Your article has been created.');
				redirect('administrator/blogs/list-blog');
			}
			
		}

		public function list_blog($offset = 0){
			// Pagination Config
			$config['base_url'] = base_url(). 'administrator/blogs/';
			$config['total_rows'] = $this->db->count_all('posts');
			$config['per_page'] = 3;
			$config['uri_segment'] = 3;
			$config['attributes'] = array('class' => 'paginate-link');

			// Init Pagination
			$this->pagination->initialize($config);

			$data['title'] = 'List of Blogs';
			$data['active'] = 'blog';
			$data['blogs'] = $this->Administrator_Model->listblogs(FALSE, FALSE, FALSE);

			$this->load->view('administrator/header-script');
			$this->load->view('administrator/header');
			$this->load->view('administrator/header-bottom', $data);
			$this->load->view('administrator/list-blogs', $data);
			$this->load->view('administrator/footer');
		}
		public function update_blog($blogId=null){
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}

			$data['title'] = 'Edit Blog';
			$data['active'] = 'blog';
			$data['categories'] = $this->Post_Model->get_categories();
			$data['post'] = $this->Administrator_Model->listblogs($blogId);

			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('body', 'Body', 'required');
			$this->form_validation->set_rules('body', 'Body', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('administrator/header-script');
			   	$this->load->view('administrator/header');
			   	$this->load->view('administrator/header-bottom', $data);
			   	$this->load->view('administrator/update-blog', $data);
			   	$this->load->view('administrator/footer');	
			}else{
				//Upload Image
				$config['upload_path'] = './assets/images/posts';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '6000';
				$config['max_width'] = '6000';
				$config['max_height'] = '10024';
				$fileExt = pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
				$postimg = time().'_'.rand().'.'.$fileExt;
				$config['file_name'] = $postimg;
				
				$this->load->library('upload', $config);

				if(!$this->upload->do_upload()){
					$errors =  array('error' => $this->upload->display_errors());
					$data['postimg'] = $this->Administrator_Model->listblogs($this->input->post('id'));
					$post_image = $data['postimg']['post_image'];
				}else{
					$data =  array('upload_data' => $this->upload->data());
					$post_image = $postimg;
					$this->load->library('image_lib');
					$image_data =   $this->upload->data();

		            $configer =  array(
		              'image_library'   => 'gd2',
		              'source_image'    =>  $image_data['full_path'],
		              'maintain_ratio'  =>  TRUE,
		              'width'           =>  350,
		              'height'          =>  300,
		            );
		            $this->image_lib->clear();
		            $this->image_lib->initialize($configer);
		            $this->image_lib->resize();
				}
				$this->Administrator_Model->update_blog_data($post_image);

			    //Set Message
			    $this->session->set_flashdata('success', 'Article has been Updated Successfully.');
			    redirect('administrator/blogs/list-blog');
			}
		}

		public function list_blog_comments()
		{
			$data['listBlogComments'] = $this->Administrator_Model->list_blog_comments();

			$data['title'] = 'Blog Comments';

			$this->load->view('administrator/header-script');
	 	 	$this->load->view('administrator/header');
	  		$this->load->view('administrator/header-bottom', $data);
	   		$this->load->view('administrator/blog-comments', $data);
	  		$this->load->view('administrator/footer');
		}

		public function view_blog_comments($id = NULL)
		{

			$data['viewBlogComments'] = $this->Administrator_Model->view_blog_comments($id);
			$data['title'] = 'View blog Comments';

			$this->load->view('administrator/header-script');
	 	 	 $this->load->view('administrator/header');
	  		 $this->load->view('administrator/header-bottom');
	   		 $this->load->view('administrator/view-blog-comment', $data);
	  		$this->load->view('administrator/footer');
		}


		public function create_blog_category()
		{
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}
			
			$data['title'] = 'Create Category';
			$data['active'] = 'blogcategory';
			$this->form_validation->set_rules('name', 'Category Name', 'required');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom', $data);
		   		 $this->load->view('administrator/add-blog-category', $data);
		  		 $this->load->view('administrator/footer');
			}else{
				$this->Administrator_Model->create_blog_category();

				//Set Message
				$this->session->set_flashdata('category_created', 'Your category has been created.');
				redirect('administrator/blog-categories');
			}
		}
		public function blog_categories()
		{
			$data['title'] = 'Blog Categories';
			$data['active'] = 'blogcategory';
			$data['blog_categories'] = $this->Administrator_Model->blog_categories();

			 	$this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom', $data);
		   		 $this->load->view('administrator/blog-categories', $data);
		  		 $this->load->view('administrator/footer');
		}

		public function update_blog_category($id = NULL)
		{

			$data['blogcategory'] = $this->Administrator_Model->update_blog_category($id);
			// print_r($data['productcategory']);exit;
			$data['active'] = 'blogcategory';
			if (empty($data['blogcategory'])) {
				show_404();
			}
			$data['title'] = 'Update Blog Category';
			$data['active'] = 'category';
			$this->load->view('administrator/header-script');
	 	 	 $this->load->view('administrator/header');
	  		 $this->load->view('administrator/header-bottom', $data);
	   		 $this->load->view('administrator/update-blog-category', $data);
	  		$this->load->view('administrator/footer');
		}

		public function update_blog_category_data()
		{
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}
			$data['title'] = 'Update Blog Category';
			$this->form_validation->set_rules('name', 'Category Name', 'required');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('administrator/update-blog-category', $data);
		  		 $this->load->view('administrator/footer');
			}else{
				$this->Administrator_Model->update_blog_category_data();

				//Set Message
				$this->session->set_flashdata('success', 'Your category has been Updated Successfully.');
				redirect('administrator/blog-categories');
			}
		}


		//Site configuration
		public function get_siteconfiguration($page = 'site-configuration')
		{
			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    	show_404();
		   	}

			$data['siteconfiguration'] = $this->Administrator_Model->get_siteconfiguration();

			$data['title'] = 'Site Configuration';

			$this->load->view('administrator/header-script');
	 	 	$this->load->view('administrator/header');
	  		$this->load->view('administrator/header-bottom');
	   		$this->load->view('administrator/update-site-configuration', $data);
	  		$this->load->view('administrator/footer');
		}

		public function update_siteconfiguration($id = NULL)
		{
			$data['siteconfiguration'] = $this->Administrator_Model->update_siteconfiguration($id);
			
			$data['title'] = 'Update Configuration';

			$this->load->view('administrator/header-script');
	 	 	$this->load->view('administrator/header');
	  		$this->load->view('administrator/header-bottom');
	   		$this->load->view('administrator/update-site-configuration', $data);
	  		$this->load->view('administrator/footer');
		}


		public function update_siteconfiguration_data($page = 'update-site-configuration')
		{

			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    show_404();
		   }
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}
			$data['title'] = 'Update Configuration';

			$this->form_validation->set_rules('site_title', 'Site Title', 'required');
			$this->form_validation->set_rules('site_name', 'Site Name', 'required');
			
			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('administrator/'.$page, $data);
		  		 $this->load->view('administrator/footer');
			}else{

				//Upload Image
				$config['upload_path'] = './assets/images';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload()){
					$errors =  array('error' => $this->upload->display_errors());
					$data['logo_imgs'] = $this->Administrator_Model->update_siteconfiguration($this->input->post('id'));
					$post_image = $data['logo_imgs']['logo_img'];
				}else{
					$data =  array('upload_data' => $this->upload->data());
					$post_image = $_FILES['userfile']['name'];
				}
				
				 $this->Administrator_Model->update_siteconfiguration_data($post_image);
				//Set Message
				$this->session->set_flashdata('success', 'site configuration Details has been Updated Successfull.');
				redirect('administrator/site-configuration/update/1');
			}
		}



		// pages content details start
		public function get_pagecontents($page = 'page-contents')
		{
			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    	show_404();
		   	}

			$data['pagecontents'] = $this->Administrator_Model->get_pagecontents();

			$data['title'] = 'List pages contents';

			$this->load->view('administrator/header-script');
	 	 	$this->load->view('administrator/header');
	  		$this->load->view('administrator/header-bottom');
	   		$this->load->view('administrator/'.$page, $data);
	  		$this->load->view('administrator/footer');
		}

		public function update_pagecontents($id = NULL)
		{
			$data['pagecontents'] = $this->Administrator_Model->update_pagecontents($id);
			
			$data['title'] = 'Update page contents';

			$this->load->view('administrator/header-script');
	 	 	$this->load->view('administrator/header');
	  		$this->load->view('administrator/header-bottom');
	   		$this->load->view('administrator/update-page-contents', $data);
	  		$this->load->view('administrator/footer');
		}


		public function update_pagecontents_data($page = 'update-page-contents')
		{

			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    show_404();
		   }
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}
			$data['title'] = 'Update Page contents Details';

			$this->form_validation->set_rules('page_name', 'Page Name', 'required');
			$this->form_validation->set_rules('content', 'Page Content', 'required');
			
			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('administrator/'.$page, $data);
		  		 $this->load->view('administrator/footer');
			}else{
				
				 $this->Administrator_Model->update_pagecontents_data();
				//Set Message
				$this->session->set_flashdata('success', 'Page Contents Details has been Updated Successfull.');
				redirect('administrator/page-contents');
			}
		}


		// galleries 
		public function galleries()
		{
			$data['title'] = 'Add Galleries';
			$this->load->view('administrator/header-script');
	 	 	$this->load->view('administrator/header');
	  		$this->load->view('administrator/header-bottom');
	   		$this->load->view('administrator/add-galleries', $data);
	  		$this->load->view('administrator/footer');
		}
			
			
		public function add_team($page = 'add-team')
		{
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}

			$data['title'] = 'Add Blog';

			$this->form_validation->set_rules('name', 'Team Name', 'required');
			$this->form_validation->set_rules('designation', 'Designation', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('administrator/header-script');
			   	$this->load->view('administrator/header');
			   	$this->load->view('administrator/header-bottom');
			   	$this->load->view('administrator/'.$page, $data);
			   	$this->load->view('administrator/footer');	
			}else{
				//Upload Image
				$config['upload_path'] = './assets/images/teams';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload()){
					$errors =  array('error' => $this->upload->display_errors());
					$team_image = 'noimage.png';
				}else{
					$data =  array('upload_data' => $this->upload->data());
					$team_image = $_FILES['userfile']['name'];
				}
				$this->Administrator_Model->create_team($team_image);

				//Set Message
				$this->session->set_flashdata('success', 'Your team has been created.');
				redirect('administrator/team/list');
			}
			
		}

		public function list_team($offset = 0){
			// Pagination Config
			$config['base_url'] = base_url(). 'administrator/team/';
			$config['total_rows'] = $this->db->count_all('teams');
			$config['per_page'] = 3;
			$config['uri_segment'] = 3;
			$config['attributes'] = array('class' => 'paginate-link');

			// Init Pagination
			$this->pagination->initialize($config);

			$data['title'] = 'List of Teams';

			$data['teams'] = $this->Administrator_Model->listteams(FALSE, $config['per_page'], $offset);

			$this->load->view('administrator/header-script');
			$this->load->view('administrator/header');
			$this->load->view('administrator/header-bottom');
			$this->load->view('administrator/list-teams', $data);
			$this->load->view('administrator/footer');
		}

		public function update_team($teamId){
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}

			$data['title'] = 'Edit Team';

			$data['team'] = $this->Administrator_Model->listteams($teamId);

			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('designation', 'url', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('administrator/header-script');
			   	$this->load->view('administrator/header');
			   	$this->load->view('administrator/header-bottom');
			   	$this->load->view('administrator/update-team', $data);
			   	$this->load->view('administrator/footer');	
			}else{
				//Upload Image
				$config['upload_path'] = './assets/images/teams';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload()){
					$errors =  array('error' => $this->upload->display_errors());
					$data['teamimg'] = $this->Administrator_Model->listteams($this->input->post('id'));
					$post_image = $data['teamimg']['image'];
				}else{
					$data =  array('upload_data' => $this->upload->data());
					$post_image = $_FILES['userfile']['name'];
				}

				$this->Administrator_Model->update_team_data($post_image);

			    //Set Message
			    $this->session->set_flashdata('success', 'Updated Successfully.');
			    redirect('administrator/team/list');
			}
		}

		public function add_testimonial($page = 'add-testimonial')
		{
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}

			$data['title'] = 'Add Testimonial';

			$this->form_validation->set_rules('name', 'Testimonial Name', 'required');
			$this->form_validation->set_rules('domain', 'Domain', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('administrator/header-script');
			   	$this->load->view('administrator/header');
			   	$this->load->view('administrator/header-bottom');
			   	$this->load->view('administrator/'.$page, $data);
			   	$this->load->view('administrator/footer');	
			}else{
				//Upload Image
				$config['upload_path'] = './assets/images/testimonials';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload()){
					$errors =  array('error' => $this->upload->display_errors());
					$uploaded_image = 'noimage.png';
				}else{
					$data =  array('upload_data' => $this->upload->data());
					$uploaded_image = $_FILES['userfile']['name'];
				}
				$this->Administrator_Model->create_testimonial($uploaded_image);

				//Set Message
				$this->session->set_flashdata('success', 'Testimonial has been created.');
				redirect('administrator/testimonials/list');
			}
			
		}

		public function list_testimonial($offset = 0){
			// Pagination Config
			$config['base_url'] = base_url(). 'administrator/team/';
			$config['total_rows'] = $this->db->count_all('teams');
			$config['per_page'] = 3;
			$config['uri_segment'] = 3;
			$config['attributes'] = array('class' => 'paginate-link');

			// Init Pagination
			$this->pagination->initialize($config);

			$data['title'] = 'List of Testimonials';

			$data['testimonials'] = $this->Administrator_Model->listtestimonial(FALSE, $config['per_page'], $offset);

			$this->load->view('administrator/header-script');
			$this->load->view('administrator/header');
			$this->load->view('administrator/header-bottom');
			$this->load->view('administrator/list-testimonials', $data);
			$this->load->view('administrator/footer');
		}

		public function update_testimonial($id){
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}

			$data['title'] = 'Edit Testimonial';

			$data['testimonial'] = $this->Administrator_Model->listtestimonial($id);

			$this->form_validation->set_rules('name', 'Testimonial Name', 'required');
			$this->form_validation->set_rules('domain', 'Domain', 'required');
			$this->form_validation->set_rules('description', 'Description', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('administrator/header-script');
			   	$this->load->view('administrator/header');
			   	$this->load->view('administrator/header-bottom');
			   	$this->load->view('administrator/edit-testimonial', $data);
			   	$this->load->view('administrator/footer');	
			}else{
				//Upload Image
				$config['upload_path'] = './assets/images/testimonials';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload()){
					$errors =  array('error' => $this->upload->display_errors());
					$data['img'] = $this->Administrator_Model->listtestimonial($this->input->post('id'));
					$uploaded_image = $data['img']['image'];
				}else{
					$data =  array('upload_data' => $this->upload->data());
					$uploaded_image = $_FILES['userfile']['name'];
				}

				$this->Administrator_Model->update_testimonial_data($uploaded_image);
			    //Set Message
			    $this->session->set_flashdata('success', 'Testimonial Updated Successfully.');
			    redirect('administrator/testimonials/list');
			}
		}

		public function get_admin_data()
		{
			$data['changePassword'] = $this->Administrator_Model->get_admin_data();
			$data['title'] = 'Change Password';

			$this->load->view('administrator/header-script');
	 	 	 $this->load->view('administrator/header');
	  		 $this->load->view('administrator/header-bottom');
	   		 $this->load->view('administrator/change-password', $data);
	  		$this->load->view('administrator/footer');
		}

		public function change_password($page = 'change-password')
		{
			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    show_404();
		   }
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}

			$data['title'] = 'Change password';

			//$data['add-user'] = $this->Administrator_Model->get_categories();

			$this->form_validation->set_rules('old_password', 'Old Password', 'required|callback_match_old_password');
			$this->form_validation->set_rules('new_password', 'New Password Field', 'required');
			$this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'matches[new_password]');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('administrator/'.$page, $data);
		  		 $this->load->view('administrator/footer');
			}else{


				$this->Administrator_Model->change_password($this->input->post('new_password'));

				//Set Message
				$this->session->set_flashdata('success', 'Password Has Been Changed Successfull.');
				redirect('administrator/change-password');
			}
			
		}
		// Check user name exists
		public function match_old_password($old_password){
			
			$this->form_validation->set_message('match_old_password', 'Current Password Does not matched, Please Try Again.');
			$password = md5($old_password);
			$que = $this->Administrator_Model->match_old_password($password);
			if ($que) {
				return true; 
			}else{
				return false;
			}
		}

		public function update_admin_profile()
		{
			$data['user'] = $this->Administrator_Model->get_admin_data();
			$data['title'] = 'Update Profile';

			$this->load->view('administrator/header-script');
	 	 	 $this->load->view('administrator/header');
	  		 $this->load->view('administrator/header-bottom');
	   		 $this->load->view('administrator/update-profile', $data);
	  		$this->load->view('administrator/footer');
		}

		public function update_admin_profile_data($page = 'update-profile')
		{
			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
		    show_404();
		   }
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}

			$data['title'] = 'Update Profile';

			//$data['add-user'] = $this->Administrator_Model->get_categories();

			$this->form_validation->set_rules('name', 'Name', 'required');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom');
		   		 $this->load->view('administrator/'.$page, $data);
		  		 $this->load->view('administrator/footer');
			}else{
				//Upload Image
				
				$config['upload_path'] = './assets/images/users';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '2048';
				$config['max_width'] = '2000';
				$config['max_height'] = '2000';

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload()){
					$id = $this->input->post('id');
					$data['img'] = $this->Administrator_Model->get_user($id);
					$errors =  array('error' => $this->upload->display_errors());
					$post_image = $data['img']['image'];
				}else{
					$data =  array('upload_data' => $this->upload->data());
					$post_image = $_FILES['userfile']['name'];
				}

				$this->Administrator_Model->update_user_data($post_image);

				//Set Message
				$this->session->set_flashdata('success', 'User has been Updated Successfull.');
				redirect('administrator/update-profile');
			}
			
		}


		//forget password functions start
		public function forget_password_mail(){
    $this->load->library('form_validation');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|callback_validate_credentials');

            //check if email is in the database
        $this->load->model('Administrator_Model');
        if($this->Administrator_Model->email_exists()){
            //$them_pass is the varible to be sent to the user's email
            $temp_pass = md5(uniqid());
            //send email with #temp_pass as a link
            $this->load->library('email', array('mailtype'=>'html'));
            $this->email->from('admin1234567@gmail.com', "Site");
            $this->email->to($this->input->post('email'));
            $this->email->subject("Reset your Password");

            $message = "<p>This email has been sent as a request to reset our password</p>";
            $message .= "<p><a href='".base_url()."administrator/reset-password/$temp_pass'>Click here </a>if you want to reset your password,
                        if not, then ignore</p>";
            $this->email->message($message);

            if($this->email->send()){
                $this->load->model('Administrator_Model');
                if($this->Administrator_Model->temp_reset_password($temp_pass)){
                    echo "check your email for instructions, thank you";
                }
            }
            else{
                echo "email was not sent, please contact your administrator";
            }

        }else{
            echo "your email is not in our database";
        }
}
public function reset_password($temp_pass){
    $this->load->model('Administrator_Model');
    if($this->Administrator_Model->is_temp_pass_valid($temp_pass)){

        $this->load->view('reset-password');
       //once the user clicks submit $temp_pass is gone so therefore I can't catch the new password and   //associated with the user...

    }else{
        echo "the key is not valid";    
    }

}
public function update_password(){
    $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');
            if($this->form_validation->run()){
            echo "passwords match";
            }else{
            echo "passwords do not match";  
            }
}

			//Magazines functionality start
			function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
			    $output = NULL;
			    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
			        $ip = '103.229.27.141'; //$ip = $_SERVER["REMOTE_ADDR"];
			        if ($deep_detect) {
			            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
			                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
			                $ip = $_SERVER['HTTP_CLIENT_IP'];
			        }
			    }
			    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
			    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
			    $continents = array(
			        "AF" => "Africa",
			        "AN" => "Antarctica",
			        "AS" => "Asia",
			        "EU" => "Europe",
			        "OC" => "Australia (Oceania)",
			        "NA" => "North America",
			        "SA" => "South America"
			    );
			    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
			        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
			        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
			            switch ($purpose) {
			                case "location":
			                    $output = array(
			                        "city"           => @$ipdat->geoplugin_city,
			                        "state"          => @$ipdat->geoplugin_regionName,
			                        "country"        => @$ipdat->geoplugin_countryName,
			                        "country_code"   => @$ipdat->geoplugin_countryCode,
			                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
			                        "continent_code" => @$ipdat->geoplugin_continentCode
			                    );
			                    break;
			                case "address":
			                    $address = array($ipdat->geoplugin_countryName);
			                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
			                        $address[] = $ipdat->geoplugin_regionName;
			                    if (@strlen($ipdat->geoplugin_city) >= 1)
			                        $address[] = $ipdat->geoplugin_city;
			                    $output = implode(", ", array_reverse($address));
			                    break;
			                case "city":
			                    $output = @$ipdat->geoplugin_city;
			                    break;
			                case "state":
			                    $output = @$ipdat->geoplugin_regionName;
			                    break;
			                case "region":
			                    $output = @$ipdat->geoplugin_regionName;
			                    break;
			                case "country":
			                    $output = @$ipdat->geoplugin_countryName;
			                    break;
			                case "countrycode":
			                    $output = @$ipdat->geoplugin_countryCode;
			                    break;
			            }
			        }
			    }
			    return $output;
			}

			public function add_issue($id=NULL)
			{	$page = 'add-issue';
				if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
			    show_404();
			   }
				// Check login
				if(!$this->session->userdata('login')) {
					redirect('administrator/index');
				}

				//echo "<pre>";
				//print_r($this->input->post());die();
				$data['title'] = 'Create New Issue';
				$data['active'] = 'magazines';
				$data['mid'] = $id;
				
				// echo "<pre>";
				// print_r($data);die();
				$this->form_validation->set_rules('name', 'Magazine Name', 'required');
				// $this->form_validation->set_rules('country', 'Publishing Company', 'required');
				$this->form_validation->set_rules('description', 'Magazine Description', 'required|min_length[300]');
			
				if (empty($_FILES['imgFiles']['name']))
				{
				    $this->form_validation->set_rules('imgFiles', 'Magazine Cover Image', 'required');
				}

				if (empty($_FILES['userfile']['name'][0]))
				{
				   $this->form_validation->set_rules('userfile', 'Upload Preview Magazine', 'required');
				}

				if (empty($_FILES['userfile_paid']['name'][0]))
				{
				    $this->form_validation->set_rules('userfile_paid', 'Upload Full Paid Magazine', 'required');
				}
				
				if($this->form_validation->run() === FALSE){
					 $data['country'] = $this->ip_info("Visitor", "Country");
					 $data['country_code'] = $this->ip_info("Visitor", "Country Code");
					 $this->load->view('administrator/header-script');
			 	 	 $this->load->view('administrator/header');
			  		 $this->load->view('administrator/header-bottom', $data);
			   		 $this->load->view('administrator/'.$page, $data);
			  		 $this->load->view('administrator/magazines-footer');
				}else{
					//Upload Image
					$config['upload_path'] = './assets/images/magzines/cover';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					// $config['max_size'] = '2048';
					// $config['max_width'] = '2000';
					// $config['max_height'] = '2000';
					$fileExt = pathinfo($_FILES['imgFiles']['name'], PATHINFO_EXTENSION);
				    $cover = time().'_'.rand().'.'.$fileExt;
					$config['file_name'] = $cover;
					$this->load->library('upload', $config);
					$errors = array();
					if(!$this->upload->do_upload('imgFiles')){
						$errors =  array('error' => $this->upload->display_errors());
					}else{
						$data =  array('upload_data' => $this->upload->data());
						$post_image = $cover;
						$this->load->library('image_lib');
						$image_data =   $this->upload->data();

			            $configer =  array(
			              'image_library'   => 'gd2',
			              'source_image'    =>  $image_data['full_path'],
			              'maintain_ratio'  =>  TRUE,
			              'width'           =>  300,
			              'height'          =>  420,
			            );
			            $this->image_lib->clear();
			            $this->image_lib->initialize($configer);
			            $this->image_lib->resize();
					}

			        $preview_magazine = $this->do_miltiupload_files('./assets/images/magzines/preview', 'M', $_FILES['userfile']);

			        $paid_magazine = $this->do_miltiupload_files('./assets/images/magzines/paid_magzine', 'M', $_FILES['userfile_paid']);

					$dataID = $this->Administrator_Model->create_issue($post_image, $preview_magazine, $paid_magazine,$id);

					$this->session->set_flashdata('success', 'Issue has been added Successfull.');
					redirect('administrator/add_magazines');
				}

			}

			public function add_magazines($page = 'add-magazines')
			{
				if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
			    show_404();
			   }
				// Check login
				if(!$this->session->userdata('login')) {
					redirect('administrator/index');
				}

				//echo "<pre>";
				//print_r($this->input->post());die();
				$data['title'] = 'Create New Magazine';
				$data['active'] = 'magazines';
				$data['product_categories'] = $this->Administrator_Model->product_categories();
				$data['countries'] = $this->Administrator_Model->countries();
				$data['languages'] = $this->Administrator_Model->getlanguages();
				$data['magazine_frequency'] = $this->Administrator_Model->getmagzine_frequency();
				$data['age_rates'] = $this->Administrator_Model->getage_rates();

				$this->form_validation->set_rules('name', 'Magazine Name', 'required');
				$this->form_validation->set_rules('publisher_company', 'Publishing Company', 'required');
				$this->form_validation->set_rules('description', 'Magazine Description', 'required|min_length[300]');
				$this->form_validation->set_rules('primary_category', 'Magazine Category', 'required');
				$this->form_validation->set_rules('age_rating', 'Magazine Age Rating', 'required');
				$this->form_validation->set_rules('country_publish_form', 'Country Publish from', 'required');
				$this->form_validation->set_rules('price_per_issue', 'Price Per Issue', 'required');
				$this->form_validation->set_rules('frequency', 'Magazine Frequency', 'required');
				$this->form_validation->set_rules('languages[]', 'Magazine Language', 'required');
				// if(empty($_FILES['imgFiles']['name']))
				// {
				//     $this->form_validation->set_rules('imgFiles', 'Magazine Cover Image', 'required');
				// }

				// if(empty($_FILES['userfile']['name'][0]))
				// {
				//    $this->form_validation->set_rules('userfile', 'Upload Preview Magazine', 'required');
				// }

				// if(empty($_FILES['userfile_paid']['name'][0]))
				// {
				//     $this->form_validation->set_rules('userfile_paid', 'Upload Full Paid Magazine', 'required');
				// }
				
				if($this->form_validation->run() === FALSE){
					 $data['country'] = $this->ip_info("Visitor", "Country");
					 $data['country_code'] = $this->ip_info("Visitor", "Country Code");
					 $this->load->view('administrator/header-script');
			 	 	 $this->load->view('administrator/header');
			  		 $this->load->view('administrator/header-bottom', $data);
			   		 $this->load->view('administrator/'.$page, $data);
			  		 $this->load->view('administrator/magazines-footer');
				}else{
					//Upload Image
					// $config['upload_path'] = './assets/images/magzines/cover';
					// $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
					// $config['max_size'] = '2048';
					// $config['max_width'] = '2000';
					// $config['max_height'] = '2000';
					// $cover = time().'_'.$_FILES['imgFiles']['name'];
					// $config['file_name'] = $cover;
					// $this->load->library('upload', $config);
					// $errors = array();
					// if(!$this->upload->do_upload('imgFiles')){
					// 	$errors =  array('error' => $this->upload->display_errors());
					// }else{
					// 	$data =  array('upload_data' => $this->upload->data());
					// 	$post_image = $cover;
					// }

			  //       $preview_magazine = $this->do_miltiupload_files('./assets/images/magzines/preview', 'M', $_FILES['userfile']);

			  //       $paid_magazine = $this->do_miltiupload_files('./assets/images/magzines/paid_magzine', 'M', $_FILES['userfile_paid']);

					$dataID = $this->Administrator_Model->create_magazine();
					$this->session->set_flashdata('success', 'Magazine has been added Successfull.');
					redirect('administrator/add_magazines');
				}

			}


			function do_miltiupload_files($path, $title, $files)
		    {   
		        $config = array(
		            'upload_path'   => $path,
		            'allowed_types' => 'jpg|gif|png|pdf|jpeg',
		            'overwrite'     => 1,                       
		        );

		        $this->load->library('upload', $config);

		        $images = array();
		        $srno  = 1;
		        foreach ($files['name'] as $key => $image) {
		            $_FILES['multi_images[]']['name']= $files['name'][$key];
		            $_FILES['multi_images[]']['type']= $files['type'][$key];
		            $_FILES['multi_images[]']['tmp_name']= $files['tmp_name'][$key];
		            $_FILES['multi_images[]']['error']= $files['error'][$key];
		            $_FILES['multi_images[]']['size']= $files['size'][$key];
		            // here we change file name on run time
		            $fileName = time().'_'.$srno.'.'.explode('/', $files['type'][$key])[1];
		            $images[] = $fileName;
		            $config['file_name'] = $fileName; //new file name

		            $this->upload->initialize($config); // load new config setting 

		            if ($this->upload->do_upload('multi_images[]')) { // upload file here
		             //echo "<pre>";
		                //print_r($this->upload->data());
		                //return true;
		                // performs your operations
		            } else {
		                return false;
		            }
		            $srno++;
		        }
		        return $images;
		    }


		public function magazines($offset = 0)
		{
			// Pagination Config
			$config['base_url'] = base_url(). 'administrator/magazines/';
			$config['total_rows'] = $this->db->count_all('add_magazines');
			$config['per_page'] = 3;
			$config['uri_segment'] = 3;
			$config['attributes'] = array('class' => 'paginate-link');

			// Init Pagination
			$this->pagination->initialize($config);
			
			$data['title'] = 'Latest Magazines';
			$data['active'] = 'magazines';
			$data['magazines'] = $this->Administrator_Model->get_magazines(FALSE, FALSE, FALSE);

			 	$this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom', $data);
		   		 $this->load->view('administrator/magazines', $data);
		  		$this->load->view('administrator/footer');
		}
		public function issues($mid,$offset = 0)
		{
			// Pagination Config
			$config['base_url'] = base_url(). 'administrator/issues/';
			$config['total_rows'] = $this->db->count_all('issues');
			$config['per_page'] = 3;
			$config['uri_segment'] = 3;
			$config['attributes'] = array('class' => 'paginate-link');

			// Init Pagination
			$this->pagination->initialize($config);
			
			$data['title'] = 'Magazines Issues';
			$data['active'] = 'magazines';
			$data['issues'] = $this->Administrator_Model->get_issues(false,$config['per_page'], $offset,$mid);
			// print_r($data);
			 	$this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom', $data);
		   		 $this->load->view('administrator/issues', $data);
		  		$this->load->view('administrator/footer');
		}

		public function update_issues($id = NULL)		
		{		
					// echo $id;exit;
			if($this->input->post('id'))		
			{		
				$id = $this->input->post('id');		
			}	

			$data['magazines'] = $this->Administrator_Model->get_single_issue($id);	
				// print_r($data);die();	
			if (empty($data['magazines'])) {		
				show_404();		
			}		
				$data['title'] = 'Update issues';		
				$data['active'] = 'magazines';		
						
				$this->form_validation->set_rules('name', 'Issues Name', 'required');		
				// $this->form_validation->set_rules('country', 'Publishing Company', 'required');		
				$this->form_validation->set_rules('description', 'Magazine Description', 'required|min_length[300]');		
				$this->form_validation->set_rules('price_per_issue', 'Price Per Issue', 'required');		
						
						
						
				if($this->form_validation->run() === FALSE){		
					 $data['country'] = $this->ip_info("Visitor", "Country");		
					 $data['country_code'] = $this->ip_info("Visitor", "Country Code");		
					 $this->load->view('administrator/header-script');		
			 	 	 $this->load->view('administrator/header');		
			  		 $this->load->view('administrator/header-bottom', $data);		
			   		 $this->load->view('administrator/update-issues', $data);		
			  		 $this->load->view('administrator/magazines-footer');		
				}else{		
				$post_image = $data['magazines']['cover'];		
				if (!empty($_FILES['imgFiles']['name']) && !empty($post_image))		
				 {		//echo "<pre>";print_r($data);die();
					if(file_exists(FCPATH.'assets/images/magzines/cover/'.$data['magazines']['cover'])){
					unlink(FCPATH.'assets/images/magzines/cover/'.$data['magazines']['cover']);	
					}
							
				   //Upload Image		
					$config['upload_path'] = './assets/images/magzines/cover';		
					$config['allowed_types'] = 'gif|jpg|png|jpeg';		
					// $config['max_size'] = '2048';		
					// $config['max_width'] = '2000';		
					// $config['max_height'] = '2000';		
					// $cover = time().'_'.$_FILES['imgFiles']['name'];
					$fileExt = pathinfo($_FILES['imgFiles']['name'], PATHINFO_EXTENSION);
				    $cover = time().'_'.rand().'.'.$fileExt;	
					$config['file_name'] = $cover;
					$this->load->library('upload', $config);		
					$errors = array();		
					if(!$this->upload->do_upload('imgFiles')){		
						$errors =  array('error' => $this->upload->display_errors());		
					}else{	
					// print_r($this->upload->data());exit;	
						$data =  array('upload_data' => $this->upload->data());		
						$post_image = $cover;
						$this->load->library('image_lib');
						$image_data =   $this->upload->data();

			            $configer =  array(
			              'image_library'   => 'gd2',
			              'source_image'    =>  $image_data['full_path'],
			              'maintain_ratio'  =>  TRUE,
			              'width'           =>  300,
			              'height'          =>  420,
			            );
			            $this->image_lib->clear();
			            $this->image_lib->initialize($configer);
			            $this->image_lib->resize();		
						}		
				}		
				$magazineson = $this->Administrator_Model->get_single_issue($this->input->post('id'));		
				$preview_magazine = explode(', ', $magazineson['preview']);		
				if(!empty($_FILES['userfile']['name'][0]) && $_FILES['userfile']['name'][0] != '')		
				{   		
					for($i = 0; $i < count($preview_magazine); $i++){	
					if(file_exists(FCPATH.'assets/images/magzines/preview/'.$preview_magazine[$i]))	
						unlink(FCPATH.'assets/images/magzines/preview/'.$preview_magazine[$i]);		
					}		
				  	$preview_magazine = $this->do_miltiupload_files('./assets/images/magzines/preview', 'M', $_FILES['userfile']);		
				}		
				$paid_magazine = explode(', ', $magazineson['paid']);		
				if (!empty($_FILES['userfile_paid']['name'][0]) && $_FILES['userfile_paid']['name'][0] != '')		
				{		
					for($i = 0; $i < count($paid_magazine); $i++){	
						if(file_exists(FCPATH.'assets/images/magzines/paid_magzine/'.$paid_magazine[$i]))
						unlink(FCPATH.'assets/images/magzines/paid_magzine/'.$paid_magazine[$i]);		
					}		
				    $paid_magazine = $this->do_miltiupload_files('./assets/images/magzines/paid_magzine', 'M', $_FILES['userfile_paid']);		
				}		
					$dataID = $this->Administrator_Model->update_issue($post_image, $preview_magazine, $paid_magazine);	
					// print_r($dataID);die();	
					$this->session->set_flashdata('success', 'Magazine has been updated Successfull.');		
					redirect('administrator/magazines/magazines');		
				}		
		}

		public function update_magazines($id = NULL)		
		{		
			// 		echo $id;
			if($this->input->post('id'))		
			{		
				$id = $this->input->post('id');		
			}		
			$data['magazines'] = $this->Administrator_Model->get_single_magazines($id);	
				// echo "<pre>";print_r($data);die();	
			if (empty($data['magazines'])) {		
				show_404();		
			}		
				$data['title'] = 'Update Magazines';		
				$data['active'] = 'magazines';		
				$data['product_categories'] = $this->Administrator_Model->product_categories();		
				$data['countries'] = $this->Administrator_Model->countries();		
				$data['languages'] = $this->Administrator_Model->getlanguages();		
				$data['magazine_frequency'] = $this->Administrator_Model->getmagzine_frequency();		
				$data['age_rates'] = $this->Administrator_Model->getage_rates();		
				$this->form_validation->set_rules('name', 'Magazine Name', 'required');		
				$this->form_validation->set_rules('publisher_company', 'Publishing Company', 'required');		
				$this->form_validation->set_rules('description', 'Magazine Description', 'required|min_length[300]');		
				$this->form_validation->set_rules('primary_category', 'Magazine Category', 'required');		
				$this->form_validation->set_rules('age_rating', 'Magazine Age Rating', 'required');		
				$this->form_validation->set_rules('country_publish_form', 'Country Publish from', 'required');		
				$this->form_validation->set_rules('price_per_issue', 'Price Per Issue', 'required');		
				$this->form_validation->set_rules('frequency', 'Magazine Frequency', 'required');		
				$this->form_validation->set_rules('languages[]', 'Magazine Language', 'required');		
						
						
				if($this->form_validation->run() === FALSE){		
					 $data['country'] = $this->ip_info("Visitor", "Country");		
					 $data['country_code'] = $this->ip_info("Visitor", "Country Code");		
					 $this->load->view('administrator/header-script');		
			 	 	 $this->load->view('administrator/header');		
			  		 $this->load->view('administrator/header-bottom', $data);		
			   		 $this->load->view('administrator/update-magazines', $data);		
			  		 $this->load->view('administrator/magazines-footer');		
				}else{		
				// $post_image = $data['magazines']['cover'];		
				// if (!empty($_FILES['imgFiles']['name']))		
				// {		
				// 	unlink(FCPATH.'assets/images/magzines/cover/'.$data['magazines']['cover']);		
				//    //Upload Image		
				// 	$config['upload_path'] = './assets/images/magzines/cover';		
				// 	$config['allowed_types'] = 'gif|jpg|png|jpeg';		
				// 	// $config['max_size'] = '2048';		
				// 	// $config['max_width'] = '2000';		
				// 	// $config['max_height'] = '2000';		
				// 	$cover = time().'_'.$_FILES['imgFiles']['name'];		
				// 	$config['file_name'] = $cover;		
				// 	$this->load->library('upload', $config);		
				// 	$errors = array();		
				// 	if(!$this->upload->do_upload('imgFiles')){		
				// 		$errors =  array('error' => $this->upload->display_errors());		
				// 	}else{		
				// 		$data =  array('upload_data' => $this->upload->data());		
				// 		$post_image = $cover;		
				// 	}		
				// }		
				// $magazineson = $this->Administrator_Model->get_single_magazines($this->input->post('id'));		
				// $preview_magazine = explode(', ', $magazineson['preview']);		
				// if(!empty($_FILES['userfile']['name'][0]) && $_FILES['userfile']['name'][0] != '')		
				// {   		
				// 	for($i = 0; $i < count($preview_magazine); $i++){		
				// 		unlink(FCPATH.'assets/images/magzines/preview/'.$preview_magazine[$i]);		
				// 	}		
				//   	$preview_magazine = $this->do_miltiupload_files('./assets/images/magzines/preview', 'M', $_FILES['userfile']);		
				// }		
				// $paid_magazine = explode(', ', $magazineson['paid']);		
				// if (!empty($_FILES['userfile_paid']['name'][0]) && $_FILES['userfile_paid']['name'][0] != '')		
				// {		
				// 	for($i = 0; $i < count($paid_magazine); $i++){		
				// 		unlink(FCPATH.'assets/images/magzines/paid_magzine/'.$paid_magazine[$i]);		
				// 	}		
				//     $paid_magazine = $this->do_miltiupload_files('./assets/images/magzines/paid_magzine', 'M', $_FILES['userfile_paid']);		
				// }		
					$dataID = $this->Administrator_Model->update_magazine();	
					// print_r($dataID);die();	
					$this->session->set_flashdata('success', 'Magazine has been updated Successfull.');		
					redirect('administrator/magazines/magazines');		
				}		
		}

		public function transactions($offset = 0)
		{

			// Pagination Config
			$config['base_url'] = base_url(). 'administrator/transactions/';
			$config['total_rows'] = $this->Administrator_Model->get_transactions_count(false, false)['count'];
			
			$config['per_page'] = 2;
			$config['uri_segment'] = 3;
			$config['attributes'] = array('class' => 'paginate-link');
			// echo "<pre>";print_r($config);die();
			// Init Pagination
			$this->pagination->initialize($config);
			
			$data['title'] = 'Transactions';
			$data['active'] = 'transaction';
			$data['transactions'] = $this->Administrator_Model->get_transactions(false, false);
			// echo "<pre>";print_r($data);die();
			 	$this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom', $data);
		   		 $this->load->view('administrator/transactions', $data);
		  		$this->load->view('administrator/footer');
		}

		public function transaction($iden)
		{

			
			$data['title'] = 'Transactions details';
			$data['active'] = 'transaction';
			$data['orderdata'] = $this->Publisher_Model->get_transaction_details(base64_decode($iden));
			$data['transaction'] = $this->Publisher_Model->print_products(base64_decode($iden));
			// echo "<pre>";print_r($data);die();
			 	$this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom', $data);
		   		 $this->load->view('administrator/transaction-detail', $data);
		  		$this->load->view('administrator/footer');
		}

		public function pending_order_delete($iden){
		$id=base64_decode($iden);
		
		if(!$this->session->userdata('login')) {
		redirect('administrator/index');
		}
		$data['userdata'] = $this->Administrator_Model->delete($id,'orders');
		$data['userdata'] = $this->Administrator_Model->delete_transaction_by_oid($id);
		// print_r($data['order']);die();
		redirect('administrator/transactions');

		}
	
	}
	




