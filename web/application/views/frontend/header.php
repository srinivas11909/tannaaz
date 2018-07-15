<!DOCTYPE html>
<html xmlns:fb="https://www.facebook.com/2008/fbml">
  <head>
    <?php 
    $this->load->view("frontend/headerJsCss")?>  
  </head>

  <body>
  <div class="top-navbar">
      <div class="container">
        <nav class="desktop_menu">
           <ul class="flex_navbar">
             <li class="flex_li">
               <a href="JavaScript:void(0);" class="nav-title">Products</a>
               <div class="categeory_block">
                  <div class="container">
                    <div class="innerCategory">
                      <div class="CategoryStep">
                        <h2 class="CategoryTitl">DOOR Hardware</h2>
                        <ul>
                          <li><a href="">Levers</a></li>
                          <li><a href="">Knobs</a></li>
                          <li><a href="">Pulls</a></li>
                          <li><a href="">Escutcheons</a></li>
                        </ul>
                      </div>
                      <div class="CategoryStep">
                        <h2 class="CategoryTitl">DOOR accessories</h2>
                        <ul>
                          <li><a href="">Hinges and Finials</a></li>
                          <li><a href="">Clavos, Hinge Straps &amp; Corner Brackets</a></li>
                          <li><a href="">Door bolts</a></li>
                          <li><a href="">Door stops</a></li>
                          <li><a href="">Push Plates</a></li>
                          <li><a href="">kickplates</a></li>
                          <li><a href="">Door Knockers</a></li>
                        </ul>
                      </div>

                      <div class="CategoryStep">
                        <p><a class="CategoryTitl">window Hardware</a></p>
                        <p><a class="CategoryTitl">Custom Works</a></p>
                        <p><a class="CategoryTitl">Locks</a></p>
                      </div>

                      <div class="CategoryStep">
                        <h2 class="CategoryTitl">sliding DOOR Hardware</h2>
                        <ul>
                          <li><a href="">Flush Pulls</a></li>
                          <li><a href="">Lift and Slide Flush Pull</a></li>
                          <li><a href="">Pocket Door Locks</a></li>
                         </ul>
                      </div>
                      <div class="CategoryStep">
                        <h2 class="CategoryTitl">cabinet Hardware</h2>
                        <ul>
                          <li><a href="">Knobs</a></li>
                          <li><a href="">Roses</a></li>
                          <li><a href="">Bin Pulls</a></li>
                          <li><a href="">Pulls</a></li>
                       </ul>
                      </div>


                      <div class="CategoryStep">
                        <h2 class="CategoryTitl">Home accessories</h2>
                        <ul>
                          <li><a href="">Hooks</a></li>
                          <li><a href="">House Numbers</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
               </div>
             </li>

             <li class="flex_li">
               <a href="JavaScript:void(0);" class="nav-title">About Us</a>
               <div class="categeory_block">
                 <div class="aboutSec">
                   <div class="CategoryStep">
                     <h2 class="CategoryTitl"><a href="/aboutus">History</a></h2>
                     <h2 class="CategoryTitl"><a href="/aboutus?type=process">Process</a></h2>
                     <h2 class="CategoryTitl"><a href="/aboutus?type=patina">Patina</a></h2>
                   </div>
                 </div>
                 </div>
             </li>
             <li class="flex_li"><a href="JavaScript:void(0);"><img src="/public/images/Logo.png" alt="Tannaaz"></a></li>
             <li class="flex_li">
               <a href="JavaScript:void(0);" class="nav-title">Contact</a>
               <div class="categeory_block">
                 <div class="cnt">
                   <div class="CategoryStep">
                       <h2 class="CategoryTitl"><a href="/contactus">Contact</a></h2>
                       <h2 class="CategoryTitl"><a href="/contactus?type=contactus">Contact Us</a></h2>
                   </div>
                 </div>
                 </div>
             </li>
             <li class="flex_li">
               <a href="JavaScript:void(0);" class="nav-title">Search</a>
               <div class="categeory_block">
                 <div class="srchBlock">
                   <div class="CategoryStep">
                     <input type="text" name="" placeholder="Search.." class="srchme" />
                     <i class="srch_ico"></i>
                   </div>
                 </div>

               </div>
             </li>
           </ul>
        </nav>
        <nav class="mobile_menu">
           <div class="mobile_flex">
             <div class="flex_m m_search">search</div>
             <div class="flex_m logo_m">
               <a href="javascript:void(0);">
                 <img src="public/images/Logo.png" alt="">
               </a>
             </div>
             <div class="flex_m ham">
               <div class="m_lines"></div>
               <div class="m_lines"></div>
               <div class="m_lines"></div>
             </div>
           </div>
           <div class="mobile_drop">
             <ul class="mobile_li">
               <li class="sub_li">
                 <a>Products</a> <i class="arrow_i"></i>
                 <ul class="inner_ul">
                   <li class="sub_li">
                     <a>Door Hardware</a> <i class="arrow_i"></i>
                     <ul class="child_ul">
                        <li><a href="javascript:void(0);">Levers</a></li>
                        <li><a href="javascript:void(0);">Knobs</a></li>
                        <li><a href="javascript:void(0);">Pulls</a></li>
                        <li><a href="javascript:void(0);">Escutcheons</a></li>
                      </ul>
                    </li>
                    <li class="sub_li">
                      <a>DOOR accessories</a> <i class="arrow_i"></i>
                      <ul class="child_ul">
                        <li><a href="javascript:void(0);">Hinges and Finials</a></li>
                        <li><a href="javascript:void(0);">Hinge Straps</a></li>
                        <li><a href="javascript:void(0);">Calvos</a></li>
                        <li><a href="javascript:void(0);">Corner Bracket</a></li>
                      </ul>
                     </li>
                     <li class="sub_li">
                       <a>cabinet Hardware</a> <i class="arrow_i"></i>
                       <ul class="child_ul">
                         <li><a href="javascript:void(0);">Knobs and Roses</a></li>
                         <li><a href="javascript:void(0);">Pulls</a></li>
                         <li><a href="javascript:void(0);">Bin Pulls</a></li>
                         <li><a href="javascript:void(0);">Corner Bracket</a></li>
                       </ul>
                      </li>
                      <li class="sub_li">
                        <a>sliding door Hardware</a> <i class="arrow_i"></i>
                        <ul class="child_ul">
                          <li><a href="javascript:void(0);">Flush Pulls</a></li>
                          <li><a href="javascript:void(0);">Lift and Slide Flush Pull</a></li>
                          <li><a href="javascript:void(0);">Pocket Door Locks</a></li>
                        </ul>
                       </li>
                       <li class="no_ul">
                         <a href="javascript">window Hardware</a>
                       </li>
                       <li class="sub_li">
                         <a>home accessories</a> <i class="arrow_i"></i>
                         <ul class="child_ul">
                           <li><a href="javascript:void(0);">Hooks</a></li>
                           <li><a href="javascript:void(0);">House Numbers</a></li>
                           <li><a href="javascript:void(0);">Pocket Door Locks</a></li>
                         </ul>
                        </li>
                        <li class="no_ul">
                          <a href="javascript">custom Hardware</a>
                        </li>
                        <li class="no_ul">
                          <a href="javascript">locks</a>
                        </li>
                  </ul>
                </li>


               <li class="sub_li">
                 <a>About us</a>
                 <i class="arrow_i"></i>
                  <ul class="child_ul">
                    <li><a href="/aboutus">History</a></li>
                    <li><a href="/aboutus?type=process">Process</a></li>
                    <li><a href="/aboutus?type=patina">Patina</a></li>
                  </ul>
               </li>
               <li class="sub_li">
                 <a>Contact</a>
                 <i class="arrow_i"></i>
                  <ul class="child_ul">
                    <li><a href="/contactus">Contact</a></li>
                    <li><a href="/contactus?type=contactus">Contact Us</a></li>
                  </ul>
               </li>
             </ul>
           </div>
        </nav>
      </div>
    </div>