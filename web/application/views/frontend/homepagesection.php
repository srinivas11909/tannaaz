
<div class="mainData">
    <div id="freewall" class="free-wall">
      <div class="container">
    		<div id='grid-fixed'>
    			<div class='block tabele-block'>
            <table class="full_table">
              <tr>
                <td class="half-cell">
                  <div class="block">
                    <a class="hoverDiv" href="/getListings/<?php echo $productData[0]['catId']?>/<?php echo $productData[0]['subcatId']?>">
                      <div class="imgName">
                        <?php echo $productData[0]['name']?>
                      </div>
                    </a>
                    <a>
                      <img src="<?php echo $productData[0]['media_url']?>" alt="">
                    </a>
                  </div>
                    <?php if(!empty($productData[1])) { ?>
                    <div class="block">
                      <a>
                        <img src="<?php echo $productData[1]['media_url']?>" alt="">
                      </a>
                      <a class="hoverDiv" href="/getListings/<?php echo $productData[1]['catId']?>/<?php echo $productData[1]['subcatId']?>">
                        <div class="imgName">
                          <?php echo $productData[1]['name']?>
                        </div>
                      </a>
                    </div>
                  <?php } ?>
                </td>
                <?php if(!empty($productData[2])) {?>
                    <td class="side-cell">
                  <div class="block">
                    <a>
                      <img src="<?php echo $productData[2]['media_url']?>" alt="sliding">
                    </a>
                    <a class="hoverDiv" href="/getListings/<?php echo $productData[2]['catId']?>/<?php echo $productData[2]['subcatId']?>">
                      <div class="imgName">
                        <?php echo $productData[2]['name']?>
                      </div>
                    </a>
                  </div>
                </td>
                <?php }?>
              </tr>
              <tr>
                <?php if(!empty($productData[3])) {?>
                  <td class="half-cell">
                    <div class="block">
                      <a>
                        <img src="<?php echo $productData[3]['media_url']?>" alt="sliding">
                      </a>
                      <a class="hoverDiv" href="/getListings/<?php echo $productData[3]['catId']?>/<?php echo $productData[3]['subcatId']?>">
                        <div class="imgName">
                          <?php echo $productData[3]['name']?>
                        </div>
                      </a>
                    </div>
                  </td>
                <?php } ?>
                <td class="side-cell">
                  <?php if(!empty($productData[4])) { ?>
                  <div class="block">
                    <a>
                      <img src="<?php echo $productData[4]['media_url']?>" alt="">
                    </a>
                    <a class="hoverDiv" href="/getListings/<?php echo $productData[4]['catId']?>/<?php echo $productData[4]['subcatId']?>">
                      <div class="imgName">
                        <?php echo $productData[4]['name']?>
                      </div>
                    </a>
                  </div>
                <?php } ?>
                <?php if(!empty($productData[5])) {?>
                  <div class="block">
                    <a>
                      <img src="<?php echo $productData[5]['media_url']?>" alt="">
                    </a>
                    <a class="hoverDiv" href="/getListings/<?php echo $productData[5]['catId']?>/<?php echo $productData[5]['subcatId']?>">
                      <div class="imgName">
                        <?php echo $productData[5]['name']?>
                      </div>
                    </a>
                  </div>
                <?php } ?>
                </td>
              </tr>
              <?php if(!empty($productData[6])) {?>
              <tr>
                <td class="full-cell" colspan="2">
                  <div class="block">
                    <a>
                      <img src="<?php echo $productData[6]['media_url']?>" alt="">
                    </a>
                    <a class="hoverDiv" href="/getListings/<?php echo $productData[6]['catId']?>/<?php echo $productData[6]['subcatId']?>">
                      <div class="imgName">
                        <?php echo $productData[6]['name']?>
                      </div>
                    </a>
                  </div>
                </td>
              </tr>
            <?php } ?>
            </table>

          </div>



    		</div>
      </div>
		</div>
    <div class="bgLayer"></div>
  </div>