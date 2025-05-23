<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>MAEH | Daftar Ahli</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="Senheng Education Assistance" name="description" />
    <meta content="Cloone" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?=base_url()?>img/logo-maeh-16x16.png">

    <!-- Plugin -->
	<link href="<?=base_url()?>plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=base_url()?>plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=base_url()?>plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=base_url()?>plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=base_url()?>plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=base_url()?>plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
	<link href="<?=base_url()?>plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?=base_url()?>plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>

	<link href="<?=base_url()?>plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

	<!-- Summernote css -->
	<!-- <link href="<?=base_url()?>plugins/summernote/summernote.css" rel="stylesheet" /> -->

	<!-- Sweet Alert -->
	<link href="<?=base_url()?>plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

	<!-- Datepicker -->
	<link href="<?=base_url()?>plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <!-- App css -->
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/css/loader_lain.css" rel="stylesheet" type="text/css" />

    <script src="<?=base_url()?>assets/js/modernizr.min.js"></script>

    <!-- jQuery -->
    <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/metisMenu.min.js"></script>
    <script src="<?=base_url()?>assets/js/waves.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.slimscroll.js"></script>

    <!-- jQuery Form Validation -->
    <script src="<?=base_url()?>plugins/jquery-validation/js/1.19.0/jquery.validate.min.js"></script>
    <script src="<?=base_url()?>plugins/jquery-validation/js/1.19.0/additional-methods.min.js"></script>

    <!-- Required datatable js -->
	<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap.js"></script>

	<script src="<?=base_url()?>plugins/datatables/dataTables.buttons.min.js"></script>
	<script src="<?=base_url()?>plugins/datatables/buttons.bootstrap.min.js"></script>
	<script src="<?=base_url()?>plugins/datatables/jszip.min.js"></script>
	<script src="<?=base_url()?>plugins/datatables/pdfmake.min.js"></script>
	<script src="<?=base_url()?>plugins/datatables/vfs_fonts.js"></script>
	<script src="<?=base_url()?>plugins/datatables/buttons.html5.min.js"></script>
	<script src="<?=base_url()?>plugins/datatables/buttons.print.min.js"></script>
	<script src="<?=base_url()?>plugins/datatables/dataTables.fixedHeader.min.js"></script>
	<script src="<?=base_url()?>plugins/datatables/dataTables.keyTable.min.js"></script>
	<script src="<?=base_url()?>plugins/datatables/dataTables.responsive.min.js"></script>
	<script src="<?=base_url()?>plugins/datatables/responsive.bootstrap.min.js"></script>
	<script src="<?=base_url()?>plugins/datatables/dataTables.scroller.min.js"></script>
	<script src="<?=base_url()?>plugins/datatables/dataTables.colVis.js"></script>
	<script src="<?=base_url()?>plugins/datatables/dataTables.fixedColumns.min.js"></script>

	<!-- Select 2 (search Inside Dropdown List) -->
    <link href="<?=base_url()?>plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
	<script src="<?=base_url()?>plugins/select2/js/select2.min.js" type="text/javascript"></script>
	<!-- <script src="<?=base_url()?>plugins/select2/js/select2.full.min.js" type="text/javascript"></script> -->

	<!-- Sweet-Alert  -->
	<script src="<?=base_url()?>plugins/sweet-alert2/sweetalert2.min.js"></script>

	<!-- Datepicker -->
	<script src="<?=base_url()?>plugins/moment/moment.js"></script>
	<script src="<?=base_url()?>plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

	<!--Form Wizard-->
	<script src="<?=base_url()?>plugins/jquery.stepy/jquery.stepy.min.js" type="text/javascript"></script>
	
	<!-- Loading Spinner -->
	<link href="<?=base_url();?>plugins/spinkit/spinkit.css" rel="stylesheet" />
    <script src="<?=base_url();?>assets/js/waves.js"></script>

</head>

<script src="<?=base_url()?>assets/js/jquery.inputmask.bundle.js" type="text/javascript"></script>

<script type="text/javascript">

function loading_on()
{
	$('.loading_cloone').show();
}

function loading_off()
{
	$('.loading_cloone').hide();
}

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

$(function(){

	$(".select2_field").select2();

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
	
	$('#datepicker-dob').datepicker({
		format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
        endDate: '+0d',
		
    }).on('changeDate', function(e) {
        // `e` here contains the extra attributes
    });

    $('.qualification_year').datepicker({
        minViewMode: 2,
		format: "yyyy",
		// startDate: new Date(),
		endDate: new Date(),
		autoclose: true,
        todayHighlight: true

	}).on('keydown', function(e) {
    	e.preventDefault();

    }).on('hide', function(event) {
		// to avoid from clear all input inside modal
	    event.preventDefault();
	    event.stopPropagation();
  	});

	// var validation_error_exist = '';

	// if ( validation_error_exist != "" )
	// {
	// 	$("#area_error_message").show();

	// 	// focus to this area if got error
	//  	$('html, body').animate({
	//         scrollTop: $("#area_error_message").offset().top
	//     }, 1000);
	// }
	// else
	// {
	// 	$("#area_error_message").hide();
	// }

});

</script>

<style>

.hilang{
	display: none;
}

.font-10 {
  font-size: 10px !important;
}
.font-11 {
  font-size: 11px !important;
}
.font-12 {
  font-size: 12px !important;
}

