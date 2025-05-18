<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';
class InvoicePDF extends TCPDF
{
    function __construct()
    {
        parent::__construct();
    }

    public function Header() {
        // for header
        

        // if($this->pageNo() == 1){ // for first page only

            $this->SetFont ('times', 'B', 26 , '', 'default', true );
            $this->MultiCell(100, 5, $this->CustomHeaderText['pdf_title'], 0, 'L', 0, 0, '', 10, true);

            $this->SetFont ('helvetica', '', 8 , '', 'default', true );
            $image_file = 'https://placehold.co/600x400.png';
            $this->Image('@'.file_get_contents($image_file), 147, 12, 35, '', 'PNG', '', 'R', false, 300, '', false, false, 0, false, false, false);
            $this->MultiCell(46, 5, ''.$this->CustomHeaderText['letterhead'].'', 0, 'L', 0, 0, 148, 20, true); 
            $this->MultiCell(46, 5, '(PAN : '.$this->CustomHeaderText['letterhead_iso_no'].' )', 0, 'L', 0, 0, 148, 41, true);
            $this->MultiCell(46, 5, '', 0, 'L', 0, 0, 148, 43, true);
            // $this->MultiCell(100, 5, 'Reference No :  '.$purchase_order->reference_no, 0, 'L', 0, 0, '', 41, true);
            // $this->MultiCell(100, 5, 'Date                :  '.display_datetime('DATE2', $purchase_order->created_at), 0, 'L', 0, 0, '', 45, true);
            $our_ref_no = '';
                    if($this->pageNo() == 1){ 
                        $our_ref_no = '<tr>
                        <th align="left" style="width: 20%">Our Ref/PO No</th>
                        <th align="left" style="width: 55%">'.$this->CustomHeaderText['so_no'].'</th>
                        
                    </tr>';
                    }// for first page only
            $table = '
            <br /><br /><br />
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <th align="left" style="width: 20%">Invoice No :</th>
                                <th align="left" style="width: 35%">'.$this->CustomHeaderText['inv_no'].'</th>
                                <th align="left" style="width: 5%">Date :</th>
                                <th align="left" style="width: 23%">'.$this->CustomHeaderText['created_date'].'</th>
                            </tr>
                            <tr>
                                <th align="left" style="width: 20%">Our Ref No :</th>
                                <th align="left" style="width: 35%">'.$this->CustomHeaderText['our_ref_no'].'</th>
                                <th align="left" style="width: 5%">Page :</th>
                                <th align="left" style="width: 23%">'.$this->getAliasNumPage().' of '.$this->getAliasNbPages().'</th>
                            </tr>
                            
                            '.$our_ref_no.'
                        </table>
    
            ';
    
    
            $this->writeHTML($table, true, false, false, false, '');
            // Logo
            if($this->CustomHeaderText['status'] == 4){
                $cancel_img_file = 'https://placehold.co/600x400.png';
                $this->Image('@'.file_get_contents($cancel_img_file), 22, 100, 170, 100, '', '', '', false, 300, '', false, false, 0);
    
            }
            // $this->MultiCell(46, 50, '(GSTIN :  '.$project->letterhead_tax_no.')', 0, 'L', 0, 0, 140, 45, true); 

            $this->SetFont ('helvetica', '', 8 , '', 'default', true );

            $string =   '';
            $this->SetTopMargin($this->GetY() + 5);
            $this->writeHTML($string, true, false, false, false, '');


        // }
        // else{
        //     $this->SetFont ('times', 'B', 26 , '', 'default', true );
        //     $this->MultiCell(100, 5, $this->CustomHeaderText['pdf_title'], 0, 'L', 0, 0, '', 10, true);

        //     $this->SetFont ('helvetica', '', 8 , '', 'default', true );
        //     $image_file = 'https://placehold.co/600x400.png';
        //     $this->Image('@'.file_get_contents($image_file), 147, 12, 35, '', 'PNG', '', 'R', false, 300, '', false, false, 0, false, false, false);
        //     $this->MultiCell(46, 5, '', 0, 'L', 0, 0, 148, 20, true); 
        //     $this->MultiCell(46, 5, '', 0, 'L', 0, 0, 148, 25, true);
        //     // $this->MultiCell(100, 5, 'Reference No :  '.$purchase_order->reference_no, 0, 'L', 0, 0, '', 41, true);
        //     // $this->MultiCell(100, 5, 'Date                :  '.display_datetime('DATE2', $purchase_order->created_at), 0, 'L', 0, 0, '', 45, true);
            
        //     if($this->CustomHeaderText['status'] == 4){
        //         $cancel_img_file = base_url().'assets/media/custom/cancelled.png';
        //         $this->Image('@'.file_get_contents($cancel_img_file), 22, 100, 170, 100, '', '', '', false, 300, '', false, false, 0);
    
        //     }
        //     // $this->MultiCell(46, 50, '(GSTIN :  '.$project->letterhead_tax_no.')', 0, 'L', 0, 0, 140, 45, true); 

        //     $this->SetFont ('helvetica', '', 8 , '', 'default', true );

        //     $string =   '';

        //     $this->writeHTML($string, true, false, false, false, '');


        // }
    }


