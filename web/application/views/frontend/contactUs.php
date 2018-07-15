<?php 
  $header = array(
      'css' => array('aboutus')
    );
  $this->load->view("frontend/header",$header);
?>
    <div class="mainData">
      <div class="about_wrapper">
       <div class="container">
         <div class="row">
           <div class="col-lg-3">
             <div class="about_data">
               <div class="about_title <?php echo ($pagetype == 'contact') ? 'active' : ''?>">
                 <a href="javascript:void(0)" id="contact" class="contactus">Contact</a>
               </div>
               <div class="about_title <?php echo ($pagetype == 'contactus') ? 'active' : ''?>">
                 <a href="javascript:void(0)" id="contactus" class="contactus">Contact Us</a>
               </div>

             </div>
           </div>

           <div class="col-lg-9">
              <div class="about_details">
                <div class="history show_contact <?php echo ($pagetype == 'contact') ? 'show' : 'hide'?>" id="contact_s">
                  <h2>Contact</h2>
                  <div class="row">
                      <div class="col-lg-4">
                        <address class="">
                          <h3 class="contact_title">Taannaz Bronzze Pvt. Ltd.</h3>
                          <p class="contact_txt">
                            A8 &amp; A9 MIDC
                            Near State Bank of India
                            Badlapur East
                            District Thane
                            Maharashtra 421 503
                            India
                          </p>
                        </address>
                      </div>
                      <div class="col-lg-4">
                        <h3 class="contact_title">Telephone:</h3>
                        <p class="contact_txt">+91 251 2696904</p>
                        <p class="contact_txt">+91 251 2695182</p>
                      </div>
                      <div class="col-lg-4">
                        <h3 class="contact_title">Email:</h3>
                        <p class="contact_txt">info@taannaz.in</p>
                      </div>
                    </div>
                </div>
                <div class="history show_contact <?php echo ($pagetype == 'contactus') ? 'show' : 'hide'?>" id="contactus_s">
                  <h2>Contact Us</h2>
                  <div class="formClass">
                    <form class="contact2-form" id="contact_form">
                      <div class="form_wrap">
                        <label for="">First Name</label>
                        <input class="form_input" type="text" name="firstname" min=3 max=20 />
                        <span id="firstname_error" style="display: none"></span>
                      </div>
                      <div class="form_wrap">
                        <label for="">Last Name</label>
                        <input class="form_input" type="text" name="lastname" min=3 max=20 />
                        <span id="lastname_error" style="display: none"></span>
                      </div>
                      <div class="form_wrap">
                        <label for="">Email</label>
                        <input class="form_input" type="email" name="email" required />
                        <span id="email_error" style="display: none"></span>
                      </div>
                      <div class="form_wrap">
                        <label for="">Phone Number</label>
                        <input class="form_input" type="number" name="mobile" />
                        <span id="mobile_error" style="display: none"></span>
                      </div>
                      <div class="form_wrap">
                        <label for="">Message</label>
                        <textarea class="text_area" name="message" rows="6" cols="80"></textarea>
                      </div>
                      <div class="form_wrap">
                        <button class="form_btn" type="submit" name="button" id="contact_submit">Submit</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
           </div>
         </div>
       </div>
      </div>
      </div>
<?php 
  $this->load->view("frontend/footer",array('pageName' => 'contactus'));
?>          