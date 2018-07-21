<?php
class UserController extends CI_Controller{
	function doLogin()
	{
		$uname = $this->input->post('username');
		$ePassword = $this->input->post('mpassword');
		$ePassword = sha256($ePassword);

		$strcookie = $uname.'|'.$ePassword;
		
		$this->load->library('cmslibrary');
		//print_r($cmsLibrary,true);die;
		$userArray = $this->cmslibrary->checkValidUser($strcookie,'login');
		if(empty($userArray['userId']))
			echo 0;
		if(!empty($userArray) && is_array($userArray))
		{
			$value = $userArray['cookiestr'];
			setcookie('user',$value,time() + (86400 * 30),'/',COOKIEDOMAIN);
		}
		echo $userArray['userId'];
	}
	function logOut()
	{
		$this->load->library('cmslibrary');
		$result = $this->cmslibrary->checkValidUser();
		if($result)
		{
			setcookie('user','',0,'/',COOKIEDOMAIN);	
			echo 1;
			exit();
		}
		echo 0;exit();
	}
	function test()
	{

	}
}
?>