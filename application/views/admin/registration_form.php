<?php
	
	$required_field = '';

	$registration_id_enc = '';
	$registration_no = '';
	$registration_agreement = ''; 
	$registration_payment = ''; 
	$payment_receipt = '';
	$payment_status = ''; 
	$registration_status = ''; 
	$registration_date = '';

	$member_id_enc = '';
	$name = '';
	$icno = '';
	$contactno_mobile = '';
	$email = '';
	$dob = '';
	$contactno_home = '';
	$home_address = '';
	$home_postcode = '';
	$home_city = '';
	$home_state = '';
	$job_position = '';
	$contactno_office = '';
	$office_address = '';
	$office_postcode = '';
	$office_city = '';
	$office_state = '';
	$member_status = ''; 
	$created = '';
	$updated = '';
	$active = ''; 
	$registration_status_label = '';
	$registration_status_color = '';

	$registration_agreement_checked = '';
	$registration_payment_checked = '';

	$attachment_payment_receipt = '';

	$approval_remarks = '';

	$readonly = 'readonly';
	$disabled = 'disabled';

	// pre($registration_data);

	if ( isset($registration_data) && is_object($registration_data) && !empty($registration_data) )
	{
		$registration_id = $registration_data->registration_id;
		$registration_id_enc = encryptor('encrypt',$registration_id);
		$registration_no = $registration_data->registration_no; 
		$registration_agreement = $registration_data->registration_agreement; 
		$registration_payment = $registration_data->registration_payment; 
		$payment_receipt = $registration_data->payment_receipt;
		$payment_status = $registration_data->payment_status; 
		$registration_status = $registration_data->registration_status; 
		$registration_date = $registration_data->registration_date;

		$member_id = $registration_data->member_id;
		$member_id_enc = encryptor('encrypt',$member_id);
		$name = $registration_data->name;
		$icno = $registration_data->icno;
		$contactno_mobile = $registration_data->contactno_mobile;
		$email = $registration_data->email;
		$dob = $registration_data->dob;
		$contactno_home = $registration_data->contactno_home;
		$home_address = $registration_data->home_address;
		$home_postcode = $registration_data->home_postcode;
		$home_city = $registration_data->home_city;
		$home_state = $registration_data->home_state;
		$job_position = $registration_data->job_position;
		$contactno_office = $registration_data->contactno_office;
		$office_address = $registration_data->office_address;
		$office_postcode = $registration_data->office_postcode;
		$office_city = $registration_data->office_city;
		$office_state = $registration_data->office_state;
		$member_status = $registration_data->member_status; 
		$registration_status_label = strtoupper($registration_data->registration_status_label);
		$registration_status_color = $registration_data->registration_status_color;

		$registration_agreement_checked = ( $registration_agreement == 1 ) ? 'checked' : '';
		$registration_payment_checked = ( $registration_payment == 1 ) ? 'checked' : '';

		$attachment_payment_receipt = $registration_data->attachment_preview['payment_receipt'];

		$approval_remarks = $registration_data->approval_remarks;

		$readonly = 'readonly';
		$disabled = 'disabled';
	}

?>

<style>
</style>

