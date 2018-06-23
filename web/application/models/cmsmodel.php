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
	}
?>