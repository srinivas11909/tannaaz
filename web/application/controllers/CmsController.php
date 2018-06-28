<?php 

class CmsController extends CI_Controller{

	function __construct()
	{
		parent::__construct();
	}

	function init(){
		$this->load->library('cmslibrary');
	}

	function isLogin()
	{
		$loginUser = $this->checkUserValidation();
		if((empty($loginUser))||(empty($loginUser['userId']))) {
		    header('location:/CmsController/login');
		    exit();
		}
	}
	function login(){
		$this->load->view('login');
	}
	
	function success()
	{
		$this->isLogin();
		//setcookie('user','12345',time() + 2592000,'/',COOKIEDOMAIN);
		echo "success";
	}

	function viewListings(){
		$this->load->view('cms/viewListings');
	}

	function postListing(){
		// $this->init();
		$data = $this->load->library('cmslibrary');
		$categoryTree = $this->cmslibrary->getCategoriesTree();
		$displayData['categoryTree'] = $categoryTree;

		$attributeList = $this->cmslibrary->getAttributeList();
		$displayData['attributeList'] = $attributeList;

		// _p($displayData);die;

		$this->load->view('cms/postListing', $displayData);
	}
}
?>

