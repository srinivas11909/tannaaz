<?php print_r($productData);die;?>
<div class="mainData">
    <div id="freewall" class="free-wall">
      <div class="container">
    		<div id='grid-fixed'>
    			<div class='block tabele-block'>
            <table class="full_table">
              <tr>
                <td class="half-cell">
                  <div class="block">
                    <a class="hoverDiv">
                      <div class="imgName">
                        <?php echo $productData[0]['name']?>
                      </div>
                    </a>
                    <a>
                      <img src="<?php echo $productData[0]['media_url']?>" alt="">
                    </a>
                  </div>
                  <div class="block">
                    <a>
                      <img src="<?php echo $productData[1]['media_url']?>" alt="">
                    </a>
                    <a class="hoverDiv">
                      <div class="imgName">
                        <?php echo $productData[1]['name']?>
                      </div>
                    </a>
                  </div>
                </td>
                <td class="side-cell">
                  <div class="block">
                    <a>
                      <img src="<?php echo $productData[2]['media_url']?>" alt="sliding">
                    </a>
                    <a class="hoverDiv">
                      <div class="imgName">
                        <?php echo $productData[2]['name']?>
                      </div>
                    </a>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="half-cell">
                  <div class="block">
                    <a>
                      <img src="<?php echo $productData[3]['media_url']?>" alt="sliding">
                    </a>
                    <a class="hoverDiv">
                      <div class="imgName">
                        <?php echo $productData[3]['name']?>
                      </div>
                    </a>
                  </div>
                </td>
                <td class="side-cell">
                  <div class="block">
                    <a>
                      <img src="<?php echo $productData[4]['media_url']?>" alt="">
                    </a>
                    <a class="hoverDiv">
                      <div class="imgName">
                        <?php echo $productData[4]['name']?>
                      </div>
                    </a>
                  </div>
                  <div class="block">
                    <a>
                      <img src="<?php echo $productData[5]['media_url']?>" alt="">
                    </a>
                    <a class="hoverDiv">
                      <div class="imgName">
                        <?php echo $productData[5]['name']?>
                      </div>
                    </a>
                  </div>
                </td>
              </tr>
              <tr>
                <td class="full-cell" colspan="2">
                  <div class="block">
                    <a>
                      <img src="<?php echo $productData[6]['media_url']?>" alt="">
                    </a>
                    <a class="hoverDiv">
                      <div class="imgName">
                        <?php echo $productData[6]['name']?>
                      </div>
                    </a>
                  </div>
                </td>
              </tr>
            </table>

          </div>



    		</div>
      </div>
		</div>
    <div class="bgLayer"></div>
  </div>