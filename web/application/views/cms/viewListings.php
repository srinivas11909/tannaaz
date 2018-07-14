<?php $this->load->view('cms/cmsHeader'); ?>
<!-- page content -->
<div class="right_col" role="main">
    <div>
        <div class="page-title">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Search</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="form-group row">
                                    <a class="btn cmsButton cmsFont addListBtn" role="button">Add New Listing</a>
                            </div>
                            <div class="form-group row form-control-X">
                                <label class="col-md-1">Search By:</label>
                                <div class="col-md-11">
                                    <div class="col-md-12 cat-drdwns">
                                        <div class="col-md-5">
                                            <label class="col-md-4" class="cmsFont">Category</label>
                                            <div class="col-md-8">
                                                <select class="form-control vcat-drpdwn">
                                                    <option value="">Choose Category</option>
                                                    <?php 
                                                    foreach ($categoryTree as $categoryId => $row) {
                                                        ?>
                                                        <option value="<?php echo $categoryId; ?>"><?php echo $row['categoryName']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <label class="col-md-1"> OR </label>
                                        <div class="col-md-5">
                                            <label class="col-md-4" class="cmsFont">Subcategory</label>
                                            <div class="col-md-8">
                                                <select class="form-control vsubcat-drpdwn">
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
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="col-md-1 col-md-offset-5" style="margin-top: 22px;"> OR </label>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-5">
                                            <label class="col-md-4" class="cmsFont">Listing ID</label>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="number"   min="1" name="name" class="col-md-2 form-control listId" (keyup)="resetInputFilters('university')" (keyup.enter)="courseListFilters(filterUniversityId,'universityId')">
                                                    <span class="input-group-btn">
                                                    <button type="button" class="btn cmsButton-go listId-btn">Go!</button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row tble-wrpper">
                <?php $this->load->view('cms/cmsListingsTable'); ?>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
<?php $this->load->view('cms/cmsFooter'); ?>
<script>
    initPostingForm();
</script>