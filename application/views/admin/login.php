<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>MAEH | Login</title>
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

<body class="bg-account-pages" style="padding-bottom: 0;">

    <!-- HOME -->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">

                    <div class="wrapper-page">

                        <div class="account-pages">
                            <div class="account-box">
                                <div class="account-logo-box">
                                    <h2 class="text-uppercase text-center">
                                        <a href="" class="text-success">
                                            <span><img src="<?=base_url()?>img/logo-maeh-100x100.png" class="img-responsive" height="50"></span>
                                        </a>
                                    </h2>
									<h5 class="text-center text-uppercase font-bold m-b-5 m-t-5">MALAYSIAN ASSOCIATION OF <br /> ENVIRONMENTAL HEALTH <br /> (MAEH)</h5>
									<?=$this->session->flashdata('login_result');?>
									<p class="m-l-5 m-r-5 m-b-0">Login to your account</p>
                                </div>
                                <div class="account-content">
                                    <form class="form-horizontal" action="<?=site_url('admin/login')?>" method="POST">
                                        <div class="form-group m-b-20 row">
                                            <div class="col-12">
                                                <label for="username">Username</label>
                                               <input class="form-control input-sm" type="text" id="user_name" name="user_name" required="" value="<?=$this->session->flashdata('login_email');?>" placeholder="Enter your username">
                                            </div>
                                        </div>

                                        <div class="form-group row m-b-20">
                                            <div class="col-12">
                                                <a href="" class="text-muted pull-right"><small>Forgot your password?</small></a>
                                                <label for="password">Password</label>
												<input class="form-control input-sm" type="password" required="" id="user_password" name="user_password" placeholder="Enter your password">
                                            </div>
                                        </div>

                                        <div class="form-group row text-center m-t-10">
                                            <div class="col-12">
                                                <button class="btn btn-sm btn-block btn-primary waves-effect waves-light" type="submit"><i class="fa fa-sign-in fa-lg fa-fw"></i>Sign In</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end card-box-->


                    </div>
                    <!-- end wrapper -->

                </div>
            </div>
        </div>
      </section>
      <!-- END HOME -->
x
 <!-- App js -->
<script src="<?=base_url()?>assets/js/jquery.core.js"></script>
<script src="<?=base_url()?>assets/js/jquery.app.js"></script>

<script type="text/javascript">
</script>

</body>
</html>