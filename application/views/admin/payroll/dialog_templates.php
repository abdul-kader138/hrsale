<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['salary_template_id']) && $_GET['data']=='payroll'){
?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('xin_edit_payroll_template');?></h4>
</div>
<?php $attributes = array('name' => 'update_template', 'id' => 'update_template', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', '_token' => $salary_template_id, 'ext_name' => $salary_grades);?>
<?php echo form_open('admin/payroll/update_template/'.$salary_template_id, $attributes, $hidden);?>
<div class="modal-body">
  <div class="bg-white">
    <div class="box-block">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="company_name"><?php echo $this->lang->line('module_company_title');?></label>
                <select class="form-control" name="company" id="aj_company" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('module_company_title');?>">
                  <option value=""><?php echo $this->lang->line('xin_select_one');?></option>
                  <?php foreach($all_companies as $company) {?>
                  <option value="<?php echo $company->company_id;?>" <?php if($company_id==$company->company_id):?> selected="selected"<?php endif;?>> <?php echo $company->name;?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="salary_grades"><?php echo $this->lang->line('xin_name_of_template');?></label>
                <input class="form-control" placeholder="<?php echo $this->lang->line('xin_name_of_template');?>" name="salary_grades" type="text" value="<?php echo $salary_grades;?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="basic_salary" class="control-label"><?php echo $this->lang->line('xin_payroll_basic_salary');?></label>
                <input class="form-control m_salary" placeholder="<?php echo $this->lang->line('xin_payroll_basic_salary');?>" name="basic_salary" type="text" value="<?php echo $basic_salary;?>">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="overtime_rate" class="control-label"><?php echo $this->lang->line('xin_payroll_overtime_rate');?></label>
                <input class="form-control" placeholder="<?php echo $this->lang->line('xin_payroll_overtime_rate');?>" name="overtime_rate" type="text" value="<?php echo $overtime_rate;?>">
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr />
      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="house_rent_allowance"><?php echo $this->lang->line('xin_Payroll_house_rent_allowance');?></label>
                <input class="form-control m_salary m_allowance" placeholder="Amount" name="house_rent_allowance" type="text" value="<?php echo $house_rent_allowance;?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="medical_allowance"><?php echo $this->lang->line('xin_payroll_medical_allowance');?></label>
                <input class="form-control m_salary m_allowance" placeholder="Amount" name="medical_allowance" type="text" value="<?php echo $medical_allowance;?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="travelling_allowance"><?php echo $this->lang->line('xin_payroll_travel_allowance');?></label>
                <input class="form-control m_salary m_allowance" placeholder="Amount" name="travelling_allowance" type="text" value="<?php echo $travelling_allowance;?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="dearness_allowance"><?php echo $this->lang->line('xin_payroll_dearness_allowance');?></label>
                <input class="form-control m_salary m_allowance" placeholder="Amount" name="dearness_allowance" type="text" value="<?php echo $dearness_allowance;?>">
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="provident_fund"><?php echo $this->lang->line('xin_payroll_provident_fund_de');?></label>
                <input class="form-control m_deduction" placeholder="Amount" name="provident_fund" type="text" value="<?php echo $provident_fund;?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="tax_deduction"><?php echo $this->lang->line('xin_payroll_tax_deduction_de');?></label>
                <input class="form-control m_deduction" placeholder="Amount" name="tax_deduction" type="text" value="<?php echo $tax_deduction;?>">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="security_deposit"><?php echo $this->lang->line('xin_payroll_security_deposit');?></label>
                <input class="form-control m_deduction" placeholder="Amount" name="security_deposit" type="text" value="<?php echo $security_deposit;?>">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">&nbsp; </div>
        <div class="col-md-6 col-right">
          <h4 class="form-section"><?php echo $this->lang->line('xin_payroll_total_salary_details');?></h4>
          <table class="table table-bordered custom-table">
            <tbody>
              <tr>
                <th class="vertical-td" style="text-align:right;"><?php echo $this->lang->line('xin_payroll_gross_salary');?> :</th>
                <td class="hidden-print"><input type="text" name="gross_salary" readonly id="m_total" class="form-control" value="<?php echo $gross_salary;?>"></td>
              </tr>
              <tr>
                <th class="vertical-td" style="text-align:right;"><?php echo $this->lang->line('xin_payroll_total_allowance');?> :</th>
                <td class="hidden-print"><input type="text" name="total_allowance" readonly id="m_total_allowance" class="form-control" value="<?php echo $total_allowance;?>"></td>
              </tr>
              <tr>
                <th class="vertical-td" style="text-align:right;"><?php echo $this->lang->line('xin_payroll_total_deduction');?> :</th>
                <td class="hidden-print"><input type="text" name="total_deduction" readonly id="m_total_deduction" class="form-control" value="<?php echo $total_deduction;?>"></td>
              </tr>
              <tr>
                <th class="vertical-td" style="text-align:right;"><?php echo $this->lang->line('xin_payroll_net_salary');?> :</th>
                <td class="hidden-print"><input type="text" name="net_salary" readonly id="m_net_salary" class="form-control" value="<?php echo $net_salary;?>"></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('xin_close');?></button>
  <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('xin_update');?></button>
</div>
<?php echo form_close(); ?> 
<script type="text/javascript">
$(document).ready(function(){
					
	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });	 

	/* Edit data */
	$("#update_template").submit(function(e){
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=1&edit_type=payroll&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				} else {
					// On page load: datatable
					var xin_table = $('#xin_table').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?php echo site_url("admin/payroll/template_list") ?>",
							type : 'GET'
						},
						dom: 'lBfrtip',
						"buttons": ['csv', 'excel', 'pdf', 'print'], // colvis > if needed
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}
					});
					xin_table.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);
					$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
					$('.edit-modal-data').modal('toggle');
					$('.save').prop('disabled', false);
				}
			}
		});
	});
});	
$(document).on("keyup", function () {
	var sum_total = 0;
	var deduction = 0;
	var net_salary = 0;
	var allowance = 0;
	$(".m_salary").each(function () {
		sum_total += +$(this).val();
	});
	
	$(".m_deduction").each(function () {
		deduction += +$(this).val();
	});
	
	$(".m_allowance").each(function () {
		allowance += +$(this).val();
	});
	
	$("#m_total").val(sum_total);
	$("#m_total_deduction").val(deduction);
	$("#m_total_allowance").val(allowance);
	
	var net_salary = sum_total - deduction;
	$("#m_net_salary").val(net_salary);
});
</script>
<?php } else if(isset($_GET['jd']) && isset($_GET['employee_id']) && $_GET['data']=='payroll_template' && $_GET['type']=='payroll_template'){ ?>
<?php
$salary_allowances = $this->Employees_model->read_salary_allowances($employee_id);
$count_allowances = $this->Employees_model->count_employee_allowances($employee_id);
$allowance_amount = 0;
if($count_allowances > 0) {
	foreach($salary_allowances as $sl_allowances){
		$allowance_amount += $sl_allowances->allowance_amount;
	}
} else {
	$allowance_amount = 0;
}
$sta_salary = $allowance_amount + $basic_salary;
?>
<?php
if($profile_picture!='' && $profile_picture!='no file') {
	$u_file = 'uploads/profile/'.$profile_picture;
} else {
	if($gender=='Male') { 
		$u_file = 'uploads/profile/default_male.jpg';
	} else {
		$u_file = 'uploads/profile/default_female.jpg';
	}
} ?>
<div class="modal-header animated fadeInRight">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('xin_payroll_employee_salary_details');?></h4>
</div>
<div class="modal-body animated fadeInRight">
  <div class="row row-md">
    <div class="col-md-12">
      <div class="card">
        <div class="bg-white product-view">
          <div class="box-block">
            <div class="row">
              <div class="col-md-12 col-sm-7">
                <div class="box box-widget widget-user-2"> 
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header bg-yellow1">
                    <div class="widget-user-image"> <img class="img-circle" src="<?php echo base_url().$u_file;?>" alt="<?php echo $first_name.' '.$last_name;?>"> </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username"><?php echo $first_name.' '.$last_name;?></h3>
                    <h5 class="widget-user-desc"><?php echo $designation_name;?></h5>
                  </div>
                  <div class="no-padding">
                    <ul class="nav nav-stacked">
                      <li><a href="javascript:void(0);"><?php echo $this->lang->line('xin_emp_id');?> <span class="pull-right"><?php echo $employee_id;?></span></a></li>
                      <li><a href="javascript:void(0);"><?php echo $this->lang->line('left_department');?> <span class="pull-right"><?php echo $department_name;?></span></a></li>
                      <li><a href="javascript:void(0);"><?php echo $this->lang->line('xin_joining_date');?><span class="pull-right badge"><?php echo $date_of_joining;?></span></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mb-1">
    <div class="col-sm-12 col-xs-12 col-xl-12">
      <div class="card-header text-uppercase"><b><?php echo $this->lang->line('xin_payroll_salary_details');?></b></div>
      <div class="card-block">
        <div id="accordion">
          <div class="card mb-2">
            <div class="card-header"> <a class="text-dark collapsed" data-toggle="collapse" href="#basic_salary" aria-expanded="false"> <strong><?php echo $this->lang->line('xin_payroll_basic_salary');?></strong> </a> </div>
            <div id="basic_salary" class="collapse" data-parent="#accordion" style="">
              <div class="box-body">
                <div class="table-responsive" data-pattern="priority-columns">
                  <table class="datatables-demo table table-striped table-bordered dataTable no-footer">
                    <tbody>
                      <?php if($wages_type == 1){?>
                      <tr>
                        <td><strong><?php echo $this->lang->line('xin_payroll_basic_salary');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($basic_salary);?></span></td>
                      </tr>
                      <?php } else {?>
                      <tr>
                        <td><strong><?php echo $this->lang->line('xin_employee_daily_wages');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($daily_wages);?></span></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php $allowances = $this->Employees_model->set_employee_allowances($user_id);?>
          <?php if(!is_null($allowances)):?>
          <div class="card mb-2">
            <div class="card-header"> <a class="text-dark collapsed" data-toggle="collapse" href="#set_allowances" aria-expanded="false"> <strong><?php echo $this->lang->line('xin_employee_set_allowances');?></strong> </a> </div>
            <div id="set_allowances" class="collapse" data-parent="#accordion" style="">
              <div class="box-body">
                <div class="table-responsive" data-pattern="priority-columns">
                  <table class="datatables-demo table table-striped table-bordered dataTable no-footer">
                    <tbody>
                      <?php $allowance_amount = 0; foreach($allowances->result() as $sl_allowances) { ?>
                      <?php $allowance_amount += $sl_allowances->allowance_amount;?>
                      <tr>
                        <td><strong><?php echo $sl_allowances->allowance_title;?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($sl_allowances->allowance_amount);?></span></td>
                      </tr>
                      <?php } ?>
                      <tr>
                        <td><strong><?php echo $this->lang->line('xin_acc_total');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($allowance_amount);?></span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php endif;?>
          <?php $loan = $this->Employees_model->set_employee_deductions($user_id);?>
          <?php if(!is_null($loan)):?>
          <div class="card mb-2">
            <div class="card-header"> <a class="text-dark collapsed" data-toggle="collapse" href="#set_loan_deductions" aria-expanded="false"> <strong><?php echo $this->lang->line('xin_employee_set_loan_deductions');?></strong> </a> </div>
            <div id="set_loan_deductions" class="collapse" data-parent="#accordion" style="">
              <div class="box-body">
                <div class="table-responsive" data-pattern="priority-columns">
                  <table class="datatables-demo table table-striped table-bordered dataTable no-footer">
                    <tbody>
                      <?php $loan_de_amount = 0; foreach($loan->result() as $r_loan) { ?>
                      <?php $loan_de_amount += $r_loan->loan_deduction_amount;?>
                      <tr>
                        <td><strong><?php echo $r_loan->loan_deduction_title;?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($r_loan->loan_deduction_amount);?></span></td>
                      </tr>
                      <?php } ?>
                      <tr>
                        <td><strong><?php echo $this->lang->line('xin_acc_total');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($loan_de_amount);?></span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php endif;?>
          <?php if(($salary_ssempee!='' && $salary_ssempee!=0) || ($salary_ssempeer!='' && $salary_ssempeer!=0) || ($salary_income_tax!='' && $salary_income_tax!=0)){?>
          <div class="card mb-2">
            <div class="card-header"> <a class="text-dark collapsed" data-toggle="collapse" href="#statutory_deductions" aria-expanded="false"> <strong><?php echo $this->lang->line('xin_employee_set_statutory_deductions');?></strong> </a> </div>
            <div id="statutory_deductions" class="collapse" data-parent="#accordion" style="">
              <div class="box-body">
                <div class="table-responsive" data-pattern="priority-columns">
                  <table class="datatables-demo table table-striped table-bordered dataTable no-footer">
                    <tbody>
                      <tr>
                        <td><strong><?php echo $this->lang->line('xin_employee_set_ssempee');?> (<?php echo $salary_ssempee;?>%):</strong> <span class="pull-right">
                          <?php if($salary_ssempee!='' && $salary_ssempee!=0){?>
                          <?php $sta_salary = $allowance_amount + $basic_salary;?>
                          <?php $salary_ssempee = $sta_salary / 100 * $salary_ssempee;?>
                          <?php echo $ssalary_ssempee = $this->Xin_model->currency_sign($salary_ssempee);?>
                          <?php } else {?>
                          <?php $ssalary_ssempee = 0;?>
                          <?php } ?>
                          </span></td>
                      </tr>
                      <tr>
                        <td><strong><?php echo $this->lang->line('xin_employee_set_ssempeer');?> (<?php echo $salary_ssempeer;?>%):</strong> <span class="pull-right">
                          <?php $ssalary_ssempeer = 0;?>
                          <?php if($salary_ssempeer!='' && $salary_ssempeer!=0){?>
                          <?php $sta_salary1 = $allowance_amount + $basic_salary;?>
                          <?php $salary_ssempeer = $sta_salary1 / 100 * $salary_ssempeer;?>
                          <?php echo $ssalary_ssempeer = $this->Xin_model->currency_sign($salary_ssempeer);?>
                          <?php } else {?>
                          <?php $ssalary_ssempeer = 0;?>
                          <?php } ?>
                          </span></td>
                      </tr>
                      <tr>
                        <td><strong><?php echo $this->lang->line('xin_employee_set_inc_tax');?> (<?php echo $salary_income_tax;?>%):</strong> <span class="pull-right">
                          <?php if($salary_income_tax!='' && $salary_income_tax!=0){?>
                          <?php $sta_salary2 = $allowance_amount + $basic_salary;?>
                          <?php $salary_income_tax = $sta_salary2 / 100 * $salary_income_tax;?>
                          <?php echo $ssalary_income_tax = $this->Xin_model->currency_sign($salary_income_tax);?>
                          <?php } else {?>
                          <?php $ssalary_income_tax = 0;?>
                          <?php } ?>
                          </span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if(($salary_commission!='' || $salary_commission!=0) && ($salary_claims!='' || $salary_claims!=0) && ($salary_paid_leave!='' || $salary_paid_leave!=0) && ($salary_director_fees!='' || $salary_director_fees!=0) && ($salary_advance_paid!='' || $salary_advance_paid!=0)){?>
          <div class="card mb-2">
            <div class="card-header"> <a class="text-dark collapsed" data-toggle="collapse" href="#other_payment" aria-expanded="false"> <strong><?php echo $this->lang->line('xin_employee_set_other_payment');?></strong> </a> </div>
            <div id="other_payment" class="collapse" data-parent="#accordion" style="">
              <div class="box-body">
                <div class="table-responsive" data-pattern="priority-columns">
                  <table class="datatables-demo table table-striped table-bordered dataTable no-footer">
                    <tbody>
                      <?php if($salary_commission!='' && $salary_commission!=0){?>
                      <tr>
                        <td><strong><?php echo $this->lang->line('xin_employee_set_oth_commission');?>:</strong> <span class="pull-right"><?php echo $ssalary_commission = $salary_commission;?></span></td>
                      </tr>
                      <?php } else {?>
                      <?php $ssalary_commission = 0;?>
                      <?php } ?>
                      <?php if($salary_claims!='' && $salary_claims!=0){?>
                      <tr>
                        <td><strong><?php echo $this->lang->line('xin_employee_set_oth_claims');?>:</strong> <span class="pull-right"><?php echo $ssalary_claims = $salary_claims;?></span></td>
                      </tr>
                      <?php } else {?>
                      <?php $ssalary_claims = 0;?>
                      <?php } ?>
                      <?php if($salary_paid_leave!='' && $salary_paid_leave!=0){?>
                      <tr>
                        <td><strong><?php echo $this->lang->line('xin_employee_set_oth_paid_leave');?>:</strong> <span class="pull-right"><?php echo $ssalary_paid_leave = $salary_paid_leave;?></span></td>
                      </tr>
                      <?php } else {?>
                      <?php $ssalary_paid_leave = 0;?>
                      <?php } ?>
                      <?php if($salary_director_fees!='' && $salary_director_fees!=0){?>
                      <tr>
                        <td><strong><?php echo $this->lang->line('xin_employee_set_oth_director_fees');?>:</strong> <span class="pull-right"><?php echo $ssalary_director_fees = $salary_director_fees;?></span></td>
                      </tr>
                      <?php } else {?>
                      <?php $ssalary_director_fees = 0;?>
                      <?php } ?>
                      <?php if($salary_advance_paid!='' && $salary_advance_paid!=0){?>
                      <tr>
                        <td><strong><?php echo $this->lang->line('xin_employee_set_oth_ad_paid');?>:</strong> <span class="pull-right"><?php echo $ssalary_advance_paid = $salary_advance_paid;?></span></td>
                      </tr>
                      <?php } else {?>
                      <?php $ssalary_advance_paid = 0;?>
                      <?php } ?>
                      <?php $all_other_payment = $ssalary_commission + $ssalary_claims + $ssalary_paid_leave + $ssalary_director_fees + $ssalary_advance_paid;?>
                      <tr>
                        <td><strong><?php echo $this->lang->line('xin_acc_total');?>:</strong> <span class="pull-right"><?php echo $ssalary_advance_paid = $this->Xin_model->currency_sign($all_other_payment);?></span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php $overtime = $this->Employees_model->set_employee_overtime($user_id);?>
          <?php if(!is_null($overtime)):?>
          <div class="card mb-2">
            <div class="card-header"> <a class="text-dark collapsed" data-toggle="collapse" href="#overtime" aria-expanded="false"> <strong><?php echo $this->lang->line('dashboard_overtime');?></strong> </a> </div>
            <div id="overtime" class="collapse" data-parent="#accordion" style="">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered mb-0">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('xin_employee_overtime_title');?></th>
                        <th><?php echo $this->lang->line('xin_employee_overtime_no_of_days');?></th>
                        <th><?php echo $this->lang->line('xin_employee_overtime_hour');?></th>
                        <th><?php echo $this->lang->line('xin_employee_overtime_rate');?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; $overtime_amount = 0; foreach($overtime->result() as $r_overtime) { ?>
                      <?php
						$overtime_total = $r_overtime->overtime_hours * $r_overtime->overtime_rate;
						$overtime_amount += $overtime_total;
						?>
                      <tr>
                        <th scope="row"><?php echo $i;?></th>
                        <td><?php echo $r_overtime->overtime_type;?></td>
                        <td><?php echo $r_overtime->no_of_days;?></td>
                        <td><?php echo $r_overtime->overtime_hours;?></td>
                        <td><?php echo $r_overtime->overtime_rate;?></td>
                      </tr>
                      <?php $i++; } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="4" align="right"><strong><?php echo $this->lang->line('xin_acc_total');?>:</strong></td>
                        <td><?php echo $this->Xin_model->currency_sign($overtime_amount);?></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } else if(isset($_GET['jd']) && isset($_GET['employee_id']) && $_GET['data']=='hourlywages' && $_GET['type']=='hourlywages'){ ?>
<?php
$grade_template = $this->Payroll_model->read_template_information($monthly_grade_id);
$hourly_template = $this->Payroll_model->read_hourly_wage_information($hourly_grade_id);
?>
<?php
if($profile_picture!='' && $profile_picture!='no file') {
	$u_file = 'uploads/profile/'.$profile_picture;
} else {
	if($gender=='Male') { 
		$u_file = 'uploads/profile/default_male.jpg';
	} else {
		$u_file = 'uploads/profile/default_female.jpg';
	}
} ?>
<div class="modal-header animated fadeInRight">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('xin_payroll_employee_hourly_wages');?></h4>
</div>
<div class="modal-body animated fadeInRight">
  <div class="row row-md">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header text-uppercase"><b><?php echo $first_name.' '.$last_name;?></b></div>
        <div class="bg-white product-view">
          <div class="box-block">
            <div class="row">
              <div class="col-md-4 col-sm-5">
                <div class="pv-images mb-sm-0"> <img class="img-fluid" src="<?php echo base_url().$u_file;?>" alt=""> </div>
              </div>
              <div class="col-md-8 col-sm-7">
                <div class="pv-content">
                  <div class="table-responsive" data-pattern="priority-columns">
                    <table class="table-hover">
                      <tbody>
                        <tr>
                          <td><strong><?php echo $this->lang->line('xin_emp_id');?></strong>:</td>
                          <td>&nbsp;&nbsp;&nbsp;</td>
                          <td><?php echo $employee_id;?></td>
                        </tr>
                        <tr>
                          <td><strong><?php echo $this->lang->line('left_department');?></strong>:</td>
                          <td>&nbsp;&nbsp;&nbsp;</td>
                          <td><?php echo $department_name;?></td>
                        </tr>
                        <tr>
                          <td><strong><?php echo $this->lang->line('left_designation');?></strong>:</td>
                          <td>&nbsp;&nbsp;&nbsp;</td>
                          <td><?php echo $designation_name;?></td>
                        </tr>
                        <tr>
                          <td><strong><?php echo $this->lang->line('xin_joining_date');?></strong>:</td>
                          <td>&nbsp;&nbsp;&nbsp;</td>
                          <td><?php echo $date_of_joining;?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="form-group row"> 
    <!-- ********************************* Salary Details Panel ***********************-->
    <div class="col-sm-12 col-xs-12">
      <div class="card">
        <div class="card-header text-uppercase"><b><?php echo $this->lang->line('xin_payroll_total_salary_details');?></b></div>
        <div class="card-block">
          <div class="row m-b-1">
            <div class="col-md-12">
              <div class="f">
                <label for="name" class="control-label" style="text-align:right;"><strong><?php echo $this->lang->line('xin_payroll_hourly_wage');?>: </strong></label>
                <?php echo $hourly_template[0]->hourly_grade;?> </div>
            </div>
            <div class="col-md-12">
              <div class="f">
                <label for="name" class="control-label" style="text-align:right;"><strong><?php echo $this->lang->line('xin_payroll_hourly_rate');?>: </strong></label>
                <?php echo $this->Xin_model->currency_sign($hourly_template[0]->hourly_rate);?> </div>
            </div>
            <?php if(isset($_GET['mode']) && $_GET['mode'] == 'not_paid'):?>
            <div class="col-md-12">
              <div class="f">
                <label for="name" class="control-label" style="text-align:right;"><strong><?php echo $this->lang->line('dashboard_xin_status');?>: </strong></label>
                <span class="tag tag-danger"><?php echo $this->lang->line('xin_not_paid');?></span></div>
            </div>
            <?php endif;?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php }
?>
