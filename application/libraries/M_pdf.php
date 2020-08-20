<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');
class m_pdf {
    
    function m_pdf()
    {
        $CI = & get_instance();
        log_message('Debug', 'mPDF class is loaded.');
    }
    function load($param=NULL)
    {
        include_once APPPATH.'/third_party/mpdf/mpdf.php';
         
        if ($params == NULL)
        {
            $param = '"utf-8","A4","","",15,15,45,15,6,3';   
			$this->param =$param;       		
        }
        return new mPDF($this->$param);
    }
}

//#other method
// include_once APPPATH.'/third_party/mpdf/mpdf.php';
 
// class M_pdf {
 
    // public $param;
    // public $pdf;
 
    // public function __construct($param = '"en-GB-x","A4","","",10,10,10,10,6,3')
    // {
        // $this->param =$param;
        // $this->pdf = new mPDF($this->param);
    // }
// }

/* End of file M_pdf.php */
/* Location: ./application/libraries/M_pdf.php */

?>