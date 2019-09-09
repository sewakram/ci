<?php
	class User_Model extends CI_Model{
		public function update_user_data($id)
		{ 
			$data = array(
							'name' => $this->input->post('name'),
							'zipcode' => $this->input->post('zipcode'),
							'contact' => $this->input->post('contact'),
							'address' => $this->input->post('address'),
							'gender' => $this->input->post('gender'),
							'dob' => $this->input->post('dob'),
						  );

			$this->db->where('id', $id);
			$d = $this->db->update('users', $data);
		}
		public function change_password($new_password){

			$data = array(
				'password' => md5($new_password)
			    );
			$this->db->where('id', $this->session->userdata('user_id'));
			return $this->db->update('users', $data);
		}
		public function get_user($id = FALSE)
		{
			if($id === FALSE){
				$query = $this->db->get('users');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('users', array('id' => $id));//print_r($this->db->last_query());exit;die();
			return $query->row_array();

		}
		public function print_order($id)
		{	
			$this->db->select('*,orders.status as ostatus,orders.id as oid');
			$this->db->from('orders');
			$this->db->join('users', 'users.id = orders.user_id');
			$this->db->where('orders.id', $id);
			$this->db->where('orders.user_id', $this->session->userdata('user_id'));
			$query = $this->db->get();//$this->db->get_where('orders', array('id' => $id));
			return $query->row_array();
		}

		public function update_order_status($id,$status)
		{	
			$data = array(
				'status' => $status
			    );
			$this->db->where('id', $id);
			  return $this->db->update('orders', $data);
			   // $this->db->last_query();
		}

		public function print_products($id)
		{	
			$this->db->select('*');
			$this->db->from('transaction');
			$this->db->join('issues', 'transaction.product_id = issues.id');
			$this->db->where('transaction.order_id', $id);
			$this->db->where('transaction.user_id', $this->session->userdata('user_id'));
			$query = $this->db->get();//$this->db->get_where('orders', array('id' => $id));
			return $query->result_array();
			 //$this->db->last_query();
		}

		public function get_subscriptions($pt)
		{	
			$this->db->select('issues.*');
			$this->db->from('transaction');
			$this->db->join('issues', 'transaction.product_id = issues.id');
			$this->db->join('orders', 'transaction.order_id = orders.id');
			$this->db->where('orders.status', 1);
			$this->db->where('transaction.pricetype', $pt);
			// $this->db->where('transaction.order_id', $id);
			$this->db->where('transaction.user_id', $this->session->userdata('user_id'));			
			$query = $this->db->get();//$this->db->get_where('orders', array('id' => $id));
			return $query->result_array();
			  // $this->db->last_query();
		}

		public function get_orders($id)
		{
			$query = $this->db->get_where('orders', array('user_id' => $id));
			return $query->result_array();
		}
		public function register($encrypt_password){

			$data = array('name' => $this->input->post('name'), 
						  'email' => $this->input->post('email'),
						  'password' => $encrypt_password,
						  'username' => $this->input->post('username'),
						  'zipcode' => $this->input->post('zipcode'),
						  'role_id' => 2
						  );

			return $this->db->insert('users', $data);
		}

		public function login($username, $encrypt_password){
			//Validate
			$this->db->where('username', $username);
			$this->db->or_where('email ', $username);
			$this->db->where('password', $encrypt_password);
			
			$this->db->where('role_id', 2);

			$result = $this->db->get('users');
			// print_r($this->db->last_query());exit;
			if ($result->num_rows() == 1) {
				return $result->row(0);
			}else{
				return false;
			}
		}

		// Check Username exists
		public function check_username_exists($username){
			$query = $this->db->get_where('users', array('username' => $username));

			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}

		// Check email exists
		public function check_email_exists($email){
			$query = $this->db->get_where('users', array('email' => $email));

			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}

		public function email_exists(){
		$email = $this->input->post('username');
		$query = $this->db->query("SELECT id,email,name FROM users WHERE email='".$email."'");    
		// if($row = $query->row()){
		return $query->row();
		// }else{
		// return FALSE;
		// }
		}

		public function reset_password($id){
			// echo $id;exit;
			$data = array(
				'password' => md5($this->input->post('password'))
			    );
			$this->db->where('id', $id);
			 $this->db->update('users', $data);
			return $this->get_user($id);
		}

		  public function get_fav_data_condition($table1, $table2, $field, $data)
	      {
	          $this->db->select("$table2.slug as m_slug, $table1.slug as i_slug,, $table1.cover as i_cover, $table1.issue_name, categories.slug as c_slug");
		      $this->db->from("$table1");
		      $this->db->where("$table1.$field", $data);
		      $this->db->where("$table1.status", '1');
		      $this->db->join("$table2","$table2.id=$table1.m_id");
		      $this->db->join("categories","categories.id=$table2.primary_category");
		      $query=$this->db->get();
		      return $query->result_array();
	      }

	      public function get_all_data_condition($table,$field,$data)
	      {
	          return $this->db->where($field,$data)->get($table)->result();
	      }

	      public function register_google_oauth($data){
				return $this->db->insert('users', $data);
		  }

		  public function social_login($social, $username, $encrypt_password){
			//Validate
			$this->db->where('oauth_provider', $social);
			// $this->db->or_where('email ', $username);
			$this->db->where('oauth_uid', $encrypt_password);
			
			$this->db->where('role_id', 2);

			$result = $this->db->get('users');
			// print_r($this->db->last_query());exit;
			if ($result->num_rows() == 1) {
				return $result->row(0);
			}else{
				return false;
			}
		}



	}