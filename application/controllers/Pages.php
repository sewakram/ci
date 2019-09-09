<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Pages extends CI_Controller{

	function  __construct(){
		parent::__construct();

		// Load cart library
		$this->load->library('cart');

	}
		
		public function view($page = 'home-index'){
			if (!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
				show_404();
			}
			//echo $this->IP_Loader->ip_info("Visitor", "Country");die();
			$data['title'] = ucfirst($page);
			$data['page'] = 'pages/'.$page;
			$data['is_home'] = true;
			$this->myissue = & get_instance();
			$this->load->view('templates/common', $data);
			
		}

		public function details($slug = NULL)
		{	$details='detailspage';
			if (!file_exists(APPPATH.'views/pages/'.$details.'.php')) {
				show_404();
			}
			
			 $pagedata=$this->Pages_Model->get_pages($slug);
			 // echo "<pre>";print_r($pagedata);die();
			 $page=$this->Pages_Model->get_posts_by_category($pagedata['id']);
			
			$data['title'] = ucfirst($page['page_name']);
			$data['pdata'] = $page;
			$data['page'] = 'pages/'.$details;
			
			$this->load->view('templates/common', $data);
		}

		public function comman_function($table,$field,$data)
		{
			$show = $this->Category_Model->get_all_data_condition($table,$field,$data);
			return $show;
		}

		public function join_comman_function($table, $table2, $field,$data)
		{
			$show = $this->Category_Model->get_join_data_condition($table,$table2,$field,$data);
			return $show;
		}

		public function join_search_function($table, $table2, $field,$data,$search)
		{
			$show = $this->Category_Model->get_join_search_condition($table,$table2,$field,$data,$search);
			return $show;
		}

		public function comman_single_record($table,$field,$data)
		{
			$show = $this->Category_Model->get_single_record($table,$field,$data);
			return $show;
		}

		public function view_category($slug = NULL)
		{
			$data['categories'] = $this->Category_Model->get_product_categories($slug);
			//print_r($data['categories']);die();
			if (empty($data['categories'])) {
				show_404();
			}
			$page = 'category';
			$data['title'] = ucfirst($data['categories']['name']);
			$data['page'] = 'pages/category';
			$this->myissue = & get_instance();
			$data['magazines'] = $this->Category_Model->get_categories_magazine($data['categories']['id']);
			$this->load->view('templates/common', $data);
		}

		function fetch()
		{
			$output = '';
			$data = $this->Category_Model->get_load_data_condition('add_magazines','issues','primary_category', $this->input->post('cat'), $this->input->post('limit'), $this->input->post('start'));
			//$data = $this->scroll_pagination_model->fetch_data($this->input->post('limit'), $this->input->post('start'));
			if($data->num_rows() > 0)
			{
				foreach($data->result() as $row)
				{
					$output .= '
					<li><a href="'.site_url('magazine/'.$row->c_slug.'/'.$row->m_slug.'/'.$row->i_slug).'"><img src="'.site_url('assets/images/magzines/cover/'.$row->i_cover).'" alt="" title="" /><h3>'.$row->issue_name.'</h3></a></li>
					';
				}
			}
			echo $output;
		}

		function loadarticlereport()
		{
			$output = '';
			$data = $articles_cat = $this->Category_Model->get_post_join_condition('posts', 'categories', 'status', '1', $this->input->post('limit'), $this->input->post('start'));
			if($data->num_rows() > 0)
			{
				foreach($data->result() as $row)
				{
					$output .= '<li style="display: inline-block;" class="mix '.$row->c_slug.'"><a href="'.site_url( 'articles_reports/'.$row->slug.'/'.$row->post_id ).'"><img src="'.site_url('/assets/images/posts/'.$row->post_image).'"></a><h5><a href="'.site_url( 'articles_reports' ).'">'.$row->title.'</a></h5></li>';
				}
			}
			echo $output;
		}

		public function view_magazine($cat = NULL, $slug = NULL, $slugissue = NULL)
		{
			$data['magazine'] = $this->Category_Model->get_magazine($slug);
			$data['myissue'] = $this->Category_Model->get_single_record('issues','slug', $slugissue);

			if (empty($data['magazine'])) {
				show_404();
			}
			if (empty($data['myissue'])) {
				show_404();
			}
			$page = 'magazine-details';
			$data['title'] = ucfirst($data['magazine']['name']);
			$data['page'] = 'pages/magazine-details';
			$data['inner'] = true;
			// print_r($data);die();
			$this->myissue = & get_instance();
			$data['category'] = $this->Category_Model->get_category($data['magazine']['primary_category']);
			$this->load->view('templates/common', $data);
		}

		public function viewmagazine()
		{
			$this->load->view('pages/idondza-flipbook/bookview');
		}

		public function article_details($slug, $id)
		{
			if(empty($id))
			{
				redirect('pages/articles_reports');
			}
			$data['articles'] = $this->Category_Model->get_single_record('posts','id', $id);
			if (empty($data['articles'])) {
				show_404();
			}
			$data['title'] = 'Articles';
			$data['page'] = 'pages/article';
			$this->myissue = & get_instance();
			$this->load->view('templates/common', $data);
		}

		public function addfav()
		{ 
			if(!$this->session->userdata('login'))
			{
				return false;
			}
			if(isset($_POST['fav'])){
				$field = array(
					"user_id" => $this->session->userdata('user_id'),
					"issue_id" => $this->input->post('fav')
				);
				$selectRecord = $this->Category_Model->checkrecords('favourites', $field);
				
				if(count($selectRecord) == 0)
				{
					$favid = $this->Category_Model->insert_record('favourites', $field);
					$data = array();
					$data['msg'] ='Successfully added to Favourites';
					$data['class'] = 'active';
					echo json_encode( $data );
				}
				else
				{
					$favid = $this->Category_Model->deleterecords('favourites', $field);
					$data['msg'] ='Removed Successfully from your Favourites';
					$data['class'] = '';
					echo json_encode( $data );
				}
			}	
		}

		public function articles_reports()
		{
			$details='articles-reports';
			if (!file_exists(APPPATH.'views/pages/'.$details.'.php')) {
				show_404();
			}
			$this->articlescat = & get_instance();
			$data['categories'] = $this->Category_Model->blog_categories();
			$data['title'] = ucfirst('Articles & Reports');
			$data['page'] = 'pages/'.$details;
			
			$this->load->view('templates/common', $data);
		}

		public function common_function_article_reports($table1, $table2, $field, $data)
		{
			$data = $this->Category_Model->get_post_join_condition($table1, $table2, $field, $data);
			return $data;
		}

		public function join_allsearch_function($table, $table2, $field,$data,$search)
		{
			$show = $this->Category_Model->get_all_search_condition($table,$table2,$field,$data,$search);
			return $show;
		}
		public function search()
		{
			$details='search-reports';
			if (!file_exists(APPPATH.'views/pages/'.$details.'.php')) {
				show_404();
			}
			$this->searchreport = & get_instance();
			$data['categories'] = $this->Category_Model->get_all_data_condition('categories', 'type', 'product');
			$data['title'] = ucfirst('Search Magazine');
			$data['page'] = 'pages/'.$details;
			$this->load->view('templates/common', $data);
		}

	}
	