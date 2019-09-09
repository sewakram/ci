<?php
	class Pages_Model extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}

		public function get_pages($slug = FALSE, $limit = FALSE, $offset = FALSE)
		{
			// if ($limit) {
			// 	$this->db->limit($limit, $offset);
			// }

			// if($slug === FALSE){
			// 	$this->db->order_by('posts.id', 'DESC');
			// 	$this->db->join('categories', 'categories.id = posts.category_id');
			// 	$query = $this->db->get('posts');
			// 	return $query->result_array(); 
			// }

			$query = $this->db->get_where('page_content', array('slug' => $slug));
			return $query->row_array();
		}

		public function get_posts($slug = FALSE, $limit = FALSE, $offset = FALSE)
		{
			if ($limit) {
				$this->db->limit($limit, $offset);
			}

			if($slug === FALSE){
				$this->db->order_by('posts.id', 'DESC');
				$this->db->join('categories', 'categories.id = posts.category_id');
				$query = $this->db->get('posts');
				return $query->result_array(); 
			}

			$query = $this->db->get_where('posts', array('slug' => $slug));
			return $query->row_array();
		}

		public function create_post($post_image)
		{
			$slug = url_title($this->input->post('title'), "dash", TRUE);

			$data = array(
				'title' => $this->input->post('title'), 
			    'slug' => $slug,
			    'body' => $this->input->post('body'),
			    'category_id' => $this->input->post('category_id'),
			    'post_image' => $post_image,
			    'user_id' => $this->session->userdata('user_id')
			    );
			return $this->db->insert('posts', $data);
		}

		public function delete_post($id)
		{
			$image_file_name = $this->db->select('post_image')->get_where('posts', array('id' => $id))->row()->post_image;
			$cwd = getcwd(); // save the current working directory
			$image_file_path = $cwd."\\assets\\images\\posts\\";
			chdir($image_file_path);
			unlink($image_file_name);
			chdir($cwd); // Restore the previous working directory
			$this->db->where('id', $id);
			$this->db->delete('posts');
			return true;
		}

		public function update_post(){
			$slug = url_title($this->input->post('title'), "dash", TRUE);

			$data = array(
				'title' => $this->input->post('title'), 
			    'slug' => $slug,
			    'body' => $this->input->post('body'),
			    'category_id' => $this->input->post('category_id')
			    );
			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('posts', $data);
		}

		public function get_categories(){
			$this->db->order_by('page_name');
			$query = $this->db->get('page_content');
			return $query->result_array();
		}

		public function get_page($page_id){
			
			$query = $this->db->get_where('page_content', array('id' => $page_id));
			return $query->row_array(); 
		}

		public function get_siteconfig($page_id){
			
			$query = $this->db->get_where('site_config', array('id' => $page_id));
			return $query->row_array(); 
		}

		public function get_posts_by_category($category_id){
			
			$query = $this->db->get_where('page_content', array('id' => $category_id));
			return $query->row_array(); 
		}
	}