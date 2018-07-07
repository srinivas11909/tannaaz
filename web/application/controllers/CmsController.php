<?php 

class CmsController extends CI_Controller{

	function __construct()
	{
		parent::__construct();
	}

	function init(){
		$this->load->library('cmslibrary');
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

	function viewListings(){
		$this->load->view('cms/viewListings');
	}

	function postListing(){
		// $this->init();
		$data = $this->load->library('cmslibrary');
		$categoryTree = $this->cmslibrary->getCategoriesTree();
		$displayData['categoryTree'] = $categoryTree;

		$attributeList = $this->cmslibrary->getAttributeList();
		$displayData['attributeList'] = $attributeList;

		// _p($displayData);die;

		$this->load->view('cms/postListing', $displayData);
	}
	function uploadPdf()
	{
		$response['data'] = array('error' => array('msg' => 'Unable to upload file due to incorrect data'));
        if($_FILES['uploads']) {
            $response = array();
            $response = $this->prepareUploadData($_FILES['uploads']);
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

            	
            	error_log('----------------'.print_r($uploadArrData,true));
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
}
?>

