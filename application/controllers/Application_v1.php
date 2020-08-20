<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Application extends MY_Controller {
	
	public $alert_danger = '<div class="alert alert-danger light"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	public $alert_warning = '<div class="alert alert-warning light"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	public $alert_success = '<div class="alert alert-success light"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Institutions');
		$this->load->model('Courses');
		$this->load->model('Applications');
		$this->load->model('Attachments');
	}
	
	public function index()
	{
		
	}
	
	public function send_email($subject, $msg, $recipient_email, $recipient_name, $sender_email, $sender_name, $cc="", $bcc="", $attachment="") 
	{
		// $this->load->library('email');

		$this->email->initialize(array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'email-smtp.us-east-1.amazonaws.com',
		  'smtp_user' => 'AKIAI2CYMSDCSZRXIVGA',
		  'smtp_pass' => 'ApYCNr4R6rkLXnu1m+HBbfBTbZdhojtddh7LBVL86ZE/',
		  'smtp_port' => 587,
		  'crlf' => "\r\n",
		  'newline' => "\r\n"
		));
		
		$this->email->set_mailtype("html");
		$this->email->from($sender_email, $sender_name);
		$this->email->to($recipient_email);
		$this->email->cc($cc);
		$this->email->bcc($bcc);
		$this->email->subject($subject);
		$this->email->message($msg);
        $this->email->attach($attachment);
		
		return $this->email->send();
		
		// $this->email->print_debugger();
	}
	
	public function get_random_code($id, $type, $randchar_length = 3, $tc_prefix="")
	{
		$random_no = '';
		
		$randchar_code = generate_random_code($randchar_length, 7); //numeric
		$randchar_code = $tc_prefix.$randchar_code;
		
		$code_exist = 0;
		
		if( $code_exist == 0 )
		{
			$random_no = $randchar_code;
		}
		else
		{
			$this->get_random_code($id, strtolower($type), $randchar_length, $tc_prefix);
		}
		
		return $random_no;
	}
	
	function application_submit()
	{
		$goto_page = 1;
		$application_id_enc = "";

		redirect('application-complete?p='.$goto_page.'&appid='.$application_id_enc);
	}
	
	//#====================================================================================================================
	
	function application_complete()
	{
		$goto_page = $this->input->get('p'); //p = 1 : success; p = 2 : fail
		$application_id_enc = $this->input->get('appid');
		$application_id = 1; //encryptor('decrypt',$application_id_enc);
		
		
		if ( $goto_page == 1 && $application_id > 0 )
		{
			// $display_img = '<a href="#" class="text-success">
								// <span><img src="'.base_url().'img/success.png" alt="" height="100"></span>
							// </a>';
			$display_img = '';
			$display_title = '<p class="text-success">APPLICATION SUBMITTED</p>';
			$display_message = '<p class="font-13 m-t-10"> 
									<span style="font-size: 14px;">
										Your application for the SENHENG EDUCATION ASSISTANCE (SEA) Programme has been submitted and in processing.
									<span><br />
								</p>
								<p class="font-13 m-t-10"> 
									<span style="font-size: 16px; font-weight: 900;">
										Thank you and have a nice day!
									</span> 
								</p>
								<p class="font-13 m-t-10"> 
									<span style="font-size: 12px;">
										If you have any enquiry, please do not hesitate to contact us via email (<a href="mailto:sea@senheng.com.my">sea@senheng.com.my</a>).
									</span> 
								</p>';
		}
		else
		{
			// $display_img = '<a href="#" class="text-danger">
								// <span><img src="'.base_url().'img/fail.png" alt="" height="100"></span>
							// </a>';
			$display_img = '';
			$display_title = '<p class="text-danger">APPLICATION SUBMISSION FAIL</p>';
			$display_message = '<p class="font-13 m-t-10"> 
									<span style="font-size: 14px;">
										We\'re sorry. Your application submission was fail.
									<span><br />
								</p>
								<p class="font-13 m-t-10"> 
									<span style="font-size: 16px; font-weight: 900;">Please try again.</span> 
								</p>
								<p class="font-13 m-t-10"> 
									<span style="font-size: 12px;">
										If you have any enquiry, please do not hesitate to contact us via email (<a href="mailto:sea@senheng.com.my">sea@senheng.com.my</a>).
									</span> 
								</p>';
		}			
		
		$data = array();
		
		$data['display_img'] = $display_img;
		$data['display_title'] = $display_title;
		$data['display_message'] = $display_message;
		
		$this->data = $data;
		$this->middle = 'application_complete';
    	$this->layout();
	}
}
