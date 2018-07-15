<div class="col-lg-3">
	<div class="about_data">
		<?php 
		foreach ($categoryTree as $categoryId => $row) {
			?>
			<div class="about_title <?php echo $categoryId == $inputCategoryId ? 'active' : ''; ?>">
				<?php 
				if(count($row['subcategories']) > 1){
					?>
					<h2 class="sub_cat"><?php echo $row['categoryName']; ?></h2>
					<div class="subcategory">
						<ul>
							<?php 
							foreach ($row['subcategories'] as $subcatRow) {
								?>
								<li><a href="<?php echo $categoryUrls[$categoryId]['subcategoryUrls'][$subcatRow['subcategoryId']]; ?>"><?php echo $subcatRow['subcategoryName']; ?></a></li>
								<?php
							}
							?>
						</ul>
					</div>
					<?php
				}
				else{
					foreach ($row['subcategories'] as $subcatRow) {
						?>
						<a href="<?php echo $categoryUrls[$categoryId]['subcategoryUrls'][$subcatRow['subcategoryId']]; ?>" class="no_category"><?php echo $row['categoryName']; ?></a>
						<?php
					}
				}
				?>
			</div>
			<?php
		}
		?>
	</div>
</div>