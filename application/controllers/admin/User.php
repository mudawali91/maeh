<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends My_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users');
		$this->load->model('Logins');

		/*
		# user type id
		1: Super Admin 
		2: Admin
		*/

		$this->uac = array(1,2);
		$this->admin = 'admin/';
	}

	public function index()
	{
		$data = array();
		$view = 'error_404';

		if ( in_array($this->session->curr_user_type_id, $this->uac) )
		{
			$view = $this->admin.'user';
		}

		$this->data = $data;
		$this->middle = $view;
    	$this->layout();	
	}
}
