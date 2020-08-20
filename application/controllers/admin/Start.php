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
	}

	public function index()
	{
		$data = array();

		$this->data = $data;
		$this->middle = 'dashboard';
    	$this->layout();
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

		// $filter_country = array('involved' => 1);
		// $data['country_lists'] = $this->Countries->list_data_dd($filter_country);

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

		$array_session = array('curr_login_id', 'curr_user_id', 'curr_user_type_id', 'curr_user_name', 'curr_full_name', 'curr_logged_in', 'curr_country_id');
		$this->session->unset_userdata($array_session);
		redirect('login');
	}

	function check_user_country($process_at='')
	{
		$data = array();

		// after login auto check user countries
		$filter_user = array('a.user_id' => $this->session->curr_user_id);
		$user_countries = $this->User_countries->read_data_join($filter_user);

		$image_path = 'assets/media/custom/flags/';

		$country_total = count($user_countries);
		$country_lists = '';
		$country_default = 75; // default Malaysia
		$country_selected = '<span class="kt-header__topbar-icon kt-header__topbar-icon--brand">
											<img class="" src="'.base_url().$image_path.'no-flag.png" style="" alt="" />
										</span>';

		if ( is_array($user_countries) && $country_total > 0 )
		{
			// pre($this->session->curr_country_id);

			if ( strtolower($process_at) == 'during_login' )
			{
				foreach ( $user_countries as $key => $val )
				{
					$country_id = $val->country_id;
					$country_name = $val->name;
					$country_image = $val->image;

					$country_image = ( !empty($country_image) && file_exists($image_path.$country_image) ) ? $country_image : 'no-flag.png';
					$img_width = 'width:5%';
					$country_lists .= '<option data-content="<img src=\''.base_url().$image_path.$country_image.'\' style=\''.$img_width.'\'>&nbsp;&nbsp;'.$country_name.'" value="'.$country_id.'">'.$country_name.'</option>';
	    		}
			}
			else if ( strtolower($process_at) == 'after_login' )
			{
				$user_country_selected = $this->Users->read_data_join_country($this->session->curr_user_id);

				if ( is_object($user_country_selected) && !empty($user_country_selected) )
				{
					$country_id_selected = $user_country_selected->country_id;
					$country_name_selected = $user_country_selected->name;
					$country_image_selected = $user_country_selected->image;

					$country_image_selected = ( !empty($country_image_selected) && file_exists($image_path.$country_image_selected) ) ? $country_image_selected : 'no-flag.png';

					$country_selected = '<span class="kt-header__topbar-icon kt-header__topbar-icon--brand">
											<img class="" src="'.base_url().$image_path.$country_image_selected.'" style="" alt="" />
										</span>';
				}

				if ( $country_total > 1 )
				{
					$country_lists .= '<ul class="kt-nav kt-margin-t-10 kt-margin-b-10">';

					foreach ( $user_countries as $key => $val )
					{
						$country_id = $val->country_id;
						$country_name = $val->name;
						$country_image = $val->image;

						$country_image = ( !empty($country_image) && file_exists($image_path.$country_image) ) ? $country_image : 'no-flag.png';

						$selected = ($user_country_selected->country_id == $country_id) ? 'kt-nav__item--active' : '';

						// if same, not assign means the country already selected and cannot be updated, will update for those not yet selected
						$ids = ($user_country_selected->country_id == $country_id) ? '' : $country_id; 

			            $country_lists .= 	'<li class="kt-nav__item '.$selected.'">
						                        <a href="javascript:void(0)" class="kt-nav__link select_user_country" ids="'.$ids.'">
						                            <span class="kt-nav__link-icon"><img src="'.base_url().$image_path.$country_image.'" style="" alt="" /></span>
						                            <span class="kt-nav__link-text">'.$country_name.'</span>
						                        </a>
						                    </li>';
		    		}

		    		$country_lists .= '</ul>';
		    	}
			}
			else
			{
				$country_lists = '';
			}

    		$country_default = $user_countries[0]->country_id;
		}
		else
		{
			$country_lists = '';
		}

		$data['country_total'] 		= $country_total;
		$data['country_lists'] 		= $country_lists;
		$data['country_default'] 	= $country_default;
		$data['country_selected'] 	= $country_selected;

		return $data;
	}
	
	function login_submit()
	{
		$login_type = 1; // 1: Web Portal, 2: Google Account
		$user_name = trim($this->input->post('user_name'));
		$user_password = trim($this->input->post('user_password'));
		$country_id = ''; //$this->input->post('country_id');
		$remember = $this->input->post('remember');
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
							    // 'curr_country_id'		 => $login_result->country_id,
							    'curr_logged_in' 		 => TRUE
							);
				
				if ( empty($login_result->first_login) || $login_result->first_login == NULL ) 
				{
					$data_update_login = array(
												'login_now'		=> 1,
												'first_login'	=> getDateTime(),
												'last_login'	=> getDateTime(),
												'remember'		=> $remember,
												'updated' 		=> getDateTime(),
												);
					
				} 
				else 
				{
					$data_update_login = array(
												'login_now'		=> 1,
												'last_login'	=> getDateTime(),
												'remember'		=> $remember,
												'updated'		=> getDateTime(),
												);
				}
				
				$rst_update_login = $this->Logins->update_data($login_result->id, $data_update_login);
				
				$this->session->set_userdata($data);
				
				if ( in_array($login_result->user_type_id, $this->uac) )
				{
					$user_countries = $this->check_user_country();

					if ( $user_countries['country_total'] > 1 )
					{
						// when user have multiple country, after login redirect user to select one of the country
						redirect('select-user-country');
					}
					else
					{
						// when user have no or only one country, redirect to dashboard
						$data_update_user = array('country_id' => $user_countries['country_default']);
						$rst_update_user = $this->Users->update_data($login_result->user_id, $data_update_user);
						$this->session->set_userdata( array('curr_country_id' => $user_countries['country_default']) );

						$notis_type = 'success';
						$notis_title = 'Login Successful';
						$notis_msg = 'Welcome '.$login_result->full_name;

						sweet_alert($notis_type, $notis_title, $notis_msg);
						redirect('dashboard');	
					}
				}
				else
				{
					$text = '<div class="alert alert-solid-danger alert-bold fade show" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning"></i></div>
                            <div class="alert-text">Login Fail! Please try again.</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                </button>
                            </div>
                        </div>';
					$this->session->set_flashdata('login_result', $text);
					redirect('login');
				}
			}
			else
			{
		        $text = '<div class="alert alert-solid-warning alert-bold fade show" role="alert">
                            <div class="alert-icon"><i class="flaticon-warning"></i></div>
                            <div class="alert-text">Invalid Username or Password!</div>
                            <div class="alert-close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="la la-close"></i></span>
                                </button>
                            </div>
                        </div>';
				$this->session->set_flashdata('login_result', $text);
				redirect('login');
			}
		}
		else 
		{
			$text = '<div class="alert alert-solid-warning alert-bold fade show" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning"></i></div>
                        <div class="alert-text">Enter Username and Password!</div>
                        <div class="alert-close">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="la la-close"></i></span>
                            </button>
                        </div>
                    </div>';
			$this->session->set_flashdata('login_result', $text);
			redirect('login');
		}
	}

	function forgot_password()
	{
		$array_session = array('curr_login_id', 'curr_user_id', 'curr_user_type_id', 'curr_user_name', 'curr_full_name', 'curr_logged_in', 'curr_country_id');
		$this->session->unset_userdata($array_session);

		$this->load->view('forgot_password');
	}
}
