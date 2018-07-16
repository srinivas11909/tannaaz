<?php 

class ListingPage extends CI_Controller {
	function getListingPage($listingId){
		$this->load->model('cmsmodel');
		$this->load->library('cmslibrary');

		$categoryTree = $this->cmslibrary->getCategoriesTree();
		$categoryUrls = array();
		foreach ($categoryTree as $row) {
			$categoryUrls[$row['categoryId']]['url'] = '/getListings/'.$row['categoryId'];
			foreach ($row['subcategories'] as $subcatRow) {
				$categoryUrls[$row['categoryId']]['subcategoryUrls'][$subcatRow['subcategoryId']] = '/getListings/'.$row['categoryId'].'/'.$subcatRow['subcategoryId'];
			}
		}

		$displayData['categoryUrls'] = $categoryUrls;
		$displayData['categoryTree'] = $categoryTree;

		$dbData = $this->cmsmodel->getListingById($listingId);
		$mediaData = $this->cmsmodel->getMedia(array($listingId));
		
		$listingData = $dbData;
		$listingData['media'] = $mediaData[$listingId];
		$listingData['attributes'] = $this->cmsmodel->getListingAttributes($listingId);

		$displayData['listingData'] = $listingData;
		$displayData['inputCategoryId'] = $dbData['category_id'];
		$displayData['inputSubcategoryId'] = $dbData['subcategory_id'];
		$this->load->view('frontend/listingdetailpage', $displayData);
	}
}

?>