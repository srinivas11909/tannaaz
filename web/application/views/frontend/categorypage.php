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

				<?php
					if($pagetype != 'searchpage') 
							echo $this->load->view('frontend/categorySidebar'); ?>
				<div class="col-lg-9">
					<!--end of products list-->
					<div class="product_list">
						<h2 class="product_title">

							<?php if($pagetype == 'searchpage')
									{
										if($searchCount > 0)
											echo "Search results for ".$searchText;
										else
											echo "No search results for ".$searchText;
									}
									else
										echo $categoryTree[$inputCategoryId]['subcategories'][$inputSubcategoryId]['subcategoryName']; ?></h2>

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
													<?php if($pagetype == 'searchpage') {?>
														<img src="<?php echo empty($row['media_url']) ? '' : $row['media_url']; ?>">
													<?php }else {?>
													<img src="<?php echo empty($row['media']['image'][1]) ? '' : $row['media']['image'][1]['url']; ?>">
													<?php } ?>
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
</div>
<?php 
  $this->load->view("frontend/footer");
?>          