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

    <!-- jQuery  -->
    <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/js/tether.min.js"></script><!-- Tether for Bootstrap -->
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/metisMenu.min.js"></script>
    <script src="<?=base_url()?>assets/js/waves.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.slimscroll.js"></script>

	<!-- Sweet-Alert  -->
	<script src="<?=base_url()?>plugins/sweet-alert2/sweetalert2.min.js"></script>

	<!-- Datepicker -->
	<script src="<?=base_url()?>plugins/moment/moment.js"></script>
	<script src="<?=base_url()?>plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
	
	<!-- Loading Spinner -->
	<link href="<?=base_url();?>plugins/spinkit/spinkit.css" rel="stylesheet" />
    <script src="<?=base_url();?>assets/js/waves.js"></script>

</head>

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

.panel-heading
{
	padding: 10px 10px 0 10px !important;
}
.panel .panel-body
{
	padding: 10px 10px !important;
}
.account-box .account-content {
    padding: 0px 30px 0px 30px;
}

/* custom sweet alert */
.swal2-modal .swal2-title {
    font-size: 20px;
}

</style>

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
							<a href="<?=site_url("registration-form");?>" role="button" class="btn btn-sm btn-primary btn-bordered waves-effect w-md waves-light"> <span>Registration Form</span> </a>
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
                
            <!-- Start content -->
            <div class="content col-md-10">
                <!-- Start container -->
            	<div class="container container-fluid">

			        <div class="row">
			            <div class="col-sm-12">

			            	<div class="card-box mb-0">

					        	<div class="text-center">
					        		<a href=""><img src="<?=base_url()?>img/logo-maeh-100x100.png" class="img-responsive"/></a>
					            	<h4 class="m-t-0 text-dark">REGISTRATION STATUS</h4>
					            	<h5 class="m-t-0 text-dark"><b>PERSATUAN KESIHATAN ENVIRONMEN MALAYSIA</b></h5>
					            	<h5 class="m-t-0 text-dark"><b>MALAYSIAN ASSOCIATION OF ENVIRONMENTAL HEALTH (MAEH)</b></h5>
					            	<h5 class="m-t-0 text-dark"><b>(REGISTRATION NO: PPM-001-14-14041990)</b></h5>
					            	<p class="text-muted m-b-30 font-14">
					            	</p>
					            </div>

				                <div class="wrapper-page" style="height: 0vh !important;">

									<div class="account-pages pb-0">
										<div class="account-box" style="max-width: 500px !important; margin: 0 auto;">
											<div class="text-center account-logo-box" style="padding: 0 !important;">
											</div>
											<div class="account-content">
												<div class="d-flex justify-content-center">
													<form class="form-inline" id="form_registration_status" name="form_registration_status" action="" method="post" enctype="multipart/form-data">
											            <div class="form-group m-r-10">
											            	<label for="icno" class="mr-sm-2 font-bold">IC No</label>
											                <input type="text" name="icno" id="icno" parsley-trigger="change" placeholder="IC No" class="form-control input-sm mask_nric" value="" />
					                                    </div>
								            			<button type="button" class="btn btn-sm btn-primary" id="btn_check_status"><i class="fa fa-spin fa-spinner spinner-status hilang"></i> Check Status</button>
										        	</form>
												</div>
												<div id="status_msg" class="p-l-r-10 p-t-10 text-dark text-center">
												</div>
											</div>
										</div>
										<!-- end card-box-->
									</div>

								</div>
								<!-- end wrapper -->

					        </div> <!-- end card-box -->

			            </div>
			        </div> <!-- end row -->

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

$(function(){
	
	$('#btn_check_status').click(function(){

		var icno = $('#icno').val();

		$('#status_msg').html('');

		var error_msg = '';

		if ( icno == '' || icno == undefined )
		{
			error_msg = 'Please key in your IC No!';

			swal({
					title: error_msg,
					html: '',
					type: 'warning',
					allowOutsideClick: false
				}).then(function () {
				});
		}
		else
		{
			$(this).find('.spinner-status').removeClass('hilang');

			$.ajax({
				type: "POST",
				url: "<?php echo site_url('registration-status/get')?>",
				data: { icno : icno },
				dataType: 'json',
				cache: false,
				success: function(response) {
					// console.log("response",response);

					$('#btn_check_status > i').addClass('hilang');

					if ( response.rst == -1 )
					{
						swal({
							title: response.msg, // 'Ops! Something wrong with your input data',
							html: '',
							type: 'warning',
							allowOutsideClick: false
						}).then(function () {
						});
					}
					else
					{
						$('#status_msg').html(response.msg);
					}
				},
				complete: function(){
				}
			});
		}
	});

});	

</script>

</body>
</html>