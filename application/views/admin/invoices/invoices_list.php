<?php
/* Invoices view
*/
?>
<?php $session = $this->session->userdata('username');?>
<?php $get_animate = $this->Xin_model->get_content_animate();?>
<div class="box <?php echo $get_animate;?>">
  <div class="box-header with-border">
    <h3 class="box-title"><?php echo $this->lang->line('xin_list_all');?> <?php echo $this->lang->line('xin_invoices_title');?></h3>
    <?php $role_resources_ids = $this->Xin_model->user_role_resource(); ?>
	<?php if(in_array('120',$role_resources_ids)) {?>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-xs btn-primary" onclick="window.location='<?php echo site_url('admin/invoices/create/')?>'"> <span class="ion ion-md-add"></span> <?php echo $this->lang->line('xin_invoice_create');?></button>
    </div>
    <?php } ?>
  </div>
  <div class="box-body">
    <div class="box-datatable table-responsive">
      <table class="datatables-demo table table-striped table-bordered" id="xin_table">
        <thead>
          <tr>
            <th><?php echo $this->lang->line('xin_action');?></th>
            <th>ID
              <?php //echo $this->lang->line('xin_client_name');?></th>
            <th>Invoice#
              <?php //echo $this->lang->line('xin_client_name');?></th>
            <th><?php echo $this->lang->line('xin_project');?></th>
            <th>Total
              <?php //echo $this->lang->line('xin_email');?></th>
            <th>Invoice Date
              <?php //echo $this->lang->line('xin_website');?></th>
            <th>Due Date
              <?php //echo $this->lang->line('xin_city');?></th>
            <th>Status
              <?php //echo $this->lang->line('xin_country');?></th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
