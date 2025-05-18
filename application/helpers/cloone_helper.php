<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function pre($data)
{
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}

function getDateTime()
{
	// return date('Y-m-d H:i:s');
	$now = new DateTime();
	// $now->setTimezone(new DateTimezone('Asia/Kuala_Lumpur'));
	return $now->format('Y-m-d H:i:s');
}

function getTodayDate()
{
	// return date('Y-m-d');
	$now = new DateTime();
	// $now->setTimezone(new DateTimezone('Asia/Kuala_Lumpur'));
	return $now->format('Y-m-d');
}

function db_date($date)
{
	return date('Y-m-d',strtotime($date));
}

function db_time($time)
{
	return date('H:i:s',strtotime($time));
}

function view_date($date)
{
	return date('d-m-Y',strtotime($date));
}

function view_time($date)
{
	return date('h:i A',strtotime($date));
}

function view_time2($date)
{
	return date('G:i',strtotime($date));
}

function show_datetime($date){
	return view_date($date).' / '.view_time($date);
}

function yesterday_date($today_date)
{
	return date('Y-m-d',strtotime($today_date.' -1 day'));
}

function db_time_1_sec($date)
{
	return date('H:i:s',strtotime($date." -1 seconds"));
}

function db_time_add_1_sec($date)
{
	return date('H:i:s',strtotime($date." +1 seconds"));
}

function date_range_weekly($today_date)
{
	$duedt = explode("-", $today_date);
	$date  = mktime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);

	$week  = (int)date('W', $date);
	$month = date('F',$date);
	$year = date('Y',$date);


	$days = '5';
	$date_current = date('Y-m-d');
	$date = date_create();
	date_isodate_set($date, $year, $week);
	$start = date_format($date, 'd-m-Y');

	$date_now = $start;
	$day = date('w',strtotime($date_now));
	$a = strtotime('-'.($day-1).' days',strtotime($date_now));
	$b = strtotime('+'.(6-$day).' days',strtotime($date_now));

	$output = array();
	while($a <= $b)
	{
	// $output[] = array(
	  // "date" => date("d/m/Y",$a),
	  // "day" => date("l",$a)
	// );
		$output[] = date("Y-m-d",$a);
		$a += 86400;
	}
	return $output;
}

function display_datetime($show_type, $datetime) {
	
	$output_datetime = '';
	
	if ( strtoupper($show_type) == 'DATETIME' ) {
		
		if ( $datetime == '' || $datetime == '0000-00-00 00:00:00' ) {
			$output_datetime = '';
		} else {
			$output_datetime = date('d/m/Y H:i:s', strtotime($datetime));
		}
		
	} else if ( strtoupper($show_type) == 'DATETIME2' ) {
		
		if ( $datetime == '' || $datetime == '0000-00-00 00:00:00' ) {
			$output_datetime = '';
		} else {
			$output_datetime = date('d/m/Y H:i A', strtotime($datetime));
		}
		
	} else if ( strtoupper($show_type) == 'DATETIME3' ) {
		
		if ( $datetime == '' || $datetime == '0000-00-00 00:00:00' ) {
			$output_datetime = '';
		} else {
			$output_datetime = date('d/m/Y', strtotime($datetime));
		}
		
	} else if ( strtoupper($show_type) == 'DATETIME4' ) {
		
		if ( $datetime == '' || $datetime == '0000-00-00 00:00:00' ) {
			$output_datetime = '';
		} else {
			$output_datetime = date('jS \of F Y', strtotime($datetime));
		}
		
	} else if ( strtoupper($show_type) == 'DATE' ) {
		
		if ( $datetime == '' || $datetime == '0000-00-00' ) {
			$output_datetime = '';
		} else {
			$output_datetime = date('d/m/Y', strtotime($datetime));
		}
		
	} else if ( strtoupper($show_type) == 'TIME' ) {
		
		if ( $datetime == '' || $datetime == '00:00:00' ) {
			$output_datetime = '';
		} else {
			$output_datetime = date('H:i A', strtotime($datetime));
		}
		
	} else if ( strtoupper($show_type) == 'DB_DATE' ) {
		
		if ( $datetime == '' || $datetime == '0000-00-00' ) {
			$output_datetime = NULL;
		} else {
			$output_datetime = date('Y-m-d', strtotime($datetime));
		}
		
	} else if ( strtoupper($show_type) == 'DB_DATETIME' ) {
		
		if ( $datetime == '' || $datetime == '0000-00-00 00:00:00' ) {
			$output_datetime = NULL;
		} else {
			$output_datetime = date('Y-m-d H:i:s', strtotime($datetime));
		}
		
	} else {
		
		if ( $datetime == '' || $datetime == '0000-00-00 00:00:00' ) {
			$output_datetime = '';
		} else {
			$output_datetime = date('d/m/Y H:i:s', strtotime($datetime));
		}
		
	}
	
	return $output_datetime;
}

