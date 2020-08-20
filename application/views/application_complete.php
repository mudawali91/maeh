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

<script>

$(function() {
});

</script>

<div class="row">
	<div class="col-md-12">

		<div class="wrapper-page" style="height: 0vh !important;">

			<div class="account-pages">
				<div class="account-box" style="max-width: 600px !important;">
					<div class="text-center account-logo-box" style="padding: 0px 0px 0px 0px !important;">
						<h2 class="text-uppercase">
							<?=$display_img;?>
							<?=$display_title;?>
						</h2>
					</div>
					<div class="account-content">
						<div class="m-b-10 text-center">

							<?=$display_message;?>

							<a href="<?=site_url("application-form");?>" role="button" class="btn btn-primary btn-bordered waves-effect waves-light m-t-30"> <i class="fa fa-arrow-left m-r-5"></i> <span>Back</span> </a>
						</div>

					</div>
				</div>
				<!-- end card-box-->
			</div>

		</div>
		<!-- end wrapper -->

	</div>
</div>

<!-- End row -->