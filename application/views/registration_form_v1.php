<?php
	$sess_applicant_name				= '';
	$sess_applicant_dob 				= ''; 
	$sess_applicant_icno 				= ''; 
	$sess_applicant_phoneno 			= ''; 
	$sess_applicant_email 				= ''; 
	$sess_applicant_permanent_address	= '';
	$sess_race_id 						= '';
	$sess_applicant_race 				= '';
	$sess_institution_id 				= ''; 
	$sess_institution 					= ''; 
	$sess_course_id 					= ''; 
	$sess_course 						= '';
	$sess_course_duration 				= ''; 
	$sess_study_level_id				= '';
	$sess_study_level					= '';
	$sess_study_start_date 				= ''; 
	$sess_qualification_id 				= ''; 
	$sess_qualification 				= ''; 
	$sess_previous_result 				= ''; 
	$sess_previous_institution 			= ''; 
	$sess_household_income 				= '';
	$sess_application_agreement 		= '';

	$required_field = '';

	// pre($_SESSION);

	$sess_institution_id_arr = array();
	$sess_institution_name_arr = array();
	$sess_institution_arr = array();

	$sess_course_id_arr = array();
	$sess_course_name_arr = array();
	$sess_course_arr = array();

	// field value return from session
	if ( isset($_SESSION['data_application']) && count($_SESSION['data_application']) > 0 ) {
		
		foreach( $_SESSION['data_application'] as $keys => $values)
		{
			//#replace keys as variable
			$$keys = $values;

			// set as array
			if ( $keys == 'sess_institution_id' )
			{
				$sess_institution_id_arr = explode("|", $values);
			}

			if ( $keys == 'sess_institution' )
			{
				$sess_institution_name_arr = explode("|", $values);
			}

			if ( $keys == 'sess_course_id' )
			{
				$sess_course_id_arr = explode("|", $values);
			}

			if ( $keys == 'sess_course' )
			{
				$sess_course_name_arr = explode("|", $values);
			}
		}
		
	}

	// set id as key and name as value fro institution
	if ( count($sess_institution_id_arr) == count($sess_institution_name_arr) )
	{	
		$sess_institution_arr = array_combine($sess_institution_id_arr, $sess_institution_name_arr);
	}

	// set id as key and name as value for course
	if ( count($sess_course_id_arr) == count($sess_course_name_arr) )
	{	
		$sess_course_arr = array_combine($sess_course_id_arr, $sess_course_name_arr);
	}

	// validation error message
	$validation_error_exist = 0;
	$validation_notis_title = "";
	$validation_notis_msg = "";

	if ( isset($_SESSION['data_errormsg']) && count($_SESSION['data_errormsg']) > 0 ) {
		$validation_notis_title = $_SESSION['data_errormsg']['notis_title'];
		$validation_notis_msg = $_SESSION['data_errormsg']['notis_msg'];

		if ( !empty($validation_notis_msg) )
		{
			$validation_error_exist = 1;
		}
	}
	
?>

<script src="<?=base_url()?>assets/js/jquery.inputmask.bundle.js" type="text/javascript"></script>

<script type="text/javascript">