function display_number_format($show_type, $number) {
	
	if ( strtoupper($show_type) == 'INTEGER' ) {
		$output_number = number_format($number);
		
	} else if ( strtoupper($show_type) == 'DECIMAL' ) {
		$output_number = number_format($number, 2);
	
	} else {
		$output_number = number_format($number);
	}
	
	return $output_number;
}

function shuffle_name($name = '')
{
	$alpa = 'abcdefghijklmnopqrstuvwxyz1234567890';
	$str = str_shuffle($alpa);
	$strrun = substr($str,0,5);
	$pName = $strrun.date('H').$name;
	
	return $pName;
}

function shuffle_name2($name = '')
{
	$alpa = 'abcdefghijklmnopqrstuvwxyz1234567890';
	$str = str_shuffle($alpa);
	$strrun = substr($str,0,7);
	$pName = $strrun.date('H').$name;
	
	return $pName;
}




/*
* echo session notis
*/
function flash( $name = '', $message = '', $class = 'alert alert-success' )
{
	//We can only do something if the name isn't empty
	if( !empty( $name ) )
	{
		//No message, create it
		if( !empty( $message ) && empty( $_SESSION[$name] ) )
		{
			if( !empty( $_SESSION[$name] ) )
			{
				unset( $_SESSION[$name] );
			}
			if( !empty( $_SESSION[$name.'_class'] ) )
			{
				unset( $_SESSION[$name.'_class'] );
			}

			$_SESSION[$name] = $message;
			$_SESSION[$name.'_class'] = $class;
		}
		//Message exists, display it
		elseif( !empty( $_SESSION[$name] ) && empty( $message ) )
		{
			$class = !empty( $_SESSION[$name.'_class'] ) ? $_SESSION[$name.'_class'] : 'success';
			echo '
			
			<div class="'.$class.' alert-dismissable" id="msg-flash">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				'.$_SESSION[$name].'
			</div>
			';
			unset($_SESSION[$name]);
			unset($_SESSION[$name.'_class']);
		}
	}
}

/*
* echo js notis from fo function
*/
function flash_output( $name = '', $message = '' )
{
	//We can only do something if the name isn't empty
	if( !empty( $name ) )
	{
		//No message, create it
		if( !empty( $message ) && empty( $_SESSION[$name] ) )
		{
			if( !empty( $_SESSION[$name] ) )
			{
				unset( $_SESSION[$name] );
			}
			if( !empty( $_SESSION[$name.'_class'] ) )
			{
				unset( $_SESSION[$name.'_class'] );
			}

			$_SESSION[$name] = $message;
			//$_SESSION[$name.'_class'] = $class;
		}
		//Message exists, display it
		elseif( !empty( $_SESSION[$name] ) && empty( $message ) )
		{
			//$class = !empty( $_SESSION[$name.'_class'] ) ? $_SESSION[$name.'_class'] : 'success';
			echo $_SESSION[$name];
			unset($_SESSION[$name]);
			//unset($_SESSION[$name.'_class']);
		}
	}
}

