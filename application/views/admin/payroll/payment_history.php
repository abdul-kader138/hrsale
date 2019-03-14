<?php
/* Payment History view
*/
?>
<?php $session = $this->session->userdata('username');?>
<?php $get_animate = $this->Xin_model->get_content_animate();?>

<div class="box <?php echo $get_animate;?>">
  <div class="box-header with-border">
    <h3 class="box-title"> <?php echo $this->lang->line('xin_list_all');?> <?php echo $this->lang->line('left_payment_history');?> </h3>
  </div>
  <div class="box-body">
    <div class="box-datatable table-responsive">
      <table class="datatables-demo table table-striped table-bordered" id="xin_table">
        <thead>
          <tr>
            <th><?php echo $this->lang->line('xin_action');?></th>
            <th><?php echo $this->lang->line('dashboard_employee_id');?></th>
            <th><?php echo $this->lang->line('xin_employee_name');?></th>
            <th><?php echo $this->lang->line('xin_paid_amount');?></th>
            <th><?php echo $this->lang->line('xin_payment_month');?></th>
            <th><?php echo $this->lang->line('xin_payment_date');?></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
