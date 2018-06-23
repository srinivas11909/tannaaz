<?php
	class cmslibrary {
		private $CI;
		function __construct()
		{
			$this->CI = & get_instance();
		}
		function checkValidUser($strcookie,$type='login')
		{
			if(empty($strcookie))
				return;
			$values = explode('|', $strcookie);
			$username = $values[0];
			$mpassword = $values[1];
			$this->CI->load->model('cmsmodel');
			return $this->CI->cmsmodel->checkValidUser($username,$mpassword);
		}
	}
?>