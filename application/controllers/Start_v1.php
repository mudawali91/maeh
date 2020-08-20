<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Institutions');
		$this->load->model('Courses');
	}
	
	public function index()
	{
		//#clear the session order id
		//need to comment
		$arr_data_session = array('sess_order_id','sess_logged_in','application_data','sess_cust_id');
		$this->session->unset_userdata($arr_data_session);
		
		$data = array();
		
		$data['institution_arrlist'] = $this->Institutions->listing();
		$data['course_arrlist'] = $this->Courses->listing();
			
		$this->data = $data;
		$this->middle = 'application_form';
    	$this->layout();
	}
}
