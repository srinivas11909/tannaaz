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
				<?php echo $this->load->view('frontend/categorySidebar'); ?>
				<div class="col-lg-9">
					<!--end of products list-->
					<div class="product_list">
						<h2 class="product_title"><?php echo $categoryTree[$inputCategoryId]['subcategories'][$inputSubcategoryId]['subcategoryName']; ?></h2>
						<div class="all_products">
							<div class="row">
								<!--product cards strat-->
								<div class="col-lg-12">
									<div class="image_show">
										<?php 
										if(!empty($listingData['media']['image'])){
											foreach ($listingData['media']['image'] as $row) {
												?>
												<div class="image_placeholder">
													<table>
														<tbody>
															<tr>
																<td>
																	<div><img src="<?php echo $row['url']; ?>" alt="product details"></div>
																</td>
															</tr>
														</tbody>
													</table>
												</div>
												<?php
												break;
											}
											?>
											<?php 
												if(count($listingData['media']['image']) > 1){
													?>
													<div class="more_images">
														<?php 
														foreach ($listingData['media']['image'] as $row) {
															?>
															<div class="imagecol">
																<a><img src="<?php echo $row['url']; ?>" alt="product details"></a>
															</div>
															<?php
														}
														?>
													</div>
													<?php
												}
											?>
											<?php
										}
										?>
										<div class="product_specifications">
											<h2 class="product_name"><?php echo $listingData['name']; ?></h2>
											<?php 
											foreach ($listingData['attributes'] as $row) {
												?>
												<p class="product_specs"><span><?php echo $row['attribute_name']; ?></span> <?php echo $row['value_1']; ?> 
												<?php 
												if(!empty($row['value_2']) && !empty($row['value_3'])){
													?>
													<sup><?php echo $row['value_2']; ?></sup>⁄<sub><?php echo $row['value_3']; ?></sub>
													<?php
												}
												?>
												"
												</p>
												<?php
											}
											?>
											<p class="product_specs"><span>Projection</span> 2 <sup>29</sup>⁄<sub>32</sub>"</p>
											<p class="show_color"><?php echo $listingData['description']; ?></p>
											<?php 
											if(!empty($listingData['media']['file'])){
												foreach ($listingData['media']['file'] as $row) {
													?>
													<p class="dwnld_pdf"><a target="_blank" href="<?php echo $row['url']; ?>">Tear Sheet</a></p>
													<?php
												}
											}
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end of products list-->
				</div>
			</div>
		</div>
	</div>
	<!--footer start-->
	<div class="footer">
		<footer>
			<div class="container">
				<p class="text-right"><a href="">Policy</a> <span> © 2018 Taanaz Bronzze Pvt.Ltd</span></p>
			</div>
		</footer>
	</div>
	<!--footer ends-->
</div>