.form-group>label
{
  font-size: 13px !important;
  font-weight: bold;
}

.input-sm-file
{
	height: 30px;
    padding: 5px 10px;
    font-size: 12px;
    line-height: 1.0;
    border-radius: 3px;
}

.content-page .content
{
	margin-top: 10px !important;
}

.footer
{
	padding: 10px 30px 0 !important;
	background: #000000 !important; 
	left: 0px !important;
}

.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th
{
	padding: 5px 10px !important;
	font-size: 13px !important;
}

.panel-heading
{
	padding: 10px 10px 0 10px !important;
}
.panel .panel-body
{
	padding: 10px 10px !important;
}

.datepicker table tr td span
{
	height: 30px !important;
	line-height: 30px !important;
}
.datepicker td, .datepicker th
{
	font-size: 13px !important;
}
.datepicker table tr td.today
{
	background-color: #eeeeee !important;
	color: #000000 !important;
}
.datepicker table tr td.active.active
{
	background-image: linear-gradient(to bottom,#3fec75,#32c861) !important;
}
.datepicker table tr td span.active, .datepicker table tr td span.active.disabled, .datepicker table tr td span.active.disabled:hover, .datepicker table tr td span.active:hover
{
	background-image: linear-gradient(to bottom,#3fec75,#32c861) !important;
}

.stepy-header li.stepy-active span
{
	/* label name */
	color: #4489e4;
}
.stepy-header li.stepy-active div
{
	/* label icon */
	border-color: #4489e4;
	color: #4489e4;
}
.stepy-header li:after, .stepy-header li:before
{
	/* line before and after*/
	background-color: #4489e4;
}
.stepy-header li div
{
	/* label icon complete */
	background-color: #4489e4;
    border: 2px solid #4489e4;
}
@media (max-width: 480px)
{
	.stepy-header li.stepy-active:after 
	{
		/* line before and after*/
		background-color: #4489e4;
	}
}

.select-sm
{
	height: 31px !important;
	font-size: 12px !important;
}
.select2-container .select2-selection--single
{
	height: 31px !important;
	font-size: 12px !important;
}
.select2-container .select2-selection--single .select2-selection__rendered
{
	line-height: 31px !important;
}
.select2-results__option
{
	font-size: 12px !important;
}
/* start custom for validation */
.form-control-feedback
{
	line-height: 15px !important;
}
.has-danger .select2-container .select2-selection--single.select2-container--custom-validation {
    border: 1px solid #d9534f !important;
    width: -webkit-calc(100% - -36px) !important;
}
.has-success .select2-container .select2-selection--single.select2-container--custom-validation {
    border: 1px solid #32c861 !important;
    width: -webkit-calc(100% - -36px) !important;
}
.cb-div .form-control-feedback {
	color: #d9534f !important;
	margin-top: -5px !important;
	margin-bottom: 15px !important;
}
/* end custom for validation */

</style>

<?php
	$required_field = '';
?>
<body>

    <!-- Begin page wrapper -->
    <div id="wrapper">

		<!-- Top Bar -->
	    <div class="topbar" style="background: #000000;">
		
			<div class="navbar">
				<div class="container" style="width: 100%; padding: 0;">
					<div class="row">
						<div class="col-md-2">
							<a href=""><img src="<?=base_url()?>img/logo-maeh-100x100.png" class="img-responsive" height="25"></a>
							<span style="font-size:16px;"><b>MAEH</b></span>
						</div>
						<div class="col-md-10 text-right">
							<a href="<?=site_url("registration-status");?>" role="button" class="btn btn-sm btn-primary btn-bordered waves-effect w-md waves-light"> <span>Registration Status</span> </a>
						</div>
					</div>
				</div>
			</div> 
		
		</div>	
		<!-- Top Bar End -->

     	<!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->

    	<div class="content-page" style="margin-top: 50px;">
            <?php flash_output('notis'); ?>    
            <!-- Start content -->
            <div class="content col-md-10">
                <!-- Start container -->
            	<div class="container container-fluid">

            		<div class="loading_cloone" style="display: none;" >
                        <div class="modal-backdrop " style="opacity: 0.2 !important;"></div>
                        <div id="cloone_preloader">
                            <div id="cloone_loader"></div>
                        </div>
                    </div>

					<div class="row">
					    <div class="col-12">

					        <div class="card-box">

					        	<div class="text-center">
					        		<a href=""><img src="<?=base_url()?>img/logo-maeh-100x100.png" class="img-responsive"/></a>
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
						            		<li class="font-13">Malaysian 18 years old and above.</li>
						            		<li class="font-13">Stay in Malaysia at least 10 years.</li>
						            	</ul>
							        </div>    
					       		</div>
								<?php 
								/* 
					       		<div id="area_error_message" class="panel panel-danger">
					  				<div class="panel-heading"><h5 style="color:#000000 !important;"><?=(isset($validation_notis_title) ? $validation_notis_title : '');?></h5></div>
					  				<div class="panel-body"><?=(isset($validation_notis_msg) ? $validation_notis_msg : '');?></div>
					  			</div>
					  			*/ 
					  			?>
								<p class="text-info m-b-10 font-11">
									<i class="fa fa-info"></i> <em>Prepare your information before key-in the registration details.</em>
									<br />
									<i class="fa fa-info"></i> <em>Please ensure that you have already made the payment for the registration fee, as you will be required to upload the payment receipt later.</em>
								</p>
								<p class="text-danger m-b-10 font-13">
									<em>(*) Compulsory Field</em>
								</p>

								<form id="form_registration" name="form_registration" action="<?=site_url("registration-submit"); ?>" method="post" enctype="multipart/form-data">

									<!-- start fieldset 1 --> 
									<fieldset title="1">
										<legend>Personal Details</legend>
										<div class="row">

											<div class="col-md-12">
												<div class="form-group">
								                    <label class="form-control-label" for="membership_type">Membership Type <?=STARFIELD;?></label>
		                                            <select class="form-control select-sm select2_field" name="membership_type_id" id="membership_type_id">
		                                            	<option value="">Select Membership Type</option>
												<?php
												if ( is_array($membership_type) && count($membership_type) > 0 ) 
												{
													foreach ( $membership_type as $key => $val ) 
													{
		                                        ?>
		                                            	<option value="<?=$key;?>"><?=$val;?></option>
												<?php
													}
												}
												?>
													</select>
												</div>
											</div>

											<div class="col-md-6">
								                <div class="form-group">
								                    <label class="form-control-label" for="name">Name <?=STARFIELD;?></label>
								                    <input type="text" name="name" id="name" parsley-trigger="change" <?=$required_field;?> placeholder="Name" class="form-control input-sm turn_uppercase" value="" />
								                    <?php if ( isset($validation_error->name) ) { ?>
								                    <div class="form-control-feedback" id="name-error"><?=$validation_error->name;?></div>
								                    <?php } ?>
								                </div>
								                <div class="form-group">
								                    <label class="form-control-label" for="icno">IC No <?=STARFIELD;?></label>
								                    <input type="text" name="icno" id="icno" parsley-trigger="change" <?=$required_field;?> placeholder="IC No" class="form-control input-sm mask_nric" value="" />
								                    <?php if ( isset($validation_error->icno) ) { ?>
								                    <div class="form-control-feedback" id="icno-error"><?=$validation_error->icno;?></div>
								                    <?php } ?>
								                </div> 
								                <div class="form-group">
								                    <label class="form-control-label" for="contactno_mobile">HP No <?=STARFIELD;?></label>
								                    <input type="text" name="contactno_mobile" id="contactno_mobile" parsley-trigger="change" <?=$required_field;?> placeholder="HP No" class="form-control input-sm mask_phone" value="" />
								                </div>
								            </div>

								            <div class="col-md-6">
								               <div class="form-group">
								                    <label class="form-control-label" for="email">Email Address <?=STARFIELD;?></label>
								                    <input type="text" name="email" id="email" parsley-trigger="change" <?=$required_field;?> placeholder="Email Address" class="form-control input-sm" value="" />
								                </div>
								                <div class="form-group">
								                    <label class="form-control-label" for="dob">Date of Birth <?=STARFIELD;?></label>
								                	<input type="text" name="dob" id="datepicker-dob" parsley-trigger="change" <?=$required_field;?> placeholder="dd/mm/yyyy" class="form-control input-sm" value="" />
								                </div>       
								                <div class="form-group">
								                    <label class="form-control-label" for="contactno_home">Home Tel No</label>
								                    <input type="text" name="contactno_home" id="contactno_home" parsley-trigger="change" placeholder="Home Tel No" class="form-control input-sm mask_phone" value="" />
								                </div>
								            </div>

								            <div class="col-md-12">    
								                <div class="form-group">
								                    <label class="form-control-label" for="home_address">Address - Home <?=STARFIELD;?></label>
								                    <textarea name="home_address" id="home_address" rows="5" style="resize: none; margin-top: 0px; margin-bottom: 0px; height: 100px; " parsley-trigger="change" <?=$required_field;?> placeholder="Address - Home" class="form-control input-sm turn_uppercase"></textarea>
								                </div>
								            </div>

								            <div class="col-md-4">
								               <div class="form-group">
								                    <label class="form-control-label" for="home_postcode">Postcode <?=STARFIELD;?></label>
								                    <input type="text" name="home_postcode" id="home_postcode" parsley-trigger="change" <?=$required_field;?> placeholder="Postcode" class="form-control input-sm turn_uppercase" value="" />
								                </div>
								            </div>

								            <div class="col-md-4">    
								                <div class="form-group">
								                    <label class="form-control-label" for="home_city">City <?=STARFIELD;?></label>
								                    <input type="text" name="home_city" id="home_city" parsley-trigger="change" <?=$required_field;?> placeholder="City" class="form-control input-sm turn_uppercase" value="" />
								                </div>
								            </div>

								            <div class="col-md-4">    
								                <div class="form-group">
								                    <label class="form-control-label" for="home_state">State <?=STARFIELD;?></label>
		                                            <select class="form-control select-sm select2_field" name="home_state" id="home_state">
		                                            	<option value="">Select State</option>
								                    <?php
		                                            	if ( is_array($states) && count($states) > 0 )
		                                            	{
		                                            		foreach ( $states as $key => $val )
		                                            		{
		                                            			$id = $val->id;
		                                            			$name = $val->name;
		                                            ?>
		                                            	<option value="<?=$name;?>"><?=$name;?></option>
		                                            <?php
		                                            		}
		                                            	}
		                                            ?>	
		                                            </select>
								                </div>
								            </div>

							        	</div>
									 	<!-- end row -->
								 	</fieldset>
									<!-- end fieldset 1 --> 

									<!-- start fieldset 2 -->
									<fieldset title="2"> 
										<legend>Job Details</legend>	

										<div class="row m-t-10">

								            <div class="col-md-6">
									 			<div class="form-group">
								                    <label class="form-control-label" for="job_position">Current Post</label>
								                    <input type="text" name="job_position" id="job_position" parsley-trigger="change" placeholder="Current Post" class="form-control input-sm turn_uppercase" value="" />
								                </div>
								            </div>

								            <div class="col-md-6">
									 			<div class="form-group">
								                    <label class="form-control-label" for="contactno_office">Office Tel No</label>
								                    <input type="text" name="contactno_office" id="contactno_office" parsley-trigger="change" placeholder="Office Tel No" class="form-control input-sm mask_phone" value="" />
								                </div>
								            </div>

											<div class="col-md-12">    
								                <div class="form-group">
								                    <label class="form-control-label" for="office_address">Address - Office</label>
								                    <textarea name="office_address" id="office_address" rows="5" style="resize: none; margin-top: 0px; margin-bottom: 0px; height: 100px; " parsley-trigger="change" placeholder="Address - Office" class="form-control input-sm turn_uppercase"></textarea>
								                </div>
								            </div>

								            <div class="col-md-4">
								               <div class="form-group">
								                    <label class="form-control-label" for="office_postcode">Postcode</label>
								                    <input type="text" name="office_postcode" id="office_postcode" parsley-trigger="change" placeholder="Postcode" class="form-control input-sm turn_uppercase" value="" />
								                </div>
								            </div>

								            <div class="col-md-4">    
								                <div class="form-group">
								                    <label class="form-control-label" for="office_city">City</label>
								                    <input type="text" name="office_city" id="office_city" parsley-trigger="change" placeholder="City" class="form-control input-sm turn_uppercase" value="" />
								                </div>
								            </div>

								            <div class="col-md-4">    
								                <div class="form-group">
								                    <label class="form-control-label" for="office_state">State</label>
		                                            <select class="form-control select-sm select2_field" name="office_state" id="office_state">
		                                            	<option value="">Select State</option>
								                    <?php
		                                            	if ( is_array($states) && count($states) > 0 )
		                                            	{
		                                            		foreach ( $states as $key => $val )
		                                            		{
		                                            			$id = $val->id;
		                                            			$name = $val->name;
		                                            ?>
		                                            	<option value="<?=$name;?>"><?=$name;?></option>
		                                            <?php
		                                            		}
		                                            	}
		                                            ?>	
		                                            </select>
								                </div>
								            </div>

							        	</div>
									 	<!-- end row m-t-10 --> 
									</fieldset>
									<!-- end fieldset 2 -->

									<!-- start fieldset 3 -->
									<fieldset title="3"> 
										<legend>Qualifications</legend>
										<div class="row m-t-10">
	 
								            <div class="col-md-12">
								            	<!-- <label><b class="font-13">Qualifications</b></label> -->
								            	<div class="col-md-12 text-right" style="padding-left:0; padding-right:0;">
				                                	<button type="button" id="btn_add_qualification" name="btn_add_qualification"  class="btn btn-sm btn-info"><i class="mdi mdi-plus"></i> Add</button>
				                                </div>
										 		<div class="table-responsive">
			                                        <table id="table_qualification" class="table m-0 table-colored table-primary">
			                                            <thead>
				                                            <tr>
				                                                <th width="10%">Qualification</th>
				                                                <th width="30%">Title/Result</th>
				                                                <th width="10%">Year</th>
				                                                <th width="40%">School/College/University</th>
				                                                <th width="10%"></th>
				                                            </tr>
			                                            </thead>
			                                            <tbody class="tbody_qualification">
			                                            <?php
			                                            /*
			                                            	if ( is_array($qualification_categories) && count($qualification_categories) > 0 )
			                                            	{
			                                            		foreach ( $qualification_categories as $key => $val )
			                                            		{
			                                            			$id = $val->id;
			                                            			$name = $val->name;
			                                            ?>
				                                            <tr>
				                                                <th scope="row">
				                                                	<input type="hidden" name="qualification_category[]" id="qualification_category_<?=$id;?>" class="form-control input-sm" value="<?=$id;?>" />
				                                                	<?=$name;?>
				                                                </th>
				                                                <td>
				                                                	<input type="text" name="qualification_title[]" id="qualification_title_<?=$id;?>" class="form-control input-sm turn_uppercase" value="" />
				                                                </td>
				                                                <td>
				                                                	<input type="text" name="qualification_year[]" id="qualification_year_<?=$id;?>" class="form-control input-sm turn_uppercase qualification_year" value="" />
				                                                </td>
				                                                <td>
				                                                	<input type="text" name="qualification_institution[]" id="qualification_institution_<?=$id;?>" class="form-control input-sm turn_uppercase" value="" />
				                                                </td>
				                                            </tr>
				                                        <?php
				                                        		}
				                                        	}
				                                        */
				                                        ?>    
			                                            </tbody>
			                                        </table>
			                                    </div>
		                                    </div>
									 		<!-- end col-md-12 --> 

							        	</div>
									 	<!-- end row m-t-10 -->
									</fieldset>
									<!-- end fieldset 3 -->

									<!-- start fieldset 4 --> 
									<fieldset title="4"> 
										<legend>Organizations</legend>
									 	<div class="row m-t-10">
	 										
								            <div class="col-md-12">
								            	<label><b class="font-13">State whether you are a member of any organization (the full name of the organization, any post held)</b></label>
								            	<div class="col-md-12 text-right" style="padding-left:0; padding-right:0;">
				                                	<button type="button" id="btn_add_organization" name="btn_add_organization"  class="btn btn-sm btn-info"><i class="mdi mdi-plus"></i> Add</button>
				                                </div>
										 		<div class="table-responsive">
			                                        <table id="table_organization" class="table m-0 table-colored table-primary">
			                                            <thead>
				                                            <tr>
				                                                <th width="70%">Organization</th>
				                                                <th width="20%">Post</th>
				                                                <th width="10%"></th>
			                                            </thead>
			                                            <tbody class="tbody_organization">
			                                            </tbody>
			                                        </table>
			                                    </div>
		                                    </div>
									 		<!-- end col-md-12 --> 

							        	</div>
									 	<!-- end row m-t-10 -->
									</fieldset>
									<!-- end fieldset 4 --> 	 

									<!-- start fieldset 5 --> 
									<fieldset title="5"> 
										<legend>Agreements</legend>
										<div class="row m-t-10">

									 		<div class="col-md-12 cb-div">
									            <div class="checkbox checkbox-success" style="margin-left:-3px;">
								                    <input type="checkbox" class="custom-control-input" id="registration_agreement" name="registration_agreement" value="1" />
								                    <label class="custom-control-label font-13" for="registration_agreement">I agree to abide by the Rules of the Malaysia Association of Environmental Health (MAEH).</label>
								                </div>
								                <?php if ( isset($validation_error->registration_agreement) ) { ?>
							                    <div class="form-control-feedback" id="registration_agreement-error"><?=$validation_error->registration_agreement;?></div>
							                    <?php } ?>
								            </div>

											<div class="col-md-12 cb-div">
									            <div class="checkbox checkbox-success" style="margin-left:-3px;">
								                    <input type="checkbox" class="custom-control-input" id="registration_payment" name="registration_payment" value="1" />
								                    <label class="custom-control-label font-13" for="registration_payment">I enclosed herewith payment receipt for <?=( isset($membership_fee) ? MAIN_CURRENCY.$membership_fee['total_registration'][1] : '' );?> being the payment of yearly subscription <?=( isset($membership_fee) ? MAIN_CURRENCY.$membership_fee['registration'][1] : '' );?> and entrance fee <?=( isset($membership_fee) ? MAIN_CURRENCY.$membership_fee['renewal_yearly'][1] : '' );?>.<br />For students, yearly subscription <?=( isset($membership_fee) ? MAIN_CURRENCY.$membership_fee['registration'][1] : '' );?> and entrance fee <?=( isset($membership_fee) ? MAIN_CURRENCY.$membership_fee['renewal_yearly'][2] : '' );?>.</label>
								                </div>
								                <?php if ( isset($validation_error->registration_payment) ) { ?>
							                    <div class="form-control-feedback" id="registration_payment-error"><?=$validation_error->registration_payment;?></div>
							                    <?php } ?>
								            </div>

											<div class="col-md-6 file-div">
								                <div class="form-group">
													<label for="payment_receipt">Payment Receipt <?=STARFIELD;?></label>
							                        <input type="file" id="payment_receipt" name="payment_receipt" parsley-trigger="change" <?=$required_field;?> class="form-control input-sm-file" />
													<span class="help-block text-primary">
														<small id="payment_receipt_description">
															[Allowed types: jpeg, jpg, png, pdf]<br />
															[Allowed size: < 2MB]
														</small>
													</span>
							                    </div>
								            </div>

								            <div class="col-md-12 payment_receipt_file">
								            </div>	

								        </div>
									 	<!-- end row m-t-10 --> 
								 	</fieldset>
									<!-- end fieldset 5 -->

									<input type="hidden" name="qualification_id" id="qualification_id" class="form-control input-sm" value="" />
									<input type="hidden" name="organization_id" id="organization_id" class="form-control input-sm" value="" />
									<input type="hidden" id="payment_receipt_uploaded" name="payment_receipt_uploaded" value="" />

							        <button type="submit" id="btn_submit" name="btn_submit"  class="btn btn-sm btn-success stepy-finish waves-effect waves-light">Submit</button>
								 	<!-- end row m-t-20 --> 

					            </form>
					        </div> <!-- end card-box -->
					    </div>
					    <!-- end col -->
					</div>
					<!-- end row -->

				</div> 
                    <!-- End container -->
            </div> 
            <!-- End content -->

            <!-- Start Footer -->
            <footer class="footer">
				<p>Copyright &#169; <span id="copyright-year"></span> <b>Malaysia Association of Environmental Health (MAEH)</b>
            </footer>
            <!-- End Footer -->
        </div>	

        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->

	</div>
	<!-- End page wrapper -->

<!-- App js -->
<script src="<?=base_url()?>assets/js/jquery.core.js"></script>
<script src="<?=base_url()?>assets/js/jquery.app.js"></script>

<script type="text/javascript">

function get_random_id()
{
    // var char_length = '10';
    var result = '';
    // var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    // var charactersLength = characters.length;
    // for ( var i = 0; i < char_length; i++ ) 
    // {
    //     result += characters.charAt(Math.floor(Math.random() * charactersLength));
    // }
    result = ( Math.round(Math.round(+new Date()) * Math.random()) ); 
    return result;
}

// append row qualification
function append_row_qualification(rand_id)
{
    var add_row = '';
    add_row += '<tr id="tr_qualification_'+rand_id+'">';
     add_row += '<td id="qc_'+rand_id+'"><div class="form-group"><select class="form-control select-sm select2_field" name="qualification_category[]" id="qualification_category_'+rand_id+'"></select></div></td>';
    add_row += '<td><div class="form-group"><input type="text" name="qualification_title[]" id="qualification_title_'+rand_id+'" class="form-control input-sm turn_uppercase" value="" placeholder="Title/Result" /></div></td>';
    add_row += '<td><div class="form-group"><input type="text" name="qualification_year[]" id="qualification_year_'+rand_id+'" class="form-control input-sm turn_uppercase qualification_year" value="" placeholder="Year" /></div></td>';
    add_row += '<td><div class="form-group"><input type="text" name="qualification_institution[]" id="qualification_institution_'+rand_id+'" class="form-control input-sm turn_uppercase" value="" placeholder="School/College/University" /></div></td>';
    add_row += '<td class="text-center"><a href="javascript:void(0);" class="btn_remove_row btn-lg" title="Remove this row" onclick="remove_row_qualification(\''+rand_id+'\')"><i class="fa fa-trash text-danger"></i></a></td>';
    add_row += '</tr>';
    $('.tbody_qualification').append(add_row);

    return add_row;
}

// remove row qualification
function remove_row_qualification(rand_id)
{
    var count_id = $("#qualification_id").val();
    var count_part = count_id.split(", ");
    var undelete_id = "";
    var delete_id = "";
    
    for (i = 0; i < count_part.length; i += 1) {     
        if ( count_part[i] == rand_id ) {
            if ( delete_id != "" ) delete_id = delete_id + ", ";
            delete_id = delete_id + count_part[i];
        } else {
            if ( undelete_id != "" ) undelete_id = undelete_id + ", ";
            undelete_id = undelete_id + count_part[i];
        }
    }
    
    if ( undelete_id == "" ) undelete_id = "";
    $("#qualification_id").val( undelete_id );

    $('#tr_qualification_'+rand_id).remove();
}

// get list of qualification categories
function get_qc(rand_id)
{
	$('#qualification_category_'+rand_id).html('');

	var dataString = "";

	$.ajax({
		type: "POST",
		url: "<?php echo site_url('qualification-category-list-dd')?>",
		data: dataString,
		// dataType: 'json',
		cache: false,
		success: function(data) {
			// console.log("data",data);
			$('#qualification_category_'+rand_id).html(data); 
		},
		complete: function(){
			$(".select2_field").select2();
		}
	});
}

// append row organization
function append_row_organization(rand_id)
{
    var add_row = '';
    add_row += '<tr id="tr_organization_'+rand_id+'">';
    add_row += '<td><div class="form-group"><input type="text" name="organization_name[]" id="organization_name_'+rand_id+'" class="form-control input-sm turn_uppercase" value="" placeholder="Organization" /></div></td>';
    add_row += '<td><div class="form-group"><input type="text" name="organization_post[]" id="qualification_post_'+rand_id+'" class="form-control input-sm turn_uppercase" value="" placeholder="Post" /></div></td>';
    add_row += '<td class="text-center"><a href="javascript:void(0);" class="btn_remove_row btn-lg" title="Remove this row" onclick="remove_row_organization(\''+rand_id+'\')"><i class="fa fa-trash text-danger"></i></a></td>';
    add_row += '</tr>';
    $('.tbody_organization').append(add_row);

    return add_row;
}

// remove row organization
function remove_row_organization(rand_id)
{
    var count_id = $("#organization_id").val();
    var count_part = count_id.split(", ");
    var undelete_id = "";
    var delete_id = "";
    
    for (i = 0; i < count_part.length; i += 1) {     
        if ( count_part[i] == rand_id ) {
            if ( delete_id != "" ) delete_id = delete_id + ", ";
            delete_id = delete_id + count_part[i];
        } else {
            if ( undelete_id != "" ) undelete_id = undelete_id + ", ";
            undelete_id = undelete_id + count_part[i];
        }
    }
    
    if ( undelete_id == "" ) undelete_id = "";
    $("#organization_id").val( undelete_id );

    $('#tr_organization_'+rand_id).remove();
}

$(function(){

	var form_data;
	/* Start Step Wizard Form */

	// Override defaults
    $.fn.stepy.defaults.legend = false;
    $.fn.stepy.defaults.transition = 'fade';
    $.fn.stepy.defaults.duration = 200;
    $.fn.stepy.defaults.backLabel = '<i class="mdi mdi-arrow-left-bold"></i> Back';
    $.fn.stepy.defaults.nextLabel = 'Next <i class="mdi mdi-arrow-right-bold"></i>';

	$("#form_registration").stepy({
		// titleClick: true,
        next: function(index) {
        	//#click on 1st next button
			if ( index == 2 )
			{
			}

			if ($("#form_registration").valid()) {} 
	        else 
	        {
	        	swal({
					title: 'Ops! Please fill in the required details',
					html: '',
					type: 'error',
					allowOutsideClick: false
				}).then(function () {
				});
	          	return false;
	        }
		},
        back: function(index) {
        },
		finish: function() {
			if ($("#form_registration").valid()) {} 
	        else 
	        {
	        	swal({
					title: 'Ops! Please fill in the required details',
					html: '',
					type: 'error',
					allowOutsideClick: false
				}).then(function () {
				});
	          	return false;
	        }
		}
    });

	// Apply "Back" and "Next" button styling
    $('.stepy-navigator').find('.button-next').addClass('btn btn-sm btn-primary');
    $('.stepy-step').find('.button-back').addClass('btn btn-sm btn-primary pull-left'); 

	/* End Step Wizard Form */

	$.validator.addMethod("validate_inputmask", function(value, element) {
		value = value.replace(/_/g, '');

		if ( element.id == 'icno' ) {
			return value.length >= 14 && value.length <= 14;
		} else if ( element.id == 'contactno_mobile' ) {
			return value.length >= 10;
		} else if ( element.id == 'contactno_home' || element.id == 'contactno_office' ) {
			value = value.substr(3);
			return !value || value.length >= 8;
		} else {
			return true;
		}
	}, "Invalid format");

	$.validator.addMethod("validate_inputdate", function(value, element) {
		var pattern = /^\d{2}\/\d{2}\/\d{4}$/;
        return pattern.test(value);
	}, "Invalid date format");

	$.validator.addMethod('validate_inputfile', function(value, element, limit) {
	    return !element.files[0] || (element.files[0].size <= limit);
	}, 'Invalid file size (Max 2MB)');

    $("#form_registration").validate({
    	errorElement: 'div',
        errorPlacement: function (error, element) {
			$(element).closest('.form-group').addClass('has-danger');
			if (element.hasClass("select2-hidden-accessible")) {
				element.closest(".form-group").find(".form-control-feedback").remove();
				error.addClass('form-control-feedback');
				error.insertAfter(element.next(".select2-container"));
				element.next(".select2-container").addClass('form-control-danger');

	        } else if (element.parent('.checkbox').length) {
	        	console.log('element', element);
				element.closest(".cb-div").find(".form-control-feedback").remove();
				error.addClass('form-control-feedback');
		        error.insertAfter(element.parent());

		    } else {
				element.next(".form-control-feedback").remove();
				error.addClass('form-control-feedback');
				error.insertAfter(element);
	            element.addClass('form-control-danger');
	        }
        },
        highlight: function (element, errorClass, validClass) {
			$(element).closest('.form-group').addClass('has-danger').removeClass('has-success');
			if ($(element).hasClass("select2-hidden-accessible")) {
				// $('.select2_field').select2({ containerCssClass : 'select2-container--custom-validation' });
				$(element).next(".select2-container").find(".select2-selection").removeClass('select2-container--custom-validation').addClass('select2-container--custom-validation');
				$(element).next(".select2-container").addClass('form-control-danger').removeClass('form-control-success');
			} else {
				$(element).addClass('form-control-danger').removeClass('form-control-success');
			}
        },
        unhighlight: function (element, errorClass, validClass) {
			$(element).closest('.form-group').addClass('has-success').removeClass('has-danger');
			if ($(element).hasClass("select2-hidden-accessible")) {
        		// $('.select2_field').select2({ containerCssClass : 'select2-container--custom-validation' });
				$(element).next(".select2-container").find(".select2-selection").removeClass('select2-container--custom-validation').addClass('select2-container--custom-validation');
				$(element).next(".select2-container").addClass('form-control-success').removeClass('form-control-danger');
			} else {
				$(element).addClass('form-control-success').removeClass('form-control-danger');
			}
        },
    	rules: {
    		membership_type_id: "required",
    		name: {
    			required: true,
    			minlength: 5
    		},
            icno: {
    			required: true,
		        // digits: true,
		        minlength: 14,
		        maxlength: 14,
		        validate_inputmask: true,
		        remote: {
					url: "<?=site_url('registration-validate');?>",
					type: "POST",
					data: {
						icno: function() {
							return $("#icno").val();
						},
						process: "validate_icno"
					}
				}
    		},
            contactno_mobile: {
    			required: true,
		        // digits: true,
		        minlength: 10,
		        validate_inputmask: true
    		},
		    email: {
		      required: true,
		      email: true
		    },
		    dob: {
		    	required: true,
            	validate_inputdate: true
		    },
            contactno_home: {
		        // digits: true,
		        minlength: 10,
		        validate_inputmask: true
    		},
    		home_address: "required",
    		home_postcode: {
    			required: true,
		        minlength: 4,
		        maxlength: 8
    		},
    		home_city: "required",
    		home_state: "required",
            contactno_office: {
		        // digits: true,
		        minlength: 10,
		        validate_inputmask: true
    		},
    		office_postcode: {
		        minlength: 4,
		        maxlength: 8
    		},
    		// https://stackoverflow.com/questions/24670447/how-to-validate-array-of-inputs-using-validate-plugin-jquery
    		"qualification_category[]": "required",
    		"qualification_title[]": "required",
    		"qualification_year[]": "required",
    		"qualification_institution[]": "required",
    		"organization_name[]": "required",
    		"organization_post[]": "required",
    		registration_agreement: "required",
    		registration_payment: "required",
    		payment_receipt: {
    			required: true,
    			extension: "jpeg|jpg|png|pdf",
    			validate_inputfile: 2097152
    		}
        },
        messages: {
    		membership_type_id: "Membership Type is required",
        	name: {
		        required: "Name is required",
		        minlength: "Name must be at least 5 characters long"
		    },
            icno: {
		        required: "IC No is required",
		        // digits: "IC No require only number format",
		        minlength: "Invalid format of IC No",
		        maxlength: "Invalid format of IC No",
		        remote: "IC No already exists"
		    },
            contactno_mobile: {
		        required: "HP No is required",
		        // digits: "HP No require only number format",
		        minlength: "Invalid format of HP No",
		    },
		    email: {
		      	required: "Email Address is required",
		      	email: "Invalid format of Email Address"
		    },
		    dob: {
		      	required: "Date of Birth is required"
		    },
            contactno_home: {
		        // digits: "Home Tel No require only number format",
		        minlength: "Invalid format of Home Tel No",
		    },
		    home_address: "Address - Home is required",
		    home_postcode: {
		    	required: "Postcode is required",
		        minlength: "Invalid format of Postcode",
		        maxlength: "Invalid format of Postcode",
		    },
		    home_city: "City is required",
    		home_state: "State is required",
    		"qualification_category[]": "Qualification is required",
    		"qualification_title[]": "Title/Result is required",
    		"qualification_year[]": "Year is required",
    		"qualification_institution[]": "School/College/University info is required",
    		"organization_name[]": "Organization info is required",
    		"organization_post[]": "Post is required",
    		registration_agreement: "Check is required",
    		registration_payment: "Check is required",
    		payment_receipt: {
    			required: "Payment Receipt is required",
    			extension: "Invalid file type (jpeg, jpg, png, pdf)"
    		}
        }
    });

	$('#datepicker-dob').datepicker().on('changeDate', function(e) {
        $(this).valid();
    });

    $('.select2_field').on('change', function(e) {
	    $(this).valid();
	});

    $('#table_qualification').on('change', '.select2_field, .qualification_year', function(e) {
    	$(this).valid();
    });

	// when click button btn_add_qualification
	$('#btn_add_qualification').click(function(){
        var rand_id = get_random_id();

        var arr_rand_id = $("#qualification_id").val();
        if ( arr_rand_id != "" ) arr_rand_id = arr_rand_id + ", ";
        arr_rand_id = arr_rand_id + rand_id;
        $("#qualification_id").val( arr_rand_id );

        append_row_qualification(rand_id);
        get_qc(rand_id);

        $('.qualification_year').datepicker({
	        minViewMode: 2,
			format: "yyyy",
			// startDate: new Date(),
			endDate: new Date(),
			autoclose: true,
	        todayHighlight: true

		}).on('keydown', function(e) {
	    	e.preventDefault();

	    }).on('hide', function(event) {
			// to avoid from clear all input inside modal
		    event.preventDefault();
		    event.stopPropagation();
	  	});
    });

	// when click button btn_add_organization
	$('#btn_add_organization').click(function(){
        var rand_id = get_random_id();

        var arr_rand_id = $("#organization_id").val();
        if ( arr_rand_id != "" ) arr_rand_id = arr_rand_id + ", ";
        arr_rand_id = arr_rand_id + rand_id;
        $("#organization_id").val( arr_rand_id );

        append_row_organization(rand_id);
    });

     // when upload payment receipt
    $('#payment_receipt').on('change',function(e){
    	// https://stackoverflow.com/questions/33602504/php-upload-file-to-ajax-using-onchange
    	var file = this.files[0];
    	// console.log(file);
    	var form_data = new FormData($("#form_registration")[0]);
    	form_data.append('payment_receipt', file);
    	form_data.append('attachment_field_name', 'payment_receipt');

    	if ($(this).valid()) { } else { return false; }

    	$('#payment_receipt_uploaded').val('');

    	if ( $('#payment_receipt').val() != '' && $('#payment_receipt').val() != undefined ) 
    	{
    		$('.payment_receipt_file').html('<i class="fa fa-spinner fa-spin"></i> Uploading...');
    	}

		$.ajax({
            url: "<?=site_url('registration-upload');?>",
            type: "POST",
            data: form_data,
            dataType: "json",
            processData: false,
            contentType: false,

            success: function (response) {
                
                console.log('response',response);

                var msg_title = "File Upload Fail!";
                var msg_content = response.error;
                var msg_status = "error";

                if ( response.rst == 1 )
                {
                	// msg_title = "File Upload Success!";
                	// msg_content = "";
                	// msg_status = "success";

                	$('#payment_receipt_uploaded').val(response.data.attachment_name);
                	$('.payment_receipt_file').html(response.data.attachment_preview);
                }
                else
                {
                	msg_title = "File Upload Fail!";
                	msg_content = response.error;
                	msg_status = "error";

                	swal({
						title: msg_title,
						html: msg_content,
						type: msg_status,
						allowOutsideClick: false
					}).then(function () {
						$("#form_registration").find('fieldset').eq(1).hide();
						$("#form_registration").stepy('step', 1);
					});

    				$('#payment_receipt_uploaded').val('');
    				$('.payment_receipt_file').html('');
                }
            },

            error: function (e) {
                console.log(e);
            }
        });

    	return false; 
	}); 

});

</script>

</body>
</html>