    public function opener($inv_det){

        
        $payment_due_date = $inv_det->due_date;
        $payment_due_date_format = date('d-m-Y',strtotime($payment_due_date));
        $etd = display_datetime('DATE2', $inv_det->etd);

        $customer_name = '';
        $customer_address = '';
        $customer_address2 = '';
        $customer_address3 = '';
        $customer_state_or_code = '';
        $customer_gst = '';

        // if($cn_dn_det->company == 'customer')
        // {
            
        // }
        // else if($cn_dn_det->company == 'supplier')
        // {

        // }
        // else
        // {

        // }

        $customer_name = $inv_det->customer_name;
        $customer_address = $inv_det->customer_address1;
        $customer_address2 = $inv_det->customer_address2;
        $customer_address3 = $inv_det->customer_address3;
        $customer_state_or_code = $inv_det->customer_state;
        $customer_gst = $inv_det->gst_no;
        
        $gstin = '';
        $state_code = '';
        if (!empty($customer_gst))
        { 
            $gstin = '
                    <tr>
                    <td width="5%"></td>
                    <td width="50%" align="left" style="">GSTIN/UIN No: '.$customer_gst.'</td>
                    <td width="20%" align="left" style="font-weight:bold"></td>
                    <td width="25%"></td>
                    </tr>
                    ';
        }
        if(!empty($customer_state_or_code))
        {
            $state_code = '
                        <tr>
                        <td width="5%"></td>
                        <td width="40%" align="left" style="">State / Code : '.$customer_state_or_code.'</td>
                        <td width="25%"></td>
                        <td width="30%"></td>
                        </tr>
                        ';
        }
        $table = '
                    <br><br>
                    <table>
                        <tr>
                            <td colspan="2" width="55%" style="font-weight:bold">To The Account of:</td>
                            <td width="20%" align="left" style="font-weight:bold">Your Ref / PO No</td>
                            <td width="25%" style="">:RTDAS</td>
                        </tr>
                        <tr>
                            <td width="5%"></td>
                            <td width="40%" align="left" style="font-weight:bold">'.strtoupper($customer_name).'</td>
                            <td width="25%" align="left" style="font-weight:bold"></td>
                            <td width="30%"></td>
                        </tr>
                        <tr>
                            <td width="5%"></td>
                            <td width="50%" align="left">'.$customer_address.'</td>
                            <td width="20%" align="left" style="font-weight:bold">Payment Term</td>
                            <td width="25%">: '.$inv_det->payment_term.'</td>
                        </tr>
                        <tr>
                            <td width="5%"></td>
                            <td width="50%" align="left">'.$customer_address2.'</td>
                            <td width="20%" align="left" style="font-weight:bold">Payment Due Date</td>
                            <td width="25%">: '.$inv_det->due_date.'</td>
                        </tr>
                        <tr>
                            <td width="5%"></td>
                            <td width="50%" align="left">'.$customer_address3.'</td>
                            <td width="20%" align="left" style="font-weight:bold">Delivery Term</td>
                            <td width="25%">: '.$inv_det->customer_delivery_term.'</td>
                        </tr>
                        '.$state_code.'
                        '.$gstin.'

                        
                        
                    </table>
        
        ';
        

        $this->writeHTML($table, true, false, false, false, '');

        $table = '
        <br><br>
        <table>
            <tr>
                <td colspan="2" width="55%" style="font-weight:bold"></td>
                <td width="20%" align="left" style="font-weight:bold">ETD</td>
                <td width="25%" style="">: '.$etd.'</td>
            </tr>
            <tr>
                <td colspan="2" width="55%" style="font-weight:bold">Congsigned /Deliver To:</td>
                <td width="20%" align="left" style="font-weight:bold">Vessel/Flight/Vehicle No</td>
                <td width="25%" style="">: '.$inv_det->vessel_name.'</td>
            </tr>
            <tr>
                <td width="5%"></td>
                <td width="50%" align="left" style="font-weight:bold">'.strtoupper($customer_name).'</td>
                <td width="20%" align="left" style="font-weight:bold">Loading Port/Place</td>
                <td width="25%">: '.$inv_det->load_port.'</td>
            </tr>
            <tr>
                <td width="5%"></td>
                <td width="50%" align="left">'.$customer_address.'</td>
                <td width="20%" align="left" style="font-weight:bold">Discharge Port/Place</td>
                <td width="25%">: '.$inv_det->dis_port.'</td>
            </tr>
            <tr>
                <td width="5%"></td>
                <td width="50%" align="left">'.$customer_address2.'</td>
                <td width="20%" align="left" style="font-weight:bold">Final Destination</td>
                <td width="25%">: '.$inv_det->final_destination.'</td>
            </tr>
            '.$state_code.'
            '.$gstin.'

        </table>

        ';


        $this->writeHTML($table, true, false, false, false, '');

    }

