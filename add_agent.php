<style>
    #radioBtn .notActive{
        color: #3276b1;
        background-color: #fff;
    }
    .space{
        margin-left: 20px;
    }
    #userStatus,#moduleLabel{
        display:block !important;
    }
	label.error{color:red !important;}
	
</style>

<div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
				<!-- BEGIN PAGE BAR -->
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="<?php echo base_url(); ?>agents">Agents</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Add Agent</span>
                                </li>
                            </ul>
						</div>
				<!-- ENFING PAGE BAR -->
					 <!-- BEGIN PAGE TITLE-->
                       <h1 class="page-title cstheader"> <i class="fa fa-server font-dark csticon"></i>   Add Agent
                        </h1>
                     <!-- END PAGE TITLE-->	
						<div class="row">
                            <div class="col-md-12 ">
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet light bordered">
                                   
                                    <div class="portlet-body form">
                                     <form method="post" enctype="multipart/form-data" id="addAgent" name="addAgent">
										 <div class="box-header with-border">
												<div id="flashError"></div>
												<div id="success"></div>
										</div>
                                            <div class="form-body">
											
                                         
											<div class="row">
												<div class="col-md-6"> 
													<div class="form-group form-md-line-input form-md-floating-label">
													  <label for="vName">Agent Name<span class="required">*</span></label>
														<input type="text" name="vName" placeholder="Enter agent name"  class="form-control" id="vName"  tabindex="1" required>
													   <label style="color:red;" id="vName-error" class="error" for="vName"></label>
													  
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group form-md-line-input form-md-floating-label">
													  <label for="vEmail">Email</label>
														<input type="email" name="vEmail" placeholder="Enter email"  class="form-control" id="vEmail" tabindex="2" >
													   <label style="color:red;" id="vEmail-error" class="error" for="vEmail"></label>  
													</div>
												</div>
											</div>
											
											<div class="row">
											
											<div class="col-md-6"> 		
												 <div class="form-group form-md-line-input form-md-floating-label">
													  <label for="iStateId">State<span class="required">*</span></label>
														<select name="iStateId" onChange="getCity(this.value);" id="iStateId" class="form-control" tabindex="3" required>
															<option value="">Select State</option>
															<?php
																if (!empty($stateList)) {
																	foreach ($stateList as $state) {
																		echo '<option value="' . $state->id . '">' . $state->state . ' </option>';
																	}
																}
																?>
														</select>
														<label style="color:red;" id="iStateId-error" class="error" for="iStateId"></label>
												  </div>
											</div>
											<div class="col-md-6"> 		
												 <div class="form-group form-md-line-input form-md-floating-label">
													  <label for="iCityId">City<span class="required">*</span></label>
														<select name="iCityId" tabindex="4" id="city-list" class="form-control" >
																<option value="">Select City</option>
										
														</select>
														
														<label style="color:red;" id="city-list-error" class="error" for="city-list"></label>
												  </div>
											</div>
											</div>
											
											
											<div class="row">
												<div class="col-md-6"> 
													<div class="form-group form-md-line-input form-md-floating-label">
													  <label for="tAddress">Address</label>
														<input type="text" name="tAddress" tabindex="5" class="form-control" id="tAddress" placeholder="Enter address" >
													   <label style="color:red;" id="tAddress-error" class="error" for="tAddress"></label>
													</div>
												</div>
												<div class="col-md-6"> 
													<div class="form-group form-md-line-input form-md-floating-label">
													  <label for="vPincode">Pincode<span class="required">*</span></label>
														<input type="text" name="vPincode" tabindex="6" placeholder="Enter pincode"  class="form-control" id="vPincode"  required>
													   <label style="color:red;" id="vPincode-error" class="error" for="vPincode"></label>
													  
													</div>
												</div>
												
												
												
											</div>
											<div class="row">
												<div class="col-md-6"> 	
													<div class="form-group form-md-line-input form-md-floating-label">
													  <label for="form_control">Mobile<span class="required">*</span></label>
														<input type="number" tabindex="7" name="vMobile" class="form-control" id="vMobile" placeholder="Enter mobile"  required>  
														<label style="color:red;" id="vMobile-error" class="error" for="vMobile"></label>
													</div>
												</div>
												<div class="col-md-6"> 
												<div class="form-group form-md-line-input form-md-floating-label">
													<label for="vLandline">Landline</label>
													<input type="number" tabindex="8" name="vLandline"  class="form-control" id="vLandline" placeholder="Enter landline" >
													<label style="color:red;" id="vLandline-error" class="error" for="vLandline"></label>
												</div>
											</div>
												
												
											</div>
                                            <div class="row">
												<div class="col-md-6"> 
													<div class="form-group form-md-line-input form-md-floating-label">
														<label>Agent Type<span class="required">*</span></label>
														<div class="md-radio-inline">
															<div class="md-radio">
																<input type="radio" id="eAgentType"   name="eAgentType" class="md-radiobtn" value="supplier" checked>
																<label for="eAgentType">
																	<span></span>
																	<span class="check" ></span>
																	<span class="box" tabindex="9"></span> Supplier </label>
															</div>
															<div class="md-radio">
																<input type="radio" id="radio2" name="eAgentType" class="md-radiobtn" value="vendor" >
																<label for="radio2">
																	<span></span>
																	<span class="check"></span>
																	<span class="box" tabindex="10"></span> Vendor </label>
															</div>
															<div class="md-radio">
																<input type="radio" id="radio3" name="eAgentType" class="md-radiobtn" value="both" >
																<label for="radio3">
																	<span></span>
																	<span class="check"></span>
																	<span class="box" tabindex="11"></span> Both </label>
															</div>

														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group form-md-line-input form-md-floating-label">
														<label for="iCommission">Commission (%)</label>
														<input type="number" tabindex="8" name="iCommission"  class="form-control" id="iCommission" placeholder="Enter Commission" >
														<label style="color:red;" id="iCommission-error" class="error" for="iCommission"></label>
													</div>
												</div>
											</div>
										<div class="row">												
										   <div class="col-md-8">
												<div class="form-group form-md-line-input form-md-floating-label">
												  <label for="vContactPerson">Contact Person</label>
												 
													<div class="itemCls cstError">
														<div class="row itemCls_0 jumpclass" id='div_1'>
															<div class="col-md-3">
															<label style="color:red;"  id="lContactperson[0][name]-error" class="error" for="lContactperson[0][name]"></label>
																<input type="text" tabindex="12"  name="lContactperson[0][name]" pattern="^[a-zA-Z ]*$" title="Alphabets only" placeholder="Contact Person"  class="form-control"   >
															</div>
															<div class="col-md-4">
															<label style="color:red;"  id="lContactperson[0][email]-error" class="error" for="lContactperson[0][email]"></label>
																<input type="email"  title="Email only" tabindex="13"  name="lContactperson[0][email]" placeholder="Enter Email"  class="form-control" value="" >
															</div>
															<div class="col-md-3">
															<label style="color:red;"  id="lContactperson[0][mobile]-error" class="error" for="lContactperson[0][mobile]"></label>
																<input type="number" pattern="^[0-9]+$" title="Numbers only" tabindex="14"  name="lContactperson[0][mobile]" placeholder="Enter mobile"  class="form-control" value="" >
															</div>
															<div class="col-md-2" ><button  type="button" tabindex="15" class="btn btn-md btn-l purple contactadd"><i class="fa fa-plus"></i> Add </button></div>
														</div>
													</div>	
												</div>
												</div>
											
								</div>	
											
												<div class="form-actions noborder">
													<button type="reset" class="btn btn-danger cstclr" tabindex="17" onclick="window.location.replace('<?php echo base_url(); ?>agents');">Back</button>
													<button type="submit" class="btn btn-success cstback" tabindex="16" >Submit</button>
												</div>
											

											
                                           
                                        </form>
                                    </div>
                                </div>
                                <!-- END SAMPLE FORM PORTLET-->
                               
                               
                               
                            </div>
                            <!-- END SAMPLE FORM PORTLET-->
                        </div>
				</div>
				
				</div>
				</div>

