<?php
class taannazlibrary{
	private $CI;
	function __construct()
	{
		$this->CI = & get_instance();
		$this->CI->load->model('cmsmodel');
	}
	public function postContactUsForm($postArray)
	{
		if(empty($postArray))
		{
			return false;
		}
		$rs = $this->CI->cmsmodel->postContactUsForm($postArray);
		return $rs;
	}
/*	public function sendMail($postArray)
	{
		$this->CI->load->library('email');
		$to = "nithish8985@gmail.com"; 

	    $from = $postArray['email']; 
	    $first_name = $postArray['firstname']
	    $last_name = $postArray['lastname']
	    $mobilenumber = $postArray['mobile'];
	    $subject = "Taannaz Contact Help";
	    $subject2 = "Copy of your Contact form submission";
	    $message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $postArray['message'];
	    $message2 = "Here is a copy of your message " . $first_name . "\n\n" . $postArray['message'];

	    $headers = "From:" . $from;
	    $headers2 = "From:" . $to;
	    $this->CI->email->from($from,$firstname.' '.$lastname);
	    $this->CI->email->to($to);
	    $this->CI->email->subject($subject);
		$this->CI->email->message($message);
	    //mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
	    //echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
	    // You can also use header('Location: thank_you.php'); to redirect to another page.
	}*/
}
?>