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
											<div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="val1 form-control col-md-1 col-xs-2"></div>
											<div class="col-md-offset-2 col-md-3 col-sm-3 col-xs-6"><input type="text" class="val2 form-control col-md-1 col-xs-2"></div>
											<div class="col-md-1 col-sm-1 col-xs-2">/</div>
											<div class="col-md-3 col-sm-3 col-xs-6"><input type="text" class="val3 form-control col-md-1 col-xs-2"></div>
										</div>
										<div class="col-md-3 col-sm-3 col-xs-6">
											<div class="col-md-5 col-sm-1 col-xs-2">
												<select class="form-control unit">
													<?php 
													foreach ($units as $row) {
														?>
														<option value="<?php echo $row['unit_id']; ?>"><?php echo $row['name']; ?></option>
														<?php
													}
													?>
												</select>
											</div>
											<button class="btn btn-primary rmvattr" type="button">Remove</button>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="product-desc">Upload Pdf </label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input name="samplepdf" type="file" id="samplepdf" onchange="uploadForm(samplepdf)"> 
									<div aria-valuenow="100" class="progress-bar progress-bar-danger" data-transitiongoal="25" style="display: none;">100</div>
				                     <div class="cms-div" style="display:none">
				                         <input id="uploaded_name" type= "text" value="<?=!empty($applicationform['files']['file_name']) ? $applicationform['files']['file_name'] : '';?>" disabled class="cms-input">
				                         <span class="cms-inline" class="viewform" id="viewform">
				                                 <a class="btn cmsButton cmsFont" target="_blank" href="<?=!empty($applicationform['files']['file_url']) ? $applicationform['files']['file_url'] : ''?>">View uploaded form</a>
				                        </span>
				                        <span class="cms-inline" id="cross">
				                                 <a class="btn btn-default" target="_blank" onclick="clearFileData(samplepdf)">X</a>
				                        </span>
				                    </div>
								</div>
							</div>

							<input type="hidden" name="actionType" id="actionType" value="<?php echo $actionType; ?>">
							<input type="hidden" name="listingId" id="listingId" value="<?php echo $listingId; ?>">

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="product-desc">Upload Images </label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input name="sampleimg" type="file" id="sampleimg" onchange="uploadForm(sampleimg,'img')"> 
									<div aria-valuenow="100" class="progress-bar progress-bar-danger" data-transitiongoal="25" style="display: none;">100</div>
				                     <div class="cms-div" style="display:none">
				                         <input id="uploaded_name" type= "text" value="<?=!empty($applicationform['files']['file_name']) ? $applicationform['files']['file_name'] : '';?>" disabled class="cms-input">
				                         <span class="cms-inline" class="viewform" id="viewform">
				                                 <a class="btn cmsButton cmsFont" target="_blank" href="<?=!empty($applicationform['files']['file_url']) ? $applicationform['files']['file_url'] : ''?>">View uploaded form</a>
				                        </span>
				                        <span class="cms-inline" id="cross">
				                                 <a class="btn btn-default" target="_blank" onclick="clearFileData(sampleimg)">X</a>
				                        </span>
				                    </div>
								</div>
								<div id="imagelist">
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
	var editData = JSON.parse('<?php echo json_encode($editData); ?>');
	var actionType = "<?php echo $actionType; ?>";
	var uploadedFiles = {};
	var uploadedImages = [];
	
	function fillEditData(){
		$('#product-name').val(editData['name']);
		$('#product-desc').val(editData['description']);
		$('.cat-drpdwn').val(editData['category_id']);
		$('.cat-drpdwn').trigger('change');
		if(editData['subcategory_id']){
			$('.subcat-drpdwn').val(editData['subcategory_id']);
		}
		var attributeData = {};
		if(editData['attributes'] && editData['attributes'].length > 0){
			var attributeIds = [];
			for(var i =0 ; i < editData['attributes'].length; i++){
				attributeIds.push(editData['attributes'][i]['attribute_id']);
				attributeData[editData['attributes'][i]['attribute_id']] = editData['attributes'][i];
			}
			$('.attr-opts').val(attributeIds);
			$('.addattr').trigger('click');
		}
		for(var attributeId in attributeData){
			$('.attr-cntner').find('.attr-div').each(function(index,ele){
				if($(ele).attr('attributeId') == attributeId){
					$(ele).find('input.val1').val(attributeData[attributeId]['value_1']);
					if(attributeData[attributeId]['value_2'] && attributeData[attributeId]['value_2'] != 0){
						$(ele).find('input.val2').val(attributeData[attributeId]['value_2']);
					}
					if(attributeData[attributeId]['value_3'] && attributeData[attributeId]['value_3'] != 0){
						$(ele).find('input.val3').val(attributeData[attributeId]['value_3']);
					}
				}
			});
		}
		if(editData['media']['image']){
			for(var i = 0; i < editData['media']['image'].length; i++){
				var temp = {};
				temp['img_url'] = editData['media']['image'][i]['media_url'];
				temp['position'] = editData['media']['image'][i]['position'];
				uploadedImages.push(temp);
			}
			if(uploadedImages.length > 0){
				updateSortOptions();
			}
		}
		if(editData['media']['file']){
			var temp = {};
			for(var i = 0; i < editData['media']['file'].length; i++){
				temp['file_url'] = editData['media']['file'][i]['media_url'];
				temp['file_name'] = editData['media']['file'][i]['file_name'];
			}
			if(temp['file_url']){
				var response = {'data' : temp};
				uploadPdfForm(samplepdf, response);
			}
		}
	}

	if(editData){
		fillEditData();
	}
</script>