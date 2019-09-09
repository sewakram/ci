<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Publisher extends CI_Controller{

		
		public function __construct()
        {
                parent::__construct();
                $this->isUserLoggedin();
                 $this->load->library('cart');
        }

        public function isUserLoggedin()
        {
        	if($this->session->userdata('login')) {
				if($this->session->userdata('role') == 1 || empty($this->session->userdata('role')))
				{
					redirect('administrator/dashboard');
				}
			}
        }
        
		public function view($page = 'index'){
			if($this->session->userdata('login')) {
    			redirect('publisher/dashboard');
   			}

			if (!file_exists(APPPATH.'views/administrator/'.$page.'.php')) {
				show_404();
			}
			$data['title'] = ucfirst($page);
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
			$this->load->view('administrator/header-script');
			$this->load->view('administrator/header');
			$this->load->view('administrator/header-bottom');
			$this->load->view('administrator/'.$page, $data);
			$this->load->view('administrator/footer');
		}

		public function dashboard($page = 'dashboard'){
		   if (!file_exists(APPPATH.'views/publisher/'.$page.'.php')) {
		    show_404();
		   }

		   $data['title'] = ucfirst($page);
		   $data['active'] = 'dashboard';
		   $data['magazinesa']=$this->Publisher_Model->magazines_count($this->session->userdata('user_id'),1);
		   $data['magazinesp']=$this->Publisher_Model->magazines_count($this->session->userdata('user_id'),0);
		   $data['magazinest']=$this->Publisher_Model->magazines_totalcount($this->session->userdata('user_id'));
		   $data['articalst']=$this->Publisher_Model->articals_totalcount($this->session->userdata('user_id'));
		   $data['ordersdata']=$this->Publisher_Model->get_transactions_count($this->session->userdata('user_id'), false, false);
		   $data['earning']=$this->Publisher_Model->get_earning($this->session->userdata('user_id'), false, false);
		   // echo "<pre>";print_r($data);exit;
		   $this->load->view('administrator/header-script');
		   $this->load->view('administrator/header');
		   $this->load->view('administrator/header-bottom', $data);
		   $this->load->view('publisher/'.$page, $data);
		   $this->load->view('administrator/footer');
		}

		public function register()
		{	

			// Check login
			if($this->session->userdata('login')) {
				redirect('administrator/index');
			}

			$data['title'] = 'Register Publisher';
			$data['page']='users/register_publisher';
			$data['inner']=true;
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
				 $this->load->view('templates/common', $data);
			}else{
				
				$ok=$this->Administrator_Model->add_publisher();
				if($ok){
						$this->load->library('email');
						$htmlContent = file_get_contents(APPPATH.'views/publisher/emailtemplate/register_publisher.html');
						$this->email->from($this->config->item('admin_email'), 'Idondza Admin');
						$this->email->to($this->input->post('email'));
						$this->email->subject('Registration Successfull');
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
				redirect('publisher/register');
			}
			
		}

		// Check Email exists
		public function check_email_exists($email){
			
			// var_dump($this->User_Model->check_email_exists($email));die();
			if ($this->User_Model->check_email_exists($email)) {

				return true;
			}else{
				$this->form_validation->set_message('check_email_exists', 'This email is already registered.');
				return false;
			}
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


				// $this->Administrator_Model->change_password($this->input->post('new_password'));
				if($this->Administrator_Model->change_password($this->input->post('new_password'))==1){
						// 
						$this->load->library('email');
						$htmlContent = file_get_contents(APPPATH.'views/publisher/emailtemplate/change_pass.html');
						$this->email->from($this->config->item('admin_email'), 'Idondza Admin');
						$this->email->to($this->input->post('email'));
						$this->email->subject('Password changed Successfull');
						$variables = array();
						$variables['admin_user'] = $this->session->userdata('username');
						$variables['publi_email'] = $this->session->userdata('email');
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
				//Set Message
				
				redirect('publisher/change-password');
			}
			
		}
	 	public function logout(){
	 		
			// $this->load->library('email');

			// $this->email->from('sewakram.gsm@gmail.com', 'sewakram');
			// $this->email->to('centsoft13@gmail.com');
			// $this->email->subject('Email Test');
			// $this->email->message('Testing the email class.');

			// // $this->email->send();
			// if($this->email->send()){
			// 	$this->session->set_flashdata("email_sent","Email sent successfully."); 
			// }else {
			// 	$this->session->set_flashdata("email_sent","Error in sending Email.".$this->email->print_debugger()); exit;
			// }
         
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
		public function enable($id)
		{
			$table = base64_decode($this->input->get('table'));
			//$table = $this->input->post('table');
			$this->Administrator_Model->enable($id,$table);       
			$this->session->set_flashdata('success', 'Desabled Successfully.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		public function desable($id)
		{
			$table = base64_decode($this->input->get('table'));
			//$table = $this->input->post('table');
			$this->Administrator_Model->desable($id,$table);       
			$this->session->set_flashdata('success', 'Enabled Successfully.');
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		public function delete($id)
		{
			$table = base64_decode($this->input->get('table'));
			if($table == 'issues'){
					$magazines = $this->Publisher_Model->get_single_issue($id);		
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
		public function update_publisher_profile()
		{
			$data['user'] = $this->Administrator_Model->get_admin_data();
			$data['publisher_details'] = $this->Publisher_Model->get_publisher_details($this->session->userdata('user_id'));
			$data['title'] = 'Update Profile';

			$this->load->view('administrator/header-script');
	 	 	 $this->load->view('administrator/header');
	  		 $this->load->view('administrator/header-bottom');
	   		 $this->load->view('publisher/update-profile', $data);
	  		$this->load->view('administrator/footer');
		}

		public function update_bank_details()
		{	
			$data['title'] = 'Update Bank Details';
			$data['active'] = 'bank';
			$data['bankdetails'] = $this->Publisher_Model->get_publisher_details($this->session->userdata('user_id'));
			// echo "<pre>";print_r($data);die();
			$data['countrys'] = $this->Administrator_Model->getcountry();
			
			$this->load->view('administrator/header-script');
	 	 	 $this->load->view('administrator/header');
	  		 $this->load->view('administrator/header-bottom');
	   		 $this->load->view('publisher/update-bank-details', $data);
	  		$this->load->view('administrator/footer');
		}

		public function update_bank_details_data($page = 'update-bank-details')
		{	if (!file_exists(APPPATH.'views/publisher/'.$page.'.php')) {
		    show_404();
		   }
			// Check login
			if(!$this->session->userdata('login')) {
				redirect('administrator/index');
			}

			$data['title'] = 'Update Bank Details';
			$data['active'] = 'bank';
			$this->form_validation->set_rules('acc_no', 'Account Number', 'required');

			if($this->form_validation->run() === FALSE){
				 $this->load->view('administrator/header-script');
	 	 	 $this->load->view('administrator/header');
	  		 $this->load->view('administrator/header-bottom');
	   		 $this->load->view('publisher/update-bank-details', $data);
	  		$this->load->view('administrator/footer');
			}else{

			$this->Publisher_Model->update_publisher_bank_details($this->session->userdata('user_id'));
			$this->session->set_flashdata('success', 'Bank details has been Updated Successfull.');
				redirect('publisher/bankdetails');
			}
		}



		public function update_publisher_profile_data($page = 'update-profile')
		{
			if (!file_exists(APPPATH.'views/publisher/'.$page.'.php')) {
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
		   		 $this->load->view('publisher/'.$page, $data);
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
				$this->Publisher_Model->update_user_data($post_image);

				//Set Message
				$this->session->set_flashdata('success', 'User has been Updated Successfull.');
				redirect('publisher/update-profile');
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

			public function add_magazines($page = 'add-magazines')
			{
				if (!file_exists(APPPATH.'views/publisher/'.$page.'.php')) {
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
				$data['product_categories'] = $this->Publisher_Model->product_categories();
				$data['company'] = $this->Publisher_Model->get_publisher_details($this->session->userdata('user_id'));//countries();
				$data['countries'] = $this->Publisher_Model->countries();
				$data['languages'] = $this->Publisher_Model->getlanguages();
				$data['magazine_frequency'] = $this->Publisher_Model->getmagzine_frequency();
				$data['age_rates'] = $this->Publisher_Model->getage_rates();
				// echo "<pre>";
				// print_r($data);die();
				$this->form_validation->set_rules('name', 'Magazine Name', 'required');
				// $this->form_validation->set_rules('country', 'Publishing Company', 'required');
				$this->form_validation->set_rules('description', 'Magazine Description', 'required|min_length[300]');
				$this->form_validation->set_rules('primary_category', 'Magazine Category', 'required');
				$this->form_validation->set_rules('age_rating', 'Magazine Age Rating', 'required');
				$this->form_validation->set_rules('country_publish_form', 'Country Publish from', 'required');
				$this->form_validation->set_rules('price_per_issue', 'Price Per Issue', 'required');
				//$this->form_validation->set_rules('frequency', 'Magazine Frequency', 'required');
				// $this->form_validation->set_rules('languages[]', 'Magazine Language', 'required');
				// if (empty($_FILES['imgFiles']['name']))
				// {
				//     $this->form_validation->set_rules('imgFiles', 'Magazine Cover Image', 'required');
				// }

				// if (empty($_FILES['userfile']['name'][0]))
				// {
				//    $this->form_validation->set_rules('userfile', 'Upload Preview Magazine', 'required');
				// }

				// if (empty($_FILES['userfile_paid']['name'][0]))
				// {
				//     $this->form_validation->set_rules('userfile_paid', 'Upload Full Paid Magazine', 'required');
				// }
				
				if($this->form_validation->run() === FALSE){
					 $data['country'] = $this->ip_info("Visitor", "Country");
					 $data['country_code'] = $this->ip_info("Visitor", "Country Code");
					 $this->load->view('administrator/header-script');
			 	 	 $this->load->view('administrator/header');
			  		 $this->load->view('administrator/header-bottom', $data);
			   		 $this->load->view('publisher/'.$page, $data);
			  		 $this->load->view('administrator/magazines-footer');
				}else{
					//Upload Image
					$config['upload_path'] = './assets/images/magzines/cover';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
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

					$dataID = $this->Publisher_Model->create_magazine();

					$this->session->set_flashdata('success', 'Magazine has been added Successfull.');
					redirect('publisher/add_magazines');
				}

			}

			public function add_issue($id=NULL)
			{	

				// echo "<pre>";print_r($_FILES);exit;
				$page = 'add-issue';
				if (!file_exists(APPPATH.'views/publisher/'.$page.'.php')) {
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
			   		 $this->load->view('publisher/'.$page, $data);
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

					$dataID = $this->Publisher_Model->create_issue($post_image, $preview_magazine, $paid_magazine,$id);

					$this->session->set_flashdata('success', 'Magazine has been added Successfull.');
					redirect('publisher/add_magazines');
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
		        $srno = 1;
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

		public function pending_magazines($offset = 0)
		{

			// Pagination Config
			$config['base_url'] = base_url(). 'publisher/pending-magazines/';
			$config['total_rows'] = $this->db->count_all('add_magazines');
			$config['per_page'] = 3;
			$config['uri_segment'] = 3;
			$config['attributes'] = array('class' => 'paginate-link');

			// Init Pagination
			$this->pagination->initialize($config);
			
			$data['title'] = 'Latest Pending Magazines';
			$data['active'] = 'magazines';
			$data['magazines'] = $this->Publisher_Model->get_pending_magazines($this->session->userdata('user_id'), $config['per_page'], $offset);
			// echo "<pre>";print_r($data);die();
			 	$this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom', $data);
		   		 $this->load->view('publisher/pending-magazine', $data);
		  		$this->load->view('administrator/footer');
		}

		public function transactions($offset = 0)
		{

			// Pagination Config
			$config['base_url'] = base_url(). 'publisher/transactions/';
			$config['total_rows'] = $this->Publisher_Model->get_transactions_count($this->session->userdata('user_id'), false, false)['count'];
			// $config['earning'] = $this->Publisher_Model->get_earning($this->session->userdata('user_id'), false, false);
			$config['per_page'] = 2;
			$config['uri_segment'] = 3;
			$config['attributes'] = array('class' => 'paginate-link');

			// Init Pagination
			$this->pagination->initialize($config);
			
			$data['title'] = 'Transactions';
			$data['active'] = 'transaction';
			$data['transactions'] = $this->Publisher_Model->get_transactions($this->session->userdata('user_id'), false, false);
			// echo "<pre>";print_r($config);die();
			 	$this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom', $data);
		   		 $this->load->view('publisher/transactions', $data);
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
		   		 $this->load->view('publisher/transaction-detail', $data);
		  		$this->load->view('administrator/footer');
		}

		public function active_magazines($offset = 0)
		{
			
			// Pagination Config
			$config['base_url'] = base_url(). 'publisher/active-magazines/';
			$config['total_rows'] = $this->db->count_all('add_magazines');
			$config['per_page'] = 3;
			$config['uri_segment'] = 3;
			$config['attributes'] = array('class' => 'paginate-link');

			// Init Pagination
			$this->pagination->initialize($config);
			
			$data['title'] = 'Latest active Magazines';
			$data['active'] = 'magazines';
			$data['magazines'] = $this->Publisher_Model->get_active_magazines($this->session->userdata('user_id'), $config['per_page'], $offset);
			// echo "<pre>";print_r($data);die();
			 	$this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom', $data);
		   		 $this->load->view('publisher/active-magazines', $data);
		  		$this->load->view('administrator/footer');
		}

		public function magazines($offset = 0)
		{
			// Pagination Config
			$config['base_url'] = base_url(). 'publisher/magazines/';
			$config['total_rows'] = $this->db->count_all('add_magazines');
			$config['per_page'] = 10;
			$config['uri_segment'] = 3;
			$config['attributes'] = array('class' => 'paginate-link');

			// Init Pagination
			$this->pagination->initialize($config);
			
			$data['title'] = 'Latest Magazines';
			$data['active'] = 'magazines';
			$data['magazines'] = $this->Publisher_Model->get_magazines($this->session->userdata('user_id'), false,false);

			 	$this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom', $data);
		   		 $this->load->view('publisher/magazines', $data);
		  		$this->load->view('administrator/footer');
		}

		public function issues($mid,$offset = 0)
		{
			// Pagination Config
			$config['base_url'] = base_url(). 'publisher/issues/';
			$config['total_rows'] = $this->db->count_all('issues');
			$config['per_page'] = 3;
			$config['uri_segment'] = 3;
			$config['attributes'] = array('class' => 'paginate-link');

			// Init Pagination
			$this->pagination->initialize($config);
			
			$data['title'] = 'Magazines Issues';
			$data['active'] = 'magazines';
			$data['issues'] = $this->Publisher_Model->get_issues($this->session->userdata('user_id'), false, false,$mid);
			// print_r($data);
			 	$this->load->view('administrator/header-script');
		 	 	 $this->load->view('administrator/header');
		  		 $this->load->view('administrator/header-bottom', $data);
		   		 $this->load->view('publisher/issues', $data);
		  		$this->load->view('administrator/footer');
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
				// $this->form_validation->set_rules('country', 'Publishing Company', 'required');		
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
			   		 $this->load->view('publisher/update-magazines', $data);		
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
					$dataID = $this->Publisher_Model->update_magazine();	
					// print_r($dataID);die();	
					$this->session->set_flashdata('success', 'Magazine has been updated Successfull.');		
					redirect('publisher/magazines/magazines');		
				}		
		}


		public function update_issues($id = NULL)		
		{		
					// echo $id;exit;
			if($this->input->post('id'))		
			{		
				$id = $this->input->post('id');		
			}	

			$data['magazines'] = $this->Publisher_Model->get_single_issue($id);	
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
			   		 $this->load->view('publisher/update-issues', $data);		
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
				$magazineson = $this->Publisher_Model->get_single_issue($this->input->post('id'));		
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
					$dataID = $this->Publisher_Model->update_issue($post_image, $preview_magazine, $paid_magazine);	
					// print_r($dataID);die();	
					$this->session->set_flashdata('success', 'Magazine has been updated Successfull.');		
					redirect('publisher/magazines/magazines');		
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
			   	$this->load->view('publisher/'.$page, $data);
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
				$this->Publisher_Model->create_blog($post_image);

				//Set Message
				$this->session->set_flashdata('post_created', 'Your article has been created.');
				redirect('publisher/blogs/list-blog');
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
			$data['blogs'] = $this->Publisher_Model->listblogs(FALSE, FALSE, FALSE);

			$this->load->view('administrator/header-script');
			$this->load->view('administrator/header');
			$this->load->view('administrator/header-bottom', $data);
			$this->load->view('publisher/list-blogs', $data);
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
			$data['post'] = $this->Publisher_Model->listblogs($blogId);

			$this->form_validation->set_rules('title', 'Title', 'required');
			$this->form_validation->set_rules('body', 'Body', 'required');

			if($this->form_validation->run() === FALSE){
				$this->load->view('administrator/header-script');
			   	$this->load->view('administrator/header');
			   	$this->load->view('administrator/header-bottom', $data);
			   	$this->load->view('publisher/update-blog', $data);
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
					$data['postimg'] = $this->Publisher_Model->listblogs($this->input->post('id'));
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

				$this->Publisher_Model->update_blog_data($post_image);

			    //Set Message
			    $this->session->set_flashdata('success', 'Article has been Updated Successfully.');
			    redirect('publisher/blogs/list-blog');
			}
		}
		
	}
	