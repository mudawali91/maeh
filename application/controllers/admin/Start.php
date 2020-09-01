<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Start extends My_Controller 
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
			$view = $this->admin.'dashboard'; 
		}

		$this->data = $data;
		$this->middle = $view;
    	$this->layout_admin();
	}

	public function convert_encryptor()
    {
    	// run url = maeh/Start/convert_encryptor?ids=1&p=dec
        $ids = $this->input->get('ids');
        $process = $this->input->get('p');
        $rst = 'Error';

        if ( $process == 'enc' )
        {
        	$rst = encryptor('encrypt',$ids);
        }
        else if ( $process == 'dec' )
        {
        	$rst = encryptor('decrypt',$ids);
        }

        echo 'Result: '.$rst;
    }

	function login()
	{	
		$data = array();

		$curr_login_id = $this->session->curr_login_id; 
		$curr_user_id = $this->session->curr_user_id; 

		$data_update_logout = array(
									'login_now'	=> 0,
									'updated'	=> getDateTime(),
									);

		$data_update_logout = $this->Logins->update_data($curr_login_id, $data_update_logout);

		$array_session = array('curr_login_id', 'curr_user_id', 'curr_user_type_id', 'curr_user_name', 'curr_full_name', 'curr_logged_in');
		$this->session->unset_userdata($array_session);
		$this->load->view(admin_path.'login', $data);
	}
	
	function logout()
	{
		$curr_login_id = $this->session->curr_login_id; 
		$curr_user_id = $this->session->curr_user_id; 

		$data_update_logout = array(
									'login_now'	=> 0,
									'updated'	=> getDateTime(),
									);

		$data_update_logout = $this->Logins->update_data($curr_login_id, $data_update_logout);

		$array_session = array('curr_login_id', 'curr_user_id', 'curr_user_type_id', 'curr_user_name', 'curr_full_name', 'curr_logged_in');
		$this->session->unset_userdata($array_session);
		redirect('admin');
	}

	function login_submit()
	{
		$login_type = 1; // 1: Web Portal, 2: Google Account
		$user_name = trim($this->input->post('user_name'));
		$user_password = trim($this->input->post('user_password'));
		$remember = ''; //$this->input->post('remember');
		$remember = !empty($remember) ? 1 : 0; 

		$this->session->set_flashdata('login_user', $user_name);

		if ( !empty($user_name) && !empty($user_password) )
		{
			$login_result = $this->Logins->login($login_type, $user_name, $user_password);
			
			if ( is_object($login_result) && !empty($login_result) )
			{
				$data = array(
							    'curr_login_id'  		 => $login_result->id,
							    'curr_user_id'  		 => $login_result->user_id,
							    'curr_user_type_id' 	 => $login_result->user_type_id,
							    'curr_user_name'		 => $login_result->user_name,
							    'curr_full_name'		 => $login_result->full_name,
							    'curr_logged_in' 		 => TRUE
							);
				
				$data_update_login = array(
											'login_now'		=> 1,
											'last_login'	=> getDateTime(),
											'remember'		=> $remember,
											'updated'		=> getDateTime(),
											);

				if ( empty($login_result->first_login) || $login_result->first_login == NULL ) 
				{
					$data_update_login['first_login'] = getDateTime();
				}
				
				$rst_update_login = $this->Logins->update_data($login_result->id, $data_update_login);
				
				$this->session->set_userdata($data);
				
				if ( in_array($login_result->user_type_id, $this->uac) )
				{
					$notis_type = 'success';
					$notis_title = 'Login Successful';
					$notis_msg = 'Welcome '.$login_result->full_name;

					sweet_alert($notis_type, $notis_title, $notis_msg);
					redirect('admin/dashboard');	
				}
				else
				{
                    $text = '<div class="alert alert-danger input-sm m-l-5 m-r-5">
		                    	<button class="close" data-close="alert"></button>
		                   		 <span><i class="fa fa-exclamation-triangle"></i> <strong>Login Fail! Please try again.</strong> </span>
		                	</div>';
					$this->session->set_flashdata('login_result', $text);
					redirect('admin');
				}
			}
			else
			{
		        $text = '<div class="alert alert-danger input-sm m-l-5 m-r-5">
		                	<button class="close" data-close="alert"></button>
		                    <span><i class="fa fa-exclamation-triangle"></i> <strong>Invalid Username or Password.</strong> </span>
		                </div>';
				$this->session->set_flashdata('login_result', $text);
				redirect('admin');
			}
		}
		else 
		{
            $text = '<div class="alert alert-danger input-sm m-l-5 m-r-5">
	                	<button class="close" data-close="alert"></button>
	                    <span><i class="fa fa-exclamation-triangle"></i> <strong>Enter Username and Password!</strong> </span>
	                </div>';        
			$this->session->set_flashdata('login_result', $text);
			redirect('admin');
		}
	}

	function forgot_password()
	{
		$array_session = array('curr_login_id', 'curr_user_id', 'curr_user_type_id', 'curr_user_name', 'curr_full_name', 'curr_logged_in', 'curr_country_id');
		$this->session->unset_userdata($array_session);

		$this->load->view('forgot_password');
	}
}
