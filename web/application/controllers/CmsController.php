<?php 

class CmsController extends CI_Controller{

	function __construct()
	{
		parent::__construct();
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
		$this->load->library('cmslibrary');
		$categoryTree = $this->cmslibrary->getCategoriesTree();
		$displayData['categoryTree'] = $categoryTree;

		$attributeList = $this->cmslibrary->getAttributeList();
		$displayData['attributeList'] = $attributeList;

		// _p($displayData);die;

		$this->load->view('cms/postListing', $displayData);
	}

	function saveListing(){
		$data['productName'] = $this->input->post('productName');
		$data['productDesc'] = $this->input->post('productDesc');
		$data['category'] = $this->input->post('category');
		$data['subcategory'] = $this->input->post('subcategory');
		$data['attributes'] = $this->input->post('attributes');

		$this->load->model('cmsmodel');
		$newProductId = $this->cmsmodel->saveListing($data);
		_p($newProductId);die;
	}
}
?>