    public function claimable($inv_det){

        $banks_name = $inv_det->bank_name;
        $status = $inv_det->status;
        $sign_name = $inv_det->letterhead_name;
        $banks_address = $inv_det->bank_address;
        $banks_acc_no = $inv_det->bank_acc_no;
        $banks_swift_code = $inv_det->bank_swift_code;
        $banks_currency = $inv_det->bank_currency;
        // $user_create_signature_image = $inv_det->user_create_signature_image;
        $full_path_user_create_signature_image = '';
        // if ( $status == 2)
        // {
        //     // $full_path_user_create_signature_image = base_url('upload_files/signature_images/20200511225912_signature_example_100x100.png');
        
        //     if(file_exists('upload_files/signature_images/'.$user_create_signature_image) == true && !empty($user_create_signature_image))
        //     {
        //         $full_path_user_create_signature_image = base_url('upload_files/signature_images/'.$user_create_signature_image);

        //     }
        //     else
        //     {
        //         $full_path_user_create_signature_image = base_url('upload_files/signature_images/20200511225912_signature_example_100x100.png');;
        //     }
        // }
        $table = '
                    <br>
                    <table>
                        <tr>
                            <td width="80%" style="font-weight: bold;">AMOUNT CLAIMABLE FOR THIS INVOICE('.$inv_det->tier_name.')</td>
                            <td width="20%" style="text-decoration:underline" align="right">'.$inv_det->claimable_amount.'</td>
                        </tr>
                        <tr><td></td></tr>
                        <tr>
                            <td colspan="2"><b>Our Bank Details : '.strtoupper($banks_name).'</b>,'.$status.' '.$banks_address.'. <b>ACCOUNT NO: '.strtoupper($banks_currency).' - '.$banks_acc_no.' , SWIFT CODE: '.$banks_swift_code.'</b></td>
                        </tr>
                        <tr><td></td></tr>
                        <tr>
                            <td>Authorised Signatory of <b>'.$sign_name.'</b></td>
                        </tr>
                        <br>
                        <br>
                        <br>
                        <br>
                        
                    </table>

        ';

        $this->writeHTML($table, true, false, false, false, '');

    }

    public function marks($inv_det){


        

        $terms = '

                    <table style="width:40px; height:30px;" cellspacing="0" cellpadding="1" style="border: 1px solid black;
                    border-collapse: collapse;">

                        <tr>
                            <td style="width:30%; height:80px;">
                            '.$inv_det->shipping_mark.'
                            </td>
                            
                        </tr>
                    
                    </table>
        
        ';

        $this->startTransaction(); 
        $start_page = $this->getPage();
        $this->SetFont ('times', 'B', 10 , '', 'default', true );
        $this->Write(10, 'SHIPPING MARKS :', '', 0, 'L', true, 0, false, false, 0);      
        $this->SetFont('helvetica', '', 8);                 
        $this->writeHTML($terms, true, false, false, false, '');
        $end_page = $this->getPage();
        if  ($end_page != $start_page) {
            $this->rollbackTransaction(true); // don't forget the true
            $this->AddPage();
            $this->Write(10, 'Terms & Conditions :', '', 0, 'L', true, 0, false, false, 0);     
            $this->SetFont('helvetica', '', 8);                  
            $this->writeHTML($terms, true, false, false, false, '');
        }else{
            $this->commitTransaction();     
        } 

        // $this->writeHTML($terms, true, false, false, false, '');

    }