<div class="row">
	<div class="col-12">
	    <div class="page-title-box">
	        <h4 class="page-title float-left">Registration Details</h4>

	        <ol class="breadcrumb float-right">
	            <li class="breadcrumb-item"><a href="javascript:void(0)">Registration</a></li>
	            <li class="breadcrumb-item"><a href="<?=site_url('admin/registration');?>">List</a></li>
	            <li class="breadcrumb-item active">Details</li>
	        </ol>

	        <div class="clearfix"></div>
	    </div>
	</div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-12">
        <div class="card-box">
			<form id="form_registration" name="form_registration" action="" method="post" enctype="multipart/form-data">
	            <h4 class="header-title m-b-15 m-t-0">Manage Registration</h4>

	            <h5 class="m-b-15">REG NO: <strong><?=$registration_no;?></strong> <span class="label label-<?=$registration_status_color;?>"><?=$registration_status_label;?></span></h5>

	            <ul class="nav nav-tabs tabs-bordered nav-justified">
                    <li class="nav-item">
                        <a href="#tab_1" data-toggle="tab" aria-expanded="true" class="nav-link active">
                            Personal Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab_2" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Job Details
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab_3" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Qualifications
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab_4" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Organizations
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab_5" data-toggle="tab" aria-expanded="false" class="nav-link">
                            Aggrements
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">

                    	<div class="row">
	                    	<div class="col-md-6">
				                <div class="form-group">
				                    <label for="name">Name <?=STARFIELD;?></label>
				                    <input type="text" name="name" id="name" parsley-trigger="change" <?=$required_field;?> <?=$readonly;?> placeholder="Name" class="form-control input-sm turn_uppercase" value="<?=$name;?>" />
				                </div>
				                <div class="form-group">
				                    <label for="icno">IC No <?=STARFIELD;?></label>
				                    <input type="text" name="icno" id="icno" parsley-trigger="change" <?=$required_field;?> <?=$readonly;?> placeholder="IC No" class="form-control input-sm mask_nric" value="<?=$icno;?>" />
				                </div> 
				                <div class="form-group">
				                    <label for="contactno_mobile">HP No <?=STARFIELD;?></label>
				                    <input type="text" name="contactno_mobile" id="contactno_mobile" parsley-trigger="change" <?=$required_field;?> <?=$readonly;?> placeholder="HP No" class="form-control input-sm mask_phone" value="<?=$contactno_mobile;?>" />
				                </div>
				            </div>

				            <div class="col-md-6">
				               <div class="form-group">
				                    <label for="email">Email Address</label>
				                    <input type="text" name="email" id="email" parsley-trigger="change" <?=$readonly;?> placeholder="Email Address" class="form-control input-sm" value="<?=$email;?>" />
				                </div>
				                <div class="form-group">
				                    <label for="dob">Date of Birth <?=STARFIELD;?></label>
				                	<input type="text" name="dob" id="datepicker-dob" parsley-trigger="change" <?=$required_field;?> <?=$readonly;?> placeholder="dd/mm/yyyy" class="form-control input-sm" value="<?=$dob;?>" />
				                </div>       
				                <div class="form-group">
				                    <label for="contactno_home">Home Tel No</label>
				                    <input type="text" name="contactno_home" id="contactno_home" parsley-trigger="change" <?=$readonly;?> placeholder="Home Tel No" class="form-control input-sm mask_phone" value="<?=$contactno_home;?>" />
				                </div>
				            </div>

				            <div class="col-md-12">
				                <div class="form-group">
				                    <label for="home_address">Address - Home <?=STARFIELD;?></label>
				                    <textarea name="home_address" id="home_address" rows="5" style="resize: none; margin-top: 0px; margin-bottom: 0px; height: 100px;" parsley-trigger="change" <?=$required_field;?> <?=$readonly;?> placeholder="Address - Home" class="form-control input-sm turn_uppercase"><?=$home_address;?></textarea>
				                </div>
				            </div>

				            <div class="col-md-4">
				               <div class="form-group">
				                    <label for="home_postcode">Postcode <?=STARFIELD;?></label>
				                    <input type="text" name="home_postcode" id="home_postcode" parsley-trigger="change" <?=$required_field;?> <?=$readonly;?> placeholder="Postcode" class="form-control input-sm turn_uppercase" value="<?=$home_postcode;?>" />
				                </div>
				            </div>

				            <div class="col-md-4">    
				                <div class="form-group">
				                    <label for="home_city">City <?=STARFIELD;?></label>
				                    <input type="text" name="home_city" id="home_city" parsley-trigger="change" <?=$required_field;?> <?=$readonly;?> placeholder="City" class="form-control input-sm turn_uppercase" value="<?=$home_city;?>" />
				                </div>
				            </div>

				            <div class="col-md-4">    
				                <div class="form-group">
				                    <label for="home_state">State <?=STARFIELD;?></label>
				                     <input type="text" name="home_state" id="home_state" parsley-trigger="change" <?=$required_field;?> <?=$readonly;?> placeholder="State" class="form-control input-sm turn_uppercase" value="<?=$home_state;?>" />
				                </div>
				            </div>

			            </div>
                    </div>
                    <!-- end tab_1 -->

                    <div class="tab-pane" id="tab_2">
                    	<div class="row">

				            <div class="col-md-6">
					 			<div class="form-group">
				                    <label for="job_position">Current Post</label>
				                    <input type="text" name="job_position" id="job_position" parsley-trigger="change" <?=$readonly;?> placeholder="Current Post" class="form-control input-sm turn_uppercase" value="<?=$job_position;?>" />
				                </div>
				            </div>

				            <div class="col-md-6">
					 			<div class="form-group">
				                    <label for="contactno_office">Office Tel No</label>
				                    <input type="text" name="contactno_office" id="contactno_office" parsley-trigger="change" <?=$readonly;?> placeholder="Office Tel No" class="form-control input-sm mask_phone" value="<?=$contactno_office;?>" />
				                </div>
				            </div>

							<div class="col-md-12">    
				                <div class="form-group">
				                    <label for="office_address">Address - Office</label>
				                    <textarea name="office_address" id="office_address" rows="5" style="resize: none; margin-top: 0px; margin-bottom: 0px; height: 100px;" parsley-trigger="change" <?=$readonly;?> placeholder="Address - Office" class="form-control input-sm turn_uppercase"><?=$office_address;?></textarea>
				                </div>
				            </div>

				            <div class="col-md-4">
				               <div class="form-group">
				                    <label for="office_postcode">Postcode</label>
				                    <input type="text" name="office_postcode" id="office_postcode" parsley-trigger="change" <?=$readonly;?> placeholder="Postcode" class="form-control input-sm turn_uppercase" value="<?=$office_postcode;?>" />
				                </div>
				            </div>

				            <div class="col-md-4">    
				                <div class="form-group">
				                    <label for="office_city">City</label>
				                    <input type="text" name="office_city" id="office_city" parsley-trigger="change" <?=$readonly;?> placeholder="City" class="form-control input-sm turn_uppercase" value="<?=$office_city;?>" />
				                </div>
				            </div>

				            <div class="col-md-4">    
				                <div class="form-group">
				                    <label for="office_state">State</label>
				                    <input type="text" name="office_state" id="office_state" parsley-trigger="change" <?=$readonly;?> placeholder="State" class="form-control input-sm turn_uppercase" value="<?=$office_state;?>" />
				                </div>
				            </div>

			        	</div>
                    </div>
                    <!-- end tab_2 -->

                    <div class="tab-pane" id="tab_3">
                    	<div class="row">

                    		<div class="table-responsive">
                            	<table id="table_qualification" class="table m-0 table-colored table-primary">
                                    <thead>
                                        <tr>
                                            <th width="10%">Qualification</th>
                                            <th width="30%">Title/Result</th>
                                            <th width="10%">Year</th>
                                            <th width="40%">School/College/University</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody_qualification">
                                    </tbody>
                                </table>
                            </div>

                    	</div>
                    </div>
                    <!-- end tab_3 -->

                    <div class="tab-pane" id="tab_4">
                        <div class="row">

                    		<div class="table-responsive">
                            	<table id="table_organization" class="table m-0 table-colored table-primary">
                                    <thead>
                                        <tr> 
                                        	<th width="70%">Organization</th>
				                            <th width="30%">Post</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody_organization">
                                    </tbody>
                                </table>
                            </div>

                    	</div>
                    </div>
                    <!-- end tab_4 -->

                    <div class="tab-pane" id="tab_5">
                        <div class="row">
	                        <div class="col-md-12">
					            <div class="checkbox checkbox-success" style="margin-left:18px;">
				                    <input type="checkbox" class="custom-control-input" id="registration_agreement" name="registration_agreement" value="1" <?=$registration_agreement_checked;?> <?=$disabled;?> />
				                    <label class="custom-control-label font-13" for="registration_agreement">I agree to abide by the Rules of the Malaysia Association of Environmental Health (MAEH).</label>
				                </div> 
				            </div>

							<div class="col-md-12">
					            <div class="checkbox checkbox-success" style="margin-left:18px;">
				                    <input type="checkbox" class="custom-control-input" id="registration_payment" name="registration_payment" value="1" <?=$registration_payment_checked;?> <?=$disabled;?> />
				                    <label class="custom-control-label font-13" for="registration_payment">I enclosed herewith payment receipt for RM39.00 being the payment of yearly subscription RM36.00 and entrance fee RM3.00.<br />For students, yearly subscription RM10.00 and entrance fee RM3.00.</label>
				                </div> 
				            </div>

				            <div class="col-md-12 payment_receipt_file">
				            	<?=$attachment_payment_receipt;?>
				            </div>
				        </div>
                    </div>
                    <!-- end tab_5 -->
                </div>

                <hr />

                <h4 class="header-title m-b-15 m-t-0">For Approval</h4>

	            <div class="m-b-10">
	                <div class="form-group">
	                    <label for="approval_remarks">Remarks</label>
	                    <textarea name="approval_remarks" id="approval_remarks" rows="5" style="resize: none; margin-top: 0px; margin-bottom: 0px; height: 100px; parsley-trigger="change" <?=( in_array($registration_status, array(2,3)) ? 'readonly' : '' );?> placeholder="Remarks" class="form-control input-sm"><?=$approval_remarks;?></textarea>
	                </div>
	            </div>
	            
	            <?php 
	            	if ( in_array($registration_status, array('', 1)) )
	            	{
	            ?>
		            <div class="m-b-10" style="text-align:end;">
			            <button type="button" class="btn btn-success waves-effect w-md waves-light btn-approval" id="btn_approve" value="2">Approve</button>
			            <button type="button" class="btn btn-danger waves-effect w-md waves-light btn-approval" id="btn_reject" value="3">Reject</button>
			        </div>
	            <?php		
	            	}
	            ?>

				<input type="hidden" id="ids_1" name="ids_1" value="<?=$registration_id_enc;?>" />
				<input type="hidden" id="ids_2" name="ids_2" value="<?=$member_id_enc;?>" />

			</form>	
        </div>
    </div><!-- end col -->
