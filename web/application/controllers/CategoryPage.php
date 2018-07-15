<?php 

class CategoryPage extends CI_Controller {

	function getCategoryPage($categoryId, $subcategoryId){
		$this->load->model('cmsmodel');
		$this->load->library('cmslibrary');

		$categoryTree = $this->cmslibrary->getCategoriesTree();

		if(empty($categoryTree[$categoryId]['subcategories'][$subcategoryId])){
			show_404();
		}
		$displayData['categoryTree'] = $categoryTree;
		$displayData['inputCategoryId'] = $categoryId;
		$displayData['inputSubcategoryId'] = $subcategoryId;

		$categoryUrls = array();
		foreach ($categoryTree as $row) {
			$categoryUrls[$row['categoryId']]['url'] = '/getListings/'.$row['categoryId'];
			foreach ($row['subcategories'] as $subcatRow) {
				$categoryUrls[$row['categoryId']]['subcategoryUrls'][$subcatRow['subcategoryId']] = '/getListings/'.$row['categoryId'].'/'.$subcatRow['subcategoryId'];
			}
		}
		$displayData['categoryUrls'] = $categoryUrls;

		$callType = $this->input->post('callType');
		$currentPage = ($this->input->post('pageNumber', true) == '') ? 1 : $this->input->post('pageNumber', true);

		$pageLimit = 20;
		$offset = ($currentPage - 1)*$pageLimit;
		$dbData = $this->cmsmodel->getProductsByCategoryAndSubcategory($categoryId, $subcategoryId, $offset, $pageLimit);
		$data = $dbData['data'];
		$totalCount = $dbData['totalCount'];

		$listingIds = array();
		foreach ($data as $key => $row) {
			$listingIds[] = $row['id'];
			$data[$key]['listingUrl'] = '/getDetailPage/'.$row['id'];
		}

		$listingData = array();
		if(!empty($listingIds)){
			$mediaData = $this->cmsmodel->getMedia($listingIds);
		}
		foreach ($data as $row) {
			$listingData[$row['id']] = $row;
			$listingData[$row['id']]['media'] = $mediaData[$row['id']];
		}
		$displayData['listingData'] = $listingData;
		// _p($displayData);die;
		$this->load->view('frontend/categorypage', $displayData);
	}
}

?>