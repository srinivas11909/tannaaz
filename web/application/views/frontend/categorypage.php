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
								<?php 
								foreach ($listingData as $row) {
									?>
									<div class="col-lg-3 col-md-6">
										<div class="item_card">
											<a target="_blank" href="<?php echo $row['listingUrl']; ?>">
												<div class="item_img">
													<img src="<?php echo empty($row['media']['image'][1]) ? '' : $row['media']['image'][1]['url']; ?>">
												</div>
												<div class="item_name">
													<?php echo $row['name']; ?>
												</div>
											</a>
										</div>
									</div>
									<?php
								}
								?>
							</div>
						</div>
					</div>
					<!--end of products list-->
				</div>
				<!--col-9 ends-->
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