/*
* create js notis in session -> output need to call flash_output
*/
function fo($big_name,$msg,$msg_title = '',$msg_type='success')
{
	$title = ($msg_title == '' ? "" : ",'".$msg_title."'" );
	$js_notis = "
		<script>
		$(function(){
			swal({
                title: '".$msg."',
                text: '',
                type: '".$msg_type."'
            });
		});
		</script>
	";
	flash_output($big_name,$js_notis);
}

/*
* echo js notis
*/
function fo_short($msg,$msg_type = "success",$msg_title = '')
{
	$title = ($msg_title == '' ? "" : ",'".$msg_title."'" );
	$js_notis = "
		<script>
		$(function(){
			$.jGrowl('".$msg."', { theme: 'bg-".$msg_type."', header: '".$title."', position: 'center' });
		});
		</script>
	";

	echo $js_notis;
}

function check_success($type,$msg_name,$msg,$location='',$types='success')
{
	// $types = ($typee == 'success' ? array("1"=>"success","2"=>"alert alert-success") : array("1"=>"red-thunderbird","2"=>"alert alert-danger") );
	fo($msg_name,$msg,'',$types);
	if($type == 2)
	{
		//$this->flash($msg_name.'2',$msg,'',$types["2"]);
	}
	if(!empty($location))
	{
		redirect($location);
	}
	
}

function sweet_alert($type='success',$header_msg='',$small_msg='',$imageUrl='',$imageHeight='',$animation='false')
{
	$js_html = '
	<script>
	$(function(){
		swal({
            title: "'.$header_msg.'",
            html: "'.$small_msg.'",
            type: "'.$type.'",
			imageUrl: "'.$imageUrl.'",
			imageHeight: "'.$imageHeight.'",
			animation: "'.$animation.'"
        });
    });
	</script>
	';
	$_SESSION['notis'] = $js_html;
	// $this->session->set_flashdata('notis', $js_html);
}

function enc_dll($pwds)
{
	$encrypted_password = '';
	try    
	  {
			$dll = new COM("PasswordUtil.PasswordUtils2"); 
			$encrypted_password = $dll->Encrypt_Password($pwds);
	  } 
	  catch(Exception $e)
	  {
		echo 'error: ' . $e->getMessage(), "\n";
	  }

	 return $encrypted_password;
}

function date_range_array($strDateFrom,$strDateTo)
{

    $aryRange=array();

    $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2), substr($strDateFrom,8,2),substr($strDateFrom,0,4));
    $iDateTo=mktime(1,0,0,substr($strDateTo,5,2), substr($strDateTo,8,2),substr($strDateTo,0,4));

    if ($iDateTo>=$iDateFrom)
    {
        array_push($aryRange,date('Y-m-d',$iDateFrom)); // first entry
        while ($iDateFrom<$iDateTo)
        {
            $iDateFrom+=86400; // add 24 hours
            array_push($aryRange,date('Y-m-d',$iDateFrom));
        }
    }
    return $aryRange;
}


function encryptor($action, $string)
{
	$output = false;

	$encrypt_method = "AES-256-CBC";
	//pls set your unique hashing key
	$secret_key = 'm@3H';
	$secret_iv = 'm@eH123!';

	// hash
	$key = hash('sha256', $secret_key);

	// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
	$iv = substr(hash('sha256', $secret_iv), 0, 16);

	//do the encyption given text/string/number
	if( $action == 'encrypt' )
	{
		$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
		$output = base64_encode($output);
	}
	else if( $action == 'decrypt' )
	{
		//decrypt the given text/string/number
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
	}

	return $output;
}

function view_menu($res)
{
	echo $res == false ? 'hilang' : '';
}

function return_empty($val)
{	
	return empty($val) ? '' : $val ;
}

