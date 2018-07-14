<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_content">
            <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap jambo_table dataTable no-footer dtr-inline collapsed" cellspacing="0" width="100%" role="grid" aria-describedby="datatable-responsive_info" style="width: 100%;">
                            <thead>
                                <tr role="row">
                                    <th  rowspan="1" colspan="1" style="width: 86px;">LISTING ID</th>
                                    <th  rowspan="1" colspan="1" style="width: 180px;">LISTING NAME</th>
                                    <th  rowspan="1" colspan="1" style="width: 182px;">CATEGORY NAME</th>
                                    <th  rowspan="1" colspan="1" style="width: 81px;">SUBCATEGORY NAME</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(empty($listings)){
                                    ?>
                                    <tr role="row" class="odd parent">
                                        <td colspan="4">No such listing exists</td>
                                    </tr>
                                    <?php
                                }
                                else{
                                    foreach ($listings as $row) {
                                        ?>
                                        <tr role="row" class="odd parent" style="background-color:#fff;">
                                            <td tabindex="0" style="cursor:pointer;font-weight:bold;"><?php  echo $row['id']; ?></td>
                                            <td><?php  echo $row['name']; ?></td>
                                            <td><?php  echo $row['category_name']; ?></td>
                                            <td><?php  echo $row['subcategory_name']; ?></td>
                                        </tr>
                                        <tr class="child hid">
                                            <td class="child" colspan="1"></td>
                                            <td class="child" colspan="8">
                                                <a  class="btn cmsButton cmsFont" href="/cmsPosting/editListing/<?php echo $row['id']; ?>">Edit Listing</a>
                                                <a  class="btn cmsButton cmsFont" target="_blank" href="/a/course/-{{courseInfo.course_id}}" role="button">View Listing</a>
                                                <a class="btn cmsButton cmsFont vdle-btn" listId="<?php echo $row['id']; ?>" role="button">Delete Listing</a>
                                            </td>
                                        </tr>
                                        <?php 
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
if($maxPagesPossible > 1){
    ?>
    <div style="text-align:right">
        <ul class="pagination pagination-sm">
            <?php 
            if($currentPage > 1){
                ?>
                <li pageNumber = "<?php echo $currentPage - 1; ?>"><a href="javascript:void(0);" class="pagination-arw" style="cursor:pointer">❮</a></li>
                <?php
            }
            foreach ($previousPages as $pageNumber) {
                ?>
                <li pageNumber = "<?php echo $pageNumber; ?>" class="page-item"><a href="javascript:void(0);" class="page-link showCursor"><?php echo $pageNumber; ?></a></li>
                <?php
            }
            ?>
            <li pageNumber = "<?php echo $currentPage; ?>" class="page-item active"><a href="javascript:void(0);" class="page-link"><?php echo $currentPage; ?></a></li>
            <?php
            foreach ($nextPages as $pageNumber) {
                ?>
                <li pageNumber = "<?php echo $pageNumber; ?>" class="page-item"><a href="javascript:void(0);" class="page-link showCursor"><?php echo $pageNumber; ?></a></li>
                <?php
            }
            if($currentPage != $maxPagesPossible){
                ?>
                <li pageNumber = "<?php echo $currentPage + 1; ?>"><a href="javascript:void(0);" class="pagination-arw" style="cursor:pointer">❯</a></li>
                <?php
            }
            ?>
        </ul>
    </div>
    <?php
}
?>