<script>
    $(document).ready(function () {
		$('#vName').focus();
        $('#vName').keyup(function () {
            $(this).val($(this).val().toUpperCase());
        });
        $('#vCity').keyup(function () {
            $(this).val($(this).val().toUpperCase());
        });
		$('#city-list').select2({
			placeholder: "Select City",
			allowClear: true
		});
		$('#iStateId').select2({
			placeholder: "Select State",
			allowClear: true
		});
		jQuery.validator.addMethod("selectnic", function (value, element) {
            if (/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value)) {
                return true;
            } else {
                return false;
            }
            ;
        }, "wrong nic number");
        $('.loading').hide();
        jQuery.validator.addMethod("lettersonly", function (value, element) {
            return this.optional(element) || /^[a-zA-Z ]+$/i.test(value);
        }, "Please enter letters only");
        $("#addAgent").validate({
            rules: {
				vName: {
                    required: true,
                    lettersonly: true
                },
				vEmail: {
                    email: true
                },
				iStateId: {
                    required: true
                },
				iCityId: {
                    required: true
                },
				vMobile: {
					min : 0,
					required: true,
					number : true,
					minlength:8,
					maxlength:12
				},
				vLandline: {
					min : 0,
					number : true,
					minlength:6,
					maxlength:12
				},
				vPincode: {
					number : true,
					minlength:6
				}
            },
            messages: {
				vName: {
                    required: "Please enter agent name.",
                },
				vEmail: {
                    email: "Please enter email in proper format."
                },
				iStateId: {
                    required: "Please select state.",
                },
				iCityId: {
                    required: "Please select city.",
                },
				vMobile: {
					required: "Please enter mobile.",
					min:"Please enter minimum 0.",
				    number : "Only numbers are allowed",
				    minlength:"Minimum 8 digits allowed.",
					maxlength:"Maximum 12 digits allowed"
				},
				vLandline: {
				    number : "Only numbers are allowed",
					min:"Please enter minimum 0.",
				    minlength:"Minimum 6 digits allowed.",
					maxlength:"Maximum 12 digits allowed"
				},
				vPincode: {
					 required: "Please enter pincode.",
					 number : "Only numbers are allowed",
					 minlength:"Minimum 6 digits allowed.",
				}
            },
            submitHandler: function (form) {
				
                $(".loading").show();
                $("#flashError").html('');
                $("#flashSuccess").html('');
                $("#flashSuccess").css('display', 'block');
                $("#flashError").css('display', 'block');
                var url = "<?php echo base_url(); ?>Agents/addAgent/"; // the script where you handle the form input.

                var formData = new FormData($(form)[0]);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData, // serializes the form's elements.
//                    async: false,
                    dataType: 'json',
                    beforeSend: function () {
                        $(".loading").show();
                    }, complete: function () {
                        $(".loading").hide();
                    },
                    success: function (data)
                    {
						if (data.response == 'fail') {
                            $("#flashError").html('<div class="alert alert-danger" ><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' + data.responseMsg + '</div>').delay(3000).fadeOut("slow");
                        } else {
                            $("#flashSuccess").html('<div class="alert alert-success alert-dismissable" id="msg"><button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' + data.responseMsg + '</div>').delay(3000).fadeOut("slow");
                            window.location = "<?php echo base_url(); ?>agents";
                        }

                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        });
    });
</script>
<script>
function getCity(val){
	$.ajax({
	type: "POST",
	url: "<?php echo base_url();?>dealer/getCities/",
	data:'iStateId='+val,
	success: function(data){
		$("#city-list").html(data);
	}
	});
}
</script>
<script>
$(".contactadd").click(function(){

		  var total_element = $(".jumpclass").length;
		   //console.log(total_element);
		  var lastid = $(".jumpclass:last").attr("id");
		  //console.log(total_element);
		  var split_id = lastid.split("_");
		  var nextindex = Number(split_id[1]) + 1;

		  var max = 10;
		  
		  if(total_element < max ){
		   $(".jumpclass:last").after("<div class='row itemCls_0 jumpclass' id='div_"+ nextindex +"'></div>");
		 
		    $("#div_" + nextindex).append('<br><div class="col-md-3"><label style="color:red;" id="lContactperson' + nextindex + '[name]-error" class="error" for="lContactperson"' + nextindex + '"[name]"></label><input type="text" name="lContactperson[' + nextindex + '][name]" pattern="^[a-zA-Z ]*$" title="Alphabets only" placeholder="Contact Person"  class="form-control" id=""   ></div><div class="col-md-4"><label style="color:red;" id="lContactperson' + nextindex + '[email]-error" class="error" for="lContactperson"' + nextindex + '"[email]"></label><input type="email" name="lContactperson[' + nextindex + '][email]"  title="Email only" placeholder="Enter Email"  class="form-control" id=""   ></div><div class="col-md-3"><label style="color:red;" id="lContactperson' + nextindex + '[mobile]-error" class="error" for="lContactperson' + nextindex + '[mobile]"></label><input type="number" pattern="^[0-9]+$" title="Numbers only" name="lContactperson[' + nextindex + '][mobile]" placeholder="Enter mobile"  class="form-control" value="" ></div><div class="col-md-2" ><button  type="button" id="remove_' + nextindex + '" class="btn btn-sm red contactremove"><i class="fa fa-remove"></i>&nbsp;Remove</button></div>');
		 
		  }
		 
		 });
		   $('.itemCls').on('click','.contactremove',function(){
 
			  var id = this.id;
			  var split_id = id.split("_");
			  var deleteindex = split_id[1];

			  // Remove <div> with id
			  $("#div_" + deleteindex).remove();

			 });
		 function addDetail(parent) {
		
		//console.log(parent);
        var index = $(".itemCls").children().length;
		//console.log(index);
		$(".itemCls").append('<div class="row itemCls_'+ index +'"><div class="col-md-5"><label style="color:red;" id="lContactperson'+ index +'[name]-error" class="error" for="lContactperson"' + index + '"[name]"></label><input type="text" name="lContactperson[0][name]" pattern="^[a-zA-Z ]*$" title="alphabet only" placeholder=""  class="form-control" id="" value="<?php //echo $inward[2] ?>" required placeholder="Enter contact person"></div><div class="col-md-5"><label style="color:red;" id="lContactperson' + index + '[mobile]-error" class="error" for="lContactperson' + index + '[mobile]"></label><input type="number" pattern="^[0-9]+$" title="Numbers only" name="lContactperson[0][mobile]" placeholder="Enter mobile"  class="form-control" value="" required></div><div class="col-md-2" ><button  type="button" onclick="removeDetail(' + index + ')" class="btn btn-sm red">Remove Contact Person</button></div></div>')
        
    }
	function removeDetail(index) {
		console.log(parent);
		console.log(index);
		$(".itemCls_"+ index).remove();   
    }
</script>