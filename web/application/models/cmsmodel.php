<?php
class cmsmodel extends CI_Model{
	function __construct()
	{
		parent::__construct();
    	$this->load->database('default');
	}
	function checkValidUser($username,$epassword)
	{	
		$sql = "SELECT userid,displayname,email,ePassword FROM user where email = ? AND ePassword= ?";
		$result = $this->db->query($sql,array($username,$epassword));
		$row = $result->row();
		if($result->num_rows() == 0)
		{
			return false;
		}
		$cookiestr = $row->email.'|'.$row->ePassword;
		$userArray = array(	'userId' => $row->userid, 
							"displayname" => $row->displayname,
							"email" => $row->email,
							"cookiestr" => $cookiestr);
		return $userArray;
	}

	function getCategoriesTree(){
		$sql = "SELECT ca.id as categoryId,ca.name as categoryName, sc.id as subcategoryId,sc.name as subcategoryName from categories ca join subcategories sc on ca.id = sc.categoryId";
		return $this->db->query($sql)->result_array();
	}

	public function getAttributeList(){
		$sql = "SELECT id as attributeId,attribute_name as attributeName from attributes";
		return $this->db->query($sql)->result_array();
	}

	public function saveListing($data){
		$this->db->trans_start();
		$product['name'] = $data['productName'];
		$product['description'] = $data['productDesc'];
		$this->db->insert('products',$product);

		$productId = $this->db->insert_id();
		foreach ($data['attributes'] as $attributeId => $row) {
			$productAttributes[] = array('product_id' => $productId,'attribute_id' => $attributeId,'value_1' => $row['val1'],'value_2' => $row['val2'],'value_3' => $row['val3'],'status' => 'live','unit_id' => 1);
		}
		$this->db->insert_batch('product_attributes',$productAttributes);

		$productMapping = array('product_id' => $productId,'category_id' => $data['category'],'subcategory_id' => $data['subcategory'],'status' => 'live');
		$this->db->insert('product_category_mapping',$productMapping);

		$this->db->trans_complete();
    	if ($this->db->trans_status() === FALSE) {
    		throw new Exception('Transaction Failed');
    	}
    	return $productId;
	}
}
?>