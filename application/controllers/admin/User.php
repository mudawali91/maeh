<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends My_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users');
		$this->load->model('Logins');
		$this->load->model('Countries');
		$this->load->model('Product_categories');
		$this->load->model('User_countries');
		$this->load->model('User_product_categories');

		/*
		# user type id
		1: Super Admin 
		2: Admin 
		3: Manager
		4: Sales 
		*/
	}

	public function index()
	{
		$data = array();
		$view = 'error_404';

		if ( in_array($this->session->curr_user_type_id, array(1,2)) )
		{
			// uac by superadmin, admin

			$data['usertype_list'] = $this->user_type;
			$data['status_list'] = $this->Users->status_list;
			$view = PATH_SETTINGS.'user';
		}

		$this->data = $data;
		$this->middle = $view;
    	$this->layout();	
	}

	public function form()
	{
		$data = array();
		$view = 'error_404';

		if ( in_array($this->session->curr_user_type_id, array(1,2)) )
		{
			// uac by superadmin, admin

			$data['usertype_list'] = $this->user_type;
			$filter_country = array('involved' => 1);
			$data['country_lists'] = $this->Countries->list_data_dd($filter_country);
			$data['pc_lists'] = $this->Product_categories->list_data_dd();

			$view = PATH_SETTINGS.'user_form';
		}

		$this->data = $data;
		$this->middle = $view;
    	$this->layout();
	}

	// list for datatable
	public function list()
	{
		$data = array();
		$usertype_list = $this->user_type;

        $curr_datetime = getDateTime();

        $no = $_POST['start'];
		$data = array();
		$list = $this->Users->get_datatables();
		$status_list_arr = $this->Users->status_list;
		$status_color_arr = $this->Users->status_color;

        foreach ($list as $field) 
        {
            $no++;
            $row = array();

            $id = $field->id;
            $id_enc = encryptor('encrypt',$id);

            $status = $field->status;

        	$status_label = $status_list_arr[$status];
        	$status_color = $status_color_arr[$status];

            $status = '<span class="btn btn-bold btn-sm btn-font-sm btn-label-'.$status_color.'">'.$status_label.'</span>';

            $last_login = display_datetime('DATETIME2', $field->last_login);

            $row["id"] = $id_enc;
            $row[] = $no;
            $row[] = $field->full_name;
            $row[] = $field->email;
            $row[] = $last_login;
            $row[] = $status;
            $row[] = '	<a href="javascript:void(0)" class="btn_view" ids="'.$id_enc.'" data-toggle="tooltip" data-placement="top" title="View" data-original-title="View" ><i class="fa fa-edit kt-font-brand"></i></a>&nbsp;&nbsp;
            			<a href="javascript:void(0)" class="btn_delete" ids="'.$id_enc.'" data-toggle="tooltip" data-placement="top" title="Delete" data-original-title="Delete" ><i class="fa fa-trash kt-font-red"></i></a>';
            $row[] = '<label class="kt-checkbox kt-checkbox--single kt-checkbox--solid">
                        <input type="checkbox" class="kt-group-checkable cb_single" id="cb_single_'.$id_enc.'" name="cb_single" value="'.$id_enc.'">
                        <span></span>
                    </label>';
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Users->count_all(),
            "recordsFiltered" => $this->Users->count_filtered(),
            "data" => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
	}

	public function save_file($attachment_type, $attachment_field_name, $files, $upload_path)
	{
		// set upload preferences
        // file upload destination
        $config['upload_path'] = $upload_path;

        // allowed file types. * means all types
        $config['allowed_types'] = 'jpg|png|gif|jpeg';
        $allowed_types = array('jpg', 'png', 'gif', 'jpeg');

        // allowed max file size. 0 means unlimited file size
        $config['max_size'] = '0';
        
        // 1MB = 1048576 Bytes
		$allowed_size_min = 0;
		$allowed_size_max = 5242880; // 5MB

        // max file name size
        // $config['max_filename'] = '255';

        // whether file name should be encrypted or not
        $config['encrypt_name'] = TRUE;

        $curr_datetime = date('YmdHis');
        $files_data = array();
        $error_msg = array();

		$rst_upload = 0;
		$msg_upload = "";
		$attachment_name = "";

        //get file details of the files
        $attachment_name = isset($files[$attachment_field_name]['name']) ? $files[$attachment_field_name]['name'] : '';
        $attachment_size = isset($files[$attachment_field_name]['size']) ? $files[$attachment_field_name]['size'] : 0;

        if ( !empty($attachment_name) && $attachment_size > 0 )
        {
			$file_ext = pathinfo($attachment_name, PATHINFO_EXTENSION);
		
			if ( !in_array($file_ext, $allowed_types) ) 
			{
			    $error_msg[] = 'Invalid file type. [Alowed types: '.implode(", ", $allowed_types).']';
			}
			if ( $attachment_size > $allowed_size_max ) 
			{
				$error_msg[] = 'Invalid file size. [Allowed size: < 5MB]';
			}
		}
		else
		{
			$error_msg[] = 'Invalid file upload. File not found';
		}

		if ( is_array($error_msg) && count($error_msg) == 0 )
		{
			// load the preferences
            $this->load->library('upload', $config);

            // check file successfully uploaded. name of the input field
            if ($this->upload->do_upload($attachment_field_name)) 
            {
                // store or display the file info
                $files_data = $this->upload->data();
                $files_name_ori = $files_data['orig_name'];
                $files_name_new = $curr_datetime.'_'.$files_name_ori;

                if ( file_exists($upload_path.$files_data['file_name']) )
                {
	                // rename to new filename
	                rename($upload_path.$files_data['file_name'], $upload_path.$files_name_new);
                }

				if ( file_exists($upload_path.$files_name_new) )
                {
					$rst_upload = 1;
					$msg_upload = 'Save File Successful';
					$attachment_name = $files_name_new;
				}
				else
				{
					$rst_upload = 0;
					$msg_upload = 'Save File Fail';
				}
            } 
            else 
            {
            	//if file upload failed then catch the errors
				$rst_upload = 0;
                $msg_upload = $this->upload->display_errors();
            }
		}
		else
		{
			$rst_upload = 0;
			$msg_upload = $error_msg;
		}

		$rst = array(
						'rst'				=>	$rst_upload, 
						'msg'				=>	$msg_upload,
						'attachment_name'	=>	$attachment_name,
					);

		return $rst;
	}

	public function upload_file()
	{
		$attachment_field_name = strtolower($this->input->post('attachment_field_name'));

		$upload_path = './upload_files/';

		if ( $attachment_field_name == 'signature_image' )
		{
			$upload_path = $upload_path.'signature_images/';
		}

		if ( !empty($attachment_field_name) )
		{
			$upload_file = $this->save_file('', $attachment_field_name, $_FILES, $upload_path);
		}

		if ( is_array($upload_file) && count($upload_file) > 0 )
		{
			$rst_upload = $upload_file['rst'];
			$msg_upload = $upload_file['msg'];
			$attachment_name = $upload_file['attachment_name'];

			if ( $rst_upload == 1 )
			{
				// upload success

				$rst = 1;
				$data = array('attachment_name' => $attachment_name);
				$error = '';
			}
			else
			{
				// upload fail

				$notis_msg = ""; 

				if ( is_array($msg_upload) && count($msg_upload) > 0 )
				{
					$notis_msg .= "<ol style='font-size:12px; font-weight: bold; color: #f96a74; text-align: left;'>";
					
					foreach ( $msg_upload as $val )
					{
						$notis_msg .= "<li>".$val."</li>";
					}
					
					$notis_msg .= "</ol>";
				}
				else
				{
					$notis_msg = $msg_upload;
				}

				$rst = 0;
				$data = array();
				$error = $notis_msg;
			}
		}
		else
		{
			$rst = 0;
			$data = array();
			$error = 'Invalid file upload. File not found';	
		}

		$output = array(
						'rst' 	=> $rst,
						'data' 	=> $data,
						'error' => $error
						);

        echo json_encode($output);
        die();
	}

	public function save()
	{
		$selected_id_enc = $this->input->post('ids');
		$selected_id = encryptor('decrypt',$selected_id_enc);

		$country_id = $this->input->post('country_id');
		$user_type_id = $this->input->post('user_type_id');
		$login_type_id = 1; // login web portal
		$user_name = $this->input->post('user_name');
		$user_password = $this->input->post('user_password');
		$user_password_confirmation = $this->input->post('user_password_confirmation');

		$user_password_enc = encryptor('encrypt',$user_password); 

		$full_name = $this->input->post('full_name');
		$email = $this->input->post('email');
		$mobile_no = $this->input->post('mobile_no');
		$status = $this->input->post('status');
		$signature_image = $this->input->post('signature_image_uploaded');

		$payment_term_review = $this->input->post('payment_term_review');
		$payment_term_approval = $this->input->post('payment_term_approval');
		$quotation_review = $this->input->post('quotation_review');
		$quotation_approval = $this->input->post('quotation_approval');
		$purchaseorder_review = $this->input->post('purchaseorder_review');
		$purchaseorder_approval = $this->input->post('purchaseorder_approval');
		$max_margin_currency = $this->input->post('max_margin_currency');
		$max_margin_value = $this->input->post('max_margin_value');

		$pc_id = $this->input->post('pc_id');
		$pc_auth_effective_date = $this->input->post('pc_auth_effective_date');
		$pc_rate = $this->input->post('pc_rate');

		// check user_name exist or not from db logins
		$find_opt = array(
							'user_name' => $user_name,
						);

		$check_data = $this->Logins->check_data($selected_id, $find_opt);
		$exist_data = ( is_object($check_data) && !empty($check_data) ) ? $check_data->id : '';

		$error = 0;

        if ( empty($exist_data) || $exist_data == 0 )
        {
        	$error = 0;
        }
        else
        {
        	$error++;
        }

        if ( $error == 0 )
		{
			if ( $selected_id == 0 )
			{
				//#Create Data

				// create user
				$data_create = array(
										'user_type_id'			=> $user_type_id,
										'country_id'			=> 75,
										'full_name'				=> $full_name,
										'email'					=> $email,
										'mobile_no'				=> $mobile_no,
										'status' 				=> $status,
										'signature_image'		=> $signature_image,
										'payment_term_review'	=> $payment_term_review,
										'payment_term_approval'	=> $payment_term_approval,
										'quotation_review'		=> $quotation_review,
										'quotation_approval'	=> $quotation_approval,
										'purchaseorder_review'	=> $purchaseorder_review,
										'purchaseorder_approval'=> $purchaseorder_approval,
										'max_margin_currency'	=> $max_margin_currency,
										'max_margin_value'		=> $max_margin_value,
										'created'				=> getDateTime(),
										'updated'				=> getDateTime(),
										'active'				=> 1,
									);
				
				$user_id = $this->Users->create_data($data_create);

				if ( $user_id > 0 )
				{
					$user_id_enc = encryptor('encrypt',$user_id);

					if ( is_array($country_id) && count($country_id) > 0 )
					{
						// add country
						$rst_add_country = $this->save_data_country($user_id, $country_id);
					}

					if ( is_array($pc_id) && count($pc_id) > 0 )
					{
						// add product category
						$rst_add_pc = $this->save_data_product_category($user_id, $pc_id, $pc_auth_effective_date, $pc_rate);
					}

					// create login
					$data_create = array(
											'user_id'		=> $user_id,
											'login_type_id'	=> $login_type_id,
											'user_name'		=> $user_name,
											'user_password'	=> $user_password_enc,
											'created'		=> getDateTime(),
											'updated'		=> getDateTime(),
											'active'		=> 1,
									  	);
				
					$login_id = $this->Logins->create_data($data_create);

					if ( $login_id > 0 )
					{
						$rst = 1;
						$data = array('ids' => $user_id_enc);
						$error = '';
					}
					else
					{
						// login not create then inactive user
						$data_update = array(
											'updated'	=> getDateTime(),
											'active'	=> 0,
											);
						$rst_update_user = $this->Users->update_data($user_id, $data_update);

						$rst = 0;
						$data = array('ids' => $user_id_enc);
						$error = 'Data login not saved';
					}
				}
				else
				{
					$rst = 0;
					$data = array();
					$error = 'Data user not saved';	
				}
			}
			else
			{
				//#Update Data

				// update user
				$data_update = array(
										'user_type_id'			=> $user_type_id,
										'country_id'			=> 75,
										'full_name'				=> $full_name,
										'email'					=> $email,
										'mobile_no'				=> $mobile_no,
										'status' 				=> $status,
										'payment_term_review'	=> $payment_term_review,
										'payment_term_approval'	=> $payment_term_approval,
										'quotation_review'		=> $quotation_review,
										'quotation_approval'	=> $quotation_approval,
										'purchaseorder_review'	=> $purchaseorder_review,
										'purchaseorder_approval'=> $purchaseorder_approval,
										'max_margin_currency'	=> $max_margin_currency,
										'max_margin_value'		=> $max_margin_value,
										'updated'				=> getDateTime(),
									);

				if ( !empty($signature_image) )
				{
					$data_update['signature_image'] = $signature_image;
				}

                $rst_update_user = $this->Users->update_data($selected_id, $data_update);

                if ( $rst_update_user > 0 ) 
                {
			        if ( is_array($country_id) && count($country_id) > 0 )
					{
						// add country
						$rst_add_country = $this->save_data_country($selected_id, $country_id);
					}

					if ( is_array($pc_id) && count($pc_id) > 0 )
					{
						// add product category
						$rst_add_pc = $this->save_data_product_category($selected_id, $pc_id, $pc_auth_effective_date, $pc_rate);
					}

                	// check login data already exist for selected user 
                	$find_opt = array(
										'user_id'		=> $selected_id,
										'login_type_id' => $login_type_id,
									);

					$check_data = $this->Logins->check_data('', $find_opt);
					$login_id = ( is_object($check_data) && !empty($check_data) ) ? $check_data->id : '';


			        if ( empty($login_id) || $login_id == 0 )
			        {
			        	// data not exist then create login
						$data_create = array(
												'user_id'		=> $selected_id,
												'login_type_id'	=> $login_type_id,
												'user_name'		=> $user_name,
												'user_password'	=> $user_password_enc,
												'created'		=> getDateTime(),
												'updated'		=> getDateTime(),
												'active'		=> 1,
										  	);
					
						$login_id = $this->Logins->create_data($data_create);
			        }
			        else
			        {
			        	// data exist then update login
						$data_update = array(
												'updated'	=> getDateTime(),
										  	);

						if ( !empty($user_password) )
						{
							$data_update['user_password'] = $user_password_enc;
						}
					
						$rst_update_login = $this->Logins->update_data($login_id, $data_update);			        	
			        }

					if ( $login_id > 0 )
					{
						$rst = 1;
						$data = array('ids' => $selected_id_enc);
						$error = '';
					}
					else
					{
						$rst = 0;
						$data = array('ids' => $selected_id_enc);
						$error = 'Data login not updated';
					}
                }
				else
				{
					$rst = 0;
					$data = array();
					$error = 'Data user not updated';	
				}
			}
		}
		else
		{
			$rst = 0;
			$data = array();
			$error = 'Username already exist. Please use other username';	
		}

		$output = array(
						'rst' 	=> $rst,
						'data' 	=> $data,
						'error' => $error
						);

        echo json_encode($output);
        die();
	}

	function save_data_country($user_id, $country_id)
	{
		$this->User_countries->delete_data_by_column_value('user_id', $user_id);

		$data_add = array();

		foreach ( $country_id as $key => $val )
		{
			$data_add[] = array(
								'user_id'		=> $user_id,
								'country_id'	=> $val,
								'created'		=> getDateTime(),
								'updated'		=> getDateTime(),	
								'active'		=> 1,
								);
		}

		$result = 0;

		if ( count($data_add) > 0 )
		{
			$affected_id = $this->User_countries->create_data_multiple($data_add);

			if ( $affected_id > 0 )
			{
				$result = 1;
			}
		}

		return $data_add;
	}

	function save_data_product_category($user_id, $pc_id, $pc_auth_effective_date, $pc_rate)
	{
		$this->User_product_categories->delete_data_by_column_value('user_id', $user_id);

		$data_add = array();

		foreach ( $pc_id as $key => $val )
		{
			$data_add[] = array(
								'user_id'				=> $user_id,
								'product_category_id'	=> $val,
								'effective_date'		=> display_datetime('DB_DATE', $pc_auth_effective_date[$key]),
								'rate'					=> $pc_rate[$key],
								'created'				=> getDateTime(),
								'updated'				=> getDateTime(),	
								'active'				=> 1,
								);
		}

		$result = 0;

		if ( count($data_add) > 0 )
		{
			$affected_id = $this->User_product_categories->create_data_multiple($data_add);

			if ( $affected_id > 0 )
			{
				$result = 1;
			}
		}

		return $result;
	}

	public function details($ids)
	{
		$selected_id_enc = $ids;
        $selected_id = encryptor('decrypt', $selected_id_enc);

        $data = array();

		$data['usertype_list'] = $this->user_type;
		$filter_country = array('involved' => 1);
		$data['country_lists'] = $this->Countries->list_data_dd($filter_country);
		$data['pc_lists'] = $this->Product_categories->list_data_dd();

		$data['users'] = $this->Users->read_data_join($selected_id);
		
		$user_countries = $this->User_countries->read_data_by_column_value('user_id', $selected_id);

		$user_countries_selected = array();

		if ( is_array($user_countries) && count($user_countries) > 0 )
		{
			foreach ( $user_countries as $key => $val )
			{
				$user_countries_selected[] = $val->country_id; 
			}
		}

		$data['user_countries'] = $user_countries_selected;

		$user_product_categories = $this->User_product_categories->read_data_join('a.user_id', $selected_id);

		$rand_id_arr = array();
		$pc_id_arr = array();
		$add_row = '';

		if ( is_array($user_product_categories) && count($user_product_categories) > 0 )
		{
			foreach ( $user_product_categories as $key => $val )
			{
                // $rand_id = $val->id;
                $rand_id  = $pc_id = $val->product_category_id;
                $effective_date = display_datetime('DATE2', $val->effective_date);
                $rate = $val->rate;
                $pc_code = $val->code;
                $pc_name = $val->name;

                $pc = format_namecode($pc_name, $pc_code);

                $add_row .= '<tr id="table_row_' . $rand_id . '">';

				$add_row .= '<td id="pc_' . $rand_id . '"><input type="hidden" id="pc_id_' . $rand_id . '" name="pc_id[]" value="' . $pc_id . '"/>' . $pc . '</td>';

                $add_row .= '<td class="text-center"><div class="input-group date"><input type="text" class="form-control form-control-sm pc_auth_effective_date" id="pc_auth_effective_date_' . $rand_id . '" name="pc_auth_effective_date[]" placeholder="Select Effective Date" value="' . $effective_date . '" readonly /><div class="input-group-append"><span class="input-group-text"><i class="la la-calendar-check-o"></i></span></div></div></td>';

                $add_row .= '<td class="text-center"><input type="text" class="form-control form-control-sm" id="pc_auth_rate_' . $rand_id . '" name="pc_rate[]" placeholder="Rate" value="' . $rate . '"></td>';

                $add_row .= '<td class="text-center"><a href="javascript:void(0);" class="btn_remove_row btn-lg" title="Remove this row" onclick="remove_row_pc_authority(\'' . $rand_id . '\')"><i class="fa fa-trash-alt text-danger"></i></a></td>';
            
            	$add_row .= '</tr>';

                $rand_id_arr[] = $rand_id;
                $pc_id_arr[] = $pc_id;
			}
		}

		$rand_id = (count($rand_id_arr) > 0 ? implode(', ', $rand_id_arr) : '');

		$data['user_product_categories'] = $add_row;
		$data['product_categories'] = $pc_id_arr;
		$data['pc_auth_id'] = $rand_id;

		// pre($data);

		$this->data = $data;
		$this->middle = PATH_SETTINGS.'user_form';
    	$this->layout();
	}

	public function delete()
	{
		$selected_id = $this->input->post('ids');
		$selected_id_arr = array();
		$data = 0;

		if ( !empty($selected_id) )
		{
			$selected_id_arr = explode(',', $selected_id);
			array_walk($selected_id_arr, 'encryptor_multiple', 'decrypt'); // call function encryptor_multiple from helper
		}

		if ( is_array($selected_id_arr) && count($selected_id_arr) > 0 )
		{
			$rst_user = $this->Users->delete_data($selected_id_arr);
			$rst_login = $this->Logins->delete_data_by_column_value('user_id', $selected_id_arr);

			if ( $rst_user > 0 && $rst_login > 0 )
			{
				$data = 1;
			}
			else
			{
				$data = 0;
			}
		}
		
		echo json_encode(array('rst'=>$data));
	}

}
