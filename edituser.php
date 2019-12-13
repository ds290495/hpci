<div class="right_col" role="main">
	  <div class="">
		<div class="page-title">
		  <div class="title_left">
			<ul class="breadcrumbcustom">
			<li><a href="<?php echo base_url();?>user/home">Home</a></li>
			  <!--<li><i class="fa fa-angle-double-right breadfa"></i></li>
			  <li><a href="<?php echo base_url();?>users">Users</a></li>-->
			   <li><i class="fa fa-angle-double-right breadfa"></i></li>
			  <li>Edit User</a></li>
			</ul>
		  </div>

		  <div class="title_right">
			<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
			  <div class="input-group">
				
			  </div>
			</div>
		  </div>
		</div>
		
		<div class="row">
            <div class="col-md-12 col-xs-12">
				<div class="x_panel">
				  <div class="x_title">
					<h2>Edit User</small></h2>
					<span class="nav navbar-right panel_toolbox">
						<a class="btn btn-round btn-primary tooltipab" href="<?php echo base_url();?>users" title="Back to User list"><i class="fa fa-reply"></i> Back</a>
                    </span>
					<div class="clearfix"></div>
				  </div>
				  <div class="x_content">
					
                    <div class="clearfix"></div>
                  </div>
                 
                    
                    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>user/updateuser" name="edituser">
					<input type="hidden" class="form-control" id="userId" name="userId" value="<?php echo $profile[0]['userId'];?>">
					  <div class="col-md-6 col-sm-6 col-xs-12 form-group">
						<label>First Name<span class="required">*</span></label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?php echo $profile[0]['firstName'];?>">
                      </div>
						<div class="col-md-6 col-sm-6 col-xs-12 form-group">
						<label>Last Name<span class="required">*</span></label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo $profile[0]['lastName'];?>">
                      </div>
					  <div class="col-md-6 col-sm-6 col-xs-12 form-group">
						<label>Email<span class="required">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $profile[0]['email'];?>" onblur="return validateemail(this.value);">
						<span class="error" id="emailerror"></span>
                      </div>
					  <div class="col-md-6 col-sm-6 col-xs-12 form-group">
						<label>Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                      </div>
					  <div class="col-md-6 col-sm-6 col-xs-12 form-group">
						<label>Type<span class="required">*</span></label>
                        <select class="form-control" name="type">
                            <option value="warehouse" <?php echo($profile[0]['type']=='warehouse')?'selected':'' ?>>Warehouse</option>
               				<option value="sales" <?php echo($profile[0]['type']=='sales')?'selected':'' ?>>Sales</option>
                        </select>
                      </div>
					  <div class="col-md-6 col-sm-6 col-xs-12 form-group">
					  <label>Status<span class="required">*</span></label>
						<select class="form-control" name="status">
                            <option value="1" <?php echo($profile[0]['status']=='1')?'selected':'' ?>>Active</option>
               				<option value="0" <?php echo($profile[0]['status']=='0')?'selected':'' ?>>Inactive</option>
                        </select>
					  </div>
					  
                      
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="submit" onclick="return validateemail()" class="btn btn-success" style="float:right">Submit</button>
                        </div>
                      </div>

                    </form>
                  
                </div>
				 
			</div>
		</div>
		
	  </div>
	</div>
</div>
<script>
$(document).ready(function(){
	$("form[name='edituser']").validate({
		rules: {
		  firstname: "required",
		  email: {
			required: true,
			email : true
		  },
		  lastname: "required",
		  type: "required",
		  status: "required"
		},
		messages: {
		  firstname: "Please Enter First Name",
		  email: {
			required: "Please Enter Email Address",
			email: "Please Enter Valid Email Address"
		  },
		  lastname: "Please Enter Last Name",
		  type: "Please Select Type",
		  status: "Please Select Status"
		  
		  
		},
		submitHandler: function(form) {
		  form.submit();
		}
	});
});
</script>
<script>
function validateemail(val)
{
	$.ajax({
		url: "<?php echo base_url();?>user/checkEmail/<?php echo $profile[0]['userId']; ?>",
		type: "post",
		data: {'email':val} ,
		success: function (response) {
			
				if(response > 0)
				{
					$("#emailerror").text("Email id is already exists!");
					$("#email").focus();
					return false;
				}
				else{
					$("#emailerror").text("");
					return true;
				}
						   

			}
		});
}
</script>