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
    <link href="<?=base_url()?>assets/css/loader_lain.css" rel="stylesheet" type="text/css" />

    <script src="<?=base_url()?>assets/js/modernizr.min.js"></script>

    <!-- jQuery  -->
    <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
    <script src=<?=base_url()?>"assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/metisMenu.min.js"></script>
    <script src="<?=base_url()?>assets/js/waves.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.slimscroll.js"></script>

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

	<!-- Sweet-Alert  -->
	<script src="<?=base_url()?>plugins/sweet-alert2/sweetalert2.min.js"></script>

	<!-- Datepicker -->
	<script src="<?=base_url()?>plugins/moment/moment.js"></script>
	<script src="<?=base_url()?>plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
	
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

	var validation_error_exist = '';

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

</style>

<?php
	$required_field = '';
?>
<body>

    <!-- Begin page wrapper -->
    <div id="wrapper">

     	<!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->

    	<div class="content-page">
                
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
<!-- 
					       		<div id="area_error_message" class="panel panel-danger">
					  				<div class="panel-heading"><h5 style="color:#000000 !important;"><?=(isset($validation_notis_title) ? $validation_notis_title : '');?></h5></div>
					  				<div class="panel-body"><?=(isset($validation_notis_msg) ? $validation_notis_msg : '');?></div>
					  			</div>
 -->
								<p class="text-danger m-b-10 font-13">
									<em>(*) Compulsory Field</em>
								</p>

								<form id="form_registration" name="form_registration" action="<?=site_url("registration-submit"); ?>" method="post" enctype="multipart/form-data">

									<div class="row">

										<div class="col-md-6">
							                <div class="form-group">
							                    <label for="applicant_name">Name <?=STARFIELD;?></label>
							                    <input type="text" name="applicant_name" id="applicant_name" parsley-trigger="change" <?=$required_field;?> placeholder="Name" class="form-control input-sm turn_uppercase" value="" />
							                </div>
							                <div class="form-group">
							                    <label for="applicant_icno">NRIC No <?=STARFIELD;?></label>
							                    <input type="text" name="applicant_icno" id="applicant_icno" parsley-trigger="change" <?=$required_field;?> placeholder="NRIC No" class="form-control input-sm mask_nric" value="" />
							                </div>
							                 <div class="form-group">
							                    <label for="applicant_address_office">Address - Office</label>
							                    <textarea name="applicant_address_office" id="applicant_address_office" rows="5" style="resize: none; margin-top: 0px; margin-bottom: 0px; height: 100px; " parsley-trigger="change" placeholder="Address - Office" class="form-control input-sm turn_uppercase"></textarea>
							                </div>
							                <div class="form-group">
							                    <label for="applicant_phoneno">Office Tel / HP No <?=STARFIELD;?></label>
							                    <input type="text" name="applicant_phoneno" id="applicant_phoneno" parsley-trigger="change" <?=$required_field;?> placeholder="Office Tel / HP No" class="form-control input-sm mask_phone" value="" />
							                </div>
							            </div>
								 		<!-- end col-md-6 --> 

							            <div class="col-md-6">
							               <div class="form-group">
							                    <label for="applicant_email">Email Address</label>
							                    <input type="text" name="applicant_email" id="applicant_email" parsley-trigger="change" placeholder="Email Address" class="form-control input-sm" value="" />
							                </div>
							                <div class="form-group">
							                    <label for="applicant_dob">Date of Birth <?=STARFIELD;?></label>
							                	<input type="text" name="applicant_dob" id="datepicker-applicant_dob" parsley-trigger="change" <?=$required_field;?> placeholder="dd/mm/yyyy" class="form-control input-sm" value="" />
							                </div>
							                <div class="form-group">
							                    <label for="applicant_address_home">Address - Home <?=STARFIELD;?></label>
							                    <textarea name="applicant_address_home" id="applicant_address_home" rows="5" style="resize: none; margin-top: 0px; margin-bottom: 0px; height: 100px; " parsley-trigger="change" <?=$required_field;?> placeholder="Permanent - Home" class="form-control input-sm turn_uppercase"></textarea>
							                </div>
							                <div class="form-group">
							                    <label for="applicant_phoneno_home">Home Tel No</label>
							                    <input type="text" name="applicant_phoneno_home" id="applicant_phoneno_home" parsley-trigger="change" placeholder="Home Tel No" class="form-control input-sm mask_phone" value="" />
							                </div>
							            </div>
								 		<!-- end col-md-6 -->

						        	</div>
								 	<!-- end row --> 

									<div class="row m-t-10">
 
							            <div class="col-md-12">
							            	<label><b class="font-13">Qualifications</b></label>
									 		<div class="table-responsive">
		                                        <table id="table_qualification" class="table m-0 table-colored table-primary">
		                                            <thead>
			                                            <tr>
			                                                <th width="10%">Qualification</th>
			                                                <th width="35%">Title/Result</th>
			                                                <th width="10%">Year</th>
			                                                <th width="45%">School/College/University</th>
			                                            </tr>
		                                            </thead>
		                                            <tbody>
		                                            <?php
		                                            	if ( is_array($qualification_categories) && count($qualification_categories) > 0 )
		                                            	{
		                                            		foreach ( $qualification_categories as $key => $val )
		                                            		{
		                                            ?>
			                                            <tr>
			                                                <th scope="row">
			                                                	<input type="hidden" name="qualification_category[]" id="qualification_category_<?=$key;?>" class="form-control input-sm" value="<?=$key;?>" />
			                                                	<?=$val;?>
			                                                </th>
			                                                <td>
			                                                	<input type="text" name="qualification_title[]" id="qualification_title_<?=$key;?>" class="form-control input-sm turn_uppercase" value="" />
			                                                </td>
			                                                <td>
			                                                	<input type="text" name="qualification_year[]" id="qualification_year_<?=$key;?>" class="form-control input-sm turn_uppercase qualification_year" value="" />
			                                                </td>
			                                                <td>
			                                                	<input type="text" name="qualification_institution[]" id="qualification_institution_<?=$key;?>" class="form-control input-sm turn_uppercase" value="" />
			                                                </td>
			                                            </tr>
			                                        <?php
			                                        		}
			                                        	}
			                                        ?>    
		                                            </tbody>
		                                        </table>
		                                    </div>
	                                    </div>
								 		<!-- end col-md-12 --> 

						        	</div>
								 	<!-- end row m-t-10 --> 

									<div class="row m-t-10">

							            <div class="col-md-12">
								 			<div class="form-group">
							                    <label for="job_position">Current Post</label>
							                    <input type="text" name="job_position" id="job_position" parsley-trigger="change" placeholder="Current Post" class="form-control input-sm" value="" />
							                </div>
							            </div>
								 		<!-- end col-md-12 --> 

						        	</div>
								 	<!-- end row m-t-10 --> 

								 	<div class="row m-t-10">
 
							            <div class="col-md-12">
							            	<label><b class="font-13">State whether you are a member of any organization (the full name of the organization, any post held)</b></label>
									 		<div class="table-responsive">
		                                        <table id="table_other_organization" class="table m-0 table-colored table-primary">
		                                            <thead>
			                                            <tr>
			                                                <th width="70%">Organization</th>
			                                                <th width="30%">Post</th>
		                                            </thead>
		                                            <tbody>
			                                            <tr>
			                                                <td>
			                                                	<input type="text" name="organization_name[]" id="organization_name_<?=$key;?>" class="form-control input-sm turn_uppercase" value="" placeholder="Organization" />
			                                                </td>
			                                                <td>
			                                                	<input type="text" name="organization_post[]" id="qualification_post_<?=$key;?>" class="form-control input-sm turn_uppercase" value="" placeholder="Post" />
			                                                </td>
			                                            </tr>
		                                            </tbody>
		                                        </table>
		                                    </div>
	                                    </div>
								 		<!-- end col-md-12 --> 

						        	</div>
								 	<!-- end row m-t-10 --> 

									<div class="row m-t-10">

										<div class="col-md-12">
								            <div class="checkbox checkbox-success">
							                    <input type="checkbox" class="custom-control-input" id="application_payment" name="application_payment" value="1" />
							                    <label class="custom-control-label font-13" for="application_payment">I enclosed herewith payment receipt for RM39.00 being the payment of yearly subscription RM36.00 and entrance fee RM3.00.<br />For students, yearly subscription RM10.00 and entrance fee RM3.00.</label>
							                </div> 
							            </div>
								 		<!-- end col-md-12 --> 

										<div class="col-md-6">
							                <div class="form-group">
												<label for="payment_receipt">Payment Receipt <?=STARFIELD;?></label>
						                        <input type="file" id="payment_receipt" name="payment_receipt" parsley-trigger="change" <?=$required_field;?> class="form-control input-sm-file" />
												<span class="help-block text-primary">
													<small id="payment_receipt_description">
														[Allowed types: jpg, png, gif, pdf]<br />
														[Allowed size: < 2MB]
													</small>
												</span>
						                    </div>
							            </div>	
								 		<!-- end col-md-6 --> 

								 		<div class="col-md-12">
								            <div class="checkbox checkbox-success">
							                    <input type="checkbox" class="custom-control-input" id="application_agreement" name="application_agreement" value="1" />
							                    <label class="custom-control-label font-13" for="application_agreement">I agree to abide by the Rules of the Persatuan Kesihatan Environmen Malaysia.</label>
							                </div> 
							            </div>
								 		<!-- end col-md-12 --> 

							        </div>
								 	<!-- end row m-t-10 --> 

									<div class="m-t-20">
					                	<button type="submit" id="btn_submit" name="btn_submit"  class="btn btn-sm btn-success waves-effect waves-light">Submit</button>
							        </div>
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

</body>
</html>