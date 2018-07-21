<!DOCTYPE html>
<html xmlns:fb="https://www.facebook.com/2008/fbml">
    <head>
    <?php $this->load->view("frontend/headerJsCss"); ?>
    </head>

    <body>
        <div class="top-navbar">
            <div class="container">
                <nav class="desktop_menu">
                    <ul class="flex_navbar">
                        <li class="flex_li">
                            <a href="JavaScript:void(0);" class="nav-title">Products</a>
                            <div class="categeory_block">
                                <div class="container">
                                    <div class="innerCategory">
                                        <?php 
                                        $subcatTree = array();
                                        foreach ($categoryTree as $categoryId => $row) {
                                            ?>
                                            <div class="CategoryStep">
                                                <?php 
                                                if(count($categoryUrls[$categoryId]['subcategoryUrls']) > 1){
                                                    ?>
                                                    <h2 class="CategoryTitl"><?php echo $row['categoryName']; ?></h2>
                                                    <ul>
                                                        <?php 
                                                        foreach ($row['subcategories'] as $subcatRow) {
                                                            ?>
                                                            <li><a href="<?php echo $categoryUrls[$categoryId]['subcategoryUrls'][$subcatRow['subcategoryId']]; ?>"><?php echo $subcatRow['subcategoryName']; ?></a></li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                    <?php
                                                }
                                                else{
                                                    $subcatTree[$categoryId] = $row;
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                        if(!empty($subcatTree)){
                                            ?>
                                            <div class="CategoryStep">
                                                <?php 
                                                foreach ($subcatTree as $categoryId => $row) {
                                                    foreach ($row['subcategories'] as $subcatRow) {
                                                        ?>
                                                        <p><a href="<?php echo $categoryUrls[$categoryId]['subcategoryUrls'][$subcatRow['subcategoryId']]; ?>" class="CategoryTitl"><?php echo $row['categoryName']; ?></a></p>
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
                            </div>
                        </li>
                        <li class="flex_li">
                            <a href="JavaScript:void(0);" class="nav-title">About Us</a>
                            <div class="categeory_block">
                                <div class="aboutSec">
                                    <div class="CategoryStep">
                                        <h2 class="CategoryTitl"><a href="/aboutus">History</a></h2>
                                        <h2 class="CategoryTitl"><a href="/aboutus?type=process">Process</a></h2>
                                        <h2 class="CategoryTitl"><a href="/aboutus?type=patina">Patina</a></h2>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="flex_li"><a href="/"><img src="/public/images/Logo.png" alt="Tannaaz"></a></li>
                        <li class="flex_li">
                            <a href="JavaScript:void(0);" class="nav-title">Contact</a>
                            <div class="categeory_block">
                                <div class="cnt">
                                    <div class="CategoryStep">
                                        <h2 class="CategoryTitl"><a href="/contactus">Contact</a></h2>
                                        <h2 class="CategoryTitl"><a href="/contactus?type=contactus">Contact Us</a></h2>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="flex_li">
                            <a href="JavaScript:void(0);" class="nav-title">Search</a>
                            <div class="categeory_block">
                                <div class="srchBlock">
                                    <div class="CategoryStep">
                                        <input type="text" id="searchtxt" name="" placeholder="Search.." class="srchme" onclick="getSearchText(event,this)" />
                                        <i class="srch_ico"></i>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
                <nav class="mobile_menu">
                    <div class="mobile_flex">
                        <div class="flex_m m_search">search</div>
                        <div class="flex_m logo_m">
                            <a href="javascript:void(0);">
                            <img src="/public/images/Logo.png" alt="">
                            </a>
                        </div>
                        <div class="flex_m ham">
                            <div class="m_lines"></div>
                            <div class="m_lines"></div>
                            <div class="m_lines"></div>
                        </div>
                    </div>
                    <div class="mobile_drop">
                        <ul class="mobile_li">
                            <li class="sub_li">
                                <a>Products</a> <i class="arrow_i"></i>
                                <ul class="inner_ul">
                                    <?php 
                                    foreach ($categoryTree as $categoryId => $row) {
                                        if(count($row['subcategories']) > 1){
                                            ?>
                                            <li class="sub_li">
                                                <a href="javascript:void(0);"><?php echo $row['categoryName'] ?></a> <i class="arrow_i"></i>
                                                <ul class="child_ul">
                                                    <?php 
                                                    foreach ($row['subcategories'] as $subcatRow) {
                                                        ?>
                                                        <li><a href="<?php echo $categoryUrls[$categoryId]['subcategoryUrls'][$subcatRow['subcategoryId']]; ?>"><?php echo $subcatRow['subcategoryName']; ?></a></li>
                                                        <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <li class="no_ul">
                                                <?php 
                                                foreach ($row['subcategories'] as $subcatRow) {
                                                    ?>
                                                    <li><a href="<?php echo $categoryUrls[$categoryId]['subcategoryUrls'][$subcatRow['subcategoryId']]; ?>"><?php echo $subcatRow['subcategoryName']; ?></a></li>
                                                    <?php
                                                }
                                                ?>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="sub_li">
                                <a>About us</a>
                                <i class="arrow_i"></i>
                                <ul class="child_ul">
                                    <li><a href="/aboutus">History</a></li>
                                    <li><a href="/aboutus?type=process">Process</a></li>
                                    <li><a href="/aboutus?type=patina">Patina</a></li>
                                </ul>
                            </li>
                            <li class="sub_li">
                                <a>Contact</a>
                                <i class="arrow_i"></i>
                                <ul class="child_ul">
                                    <li><a href="/contactus">Contact</a></li>
                                    <li><a href="/contactus?type=contactus">Contact Us</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
  