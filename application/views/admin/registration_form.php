<?php
	
	$required_field = '';

	$registration_id_enc = '';
	$member_id_enc = '';

	$readonly = 'readonly';
	$disabled = 'disabled';

	if ( isset($registration_data) && is_object($registration_data) && !empty($registration_data) )
	{
		$registration_id = $registration_data->registration_id;
		$registration_id_enc = encryptor('encrypt',$registration_id);
		$member_id = $registration_data->member_id;
		$member_id_enc = encryptor('encrypt',$member_id);

		$readonly = 'readonly';
		$disabled = 'disabled';
	}

	pre($registration_data);
?>

<style>
</style>

<div class="row">
	<div class="col-12">
	    <div class="page-title-box">
	        <h4 class="page-title float-left">Registration Details</h4>

	        <ol class="breadcrumb float-right">
	            <li class="breadcrumb-item"><a href="<?=site_url('admin/registration');?>">Registration</a></li>
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
				                    <input type="text" name="name" id="name" parsley-trigger="change" <?=$required_field;?> <?=$readonly;?> placeholder="Name" class="form-control input-sm turn_uppercase" value="" />
				                </div>
				                <div class="form-group">
				                    <label for="icno">IC No <?=STARFIELD;?></label>
				                    <input type="text" name="icno" id="icno" parsley-trigger="change" <?=$required_field;?> <?=$readonly;?> placeholder="IC No" class="form-control input-sm mask_nric" value="" />
				                </div> 
				                <div class="form-group">
				                    <label for="contactno_mobile">HP No <?=STARFIELD;?></label>
				                    <input type="text" name="contactno_mobile" id="contactno_mobile" parsley-trigger="change" <?=$required_field;?> <?=$readonly;?> placeholder="HP No" class="form-control input-sm mask_phone" value="" />
				                </div>
				            </div>

				            <div class="col-md-6">
				               <div class="form-group">
				                    <label for="email">Email Address</label>
				                    <input type="text" name="email" id="email" parsley-trigger="change" <?=$readonly;?> placeholder="Email Address" class="form-control input-sm" value="" />
				                </div>
				                <div class="form-group">
				                    <label for="dob">Date of Birth <?=STARFIELD;?></label>
				                	<input type="text" name="dob" id="datepicker-dob" parsley-trigger="change" <?=$required_field;?> <?=$readonly;?> placeholder="dd/mm/yyyy" class="form-control input-sm" value="" />
				                </div>       
				                <div class="form-group">
				                    <label for="contactno_home">Home Tel No</label>
				                    <input type="text" name="contactno_home" id="contactno_home" parsley-trigger="change" <?=$readonly;?> placeholder="Home Tel No" class="form-control input-sm mask_phone" value="" />
				                </div>
				            </div>

				            <div class="col-md-12">
				                <div class="form-group">
				                    <label for="home_address">Address - Home <?=STARFIELD;?></label>
				                    <textarea name="home_address" id="home_address" rows="5" style="resize: none; margin-top: 0px; margin-bottom: 0px; height: 100px; " parsley-trigger="change" <?=$required_field;?> <?=$readonly;?> placeholder="Address - Home" class="form-control input-sm turn_uppercase"></textarea>
				                </div>
				            </div>

				            <div class="col-md-4">
				               <div class="form-group">
				                    <label for="home_postcode">Postcode <?=STARFIELD;?></label>
				                    <input type="text" name="home_postcode" id="home_postcode" parsley-trigger="change" <?=$required_field;?> <?=$readonly;?> placeholder="Postcode" class="form-control input-sm turn_uppercase" value="" />
				                </div>
				            </div>

				            <div class="col-md-4">    
				                <div class="form-group">
				                    <label for="home_city">City <?=STARFIELD;?></label>
				                    <input type="text" name="home_city" id="home_city" parsley-trigger="change" <?=$required_field;?> <?=$readonly;?> placeholder="City" class="form-control input-sm turn_uppercase" value="" />
				                </div>
				            </div>

				            <div class="col-md-4">    
				                <div class="form-group">
				                    <label for="home_state">State <?=STARFIELD;?></label>
				                     <input type="text" name="home_state" id="home_state" parsley-trigger="change" <?=$required_field;?> <?=$readonly;?> placeholder="State" class="form-control input-sm turn_uppercase" value="" />
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
				                    <input type="text" name="job_position" id="job_position" parsley-trigger="change" <?=$readonly;?> placeholder="Current Post" class="form-control input-sm turn_uppercase" value="" />
				                </div>
				            </div>

				            <div class="col-md-6">
					 			<div class="form-group">
				                    <label for="contactno_office">Office Tel No</label>
				                    <input type="text" name="contactno_office" id="contactno_office" parsley-trigger="change" <?=$readonly;?> placeholder="Office Tel No" class="form-control input-sm mask_phone" value="" />
				                </div>
				            </div>

							<div class="col-md-12">    
				                <div class="form-group">
				                    <label for="office_address">Address - Office</label>
				                    <textarea name="office_address" id="office_address" rows="5" style="resize: none; margin-top: 0px; margin-bottom: 0px; height: 100px; " parsley-trigger="change" <?=$readonly;?> placeholder="Address - Office" class="form-control input-sm turn_uppercase"></textarea>
				                </div>
				            </div>

				            <div class="col-md-4">
				               <div class="form-group">
				                    <label for="office_postcode">Postcode</label>
				                    <input type="text" name="office_postcode" id="office_postcode" parsley-trigger="change" <?=$readonly;?> placeholder="Postcode" class="form-control input-sm turn_uppercase" value="" />
				                </div>
				            </div>

				            <div class="col-md-4">    
				                <div class="form-group">
				                    <label for="office_city">City</label>
				                    <input type="text" name="office_city" id="office_city" parsley-trigger="change" <?=$readonly;?> placeholder="City" class="form-control input-sm turn_uppercase" value="" />
				                </div>
				            </div>

				            <div class="col-md-4">    
				                <div class="form-group">
				                    <label for="office_state">State</label>
				                    <input type="text" name="office_state" id="office_state" parsley-trigger="change" <?=$readonly;?> placeholder="State" class="form-control input-sm turn_uppercase" value="" />
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
                        <p>dd</p>
                    </div>
                    <!-- end tab_4 -->

                    <div class="tab-pane" id="tab_5">
                        <p>ee</p>
                    </div>
                    <!-- end tab_5 -->
                </div>

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
		success: function(data) {
			console.log("data",data);
			$('.tbody_qualification').html(data); 
		},
		complete: function(){
		}
	});
}

$(function(){
	
	get_qualification_details();

});	
	
</script>