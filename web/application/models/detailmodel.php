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
		$this->db->where('pm.status','live');
		$this->db->where('pm.position','1');
		$this->db->where('pm.media_type','image');
		$result = $this->db->get()->result_array();
		return $result;
	}
	function getFirstImageForAllCategories()
	{
		$this->db->select('c.id,c.name,max(pm.media_url) as media_url,max(pcm.category_id) as catId,min(pcm.subcategory_id) as subcatId');
		$this->db->from('categories c');
		$this->db->join('product_category_mapping pcm','pcm.category_id = c.id');
		$this->db->join('product_media pm','pm.product_id = pcm.product_id');
		$this->db->where('pm.media_type','image');
		$this->db->where('pm.position','1');
		$this->db->where('pm.status','live');
		$this->db->where('pcm.status','live');
		$this->db->group_by('c.id');
		$result = $this->db->get()->result_array();
		return $result;
	}
}
?>
