<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Users extends CI_Controller
	{
		function  __construct(){
        parent::__construct();
        
        // Load cart library
        $this->load->library('cart');
        $this->load->library('google');
        // Load product model
        // $this->load->model('product');
    }
		public function dashboard(){
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$data['title'] = 'Dashboard';
			$data['page'] = 'users/dashboard';
			$data['inner'] = true;
			// $this->load->view('templates/header-front');
			// $this->load->view('users/dashboard', $data);
			// $this->load->view('templates/footer-front');
			$this->load->view('templates/common', $data);
		}

		public function orders(){
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$data['title'] = 'Orders';
			$data['page'] = 'users/orders';
			$data['inner'] = true;

			$data['orders'] = $this->User_Model->get_orders($this->session->userdata('user_id'));
			// echo "<pre>";print_r($data);die();
			// $this->load->view('templates/header-front');
			// $this->load->view('users/dashboard', $data);
			// $this->load->view('templates/footer-front');
			$this->load->view('templates/common', $data);
		}

		public function vieworder($iden){
			$id=base64_decode($iden);
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			$data['title'] = 'View Order';
			$data['page'] = 'users/vieworder';
			$data['inner'] = true;
			
			$data['productdata'] = $this->User_Model->print_products($id);
			// echo "<pre>";print_r($data['productdata'] );die();
			$message =
			'<table class="table table-striped" id="customers">
			<thead>
			<tr>
			<th class="center">#</th>
			<th>Item</th>
			<th class="right">Unit Cost(Rs.)</th>
			<th class="center">Qty</th>
			<th class="right">Subtotal(Rs.)</th>
			</tr>
			</thead>
			<tbody>';
	
			// $no=1;
			$total=0;
			foreach ($data['productdata'] as $key =>$product) {
			// print_r($product['price_per_issue']);
			// $no++;
			$total=$total+$product['sub_total'];
	
			$message .='<tr><td class="center">'.($key+1).'</td>
			<td class="left strong">'.$product['issue_name'].'</td>
			<td class="right">'.($product['sub_total']/$product['qty']).'</td>
			<td class="center">'.$product['qty'].'</td>
			<td class="right">'.$product['sub_total'].'</td>
			</tr>';
			} 

			$message .='</tbody></table>';
			$messagetotal='<table class="table table-clear">
			<tbody>
			<tr>
			<td class="left">
			<strong>Total</strong>
			</td>
			<td class="right">
			<strong>Rs.'.$total.'</strong>
			</td>
			</tr>
			</tbody>
			</table>';
			// echo "<pre>";print_r($message.$messagetotal);die();
			// $this->load->view('templates/header-front');
			// $this->load->view('users/dashboard', $data);
			// $this->load->view('templates/footer-front');
			
			// print_r($this->input->get());die();
			if(!empty($_GET['status'])=='success'){
			$this->User_Model->update_order_status($id,1);
			$data['orderdata'] = $this->User_Model->print_order($id);
			// echo "<pre>";print_r($data);die();
			//////////////
				$this->load->library('email');
				$htmlContent = file_get_contents(APPPATH.'views/cart/emailtemplate/invoice.html');
				$this->email->from($this->config->item('admin_email'), 'Idondza Admin');
				$this->email->to($this->session->userdata('email'));
				$this->email->subject('Invoice by Idondza');
				$variables = array();
				$variables['admin_user'] = $this->session->userdata('name');
				// data
				$variables['products_data'] = $message.$messagetotal;
				// footer
				$variables['post_copy_year'] = date('Y');
				$variables['post_sitename'] = 'Idondza';
				$variables['post_siteemail'] = $this->config->item('admin_email');
				$variables['site_logo_img1'] = $this->config->item('logo');
				foreach($variables as $x => $value) {

				$htmlContent=str_replace($x,$value,$htmlContent);

				}
				// print_r($htmlContent);die();
				$this->email->message($htmlContent);

				$this->email->send();
			///////////////	
			}else{
			$data['orderdata'] = $this->User_Model->print_order($id);
			// $data['status_data']=	$this->User_Model->print_order($id)['ostatus'];
			}
			// echo "<pre>";print_r($data);die();
			$this->load->view('templates/common', $data);
			
		}

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
		public function changepassword(){
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}
			// print_r();die();
			$data['title'] = 'Change Password';
			$data['page'] = 'users/change_password';
			$data['inner'] = true;
			$this->form_validation->set_rules('old_password', 'Old Password', 'required|callback_match_old_password');
			$this->form_validation->set_rules('new_password', 'New Password Field', 'required');
			$this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'matches[new_password]');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('templates/common', $data);
			}else{

				
			
				// print_r($ok);die();
				if($this->User_Model->change_password($this->input->post('new_password'))==1){
						// 
						$this->load->library('email');
						$htmlContent = file_get_contents(APPPATH.'views/publisher/emailtemplate/change_pass.html');
						$this->email->from($this->config->item('admin_email'), 'Idondza Admin');
						$this->email->to($this->input->post('email'));
						$this->email->subject('Password changed Successfull');
						$variables = array();
						$variables['admin_user'] = $this->session->userdata('name');
						$variables['publi_email'] = $this->session->userdata('username');
						$variables['publi_pass'] = $this->input->post('confirm_new_password');
						$variables['post_copy_year'] = date('Y');
						$variables['post_sitename'] = 'Idondza';
						$variables['site_logo_img1'] = $this->config->item('logo');
						foreach($variables as $x => $value) {

						$htmlContent=str_replace($x,$value,$htmlContent);

						}
						// print_r($htmlContent);die();
						$this->email->message($htmlContent);

						$this->email->send();
						// if($this->email->send()){
						// $this->session->set_flashdata("success","Email sent successfully."); 
						// }else {
						// $this->session->set_flashdata("error","Error in sending Email.".$this->email->print_debugger()); exit;
						// }
						$this->session->set_flashdata('success', 'Password Has Been Changed Successfull.');
				}
				
				redirect('users/changepassword');
			}
		}
		// Edit profile user
		public function profile(){
			if(!$this->session->userdata('login')) {
				redirect('users/login');
			}

			$data['title'] = 'User Profile';
			$data['page'] = 'users/profile';
			$data['inner'] = true;
			$data['profiledata'] = $this->User_Model->get_user($this->session->userdata('user_id'));
// echo "<pre>";print_r($data);die();
			$this->form_validation->set_rules('name', 'Name', 'required');
			// $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
			// $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			if($this->form_validation->run() === FALSE){
				// echo "<pre>";print_r($this->session->userdata('user_id'));die();
				$this->load->view('templates/common', $data);
			}else{
				//Encrypt Password
				$this->User_Model->update_user_data($this->session->userdata('user_id'));
				//Set Message
				$this->session->set_flashdata('success', 'Your profile has been updated.');
				redirect('users/profile');
			}
		}

		// Register User
		public function register(){
			if($this->session->userdata('login')) {
				redirect('user/orders');
			}

			$data['title'] = 'Sign Up';
			$data['page']='users/register';
			$data['inner']=true;
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

			if($this->form_validation->run() === FALSE){
				// $this->load->view('templates/header');
				// $this->load->view('templates/header-front');
				// $this->load->view('users/register', $data);
				// // $this->load->view('templates/footer');
				// $this->load->view('templates/footer-front');
				$this->load->view('templates/common', $data);
			}else{
				//Encrypt Password
				$encrypt_password = md5($this->input->post('password'));

				$ok=$this->User_Model->register($encrypt_password);
				if($ok){
						$this->load->library('email');
						$htmlContent = file_get_contents(APPPATH.'views/publisher/emailtemplate/register_publisher.html');
						$this->email->from($this->config->item('admin_email'), 'Idondza Admin');
						$this->email->to($this->input->post('email'));
						$this->email->subject('Registration Successfull');
						$variables = array();
						$variables['admin_user'] = $this->input->post('username');
						$variables['publi_email'] = $this->input->post('email');
						$variables['publi_pass'] = $this->input->post('password2');
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
				$this->session->set_flashdata('success', 'You are registered and can log in.');
				redirect('users/login');
			}
		}
		
		public function resetpassword(){
			if($this->session->userdata('login')) {
				redirect('user/orders');
			}

			$data['title'] = 'Reset Password';
			$data['page']='users/reset';
			$data['inner']=true;
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() === FALSE){
				
				$this->load->view('templates/common', $data);
			}else{
				// ini_set("allow_url_fopen", 1);
				//Set Message
				// $htmlContent = file_get_contents($this->config->item('base_url')."assets/emailtemplate/register_publisher.html");


				$rowdata=$this->User_Model->reset_password(base64_decode($this->input->post('id')));
				// print_r($rowdata);die();
				if($rowdata){
					$headers = "MIME-Version: 1.0" . "\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\n";
					$headers .= "From:sewakram.gsm@gmail.com". "\n";
					$variables = array();
				$variables['admin_user'] = $rowdata['name'];
				
				$htmlContent = file_get_contents(APPPATH."views/users/emailtemplate/reset_thanks.html");
				// print_r($htmlContent);exit;
				foreach($variables as $x => $value) {

				$htmlContent=str_replace($x,$value,$htmlContent);

				}
					
					
					// mail( "sewakram.gsm@gmail.com", "Forget password ", $htmlContent,$headers );
					mail( $rowdata['email'], "Forget password ", $htmlContent,$headers );

					
					$this->session->set_flashdata('success', 'Thank you! Successfully changed password.');
				}else{
					$this->session->set_flashdata('danger', 'Oops! Something went wrong.');
				}
				redirect('users/login');
			}
		}

		// forget password user
		public function forget(){
			if($this->session->userdata('login')) {
				redirect('users/forget');
			}

			$data['title'] = 'Forget Password';
			$data['page']='users/forget';
			$data['inner']=true;
			$this->form_validation->set_rules('username', 'Email', 'required');

			if($this->form_validation->run() === FALSE){
				
				$this->load->view('templates/common', $data);
			}else{
				// ini_set("allow_url_fopen", 1);
				//Set Message
				// $htmlContent = file_get_contents($this->config->item('base_url')."assets/emailtemplate/register_publisher.html");


				$rowdata=$this->User_Model->email_exists();
				// print_r($rowdata->name);die();
				if($rowdata){
					$headers = "MIME-Version: 1.0" . "\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\n";
					$headers .= "From:sewakram.gsm@gmail.com". "\n";
					$variables = array();



				$variables['admin_user'] = $rowdata->name;

				$variables['post_us_link']=base_url(). 'users/resetpassword?id='.base64_encode($rowdata->id);
				
				$htmlContent = file_get_contents(APPPATH."views/users/emailtemplate/forgetpassword.html");
				// print_r($htmlContent);exit;
				foreach($variables as $x => $value) {



				$htmlContent=str_replace($x,$value,$htmlContent);



				}
					
					
					// mail( "sewakram.gsm@gmail.com", "Forget password ", $htmlContent,$headers );
					mail( $rowdata->email, "Forget password ", $htmlContent,$headers );

					
					$this->session->set_flashdata('success', 'An email has been sent to the address you provided.');
				}else{
					$this->session->set_flashdata('danger', 'An email has not been registered.');
				}
				redirect('users/forget');
			}
		}

		// Log in User
		public function login(){
			$data['title'] = 'Sign In';
			$data['page']= 'users/login';
			$data['inner']=true;
			$data['google_client_id']= $this->config->item('google_client_id');
			$data['google_redirect_uri']= $this->config->item('google_redirect_uri');
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() === FALSE){
				
				$this->load->view('templates/common', $data);
			}else{
				// get username and Encrypt Password
				$username = $this->input->post('username');
				$encrypt_password = md5($this->input->post('password'));

				$user_id = $this->User_Model->login($username, $encrypt_password);
				// print_r($user_id);
				if ($user_id) {
					if($user_id->status)
					{
							//Create Session
						$user_data = array(
									'user_id' => $user_id->id,
					 				'username' => $username,
					 				'email' => $user_id->email,
					 				'name'=>$user_id->username,
					 				'login' => true
					 	);

					 	$this->session->set_userdata($user_data);

						//Set Message
						$this->session->set_flashdata('user_loggedin', 'You are now logged in.');
						// redirect('users/dashboard');
						redirect('users/profile');
					}
					else
					{
						$this->session->set_flashdata('danger', 'Your Account is Deactivate.');
						redirect('users/login');
					}
					
				}else{
					$this->session->set_flashdata('danger', 'Login is invalid.');
					redirect('users/login');
				}
				
			}
		}

		// log user out
		public function logout(){
			// unset user data
			$this->session->unset_userdata('login');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('email');

			//Set Message
			$this->session->set_flashdata('user_loggedout', 'You are logged out.');
			redirect(base_url());
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

	    // favourites tab
	    public function favourites()
	    {
	      if(!$this->session->userdata('login')) {
	        redirect('users/login');
	      }
			$data['inner'] = true;
	      $data['title'] = 'Favourites';
	      $data['page'] = 'users/favourites';
	      $this->myissue = & get_instance();
	      $data['myfav'] = $this->User_Model->get_all_data_condition('favourites', 'user_id', $this->session->userdata('user_id'));
	      $this->load->view('templates/common', $data);
	    }

	    public function subscriptions()
	    {
	      if(!$this->session->userdata('login')) {
	        redirect('users/login');
	      }
		  $data['inner'] = true;
	      $data['title'] = 'Subscriptions';
	      $data['page'] = 'users/subscription';
	     
	      $data['subscriptions'] = $this->User_Model->get_subscriptions('sp');
	      // echo "<pre>";print_r($data['subscriptions']);die();
	      $this->load->view('templates/common', $data);
	    }

	    public function subscriptionsbyissue()
	    {
	      if(!$this->session->userdata('login')) {
	        redirect('users/login');
	      }
		  $data['inner'] = true;
	      $data['title'] = 'My Single Issues';
	      $data['page'] = 'users/subscription';
	     
	      $data['subscriptions'] = $this->User_Model->get_subscriptions('ip');
	      // echo "<pre>";print_r($data['subscriptions']);die();
	      $this->load->view('templates/common', $data);
	    }

	    public function common_function_fav($table1, $table2, $field, $data)
	    {
	    	$fetchrecord = $this->User_Model->get_fav_data_condition($table1, $table2, $field, $data);
	    	return $fetchrecord;
	    }

	    public function randomPassword() {
		    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		    $pass = array(); //remember to declare $pass as an array
		    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		    for ($i = 0; $i < 8; $i++) {
		        $n = rand(0, $alphaLength);
		        $pass[] = $alphabet[$n];
		    }
		    return implode($pass); //turn the array into a string
		}

		public function login_social($social, $id, $email)
		{
			$user_id = $this->User_Model->social_login($social, $email, $id);
				// print_r($user_id);die();
				if ($user_id) {
					if($user_id->status)
					{
							//Create Session
						$user_data = array(
									'user_id' => $user_id->id,
					 				'username' => $user_id->username,
					 				'email' => $user_id->email,
					 				'name'=>$user_id->name,
					 				'login' => true
					 	);

					 	$this->session->set_userdata($user_data);

						//Set Message
						$this->session->set_flashdata('user_loggedin', 'You are now logged in.');
						// redirect('users/dashboard');
						redirect('users/profile');
					}
					else
					{
						$this->session->set_flashdata('danger', 'Your Account is Deactivate.');
						redirect('users/login');
					}
					
				}else{
					return false;
				}
		}

		public function register_social($data, $email, $name, $password)
		{
			$ok = $this->User_Model->register_google_oauth($data);
			if($ok){
						$this->load->library('email');
						$htmlContent = file_get_contents(APPPATH.'views/publisher/emailtemplate/register_publisher.html');
						$this->email->from($this->config->item('admin_email'), 'Idondza Admin');
						$this->email->to($email);
						$this->email->subject('Registration Successfull');
						$variables = array();
						$variables['admin_user'] = $name;
						$variables['publi_email'] = $email;
						$variables['publi_pass'] = $password;
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
						$this->session->set_flashdata("danger","Error in sending Email.".$this->email->print_debugger()); //exit;
						}
					$this->session->set_flashdata('success', 'You have been successfully registered ! Please check your mail box.');
					$this->login_social($data['oauth_provider'], $data['oauth_uid'], $email);
					redirect('users/login');
				}

				//Set Message
				return false;
		}

	    public function google_user_authentiction()
	    {
	    	if(isset($_GET['code'])) {
				try {
					$gapi = new Google();
					
					// Get the access token 
					$data = $gapi->GetAccessToken($this->config->item('google_client_id'), $this->config->item('google_redirect_uri'), $this->config->item('google_client_secret'), $_GET['code']);
					
					// Get user information
					$user_info = $gapi->GetUserProfileInfo($data['access_token']);
					// echo "<pre>";print_r($user_info);die();
					$this->login_social('gmail', $user_info['id'], $user_info['email']);
					$encpassword = $this->randomPassword();
					$data = array('name' => $user_info['name'], 
					  'email' => $user_info['email'],
					  'oauth_provider' => 'gmail',
					  'oauth_uid' => $user_info['id'],
					  'password' => md5($encpassword),
					  'username' => $user_info['name'],
					  'status' => 1,
					  'role_id' => 2
					  );

					$this->register_social($data, $user_info['email'], $user_info['name'], $encpassword);
					$data['error'] = 'Sorry! Something Wrong?';
					redirect('users/login',$data);
					exit();
				}
				catch(Exception $e) {
					//echo $e->getMessage();
					$data['error'] = $e->getMessage();
					redirect('users/login',$data);
					exit();
				}
			}
	    }

	}