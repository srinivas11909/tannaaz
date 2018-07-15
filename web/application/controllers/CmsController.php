<?php 

class CmsController extends CI_Controller{

	function __construct()
	{
		parent::__construct();
	}

	function isLogin()
	{
		$loginUser = $this->checkUserValidation();
		if((empty($loginUser))||(empty($loginUser['userId']))) {
		    header('location:/CmsController/login');
		    exit();
		}
	}
	function login(){
		$this->load->view('login');
	}
	
	function success()
	{
		$this->isLogin();
		//setcookie('user','12345',time() + 2592000,'/',COOKIEDOMAIN);
		echo "success";
	}

	function deleteListing($listingId){
		$this->load->model('cmsmodel');
		$this->cmsmodel->deleteListing($listingId);
		echo json_encode(array('data' => array('message' => 'Listing with id: '.$listingId.' deleted successfully','status' => 'success')));
	}

	function viewListings(){
		$this->load->model('cmsmodel');
		$this->load->library('cmslibrary');

		$categoryId = $this->input->post('categoryId',true);
		$subCategoryId = $this->input->post('subCategoryId',true);
		$listingId = $this->input->post('listingId',true);
		$callType = $this->input->post('callType',true);
		$currentPage = $this->input->post('currentPage',true) == '' ? 1 : $this->input->post('currentPage',true);

		$listings = array();
		$pageLimit = 4;
		$offset = ($currentPage - 1)*$pageLimit;
		$numberOfPagesToShow = 3;

		if(!empty($listingId)){
			$data = $this->cmsmodel->getListingById($listingId);
			if(!empty($data)){
				$listings[] = $data;
			}
			$totalCount = 1;
		}
		else if(!empty($categoryId) || !empty($subCategoryId)){
			$data = $this->cmsmodel->getProductsByCategoryAndSubcategory($categoryId, $subCategoryId, $offset, $pageLimit);
			$listings = $data['data'];
			$totalCount = $data['totalCount'];
		}
		else{
			$data = $this->cmsmodel->getAllListings($offset,$pageLimit);
			$listings = $data['data'];
			$totalCount = $data['totalCount'];
		}

		$maxPagesPossible = ceil($totalCount/$pageLimit);
		$pageNumbers = array();
		for($i=0; $i< $maxPagesPossible; $i++){
			$pageNumbers[] = $i;
		}
		$previousPages = array();$nextPages = array();
		if($maxPagesPossible <= $numberOfPagesToShow){
			foreach ($pageNumbers as $pageNumber) {
				if($pageNumber+1 < $currentPage){
					$previousPages[] = $pageNumber+1;
				}
				else if($pageNumber+1 > $currentPage){
					$nextPages[] = $pageNumber + 1;
				}
			}
		}
		else{
			$temp = ($numberOfPagesToShow - 1)/2;
			$startIndex = ($currentPage - 1) - floor($temp);
			$endIndex = ($currentPage - 1) + floor($temp);

			if($startIndex < 0){
				$endIndex -= $startIndex;
				$startIndex = 0;
			}
			else if($endIndex > $maxPagesPossible - 1){
				$startIndex -= ($endIndex+1 - $maxPagesPossible);
				$endIndex = $maxPagesPossible - 1;
			}
			for($i =$startIndex; $i <= $endIndex; $i++){
				$pageNumber = $pageNumbers[$i] + 1;
				if($pageNumber < $currentPage){
					$previousPages[] = $pageNumber;
				}
				else if($pageNumber > $currentPage){
					$nextPages[] = $pageNumber;
				}
			}
		}

		$displayData = array();
		$displayData['listings'] = $listings;
		$displayData['totalCount'] = $totalCount;
		$displayData['currentPage'] = $currentPage;
		$displayData['previousPages'] = $previousPages;
		$displayData['nextPages'] = $nextPages;
		$displayData['maxPagesPossible'] = $maxPagesPossible;

		$categoryTree = $this->cmslibrary->getCategoriesTree();
		$displayData['categoryTree'] = $categoryTree;

		if($callType == 'ajax'){
			$html = $this->load->view('cms/cmsListingsTable', $displayData, true);
			echo json_encode(array('html' => $html));
		}
		else{
			$this->load->view('cms/viewListings', $displayData);
		}
	}

	function postListing(){
		$this->load->library('cmslibrary');
		$this->load->config('listingConfig');

		$categoryTree = $this->cmslibrary->getCategoriesTree();
		$displayData['categoryTree'] = $categoryTree;
		$displayData['units'] = $this->config->item('units');

		$attributeList = $this->cmslibrary->getAttributeList();
		$displayData['attributeList'] = $attributeList;
		$displayData['actionType'] = 'add';

		// _p($displayData);die;

		$this->load->view('cms/postListing', $displayData);
	}