    public function remark($inv_det){

        $table = $remark1= $remark2 = '';
        if (!empty($inv_det->remark1))
        {
            $remark1 = '<tr>
            <td style="height:30px;">
            '.$inv_det->remark1.'
            </td>
            
        </tr>';
        }
        if (!empty($inv_det->remark2))
        {
            $remark2 = '<tr>
            <td style="height:60px;">
            '.$inv_det->remark2.'
            </td>
            
        </tr>';
        }

        $table = '
                    
            <table>

                
               '.$remark1.'
               '.$remark2.'
            
            </table>

        ';
        
        $this->SetFont ('times', 'B', 10 , '', 'default', true );
        $this->Write(10, 'REMARKS :', '', 0, 'L', true, 0, false, false, 0);      
        $this->SetFont('helvetica', '', 8);
        $this->writeHTML($table, true, false, false, false, '');

    }

function create_table($data) 
{
	$res = '<table width="100%"  cellspacing="10" border="0">';
	$max_data = sizeof($data);
	$ctr = 1;
    $i= 0;
	foreach ($data as $db_data) 
	{
		if ($ctr % 2 == 0) 
		{
			$res .= '<td align="center"  style="border: 1px solid #000;">' . nl2br($db_data). '</td></tr>';
		}
		else 
		{
			if ($ctr < $max_data) 
			{
				$res .= '<tr><td align="center" style="border: 1px solid #000;">' . nl2br($db_data). '</td>';
			}
			else 
			{
				$res .= '<tr><td align="center" style="border: 1px solid #000;">' . nl2br($db_data). '</td></tr>';
			}
		}
		$ctr++;
        $i++;
	}

	$res .= '</table>';
    $this->SetFont ('times', 'B', 10 , '', 'default', true );
    $this->Write(10, 'SHIPPING MARKS :', '', 0, 'L', true, 0, false, false, 0);      
    $this->SetFont('helvetica', '', 8);  
    $this->writeHTML($res, true, false, false, false, '');

	
}


    public function remark_multiple(){

        $table = '
                    <br><br>
                    <table>
                        <tr>
                            <td style="font-weight: bold;"></td>
                        </tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr>
                            <td style="font-weight: bold;">REMARKS :</td>
                        </tr>
                        <tr><td></td></tr>
                        <tr>
                            <td>We hereby certify that our registration certificate under the Goods and Service Tax  Act, 2017 for the state of Haryana is in force on the date on of 01st July, 2017 and that the transaction of supply covered by  this Tax Invoice has been effected by us and it shall be accounted  for in  the turnover of  supply while filing  the respective period return and due tax , if any payable on the supply has been paid shall be paid.</td>
                        </tr>
                        <tr><td></td></tr>
                    </table>
        ';

        $this->writeHTML($table, true, false, false, false, '');

    }

    public function attached_sheet(){

        $this->SetFont('helvetica', 'B', 8);
        $this->Write(10, '-Attached Sheet-', '', 0, 'L', true, 0, false, false, 0);  

        $shipping_marks = '

                        <br><br>
                        <table>
                            <tr>
                                <td></td>
                            </tr>
                        </table>
                        <br>
                        <br>
        
        ';

        $this->writeHTML($shipping_marks, true, false, false, false, '');
        
        $this->SetFont('helvetica', '', 8);
        $shipping = '
        
                        <table cellpadding="5">
                            <tr>
                                <td>
                                    <table border="1">
                                        <tr>
                                            <td>
                                                GE1234
                                                <br>
                                                Volvo OE
                                                <br>
                                                PONO : 123456
                                                <br>
                                                C/No : 1- Up
                                                <br>
                                                1 Pallet = 78
                                                <br>
                                                Made in Japan
                                                <br>
                                                xxxxxxxxxxxxxxxxxx
                                                <br>
                                                xxxxxxxxxxxxxxxxxx
                                                <br>
                                                xxxxxxxxxxxxxxx
                                                <br>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table border="1">
                                        <tr>
                                            <td>
                                                GE1234
                                                <br>
                                                Volvo OE
                                                <br>
                                                PONO : 123456
                                                <br>
                                                C/No : 1- Up
                                                <br>
                                                1 Pallet = 78
                                                <br>
                                                Made in Japan
                                                <br>
                                                xxxxxxxxxxxxxxxxxx
                                                <br>
                                                xxxxxxxxxxxxxxxxxx
                                                <br>
                                                xxxxxxxxxxxxxxx
                                                <br>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table border="1">
                                        <tr>
                                            <td>
                                                GE1234
                                                <br>
                                                Volvo OE
                                                <br>
                                                PONO : 123456
                                                <br>
                                                C/No : 1- Up
                                                <br>
                                                1 Pallet = 78
                                                <br>
                                                Made in Japan
                                                <br>
                                                xxxxxxxxxxxxxxxxxx
                                                <br>
                                                xxxxxxxxxxxxxxxxxx
                                                <br>
                                                xxxxxxxxxxxxxxx
                                                <br>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <br><br>
        
                    ';

        $this->writeHTML($shipping, true, false, false, false, '');

        $this->SetFont('helvetica', 'B', 8);

        $remarks = '
        
                        <table>
                            <tr>
                                <td style="font-weight: bold;">REMARKS :</td>
                            </tr>
                        </table>
        
        ';

        $this->writeHTML($remarks, true, false, false, false, '');
        
    }

