<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qualification_category extends MY_Controller {
	
	public $alert_danger = '<div class="alert alert-danger light"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	public $alert_warning = '<div class="alert alert-warning light"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	public $alert_success = '<div class="alert alert-success light"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Status');
		$this->load->model('Qualification_categories');
	}
	
	public function index()
	{
		
	}

	public function list_dd()
	{
		$data = array();
		$output = '';

		$usertype_list = $this->user_type;
		
		$qc_lists = $this->Qualification_categories->list_dd();

		$output .= '<option value="">Select Qualification</option>';

		if ( is_array($qc_lists) && count($qc_lists) > 0 )
		{
			foreach ( $qc_lists as $key => $val )
			{
				$pc_id = $val->id;
				$pc_name = $val->name;

				$output .= '<option value="'.$pc_id.'">'.$pc_name.'</option>';
			}
		}

		echo $output;
	}
}
