<?php
/*
* Designation View
*/
$session = $this->session->userdata('username');
?>
<?php $get_animate = $this->Xin_model->get_content_animate();?>
<?php $role_resources_ids = $this->Xin_model->user_role_resource(); ?>
<?php if(in_array('243',$role_resources_ids)) {?>
<div class="row m-b-1 <?php echo $get_animate;?>">
  <div class="col-md-4">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"> <?php echo $this->lang->line('xin_add_new');?> <?php echo $this->lang->line('xin_designation');?> </h3>
      </div>
      <div class="box-body">
      <?php $attributes = array('name' => 'add_designation', 'id' => 'xin-form', 'autocomplete' => 'off');?>
      <?php $hidden = array('user_id' => $session['user_id']);?>
      <?php echo form_open('admin/designation/add_designation', $attributes, $hidden);?>
      
        <div class="form-group">
          <label for="first_name"><?php echo $this->lang->line('left_company');?></label>
          <select class="form-control" name="company_id" id="aj_company" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('left_company');?>">
            <option value=""></option>
            <?php foreach($get_all_companies as $company) {?>
            <option value="<?php echo $company->company_id?>"><?php echo $company->name?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group" id="department_ajax">
          <label for="name"><?php echo $this->lang->line('xin_department');?></label>
          <select disabled="disabled" class="select2" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_select_department');?>" name="department_id">
            <option value=""></option>
          </select>
        </div>
        <div class="form-group">
          <label for="name"><?php echo $this->lang->line('xin_designation_name');?></label>
          <input type="text" class="form-control" name="designation_name" placeholder="<?php echo $this->lang->line('xin_designation_name');?>">
        </div>
      
      <div class="form-actions box-footer">
        <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('xin_save');?> </button>
      </div>
      <?php echo form_close(); ?> </div></div>
  </div>
  <?php $colmdval = 'col-md-8';?>
  <?php } else {?>
  <?php $colmdval = 'col-md-12';?>
  <?php } ?>
  <div class="<?php echo $colmdval;?>">
    <div class="box">
      <div class="box-header">
        <h3 class="box-title"> <?php echo $this->lang->line('xin_list_all');?> <?php echo $this->lang->line('xin_designations');?> </h3>
      </div>
      <div class="box-body">
        <div class="box-datatable table-responsive">
          <table class="datatables-demo table table-striped table-bordered" id="xin_table">
            <thead>
              <tr>
                <th style="width:65px;"><?php echo $this->lang->line('xin_action');?></th>
                <th><?php echo $this->lang->line('xin_designation');?></th>
                <th><?php echo $this->lang->line('left_company');?></th>
                <th><?php echo $this->lang->line('xin_department');?></th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
