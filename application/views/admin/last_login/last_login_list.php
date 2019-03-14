<?php
/* Employees Last Login view
*/
?>
<?php $session = $this->session->userdata('username');?>
<?php $get_animate = $this->Xin_model->get_content_animate();?>
<div class="box <?php echo $get_animate;?>">
  <div class="box-header with-border">
    <h3 class="box-title"> <?php echo $this->lang->line('left_employees_last_login');?> </h3>
  </div>
  <div class="box-body">
    <div class="box-datatable table-responsive">
      <table class="datatables-demo table table-striped table-bordered" id="xin_table">
        <thead>
          <tr>
            <th><?php echo $this->lang->line('xin_employees_id');?></th>
            <th><?php echo $this->lang->line('xin_employees_full_name');?></th>
            <th><?php echo $this->lang->line('dashboard_username');?></th>
            <th><?php echo $this->lang->line('left_company');?></th>
            <th><?php echo $this->lang->line('dashboard_last_login');?> </th>
            <th><?php echo $this->lang->line('xin_employee_role');?></th>
            <th><?php echo $this->lang->line('dashboard_xin_status');?></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
