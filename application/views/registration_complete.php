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
.bg-account-pages
{
	background: linear-gradient(to left, #4489e4, #5691c8);
}
</style>

<body class="bg-account-pages">

    <!-- Begin page wrapper -->
    <div id="wrapper">

    	<!-- Top Bar -->
	    <div class="topbar" style="background: #000000;">
		
			<div class="navbar navbar-custom">
				<div class="container" style="width: 100%; padding: 0;">
					<div class="row">
						<div class="col-md-2">
							<a href=""><img src="<?=base_url()?>img/logo-maeh-100x100.png" class="img-responsive" height="25"></a>
							<span style="font-size:16px;"><b>MAEH</b></span>
						</div>
						<div class="col-md-10 text-right">
							<button type="button" class="btn btn-sm btn-primary btn-bordered waves-effect w-md waves-light">Semakan Keahlian</button>
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

			                <div class="wrapper-page" style="height: 0vh !important;">

								<div class="account-pages">
									<div class="account-box" style="max-width: 600px !important;">
										<div class="text-center account-logo-box" style="padding: 10px 0px 0px 0px !important;">
											<h2 class="text-uppercase">
												<?=$display_img;?>
												<?=$display_title;?>
											</h2>
										</div>
										<div class="account-content">
											<div class="m-b-10 text-center">
												<?=$display_message;?>
												<a href="<?=site_url("registration-form");?>" role="button" class="btn btn-sm btn-primary btn-bordered waves-effect waves-light m-t-10"> <i class="fa fa-arrow-left m-r-5"></i> <span>Back</span> </a>
											</div>

										</div>
									</div>
									<!-- end card-box-->
								</div>

							</div>
							<!-- end wrapper -->

			            </div>
			        </div>

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
</script>

</body>
</html>