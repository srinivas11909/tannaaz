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
}
?>

