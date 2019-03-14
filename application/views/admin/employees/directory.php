<?php
/* Employee Directory view
*/
?>
<?php $session = $this->session->userdata('username');?>
<?php $countries = $this->Xin_model->get_countries();?>

<?php $get_animate = $this->Xin_model->get_content_animate();?>
<?php $role_resources_ids = $this->Xin_model->user_role_resource(); ?>
<div class="row contacts-col-view">
  <?php foreach($results as $employee) { ?>
  <?php
	if($employee->profile_picture!='' && $employee->profile_picture!='no file') {
		$u_file = base_url().'uploads/profile/'.$employee->profile_picture;
	} else {
		if($employee->gender=='Male') { 
			$u_file = base_url().'uploads/profile/default_male.jpg';
		} else {
			$u_file = base_url().'uploads/profile/default_female.jpg';
		}
	}
	?>
  <?php $designation = $this->Designation_model->read_designation_information($employee->designation_id);?>
  <?php
		if(!is_null($designation)){
		$designation_name = strtolower($designation[0]->designation_name);
	  } else {
		$designation_name = '--';	
	  }
	?>
    <div class="col-md-4 <?php echo $get_animate;?>">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username">
              <?php if(in_array('202',$role_resources_ids)) {?>
              <a style="color:#FFF;" href="<?php echo site_url('admin/employees/detail')?>/<?php echo $employee->user_id;?>"><?php echo $employee->first_name;?> <?php echo $employee->last_name;?></a>
              <?php } else {?>
              <?php echo $employee->first_name;?> <?php echo $employee->last_name;?>
              <?php } ?>
              </h3>
              <h5 class="widget-user-desc"><?php echo ucwords($designation_name);?></h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="<?php echo $u_file;?>" alt="<?php echo $employee->first_name;?> <?php echo $employee->last_name;?>">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-8 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo $employee->email;?></h5>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header"><?php echo $employee->contact_no;?></h5>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
  <?php } ?>
  <?php //} ?>
</div>
<?php if (isset($links)) { ?>
<ul class="pagination pagination-sm no-margin">
	<?php foreach ($links as $link) { 
    echo "<li>". $link."</li>";
    } ?>
  </ul>
<?php } ?>
