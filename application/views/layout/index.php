<!DOCTYPE html>
<html>
    
    <?php if ( $index_header ) echo $index_header; ?>

    <body>

        <!-- Begin page wrapper -->
        <div id="wrapper">

			<!-- ########## START: HEAD LOGO PANEL ########## -->
            <?php if ( $index_top_logo ) echo $index_top_logo; ?>
            <!-- ########## END: HEAD LOGO PANEL ########## -->

		
            <!-- ########## START: HEAD PANEL ########## -->
            <?php //if ( $index_top_menu ) echo $index_top_menu; ?>
            <!-- ########## END: HEAD PANEL ########## -->


            <!-- ########## START: LEFT PANEL ########## -->
            <?php //if ( $index_left_menu ) echo $index_left_menu; ?>
            <!-- ########## END: LEFT PANEL ########## -->

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

	                    <?php flash_output('notis'); ?>
	                    <?php if ( $middle ) echo $middle; ?>

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