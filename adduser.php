<div class="right_col" role="main">
	  <div class="">
		<div class="page-title">
		  <div class="title_left">
			<ul class="breadcrumbcustom">
			<li><a href="<?php echo base_url();?>user/home">Home</a></li>
			  <!--<li><i class="fa fa-angle-double-right breadfa"></i></li>
			  <li><a href="<?php echo base_url();?>users">Users</a></li>-->
			   <li><i class="fa fa-angle-double-right breadfa"></i></li>
			  <li>Add User</a></li>
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
					<h2>Add User</small></h2>
					<span class="nav navbar-right panel_toolbox">
						<a class="btn btn-round btn-primary tooltipab" href="<?php echo base_url();?>users" title="Back to User list"><i class="fa fa-reply"></i> Back</a>
                    </span>
					<div class="clearfix"></div>
				  </div>
				  <div class="x_content">
					
                    <div class="clearfix"></div>
                  </div>
                 
                    
                    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>user/useradd" name="adduser">
					  <div class="col-md-6 col-sm-6 col-xs-12 form-group">
						<label>First Name<span class="required">*</span></label>
                        <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name">
                      </div>
						<div class="col-md-6 col-sm-6 col-xs-12 form-group">
						<label>Last Name<span class="required">*</span></label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name">
                      </div>
					  <div class="col-md-6 col-sm-6 col-xs-12 form-group">
						<label>Email<span class="required">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" onblur="return emailaval();">
						<span class="error" id="emailerror"></span>
                      </div>
					  <div class="col-md-6 col-sm-6 col-xs-12 form-group">
						<label>Password<span class="required">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                      </div>
					  <div class="col-md-6 col-sm-6 col-xs-12 form-group">
						<label>Type<span class="required">*</span></label>
                        <select class="form-control" name="type">
                            <option value="">Choose Type</option>
                            <option value="warehouse">Warehouse</option>
                            <option value="sales">Sales</option>
                        </select>
                      </div>
					  <div class="col-md-6 col-sm-6 col-xs-12 form-group">
					  <label>Status<span class="required">*</span></label>
						<select class="form-control" name="status">
                            <option value="">Choose Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
					  </div>
					  
                      
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="submit" onclick="return emailaval()" class="btn btn-success" style="float:right">Submit</button>
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
	$("form[name='adduser']").validate({
		rules: {
		  firstname: "required",
		  email: {
			required: true,
			email : true
		  },
		  lastname: "required",
		  password: "required",
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
		  password: "Please Enter Password",
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
function emailaval()
{
	
	var email = document.getElementById("email").value;
	$.ajax({
		url: "<?php echo base_url();?>user/emailaval",
		type: "post",
		data: {'email':email} ,
		success: function (response) {
			//alert(response);
				if(response > 0)
				{
					$("#emailerror").text("Email is already existed!");
					//alert('Email is already existed!');
					$("#email").focus();
					return false;
				}
				else{
					$("#emailerror").text("");
					return true;
				}
				 //window.location.reload();              

			}
		});
							
}
</script>