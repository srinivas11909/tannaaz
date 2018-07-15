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


function getImageVariant($imageLink, $variantIdentifier = '')
{
	switch ($variantIdentifier) {
		case 's':
			$imageUrlIdentifier = '_s';
			break;
		case 'm':
			$imageUrlIdentifier = '_m';
			break;
		case 'l':
			$imageUrlIdentifier = '_l';
			break;
		default:
			$imageUrlIdentifier = '';
			break;
	}
	$imageString = substr($imageLink,0,(strrpos($imageLink,'.')));
	$imageExt = substr($imageLink,(strrpos($imageLink,'.')+1),strlen($imageLink));
	$imageExt = strtolower($imageExt);
	$imageExt = ($imageExt == 'jpeg' ? 'jpg' : $imageExt);
	
	return $imageString.$imageUrlIdentifier.'.'.$imageExt; 
}


?>