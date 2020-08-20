<?php
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class pdf_generator extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }
	
	//Page header
	public function Header() 
	{
		//# Logo
		$image_file = base_url()."img/senheng_logo_200x200.jpg";
		$this->Image($image_file, 10, 10, 20, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		//# Set font
		$this->SetFont('helvetica', 'B', 16);
		//# Title
		$this->Cell(70, 15, 'Aeon Easy Payment', 0, false, 'C', 0, '', 0, false, 'M', 'M');
		
		//# Header By using HTML << https://sourceforge.net/p/tcpdf/discussion/435311/thread/505a9e13/ >>
		// $headerData = $this->getHeaderData();
        // $this->SetFont('helvetica', 'B', 10);
        // $this->writeHTML(10, 4, $headerData['string'], 1);
	}

	// Page footer
	public function Footer() 
	{
		//# Position at 15 mm from bottom
		$this->SetY(-15);
		//# Set font
		$this->SetFont('helvetica', 'I', 8);
		//# Page number
		$this->Cell(0, 10, 'Copyright© 2016 Senheng® Electric (KL) Sdn. Bhd. (296691-X) All rights reserved.', 0, false, 'L', 0, '', 0, false, 'T', 'M');
		//# Page number
		$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
	}
}

/* End of file pdf_generator.php */
/* Location: ./application/libraries/pdf_generator.php */

?>