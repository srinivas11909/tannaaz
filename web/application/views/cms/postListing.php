<?php $this->load->view('cms/cmsHeader'); ?>
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
		    <div class="title_left">
		        <h3> Post New Listing </h3>
		    </div>
		</div>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Enter Details </small></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<br>
						<form id="demo-form2" class="form-horizontal form-label-left" action="">
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="product-name">Enter Name <span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="product-name" required="required" class="form-control col-md-7 col-xs-12">
									<span class="error hid" id="product-name_error">please enter name</span>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="product-desc">Enter description </label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<textarea class="form-control" id="product-desc" rows="3"></textarea>
									<span id="product-desc_error" class="error hid">please enter description</span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Choose Category </label>
								<div class="col-md-3 col-sm-3 col-xs-6">
									<select class="form-control cat-drpdwn">
										<option value="">Choose Category</option>
										<?php 
										foreach ($categoryTree as $categoryId => $row) {
											?>
											<option value="<?php echo $categoryId; ?>"><?php echo $row['categoryName']; ?></option>
											<?php
										}
										?>
									</select>
									<span id="cat-drpdwn_error" class="error hid">please enter category</span>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-6">
									<select class="form-control subcat-drpdwn">
										<option value="">Choose SubCategory</option>
										<?php 
										foreach ($categoryTree as $categoryId => $row) {
											foreach ($row['subcategories'] as $subcategoryId => $subcategory) {
												?>
												<option value="<?php echo $subcategoryId; ?>" categoryId="<?php echo $categoryId; ?>"><?php echo $subcategory['subcategoryName']; ?></option>
												<?php
											}
										}
										?>
									</select>
									<span id="subcat-drpdwn_error" class="error hid">please enter subcategory</span>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Choose Attribute to add </label>
								<div class="col-md-4 col-sm-4 col-xs-8">
									<select class="form-control attr-opts" multiple="multiple">
										<?php 
										foreach ($attributeList as $attributeId => $row) {
											?>
											<option value="<?php echo $attributeId; ?>"><?php echo $row['attributeName']; ?></option>
											<?php
										}
										?>
									</select>
									<span id="attr-opts_error" class="error hid">Add atleast one attribute</span>
								</div>
								<div class="col-md-3 col-sm-3 col-xs-6">
									<button class="btn btn-primary addattr" type="button">Add</button>
								</div>
							</div>

							<div class="attr-cntner">
								
							</div>

							<div class="smple-attr" style="display: none;">
								<div class="attr-div">
									<div class="form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
										<div class="col-md-5 col-sm-5 col-xs-10">
											<div class="col-md-3 col-sm-3 col-xs-6"><input type="number" class="val1 form-control col-md-1 col-xs-2"></div>
											<div class="col-md-offset-2 col-md-3 col-sm-3 col-xs-6"><input type="number" class="val2 form-control col-md-1 col-xs-2"></div>
											<div class="col-md-1 col-sm-1 col-xs-2">/</div>
											<div class="col-md-3 col-sm-3 col-xs-6"><input type="number" class="val3 form-control col-md-1 col-xs-2"></div>
										</div>
										<div class="col-md-3 col-sm-3 col-xs-6"><button class="btn btn-primary rmvattr" type="button">Remove</button></div>
									</div>
								</div>
							</div>
							
							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button class="btn btn-primary" type="button">Cancel</button>
									<button type="button" class="btn btn-success btn-sbmt">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
$this->load->view('cms/cmsFooter');
?>
<script>
	initPostingForm();
	var attributeList = JSON.parse('<?php echo json_encode($attributeList); ?>');
</script>