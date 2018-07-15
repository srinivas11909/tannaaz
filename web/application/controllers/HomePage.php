<?php 
class HomePage extends CI_Controller
{

	function index()
	{
		print_r($this);
		$this->load->view('frontend/homepage');
	}

	function aboutUs()
	{
		$pagetype = $_GET['type'];
		if(empty($pagetype) || !in_array($pagetype, array('process','patina')))
		{
			$pagetype = 'history';
		}
		$displayData = array();
		$displayData['pagetype'] = $pagetype;
		$this->load->view('frontend/aboutus',$displayData);
	}
	function contactUs()
	{
		$pagetype = $_GET['type'];
		if(empty($pagetype) || !in_array($pagetype, array('contactus')))
		{
			$pagetype = 'contact';
		}
		$displayData = array();
		$displayData['pagetype'] = $pagetype;
		$this->load->view('frontend/contactUs',$displayData);
	}
	function policyView()
	{
		$this->load->view('frontend/policyView');	
	}
	function postContactUsForm()
	{
		$firstname = !empty($_POST['firstname']) ? $this->input->post('firstname') : '';
		$lastname = !empty($_POST['lastname']) ? $this->input->post('lastname') : '';
		$email = !empty($_POST['email']) ? $this->input->post('email') : '';
		$mobile = !empty($_POST['mobile']) ? $this->input->post('mobile') : '';
		$message = !empty($_POST['message']) ? $this->input->post('message') : '';

		if(empty($firstname) || empty($lastname) || empty($email) || empty($mobile) || !filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			echo json_encode(array('data'=> array('msg' => 'some error occured')));
		}

		$postArray = array();
		$postArray['firstname'] = $firstname;
		$postArray['lastname'] = $lastname;
		$postArray['email'] = $email;
		$postArray['mobile'] = $mobile;
		$postArray['message'] = $message;

		$this->load->library('taannazlibrary');

		$result = $this->taannazlibrary->postContactUsForm($postArray);
		if($result)
		{
			//error_log('===================');
			//$this->taannazlibrary->sendMail($postArray);
			echo json_encode(array('data'=>"success"));
		}
		else
		{

			echo json_encode(array('data'=> 'some error occured'));	
		}
	}
	function search()
	{
		$this->load->model('cmsmodel');
		$this->load->model('detailmodel');
		$searchText = $_GET['q'];
		$results = $this->detailmodel->getProductsBasedOnSearch($searchText);
		$displayData = array();

		foreach ($results as $key => $row) {
			$listingData[$key] = $row;
			$listingData[$key]['listingUrl'] = '/getDetailPage/'.$row['id'];
		}

		$displayData['searchCount'] = count($listingData);
		$displayData['listingData'] = $listingData;
		$displayData['pagetype'] = 'searchpage';
		$displayData['searchText'] = $searchText;
		$this->load->view('frontend/categorypage',$displayData);
	}
}
?>
