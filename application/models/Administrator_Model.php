<?php
	class Administrator_Model extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}

		public function adminLogin($email, $encrypt_password){
			//Validate
			$this->db->where('email', $email);
			$this->db->where('password', $encrypt_password);

			$result = $this->db->get('users');

			if ($result->num_rows() == 1) {
				return $result->row(0);
			}else{
				return false;
			}
		}
		public function articals_totalcount()
		{
			// $this->db->where('user_id', $id);
			// $this->db->where('status',$status);
			$query = $this->db->count_all_results('posts');
			
			return $query;
		}

		public function get_posts($slug = FALSE)
		{
			if($slug === FALSE){
				$query = $this->db->order_by('id', 'DESC');
				$query = $this->db->get('posts');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('posts', array('slug' => $slug));
			return $query->row_array();
		}

		public function create_post()
		{
			$slug = url_title($this->input->post('title'), "dash", TRUE);

			$data = array(
				'title' => $this->input->post('title'), 
			    'slug' => $slug,
			    'body' => $this->input->post('body'),
			    'category_id' => $this->input->post('category_id')
			    );
			return $this->db->insert('posts', $data);
		}

		public function deletepub($id)
		{	

			$this->db->where('id', $id);
			$t=$this->db->delete('users');
			// print_r($this->db->last_query());exit;
			if($t){
				$this->db->where('user_id', $id);
				$this->db->delete('publisher_details');

				// return true;
			}
			
		}
		public function delete($id,$table)
		{
			$this->db->where('id', $id);
			$this->db->delete($table);
			return true;
		}

		public function delete_transaction_by_oid($id){
			$this->db->where('order_id', $id);
			$this->db->delete('transaction');
		}
		
		public function get_categories(){
			$this->db->order_by("id", "DESC");
			$query = $this->db->get('categories');
			return $query->result_array();
		}

		public function add_user($post_image,$password)
		{
			$data = array('name' => $this->input->post('name'), 
							'email' => $this->input->post('email'),
							'password' => $password,
							'username' => $this->input->post('username'),
							'zipcode' => $this->input->post('zipcode'),
							'contact' => $this->input->post('contact'),
							'address' => $this->input->post('address'),
							'gender' => $this->input->post('gender'),
							'role_id' => '2',
							'status' => $this->input->post('status'),
							'dob' => $this->input->post('dob'),
							'image' => $post_image,
							'password' => $password,
							'register_date' => date("Y-m-d H:i:s")

						  );
			return $this->db->insert('users', $data);
		}
		public function getcountry()
		{
			$query = $this->db->get('country');
				return $query->result_array();
		}
		public function add_publisher()
		{
			$data = array(
							'name' => $this->input->post('firstname')." ".$this->input->post('firstname'), 
							'username' => $this->input->post('firstname'), 
							'email' => $this->input->post('email'),
							'password' => md5($this->input->post('password')),
							'zipcode' => $this->input->post('zip'),
							'contact' => $this->input->post('mobile'),
							'address' => $this->input->post('address1'),
							'role_id' => '3',
							'status' => 0,
							'register_date' => date("Y-m-d H:i:s")

						  );
			
			$this->db->insert('users', $data);
			$insert_id = $this->db->insert_id();
			if($insert_id){
				$publisherdata = array(
							'publisher' => $this->input->post('publisher'), 
							'mag_no' => $this->input->post('magNo'), 
							'country' => $this->input->post('country'),
							'hear' => $this->input->post('hear'),
							'user_id' => $insert_id
						  );
				return $this->db->insert('publisher_details', $publisherdata);
			}
			// echo "<pre>";print_r($insert_id);
			 
		}
		public function users_count($roll)
		{
			$this->db->where('role_id', $roll);
			// $this->db->where('status', 1);
			$query = $this->db->count_all_results('users');
			
			return $query;
		}
		public function magazines_count()
		{
			// $this->db->where('role_id', $roll);
			// $this->db->where('status', 1);
			$query = $this->db->count_all_results('add_magazines');
			
			return $query;
		}
		public function get_publishers($username = FALSE, $limit = FALSE, $offset = FALSE)
		{
			if ($limit) {
				$this->db->limit($limit, $offset);
			}

			if($username === FALSE){
				$this->db->select('users.id, users.name, users.email,users.contact,users.status,publisher_details.publisher,publisher_details.mag_no, publisher_details.hear, country.nicename');
				$this->db->order_by('users.id', 'DESC');
				$this->db->join('users', 'users.id = publisher_details.user_id','right');
				$this->db->join('country', 'country.id = publisher_details.country','right');
				$this->db->where('users.role_id', 3);
				$query = $this->db->get('publisher_details');
				// echo $this->db->last_query();exit;
				return $query->result_array(); 
			}

			$query = $this->db->get_where('users', array('username' => $username));
			return $query->row_array();
		}

		public function get_users($username = FALSE, $limit = FALSE, $offset = FALSE)
		{
			if ($limit) {
				$this->db->limit($limit, $offset);
			}

			if($username === FALSE){
				$this->db->order_by('users.id', 'DESC');
				//$this->db->join('categories', 'categories.id = posts.category_id');
				$this->db->where('users.role_id', 2);
				$query = $this->db->get('users');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('users', array('username' => $username));
			return $query->row_array();
		}

		public function enable($id,$table){
			$data = array(
				'status' => 0
			    );
			$this->db->where('id', $id);
			return $this->db->update($table, $data);
		}
		public function desable($id,$table){
			$data = array(
				'status' => 1
			    );
			$this->db->where('id', $id);
			return $this->db->update($table, $data);
		}

		public function get_user($id = FALSE)
		{
			if($id === FALSE){
				$query = $this->db->get('users');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('users', array('id' => $id));
			return $query->row_array();
		}
		public function get_publisher($id = FALSE)
		{
			if($id === FALSE){
				$this->db->select('users.id as id,users.name, users.email,users.contact,users.status,publisher_details.publisher,publisher_details.mag_no, publisher_details.hear, country.nicename');
				$this->db->order_by('users.id', 'DESC');
				$this->db->join('users', 'users.id = publisher_details.user_id','right');
				$this->db->join('country', 'country.id = publisher_details.country','right');
				$this->db->where('role_id', 3);
				$query = $this->db->get('publisher_details');
				return $query->result_array(); 
			}
				$this->db->select('users.id,users.username,users.address,users.zipcode, users.name, users.email,users.contact,users.status,publisher_details.*, country.nicename,country.id as cid');
				$this->db->join('users', 'users.id = publisher_details.user_id','right');
				$this->db->join('country', 'country.id = publisher_details.country','right');
				$this->db->where('users.role_id', 3);
				$this->db->where('users.id', $id);
				$query = $this->db->get('publisher_details');
			// $query = $this->db->get_where('users', array('id' => $id));
			return $query->row_array();
		}
		public function update_user_data($post_image)
		{ 
			$data = array(
							'name' => $this->input->post('name'),
							'zipcode' => $this->input->post('zipcode'),
							'contact' => $this->input->post('contact'),
							'address' => $this->input->post('address'),
							'gender' => $this->input->post('gender'),
							'status' => $this->input->post('status'),
							'dob' => $this->input->post('dob'),
							'image' => $post_image,
							'register_date' => date("Y-m-d H:i:s")
						  );

			$this->db->where('id', $this->input->post('id'));
			$d = $this->db->update('users', $data);
		}

		public function update_publisher_data()
		{ 
			// echo "<pre>";print_r($this->input->post());
			$publisherdata = array(
							'name' => $this->input->post('name'),
							'email' => $this->input->post('email'),
							'zipcode' => $this->input->post('zipcode'),
							'contact' => $this->input->post('contact'),
							'address' => $this->input->post('address'),
							'status' => $this->input->post('status'),
							
						  );
			$pub_details = array(
							'publisher' => $this->input->post('publisher'),
							'mag_no' => $this->input->post('magNo'),
							'country' => $this->input->post('country'),
							'hear' => $this->input->post('hear'),
														
						  );

			$this->db->where('id', $this->input->post('id'));
			$d = $this->db->update('users', $publisherdata);
			if($d){
				$this->db->where('user_id', $this->input->post('id'));
				$this->db->update('publisher_details', $pub_details);
			}
			 
		}

		public function create_product_category()
		{
			$slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($this->input->post('name'))));

			$query = $this->db->query("SELECT COUNT(*) AS NumHits FROM categories WHERE  slug  LIKE '$slug%' and type = 'product'");
			$row = $query->row_array();
			$numHits = $row['NumHits'];
			$slugs = ($numHits > 0) ? ($slug . '-' . $numHits) : $slug;
			$data = array(
				'name' => $this->input->post('name'),
				'type' => 'product',
				'slug' => $slugs,
				'status' => $this->input->post('status'),
				'user_id' => $this->session->userdata('user_id')
			    );
			return $this->db->insert('categories', $data);
		}

		public function product_categories(){
			$this->db->order_by('id','desc');
			$this->db->where('type', 'product');
			$query = $this->db->get('categories');
			return $query->result_array();
		}

		public function update_product_category_data()
		{
			$data = array('name' => $this->input->post('name'),
							'status' => $this->input->post('status')
						  );

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('categories', $data);
		}

		public function update_product_category($id = FALSE)
		  {
		   if($id === FALSE){
		    $query = $this->db->get('categories');
		    return $query->result_array(); 
		   }

		   $query = $this->db->get_where('categories', array('id' => $id));
		   return $query->row_array();
		  }


		public function create_product($post_image)
		{
			$data = array('name' => $this->input->post('name'), 
							'sku' => $this->input->post('sku'),
							'save_price' => $this->input->post('save_price'),
							'price' => $this->input->post('price'),
							'user_id' => $this->session->userdata('user_id'),
							'quantity' => $this->input->post('quantity'),
							'color' => $this->input->post('color'),
							'tag' => $this->input->post('tag'),
							'short_description' => $this->input->post('short_description'),
							'cat_id' => $this->input->post('cat_id'),
							'size' => $this->input->post('size'),
							'status' => $this->input->post('status'),
							'description' => $this->input->post('description'),
							'meta_title' => $this->input->post('meta_title'),
							'meta_desc' => $this->input->post('meta_desc'),
							'meta_tag' => $this->input->post('meta_tag'),
							'image' => $post_image,
							'datetime' => date("Y-m-d H:i:s")
						);
			$this->db->insert('products', $data);
			 return  $insert_id = $this->db->insert_id();
		}

		public function insertproductsmultipleImages($data = array()){
       	 $insert = $this->db->insert_batch('product_images',$data);
       	 return $insert?true:false;
    	}

		// Check Product SKU exists
		public function check_sku_exists($sku){
			$query = $this->db->get_where('products', array('sku' => $sku));

			if(empty($query->row_array())){
				return true;
			}else{
				return false;
			}
		}

		public function get_products($id = FALSE)
		{
			if($id === FALSE){
				$query = $this->db->get('products');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('products', array('id' => $id));
			return $query->row_array();
		}

		public function update_products($id = FALSE)
		{
			if($id === FALSE){
				$query = $this->db->get('products');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('products', array('id' => $id));
			return $query->row_array();
		}

		public function product_images($productId = FALSE){
			$this->db->order_by('id','desc');
			$this->db->where('product_id', $productId);
			$query = $this->db->get('product_images');
			return $query->result_array();
		}

		public function update_products_data($post_image)
		{
			$data = array('name' => $this->input->post('name'), 
							'save_price' => $this->input->post('save_price'),
							'price' => $this->input->post('price'),
							'user_id' => $this->session->userdata('user_id'),
							'quantity' => $this->input->post('quantity'),
							'color' => $this->input->post('color'),
							'tag' => $this->input->post('tag'),
							'short_description' => $this->input->post('short_description'),
							'cat_id' => $this->input->post('cat_id'),
							'size' => $this->input->post('size'),
							'status' => $this->input->post('status'),
							'description' => $this->input->post('description'),
							'meta_title' => $this->input->post('meta_title'),
							'meta_desc' => $this->input->post('meta_desc'),
							'meta_tag' => $this->input->post('meta_tag'),
							'image' => $post_image,
							'datetime' => date("Y-m-d H:i:s")
						);
			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('products', $data);
		}

		public function create_faq_category()
		{
			$data = array(
				'name' => $this->input->post('name'),
				'type' => 'faq',
				'status' => $this->input->post('status'),
				'user_id' => $this->session->userdata('user_id')
			    );
			return $this->db->insert('categories', $data);
		}

		public function faq_categories(){
			$this->db->order_by('id','desc');
			$this->db->where('type', 'faq');
			$query = $this->db->get('categories');
			return $query->result_array();
		}

		public function update_faq_category_data()
		{
			$data = array('name' => $this->input->post('name'),
							'status' => $this->input->post('status')
						  );

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('categories', $data);
		}

		public function update_faq_category($id = FALSE)
		 {
		   	if($id === FALSE){
		    $query = $this->db->get('categories');
		    return $query->result_array(); 
		}
			$query = $this->db->get_where('categories', array('id' => $id));
			return $query->row_array();
		}


		//faq models functions start

		 public function create_faq()
		{
			$data = array('question' => $this->input->post('question'), 
							'answer' => $this->input->post('answer'),
							'faq_cat_id' => $this->input->post('faq_cat_id'),
							'status' => 1,
							'datetime' => date("Y-m-d H:i:s")
						);
			return $this->db->insert('faqs', $data);
		}


		public function get_faqs()
		{
			$this->db->select('categories.name catName, faqs.id as faqId,faqs.question,faqs.answer,faqs.datetime,faqs.status as faqStatus');
			$this->db->from('faqs');
			$this->db->join('categories', 'categories.id = faqs.faq_cat_id');
				
				$query=$this->db->get();
				return $data=$query->result_array();
		}

		public function update_faqs($id = FALSE)
		{
			if($id === FALSE){
				$query = $this->db->get('faqs');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('faqs', array('id' => $id));
			return $query->row_array();
		}

		public function update_faq_data()
		{
			$data = array('question' => $this->input->post('question'), 
							'answer' => $this->input->post('answer'),
							'faq_cat_id' => $this->input->post('faq_cat_id'),
							'status' => 1,
							'datetime' => date("Y-m-d H:i:s")
						);
			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('faqs', $data);
		}

		//sco pages details start
		public function get_scopages($id = FALSE)
		{
			if($id === FALSE){
				$query = $this->db->get('sco');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('sco', array('id' => $id));
			return $query->row_array();
		}

		public function update_scopages($id = FALSE)
		{
			if($id === FALSE){
				$query = $this->db->get('sco');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('sco', array('id' => $id));
			return $query->row_array();
		}

		public function update_scopages_data($id = FALSE)
		{
			$data = array('title' => $this->input->post('title'), 
							'keywords' => $this->input->post('keywords'),
							'description' => $this->input->post('description')
						);
			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('sco', $data);
		}

		//social links
		public function get_sociallinks($id = FALSE)
		{
			if($id === FALSE){
				$query = $this->db->get('sociallinks');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('sociallinks', array('id' => $id));
			return $query->row_array();
		}

		public function update_sociallinks($id = FALSE)
		{
			if($id === FALSE){
				$query = $this->db->get('sociallinks');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('sociallinks', array('id' => $id));
			return $query->row_array();
		}

		public function update_sociallinks_data($id = FALSE)
		{
			$data = array('link' => $this->input->post('link'));
			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('sociallinks', $data);
		}

		//slider
		public function create_slider($post_image)
		{
			$data = array('title' => $this->input->post('title'), 
							'image' => $post_image,
							'description' => $this->input->post('description'),
							'status' => $this->input->post('status')
						  );
			return $this->db->insert('sliders_img', $data);
		}

		public function get_sliders($id = false)
		{
			if($id === FALSE){
				$query = $this->db->get('sliders_img');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('sliders_img', array('id' => $id));
			return $query->row_array();
		}

		public function get_slider_data($id = FALSE)
		{
			if($id === FALSE){
				$query = $this->db->get('sliders_img');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('sliders_img', array('id' => $id));
			return $query->row_array();
		}

		public function update_slider_data($post_image)
		{
			$data = array('title' => $this->input->post('title'), 
							'image' => $post_image,
							'description' => $this->input->post('description'),
							'status' => $this->input->post('status')
						  );

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('sliders_img', $data);
		}

		// blogs models functions starts
		public function create_blog($post_image)
		{
			$slug = url_title($this->input->post('title'), "dash", TRUE);

			$data = array(
				'title' => $this->input->post('title'), 
			    'slug' => $slug,
			    'body' => $this->input->post('body'),
			    'magazine_id' => $this->input->post('magazine_id'),
			    'category_id' => $this->input->post('category_id'),
			    'post_image' => $post_image,
			    'user_id' => $this->session->userdata('user_id')
			    );
			return $this->db->insert('posts', $data);
		}

		public function listblogs($blogId = FALSE, $limit = FALSE, $offset = FALSE)
		{
			if ($limit) {
				$this->db->limit($limit, $offset);
			}

			if($blogId === FALSE){
				$this->db->order_by('posts.id', 'DESC');
				//$this->db->join('categories as cat', 'cat.id = posts.category_id');
				$query = $this->db->get('posts');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('posts', array('id' => $blogId));
			return $query->row_array();
		}

	
		public function update_blog_data($post_image){
			$slug = url_title($this->input->post('title'), "dash", TRUE);
			$data = array(
				'title' => $this->input->post('title'), 
			    'slug' => $slug,
			    'body' => $this->input->post('body'),
			    'magazine_id' => $this->input->post('magazine_id'),
			    'category_id' => $this->input->post('category_id'),
			    'post_image' => $post_image
			    );
			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('posts', $data);
		}

		public function list_blog_comments()
		{
			$this->db->select('comments.username, comments.email, comments.comment, comments.id as commentId, comments.created_at createdAt, comments.status as commentStatus, posts.title as blogTitle');
			$this->db->from('comments');
			$this->db->join('posts', 'posts.id = comments.post_id');
			$this->db->where('comments.comment_type', 'blog');

				$query=$this->db->get();
				return $data=$query->result_array();
		}

		public function view_blog_comments($id = FALSE)
		{

			if($id === FALSE){
				$query = $this->db->get('comments');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('comments', array('id' => $id));
			return $query->row_array();

			
		}

		public function create_blog_category()
		{
			$slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($this->input->post('name'))));

			$query = $this->db->query("SELECT COUNT(*) AS NumHits FROM categories WHERE  slug  LIKE '$slug%' and type = 'product'");
			$row = $query->row_array();
			$numHits = $row['NumHits'];
			$slugs = ($numHits > 0) ? ($slug . '-' . $numHits) : $slug;
			$data = array(
				'name' => $this->input->post('name'),
				'type' => 'blog',
				'slug' => $slugs,
				'status' => $this->input->post('status'),
				'user_id' => $this->session->userdata('user_id')
			    );
			return $this->db->insert('categories', $data);
		}

		public function blog_categories(){
			$this->db->order_by('id','desc');
			$this->db->where('type', 'blog');
			$query = $this->db->get('categories');
			return $query->result_array();
		}

		public function update_blog_category_data()
		{
			$data = array('name' => $this->input->post('name'),
							'status' => $this->input->post('status')
						  );

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('categories', $data);
		}

		public function update_blog_category($id = FALSE)
		  {
		   if($id === FALSE){
		    $query = $this->db->get('categories');
		    return $query->result_array(); 
		   }

		   $query = $this->db->get_where('categories', array('id' => $id));
		   return $query->row_array();
		  }



		//social links
		public function get_siteconfiguration($id = FALSE)
		{
			if($id === FALSE){
				$query = $this->db->get('site_config');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('site_config', array('id' => $id));
			return $query->row_array();
		}

		public function update_siteconfiguration($id = FALSE)
		{
			if($id === FALSE){
				$query = $this->db->get('site_config');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('site_config', array('id' => $id));
			return $query->row_array();
		}

		public function update_siteconfiguration_data($post_image)
		{
			$data = array('site_title' => $this->input->post('site_title'),
						  'site_name' => $this->input->post('site_name'),
						  'company_address' => $this->input->post('company_address'),
						  'logo_img' => $post_image
						);

			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('site_config', $data);
		}

		//Page Content pages details start
		public function get_pagecontents($id = FALSE)
		{
			if($id === FALSE){
				$query = $this->db->get('page_content');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('page_content', array('id' => $id));
			return $query->row_array();
		}

		public function update_pagecontents($id = FALSE)
		{
			if($id === FALSE){
				$query = $this->db->get('page_content');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('page_content', array('id' => $id));
			return $query->row_array();
		}

		public function update_pagecontents_data($id = FALSE)
		{
			$data = array('page_name' => $this->input->post('page_name'), 
							'content' => $this->input->post('content'),
							'updated_datetime' => date("Y-m-d H:i:s")
						);
			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('page_content', $data);
		}

		public function get_galleries_images(){
			$this->db->order_by('id','desc');
			$query = $this->db->get('galleries');
			return $query->result_array();
		}

		public function create_team($team_image)
		{

			$data = array(
				'name' => $this->input->post('name'), 
			    'designation' => $this->input->post('designation'),
			    'description' => $this->input->post('description'),
			    'image' => $team_image,
			    'status' => $this->input->post('status')
			    );
			return $this->db->insert('teams', $data);
		}

		public function listteams($teamId = FALSE, $limit = FALSE, $offset = FALSE)
		{
			if ($limit) {
				$this->db->limit($limit, $offset);
			}

			if($teamId === FALSE){
				$this->db->order_by('teams.id', 'DESC');
				//$this->db->join('categories as cat', 'cat.id = posts.category_id');
				$query = $this->db->get('teams');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('teams', array('id' => $teamId));
			return $query->row_array();
		}

		public function update_team_data($post_image){
			//$slug = url_title($this->input->post('title'), "dash", TRUE);
			$data = array(
				'name' => $this->input->post('name'), 
			    'designation' => $this->input->post('designation'),
			    'description' => $this->input->post('description'),
			    'image' => $post_image
			    );
			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('teams', $data);
		}

		public function create_testimonial($uploaded_image)
		{

			$data = array(
				'name' => $this->input->post('name'), 
			    'domain' => $this->input->post('domain'),
			    'description' => $this->input->post('description'),
			    'image' => $uploaded_image,
			    'status' => $this->input->post('status')
			    );
			return $this->db->insert('testimonials', $data);
		}

		public function listtestimonial($id = FALSE, $limit = FALSE, $offset = FALSE)
		{
			if ($limit) {
				$this->db->limit($limit, $offset);
			}

			if($id === FALSE){
				$this->db->order_by('testimonials.id', 'DESC');
				//$this->db->join('categories as cat', 'cat.id = posts.category_id'); 
				$query = $this->db->get('testimonials');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('testimonials', array('id' => $id));
			return $query->row_array();
		}

		public function update_testimonial_data($uploaded_image){
			//$slug = url_title($this->input->post('title'), "dash", TRUE);
			$data = array(
				'name' => $this->input->post('name'), 
			    'domain' => $this->input->post('domain'),
			    'description' => $this->input->post('description'),
			    'image' => $uploaded_image,
			    'status' => $this->input->post('status')
			    );
			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('testimonials', $data);
		}

		public function get_admin_data()
		{
			$id = $this->session -> userdata('user_id');
			if($id === FALSE){
				$query = $this->db->get('users');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('users', array('id' => $id));
			return $query->row_array();
		}

		public function change_password($new_password){

			$data = array(
				'password' => md5($new_password)
			    );
			$this->db->where('id', $this->session->userdata('user_id'));
			return $this->db->update('users', $data);
		}

		public function match_old_password($password)
		{
			$id = $this->session -> userdata('user_id');
			if($id === FALSE){
				$query = $this->db->get('users');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('users', array('password' => $password));
			return $query->row_array();

		}

		// function start fron forget password

		public function email_exists(){
    $email = $this->input->post('email');
    $query = $this->db->query("SELECT email, password FROM users WHERE email='$email'");    
    if($row = $query->row()){
        return TRUE;
    }else{
        return FALSE;
    }
}
public function temp_reset_password($temp_pass){
    $data =array(
                'email' =>$this->input->post('email'),
                'reset_pass'=>$temp_pass);
                $email = $data['email'];

    if($data){
        $this->db->where('email', $email);
        $this->db->update('users', $data);  
        return TRUE;
    }else{
        return FALSE;
    }

}
public function is_temp_pass_valid($temp_pass){
    $this->db->where('reset_pass', $temp_pass);
    $query = $this->db->get('users');
    if($query->num_rows() == 1){
        return TRUE;
    }
    else return FALSE;
}

		public function countries(){
			$this->db->order_by('id','asc');
			$query = $this->db->get('country');
			return $query->result_array();
		}

		public function getlanguages(){
			$this->db->order_by('id','asc');
			$query = $this->db->get('languages');
			return $query->result_array();
		}

		public function getmagzine_frequency(){
			$this->db->order_by('id','asc');
			$query = $this->db->get('magazine_frequency');
			return $query->result_array();
		}

		public function getage_rates(){
			$this->db->order_by('id','asc');
			$query = $this->db->get('magzine_age_rating');
			return $query->result_array();
		}
		public function removeAccents($str) {
		  $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή');
		  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η');
		  return str_replace($a, $b, $str);
		}
		public function create_issue($cover, $preview, $paid_docs,$id)
		{

			$cover =  $cover;
			$preview = implode(', ', $preview);
			$paid_docs = implode(', ', $paid_docs);
			//slug functionality
			$slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($this->removeAccents($this->input->post('name')).'_'.date('d-F-Y', strtotime($this->input->post('publishing_date'))))));

			$query = $this->db->query("SELECT COUNT(*) AS NumHits FROM issues WHERE  slug  LIKE '$slug%'");
			$row = $query->row_array();
			$numHits = $row['NumHits'];
			$slugs = ($numHits > 0) ? ($slug . '-' . $numHits) : $slug;

			$data = array(	'issue_name' => $this->input->post('name'),
							'description' => $this->input->post('description'),
							'publishing_date' => date('Y-m-d', strtotime($this->input->post('publishing_date'))),
							'cover' => $cover,
							'slug' => $slugs,
							'preview' => $preview,
							'paid' => $paid_docs,
							'm_id' => $id,
							'issue_price' => $this->input->post('price_per_issue')
						);
			
			$this->db->insert('issues', $data);
			return  $insert_id = $this->db->insert_id();
		}

		public function create_magazine()
		{

			// $cover =  $cover;
			// $preview = implode(', ', $preview);
			// $paid_docs = implode(', ', $paid_docs);
			$languages = implode(', ', $this->input->post('languages'));
			$datapublisher = $this->Administrator_Model->get_publisher($this->input->post('publisher_company'));
			// if(!empty($this->input->post('country_block'))){
			// 	$country_block = implode(', ', $this->input->post('country_block'));
			// }else{
			// 	$country_block=NULL;
			// }
			$country_block =($this->input->post('country_block'))? implode(', ', $this->input->post('country_block')):NULL;
			//slug
			$slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($this->removeAccents($this->input->post('name')))));

			$query = $this->db->query("SELECT COUNT(*) AS NumHits FROM add_magazines WHERE  slug  LIKE '$slug%'");
			$row = $query->row_array();
			$numHits = $row['NumHits'];
			$slugs = ($numHits > 0) ? ($slug . '-' . $numHits) : $slug;

			$data = array(	'name' => $this->input->post('name'),
							'slug' => $slugs,
							'publisher_company' => $datapublisher['publisher'],
							'description' => $this->input->post('description'),
							'primary_category' => $this->input->post('primary_category'),
							'sub_category' => $this->input->post('sub_category'),
							'age_rating' => $this->input->post('age_rating'),
							'keywords' => $this->input->post('keywords'),
							'website_url' => $this->input->post('website_url'),
							// 'publishing_date' => date('Y-m-d', strtotime($this->input->post('publishing_date'))),
							'country_publish_form' => $this->input->post('country_publish_form'),
							'country_block' => $country_block,
							'price_per_issue' => $this->input->post('price_per_issue'),
							'magazine_three_mon_sub' => $this->input->post('magazine_three_mon_sub'),
							'magazine_three_mon_sub_price' => $this->input->post('magazine_three_mon_sub_price'),
							'magazine_six_mon_sub' => $this->input->post('magazine_six_mon_sub'),
							'magazine_six_mon_sub_price' => $this->input->post('magazine_six_mon_sub_price'),
							'magazine_twelve_mon_sub' => $this->input->post('magazine_twelve_mon_sub'),
							'magazine_twelve_mon_sub_price' => $this->input->post('magazine_twelve_mon_sub_price'),
							'frequency' => $this->input->post('frequency'),
							'languages' => $languages,
							// 'cover' => $cover,
							// 'preview' => $preview,
							// 'paid' => $paid_docs,
							'user_id' => $this->input->post('publisher_company')
						);
			$this->db->insert('add_magazines', $data);
			return  $insert_id = $this->db->insert_id();
		}
		public function get_single_issue($id)
		{

			$query = $this->db->get_where('issues', array('id' => $id));
			return $query->row_array();
		}
		
		public function get_single_issue_by_mid($id)
		{

			$query = $this->db->get_where('issues', array('m_id' => $id));
			return $query->result_array();
		}

		public function update_issue($cover, $preview, $paid_docs)
		{

			$cover =  $cover;
			$preview = implode(', ', $preview);
			$paid_docs = implode(', ', $paid_docs);
			$data = array(	'issue_name' => $this->input->post('name'), 
							'description' => $this->input->post('description'),
							'issue_price' => $this->input->post('price_per_issue'),
							'publishing_date' => date('Y-m-d', strtotime($this->input->post('publishing_date'))),
							'cover' => $cover,
							'preview' => $preview,
							'paid' => $paid_docs,
							
						);
			$this->db->where('id', $this->input->post('id'));
			$query=$this->db->update('issues', $data);
			// return $this->db->last_query();
			return  true;
		}

		public function get_issues($username = FALSE, $limit = FALSE, $offset = FALSE,$mid)
		{
			if ($limit) {
				$this->db->limit($limit, $offset);
			}

			if($username === FALSE){
				$this->db->order_by('issues.id', 'DESC');
				//$this->db->join('categories', 'categories.id = posts.category_id');
				$this->db->where('m_id', $mid);
				$query = $this->db->get('issues');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('issues', array('m_id' => $mid));
			return $query->result_array();
		}

		public function get_magazines($username = FALSE, $limit = FALSE, $offset = FALSE)
		{
			if ($limit) {
				$this->db->limit($limit, $offset);
			}

			if($username === FALSE){
				$this->db->order_by('add_magazines.id', 'DESC');
				//$this->db->join('categories', 'categories.id = posts.category_id');
				$query = $this->db->get('add_magazines');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('add_magazines', array('user_id' => $username));
			return $query->result_array();
		}

		public function get_category_details($category_id)
		{
			$query = $this->db->get_where('categories', array('id' => $category_id));
			return $query->row_array();
		}

		public function get_country_details($country_id)
		{
			$query = $this->db->get_where('country', array('id' => $country_id));
			return $query->row_array();
		}

		public function get_user_details($user_id)
		{
			$query = $this->db->get_where('users', array('id' => $user_id));
			return $query->row_array();
		}

		public function get_single_magazines($id)
		{

			$query = $this->db->get_where('add_magazines', array('id' => $id));
			return $query->row_array();
		}

		public function update_magazine()
		{

			// $cover =  $cover;
			// $preview = implode(', ', $preview);
			// $paid_docs = implode(', ', $paid_docs);
			$languages = implode(', ', $this->input->post('languages'));
			$datapublisher = $this->Administrator_Model->get_publisher($this->input->post('publisher_company'));
			$country_block = implode(', ', $this->input->post('country_block'));
			$data = array('name' => $this->input->post('name'), 
							'publisher_company' => $datapublisher['publisher'],
							'description' => $this->input->post('description'),
							'primary_category' => $this->input->post('primary_category'),
							'sub_category' => $this->input->post('sub_category'),
							'age_rating' => $this->input->post('age_rating'),
							'keywords' => $this->input->post('keywords'),
							'website_url' => $this->input->post('website_url'),
							// 'publishing_date' => date('Y-m-d', strtotime($this->input->post('publishing_date'))),
							'country_publish_form' => $this->input->post('country_publish_form'),
							'country_block' => $country_block,
							'price_per_issue' => $this->input->post('price_per_issue'),
							'magazine_three_mon_sub' => $this->input->post('magazine_three_mon_sub'),
							'magazine_three_mon_sub_price' => $this->input->post('magazine_three_mon_sub_price'),
							'magazine_six_mon_sub' => $this->input->post('magazine_six_mon_sub'),
							'magazine_six_mon_sub_price' => $this->input->post('magazine_six_mon_sub_price'),
							'magazine_twelve_mon_sub' => $this->input->post('magazine_twelve_mon_sub'),
							'magazine_twelve_mon_sub_price' => $this->input->post('magazine_twelve_mon_sub_price'),
							'frequency' => $this->input->post('frequency'),
							'languages' => $languages,
							// 'cover' => $cover,
							// 'preview' => $preview,
							// 'paid' => $paid_docs,
							'user_id' => $this->input->post('publisher_company')
						);
			$this->db->where('id', $this->input->post('id'));
			$query=$this->db->update('add_magazines', $data);
			// return $this->db->last_query();
			return  true;
		}

		public function get_single_post($id)
		{
			$query = $this->db->get_where('posts', array('id' => $id));
			return $query->row_array();
		}

		

		public function get_transactions($limit = FALSE, $offset = FALSE)
		{
			if ($limit) {
				$this->db->limit($limit, $offset);
			}

			// $this->db->where('status', 0);
			// $this->db->select('*,orders.status as ostatus,orders.id as oid');
			$this->db->select('orders.*');
			$this->db->from('add_magazines');
			$this->db->join('issues', 'issues.m_id = add_magazines.id');
			$this->db->join('transaction', 'transaction.product_id = issues.id');
			$this->db->join('orders', 'orders.id = transaction.order_id');
			$this->db->join('users', 'users.id = orders.user_id');
			// $this->db->where('add_magazines.user_id', $username);
			$this->db->group_by("transaction.order_id");
			$query = $this->db->get();//$this->db->get_where('orders', array('id' => $id));
			return $query->result_array();
			 //$this->db->last_query();
			  //count($query->result_array());
		}

		public function get_transactions_count()
		{					 
			$this->db->select('orders.*');
			$this->db->from('add_magazines');
			$this->db->join('issues', 'issues.m_id = add_magazines.id');
			$this->db->join('transaction', 'transaction.product_id = issues.id');
			$this->db->join('orders', 'orders.id = transaction.order_id');
			$this->db->join('users', 'users.id = orders.user_id');
			// $this->db->where('add_magazines.user_id', $username);
			$this->db->group_by("transaction.order_id");
			$query = $this->db->get();//$this->db->get_where('orders', array('id' => $id));
			 $query->result_array();
			 //$this->db->last_query();
			
			 return array('count'=>count($query->result_array()));
		}

		public function get_earning()
		{
			
					 
			$this->db->select('orders.*');
			$this->db->from('add_magazines');
			$this->db->join('issues', 'issues.m_id = add_magazines.id');
			$this->db->join('transaction', 'transaction.product_id = issues.id');
			$this->db->join('orders', 'orders.id = transaction.order_id');
			$this->db->join('users', 'users.id = orders.user_id');
			// $this->db->where('add_magazines.user_id', $username);
			$this->db->where('orders.status', 1);
			$this->db->group_by("transaction.order_id");
			$query = $this->db->get();//$this->db->get_where('orders', array('id' => $id));
			 
			 //$this->db->last_query();
			 $earning=0;
			 foreach ($query->result_array() as $key => $value) {
			 $earning=$earning+$value['amount'];
			 }
			 return array('earning'=>$earning*10/100,'Completed_orders'=>$query->result_array());
		}

	}