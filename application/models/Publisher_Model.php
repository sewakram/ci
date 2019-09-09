<?php
	class Publisher_Model extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}
		public function magazines_count($id,$status)
		{
			$this->db->where('user_id', $id);
			$this->db->where('status',$status);
			$query = $this->db->count_all_results('add_magazines');
			
			return $query;
		}
		public function magazines_totalcount($id)
		{
			$this->db->where('user_id', $id);
			// $this->db->where('status',$status);
			$query = $this->db->count_all_results('add_magazines');
			
			return $query;
		}

		public function articals_totalcount($id)
		{
			$this->db->where('user_id', $id);
			// $this->db->where('status',$status);
			$query = $this->db->count_all_results('posts');
			
			return $query;
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
		public function product_categories(){
			$this->db->order_by('id','desc');
			$this->db->where('type', 'product');
			$this->db->where('status', '1');
			$query = $this->db->get('categories');
			return $query->result_array();
		}

		public function removeAccents($str) {
		  $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή');
		  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η');
		  return str_replace($a, $b, $str);
		}

		public function create_magazine()
		{

			
			$languages = implode(', ', $this->input->post('languages'));
			$country_block = ($this->input->post('country_block'))?implode(', ', $this->input->post('country_block')):NULL;
			//slug
			$slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($this->removeAccents($this->input->post('name')))));

			$query = $this->db->query("SELECT COUNT(*) AS NumHits FROM add_magazines WHERE  slug  LIKE '$slug%'");
			$row = $query->row_array();
			$numHits = $row['NumHits'];
			$slugs = ($numHits > 0) ? ($slug . '-' . $numHits) : $slug;
			$data = array('name' => $this->input->post('name'),
							'slug' => $slugs,
							'publisher_company' => $this->input->post('country'),
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
							'user_id' => $this->session->userdata('user_id')
						);
			
			$this->db->insert('add_magazines', $data);
			return  $insert_id = $this->db->insert_id();
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
							'preview' => $preview,
							'slug' => $slugs,
							'paid' => $paid_docs,
							'm_id' => $id,
							'issue_price' => $this->input->post('price_per_issue')
						);
			
			$this->db->insert('issues', $data);
			return  $insert_id = $this->db->insert_id();
		}

		public function get_transactions($username = FALSE, $limit = FALSE, $offset = FALSE)
		{
			if ($limit) {
				$this->db->limit($limit, $offset);
			}

			if($username === FALSE){
				// $this->db->order_by('add_magazines.id', 'DESC');
				// $this->db->where('status', 0);
				// //$this->db->join('categories', 'categories.id = posts.category_id');
				// $query = $this->db->get('add_magazines');
				// return $query->result_array(); 
			}
					 // $this->db->where('status', 0);
			// $this->db->select('*,orders.status as ostatus,orders.id as oid');
			$this->db->select('orders.*');
			$this->db->from('add_magazines');
			$this->db->join('issues', 'issues.m_id = add_magazines.id');
			$this->db->join('transaction', 'transaction.product_id = issues.id');
			$this->db->join('orders', 'orders.id = transaction.order_id');
			$this->db->join('users', 'users.id = orders.user_id');
			$this->db->where('add_magazines.user_id', $username);
			$this->db->group_by("transaction.order_id");
			$query = $this->db->get();//$this->db->get_where('orders', array('id' => $id));
			return $query->result_array();
			 //$this->db->last_query();
			  //count($query->result_array());
		}

		public function get_transactions_count($username = FALSE, $limit = FALSE, $offset = FALSE)
		{
			if ($limit) {
				$this->db->limit($limit, $offset);
			}

			if($username === FALSE){
				
			}
					 
			$this->db->select('orders.*');
			$this->db->from('add_magazines');
			$this->db->join('issues', 'issues.m_id = add_magazines.id');
			$this->db->join('transaction', 'transaction.product_id = issues.id');
			$this->db->join('orders', 'orders.id = transaction.order_id');
			$this->db->join('users', 'users.id = orders.user_id');
			$this->db->where('add_magazines.user_id', $username);
			$this->db->group_by("transaction.order_id");
			$query = $this->db->get();//$this->db->get_where('orders', array('id' => $id));
			 $query->result_array();
			 //$this->db->last_query();
			 $earning=0;
			 foreach ($query->result_array() as $key => $value) {
			 $earning=$earning+$value['amount'];
			 }
			 return array('count'=>count($query->result_array()),'earning'=>$earning);
		}

		public function get_earning($username = FALSE, $limit = FALSE, $offset = FALSE)
		{
			if ($limit) {
				$this->db->limit($limit, $offset);
			}

			if($username === FALSE){
				
			}
					 
			$this->db->select('orders.*');
			$this->db->from('add_magazines');
			$this->db->join('issues', 'issues.m_id = add_magazines.id');
			$this->db->join('transaction', 'transaction.product_id = issues.id');
			$this->db->join('orders', 'orders.id = transaction.order_id');
			$this->db->join('users', 'users.id = orders.user_id');
			$this->db->where('add_magazines.user_id', $username);
			$this->db->where('orders.status', 1);
			$this->db->group_by("transaction.order_id");
			$query = $this->db->get();//$this->db->get_where('orders', array('id' => $id));
			 
			 //$this->db->last_query();
			 $earning=0;
			 foreach ($query->result_array() as $key => $value) {
			 $earning=$earning+$value['amount'];
			 }
			 return array('earning'=>$earning-($earning*10/100),'Completed_orders'=>$query->result_array());
		}

		public function get_pending_magazines($username = FALSE, $limit = FALSE, $offset = FALSE)
		{
			if ($limit) {
				$this->db->limit($limit, $offset);
			}

			if($username === FALSE){
				$this->db->order_by('add_magazines.id', 'DESC');
				$this->db->where('status', 0);
				//$this->db->join('categories', 'categories.id = posts.category_id');
				$query = $this->db->get('add_magazines');
				return $query->result_array(); 
			}
						$this->db->where('status', 0);
			$query = $this->db->get_where('add_magazines', array('user_id' => $username));
			return $query->result_array();
		}

		public function get_active_magazines($username = FALSE, $limit = FALSE, $offset = FALSE)
		{
			if ($limit) {
				$this->db->limit($limit, $offset);
			}

			if($username === FALSE){
				$this->db->order_by('add_magazines.id', 'DESC');
				$this->db->where('status', 1);
				//$this->db->join('categories', 'categories.id = posts.category_id');
				$query = $this->db->get('add_magazines');
				return $query->result_array(); 
			}
						$this->db->where('status', 1);
			$query = $this->db->get_where('add_magazines', array('user_id' => $username));
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

		public function get_issues($username = FALSE, $limit = FALSE, $offset = FALSE,$mid)
		{
			if ($limit) {
				$this->db->limit($limit, $offset);
			}

			if($username === FALSE){
				$this->db->order_by('issues.id', 'DESC');
				//$this->db->join('categories', 'categories.id = posts.category_id');
				$query = $this->db->get('issues');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('issues', array('m_id' => $mid));
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

		public function get_publisher_details($user_id)
		{
			$query = $this->db->get_where('publisher_details', array('user_id' => $user_id));
			return $query->row_array();
		}
		public function update_publisher_bank_details($user_id)
		{
				// if($id){
					// $query = $this->db->get_where('publisher_details', array('user_id' => $user_id));
					// return $query->row_array();
				// }else{
					$pub_details = array(
							'acc_no' => $this->input->post('acc_no'),
							'acc_name' => $this->input->post('acc_name'),
							'bnk_name' => $this->input->post('bnk_name'),
							'bnk_swift' => $this->input->post('bnk_swift'),
							'bnk_routing' => $this->input->post('bnk_routing'),
							'bnk_ifsc' => $this->input->post('bnk_ifsc'),
							'bnk_address1' => $this->input->post('bnk_address1'),
							'bnk_address2' => $this->input->post('bnk_address2'),
							'bnk_city' => $this->input->post('bnk_city'),
							'bnk_state' => $this->input->post('bnk_state'),
							'bnk_country' => $this->input->post('country'),
							'bnk_zip' => $this->input->post('bnk_zip'),
														
						  );
				$this->db->where('user_id', $user_id);
				$this->db->update('publisher_details', $pub_details);
			 // 	echo $this->db->last_query();die();
				// }
				
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

		public function get_single_issue($id)
		{

			$query = $this->db->get_where('issues', array('id' => $id));
			return $query->row_array();
		}

		public function update_magazine()
		{

			// $cover =  $cover;
			// $preview = implode(', ', $preview);
			// $paid_docs = implode(', ', $paid_docs);
			$languages = implode(', ', $this->input->post('languages'));
			$country_block = implode(', ', $this->input->post('country_block'));
			$data = array('name' => $this->input->post('name'), 
							'publisher_company' => $this->input->post('country'),
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
							'user_id' => $this->session->userdata('user_id')
						);
			$this->db->where('id', $this->input->post('id'));
			$query=$this->db->update('add_magazines', $data);
			// return $this->db->last_query();
			return  true;
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

			$pub_details = array(
							'publisher' => $this->input->post('publisher')
							// 'mag_no' => $this->input->post('magNo'),
							// 'country' => $this->input->post('country'),
							// 'hear' => $this->input->post('hear'),
														
						  );
			$this->db->where('id', $this->input->post('id'));
			$d = $this->db->update('users', $data);
			if($d){
				$this->db->where('user_id', $this->input->post('id'));
				$this->db->update('publisher_details', $pub_details);
			}
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
				$this->db->where('user_id', $this->session->userdata('user_id'));
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

		// public function get_single_magazin_byID($issueID)
	 //    {
	 //      $this->db->select("issues.id as pid,issues.issue_price,issues.issue_name,issues.cover");
	 //      $this->db->from("issues");
	 //      $this->db->join("add_magazines","add_magazines.id=issues.m_id");
	 //      $this->db->join("categories","add_magazines.primary_category=categories.id");
	 //      $this->db->where("issues.id", $issueID);
	 //      $query=$this->db->get();
	 //      return $query->row_array();
	 //    }

		public function get_transaction_details($id)
		{	
			$this->db->select('*,orders.status as ostatus,orders.id as oid');
			$this->db->from('orders');
			$this->db->join('users', 'users.id = orders.user_id');
			$this->db->where('orders.id', $id);
			$query = $this->db->get();//$this->db->get_where('orders', array('id' => $id));
			return $query->row_array();
		}

		public function print_products($id)
		{	
			$this->db->select('*');
			$this->db->from('transaction');
			$this->db->join('issues', 'transaction.product_id = issues.id');
			$this->db->where('transaction.order_id', $id);
			// $this->db->where('transaction.user_id', $this->session->userdata('user_id'));
			$query = $this->db->get();//$this->db->get_where('orders', array('id' => $id));
			return $query->result_array();
			 //$this->db->last_query();
		}

	}