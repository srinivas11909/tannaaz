<?php
class detailmodel extends CI_Model{
	function __construct()
	{
		parent::__construct();
    	$this->load->database('default');

	}
	function getProductsBasedOnSearch($searchText)
	{
		$this->db->select('p.id,p.name,pm.media_url as media_url');
		$this->db->from('products p');
		$this->db->join('product_media pm','p.id = pm.product_id');
		$this->db->like('p.name',$searchText);
		$this->db->where('p.status','live');
		$this->db->where('pm.status','live');
		$this->db->where('pm.position','1');
		$this->db->where('pm.media_type','image');
		$result = $this->db->get()->result_array();
		return $result;
	}
}
?>