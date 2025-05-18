<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{ 
    //set the class variable.
    var $template  = array();
    var $data      = array();
    //var $data_menu = array();

    public function __construct()
    {
        parent::__construct();
		
		define("DEFAULT_SENDER_EMAIL", "noreply@senheng.com.my");
		define("DEFAULT_SENDER_NAME", "noreply@senheng.com.my");
		define("STARFIELD", "<span class=\"text-danger\">*</span>");
		define("PREFIX_MOBILE_TELNO", "+60");
		$this->load->model('Status');
    }

	public function update_status($selected_status_id, $selected_status, $selected_id)
	{
		$this->load->model('Registrations');
		$status_app = $this->Status->field_array($selected_status_id);
				
		$status_id = $selected_status_id;
		$status = $selected_status;
		
		if ( count($status_app) > 0 )
		{
			$status_id = $status_app->id;
			$status = $status_app->status;
		}
		
		$data_update = array(  "registration_status" => $status_id,
        					   "updated" => getDateTime(),
        					 );
									
		$rst_update = $this->Registrations->update_data($selected_id, $data_update);
		
		return $rst_update;
	}
	
    //Load layout    
    public function layout() 
    {
		// if( empty($this->session->curr_login_id) || $this->session->curr_login_id == '' )
        // {
            // $text = '<div class="alert alert-info input-sm m-l-5 m-r-5">
                        // <button class="close" data-close="alert"></button>
                        // <span> Please login. </span>
                     // </div>';
            // $this->session->set_flashdata('login_result', $text);
            // redirect('login');
            // die();
        // }

        // making temlate and send data to view.
        // $this->template['index_header'] = $this->load->view('layout/index_header', $this->data, true);
        // $this->template['index_top_logo'] = $this->load->view('layout/index_top_logo', $this->data, true);
        // $this->template['index_top_menu'] = $this->load->view('layout/index_top_menu', $this->data, true);
        // $this->template['index_left_menu'] = $this->load->view('layout/index_left_menu', $this->data, true);
        // $this->template['middle'] = $this->load->view($this->middle, $this->data, true);
        // $this->load->view('layout/index', $this->template);
    }
	
	//Load layout    
    public function layout_admin() 
    {
		if( empty($this->session->curr_login_id) || $this->session->curr_login_id == '' )
        {
            $text = '<div class="alert alert-info input-sm m-l-5 m-r-5">
                        <button class="close" data-close="alert"></button>
                        <span> Your session expire. Please login again. </span>
                     </div>';
            $this->session->set_flashdata('login_result', $text);
            redirect('admin');
            die();
        }

        // making temlate and send data to view.
        $this->template['index_header'] = $this->load->view('admin/layout/index_header', $this->data, true);
        $this->template['index_top_menu'] = $this->load->view('admin/layout/index_top_menu', $this->data, true);
        $this->template['index_left_menu'] = $this->load->view('admin/layout/index_left_menu', $this->data, true);
        $this->template['middle'] = $this->load->view($this->middle, $this->data, true);
        $this->load->view('admin/layout/index', $this->template);
    }
}

?>