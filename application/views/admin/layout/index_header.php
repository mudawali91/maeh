<head>
    <meta charset="utf-8" />
    <title>MAEH | Administrator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta content="MAEH Registration System" name="description" />
    <meta content="Muda Wali" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?=base_url()?>img/logo-maeh-16x16.png">

    <!-- Plugin css -->

    <!-- Datatable css -->
	<link href="<?=base_url()?>plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="<?=base_url()?>plugins/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

	<!-- Select2 css (search inside dropdown list) -->
	<link href="<?=base_url()?>plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />

	<!-- Summernote css -->
	<!-- <link href="<?=base_url()?>plugins/summernote/summernote.css" rel="stylesheet" /> -->

	<!-- Sweet Alert css -->
	<link href="<?=base_url()?>plugins/sweet-alert2/sweetalert2.min.css" rel="stylesheet" type="text/css">

	<!-- Datepicker css -->
	<link href="<?=base_url()?>plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

    <!-- App css -->
    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/css/metismenu.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url()?>assets/css/loader_lain.css" rel="stylesheet" type="text/css" />

    <script src="<?=base_url()?>assets/js/modernizr.min.js"></script>

    <!-- App js -->
    <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/js/tether.min.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/metisMenu.min.js"></script>
    <script src="<?=base_url()?>assets/js/waves.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.slimscroll.js"></script>

    <!-- jQuery Form Validation -->
    <script src="<?=base_url()?>plugins/jquery-validation/js/1.19.0/jquery.validate.min.js"></script>
    <script src="<?=base_url()?>plugins/jquery-validation/js/1.19.0/additional-methods.min.js"></script>

	<!-- Required datatable js -->
    <script src="<?=base_url()?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=base_url()?>plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="<?=base_url()?>plugins/datatables/dataTables.buttons.min.js"></script>
    <script src="<?=base_url()?>plugins/datatables/buttons.bootstrap4.min.js"></script>
    <script src="<?=base_url()?>plugins/datatables/jszip.min.js"></script>
    <script src="<?=base_url()?>plugins/datatables/pdfmake.min.js"></script>
    <script src="<?=base_url()?>plugins/datatables/vfs_fonts.js"></script>
    <script src="<?=base_url()?>plugins/datatables/buttons.html5.min.js"></script>
    <script src="<?=base_url()?>plugins/datatables/buttons.print.min.js"></script>
    <script src="<?=base_url()?>plugins/datatables/buttons.colVis.min.js"></script>
    <!-- Responsive examples -->
    <script src="<?=base_url()?>plugins/datatables/dataTables.responsive.min.js"></script>
    <script src="<?=base_url()?>plugins/datatables/responsive.bootstrap4.min.js"></script>

	<!-- Select 2 js (search inside dropdown list) -->
    <link href="<?=base_url()?>plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
	<script src="<?=base_url()?>plugins/select2/js/select2.min.js" type="text/javascript"></script>

	<!-- Summernote js -->
	<!-- <script src="<?=base_url()?>plugins/summernote/summernote.min.js"></script> -->

	<!-- Sweet-Alert js -->
	<script src="<?=base_url()?>plugins/sweet-alert2/sweetalert2.min.js"></script>

	<!-- Datepicker js -->
	<script src="<?=base_url()?>plugins/moment/moment.js"></script>
	<script src="<?=base_url()?>plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
	
	<!-- Loading Spinner -->
	<link href="<?=base_url();?>plugins/spinkit/spinkit.css" rel="stylesheet" />
    <script src="<?=base_url();?>assets/js/waves.js"></script>

</head>

<style type="text/css">

	body.enlarged {
		min-height: 0 !important;
	}

	.navbar-custom, .button-menu-mobile, .notification-list .noti-title {
		background-color: #4489e4 !important;
	}

	.pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus, .page-item.active .page-link {
		background-color: #4489e4 !important;
		border-color: #4489e4 !important;
	}

	.tabs-bordered li a.active {
		border-color: #4489e4 !important;
	}

	.hilang {
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

	.footer
	{
		padding: 10px 30px 0 !important;
		background: #000000 !important; 
	}

	.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th
	{
		padding: 5px 10px !important;
		font-size: 12px !important;
	}

	#datatable_custom_paginate > ul.pagination, #datatable_custom_info
	{
		font-size: 12px !important;
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

<script type="text/javascript">

function loading_on()
{
	$('.loading_cloone').show();
}

function loading_off()
{
	$('.loading_cloone').hide();
}

$(function(){

	$(".select2_field").select2();
	$('.date_picker').datepicker({
		format: 'dd-mm-yyyy'
	});

	$('#datatable').DataTable({
		"pageLength": 50,
		"columnDefs": [ {
	          "targets": 'no-sort',
	          "orderable": false,
	    } ]
	});

	// $('.div_form_filter').hide();
	// $('.btn_expand_filter').on('click',function(){
	// 	if( $(this).hasClass('fa-plus') )
	// 	{
	// 		$(this).removeClass('fa-plus').addClass('fa-minus');
	// 		$('.div_form_filter').slideDown('400');
			
	// 	}
	// 	else
	// 	{
	// 		$(this).removeClass('fa-minus').addClass('fa-plus');
	// 		$('.div_form_filter').slideUp('400');
			
	// 	}
	// });

});

</script>