$(function() {

	var validation_error_exist = <?=$validation_error_exist;?>;

	if ( validation_error_exist != "" )
	{
		$("#area_error_message").show();

		// focus to this area if got error
	 	$('html, body').animate({
	        scrollTop: $("#area_error_message").offset().top
	    }, 1000);
	}
	else
	{
		$("#area_error_message").hide();
	}

	
	$(".mask_phone").inputmask({"mask": "+609999999999"});
	$(".mask_nric").inputmask({"mask": "999999-99-9999"});

	$('.turn_uppercase').keyup( function(e){
		$(this).val($(this).val().toUpperCase());
	});
	
	$('.input_integer').keyup( function(e){
		//enable numeric integer input only
		this.value=this.value.replace(/[^\d]/g, '');
	});

	$('.input_decimal').keyup( function(e){
		//enable numeric decimal input only
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

    // set race data grabbed from db
    if ( $("#race_id_-1").prop("checked") == true )
    {
	  	$(".race_other_input").show();
    }
    else
    {
	  	$(".race_other_input").hide();
    }

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

	// set institution data grabbed from db
    // var sess_institution_id_arr = <?php echo json_encode($sess_institution_id_arr); ?>;
    // console.log('sess_institution_id_arr',sess_institution_id_arr.indexOf("-1")); //return -1: not found, > -1: found

    if ( $("#institution_id_-1").prop("checked") == true )
    {
	  	$(".institution_other_input").show();
    }
    else
    {
	  	$(".institution_other_input").hide();
    }


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


	// set course data grabbed from db
    if ( $("#course_id_-1").prop("checked") == true )
    {
	  	$(".course_other_input").show();
    }
    else
    {
	  	$(".course_other_input").hide();
    }

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

	// set qualification data grabbed from db
    var sess_qualification_id = $("input[name='qualification_id']:checked").val();

    if ( sess_qualification_id == undefined || sess_qualification_id == 0 || sess_qualification_id == 1 )
    {
		//set default previous qualification
		$('.previous_qualification:first').trigger('click');
		// $(":radio[name='qualification_id'][value='1']").attr('checked', 'checked');

  		$("#area_qualification_1").show();
  		$("#area_qualification_2").hide();

		$('#area_qualification_1').find('input').prop('disabled',false);
		$('#area_qualification_2').find('input').prop('disabled',true);

		$('#area_qualification_2').find('input').val('');
    }
    else
    {
  		$("#area_qualification_1").hide();
  		$("#area_qualification_2").show();

  		$('#area_qualification_1').find('input').prop('disabled',true);
  		$('#area_qualification_2').find('input').prop('disabled',false);

  		$('#area_qualification_1').find('input').val('');
    }

	$('.previous_qualification').on('click', function() {
	  	var qualification_id = $(this).attr("value");

	  	if ( qualification_id == 1 )
	  	{
	  		$("#area_qualification_1").show();
	  		$("#area_qualification_2").hide();

	  		$('#area_qualification_1').find('input').prop('disabled',false);
	  		$('#area_qualification_2').find('input').prop('disabled',true);

			$('#area_qualification_2').find('input').val('');
	  	}
	  	else
	  	{
	  		$("#area_qualification_1").hide();
	  		$("#area_qualification_2").show();

	  		$('#area_qualification_1').find('input').prop('disabled',true);
	  		$('#area_qualification_2').find('input').prop('disabled',false);

	  		$('#area_qualification_1').find('input').val('');
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

        	//#click on 1st next button
			if ( index == 2 )
			{
				var applicant_name 				= $("#applicant_name").val();
				var applicant_dob 				= $("#datepicker-applicant_dob").val();
				var applicant_icno_temp 		= $("#applicant_icno").val();
				var	applicant_icno  			= applicant_icno_temp.replace(/\_/g, "");
				var applicant_phoneno_temp		= $("#applicant_phoneno").val();
				var	applicant_phoneno 			= applicant_phoneno_temp.replace(/\_/g, "");
				var applicant_email 			= $("#applicant_email").val();
				var applicant_permanent_address = $("#applicant_permanent_address").val();

  				var check_race_id 				= $("input[name='race_id']:checked").val();
  				var check_race_other 			= $("#race_other").val();

  				var check_qualification_id 		= $("input[name='qualification_id']:checked").val();
  				var check_previous_result_q1 	= $("#area_qualification_1 #previous_result").val();
				var check_previous_ins_q1		= $("#area_qualification_1 #previous_institution").val();
  				var check_previous_result_q2 	= $("#area_qualification_2 #previous_result").val();
				var check_previous_ins_q2 		= $("#area_qualification_2 #previous_institution").val();

				var household_income 			= $("#household_income").val();

				var check_institution_id 		= $("input[name='institution_id[]']:checked").length;
				var check_institution_other_id 	= $("#institution_id_-1").prop("checked");
				var check_institution_other 	= $("#institution_other").val();

				var check_course_id 			= $("input[name='course_id[]']:checked").length;
				var check_course_other_id 		= $("#course_id_-1").prop("checked");
				var check_course_other 			= $("#course_other").val();

  				var check_study_level_id		= $("input[name='study_level_id']:checked").val();

				var course_duration 			= $("#course_duration").val();
				var study_start_date 			= $("#datepicker-study_start_date").val();

				var error_msg = '';
				var msg_title = '';
				var msg_content = '';
				var msg_status = '';

				// clear validation error message content
				$("#area_error_message .panel-heading").html('');
				$("#area_error_message .panel-body").html('');

				if ( applicant_name == "" )
				{
					error_msg += "<li>Full Name</li>";
				}

				if ( applicant_dob == "" )
				{
					error_msg += "<li>Date of Birth</li>";
				}

				if ( applicant_icno == "" )
				{
					error_msg += "<li>IC Number</li>";
				}
				else
				{
					if ( applicant_icno.length < 14 || applicant_icno.length > 15 )
					{
						error_msg += "<li>Invalid IC Number format</li>";
					}
				}

				if ( applicant_phoneno == "" )
				{
					error_msg += "<li>Phone Number</li>";
				}
				else
				{
					if ( applicant_phoneno.length < 12 || applicant_phoneno.length > 14 )
					{
						error_msg += "<li>Invalid Phone Number format</li>";
					}
				}

				if ( applicant_email == "" )
				{
					error_msg += "<li>Email Address</li>";
				}
				else 
				{
					if( /(.+)@(.+){2,}\.(.+){2,}/.test(applicant_email) )
					{
					 // error_msg += "<li>Valid Email</li>";
					} 
					else 
					{
						error_msg += "<li>Invalid Email Address format</li>";
					}
				}

				if ( applicant_permanent_address == "" )
				{
					error_msg += "<li>Permanent Address</li>";
				}

				if ( check_race_id == undefined || check_race_id == 0 || check_race_id == "" )
				{
					error_msg += "<li>Race</li>";
				}
				else 
				{
					if ( check_race_id == -1 && check_race_other == "" )
					{
						error_msg += "<li>Other Race</li>";
					}
				}

				if ( check_qualification_id == undefined || check_qualification_id == 0 || check_qualification_id == "" )
				{
					error_msg += "<li>Previous Qualifications</li>";
				}
				else
				{
					if ( check_qualification_id == 1 )
					{
						if ( check_previous_result_q1 == "" )
						{
							error_msg += "<li>SPM result</li>";
						}
						if ( check_previous_ins_q1 == "" )
						{
							error_msg += "<li>Secondary School Attend</li>";
						}
					}
					else 
					{
						if ( check_previous_result_q2 == "" || check_previous_result_q2 == 0 )
						{
							error_msg += "<li>CGPA result</li>";
						}
						if ( check_previous_ins_q2 == "" )
						{
							error_msg += "<li>College or University Attend</li>";
						}
					}
				}

				if ( household_income == 0 || household_income == "" )
				{
					error_msg += "<li>Household Combined Income</li>";
				}

				if ( check_institution_id == undefined || check_institution_id == 0 || check_institution_id == "" )
				{
					error_msg += "<li>Interest Education Institution</li>";
				}
				else
				{
					if ( check_institution_other_id == true )
					{
						if ( check_institution_other == "" )
						{
							error_msg += "<li>Other Interest Education Institution</li>";
						}
					}
				}

				if ( check_course_id == undefined || check_course_id == 0 || check_course_id == "" )
				{
					error_msg += "<li>Interest Course of Study</li>";
				}
				else
				{
					if ( check_course_other_id == true )
					{
						if ( check_course_other == "" )
						{
							error_msg += "<li>Other Interest Course of Study</li>";
						}
					}
				}

				if ( check_study_level_id == undefined || check_study_level_id == 0 || check_study_level_id == "" )
				{
					error_msg += "<li>Intended Level of Study</li>";
				}

				if ( course_duration == "" )
				{
					error_msg += "<li>Duration of Course</li>";	
				}

				if ( study_start_date == "" )
				{
					error_msg += "<li>Intended Start Date</li>";	
				}

				if ( error_msg == "" )
				{
					// clear validation error message content
					$("#area_error_message .panel-heading").html('');
					$("#area_error_message .panel-body").html('');

					$("#area_error_message").hide();
				}
				else
				{
					msg_title = 'Please Enter These Compulsory Field!';
					msg_content = "<ol style='font-size:12px; font-weight: bold; color: #f96a74; text-align: left;'>"+error_msg+"</ol>";
					msg_status = 'error';
					
					// swal({
					// 	title: 'Opss! Some of compulsory field was empty.',
					// 	text: '',
					// 	type: msg_status,
					// 	allowOutsideClick: false
					// }).then(function () {
						
					// });

					// set the new content
					$("#area_error_message .panel-heading").html('<h5 style="color:#000000 !important;">'+msg_title+'</h5>');
					$("#area_error_message .panel-body").html(msg_content);

					$("#area_error_message").show();

					// focus to this area if got error
				 	$('html, body').animate({
				        scrollTop: $("#area_error_message").offset().top
				    }, 1000);
					
					return false;
				}
			}
        },
        back: function(index) {
        },
		finish: function() {

				var attachment_qualification 	= $("#attachment_qualification").val();
				var attachment_ic 				= $("#attachment_ic").val();
				var attachment_household_income = $("#attachment_household_income").val();
				var check_application_agreement = $('#application_agreement').prop('checked');

				var error_msg = '';
				var msg_title = '';
				var msg_content = '';
				var msg_status = '';

				// clear validation error message content
				$("#area_error_message .panel-heading").html('');
				$("#area_error_message .panel-body").html('');

				if ( attachment_qualification == "" )
				{
					error_msg += "<li>Previous Qualification Result Certificates</li>";	
				}

				if ( attachment_ic == "" )
				{
					error_msg += "<li>Malaysia IC (Front and Back)</li>";	
				}

				if ( attachment_household_income == "" )
				{
					error_msg += "<li>Household Proof of Income</li>";	
				}

				if ( check_application_agreement == false )
				{
					error_msg += "<li>Terms & Conditions Agreement</li>";	
				}

				if ( error_msg == "" )
				{
					// clear validation error message content
					$("#area_error_message .panel-heading").html('');
					$("#area_error_message .panel-body").html('');

					$("#area_error_message").hide();
				}
				else
				{
					msg_title = 'Please Enter These Compulsory Field!';
					msg_content = "<ol style='font-size:12px; font-weight: bold; color: #f96a74; text-align: left;'>"+error_msg+"</ol>";
					msg_status = 'error';
					
					// swal({
					// 	title: 'Opss! Some of compulsory field was empty.',
					// 	text: '',
					// 	type: msg_status,
					// 	allowOutsideClick: false
					// }).then(function () {
						
					// });

					// set the new content
					$("#area_error_message .panel-heading").html('<h5 style="color:#000000 !important;">'+msg_title+'</h5>');
					$("#area_error_message .panel-body").html(msg_content);

					$("#area_error_message").show();

					// focus to this area if got error
				 	$('html, body').animate({
				        scrollTop: $("#area_error_message").offset().top
				    }, 1000);
					
					return false;
				}

        }
    });   

    // Apply "Back" and "Next" button styling
    $('.stepy-navigator').find('.button-next').addClass('btn btn-default');
    $('.stepy-step').find('.button-back').addClass('btn btn-default pull-left'); 
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


.panel-heading
{
	padding: 10px 10px 0 10px !important;
}
.panel .panel-body
{
	padding: 10px 10px !important;
}

</style>

<div class="row">
    <div class="col-12">

        <div class="card-box">

        	<div class="text-center">
        		<a href=""><img src="<?=base_url()?>img/logo-maeh-100x100.png" class="img-responsive"></a>
            	<h4 class="m-t-0 text-dark">REGISTRATION FORM</h4>
            	<h5 class="m-t-0 text-dark"><b>PERSATUAN KESIHATAN ENVIRONMEN MALAYSIA</b></h5>
            	<h5 class="m-t-0 text-dark"><b>MALAYSIAN ASSOCIATION OF ENVIRONMENTAL HEALTH (MAEH)</b></h5>
            	<h5 class="m-t-0 text-dark"><b>(REGISTRATION NO: PPM-001-14-14041990)</b></h5>
            	<p class="text-muted m-b-30 font-14">
            	</p>
            </div>
            
            <div class="panel panel-default">
  				<div class="panel-heading" style="background-color: #e2e2e2 !important;">
  					<h6 class="m-t-0 text-dark">Terms & Conditions</h6>
  				</div>
   				<div class="panel-body">
	            	<ul style="margin-bottom: 0 !important;">
	            		<li class="font-12">Malaysian 18 years old and above</li>
	            		<li class="font-12">Stay in Malaysia at least 10 Years</li>
	            	</ul>
		        </div>    
       		</div>

       		<div id="area_error_message" class="panel panel-danger">
  				<div class="panel-heading"><h5 style="color:#000000 !important;"><?=$validation_notis_title;?></h5></div>
  				<div class="panel-body"><?=$validation_notis_msg;?></div>
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
			                    <input type="text" name="applicant_name" id="applicant_name" parsley-trigger="change" <?=$required_field;?> placeholder="Full Name" class="form-control turn_uppercase" value="<?=$sess_applicant_name;?>" />
			                </div>
			                <div class="form-group">
			                    <label for="applicant_dob">Date of Birth <?=STARFIELD;?></label>
			                	<input type="text" name="applicant_dob" id="datepicker-applicant_dob" parsley-trigger="change" <?=$required_field;?> placeholder="dd/mm/yyyy" class="form-control" value="<?=$sess_applicant_dob;?>" />
			                </div>
			                <div class="form-group">
			                    <label for="applicant_icno">IC Number <?=STARFIELD;?></label>
			                    <input type="text" name="applicant_icno" id="applicant_icno" parsley-trigger="change" <?=$required_field;?> placeholder="IC Number" class="form-control mask_nric" value="<?=$sess_applicant_icno;?>" />
			                </div>
			                <div class="form-group">
			                    <label for="applicant_phoneno">Phone Number <?=STARFIELD;?></label>
			                    <input type="text" name="applicant_phoneno" id="applicant_phoneno" parsley-trigger="change" <?=$required_field;?> placeholder="Phone Number" class="form-control mask_phone" value="<?=$sess_applicant_phoneno;?>" />
			                </div>
			                <div class="form-group">
			                    <label for="applicant_email">Email Address <?=STARFIELD;?></label>
			                    <input type="text" name="applicant_email" id="applicant_email" parsley-trigger="change" <?=$required_field;?> placeholder="Email Address" class="form-control" value="<?=$sess_applicant_email;?>" />
			                </div>
			                <div class="form-group">
			                    <label for="applicant_permanent_address">Permanent Address <?=STARFIELD;?></label>
			                    <textarea name="applicant_permanent_address" id="applicant_permanent_address" rows="5" style="resize: none; margin-top: 0px; margin-bottom: 0px; height: 100px; " parsley-trigger="change" <?=$required_field;?> placeholder="Permanent Address" class="form-control turn_uppercase"><?=$sess_applicant_permanent_address;?></textarea>
			                </div>

			                <div class="form-group">
			                    <label for="applicant_race">Race <?=STARFIELD;?></label>
			                    <?php
			                    	$race_type_other = -1;

			                    	foreach ( $race_type_arrlist as $race_type_keys => $race_type_list )
			                    	{
			                    ?>
				                    <div class="radio radio-success">
			                            <input type="radio" id="race_id_<?=$race_type_keys;?>" name="race_id" class="custom-control-input race" value="<?=$race_type_keys;?>" <?=( $sess_race_id == $race_type_keys ? 'checked' : '' ); ?> />
			                            <label class="custom-control-label" for="race_id_<?=$race_type_keys;?>"><?=$race_type_list;?></label>
			                        </div>
			                    <?php
			                    	}
		                  		?>
		                        <div class="radio radio-success">
		                            <input type="radio" id="race_id_<?=$race_type_other;?>" name="race_id" class="custom-control-input race" value="<?=$race_type_other;?>" <?=( $sess_race_id == $race_type_other ? 'checked' : '' ); ?> />
		                            <label class="custom-control-label" for="race_id_<?=$race_type_other;?>">Other</label>
		                        </div>

				                <div class="form-group race_other_input default_hide">
				                    <input type="text" name="race_other" id="race_other" parsley-trigger="change" <?=$required_field;?> placeholder="Please State Other Race" class="form-control turn_uppercase" value="<?=( $sess_race_id == $race_type_other ? $sess_applicant_race : '' );?>" />
				                </div>
			                </div>

			                <div class="form-group">
			                    <label for="qualification_id">Previous Qualifications <?=STARFIELD;?></label>
			                    <?php
			                    	foreach ( $qualification_arrlist as $qualification_keys => $qualification_list )
			                    	{
			                    ?>
				                    <div class="radio radio-success">
			                            <input type="radio" id="qualification_id_<?=$qualification_keys;?>" name="qualification_id" class="custom-control-input previous_qualification" value="<?=$qualification_keys;?>" <?=( $sess_qualification_id == $qualification_keys ? 'checked' : '' ); ?> />
			                            <label class="custom-control-label" for="qualification_id_<?=$qualification_keys;?>"><?=$qualification_list;?></label>
			                        </div>
			                    <?php
			                    	}
		                  		?>
			                </div>

			                <div id="area_qualification_1">
				                <div class="form-group" id="area_previous_result">
				                	<label for="previous_result">SPM result <?=STARFIELD;?></label>
				                	<input type="text" name="previous_result" id="previous_result" parsley-trigger="change" <?=$required_field;?> placeholder="SPM result" class="form-control turn_uppercase" value="<?=$sess_previous_result;?>" />
				                </div> 
				                <div class="form-group" id="area_previous_institution">
				                	<label for="previous_institution">Which Secondary School did you attend? <?=STARFIELD;?></label>
				                	<input type="text" name="previous_institution" id="previous_institution" parsley-trigger="change" <?=$required_field;?> placeholder="Which Secondary School did you attend?" class="form-control turn_uppercase" value="<?=$sess_previous_institution;?>" />
				                </div>
				            </div>

				            <div id="area_qualification_2" class="default_hide">
				                <div class="form-group" id="area_previous_result">
				                	<label for="previous_result">CGPA result <?=STARFIELD;?></label>
				                	<input type="text" name="previous_result" id="previous_result" parsley-trigger="change" <?=$required_field;?> placeholder="CGPA result" class="form-control input_decimal" value="<?=$sess_previous_result;?>" />
				                </div> 
				                <div class="form-group" id="area_previous_institution">
				                	<label for="previous_institution">Which college or university did you attend? <?=STARFIELD;?></label>
				                	<input type="text" name="previous_institution" id="previous_institution" parsley-trigger="change" <?=$required_field;?> placeholder="Which college or university did you attend?" class="form-control turn_uppercase" value="<?=$sess_previous_institution;?>" />
				                </div>
				            </div>

			                <div class="form-group">
			                    <label for="household_income">What is your household combined income? <?=STARFIELD;?></label>
			                    <input type="text" name="household_income" id="household_income" parsley-trigger="change" <?=$required_field;?> placeholder="What is your household combined income?" class="form-control input_decimal" value="<?=$sess_household_income;?>" />
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
			                            <input type="checkbox" class="custom-control-input institution" id="institution_id_<?=$institution_id;?>" name="institution_id[]" value="<?=$institution_id;?>" <?=( in_array($institution_id, $sess_institution_id_arr) ? 'checked' : '' ); ?> />
			                            <label class="custom-control-label" for="institution_id_<?=$institution_id;?>"><?=$institution_name;?></label>
			                        </div>
			                    <?php
			                    	}
			                    ?>	
		                        <div class="checkbox checkbox-success">
		                            <input type="checkbox" class="custom-control-input institution" id="institution_id_<?=$institution_other;?>" name="institution_id[]" value="<?=$institution_other;?>" <?=( in_array($institution_other, $sess_institution_id_arr) ? 'checked' : '' ); ?> />
		                            <label class="custom-control-label" for="institution_id_<?=$institution_other;?>">Other</label>
		                        </div>    
			                     <div class="form-group institution_other_input default_hide">
				                    <input type="text" name="institution_other" id="institution_other" parsley-trigger="change" <?=$required_field;?> placeholder="Please State Other Institution" class="form-control turn_uppercase" value="<?=( !empty($sess_institution_arr[$institution_other]) ? $sess_institution_arr[$institution_other] : '');?>" />
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
			                            <input type="checkbox" class="custom-control-input course" id="course_id_<?=$course_id;?>" name="course_id[]" value="<?=$course_id;?>" <?=( in_array($course_id, $sess_course_id_arr) ? 'checked' : '' ); ?> />
			                            <label class="custom-control-label" for="course_id_<?=$course_id;?>"><?=$course_name;?></label>
			                        </div>
			                    <?php
			                    	}
			                    ?>	
		                        <div class="checkbox checkbox-success">
		                            <input type="checkbox" class="custom-control-input course" id="course_id_<?=$course_other;?>" name="course_id[]" value="<?=$course_other;?>" <?=( in_array($course_other, $sess_course_id_arr) ? 'checked' : '' ); ?> />
		                            <label class="custom-control-label" for="course_id_<?=$course_other;?>">Other</label>
		                        </div>    
			                     <div class="form-group course_other_input default_hide">
				                    <input type="text" name="course_other" id="course_other" parsley-trigger="change" <?=$required_field;?> placeholder="Please State Other Course" class="form-control turn_uppercase" value="<?=( !empty($sess_course_arr[$course_other]) ? $sess_course_arr[$course_other] : '');?>" />
				                </div>
			                </div>

			                 <div class="form-group">
			                    <label for="study_level_id">Intended Level of Study <?=STARFIELD;?></label>
			                    <?php
			                    	foreach ( $study_level_arrlist as $study_level_keys => $study_level_list )
			                    	{
			                    ?>
				                    <div class="radio radio-success">
			                            <input type="radio" id="study_level_id_<?=$study_level_keys;?>" name="study_level_id" class="custom-control-input" value="<?=$study_level_keys;?>" <?=( $sess_study_level_id == $study_level_keys ? 'checked' : '' ); ?> />
			                            <label class="custom-control-label" for="study_level_id_<?=$study_level_keys;?>"><?=$study_level_list;?></label>
			                        </div>
			                    <?php
			                    	}
		                  		?>
			                </div>

			                <div class="form-group">
			                    <label for="course_duration">Duration of Course (months) <?=STARFIELD;?></label>
			                    <input type="text" name="course_duration" id="course_duration" parsley-trigger="change" <?=$required_field;?> placeholder="Duration of Course (months)" class="form-control input_integer" value="<?=$sess_course_duration;?>" />
			                </div>

			                <div class="form-group">
			                    <label for="study_start_date">Intended Start Date <?=STARFIELD;?></label>
			                	<input type="text" name="study_start_date" id="datepicker-study_start_date" parsley-trigger="change" <?=$required_field;?> placeholder="dd/mm/yyyy" class="form-control" value="<?=$sess_study_start_date;?>" />
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
		                        <input type="file" id="attachment_qualification" name="attachment_qualification" parsley-trigger="change" <?=$required_field;?> class="form-control" />
								<span class="help-block text-info">
									<small id="attachment_qualification_description">
										[Allowed types: jpg, png, gif, pdf]<br />
										[Allowed size: < 2MB]
									</small>
								</span>
		                    </div>

		                     <div class="form-group">
								<label for="attachment_ic">Malaysia IC (Front and Back) <?=STARFIELD;?></label>
		                        <input type="file" id="attachment_ic" name="attachment_ic" parsley-trigger="change" <?=$required_field;?> class="form-control" />
								<span class="help-block text-info">
									<small id="attachment_ic_description">
										[Allowed types: jpg, png, gif, pdf]<br />
										[Allowed size: < 2MB]
									</small>
								</span>
		                    </div>

		                     <div class="form-group">
								<label for="attachment_household_income">Household Proof of Income <?=STARFIELD;?></label>
		                        <input type="file" id="attachment_household_income" name="attachment_household_income" parsley-trigger="change" <?=$required_field;?> class="form-control" />
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
		                        <input type="file" id="attachment_certificate" name="attachment_certificate" parsley-trigger="change" class="form-control" />
								<span class="help-block text-info">
									<small id="aattachment_certificate_description">
										[Allowed types: jpg, png, gif, pdf]<br />
										[Allowed size: < 2MB]
									</small>
								</span>
		                    </div>

		                     <div class="form-group">
								<label for="attachment_rec_letter">Recommendation Letter</label>
		                        <input type="file" id="attachment_rec_letter" name="attachment_rec_letter" parsley-trigger="change" class="form-control" />
								<span class="help-block text-info">
									<small id="attachment_rec_letter_description">
										[Allowed types: jpg, png, gif, pdf]<br />
										[Allowed size: < 2MB]
									</small>
								</span>
		                    </div>

				            <div class="checkbox checkbox-success">
			                    <input type="checkbox" class="custom-control-input" id="application_agreement" name="application_agreement" value="1" <?=( $sess_application_agreement == 1 ? 'checked' : '' ); ?> />
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