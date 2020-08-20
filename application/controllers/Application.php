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
		$curr_sess_cust_id = $this->session->sess_cust_id;
		$default_value_other = -1; // used for other race, other institution, other course

		// pre($_POST);
		// pre($_FILES);

		$applicant_name 			= $this->input->post('applicant_name');
		$applicant_dob_temp 		= $this->input->post('applicant_dob');

		if ( $applicant_dob_temp == '' || $applicant_dob_temp == '00/00/0000' ) 
		{
			$applicant_dob = '';
		} 
		else 
		{
			$applicant_dob 			= str_replace("/", "-", $applicant_dob_temp);
			$applicant_dob 			= date('Y-m-d', strtotime($applicant_dob));
		}

		$applicant_icno_temp 		= $this->input->post('applicant_icno');
		$applicant_icno 			= str_replace("_", "", $applicant_icno_temp);

		$applicant_phoneno_temp		= $this->input->post('applicant_phoneno');
		$applicant_phoneno 			= str_replace("_", "", $applicant_phoneno_temp);

		$applicant_email 			= $this->input->post('applicant_email');
		$applicant_permanent_address= $this->input->post('applicant_permanent_address');

		// =============================================================
		// start get race

		$race_id 					= $this->input->post('race_id');
		$race_other 				= $this->input->post('race_other');
		$applicant_race 			= ( !empty($race_other) ? $race_other : "" );

		if ( $race_id > 0 )
		{
			//get value from array by key
			$race_type_arrlist 		= $this->Institutions->data_race_type;
			$applicant_race 		= $race_type_arrlist[$race_id];
		}

		// end get race
		// =============================================================



		// =============================================================
		// start get qualification

		$qualification_id 			= $this->input->post('qualification_id');
		$qualification 				= "";

		if ( $qualification_id > 0 )
		{
			//get value from array by key
			$qualification_arrlist 	= $this->Institutions->data_qualification;
			$qualification = $qualification_arrlist[$qualification_id];
		}

		$previous_result 			= $this->input->post('previous_result');
		$previous_institution 		= $this->input->post('previous_institution');
		$household_income 			= $this->input->post('household_income');

		// end get qualification
		// =============================================================
		


		// =============================================================
		// start get institution

		$institution_id_arr 		= $this->input->post('institution_id');
		$institution_other 			= $this->input->post('institution_other');

		$ins_id_arr = array();
		$ins_name_arr = array();

		if ( count($institution_id_arr) > 0 && is_array($institution_id_arr) )
		{
			$institution_list_arr = $this->Institutions->listing_filter_1($institution_id_arr);

			foreach ( $institution_list_arr as $institution_list )
			{
				$ins_id_arr[] = $institution_list->institution_id;
				$ins_name_arr[] = $institution_list->institution_name;
			}

			//insert value for other institution in other array
			if ( in_array($default_value_other ,$institution_id_arr) )
			{
				array_push($ins_id_arr, $default_value_other);
				array_push($ins_name_arr, $institution_other);
			}
		}

		$institution_id 			= implode("|", $ins_id_arr);
		$institution_name 			= implode("|", $ins_name_arr);

		// end get institution
		// =============================================================



		// =============================================================
		// start get course

		$course_id_arr 				= $this->input->post('course_id');
		$course_other 				= $this->input->post('course_other');

		$crs_id_arr = array();
		$crs_name_arr = array();

		if ( count($course_id_arr) > 0 && is_array($course_id_arr) )
		{
			$course_list_arr = $this->Courses->listing_filter_1($course_id_arr);

			foreach ( $course_list_arr as $course_list )
			{
				$crs_id_arr[] = $course_list->course_id;
				$crs_name_arr[] = $course_list->course_name;
			}

			//insert value for other course in other array
			if ( in_array($default_value_other ,$course_id_arr) )
			{
				array_push($crs_id_arr, $default_value_other);
				array_push($crs_name_arr, $course_other);
			}
		}

		$course_id 					= implode("|", $crs_id_arr);
		$course_name 				= implode("|", $crs_name_arr);

		// end get course
		// =============================================================



		// =============================================================
		// start get course

		$study_level_id 			= $this->input->post('study_level_id');
		$study_level 				= "";

		if ( $study_level_id > 0 )
		{
			//get value from array by key
			$study_level_arrlist 	= $this->Institutions->data_study_level;
			$study_level = $study_level_arrlist[$study_level_id];
		}

		// end get course
		// =============================================================

		$course_duration 			= $this->input->post('course_duration');
		$study_start_date_temp		= $this->input->post('study_start_date');

		if ( $study_start_date_temp == '' || $study_start_date_temp == '00/00/0000' ) 
		{
			$study_start_date = '';
		} 
		else 
		{
			$study_start_date 		= str_replace("/", "-", $study_start_date_temp);
			$study_start_date 		= date('Y-m-d', strtotime($study_start_date));
		}

		$application_agreement 		= $this->input->post('application_agreement');

		// -------------------------------------------------------------
		// start form validation

		// checking empty compulsory field
		$error_msg = "";

		if ( empty($applicant_name) )
		{
			$error_msg .= "<li>Full Name</li>";
		}

		if ( empty($applicant_dob) )
		{
			$error_msg .= "<li>Date of Birth</li>";
		}

		if ( empty($applicant_icno) )
		{
			$error_msg .= "<li>IC Number</li>";
		}
		else
		{
			if ( strlen($applicant_icno) < 14 || strlen($applicant_icno) > 14 )
			{
				$error_msg .= "<li>Invalid IC Number format</li>";
			}
		}

		if ( empty($applicant_phoneno) )
		{
			$error_msg .= "<li>Phone Number</li>";
		}
		else
		{
			if ( strlen($applicant_phoneno) < 12 || strlen($applicant_icno) > 14 )
			{
				$error_msg .= "<li>Invalid Phone Number format</li>";
			}
		}

		if ( empty($applicant_email) )
		{
			$error_msg .= "<li>Email Address</li>";
		}
		else
		{
			if ( !filter_var($applicant_email, FILTER_VALIDATE_EMAIL) ) 
			{
			  	$error_msg .= "<li>Invalid Email Address format</li>"; 
			}
		}

		if ( empty($applicant_permanent_address) )
		{
			$error_msg .= "<li>Permanent Address</li>";
		}

		if ( empty($race_id) )
		{
			$error_msg .= "<li>Race</li>";
		}
		else
		{
			if ( $race_id == $default_value_other && empty($race_other) )
			{
				$error_msg .= "<li>Other Race</li>";
			}
		}

		if ( empty($qualification_id) )
		{
			$error_msg .= "<li>Previous Qualifications</li>";
		}
		else
		{
			if ( $qualification_id == 1 )
			{
				if ( empty($previous_result) )
				{
					$error_msg .= "<li>SPM result</li>";
				}
				if ( empty($previous_institution) )
				{
					$error_msg .= "<li>Secondary School Attend</li>";
				}
			}
			else 
			{
				if ( empty($previous_result) || $previous_result == 0 )
				{
					$error_msg .= "<li>CGPA result</li>";
				}
				if ( empty($previous_institution) )
				{
					$error_msg .= "<li>College or University Attend</li>";
				}
			}
		}

		if ( empty($household_income) || $household_income == 0 )
		{
			$error_msg .= "<li>Household Combined Income</li>";
		}

		if ( count($institution_id_arr) == 0 )
		{
			$error_msg .= "<li>Interest Education Institution</li>";
		}
		else
		{
			if ( in_array($default_value_other ,$institution_id_arr) )
			{
				if ( empty($institution_other) )
				{
					$error_msg .= "<li>Other Interest Education Institution</li>";
				}
			}
		}

		if ( count($course_id_arr) == 0 )
		{
			$error_msg .= "<li>Interest Course of Study</li>";
		}
		else
		{
			if ( in_array($default_value_other ,$course_id_arr) )
			{
				if ( empty($course_other) )
				{
					$error_msg .= "<li>Other Interest Course of Study</li>";
				}
			}
		}

		if ( empty($study_level_id) )
		{
			$error_msg .= "<li>Intended Level of Study</li>";
		}

		if ( empty($course_duration) || $course_duration == 0 )
		{
			$error_msg .= "<li>Duration of Course</li>";
		}

		if ( empty($study_start_date) )
		{
			$error_msg .= "<li>Intended Start Date</li>";
		}

		if( empty($application_agreement) )
		{
			$error_msg .= "<li>Terms & Conditions Agreement</li>";
		}

		// end form validation
		// -------------------------------------------------------------



		// =============================================================
		// start preference for attachment file upload

		// source 1: https://www.roytuts.com/upload-and-resize-image-using-codeigniter/
		// source 2: http://mfikri.com/artikel/Upload-dan-resize-image-menggunakan-codeigniter.html
		// source 3: https://stackoverflow.com/questions/20113832/multiple-files-upload-in-codeigniter

		//set upload preferences
        //file upload destination
        $upload_path = './upload_files/applicant_files/';
        $config['upload_path'] = $upload_path;

        //allowed file types. * means all types
        $config['allowed_types'] = 'jpg|png|gif|pdf';
        $allowed_types = array('jpg', 'png', 'gif', 'pdf');

        //allowed max file size. 0 means unlimited file size
        $config['max_size'] = '0';
        //#1MB = 1048576 Bytes
		//#0.5MB = 524288 Bytes, 512KB
		$allowed_size_min = 0; //1048576; //1MB
		$allowed_size_max = 2097152; //2MB

        //max file name size
        // $config['max_filename'] = '255';

        //whether file name should be encrypted or not
        $config['encrypt_name'] = TRUE;

		$require_attachment_arrlist = array(
												'attachment_qualification' 	 => 'Attachment - Previous Qualification Result Certificates', 
												'attachment_ic' 			 => 'Attachment - Malaysia IC (Front and Back)', 
												'attachment_household_income'=> 'Attachment - Household Proof of Income'
												);

        //store file info once uploaded
        $files_data = array();
		$msg_upload = "";

        $attachment_files_arr = $_FILES;

        foreach ( $attachment_files_arr as $attachment_keys => $attachment_files )
        {
        	$attachment_field_name = $attachment_keys; //attachment files input field name

	        //get file details of the files
	        $attachment_qualification_name = $attachment_files_arr[$attachment_field_name]['name'];
	        $attachment_qualification_size = $attachment_files_arr[$attachment_field_name]['size'];

	        if ( isset($require_attachment_arrlist[$attachment_field_name]) )
	        {
	        	if (  empty($attachment_qualification_name) || $attachment_qualification_size == 0 )
	        	{
	        		$error_msg .= '<li>'.$require_attachment_arrlist[$attachment_field_name].'</li>';
	        	}
	        }

	        if ( !empty($attachment_qualification_name) && $attachment_qualification_size > 0 )
	        {
				$file_ext = pathinfo($attachment_qualification_name, PATHINFO_EXTENSION);
			
				if ( !in_array($file_ext,$allowed_types) ) 
				{
				    $error_msg .= '<li>Invalid Attachment file type for '.$attachment_qualification_name.' [allowed types: '.implode(", ", $allowed_types).']</li>';
				}
				if ( $attachment_qualification_size > $allowed_size_max ) 
				{
					$error_msg .= '<li>Invalid Attachment file size for '.$attachment_qualification_name.' [allowed size: < 2MB]</li>';
				}
			}

			$attachment_qualification_name = "";
			$attachment_qualification_size = "";
        } 

		// end preference for attachment file upload
		// =============================================================


		// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
		// start session all insert feild
		
		//clear previous session to set new session
		$array_data_validation = array('data_application', 'data_errormsg');
		$this->session->unset_userdata($array_data_validation);
			
		$data_validation['data_application'] = array(
												'sess_applicant_name'				=> $applicant_name,
												'sess_applicant_dob' 				=> $applicant_dob_temp,
												'sess_applicant_icno' 				=> $applicant_icno,
												'sess_applicant_phoneno' 			=> $applicant_phoneno,
												'sess_applicant_email' 				=> $applicant_email,
												'sess_applicant_permanent_address'	=> $applicant_permanent_address,
												'sess_race_id' 						=> $race_id,
												'sess_applicant_race' 				=> $applicant_race,
												'sess_institution_id' 				=> $institution_id,
												'sess_institution' 					=> $institution_name,
												'sess_course_id' 					=> $course_id,
												'sess_course' 						=> $course_name,
												'sess_course_duration' 				=> $course_duration,
												'sess_study_level_id' 				=> $study_level_id,
												'sess_study_level' 					=> $study_level,
												'sess_study_start_date' 			=> $study_start_date_temp,
												'sess_qualification_id' 			=> $qualification_id,
												'sess_qualification' 				=> $qualification,
												'sess_previous_result' 				=> $previous_result,
												'sess_previous_institution' 		=> $previous_institution,
												'sess_household_income' 			=> $household_income,
												'sess_application_agreement' 		=> $application_agreement,
												);

		foreach ( $attachment_files_arr as $attachment_keys => $attachment_files )
        {
        	$attachment_field_name = $attachment_keys; //attachment files input field name

        	$data_validation['data_application']['sess_'.$attachment_field_name] = $attachment_files_arr[$attachment_field_name]['name'];

        }
				
		//set new session
		$this->session->set_userdata($data_validation);

		// end session all insert feild
		// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


		if ( empty($error_msg) )
		{
			$error = 0;
			$success = 0;
			$last_customer_id = 0;
			$last_booking_id = 0;
			
			if ( $error == 0 )
			{
				// set data application to insert in db
				$data_application = array(
										'applicant_name'				=> $applicant_name,
										'applicant_dob' 				=> $applicant_dob,
										'applicant_icno' 				=> $applicant_icno,
										'applicant_phoneno' 			=> $applicant_phoneno,
										'applicant_email' 				=> $applicant_email,
										'applicant_permanent_address'	=> $applicant_permanent_address,
										'race_id' 						=> $race_id,
										'applicant_race' 				=> $applicant_race,
										'institution_id' 				=> $institution_id,
										'institution' 					=> $institution_name,
										'course_id' 					=> $course_id,
										'course' 						=> $course_name,
										'course_duration' 				=> $course_duration,
										'study_level_id' 				=> $study_level_id,
										'study_level' 					=> $study_level,
										'study_start_date' 				=> $study_start_date,
										'qualification_id' 				=> $qualification_id,
										'qualification' 				=> $qualification,
										'previous_result' 				=> $previous_result,
										'previous_institution' 			=> $previous_institution,
										'household_income' 				=> $household_income,
										'application_agreement' 		=> $application_agreement,
										'status_id' 					=> 1,
										'status' 						=> 'Pending',
										 );
				
				$data_application['created'] = getDateTime();
				$data_application['updated'] = getDateTime();
				$data_application['active']  = 1;

				$application_id = 0;
				
				if ( isset($data_application) && count($data_application) > 0 )
				{
					// pre($data_application);				
					$application_id = $this->Applications->insert_new($data_application);
					$success++;
				}

				if ( $application_id > 0 )
				{
					$application_id_pre = str_pad($application_id, 6, '0', STR_PAD_LEFT);

					// =============================================================
					// start attachment file upload

					$dir_application = create_folder($upload_path.$application_id_pre);

					$data_application_attachment = array();
					
					// directory by application_id prefix exist then proceed to upload the attachement file
					if ( $dir_application == 0 )
					{
        				$upload_path_new 		= $upload_path.$application_id_pre."/";
        				$config['upload_path'] 	= $upload_path_new;

        				$count_attachment_files = 1;

				        foreach ( $attachment_files_arr as $attachment_keys => $attachment_files )
				        {
				        	$attachment_field_name = $attachment_keys; //attachment files input field name

					        //get file details of the files
					        $attachment_qualification_name = $attachment_files_arr[$attachment_field_name]['name'];
					        $attachment_qualification_size = $attachment_files_arr[$attachment_field_name]['size'];

					        if ( !empty($attachment_qualification_name) && $attachment_qualification_size > 0 )
					        {
					        	//load the preferences
					            $this->load->library('upload', $config);

					            //check file successfully uploaded. name of the input field
					            if ($this->upload->do_upload($attachment_field_name)) 
					            {
					                //store or display the file info
					                $files_data = $this->upload->data();
					                $files_name_new = $application_id_pre."_".$attachment_field_name."_".$files_data['orig_name'];

					                if ( file_exists($upload_path_new.$files_data['file_name']) )
					                {
						                // rename to new filename
						                rename($upload_path_new.$files_data['file_name'], $upload_path_new.$files_name_new);
					                }

					                // pre($files_data);
					            } 
					            else 
					            {
					            	//if file upload failed then catch the errors
					                $msg_upload .= '<br />'.$this->upload->display_errors();
					                $is_file_error = TRUE;
					            }

								if ( file_exists($upload_path_new.$files_name_new) )
				                {
				                	// set data attachment to insert multiple in db
				                	$data_application_attachment[] = array(
																		'attachment_type_id'	=> $count_attachment_files,
																		'attachment_type' 		=> $attachment_field_name,
																		'attachment_filename' 	=> $files_name_new,
																		'application_id'		=> $application_id,
																		'created'				=> getDateTime(),
																		'updated'				=> getDateTime(),
																		'active'				=> 1
																		);
				                }
							}

							$attachment_qualification_name = "";
							$attachment_qualification_size = "";

				        	$count_attachment_files++;
				        }	
			   		}

			   		$attachment_id = 0;

			   		if ( isset($data_application_attachment) && count($data_application_attachment) > 0 )
			   		{
			   			// pre($data_application_attachment);
						$attachment_id = $this->Attachments->insert_new_multiple($data_application_attachment);	
						$success++;
			   		}

					// end attachment file upload
			        // =============================================================

				}

				//clear session once success
				$array_data_validation = array('data_application', 'data_errormsg');
				$this->session->unset_userdata($array_data_validation);

		        if ( $success > 0 )
		        {
					$goto_page = 1;
		        }
		        else
		        {
					$goto_page = 2;
		        }

				$application_id_enc = encryptor('encrypt',$application_id);

				redirect('application-complete?p='.$goto_page.'&appid='.$application_id_enc);
			}
			// end check error
		}
		else
		{
			$notis_type = 'error';
			$notis_title = 'Please Enter These Compulsory Field!';
			$notis_msg = "<ol style='font-size:12px; font-weight: bold; color: #f96a74; text-align: left;'>".$error_msg."</ol>";
			$notis_img = '';
			$notis_img_size = '';
			// sweet_alert($notis_type, $notis_title, $notis_msg, $notis_img, $notis_img_size); //custom sweet alert
			sweet_alert($notis_type, 'Application Submission Fail', '', '', '');

			// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
			// start session all error message

			$data_validation['data_errormsg'] = array(
														'notis_title' => $notis_title,
														'notis_msg' => $notis_msg
														);
					
			//set new session
			$this->session->set_userdata($data_validation);

			// end session all error message
			// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


			redirect('application-form');
		}		

	}
	
	function application_complete()
	{
		$goto_page = $this->input->get('p'); //p = 1 : success; p = 2 : fail
		$application_id_enc = $this->input->get('appid');
		$application_id = encryptor('decrypt',$application_id_enc);
		
		
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
