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
               <div class="about_title">
                 <a href="javascript:void(0);" id="history">History</a>
               </div>
               <div class="about_title">
                 <a href="javascript:void(0);">Process</a>
               </div>
               <div class="about_title">
                 <a href="javascript:void(0);">Patina</a>
               </div>
             </div>
           </div>

           <div class="col-lg-9">
              <div class="about_details">
                <div class="history contact" style="display: none" id="history">
                   <h2>History</h2>
                   <div class="about">
                     <p>
                       Established in 2001, Taannaz is the brainchild of Mumbai based brothers Mahesh and Harsh Tanna. <br> <br>
                       The journey began early. The Tanna family had been in the architectural hardware business
                       since 1985. Frequent overseas business trips and exhibition visits inculcated in the brothers a
                       passion for architectural hardware and art at an early age. The exposure to world-class
                       products at internationally renowned trade fairs brought about a keen sense of quality while
                       underscoring the need to innovate. <br/><br/>
                       When the brothers travelled to Chicago for higher studies in the late 90s, the thriving art scene
                       in the city further fuelled their passion for luxury architectural hardware. It was just a matter of
                       time before Taannaz was born. <br/> <br/>
                       What started as a small brand dealing in extruded brass hinges has, over the last 17 years,
                       come a long way. Today Taannaz offers an array of bespoke architectural hardware and
                       accessories of the highest quality in silicon bronze, white bronze and brass. <br/><br/>
                       The entire process from production to plating is carried out at the family’s existing
                       manufacturing set up.
                   </p>
                   </div>
                </div>
                <div class="history" style="display: none" id="process">
                   <h2>Process</h2>
                   <div class="about">
                     <p>
                       The process of creating architectural hardware starts with a pencil sketch or computer aided
                       2D and 3D images of the product. <br/><br/>
                       Depending on the intricacy and complexity of the design, the product is prototyped on CNC
                       machines, 3D printers or by manual wax carving. Prototyping aids in selecting the most
                       feasible manufacturing process for the product. The prototype is then checked for practical
                       applications and all technical requirements of the product. <br/> <br/>
                       Next comes the production of alloys. Taannaz produces its own alloys of silicon bronze, white
                       bronze and brass to retain control over the quality, patina and final finish of the product. <br/><br/>
                       The alloys are melted at temperatures as high as 1400 o C, and depending on the design are
                       sand casted, lost wax casted, forged or extruded. The products are then CNC machined for
                       exact tolerances, after which they are buffed and polished at various stages, thereby
                       preparing for the final finish. <br><br>
                       The buffed products are put through various electroplating baths to achieve the final finish.
                       Bronze items are hand patinaed via hot and cold process to arrive at the desired colour.
                       Finally, a protective coat of lacquer or wax is applied for longevity of the finish and patina.
                   </p>
                   </div>
                </div>
                <div class="history" id="patina">
                   <h2>Patinas</h2>
                   <div class="about">
                     <p>
                       Silicon bronze is an alloy of copper and silicon. Coppery gold in colour, it can be patinaed to
                       light, medium, dark, polished, tumbled, orbital, antique and mottled turquoise shades.<br/><br/>
                       White bronze – an alloy of copper, zinc, nickel, manganese and tin – is champagne white. It
                       can be patinaed to light, medium, dark, polished, tumbled and orbital shades.<br/> <br/>
                       Brass, which is an alloy of copper and zinc is golden yellow and can be finished to polished
                       brass, antique brass, oil rubbed bronze, bright nickel and bright chrome among others. A
                       protective coat of lacquer helps prolong the life of the finish. <br><br>
                       The uniqueness of a patina lies in its ageing. Every patina ages differently. The ageing process
                       is influenced by climatic conditions, touch and passage of time. The patinas on bronze
                       products are protected with a clear superior quality floor wax which delays the ageing process
                       but cannot prevent it altogether. <br><br>
                       Patinaed products should never be cleaned with solvents or chemical cleaners as these can
                       cause permanent damage to the finish. Mild soap and water may be used to clean the
                       products.
                   </p>
                   </div>
                </div>
              </div>
           </div>
         </div>
       </div>
      </div>
    </div>
<?php 
  $this->load->view("frontend/footer");
?>    