<?php
	class Cart_Model extends CI_Model
	{
		public function __construct()
		{
			$this->load->database();
		}
		

		public function get_single_magazin_byID($issueID,$price)
	    {
	      $this->db->select("issues.id as pid,".$price." as price,issues.issue_name,issues.cover");
	      $this->db->from("issues");
	      $this->db->join("add_magazines","add_magazines.id=issues.m_id");
	      $this->db->join("categories","add_magazines.primary_category=categories.id");
	      $this->db->where("issues.id", $issueID);
	      $query=$this->db->get();
	      return $query->row_array();
	    }

		public function delete_transaction_by_oid($id){
			$this->db->where('order_id', $id);
			$this->db->delete('transaction');
		}
		public function insertOrder($data){
		// Add created and modified date if not included
		
		// Insert order data
		$insert = $this->db->insert('orders', $data);

		// Return the status
		return $insert?$this->db->insert_id():false;
		}

		public function insertOrderItems($data = array()) {

		// Insert order items
		$insert = $this->db->insert_batch('transaction', $data);

		// Return the status
		return $insert?true:false;
		}
    
	}