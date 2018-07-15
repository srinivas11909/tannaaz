<?php 
  $header = array(
    );
  $this->load->view("frontend/header",$header);
?>
  <div class="mainData">
      <div class="about_wrapper">
       <div class="container">
         <div class="row">
            <?php 
            $this->load->view('frontend/productlistLeft');
              $this->load->view('frontend/productlistRight');
            ?> 
           </div>
       </div>
      </div>
    </div>
<?php 
  $this->load->view("frontend/footer",array('pageName' => 'contactus'));
?>          