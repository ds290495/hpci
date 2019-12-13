<style>
.customwidth{max-width: 95px;
    min-width: 95px;}
	.customwidth select {
    max-width: 95px;
    min-width: 95px;
}
</style>

<div class="right_col" role="main">
  <div class="">
	<div class="page-title">
	  <div class="title_left">
		<ul class="breadcrumbcustom">
		
		  <li><a href="<?php echo base_url();?>user/home">Home</a></li>
		  <li><i class="fa fa-angle-double-right breadfa"></i></li>
		  <li>Users</li>
		   
		</ul>
	  </div>

	  <div class="title_right">
		<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
		  <div class="input-group">
			
		  </div>
		</div>
	  </div>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="x_title">
			<h2>User List</small></h2>
			<span class="nav navbar-right panel_toolbox">
			  <a href="<?php echo base_url() ?>user/adduser" class="btn btn-round btn-success tooltipab" title="Add new bundle to product"><i class="fa fa-plus" style="padding-right:3px"></i> Add User</a>
			</span>
			<div class="clearfix"></div>
		  </div>
		  <?php
						
			if($this->session->flashdata('flashSuccess')){
			?>
			<div class="success_msg" style="text-align: center; color: green; font-weight: bold;padding-bottom: 10px;"><?php echo $this->session->flashdata('flashSuccess');
			
			?></div>
			<?php
			}?>
			<?php
				
				if($this->session->flashdata('flashError')){
				?>
				<div class="error_msg" style="text-align: center; color: red; font-weight: bold;padding-bottom: 10px;"><?php echo $this->session->flashdata('flashError');
				
				?></div>
				<?php
				}
			?>
		  <div class="x_content">
			<p class="text-muted font-13 m-b-30">
			  
			</p>
			<table id="example2" class="table table-striped table-bordered jambo_table bulk_action">
			  <thead>
				<tr>
			      <th class="hidecol">S.No.</th>
				  <th  class="customwidth">First Name</th>
				  <th class="customwidth">Last Name</th>
				  <th class="customwidth">Email</th>
				  <th class="customwidth">Type</th>
				  <th class="hidecol">Action</th>
				</tr>
			  </thead>
			  
			  <tbody>
			  <?php 
				$i=1;
				foreach($users as $user)
				{
					$user_id=$user['userId'];
					
					?>
				<tr>
				  <td><?php echo $i++;?></td>
				  <td class="customwidth"><?php echo $user['firstName']; ?></td>
				  <td class="customwidth"><?php echo $user['lastName']; ?></td>
				  <td class="customwidth"><?php echo $user['email']; ?></td>
				  <td class="customwidth"><?php echo $user['type']; ?></td>
				  <td class="action_icons customwidth" style="padding: 3px;">
					<a href="<?php echo site_url('user/edituser/'.$user_id);?>" class="edit_link btn btn-lg blue tooltipb" style="padding: 0 5px 0 5px;margin: 0;" title="Edit the User"><i class="fa fa-pencil-square-o edit_font" ></i></a>
					<a onclick="return confirm('Are you sure you want to delete ?');" href="<?php echo site_url('user/deleteuser/'.$user_id);?>" class="delete_link btn btn-lg red tooltipb" style="padding: 0 5px 0 5px;margin: 0;" title="Delete the User"><i class="fa fa-trash delete_font"></i></a>
					
				  </td>
				</tr>
				<?php }
				?>
			  </tbody>
			</table>
		  </div>
		  </div>
	  </div>
  </div>
</div>