	function editListing($listingId){
		$this->load->library('cmslibrary');
		$this->load->model('cmsmodel');
		$this->load->config('listingConfig');

		$categoryTree = $this->cmslibrary->getCategoriesTree();
		$displayData['categoryTree'] = $categoryTree;
		$displayData['units'] = $this->config->item('units');

		$attributeList = $this->cmslibrary->getAttributeList();
		$displayData['attributeList'] = $attributeList;

		$displayData['actionType'] = 'edit';
		$displayData['listingId'] = $listingId;

		$editData = $this->cmsmodel->getListingData($listingId);
		// _p($editData);die;
		$displayData['editData'] = $editData;

		// _p($displayData);die;

		$this->load->view('cms/postListing', $displayData);
	}

	function uploadPdf()
	{
		$response['data'] = array('error' => array('msg' => 'Unable to upload file due to incorrect data'));
        if($_FILES['uploads']) {
            $response = array();
            $response = $this->prepareUploadData($_FILES['uploads']);

            $finalResponse = $response;

            if(!is_array($response) && $response != ""){
				$finalResponse = array();
				$finalResponse['file_url'] = $response;
				$finalResponse['file_size'] = $_FILES['uploads']['size'][0];
				$finalResponse['file_name'] = $_FILES['uploads']['name'][0];
			}

            $response = array('data' => $finalResponse);
        }
        echo json_encode($response);
	}
	function prepareUploadData($uploadArrData,$file_type)
    {

        // check if files has been uploaded
        if(!empty($uploadArrData['tmp_name'][0])) {

            $return_response_array = array();
            // get file data and type check
            $type_doc = $uploadArrData['type']['0'];
            $type_doc = explode("/", $type_doc);
            $type_doc = $type_doc['0'];
            $type = explode(".",$uploadArrData['name'][0]);
            $type = strtolower($type[count($type)-1]);
            // display error if type doesn't match with the required file types
            if(!in_array($type, array('pdf','doc'))) {
                $return_response_array['error']['msg'] = "Only document of type .pdf and .doc allowed";
                return $return_response_array;
            }
            
            $this->load->library('uploadlibrary');


            $upload_array = $this->uploadlibrary->uploadFile('pdf',array('pdf' => $uploadArrData));

            if(is_array($upload_array) && $upload_array['status'] == 1) {
                $return_response_array = $upload_array[0]['imageurl'];
            }
            else {
                if($upload_array == 'Size limit of 25 Mb exceeded') {
                    $upload_array = "Please upload a file less than 25 MB in size"; 
                }
                $return_response_array['error']['msg'] = $upload_array;
            }
            return $return_response_array;
        }
        else {
            return "";
        }
    }
    function uploadMedia()
    {

		$uploadArrData = array();
		$listingMediaType = 'photo';
		$uploadArrData = $_FILES['uploads'];

		if(empty($uploadArrData['tmp_name'][0])) {
            return;
		}

		$this->load->library('uploadlibrary');
		$uploadResponse = $this->uploadlibrary->uploadFile('image',array('image' => $uploadArrData));
		if($uploadResponse['status'] == 1) {
			unset($response['data']['error']);
			$response['data'] = array("imageurl" 	=> $uploadResponse[0]['imageurl']);
		}
		else {
			$response['data']['error']['msg'] = "Image could not be uploaded.";
		}
		echo json_encode($response);

    }

	function saveListing(){
		$data['productName'] = $this->input->post('productName');
		$data['productDesc'] = $this->input->post('productDesc');
		$data['category'] = $this->input->post('category');
		$data['subcategory'] = $this->input->post('subcategory');
		$data['attributes'] = $this->input->post('attributes');
		$data['images']  = $this->input->post('images');
		$data['actionType']  = $this->input->post('actionType');
		$data['listingId']  = $this->input->post('listingId');

		$files  = $this->input->post('files');
		$data['files'] = array();
		if(!empty($files)){
			$data['files'][] = $files;
		}

		$this->load->model('cmsmodel');
		$newProductId = $this->cmsmodel->saveListing($data);
		if($data['actionType'] == 'edit'){
			$message = 'Edited listing with id: '.$newProductId;
		}
		else{
			$message = 'Added new listing with id: '.$newProductId;
		}
		echo json_encode(array('data' => array('message' => $message,'status' => 'success')));
	}
}
?>