function return_img($val,$path = '')
{
	if(empty($val))
	{
		return base_url('files/sample_img.jpg');
	}
	else
	{
		$img = explode('/',$val);
		$img = end($img);

		if($img == 'temporary.jpg' || $img == 'imgTemp.png' || $img == 'video-img.jpg')
		{
			return base_url('files/sample_img.jpg');
		}
		else
		{
			$img = str_replace("mp4","jpg",$img);
			return $path.$img;
		}
	}
}

function return_img2($val,$path = '')
{
	if(empty($val))
	{
		return base_url('files/sample_img.jpg');
	}
	else
	{
		$img = explode('/',$val);
		$img = end($img);

		if($img == 'temporary.jpg' || $img == 'imgTemp.png' || $img == 'video-img.jpg')
		{
			return base_url('files/sample_img.jpg');
		}
		else
		{
			return $path.$img;
		}
	}
}

function imgVidType($val)
{
	$type = 'img';
	$val_arr = explode('.',$val);
	$val_end = end($val_arr);

	if($val_end == 'mp4')
	{
		$type = 'vid';
	}

	return $type;
}

function path_img($img,$path)
{
	if (file_exists($path.$img)) 
	{
	    return '/'.$path.$img;
	}
	else
	{
		return '/files/sample_img.jpg';
	}
}

function imgOrVid($val)
{
	if(strpos($val,".jpg") > 0)
	{
		return $val;
	}
	else
	{
		return '/files/default_video.jpg';
	}
}

function remove_space_and_tab($string)
{
	$string = str_replace('`',"'",$string);
	$string = preg_replace('/\s+/S', " ", $string);

	return $string;
}

function read_svg()
{
	$main_path = "assets/SVG/";
	// model looping
	$count = 0;
	$output = array();
	//all file without ext glob(*)
	foreach (glob($main_path."*") as $filename)
	{
		//echo "<br />".$count.' - '.basename($filename);

		$file_name = basename($filename);
		$file_name_arr = explode('.svg', $file_name);
		$new_file_name = $file_name_arr[0];
		$output[] = $new_file_name;
		// echo "<br />".$count.' - '.$new_file_name;
		// $count++;
	}

	return $output;
}

