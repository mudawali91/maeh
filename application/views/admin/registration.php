<style>
</style>

<div class="row">
	<div class="col-12">
	    <div class="page-title-box">
	        <h4 class="page-title float-left">Registration List</h4>

	        <ol class="breadcrumb float-right">
	            <li class="breadcrumb-item">Registration</li>
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
			<form id="form_table" name="form_table" action="" method="post" enctype="multipart/form-data">
	            <!-- <h4 class="header-title m-b-15 m-t-0"></h4> -->

	            <div class="text-center m-b-30">
	                <div class="row">
	                    <div class="col-xs-6 col-sm-3">
	                        <div class="m-t-20 m-b-20">
	                            <h3 class="m-b-10">25563</h3>
	                            <p class="text-uppercase m-b-5 font-13 font-600">Total</p>
	                        </div>
	                    </div>
	                    <div class="col-xs-6 col-sm-3">
	                        <div class="m-t-20 m-b-20">
	                            <h3 class="m-b-10 text-warning">6952</h3>
	                            <p class="text-uppercase m-b-5 font-13 font-600">Pending</p>
	                        </div>
	                    </div>
	                    <div class="col-xs-6 col-sm-3">
	                        <div class="m-t-20 m-b-20">
	                            <h3 class="m-b-10 text-success">18361</h3>
	                            <p class="text-uppercase m-b-5 font-13 font-600">Approved</p>
	                        </div>
	                    </div>
	                    <div class="col-xs-6 col-sm-3">
	                        <div class="m-t-20 m-b-20">
	                            <h3 class="m-b-10 text-danger">250</h3>
	                            <p class="text-uppercase m-b-5 font-13 font-600">Rejected</p>
	                        </div>
	                    </div>
	                </div>
	            </div>

	            <table class="table table-hover table-bordered table-colored table-primary" cellspacing="0" width="100%" id="datatable_custom">
	                <thead>
		                <tr>
		                    <th class="text-center no-sort">
			                    <div class="checkbox checkbox-single">
	                                <input type="checkbox" class="cb_all" id="cb_all" name="cb_all" value="">
	                                <label></label>
	                            </div>
		                    </th>
		                    <th class="text-center">No</th>
		                    <th class="text-center">Name</th>
		                    <th class="text-center">IC No</th>
		                    <th class="text-center">HP No</th>
		                    <th class="text-center">Address</th>
		                    <th class="text-center">Registered Date</th>
		                    <th class="text-center">Status</th>
		                    <th class="text-center no-sort">Action</th>
		                </tr>
	                </thead>

	                <tbody>
	                </tbody>
	            </table>

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
	        "url": "<?=site_url('admin/registration/list')?>",
	        "type": "POST",
	        data: function (d) {
				d.filter_major = ''; // $('#filter_major').val();
				d.filter_status = ''; // $('#filter_status').val();
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
	    	$( row ).find('td:eq(0),td:eq(1),td:eq(6),td:eq(7),td:eq(8)').addClass('text-center');
	    },
	    order: [[ 6, "DESC" ]]
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

        location.href = "<?=site_url('admin/registration');?>/"+ids;
    });

});	
	
</script>