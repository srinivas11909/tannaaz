<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cmslibrary {
	private $CI;
	function __construct()
	{
		$this->CI = & get_instance();
		$this->CI->load->model('cmsmodel');
	}

	function checkValidUser($strcookie,$type='default')
	{
		if(empty($strcookie) && $type == 'login')
			return;

		if(empty($strcookie))
		{
			$cookiestr = isset($_COOKIE['user']) ? $_COOKIE['user'] : '';	
			$strcookie = $cookiestr;
		}
		if(empty($strcookie))
			return;
		$values = explode('|', $strcookie);
		$username = $values[0];
		$mpassword = $values[1];
		return $this->CI->cmsmodel->checkValidUser($username,$mpassword);
	}

	public function getCategoriesTree(){
		$dbData = $this->CI->cmsmodel->getCategoriesTree();
		$returnData = array();
		foreach ($dbData as $row) {
			$returnData[$row['categoryId']]['categoryId'] = $row['categoryId'];
			$returnData[$row['categoryId']]['categoryName'] = $row['categoryName'];
			$returnData[$row['categoryId']]['subcategories'][$row['subcategoryId']]['subcategoryId'] = $row['subcategoryId'];
			$returnData[$row['categoryId']]['subcategories'][$row['subcategoryId']]['subcategoryName'] = $row['subcategoryName'];
		}
		return $returnData;
	}

	public function getAttributeList(){
		$dbData = $this->CI->cmsmodel->getAttributeList();
		$returnData = array();
		foreach ($dbData as $row) {
			$returnData[$row['attributeId']] = $row;
		}
		return $returnData;
	}
}
?>