</div>
<!-- end row -->

<script type="text/javascript">

// get list of qualification details
function get_qualification_details()
{
	$('.tbody_qualification').html('');

	var ids_1 = $('#ids_1').val();
	var ids_2 = $('#ids_2').val();

	var dataString = "ids_1="+ids_1+"&ids_2="+ids_2;

	$.ajax({
		type: "POST",
		url: "<?php echo site_url('registration/qualification/details')?>",
		data: dataString,
		// dataType: 'json',
		cache: false,
		success: function(response) {
			// console.log("response",response);
			$('.tbody_qualification').html(response); 
		},
		complete: function(){
		}
	});
}

// get list of organization details
function get_organization_details()
{
	$('.tbody_organization').html('');

	var ids_1 = $('#ids_1').val();
	var ids_2 = $('#ids_2').val();

	var dataString = "ids_1="+ids_1+"&ids_2="+ids_2;

	$.ajax({
		type: "POST",
		url: "<?php echo site_url('registration/organization/details')?>",
		data: dataString,
		// dataType: 'json',
		cache: false,
		success: function(response) {
			// console.log("response",response);
			$('.tbody_organization').html(response); 
		},
		complete: function(){
		}
	});
}

$(function(){
	
	get_qualification_details();
	get_organization_details();

	$('.btn-approval').click(function(){

		var ids_1 = $('#ids_1').val();
		var ids_2 = $('#ids_2').val();
		var status = $(this).val(); 
		var approval_remarks = $('#approval_remarks').val();

		var dataString = "ids_1="+ids_1+"&ids_2="+ids_2+"&status="+status+"&approval_remarks="+approval_remarks;

		if ( status == 2 )
		{
			status_label = 'Approve';
		}
		else
		{
			status_label = 'Reject';
		}

		if ( status == 3 && approval_remarks == '' )
		{
			swal({
					title: '',
					html: 'Please key your remarks regarding the rejection!',
					type: 'warning',
					allowOutsideClick: false
				}).then(function () {
				});
		}
		else
		{
			swal({
		        title: 'Are you sure to '+status_label+'?',
		        text: 'Once Approve or Reject you cannot undo this step, proceed anyway?',
		        type: 'warning',
		        showCancelButton: true,
		        confirmButtonColor: '#4cbe71',
		        cancelButtonColor: '#d33',
		        confirmButtonText: 'Yes!',
		        cancelButtonText: 'No, cancel!',
		        confirmButtonClass: 'btn btn-success',
		        cancelButtonClass: 'btn btn-danger m-l-10',
		        allowOutsideClick: false
	        
	    	}).then(function() {

				$.ajax({
					type: "POST",
					url: "<?php echo site_url('admin/registration/approval')?>",
					data: dataString,
					dataType: 'json',
					cache: false,
					success: function(response) {
						// console.log("response",response);

		                var msg_title = "Approval Fail!";
		                var msg_content = response.msg;
		                var msg_status = "error";

		                if ( response.rst == 1 )
		                {
		                	msg_title = "Approval Success!";
		                	msg_content = response.msg;
		                	msg_status = "success";
		                }
		                else
		                {
		                	msg_title = "Approval Fail!";
		                	msg_content = response.msg;
		                	msg_status = "error";
		                }

		            	swal({
							title: msg_title,
							html: msg_content,
							type: msg_status,
							allowOutsideClick: false
						}).then(function () {
							location.reload();
						});
					},
					complete: function(){
					}
				});
			});
	    }
	});

});	
	
</script>