    public function lc(){


        $this->SetFont('helvetica', 'B', 8);
        $this->Write(10, '-For LC Only-', '', 0, 'L', true, 0, false, false, 0);  

        $shipping_marks = '

                        <br><br>
                        <table>
                            <tr>
                                <td>The Recommended and Proposed Content of Terms and Conditions for Letter of Credit</td>
                            </tr>
                        </table>
                        <br>
                        <br>
        
        ';

        $this->writeHTML($shipping_marks, true, false, false, false, '');

        $this->SetFont('helvetica', '', 8);

        $table = '
        
                        <table>
                            <tr>
                                <td width="10%">
                                    1)
                                </td>
                                <td align="left">
                                    Port of Loading/Shipment :
                                </td>
                                <td align="left">
                                    Yokohama, Japan
                                </td>
                            </tr>
                            <tr><td></td></tr>
                            <tr>
                                <td width="10%">
                                    2)
                                </td>
                                <td align="left">
                                    Partial Shipment :
                                </td>
                                <td align="left">
                                    Allowed
                                </td>
                            </tr>
                            <tr><td></td></tr>
                            <tr>
                                <td width="10%">
                                    3)
                                </td>
                                <td align="left">
                                    Transhipment :
                                </td>
                                <td align="left">
                                    Allowed
                                </td>
                            </tr>
                            <tr><td></td></tr>
                            <tr>
                                <td width="10%">
                                    4)
                                </td>
                                <td align="left">
                                    Irrevocable LC At :
                                </td>
                                <td align="left">
                                    60 Days After BL
                                </td>
                            </tr>
                            <tr><td></td></tr>
                            <tr>
                                <td width="10%">
                                    5)
                                </td>
                                <td align="left">
                                    Our Advising Bank :
                                </td>
                                <td align="left">
                                    <table>
                                        <tr>
                                            <td>Sumitomo Mitsui Banking Corp, Level 2, Jalan SR, 348, 54000 KL</td>
                                        </tr>
                                        <tr>
                                            <td>Account No. : For JPY - XXXXXXX</td>
                                        </tr>
                                        <tr>
                                            <td>Swift Code : XXXXXX</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td></td></tr>
                            <tr>
                                <td width="10%">
                                    6)
                                </td>
                                <td align="left">
                                    Latest Date of Shipment :
                                </td>
                                <td align="left">
                                    30/12/2020
                                </td>
                            </tr>
                            <tr><td></td></tr>
                            <tr>
                                <td width="10%">
                                    7)
                                </td>
                                <td align="left">
                                    Expiry Date of LC :
                                </td>
                                <td align="left">
                                    21/01/2021
                                </td>
                            </tr>
                            <tr><td></td></tr>
                            <tr>
                                <td width="10%">
                                    8)
                                </td>
                                <td align="left">
                                    Documents Required to Submit To Bank :
                                </td>
                                <td align="left">
                                    <table>
                                        <tr>
                                            <td>
                                                a) Invoice
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                b) PL
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                c) BL
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr><td></td></tr>
                            <tr>
                                <td>
                                    9)
                                </td>
                                <td align="left">
                                    Other Conditions :
                                </td>
                                <td align="left">
                                    <table>
                                        <tr>
                                            <td>
                                                a) Documents to submit within 21 days
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
        
        ';

        $this->writeHTML($table, true, false, false, false, '');

    }


}