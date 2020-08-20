<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends MY_Controller {
	
	public $alert_danger = '<div class="alert alert-danger light"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	public $alert_warning = '<div class="alert alert-warning light"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
	public $alert_success = '<div class="alert alert-success light"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Status');
		$this->load->model('States');
		$this->load->model('Qualification_categories');
		$this->load->model('Registrations');
		$this->load->model('Members');
		$this->load->model('Member_qualifications');
		$this->load->model('Member_organizations');
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
		$payment_status = null;
		$registration_status = null;

		$name = $this->input->post('name');
		$icno = $this->input->post('icno');
		$icno = str_replace('_', '', $icno);
		$contactno_mobile = $this->input->post('contactno_mobile');
		$contactno_mobile = str_replace('_', '', $contactno_mobile);
		$email = $this->input->post('email');
		$dob = $this->input->post('dob');
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
		$member_status = null;

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
				$set_member_status = ( $submit_form == 1 ) ? 1 : null; 
				$set_registration_status = ( $submit_form == 1 ) ? 1 : null; 

				// update registration
				$data_update_registration = array(
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
					// update registration
					$data_update_member = array(
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

	function registration_complete($id)
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
}
