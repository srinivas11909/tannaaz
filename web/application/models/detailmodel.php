<?php
class detailmodel extends CI_Model{
	function __construct()
	{
		parent::__construct();
    	$this->load->database('default');

	}
}
?>