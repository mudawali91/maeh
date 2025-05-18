<style>

.input-group-addon 
{
	padding: 0.3rem 0.75rem !important;
	font-size: 12px;
}

</style>

<div class="row">
	<div class="col-12">
	    <div class="page-title-box">
	        <h4 class="page-title float-left">User List</h4>

	        <ol class="breadcrumb float-right">
	            <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
	            <li class="breadcrumb-item active">List</li>
	        </ol>

	        <div class="clearfix"></div>
	    </div>
	</div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-12">
        <div class="card-box">

            <!-- <h4 class="header-title m-b-15 m-t-0"></h4> -->

			<!-- start row filter and search -->
			<div class="col-md-12 m-l-5">
				<?php
				/*
				<h4 class="m-t-0 m-b-5 header-title">
					<span id="click_filter">Filter</span>
		        </h4>
		        */
		        ?>
		        <div class="div_form_filter">
			        <form id="form_filter" name="form_filter" action="" method="post" enctype="multipart/form-data">

						<div class="row m-t-20">
							<div class="col-sm-4">
								<div class="form-group">
									<label>Name</label>
									<input type="text" class="form-control input-sm" id="filter_name" name="filter_name" placeholder="Name" value="" />
								</div>
							</div>
							<div class="col-sm-4">
								<div class="form-group">
									<label>User Type</label>
									<select class="form-control select-sm select2_field" id="filter_user_type" name="filter_user_type">
									<option value="">All</option>
									<?php
										if ( is_array($user_type_list) && count($user_type_list) > 0 )
										{
											foreach ( $user_type_list as $key => $val )
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
							<div class="col-sm-4">
								<div class="form-group">
									<label>Status</label>
									<select class="form-control select-sm select2_field" id="filter_status" name="filter_status">
									<option value="">All</option>
										<option value="1">Active</option>
										<option value="2">Inactive</option>
									</select>
								</div>
							</div>
						</div>

						<div class="text-left">
							<button type="submit" name="btn_search" id="btn_search" class="btn btn-primary btn-bordered btn-sm"><i class="fa fa-search"></i> Search</button>
							<button type="button" name="btn_reset" id="btn_reset" class="btn btn-inverse btn-bordered btn-sm"><i class="fa fa-eraser"></i> Reset</button>
						</div>
					</form>
				</div>
			</div>
			<!-- end row filter and search -->

			<hr />

			<form id="form_table" name="form_table" action="" method="post" enctype="multipart/form-data">

				<div class="text-right">
					<button type="button" name="btn_delete_selected" id="btn_delete_selected" class="btn btn-danger btn-bordered btn-sm"><i class="fa fa-trash"></i> Delete Selected</button>
				</div>

                <div class="table-responsive" data-pattern="priority-columns">
		            <table class="table table-hover table-bordered table-colored table-primary" cellspacing="0" width="100%" id="datatable_custom">
		                <thead>
			                <tr>
			                    <th class="text-center no-sort">
				                    <div class="checkbox checkbox-single">
		                                <input type="checkbox" class="cb_all" id="cb_all" name="cb_all" value="">
		                                <label></label>
		                            </div>
			                    </th>
			                    <th class="text-center no-sort">Action</th>
			                    <th class="text-center no-sort">No</th>
			                    <th class="text-center">User Type</th>
			                    <th class="text-center">Name</th>
			                    <th class="text-center">Email</th>
			                    <th class="text-center">HP No</th>
			                    <th class="text-center">Last Login</th>
			                    <th class="text-center">Status</th>
			                </tr>
		                </thead>

		                <tbody>
		                </tbody>
		            </table>
		        </div>

				<input type="hidden" id="selected_id" name="selected_id" value="" />

			</form>	
        </div>
    </div><!-- end col -->
</div>
<!-- end row -->

<script type="text/javascript">

$(function(){

	$('#datatable_custom').DataTable({
	    "processing": true, 
	    "serverSide": true, 
	    "ajax": {
	        "url": "<?=site_url('admin/setting/user/list')?>",
	        "type": "POST",
	        data: function (d) {
				d.filter_name = $('#filter_name').val();
				d.filter_user_type = $('#filter_user_type').val();
				d.filter_status = $('#filter_status').val();
	        },
	    },
		"pageLength": 100,
	    "language": {
	        "emptyTable": "No data available in the table",
	        "processing": '<div class="alert input-sm m-l-5 m-r-5"><i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"></i>Processing...</div>' // add a loading image, simply putting <img src="loader.gif" /> tag.
	    },
		"searching": false, // disable searching
		"bLengthChange": false, // disable show entries
		"columnDefs": [ {
	          "targets": 'no-sort',
	          "orderable": false,
	    } ],
	    initComplete: function(setting,json){
	        $('.tooltips').tooltip();
	        $('table.table.table-hover.dataTable.no-footer,.dataTables_scrollHeadInner').css("min-width", "100%");
	        $(window).trigger('resize');
	    },
	    createdRow: function( row, data, dataIndex ) {
	    	$( row ).find('td:eq(0),td:eq(1),td:eq(2),td:eq(3),td:eq(6),td:eq(7),td:eq(8)').addClass('text-center');
	    },
	    order: [[ 4, "ASC" ]]
	});

	var arr_cb_val = [];
	
	// when click cb_all
    $("#cb_all").change(function(){
    	$(".cb_single").prop('checked', $(this).prop('checked'));

    	// clear selected_id array
    	arr_cb_val = [];

        $.each($(".cb_single:checked"), function(){            
            arr_cb_val.push($(this).val());
        });

        $("#selected_id").val( arr_cb_val.join(", ") );
	});

    // when click cb_single
	$('#datatable_custom').on('change','.cb_single',function(){
		
		// one of the cb_single is checked, then uncheck cb_all
        if (!$(this).prop("checked"))
        {
            $("#cb_all").prop("checked",false);
        }         

        // when total checked cb_single equal to total checkbox, then check cb_all
        var cb_total = $('.cb_single').length;
        var cb_checked = $('.cb_single:checked').length;

		if ( cb_checked == cb_total )
		{
			$("#cb_all").prop("checked", true);
		}

		// clear cb_val array
        arr_cb_val = [];

        $.each($(".cb_single:checked"), function(){            
            arr_cb_val.push($(this).val());
        });

        $("#selected_id").val( arr_cb_val.join(", ") );
	});

	// when click btn_view
	$('#datatable_custom').on('click','.btn_view',function(){

        var ids = $(this).attr('ids');

        location.href = "<?=site_url('admin/setting/user/form');?>/"+ids;
    });

    // when click button search
    $('#btn_search').on('click',function(e){

        $('#selected_id').val('');

        e.preventDefault();
        $('#datatable_custom').DataTable().draw();
    });

    // when click button reset
    $('#btn_reset').on('click',function(e){

        $('#filter_name').val('');
        $('#filter_user_type').val('').trigger('change');
        $('#filter_status').val('').trigger('change');
        $('#selected_id').val('');

        e.preventDefault();
        $('#datatable_custom').DataTable().draw();
    });

});	
	
</script>