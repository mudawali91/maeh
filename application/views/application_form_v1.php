<?php

	$sess_ticket_category_id = '';
	$sess_league_category_id = '';
	$sess_game_date = '';
	$sess_game_id = '';
	$sess_qty_adult = '';
	$sess_qty_child = '';
	
	$sess_fullname = '';
	$sess_nric = '';
	$sess_email = '';
	$sess_mobile_telno = '';
	$sess_address = '';
	$sess_city = '';
	$sess_postal_code = '';
	$sess_state_id = '';
	$sess_customer_agree = '';

	$required_field = '';
	
?>

<script src="<?=base_url()?>assets/js/jquery.inputmask.bundle.js" type="text/javascript"></script>

<script type="text/javascript">

$(function() {
	
	$(".mask_phone").inputmask({"mask": "+609999999999"});
	$(".mask_nric").inputmask({"mask": "999999-99-9999"});

	$('.turn_uppercase').keyup( function(e){
		$(this).val($(this).val().toUpperCase());
	});
	
	$('.input_integer').keyup( function(e){
		//enable numeric input only
		this.value=this.value.replace(/[^\d]/g, '');
	});

	$('.input_decimal').keyup( function(e){
		//enable numeric input only
		this.value=this.value.replace(/[^\d.]/g, '');
	});
	
	$('#datepicker-applicant_dob').datepicker({
		format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
        endDate: '+0d',
		
    }).on('changeDate', function(e) {
        // `e` here contains the extra attributes
    });


    $('#datepicker-study_start_date').datepicker({
		format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
        startDate: '+0d',
		
    }).on('changeDate', function(e) {
        // `e` here contains the extra attributes
    });

	$('.race').on('click', function() {
	  	var race_id = $(this).attr("value");

	  	if ( race_id == -1 )
	  	{
	  		$(".race_other_input").show();
	  	}
	  	else
	  	{
	  		$(".race_other_input").hide();
	  	}
	});

	$('.institution').on('click', function() {
	  	var institution_id = $(this).attr("value");

	  	if ( institution_id == -1 )
	  	{
	  		if ( $(this).prop("checked") == false )
	  		{

	  			$(".institution_other_input").hide();
	  		}
	  		else
	  		{
	  			$(".institution_other_input").show();
	  		}
	  	}
	});

	$('.course').on('click', function() {
	  	var course_id = $(this).attr("value");

	  	if ( course_id == -1 )
	  	{
	  		if ( $(this).prop("checked") == false )
	  		{

	  			$(".course_other_input").hide();
	  		}
	  		else
	  		{
	  			$(".course_other_input").show();
	  		}
	  	}
	});

	//set default previous qualification
	$('.previous_qualification:first').trigger('click');
	// $(":radio[name='qualification_id'][value='1']").attr('checked', 'checked');

	$('.previous_qualification').on('click', function() {
	  	var qualification_id = $(this).attr("value");

		// $("#area_previous_result").html('');
		// $("#area_previous_institution").html('');

	  	if ( qualification_id == 1 )
	  	{
	  		$("#area_qualification_1").show();
	  		$("#area_qualification_2").hide();

	  		// $("#area_previous_result").html('<label for="previous_result">SPM result <?=STARFIELD;?></label><input type="text" name="previous_result" id="previous_result" parsley-trigger="change" <?=$required_field;?> placeholder="SPM result" class="form-control turn_uppercase" />');

	  		// $("#area_previous_institution").html('<label for="previous_institution">Which Secondary School did you attend? <?=STARFIELD;?></label><input type="text" name="previous_institution" id="previous_institution" parsley-trigger="change" <?=$required_field;?> placeholder="Which Secondary School did you attend?" class="form-control turn_uppercase" />');
	  	}
	  	else
	  	{
	  		$("#area_qualification_1").hide();
	  		$("#area_qualification_2").show();
	  		// $("#area_previous_result").html('<label for="previous_result">CGPA result <?=STARFIELD;?></label><input type="text" name="previous_result" id="previous_result" parsley-trigger="change" <?=$required_field;?> placeholder="CGPA result" class="form-control input_decimal" />');

	  		// $("#area_previous_institution").html('<label for="previous_institution">Which college or university did you attend? <?=STARFIELD;?></label><input type="text" name="previous_institution" id="previous_institution" parsley-trigger="change" <?=$required_field;?> placeholder="Which college or university did you attend?" class="form-control turn_uppercase" />');
	  	}
	});

	// Override defaults
    $.fn.stepy.defaults.legend = false;
    $.fn.stepy.defaults.transition = 'fade';
    $.fn.stepy.defaults.duration = 200;
    $.fn.stepy.defaults.backLabel = '<i class="mdi mdi-arrow-left-bold"></i> Back';
    $.fn.stepy.defaults.nextLabel = 'Next <i class="mdi mdi-arrow-right-bold"></i>';

	$("#custom-wizard").stepy({
		// titleClick: true,
        next: function(index) {
        },
        back: function(index) {
        },
		finish: function() {
        }
    });   

    // Apply "Back" and "Next" button styling
    $('.stepy-navigator').find('.button-next').addClass('btn btn-default');
    $('.stepy-step').find('.button-back').addClass('btn btn-default pull-left'); 

    /*
	var ticket_category_id = $("#ticket_category_id").val();
	var category_id = $("#category_id").val();
	var game_date = $("#game_date").val();
	var game_id = $("#game_id").val();
	var qty_adult = $("#qty_adult").val();
	var qty_child = $("#qty_child").val();
	var total_available = parseInt($(".total_available").text());
	var customer_fullname = $("#customer_fullname").val();
	var customer_nric = $("#customer_nric").val();
	var customer_nric_raw = customer_nric.replace(/_/g, ''); //replace underscore with space
	var customer_email = $("#customer_email").val();
	var customer_mobile_telno = $("#customer_mobile_telno").val();
	var customer_agree = $('#customer_agree').prop('checked');
		
		
	if ( qty_adult == "" || qty_adult == 0 || qty_adult == null || qty_adult == undefined )
	{
		qty_adult = 0;
	}
	
	if ( qty_child == "" || qty_child == 0 || qty_child == null || qty_child == undefined )
	{
		qty_child = 0;
	}
	
	if ( total_available == "" || total_available == 0 || total_available == null || total_available == undefined )
	{
		total_available = 0;
	}

	if ( customer_agree == true )
	{
		customer_agree = 1;
	}
	else
	{
		customer_agree = 0;
	}
	
	var error_msg = '';
	var msg_title = '';
	var msg_content = '';
	var msg_status = '';
		
	if ( customer_fullname == "" )
	{
		error_msg += "<li>Full Name as in NRIC</li>";
	}
	
	// if ( customer_nric == "" )
	// {
		// error_msg += "<li>IC No</li>";
	// }
	
	// if ( customer_nric_raw.length < 14 || customer_nric_raw.length > 15 )
	// {
		// error_msg += "<li>IC No should be in the right format</li>";
	// }
	
	if ( customer_email == "" )
	{
		error_msg += "<li>Email</li>";
	}
	else 
	{
		if( /(.+)@(.+){2,}\.(.+){2,}/.test(customer_email) )
		{
		 // error_msg += "<li>Valid Email</li>";
		} 
		else 
		{
			error_msg += "<li>Invalid Email</li>";
		}
	}
	
	if ( customer_mobile_telno == "" )
	{
		error_msg += "<li>Handphone Tel No</li>";
	}
	
	if ( customer_mobile_telno.length < 12 || customer_mobile_telno.length > 13 )
	{
		error_msg += "<li>Handphone Tel No should be between 12 to 13 digits</li>";
	}
	if ( customer_agree == 0 )
	{
		error_msg += "<li>Terms & Conditions Agreement</li>";
	}
	
	if ( error_msg == "" )
	{
	}
	else
	{
		msg_title = 'Please Enter All Compulsory Field!';
		msg_content = "<ol style='font-size:12px; font-weight: bold; color: #f96a74; text-align: left;'>"+error_msg+"</ol>";
		msg_status = 'error';
		
		swal({
			title: msg_title,
			text: msg_content,
			type: msg_status,
			allowOutsideClick: false
		}).then(function () {
			
		});
		
		return false;
	}
	*/
});

