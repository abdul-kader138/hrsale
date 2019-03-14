<?php
/* Hourly Wage/Rate view
*/
?>
<?php $session = $this->session->userdata('username');?>

<div class="row m-b-1 animated fadeInRight">
  <div class="col-md-4">
    <div class="card">
      <h6 class="card-header"> <?php echo $this->lang->line('xin_add_new');?> <?php echo $this->lang->line('xin_invoice_currency');?> </h6>
      <div class="card-body">
        <?php $attributes = array('name' => 'add_currency_data', 'id' => 'xin-form', 'autocomplete' => 'off');?>
        <?php $hidden = array('user_id' => $session['user_id']);?>
        <?php echo form_open('admin/payroll/add_currency_data', $attributes, $hidden);?>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="usd_currency"><?php echo $this->lang->line('xin_payroll_from_usd_currency');?></label>
              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_payroll_from_usd_currency');?>" name="usd_currency" type="text" value="1" readonly="readonly">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="to_currency_title"><?php echo $this->lang->line('xin_payroll_to_currency_title');?></label>
              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_payroll_to_currency_title');?>" name="to_currency_title" type="text">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="to_currency_rate"><?php echo $this->lang->line('xin_payroll_to_currency_rate');?></label>
              <input class="form-control" placeholder="<?php echo $this->lang->line('xin_payroll_to_currency_rate');?>" name="to_currency_rate" type="text">
            </div>
          </div>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo $this->lang->line('xin_save');?> </button>
        </div>
        <?php echo form_close(); ?> </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card">
      <h6 class="card-header"> <?php echo $this->lang->line('xin_list_all');?> <?php echo $this->lang->line('xin_payroll_hourly_wages');?> </h6>
      <div class="card-datatable table-responsive">
        <table class="datatables-demo table table-striped table-bordered" id="xin_table">
          <thead>
            <tr>
              <th style="width:76px;"><?php echo $this->lang->line('xin_action');?></th>
              <th><?php echo $this->lang->line('xin_payroll_from_usd_currency');?></th>
              <th><?php echo $this->lang->line('xin_payroll_to_currency_title');?></th>
              <th><?php echo $this->lang->line('xin_payroll_to_currency_rate');?></th>
            </tr>
          </thead>
        </table>
      </div>
      <!-- responsive --> 
    </div>
  </div>
</div>
