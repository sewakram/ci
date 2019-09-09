<?php
	class Category_Model extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}

		public function create_category()
		{
			$data = array(
				'name' => $this->input->post('name'), 
				'user_id' => $this->session->userdata('user_id')
			    );
			return $this->db->insert('categories', $data);
		}

		public function get_categories(){
			$this->db->order_by('name');
			$query = $this->db->get('categories');
			return $query->result_array();
		}

		public function get_category($id){
			$query = $this->db->get_where('categories', array('id' => $id));
			return $query->row();
		}

		public function delete_category($id){
			$this->db->where('id', $id);
			$this->db->delete('categories');
			return true;
		}

		public function product_categories(){
			$this->db->order_by('id','asc');
			$this->db->limit(3);
			$this->db->where('type', 'product');
			$query = $this->db->get('categories');
			return $query->result_array();
		}

		public function blog_categories(){
			$this->db->order_by('id','asc');
			$this->db->where('type', 'blog');
			$query = $this->db->get('categories');
			return $query->result_array();
		}

		public function get_product_categories($slug){	 
			$this->db->where('type', 'product');
			$this->db->where('slug', $slug);
			$query = $this->db->get('categories');
			return $query->row_array();
		}

		public function get_categories_magazine($id){
			$countrycode = $this->iploader->get_visitor_location(NULL, 'countryCode');
	    	$countryid = $this->get_single_record('country', 'iso', $countrycode);
			$this->db->where('primary_category', $id);
			$this->db->where('status', 1);
			if($countryid){
				$this->db->where("NOT FIND_IN_SET(country_block, $countryid->id) ORDER BY case country_publish_form when ".$countryid->id." then 1 else 2 end");
			}
			$query = $this->db->get('add_magazines');
			//echo $this->db->last_query();die();
			return $query->result_array();
		}

		public function get_magazine($slug){
			$this->db->where('slug', $slug);
			$query = $this->db->get('add_magazines ');
			return $query->row_array();
		}

		public function get_details_table($table, $field, $value, $select){
			$query = $this->db->query("SELECT GROUP_CONCAT(".$select.") as name FROM ".$table." where ".$field." IN (".$value.")");
			return $query->row_array();
		}

		public function get_last_recent_magazines($order, $limit, $category)
		{
			$currentdate =  date('Y-m-d');
			$this->db->order_by('id', $order);
			$this->db->limit($limit);
			$this->db->where('m_id', $category);
			$this->db->where("issues.status", '1');
			$this->db->where("issues.publishing_date <= '$currentdate'");
			$query = $this->db->get('issues');
			return $query->result_array();
		}

		public function get_all_data_condition($table,$field,$data)
	    {
	        return $this->db->where($field,$data)->where('status', '1')->get($table)->result();
	    }

	     // Get Single Record
	    public function get_single_record($table,$field,$data)
	    {
	      return  $this->db->where($field,$data)->where('status', '1')->get($table)->row();
	    }
	    public function get_single_magazin_byID($issueID)
	    {
	      $this->db->select("issues.*,add_magazines.*,categories.*");
	      $this->db->from("issues");
	      $this->db->join("add_magazines","add_magazines.id=issues.m_id");
	      $this->db->join("categories","add_magazines.primary_category=categories.id");
	      $this->db->where("issues.id", $issueID);
	      $query=$this->db->get();
	      return $query->row_array();
	    }

	    public function get_join_data_condition($table1, $table2, $field, $data)
	    {
	    	$countrycode = $this->iploader->get_visitor_location(NULL, 'countryCode');
	    	$countryid = $this->get_single_record('country', 'iso', $countrycode);
	    	//echo $this->db->last_query();
	    	$setcode = $this->session->userdata('site_country');
	    	$setcountryid = $this->get_single_record('country', 'iso', $setcode);
	    	$currentdate =  date('Y-m-d');
	        $this->db->select("$table1.slug as m_slug, $table2.slug as i_slug,, $table2.cover as i_cover, $table2.issue_name, categories.slug as c_slug");
			$this->db->from("$table1");
			$this->db->where("$table1.$field=$data");
			$this->db->where("issues.publishing_date <= '$currentdate'");
			$this->db->join("categories","categories.id=$table1.$field");
			$this->db->where("$table2.status", '1');
			$this->db->where("$table1.status", '1');
			$this->db->join("$table2","$table2.m_id=$table1.id");
			if($setcountryid){
				$this->db->where("NOT FIND_IN_SET(add_magazines.country_block, $countryid->id) ORDER BY case when add_magazines.country_publish_form ='".$setcountryid->id."' then 1 when add_magazines.country_publish_form ='".$countryid->id."' then 2 else 3 end, issues.id desc");
			}
			$this->db->limit('7');
			$query=$this->db->get();
			return $query->result_array();
	    }

	    public function get_join_search_condition($table1, $table2, $field, $data, $search)
	    {
	    	$countrycode = $this->iploader->get_visitor_location(NULL, 'countryCode');
	    	$countryid = $this->get_single_record('country', 'iso', $countrycode);
	    	$currentdate =  date('Y-m-d');
	        $this->db->select("$table1.slug as m_slug, $table2.slug as i_slug,, $table2.cover as i_cover, $table2.issue_name, categories.slug as c_slug");
			$this->db->from("$table1");
			$this->db->where("$table1.$field", $data);
			$this->db->join("categories","categories.id=$table1.$field");
			$this->db->where("$table2.status", '1');
			$this->db->where("$table1.status", '1');
			$this->db->where("issues.publishing_date <= '$currentdate'");
			if($countryid){
				$this->db->where("NOT FIND_IN_SET($table1.country_block, $countryid->id)");
			}
			$this->db->like("$table2.issue_name",$search);
        	//$this->db->or_like("$table2.description",$search);
			$this->db->join("$table2","$table2.m_id=$table1.id");
			$this->db->order_by("$table2.id",'desc');
			//$this->db->where("$table1.$field", $data);
			$query=$this->db->get();
			return $query->result_array();
	    }

	    public function insert_record( $table, $field)
	    {
	      $data = $this->db->insert($table, $field);
	      return $this->db->insert_id();
	    }

	    public function checkrecords($table, $data)
	    {
	    	 $this->db->select('*');
	    	 $this->db->from($table);
			 $this->db->where($data);
			 $query=$this->db->get();
			 return $query->result_array();
	    }

	    public function deleterecords($table, $data)
	    {
	    	return $this->db->where($data)->delete($table);
	    }

	    public function get_post_join_condition($table1, $table2, $field, $data, $limit, $start)
	    {
	    	$countrycode = $this->iploader->get_visitor_location(NULL, 'countryCode');
	    	$countryid = $this->get_single_record('country', 'iso', $countrycode);
	    	//echo $this->db->last_query();
	    	$setcode = $this->session->userdata('site_country');
	    	$setcountryid = $this->get_single_record('country', 'iso', $setcode);
	    	
	        $this->db->select("$table1.id as post_id, $table1.title as title, $table1.slug as slug, $table1.magazine_id, $table1.user_id, $table1.post_image, $table2.name as cat_name,  $table2.slug as c_slug");
			$this->db->from("$table1");
			$this->db->where("$table1.$field", $data);
			$this->db->join("add_magazines","add_magazines.id=$table1.magazine_id");
			$this->db->join("$table2","$table2.id=$table1.category_id");
			if($setcountryid){
				$this->db->where("NOT FIND_IN_SET(add_magazines.country_block, $countryid->id) ORDER BY case when add_magazines.country_publish_form ='".$setcountryid->id."' then 1 when add_magazines.country_publish_form ='".$countryid->id."' then 2 else 3 end, posts.id desc");
			}
			if($this->input->get('search'))
			{
				$this->db->like("$table1.title",$this->input->get('search'));
        		$this->db->or_like("$table1.body",$this->input->get('search'));
			}
			$this->db->limit($limit, $start);
			$query=$this->db->get();
			return $query;
	    }

	    public function get_all_search_condition($table1, $table2, $field, $data, $search)
	    {
	    	$countrycode = $this->iploader->get_visitor_location(NULL, 'countryCode');
	    	$countryid = $this->get_single_record('country', 'iso', $countrycode);
	    	$currentdate =  date('Y-m-d');
	        $this->db->select("$table1.slug as m_slug, $table2.slug as i_slug,, $table2.cover as i_cover, $table2.issue_name, categories.slug as c_slug");
			$this->db->from("$table1");
			$this->db->join("categories","categories.id=$table1.$field");
			$this->db->where("$table2.status", '1');
			$this->db->where("$table1.status", '1');
			$this->db->where("issues.publishing_date <= '$currentdate'");
			if($countryid){
				$this->db->where("NOT FIND_IN_SET($table1.country_block, $countryid->id)");
			}
			$this->db->like("$table2.issue_name",$search);
        	//$this->db->or_like("$table2.description",$search);
			$this->db->join("$table2","$table2.m_id=$table1.id");
			$this->db->order_by("$table2.id",'desc');
			$query=$this->db->get();
			return $query->result_array();
	    }


	    public function get_load_data_condition($table1, $table2, $field, $data, $limit, $start)
	    {
	    	$countrycode = $this->iploader->get_visitor_location(NULL, 'countryCode');
	    	$countryid = $this->get_single_record('country', 'iso', $countrycode);
	    	//echo $this->db->last_query();
	    	$setcode = $this->session->userdata('site_country');
	    	$setcountryid = $this->get_single_record('country', 'iso', $setcode);
	    	$currentdate =  date('Y-m-d');
	        $this->db->select("$table1.slug as m_slug, $table2.slug as i_slug,, $table2.cover as i_cover, $table2.issue_name, categories.slug as c_slug");
			$this->db->from("$table1");
			$this->db->where("$table1.$field=$data");
			$this->db->join("categories","categories.id=$table1.$field");
			$this->db->where("$table2.status", '1');
			$this->db->where("$table1.status", '1');
			$this->db->where("issues.publishing_date <= '$currentdate'");
			if($setcountryid){
				$this->db->where("NOT FIND_IN_SET($table1.country_block, $countryid->id) ORDER BY case when $table1.country_publish_form ='".$setcountryid->id."' then 1 when $table1.country_publish_form ='".$countryid->id."' then 2 else 3 end, issues.id desc");
			}
			$this->db->join("$table2","$table2.m_id=$table1.id");
			//$this->db->order_by("$table2.id",'desc');
			$this->db->limit($limit, $start);
			$query=$this->db->get();
			return $query;
	    }
	}