function goto_SyncID(field_id) 
{
	var data_value = $('option:selected', "#"+field_id).attr('data-value');
	var data_name = $('option:selected', "#"+field_id).attr('data-name');
	
	if (data_value == null || data_value == "null" || data_value == "" || data_value == undefined || data_value == "undefined") 
	{
		$("#"+data_name).val("");
	} 
	else 
	{
		$("#"+data_name).val(data_value);
	}
}

</script>

<style>
.datepicker table tr td.disabled
{
	color: #e2e2e2 !important;
}
.thumb-lg
{
	height: 300px !important;
	width: 195px !important;
}
.bootstrap-touchspin .input-group-btn-vertical>.btn
{
	padding: 9px 10px !important;
}
.vertical-spin
{
	border-radius: 4px 0 0 4px !important;
}
.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th
{
	padding: 5px 10px !important;
}
.btn_qty
{
	border-color: transparent !important;
}
.btn_qty_minus
{
	border: 1px solid #d6d8da !important;
	border-radius: 4px 0 0 4px !important;
}
.btn_qty_add
{
	border: 1px solid #d6d8da !important;
	border-radius: 0 4px 4px 0 !important;
}
.default_hide
{
	display:none;
}
</style>

<div class="row">
    <div class="col-xs-12">
		<?php
		/*
        <div class="page-title-box">
            <h4 class="page-title">Dashboard</h4>
            <ol class="breadcrumb p-0 m-0">
                <li>
                    <a href="#">Home</a>
                </li>
                <li class="active">
                    Dashboard
                </li>
            </ol>
            <div class="clearfix"></div>
        </div>
		*/ 
		?>
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-lg-12">

        <div class="card-box">
            <!--<h4 class="header-title m-t-0">Application Form</h4>-->
            
            <div class="panel panel-default">
  				<div class="panel-heading" style="background-color: #e2e2e2 !important;"><h4 style="color:#000000 !important;">Scholarship Details</h4></div>
   				<div class="panel-body">
		            <p class="font-14 m-b-5">
		            	The SENHENG EDUCATION ASSISTANCE (SEA) PROGRAMME is founded to support and benefit talented students facing financial hardship from Malaysia to fulfil their dreams of pursuing higher education.
		            </p>
		  			<p class="font-14 m-b-5">
		          	  	The SEA Programme will benefit the successful applicant a total sum of RM20,000.
						<br />Successful applicants will be employed by Senheng for 3 (three) years commencing upon completion of their study.
						<br />Successful applicants will be employed by Senheng as Interns during the semester breaks of their study.
		            </p>
		  			<p class="font-14 m-b-5">
		  				To be considered for the SEA Programme, the criteria are as follows:
		  				<ol>
		  					<li>The applicant must not be older than 25 years of age</li>
		  					<li>The applicant must possess admirable academic records</li>
		  					<li>The applicant must demonstrate achievements in extra co-curricular activities and/or participation in volunteer activities</li>
		  					<li>The combined income of the household must not exceed RM50,000</li>
		  					<li>The intended education institution and course of study shall be limited by Senheng, and the applicant must select from the list in the application form.</li>
		  				</ol>
		            </p>
		            <p class="font-14 m-b-5">
		  				To apply for the SEA Programme, please fill in the application form in the next page and attach the following documents:
		  				<ol>
		  					<li>SPM and Diploma/Pre-U (for Degree applicants) and Degree (for Masters applicants)</li>
		  					<li>Malaysia I/C back and front copy</li>
		  					<li>Any letters of recommendation, certificates of achievement, or any supporting documents that will benefit your application</li>
		  					<li>Proof of income of both parents</li>
		  				</ol>
		            </p>
		            <p class="font-14 m-b-5">
		            	Applications with incomplete form or documents will not be considered. The full Terms & Conditions of the SEA Programme can be obtained upon request.
		            </p>
		        </div>    
       		</div>

			<p class="text-danger m-b-30 font-13">
				<em>(*) Compulsory Field</em>
			</p>

			<form id="custom-wizard" name="form-wizard-clickable" action="<?=site_url("application-submit"); ?>" method="post" enctype="multipart/form-data">

				<fieldset title="1">

					<legend>Applicant Information</legend>

					<div class="row m-t-10">
						<div class="col-md-6">
			                <div class="form-group">
			                    <label for="applicant_name">Full Name <?=STARFIELD;?></label>
			                    <input type="text" name="applicant_name" id="applicant_name" parsley-trigger="change" <?=$required_field;?> placeholder="Full Name" class="form-control turn_uppercase" />
			                </div>
			                <div class="form-group">
			                    <label for="applicant_dob">Date of Birth <?=STARFIELD;?></label>
			                	<input type="text" name="applicant_dob" id="datepicker-applicant_dob" parsley-trigger="change" <?=$required_field;?> placeholder="dd/mm/yyyy" class="form-control" />
			                </div>
			                <div class="form-group">
			                    <label for="applicant_icno">IC Number <?=STARFIELD;?></label>
			                    <input type="text" name="applicant_icno" id="applicant_icno" parsley-trigger="change" <?=$required_field;?> placeholder="IC Number" class="form-control mask_nric" />
			                </div>
			                <div class="form-group">
			                    <label for="applicant_phoneno">Phone Number <?=STARFIELD;?></label>
			                    <input type="text" name="applicant_phoneno" id="applicant_phoneno" parsley-trigger="change" <?=$required_field;?> placeholder="Phone Number" class="form-control mask_phone" />
			                </div>
			                <div class="form-group">
			                    <label for="applicant_email">Email Address <?=STARFIELD;?></label>
			                    <input type="email" name="applicant_email" id="applicant_email" parsley-trigger="change" <?=$required_field;?> placeholder="Email Address" class="form-control" />
			                </div>
			                <div class="form-group">
			                    <label for="applicant_permanent_address">Permanent Address <?=STARFIELD;?></label>
			                    <textarea name="applicant_permanent_address" id="applicant_permanent_address" rows="5" style="resize: none; margin-top: 0px; margin-bottom: 0px; height: 100px; " parsley-trigger="change" <?=$required_field;?> placeholder="Permanent Address" class="form-control turn_uppercase"></textarea>
			                </div>

			                <div class="form-group">
			                    <label for="applicant_race">Race <?=STARFIELD;?></label>
			                    <?php
			                    	$race_type_arrlist = array(1=>'Malay', 'Chinese', 'Indian');
			                    	$race_type_other = -1;

			                    	foreach ( $race_type_arrlist as $race_type_keys => $race_type_list )
			                    	{
			                    ?>
				                    <div class="radio radio-success">
			                            <input type="radio" id="race_id_<?=$race_type_keys;?>" name="race_id" class="custom-control-input race" value="<?=$race_type_keys;?>" />
			                            <label class="custom-control-label" for="race_id_<?=$race_type_keys;?>"><?=$race_type_list;?></label>
			                        </div>
			                    <?php
			                    	}
		                  		?>
		                        <div class="radio radio-success">
		                            <input type="radio" id="race_id_<?=$race_type_other;?>" name="race_id" class="custom-control-input race" value="<?=$race_type_other;?>" />
		                            <label class="custom-control-label" for="race_id_<?=$race_type_other;?>">Other</label>
		                        </div>

				                <div class="form-group race_other_input default_hide">
				                    <input type="text" name="race_other" id="race_other" parsley-trigger="change" <?=$required_field;?> placeholder="Please State Other Race" class="form-control turn_uppercase" />
				                </div>
			                </div>

			                <div class="form-group">
			                    <label for="qualification_id">Previous Qualifications <?=STARFIELD;?></label>
			                    <?php
			                    	$qualification_arrlist = array(1=>'SPM', 'Pre-University', 'Diploma', 'Degree');

			                    	foreach ( $qualification_arrlist as $qualification_keys => $qualification_list )
			                    	{
			                    ?>
				                    <div class="radio radio-success">
			                            <input type="radio" id="qualification_id_<?=$qualification_keys;?>" name="qualification_id" class="custom-control-input previous_qualification" value="<?=$qualification_keys;?>" />
			                            <label class="custom-control-label" for="qualification_id_<?=$qualification_keys;?>"><?=$qualification_list;?></label>
			                        </div>
			                    <?php
			                    	}
		                  		?>
			                </div>

			                <div id="area_qualification_1">
				                <div class="form-group" id="area_previous_result">
				                	<label for="previous_result">SPM result <?=STARFIELD;?></label><input type="text" name="previous_result" id="previous_result" parsley-trigger="change" <?=$required_field;?> placeholder="SPM result" class="form-control turn_uppercase" />
				                </div> 
				                <div class="form-group" id="area_previous_institution">
				                	<label for="previous_institution">Which Secondary School did you attend? <?=STARFIELD;?></label><input type="text" name="previous_institution" id="previous_institution" parsley-trigger="change" <?=$required_field;?> placeholder="Which Secondary School did you attend?" class="form-control turn_uppercase" />
				                </div>
				            </div>

				            <div id="area_qualification_2" class="default_hide">
				                <div class="form-group" id="area_previous_result">
				                	<label for="previous_result">CGPA result <?=STARFIELD;?></label><input type="text" name="previous_result" id="previous_result" parsley-trigger="change" <?=$required_field;?> placeholder="CGPA result" class="form-control input_decimal" />
				                </div> 
				                <div class="form-group" id="area_previous_institution">
				                	<label for="previous_institution">Which college or university did you attend? <?=STARFIELD;?></label><input type="text" name="previous_institution" id="previous_institution" parsley-trigger="change" <?=$required_field;?> placeholder="Which college or university did you attend?" class="form-control turn_uppercase" />
				                </div>
				            </div>

			                <div class="form-group">
			                    <label for="household_income">What is your household combined income? <?=STARFIELD;?></label>
			                    <input type="text" name="household_income" id="household_income" parsley-trigger="change" <?=$required_field;?> placeholder="What is your household combined income?" class="form-control input_decimal" />
			                </div>
			            </div>
				 		<!-- end col-md-6 --> 

			            <div class="col-md-6">
			                <div class="form-group">
			                    <label for="institution_id">Which Education Institution of Study are you interested in? <?=STARFIELD;?></label>
								<?php
			                    	$institution_other = -1;

			                    	foreach ( $institution_arrlist as $institution_list )
			                    	{
			                    		$institution_id = $institution_list->institution_id;
										$institution_name = $institution_list->institution_name;
			                    ?>
				                  	<div class="checkbox checkbox-success">
			                            <input type="checkbox" class="custom-control-input institution" id="institution_id_<?=$institution_id;?>" name="institution_id" value="<?=$institution_id;?>" />
			                            <label class="custom-control-label" for="institution_id_<?=$institution_id;?>"><?=$institution_name;?></label>
			                        </div>
			                    <?php
			                    	}
			                    ?>	
		                        <div class="checkbox checkbox-success">
		                            <input type="checkbox" class="custom-control-input institution" id="institution_id_<?=$institution_other;?>" name="institution_id" value="<?=$institution_other;?>" />
		                            <label class="custom-control-label" for="institution_id_<?=$institution_other;?>">Other</label>
		                        </div>    
			                     <div class="form-group institution_other_input default_hide">
				                    <input type="text" name="institution_other" id="institution_other" parsley-trigger="change" <?=$required_field;?> placeholder="Please State Other Institution" class="form-control turn_uppercase" />
				                </div>
			                </div>

			                <div class="form-group">
			                    <label for="course_id">Which Course of Study are you interested in? <?=STARFIELD;?></label>
								<?php
			                    	$course_other = -1;

			                    	foreach ( $course_arrlist as $course_list )
			                    	{
			                    		$course_id = $course_list->course_id;
										$course_name = $course_list->course_name;
			                    ?>
				                  	<div class="checkbox checkbox-success">
			                            <input type="checkbox" class="custom-control-input course" id="course_id_<?=$course_id;?>" name="course_id" value="<?=$course_id;?>" />
			                            <label class="custom-control-label" for="course_id_<?=$course_id;?>"><?=$course_name;?></label>
			                        </div>
			                    <?php
			                    	}
			                    ?>	
		                        <div class="checkbox checkbox-success">
		                            <input type="checkbox" class="custom-control-input course" id="course_id_<?=$course_other;?>" name="course_id" value="<?=$course_other;?>" />
		                            <label class="custom-control-label" for="course_id_<?=$course_other;?>">Other</label>
		                        </div>    
			                     <div class="form-group course_other_input default_hide">
				                    <input type="text" name="course_other" id="course_other" parsley-trigger="change" <?=$required_field;?> placeholder="Please State Other Course" class="form-control turn_uppercase" />
				                </div>
			                </div>

			                 <div class="form-group">
			                    <label for="study_level_id">Intended Level of Study <?=STARFIELD;?></label>
			                    <?php
			                    	$study_level_arrlist = array(1=>'Degree', 'Masters');

			                    	foreach ( $study_level_arrlist as $study_level_keys => $study_level_list )
			                    	{
			                    ?>
				                    <div class="radio radio-success">
			                            <input type="radio" id="study_level_id_<?=$study_level_keys;?>" name="study_level_id" class="custom-control-input race" value="<?=$study_level_keys;?>" />
			                            <label class="custom-control-label" for="study_level_id_<?=$study_level_keys;?>"><?=$study_level_list;?></label>
			                        </div>
			                    <?php
			                    	}
		                  		?>
			                </div>

			                <div class="form-group">
			                    <label for="course_duration">Duration of Course (months) <?=STARFIELD;?></label>
			                    <input type="text" name="course_duration" id="course_duration" parsley-trigger="change" <?=$required_field;?> placeholder="Duration of Course (months)" class="form-control input_integer" />
			                </div>

			                <div class="form-group">
			                    <label for="study_start_date">Intended Start Date <?=STARFIELD;?></label>
			                	<input type="text" name="study_start_date" id="datepicker-study_start_date" parsley-trigger="change" <?=$required_field;?> placeholder="dd/mm/yyyy" class="form-control" />
		                    </div> 
			            </div>
				 		<!-- end col-md-6 --> 
		        	</div>
				 	<!-- end row m-t-10 --> 
				</fieldset>
				 <!-- end fieldset applicant_info --> 

				<fieldset title="2">
					
					<legend>Attachment</legend>

					<div class="row m-t-10">
						<div class="col-md-6">
			                <div class="form-group">
								<label for="attachment_qualification">Previous Qualification Result Certificates <?=STARFIELD;?></label>
		                        <input type="file" id="attachment_qualification" name="attachment_qualification" parsley-trigger="change" <?=$required_field;?> class="form-control" multiple="multiple" />
								<span class="help-block text-info">
									<small id="attachment_qualification_description">
										[Allowed types: jpg, png, gif, pdf]<br />
										[Allowed size: < 2MB]
									</small>
								</span>
		                    </div>

		                     <div class="form-group">
								<label for="attachment_ic">Malaysia IC (Front and Back) <?=STARFIELD;?></label>
		                        <input type="file" id="attachment_ic" name="attachment_ic" parsley-trigger="change" <?=$required_field;?> class="form-control" multiple="multiple" />
								<span class="help-block text-info">
									<small id="attachment_ic_description">
										[Allowed types: jpg, png, gif, pdf]<br />
										[Allowed size: < 2MB]
									</small>
								</span>
		                    </div>

		                     <div class="form-group">
								<label for="attachment_household_income">Household Proof of Income <?=STARFIELD;?></label>
		                        <input type="file" id="attachment_household_income" name="attachment_household_income" parsley-trigger="change" <?=$required_field;?> class="form-control" multiple="multiple" />
								<span class="help-block text-info">
									<small id="attachment_household_income_description">
										[Allowed types: jpg, png, gif, pdf]<br />
										[Allowed size: < 2MB]
									</small>
								</span>
		                    </div>
		                </div>
				 		<!-- end col-md-6 --> 
		                
		                <div class="col-md-6">    
		                     <div class="form-group">
								<label for="attachment_certificate">Other Relevant Certificates</label>
		                        <input type="file" id="attachment_certificate" name="attachment_certificate" parsley-trigger="change" class="form-control" multiple="multiple" />
								<span class="help-block text-info">
									<small id="aattachment_certificate_description">
										[Allowed types: jpg, png, gif, pdf]<br />
										[Allowed size: < 2MB]
									</small>
								</span>
		                    </div>

		                     <div class="form-group">
								<label for="attachment_rec_letter">Recommendation Letter</label>
		                        <input type="file" id="attachment_rec_letter" name="attachment_rec_letter" parsley-trigger="change" class="form-control" multiple="multiple" />
								<span class="help-block text-info">
									<small id="attachment_rec_letter_description">
										[Allowed types: jpg, png, gif, pdf]<br />
										[Allowed size: < 2MB]
									</small>
								</span>
		                    </div>

				            <div class="checkbox checkbox-success">
			                    <input type="checkbox" class="custom-control-input" id="application_agreement" name="application_agreement" value="1" />
			                    <label class="custom-control-label" for="application_agreement">I acknowledge the details above are correct and accurate as the date of submission</label>
			                </div> 
			            </div>	
				 		<!-- end col-md-6 --> 
			        </div>
				 	<!-- end row m-t-10 --> 
				</fieldset>
                <!-- end fieldset applicant_attachment --> 

                <button type="submit" id="btn_submit" name="btn_submit"  class="btn btn-success stepy-finish waves-effect waves-light">Submit</button>

            </form>
        </div> <!-- end card-box -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->