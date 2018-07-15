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
		error_log('=====================');

		if($data['actionType'] == 'edit'){
			$productId = $data['listingId'];

			$this->db->where('product_id', $productId)->update('products', array('status' => 'history'));


			/*$product['name'] = $data['productName'];
			$product['description'] = $data['productDesc'];
			$this->db->update('products',$product);*/
			$product['name'] = $data['productName'];
			$product['description'] = $data['productDesc'];
			$this->db->insert('products',$product);
			$productId = $this->db->insert_id();
		}
		else{
			$product['name'] = $data['productName'];
			$product['description'] = $data['productDesc'];
			$this->db->insert('products',$product);
			$productId = $this->db->insert_id();
		}

		if($data['actionType'] == 'edit'){
			$this->db->where('product_id', $productId)->update('product_attributes', array('status' => 'history'));
		}
		foreach ($data['attributes'] as $attributeId => $row) {
			$row['val2'] = empty($row['val2']) ? 0 : $row['val2'];
			$row['val3'] = empty($row['val3']) ? 0 : $row['val3'];
			$productAttributes[] = array('product_id' => $productId,'attribute_id' => $attributeId,'value_1' => $row['val1'],'value_2' => $row['val2'],'value_3' => $row['val3'],'status' => 'live','unit_id' => $row['unit']);
		}
		$this->db->insert_batch('product_attributes',$productAttributes);

		if($data['actionType'] == 'edit'){
			$this->db->where('product_id', $productId)->update('product_category_mapping', array('status' => 'history'));
		}
		$productMapping = array('product_id' => $productId,'category_id' => $data['category'],'subcategory_id' => $data['subcategory'],'status' => 'live');
		$this->db->insert('product_category_mapping',$productMapping);

		if($data['actionType'] == 'edit'){
			$this->db->where('product_id', $productId)->update('product_media', array('status' => 'history'));
		}
		$mediaData = array();
		foreach ($data['images'] as $row) {
			$mediaData[] = array('product_id' => $productId, 'media_url' => $row['img_url'], 'position' => $row['position'], 'media_type' => 'image', 'file_name' => NULL, 'status' => 'live');
		}
		foreach ($data['files'] as $row) {
			$mediaData[] = array('product_id' => $productId, 'media_url' => $row['file_url'], 'position' => 1, 'media_type' => 'file', 'file_name' => $row['file_name'], 'status' => 'live');
		}
		if(!empty($mediaData)){
			$this->db->insert_batch('product_media', $mediaData);
		}
		error_log('=====================');
		$this->db->trans_complete();
    	if ($this->db->trans_status() === FALSE) {
    		throw new Exception('Transaction Failed');
    	}
    	return $productId;
	}
	public function postContactUsForm($postArray)
	{
		if(empty($postArray))
		{
			return false;
		}
		$sql = "INSERT INTO contactus_form_data(firstname,lastname,email,mobile,message) values(?,?,?,?,?)";
		$this->db->query($sql,array($postArray['firstname'],$postArray['lastname'],$postArray['email'],$postArray['mobile'],$postArray['message']));
		return true;
	}

	public function getProductsByCategoryAndSubcategory($categoryId, $subCategoryId, $offset, $limit){
		$sql = "SELECT SQL_CALC_FOUND_ROWS p.id,p.name, p.description, c.name as category_name, sc.name as subcategory_name from products p join product_category_mapping pcm on pcm.product_id = p.id and pcm.status = 'live'  left join categories c on c.id = pcm.category_id left join subcategories sc on sc.id = pcm.subcategory_id ";

		$whereStatements = array();
		if(!empty($categoryId)){
			$whereStatements[] = "pcm.category_id = $categoryId";
		}
		if(!empty($subCategoryId)){
			$whereStatements[] = "pcm.subcategory_id = $subCategoryId";
		}
		$sql .= 'where '.implode(' AND ', $whereStatements).' limit '.$offset.','.$limit;
		$query = $this->db->query($sql)->result_array();

		$sql = "SELECT FOUND_ROWS() as count";
		$data = $this->db->query($sql)->row_array();
		$totalCount = $data['count'];

		$returnData = array();
		$returnData['data'] = $query;
		$returnData['totalCount'] = $totalCount;

		return $returnData;
	}

	public function getListingById($listingId){
		$sql = "SELECT p.id,p.name, p.description, c.name as category_name, sc.name as subcategory_name from products p join product_category_mapping pcm on pcm.product_id = p.id and pcm.status = 'live'  left join categories c on c.id = pcm.category_id left join subcategories sc on sc.id = pcm.subcategory_id where p.id = $listingId";
		$query = $this->db->query($sql)->row_array();

		return $query;
	}

	public function getAllListings($offset, $limit){
		$sql = "SELECT SQL_CALC_FOUND_ROWS p.id,p.name, p.description, c.name as category_name, sc.name as subcategory_name from products p join product_category_mapping pcm on pcm.product_id = p.id and pcm.status = 'live'  left join categories c on c.id = pcm.category_id left join subcategories sc on sc.id = pcm.subcategory_id ".' limit '.$offset.','.$limit;
		$query = $this->db->query($sql)->result_array();

		$sql = "SELECT FOUND_ROWS() as count";
		$data = $this->db->query($sql)->row_array();
		$totalCount = $data['count'];

		$returnData = array();
		$returnData['data'] = $query;
		$returnData['totalCount'] = $totalCount;

		return $returnData;
	}

	public function getListingData($listingId){
		$this->db->where('id', $listingId);
		$data = $this->db->get('products')->row_array();
		if(empty($data)){
			return array();
		}
		$returnData = array();
		$returnData['name'] = $data['name'];
		$returnData['description'] = $data['description'];

		$this->db->select('attribute_id,value_1,value_2,value_3,unit_id');
		$this->db->where('product_id', $listingId)->where('status','live');
		$data = $this->db->get('product_attributes')->result_array();
		foreach ($data as $row) {
			$returnData['attributes'][] = $row;
		}

		$this->db->select('category_id,subcategory_id');
		$this->db->where('product_id', $listingId)->where('status','live');
		$data = $this->db->get('product_category_mapping')->row_array();
		if(!empty($data)){
			$returnData['category_id'] = $data['category_id'];
			$returnData['subcategory_id'] = $data['subcategory_id'];
		}

		$this->db->select('media_url, media_type, file_name, position');
		$this->db->where('product_id', $listingId)->where('status','live')->order_by('position','asc');
		$data = $this->db->get('product_media')->result_array();
		foreach ($data as $row) {
			$returnData['media'][$row['media_type']][] = $row;
		}
		return $returnData;
	}

	public function deleteListing($listingId){
		$this->db->trans_start();

		$this->db->where('id', $listingId);
		$this->db->update('products', array('status' => 'deleted'));

		$this->db->where('product_id', $listingId);
		$this->db->update('product_attributes', array('status' => 'deleted'));

		$this->db->where('product_id', $listingId);
		$this->db->update('product_category_mapping', array('status' => 'deleted'));

		$this->db->where('product_id', $listingId);
		$this->db->update('product_media', array('status' => 'deleted'));

		$this->db->trans_complete();
    	if ($this->db->trans_status() === FALSE) {
    		throw new Exception('Transaction Failed');
    	}

    	return true;
	}

	public function getMedia($listingIds){
		$this->db->select('product_id,media_url,media_type, file_name,position')->where('status','live');
		$this->db->where_in('product_id', $listingIds);
		$this->db->order_by('position','asc');
		$mediaData = $this->db->get('product_media')->result_array();

		$returnData = array();
		foreach ($mediaData as $row) {
			$returnData[$row['product_id']][$row['media_type']][$row['position']] = array('file_name' => $row['file_name'],'url' => $row['media_url']);
		}
		return $returnData;
	}
}
?>