function generate_random_code($length = 3, $category = 1) 
{
	//-------------------------------------------------
	//category : 
	// 1 = alphabets upper
	// 2 = alphabets lower 
	// 3 = alphabets mix
	// 4 = alphanumeric upper 
	// 5 = alphanumeric lower
	// 6 = alphanumeric mix
	// 7 = numeric
	//-------------------------------------------------
	
	//#Reference - https://gist.github.com/karlgroves/5227409
	$randstr = "";
	srand((double) microtime(TRUE) * 1000000);
	//our array add all letters and numbers if you wish
	
	// 1 = alphabets upper
	if ( $category == 1 )
	{
		$alphanumeric_chars = array(
			'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 
			'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 
			'U', 'V', 'W', 'X', 'Y', 'Z');
	}
	// 2 = alphabets lower 
	else if ( $category == 2 )
	{
		$alphanumeric_chars = array(
			'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 
			'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 
			'u', 'v', 'w', 'x', 'y', 'z');
	}
	// 3 = alphabets mix
	else if ( $category == 3 )
	{
		$alphanumeric_chars = array(
			'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 
			'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 
			'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 
			'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 
			'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 
			'Y', 'Z');
	}
	// 4 = alphanumeric upper 
	else if ( $category == 4 )
	{
		$alphanumeric_chars = array(
			'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 
			'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 
			'U', 'V', 'W', 'X', 'Y', 'Z', '0', '1', '2', '3', 
			'4', '5', '6', '7', '8', '9');
	}
	// 5 = alphanumeric lower
	else if ( $category == 5 )
	{
		$alphanumeric_chars = array(
			'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 
			'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 
			'u', 'v', 'w', 'x', 'y', 'z', '0', '1', '2', '3', 
			'4', '5', '6', '7', '8', '9');
	}
	// 6 = alphanumeric mix
	else if ( $category == 6 )
	{
		$alphanumeric_chars = array(
			'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 
			'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 
			'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 
			'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 
			'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 
			'Y', 'Z', '1', '2', '3', '4', '5', '6', '7', '8', 
			'9');
	}
	// 7 = numeric
	else if ( $category == 7 )
	{
		$alphanumeric_chars = array(
			'0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
	}
	
	for ($rand = 0; $rand <= $length; $rand++) {
		$random = rand(0, count($alphanumeric_chars) - 1);
		$randstr .= $alphanumeric_chars[$random];
	}
	return $randstr;
}

function create_folder($filename)
{
	if (!file_exists($filename))
	{
		mkdir($filename, 0777);
		$result = 1;
		//success create directory
		if ( file_exists($filename) )
		{
			$result = 0;
		} 
		//fail need to call this function back (recursive)
		else 
		{
			create_folder($filename);
		}
	}
	//already exist
	else 
	{
		$result = 0;
	}
	
	return $result;
}

function get_prefix_code($prefix_type, $selected_id, $prefix_no, $year='', $month='', $date='')
{
	$code = "";
	
	if ( !empty($selected_id) && $prefix_no > 0 ) 
	{
		if ( !empty($prefix_type) )
		{
			$prefix = $prefix_type.$year.$month;
		}
		else
		{
			$prefix = 'MPL'.$year.$month;
		}
		
		// if ( (int)$selected_id > 999999 ) {
			// $prefix_no = $prefix_no + 1;
		// }
		
		$code = $prefix.str_pad($selected_id, $prefix_no, '0', STR_PAD_LEFT);
	}
	
	return $code;
}

function iPay88_signature($source) {
    return base64_encode(_hex2bin(sha1($source)));
}

function _hex2bin($hexSource) {
	$bin = "";
    for ($i = 0; $i < strlen($hexSource); $i = $i + 2) {
        $bin .= chr(hexdec(substr($hexSource, $i, 2)));
    }
    return $bin;
}

function prepare_signature($merkey, $mercode, $reffno, $amt, $curr) 
{
	// https://payment.ipay88.com.my/epayment/testing/testsignature_256.asp (signature simulator for request)
	
    $amount = preg_replace("/[^0-9]/", "", $amt);
	
	$signature_source = "";
	$signature_source .= $merkey;
	$signature_source .= $mercode;
	$signature_source .= $reffno;
	$signature_source .= $amount;
	$signature_source .= $curr;
	
    $signature_generated = iPay88_signature($signature_source);
	// $signature_generated = hash("sha256", $signature_source); 
	return $signature_generated;
}

function verify_signature($merkey, $mercode, $payid, $reffno, $amt, $curr, $status, $sign) 
{
	// https://payment.ipay88.com.my/epayment/testing/TestSignature_response_256.asp (signature simulator for response)
	
    $amount = preg_replace("/[^0-9]/", "", $amt);
	
	$signature_source = "";
	$signature_source .= $merkey;
	$signature_source .= $mercode;
	$signature_source .= $payid;
	$signature_source .= $reffno;
	$signature_source .= $amount;
	$signature_source .= $curr;
	$signature_source .= $status;
	
    $signature_generated = iPay88_signature($signature_source);
	// $signature_generated = hash("sha256", $signature_source); 
	
	if ( $signature_generated == $sign ) 
	{
		// Signature Match
        $signature_status = 1;
    } 
	else 
	{
		// Signature Not Match
        $signature_status = 0;
    }
	
	return $signature_status;
}

function format_namecode($name, $code='')
{
	return $name . ( !empty($code) ? ' ('.$code.')' : '' );
}

function encryptor_multiple(&$val, $fn, $action)
{
	$val = encryptor($action, $val);
}
	
?>