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
}
?>