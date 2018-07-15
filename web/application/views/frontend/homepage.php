<?php 
  $header = array(
      'css' => array('')
    );
  $this->load->view("frontend/header",$header);
?>

<?php 
  $this->load->view("frontend/homepagesection");
  $this->load->view("frontend/footer",array('pageName' => 'contactus'));
?>          