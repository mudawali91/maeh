<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends MY_Controller {
	
	public $alert_danger = '<div class="alert alert-danger light"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	public $alert_warning = '<div class="alert alert-warning light"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	public $alert_success = '<div class="alert alert-success light"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users');
		$this->load->model('Logins');
		$this->load->model('Status');
		$this->load->model('States');
		$this->load->model('Qualification_categories');
		$this->load->model('Registrations');
		$this->load->model('Members');
		$this->load->model('Member_qualifications');
		$this->load->model('Member_organizations');
        $this->load->model('Reference_runnings');

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
		//#clear the session order id
		//need to comment
		$arr_data_session = array();
		$this->session->unset_userdata($arr_data_session);
		
		$data = array();
		
		$data['states'] = $this->States->list_dd(); 
		$data['qualification_categories'] = $this->Qualification_categories->list_dd(); 

		// $this->data = $data;
		// $this->middle = 'registration_form';
    	// $this->layout();

    	$this->load->view('registration_form', $data);
	}

	public function save()
	{
		$selected_id_enc = $this->input->post('sid'); // registration id
		$selected_id = ( !empty($selected_id_enc) ? encryptor('decrypt',$selected_id_enc) : 0 );

		$selected_id2_enc = $this->input->post('sid2'); // member id
		$selected_id2 = ( !empty($selected_id2_enc) ? encryptor('decrypt',$selected_id2_enc) : 0 );

		$submit_form = !empty($this->input->post('submit_form')) ? $this->input->post('submit_form') : 0;

		$registration_agreement = $this->input->post('registration_agreement');
		$registration_payment = $this->input->post('registration_payment');
		$payment_receipt = $this->input->post('payment_receipt_uploaded');
		$payment_status = NULL;
		$registration_status = NULL;

		$name = $this->input->post('name');
		$icno = $this->input->post('icno');
		$icno = str_replace('_', '', $icno);
		$contactno_mobile = $this->input->post('contactno_mobile');
		$contactno_mobile = str_replace('_', '', $contactno_mobile);
		$email = $this->input->post('email');
		$dob = display_datetime('DB_DATE', $this->input->post('dob'));
		$contactno_home = $this->input->post('contactno_home');
		$contactno_home = str_replace('_', '', $contactno_home);
		$home_address = $this->input->post('home_address');
		$home_postcode = $this->input->post('home_postcode');
		$home_city = $this->input->post('home_city');
		$home_state = $this->input->post('home_state');
		$job_position = $this->input->post('job_position');
		$contactno_office = $this->input->post('contactno_office');
		$contactno_office = str_replace('_', '', $contactno_office);
		$office_address = $this->input->post('office_address');
		$office_postcode = $this->input->post('office_postcode');
		$office_city = $this->input->post('office_city');
		$office_state = $this->input->post('office_state');
		$member_status = NULL;

		$qualification_category 	= $this->input->post('qualification_category');
		$qualification_title 		= $this->input->post('qualification_title');
		$qualification_year 		= $this->input->post('qualification_year');
		$qualification_institution 	= $this->input->post('qualification_institution');

		$organization_name 	= $this->input->post('organization_name');
		$organization_post 	= $this->input->post('organization_post');

		// check icno exist or not
		$find_opt = array(
							'icno'	=> $icno,
							'active'=> 1,
						);

		$check_data = $this->Members->check_data($selected_id2, $find_opt);
		$exist_data = ( is_object($check_data) && !empty($check_data) ) ? $check_data->id : '';

		$error = 0;

        if ( empty($exist_data) || $exist_data == 0 )
        {
        	$error = 0;
        }
        else
        {
        	$error = -1;
        }

        $rst = 0;
		$data = array();
		$msg = '';	

        if ( $error == 0 )
		{
			if ( $selected_id == 0 )
			{
				// Create Data

				// create registration
				$data_create_registration = array(
													'payment_status' 			=> $payment_status,
													'registration_status' 		=> $registration_status,
													'created' 					=> getDateTime(),
													'updated' 					=> getDateTime(),
													'active'					=> 0,
												);
				
				$registration_id = $this->Registrations->create_data($data_create_registration);

				if ( $registration_id > 0 )
				{
					// create registration
					$data_create_member = array(
													'registration_id'	=> $registration_id,
													'name' 				=> $name,
													'icno' 				=> $icno,
													'contactno_mobile' 	=> $contactno_mobile,
													'email' 			=> $email,
													'dob' 				=> $dob,
													'contactno_home' 	=> $contactno_home,
													'home_address' 		=> $home_address,
													'home_postcode' 	=> $home_postcode,
													'home_city' 		=> $home_city,
													'home_state' 		=> $home_state,
													'job_position' 		=> $job_position,
													'contactno_office' 	=> $contactno_office,
													'office_address' 	=> $office_address,
													'office_postcode' 	=> $office_postcode,
													'office_city' 		=> $office_city,
													'office_state' 		=> $office_state,
													'member_status'		=> $member_status,
													'created' 			=> getDateTime(),
													'updated' 			=> getDateTime(),
													'active'  			=> 0,
												);

					$member_id = $this->Members->create_data($data_create_member);

					$data_update_registration = array(
														'member_id'	=> $member_id, 		
														'updated' 	=> getDateTime(),
													);
					$registration_update = $this->Registrations->update_data($registration_id, $data_update_registration);

					$selected_id_enc = $registration_id_enc = encryptor('encrypt',$registration_id);
					$selected_id2_enc = $member_id_enc = encryptor('encrypt',$member_id);

					if ( $submit_form == 1 && $member_id > 0 )
					{
						if ( is_array($qualification_category) && count($qualification_category) > 0 )
						{
							// add qualifications
							$rst_add_qualifications = $this->save_qualifications($member_id, $qualification_category, $qualification_title, $qualification_year, $qualification_institution);
						}

						if ( is_array($organization_name) && count($organization_name) > 0 )
						{
							// add organizations
							$rst_add_organizations = $this->save_organizations($member_id, $organization_name, $organization_post);
						}
					}

					$rst 	= 1;
					$data 	= array('sid' => $registration_id_enc, 'sid2' => $member_id_enc);
					$msg 	= 'Registration Successful!';	
				}
				else
				{
					$rst 	= 0;
					$data 	= array();
					$msg 	= 'Registration Fail!';	
				}
			}
			else
			{
				$set_active = ( $submit_form == 1 ) ? 1 : 0;
				$set_member_status = ( $submit_form == 1 ) ? 1 : NULL; 
				$set_registration_status = ( $submit_form == 1 ) ? 1 : NULL;

				$registration_no = NULL;

				if ( $submit_form == 1 )
				{
					// generate registration no once submit
					$registration_no = $this->Reference_runnings->generate_reference_no('REGISTRATION', date('Y'));
				}

				// update registration
				$data_update_registration = array(
													'registration_no'			=> $registration_no,
													'payment_status' 			=> $payment_status,
													'registration_status' 		=> $set_registration_status,
													'updated' 					=> getDateTime(),
													'active'					=> $set_active,
												);

				$data_update_registration['registration_agreement'] = $registration_agreement;
				$data_update_registration['registration_payment'] 	= $registration_payment;
				$data_update_registration['payment_receipt'] 		= $payment_receipt;
				
				$rst_registration = $this->Registrations->update_data($selected_id, $data_update_registration);

				if ( $rst_registration > 0 )
				{
					$membership_no = NULL;

					if ( $submit_form == 1 )
					{
						$membership_no = $this->Reference_runnings->generate_reference_no('MEMBERSHIP', NULL);
					}

					// update member
					$data_update_member = array(
													'membership_no'		=> $membership_no,
													'name' 				=> $name,
													'icno' 				=> $icno,
													'contactno_mobile' 	=> $contactno_mobile,
													'email' 			=> $email,
													'dob' 				=> $dob,
													'contactno_home' 	=> $contactno_home,
													'home_address' 		=> $home_address,
													'home_postcode' 	=> $home_postcode,
													'home_city' 		=> $home_city,
													'home_state' 		=> $home_state,
													'job_position' 		=> $job_position,
													'contactno_office' 	=> $contactno_office,
													'office_address' 	=> $office_address,
													'office_postcode' 	=> $office_postcode,
													'office_city' 		=> $office_city,
													'office_state' 		=> $office_state,
													'member_status'		=> $set_member_status,
													'updated' 			=> getDateTime(),
													'active'			=> $set_active,
												);

					$rst_member = $this->Members->update_data($selected_id2, $data_update_member);

					if ( $submit_form == 1 && $rst_member > 0 )
					{
						if ( is_array($qualification_category) && count($qualification_category) > 0 )
						{
							// add qualifications
							$rst_add_qualifications = $this->save_qualifications($selected_id2, $qualification_category, $qualification_title, $qualification_year, $qualification_institution);
						}

						if ( is_array($organization_name) && count($organization_name) > 0 )
						{
							// add organizations
							$rst_add_organizations = $this->save_organizations($selected_id2, $organization_name, $organization_post);
						}
					}

					$rst 	= 1;
					$data 	= array('sid' => $selected_id_enc, 'sid2' => $selected_id2_enc);
					$msg 	= 'Registration Successful!';	
				}
				else
				{
					$rst 	= 0;
					$data 	= array();
					$msg 	= 'Registration Fail!';	
				}
			}
		}
		else if ( $error == -1 )
		{
			$rst 	= -1;
			$data 	= array();
			$msg	= 'NRIC No already exist';	
		}
		else
		{
			$rst 	= 0;
			$data 	= array();
			$msg	= 'Registration Fail!';	
		}

		if ( $submit_form == 1 )
		{
			redirect('registration-complete/'.$selected_id_enc);
		}
		else
		{
			$output = array(
							'rst' 	=> $rst,
							'data' 	=> $data,
							'msg' 	=> $msg
							);

			// output in JSON format 
	        echo json_encode($output);
		}
	}

	function save_qualifications($member_id, $qualification_category, $qualification_title, $qualification_year, $qualification_institution)
	{
		$this->Member_qualifications->delete_data_by_column_value('member_id', $member_id);

		$data_add = array();

		foreach ( $qualification_category as $key => $val )
		{
			$data_add[] = array(
								'member_id'					=> $member_id,
								'qualification_category_id'	=> $val,
								'qualification_title'		=> $qualification_title[$key],
								'qualification_year'		=> $qualification_year[$key],
								'qualification_institution'	=> $qualification_institution[$key],
								'created'					=> getDateTime(),
								'updated'					=> getDateTime(),	
								'active'					=> 1,
								);
		}

		$result = 0;

		if ( count($data_add) > 0 )
		{
			$affected_id = $this->Member_qualifications->create_data_multiple($data_add);

			if ( $affected_id > 0 )
			{
				$result = 1;
			}
		}

		return $result;
	}

	function save_organizations($member_id, $organization_name, $organization_post)
	{
		$this->Member_organizations->delete_data_by_column_value('member_id', $member_id);

		$data_add = array();

		foreach ( $organization_name as $key => $val )
		{
			$data_add[] = array(
								'member_id'			=> $member_id,
								'organization_name'	=> $val,
								'organization_post'	=> $organization_post[$key],
								'created'			=> getDateTime(),
								'updated'			=> getDateTime(),	
								'active'			=> 1,
								);
		}

		$result = 0;

		if ( count($data_add) > 0 )
		{
			$affected_id = $this->Member_organizations->create_data_multiple($data_add);

			if ( $affected_id > 0 )
			{
				$result = 1;
			}
		}

		return $result;
	}

	public function save_file($attachment_type, $attachment_field_name, $files, $upload_path)
	{
		// set upload preferences
        // file upload destination
        $config['upload_path'] = $upload_path;

        // allowed file types. * means all types
        $config['allowed_types'] = 'jpeg|jpg|png|pdf';
        $allowed_types = array('jpeg', 'jpg', 'png', 'pdf');

        // allowed max file size. 0 means unlimited file size
        $config['max_size'] = '0';
        
        // 1MB = 1048576 Bytes
		$allowed_size_min = 0;
		$allowed_size_max = 2097152; // 2MB

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
				$error_msg[] = 'Invalid file size. [Allowed size: < 2MB]';
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
						'attachment_ext'	=>	$file_ext,
					);

		return $rst;
	}

	public function upload_file()
	{
		$attachment_field_name = strtolower($this->input->post('attachment_field_name'));

		$upload_path = './upload_files/';

		if ( $attachment_field_name == 'payment_receipt' )
		{
			$upload_path = $upload_path.'payment_receipts/';
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
			$attachment_ext = $upload_file['attachment_ext'];

			$attachment_preview = '<i class="fa fa-file-o fa-3x"></i><p>No File Uploaded</p>';

			if ( in_array(strtolower($attachment_ext), array('jpeg', 'jpg', 'png')) )
			{
				$attachment_preview = '<i class="fa fa-file-image-o fa-3x"></i><p>Payment Receipt Uploaded</p>';
			}
			else if ( strtolower($attachment_ext) == 'pdf' )
			{
				$attachment_preview = '<i class="fa fa-file-pdf-o fa-3x"></i><p>Payment Receipt Uploaded</p>';
			}

			if ( $rst_upload == 1 )
			{
				// upload success
				$rst = 1;
				$data = array(
								'attachment_name' => $attachment_name, 
								'attachment_preview' => $attachment_preview
							);
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

	public function registration_complete($id)
	{
		$registration_id_enc = $id;
		$registration_id =  encryptor('decrypt',$registration_id_enc);

		$registration_data = $this->Registrations->read_join($registration_id);

		if ( is_object($registration_data) && !empty($registration_data) )
		{
			$member_id = $registration_data->member_id;
			$registration_status = $registration_data->registration_status;

			if ( $member_id > 0 && $registration_status > 0 )
			{
				$display_img = ' <span><img src="'.base_url().'img/success.png"></span>';
				$display_title = '<p class="text-success m-t-10">REGISTRATION SUCCESSFUL</p>';
				$display_message = '<p class="font-13 m-t-10"> 
										<span style="font-size: 14px;">
											Your registration for Malaysia Association of Environmental Health (MAEH) Member has been submitted and processing.
										<span><br />
									</p>
									<p class="font-13 m-t-10"> 
										<span style="font-size: 16px; font-weight: 900;">
											Thank you and have a nice day!
										</span> 
									</p>';
			}
			else
			{
				$display_img = ' <span><img src="'.base_url().'img/fail.png"></span>';
				$display_title = '<p class="text-danger m-t-10">REGISTRATION FAIL</p>';
				$display_message = '<p class="font-13 m-t-10"> 
										<span style="font-size: 14px;">
											We\'re sorry. Your registration was fail.
										<span><br />
									</p>
									<p class="font-13 m-t-10"> 
										<span style="font-size: 16px; font-weight: 900;">Please try again.</span> 
									</p>';
			}	
		}
		else
		{
			$display_img = ' <span><img src="'.base_url().'img/fail.png"></span>';
			$display_title = '<p class="text-danger m-t-10">REGISTRATION NOT FOUND</p>';
			$display_message = '<p class="font-13 m-t-10"> 
									<span style="font-size: 14px;">
										We\'re sorry. Your registration data not exist in our database.
									<span><br />
								</p>
								<p class="font-13 m-t-10"> 
									<span style="font-size: 16px; font-weight: 900;">Please try again.</span> 
								</p>';
		}		


		$display_message .= '<p class="font-13 m-t-10"> 
								<span style="font-size: 12px;">
									If you have any enquiry, please do not hesitate to contact us
								</span> 
							</p>';

		$display_message .= '<p class="font-13 m-t-10"> 
								<span style="font-size: 12px;">
									<a href="mailto:admin@maeh.com.my">admin@maeh.com.my</a>
									<br />
									<a href="tel:+6031234567">+603 123 4567</a>
								</span> 
							</p>';
		
		$data = array();
		
		$data['display_img'] = $display_img;
		$data['display_title'] = $display_title;
		$data['display_message'] = $display_message;
		
    	$this->load->view('registration_complete', $data);
	}

	public function check_status()
	{
		$data = array();
		
    	$this->load->view('registration_status', $data);
	}

	public function get_status()
	{
		$icno = $this->input->post('icno');
		$icno = str_replace('-', '', $icno);

		$error = 0;
		$error_msg = array();

		// validate input
		if ( empty($icno) )
		{
			$error_msg[] = 'IC No is empty';
		}

		if ( count($error_msg) > 0 )
		{
			$error = -1;
		} 

		$rst = 0;
		$data = array();
		$msg = '';

		if ( $error == 0 )
		{
			$filter = array('icno_no_dash' => $icno);

			$registration_data = $this->Registrations->read_join_3($filter);

			if ( is_object($registration_data) && !empty($registration_data) )
			{
				$member_id = $registration_data->member_id;
				$registration_status = $registration_data->registration_status;
				$membership_no = $registration_data->membership_no;
				$name = $registration_data->name;
				$icno = $registration_data->icno;

				if ( $member_id > 0 && $registration_status > 0 )
				{
					$rst = 1;

					$status_list = $this->Status->list_all();
					$status_arr = array();

					if ( is_array($status_list) && count($status_list) > 0 )
					{
						foreach ($status_list as $key => $val) 
						{
							$status_arr[$val->id] = array(
															'status' 			=> $val->status,
															'bootstrap_class' 	=> $val->bootstrap_class,
															'color_code' 		=> $val->color_code
														); 
						}
					}

		        	$registration_status_label = $status_arr[$registration_status]['status'];
		        	$registration_status_color = $status_arr[$registration_status]['bootstrap_class'];
		            $registration_status_display = '<span class="label label-'.$registration_status_color.' font-14">'.$registration_status_label.'</span>';
		            $registration_status_color_code = $status_arr[$registration_status]['color_code'];

		            $msg = '<div class="col-md-12 text-center p-0 p-t-10 m-b-0" style="border: 2px '.$registration_status_color_code.' dashed; border-radius: 4px;">';
					$msg .= '<p class="m-b-5 font-bold">Status: '.$registration_status_display.'</p>';
					$msg .= '<p class="m-b-5 font-bold">Name: '.$name.'</p>';
					$msg .= '<p class="m-b-5 font-bold">IC NO: '.$icno.'</p>';

					// status approved
					if ( $registration_status == 2 )
					{
						$msg .= '<p class="m-b-5 font-bold">Membership No: '.$membership_no.'</p>';
					}

					$msg .= '</div>';
				}
				else
				{
					$msg .= '<p class="text-danger m-t-5 font-16 font-bold">IC No Not Found!</p>';
					$msg .= '<p class="font-13 m-b-5"> 
								<span style="font-size: 14px;">
									We\'re sorry. Your registration data does not exist in our database.
								<span><br />
							</p>';
				}	
			}
			else
			{
				$msg .= '<p class="text-danger m-t-5 font-16 font-bold">IC No Not Found!</p>';
				$msg .= '<p class="font-13 m-b-5"> 
							<span style="font-size: 14px;">
								We\'re sorry. Your registration data does not exist in our database.
							<span><br />
						</p>';
			}		


			$msg .= '<p class="font-13 m-t-10"> 
						<span style="font-size: 12px;">
							If you have any enquiry, please do not hesitate to contact us
						</span> 
					</p>';

			$msg .= '<p class="font-13 m-t-10"> 
						<span style="font-size: 12px;">
							<a href="mailto:admin@maeh.com.my">admin@maeh.com.my</a>
							<br />
							<a href="tel:+6031234567">+603 123 4567</a>
						</span>
					</p>';
		}
		else
		{
			$notis_msg = "Please key in your IC No!";

			// $notis_msg .= "<ol style='font-size:12px; font-weight: bold; color: #f96a74; text-align: left;'>";
					
			// foreach ( $error_msg as $val )
			// {
			// 	$notis_msg .= "<li>".$val."</li>";
			// }
			
			// $notis_msg .= "</ol>";

			$rst = -1;
			$data = array();
			$msg = $notis_msg;
		}

		$output = array(
						'rst' 	=> $rst,
						'data' 	=> $data,
						'msg' 	=> $msg
						);

		echo json_encode($output);
	}

	public function list_page()
	{
		$data = array();
		$view = 'error_404';

		if ( in_array($this->session->curr_user_type_id, $this->uac) )
		{
			$data['status_list'] = $this->Status->list_dd();
			$view = $this->admin.'registration'; 
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
			$list = $this->Registrations->get_datatables();

	        foreach ($list as $field) 
	        {
	            $no++;
	            $row = array();

	            $id = $field->registration_id;
	            $id_enc = encryptor('encrypt',$id);

	            $registration_status = $field->registration_status;

	        	$registration_status_label = $field->registration_status_label;
	        	$registration_status_color = $field->registration_status_color;
	            $registration_status = '<span class="label label-'.$registration_status_color.'">'.$registration_status_label.'</span>';

	            // $address = $field->home_address;
	            // $address .= '<br />'.$field->home_postcode.' '.$field->home_city;
	            // $address .= '<br />'.$field->home_state;

	            $registration_date = display_datetime('DATETIME2', $field->registration_date);

	            $row["id"] = $id_enc;
	            $row[] = '<div class="checkbox checkbox-single">
		                        <input type="checkbox" class="cb_single" id="cb_single_'.$id_enc.'" name="cb_single" value="'.$id_enc.'">
                                <label></label>
		                    </label>';
	            $row[] = 	'<a href="javascript:void(0)" class="table-action-btn btn_view" ids="'.$id_enc.'" title="View Data">
	            				<i class="fa fa-eye fa-lg text-info"></i>
	            			</a>
	            			<a href="javascript:void(0)" class="table-action-btn btn_delete" ids="'.$id_enc.'" title="Delete Data">
	            				<i class="fa fa-trash fa-lg text-danger"></i>
	            			</a>';
	            $row[] = $no;
	            $row[] = $field->registration_no;
	            $row[] = $field->membership_no;
	            $row[] = $field->name;
	            $row[] = $field->icno;
	            $row[] = $registration_date;
	            $row[] = $registration_status;
	 
	            $data[] = $row;
	        }
	 
	        $output = array(
	            "draw" => $_POST['draw'],
	            "recordsTotal" => $this->Registrations->count_all(),
	            "recordsFiltered" => $this->Registrations->count_filtered(),
	            "data" => $data,
	        );
		}

        //output dalam format JSON
        echo json_encode($output);
	}

	public function total()
	{
		$rst = 0;
		$data = array();
		$msg = '';

		$filter_registration_no = $this->input->post('filter_registration_no');
    	$filter_date_start = $this->input->post('filter_date_start');
    	$filter_date_end = $this->input->post('filter_date_end');
    	$filter_status = $this->input->post('filter_status');
    	$filter_membership_no = $this->input->post('filter_membership_no');
    	$filter_icno = $this->input->post('filter_icno');
    	$filter_name = $this->input->post('filter_name');

		$filter = array(
						'filter_registration_no'	=> $filter_registration_no,
						'filter_date_start' 		=> $filter_date_start,
						'filter_date_end' 			=> $filter_date_end,
						'filter_status'				=> $filter_status,
						'filter_membership_no'		=> $filter_membership_no,
						'filter_icno' 				=> $filter_icno,
						'filter_name' 				=> $filter_name,
						);

		$data = $this->Registrations->read_total($filter);

		$output = array(
						'rst' 	=> $rst,
						'data' 	=> $data,
						'msg' 	=> $msg
						);

		echo json_encode($output);
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
			$data = $this->Registrations->delete_data($selected_id_arr);
		}
		
		echo json_encode(array('rst'=>$data));
	}

	public function approval()
	{
		$registration_id_enc = $this->input->post('ids_1');
	    $registration_id = encryptor('decrypt', $registration_id_enc);
		$member_id_enc = $this->input->post('ids_2');
	    $member_id = encryptor('decrypt', $member_id_enc);
		$status = $this->input->post('status');
		$approval_remarks = $this->input->post('approval_remarks');

		$rst = 0;
		$data = array();
		$msg = '';

		$data_update = array(
							'registration_status' => $status,
							'approval_remarks' => $approval_remarks,
							'approval_at' => getDateTime(),
							'approval_by' => $this->session->curr_user_id,
							'updated' => getDateTime(),
							);
		$rst = $this->Registrations->update_data($registration_id, $data_update);

		$status_label = ( $status == 3 ) ? ' Reject' : ' Approve';

		if ( $rst > 0 )
		{
			$msg = 'Registration '.$status_label.' Succesful';
		}
		else
		{
			$msg = 'Registration '.$status_label.' Fail';
		}

		$output = array(
						'rst' 	=> $rst,
						'data' 	=> $data,
						'msg' 	=> $msg
						);

		echo json_encode($output);
	}

	public function details($ids)
	{
        $data = array();
		$view = 'error_404';

		if ( in_array($this->session->curr_user_type_id, $this->uac) )
		{
			$selected_id_enc = $ids;
	        $selected_id = encryptor('decrypt', $selected_id_enc);

			$data['states'] = $this->States->list_dd(); 
			$data['qualification_categories'] = $this->Qualification_categories->list_dd();
			$data['status_list'] = $this->Status->list_dd();

			$data['registration_data'] = $this->Registrations->read_join_2($selected_id);
			$data['registration_data']->dob = display_datetime('DATE', $data['registration_data']->dob);
			$data['registration_data']->registration_date = display_datetime('DATETIME2', $data['registration_data']->registration_date);

			$attachment_name = $data['registration_data']->payment_receipt;

			$attachment_preview = '<i class="fa fa-file-o fa-3x"></i><p>No File </p>';
			
			if ( !empty($attachment_name) )
			{
				$attachment_ext = pathinfo($attachment_name, PATHINFO_EXTENSION);

				if ( in_array(strtolower($attachment_ext), array('jpeg', 'jpg', 'png')) )
				{
					$attachment_preview = '<i class="fa fa-file-image-o fa-3x"></i>';
				}
				else if ( strtolower($attachment_ext) == 'pdf' )
				{
					$attachment_preview = '<i class="fa fa-file-pdf-o fa-3x"></i>';
				}

				$attachment_preview .= '<p><a href="'.base_url().'upload_files/payment_receipts/'.$attachment_name.'" target="_blank">Download</a></p>';
			}

			$data['registration_data']->attachment_preview['payment_receipt'] = $attachment_preview;

			$view = $this->admin.'registration_form'; 
		}

		$this->data = $data;
		$this->middle = $view;
    	$this->layout_admin();
	}

	public function qualification_details()
	{
		$registration_id_enc = $this->input->post('ids_1');
	    $registration_id = encryptor('decrypt', $registration_id_enc);
		$member_id_enc = $this->input->post('ids_2');
	    $member_id = encryptor('decrypt', $member_id_enc);

		$filter_member_qualification = array('a.member_id' => $member_id);
		$qualification_data = $this->Member_qualifications->list_data($filter_member_qualification);

		$output = '';

    	if ( is_array($qualification_data) && count($qualification_data) > 0 )
    	{
    		foreach ( $qualification_data as $key => $val )
    		{
    			$id = $val->id;
    			$qualification_category = $val->qualification_category;
    			$qualification_title = $val->qualification_title;
    			$qualification_year = $val->qualification_year;
    			$qualification_institution = $val->qualification_institution;

		        $output .= '<tr>
					            <td>
					            	<input type="hidden" name="qualification_category_id[]" id="qualification_category_id_'.$id.'" class="form-control input-sm" value="'.$id.'" />
					            	<input type="text" name="qualification_category[]" id="qualification_category_'.$id.'" class="form-control input-sm" value="'.$qualification_category.'" readonly />
					            </td>
					            <td>
					            	<input type="text" name="qualification_title[]" id="qualification_title_'.$id.'" class="form-control input-sm turn_uppercase" value="'.$qualification_title.'" readonly />
					            </td>
					            <td>
					            	<input type="text" name="qualification_year[]" id="qualification_year_'.$id.'" class="form-control input-sm turn_uppercase qualification_year" value="'.$qualification_year.'" readonly />
					            </td>
					            <td>
					            	<input type="text" name="qualification_institution[]" id="qualification_institution_'.$id.'" class="form-control input-sm turn_uppercase" value="'.$qualification_institution.'" readonly />
					            </td>
					        </tr>';
    		}
    	}

    	echo $output;
	}

	public function organization_details()
	{
		$registration_id_enc = $this->input->post('ids_1');
	    $registration_id = encryptor('decrypt', $registration_id_enc);
		$member_id_enc = $this->input->post('ids_2');
	    $member_id = encryptor('decrypt', $member_id_enc);

		$filter_member_qualification = array(); //array('a.member_id' => $member_id);
		$organization_data = $this->Member_organizations->list_data($filter_member_qualification);

		$output = '';

    	if ( is_array($organization_data) && count($organization_data) > 0 )
    	{
    		foreach ( $organization_data as $key => $val )
    		{
    			$id = $val->id;
    			$organization_name = $val->organization_name;
    			$organization_post = $val->organization_post;

		        $output .= '<tr>
					            <td>
					            	<input type="text" name="organization_name[]" id="organization_name_'.$id.'" class="form-control input-sm" value="'.$organization_name.'" readonly />
					            </td>
					            <td>
					            	<input type="text" name="organization_post[]" id="organization_post_'.$id.'" class="form-control input-sm turn_uppercase" value="'.$organization_post.'" readonly />
					            </td>
					        </tr>';
    		}
    	}

    	echo $output;
	}
}
