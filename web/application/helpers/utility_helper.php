<?php
	function sha256($data){
		return hash('sha256', passwordSalt.$data);
	}
	if ( ! function_exists('set_cookie'))
	{
		function set_cookie($name = '', $value = '', $expire = '', $domain = '', $path = '/', $prefix = '')
		{
			// Set the config file options
			$CI =& get_instance();
			$CI->input->set_cookie($name, $value, $expire, $domain, $path, $prefix);
		}
	}

	function _p($data)
	{
	    echo '<pre>'.print_r($data,TRUE).'</pre>';
	}

?>