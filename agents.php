<style>
.table td, .table th {
    font-size: 14px;
    word-break: break-all;
}
</style>
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <a href="<?php echo base_url() . 'dashboard'; ?>">Home</a>
                    <i class="fa fa-circle"></i>
                </li>
                <li>
                    <span>Agents</span>
                </li>
            </ul>
            <div class="page-toolbar">

            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- BEGIN PAGE TITLE-->
        <h1 class="page-title">
            <!--                            Material Design Form Controls
                                        <small>material design form inputs, checkboxes and radios</small>-->
        </h1>
		<div class="flashdata">
                            <div class="col-md-12">
                                <?php
                                if ($this->session->flashdata('flashError')) {
                                    echo $this->session->flashdata('flashError');
                                }

                                if ($this->session->flashdata('flashSuccess')) {
                                    echo $this->session->flashdata('flashSuccess');
                                }
                                ?>
                            </div>
                        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    
					<div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-users "></i>Agents List </div>
                                        <div class="tools"> </div>
                                    </div>
					
                    <div class="portlet-body">
                        
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="btn-group cutting-btn">
                                        <a id="sample_editable_1_new" class="btn sbold green" href="<?php echo base_url()?>Agents/addAgent"> Add Agent
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <table id="agentlistTable" class="table table-striped table-bordered table-hover table-checkable order-column" >
                            <thead>
                                <tr>

                                <th width="20%">Name</th>
								<th width="20%">Email</th>
								<th width="20%">Mobile No</th>
								<th width="15%">State</th>
								<th width="15%">City</th>
								<th width="10%">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
					</div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE TITLE-->

    </div>
    <!-- END CONTENT BODY -->
</div>
<script>

	function deleteAgentModel(iAgentId){
		$('#basic_'+iAgentId).modal('show');
	}
	
	
	
	function deleteAgent(iAgentId) {
        
		var url = "<?php echo base_url(); ?>Agents/deleteAgent/" + iAgentId; // the script where you handle the form input.
				$.ajax({
					type: "POST",
					url: url,
					dataType: 'json',
					data: {'iAgentId': iAgentId},
					//  async: false,
					success: function (result)
					{
						{
                            if (result == 1) {
                                $("#flashSuccess").html('<div class="alert alert-success alert-dismissable" id="msg"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>Agent deleted successfully.</div>').delay(3000).fadeOut("slow");
                                $('#agentlistTable').DataTable().ajax.reload();
                            } else {
                                $("#flashError").html('<div class="alert alert-danger alert-dismissable" id="msg"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>Something went wrong, Please try again.</div>').delay(3000).fadeOut("slow");
                            }
                        }
						$('#basic_'+iAgentId).modal('hide');
					}
				})
		
    }


	$.fn.createTable = function () {
        tables1 = $('#agentlistTable').DataTable(
                {
//                    "scrollY": 400,
                //    "scrollX": true,
                    "responsive": true,
//                    "bSort": false,
                    "pageLength": 5,
                    "language": {
                        "processing": "<img src='<?php echo base_url() . 'assets/img/ajaxload.gif' ?>'>"
                    },
                    "bProcessing": true,
                    "bServerSide": true,
                    'aaSorting': [],
                    "order": [],
                    autoWidth: true,
//                    "pagingType": "simple_numbers",
                    "ajax": "<?php echo base_url(); ?>Agents/getAgents",
                    "columnDefs": [
                        {
                            "targets": [5], // exeptions des ordres de triage
                            "orderable": false,
                        }]
                })
    }
//$('#companyemployeeclick').click(function () {
    $(document).ready(function () {
        $.fn.createTable();
        $("#msg").delay(3000).fadeOut("slow");
    });

</script>

