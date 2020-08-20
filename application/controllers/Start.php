<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends MY_Controller 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		//#clear the session
		//need to comment
		$arr_data_session = array();
		$this->session->unset_userdata($arr_data_session);
		
		$data = array();
		$this->data = $data;
		$this->middle = '';
    	$this->layout();
	}
}
