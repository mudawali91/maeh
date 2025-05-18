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
			$data['user_type_list'] = $this->Users->user_type;
			$view = $this->admin.'user';
		}

		$this->data = $data;
		$this->middle = $view;
    	$this->layout_admin();	
	}

	public function list_data()
	{
		$output = array();

		if ( in_array($this->session->curr_user_type_id, $this->uac) )
		{
			$no = $_POST['start'];
			$data = array();

			$user_type_arr = $this->Users->user_type;

			$status_list_arr = $this->Users->status_list;
			$status_color_arr = $this->Users->status_color;

			$list = $this->Users->get_datatables();

	        foreach ($list as $field) 
	        {
	            $no++;
	            $row = array();

	            $id = $field->id;
	            $id_enc = encryptor('encrypt',$id);

	            $user_type = $user_type_arr[$field->user_type_id];

	            $status = $field->status;

	        	$status_label = $status_list_arr[$status];
	        	$status_color = $status_color_arr[$status];

	            $status = '<span class="label label-'.$status_color.'">'.$status_label.'</span>';

	            $last_login = display_datetime('DATETIME2', $field->last_login);

	            $row["id"] = $id_enc;
	            $row[] = '<div class="checkbox checkbox-single">
		                        <input type="checkbox" class="cb_single" id="cb_single_'.$id_enc.'" name="cb_single" value="'.$id_enc.'">
                                <label></label>
		                    </div>';
	            $row[] = 	'<a href="javascript:void(0)" class="table-action-btn btn_view" ids="'.$id_enc.'" title="View Data">
	            				<i class="fa fa-eye fa-lg text-info"></i>
	            			</a>
	            			<a href="javascript:void(0)" class="table-action-btn btn_delete" ids="'.$id_enc.'" title="Delete Data">
	            				<i class="fa fa-trash fa-lg text-danger"></i>
	            			</a>';
	            $row[] = $no;
	            $row[] = $user_type;
	            $row[] = $field->full_name;
	            $row[] = $field->email;
	            $row[] = $field->mobile_no;
	            $row[] = $last_login;
	            $row[] = $status;
	 
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->Users->count_all(),
	            "recordsFiltered" => $this->Users->count_filtered(),
	            "data" => $data,
	        );
		}

        //output dalam format JSON
        echo json_encode($output);
	}
}
