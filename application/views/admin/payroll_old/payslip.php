<?php
/* Payslip view
*/
?>
<?php $session = $this->session->userdata('username');?>
<?php
	/*$gd = '';
	if($hourly_rate == '') {
		$gd = 'sl';
	} else {
		$gd = 'hr';
	}*/
?>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-header with-elements"> <span class="card-header-title mr-2"><?php echo $this->lang->line('xin_payslip');?> - </strong><?php echo date("F, Y", strtotime($payment_date));?></span>
        <div class="card-header-elements ml-md-auto"> <a href="<?php echo site_url();?>admin/payroll/pdf_create/p/<?php echo $make_payment_id;?>/" class="btn btn-social-icon mb-1 btn-outline-github" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('xin_pdf');?>"><i class="far fa-file-pdf d-block"></i></a> </div>
      </div>
      <div class="card-body">
        <div class="table-responsive" data-pattern="priority-columns">
          <table class="datatables-demo table table-striped table-bordered dataTable no-footer">
            <tbody>
              <tr>
                <td><strong class="help-split"><?php echo $this->lang->line('dashboard_employee_id');?>: </strong>#<?php echo $employee_id;?></td>
                <td><strong class="help-split"><?php echo $this->lang->line('xin_employee_name');?>: </strong><?php echo $first_name.' '.$last_name;?></td>
                <td><strong class="help-split"><?php echo $this->lang->line('xin_payslip_number');?>: </strong><?php echo $make_payment_id;?></td>
              </tr>
              <tr>
                <td><strong class="help-split"><?php echo $this->lang->line('xin_phone');?>: </strong><?php echo $contact_no;?></td>
                <td><strong class="help-split"><?php echo $this->lang->line('xin_joining_date');?>: </strong><?php echo $this->Xin_model->set_date_format($date_of_joining);?></td>
                <td><strong class="help-split"><?php echo $this->lang->line('xin_payslip_payment_by');?>: </strong><?php echo $payment_method;?></td>
              </tr>
              <tr>
                <td><strong class="help-split"><?php echo $this->lang->line('left_department');?>: </strong><?php echo $department_name;?></td>
                <td><strong class="help-split"><?php echo $this->lang->line('left_designation');?>: </strong><?php echo $designation_name;?></td>
                <td><strong class="help-split">&nbsp;</strong></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $user_id = $employee_id;?>
<div class="row m-b-1">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header with-elements"> <span class="card-header-title mr-2"><?php echo $this->lang->line('xin_payment_details');?></span> </div>
      <div class="card-body">
        <div id="accordion">
              <div class="card mb-2">
                <div class="card-header">
                  <a class="text-dark collapsed" data-toggle="collapse" href="#basic_salary" aria-expanded="false">
                    <strong><?php echo $this->lang->line('xin_payroll_basic_salary');?></strong>
                  </a>
                </div>

                <div id="basic_salary" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body">
                    <div class="row m-b-1">
                    <div class="col-md-6">
                      <ul class="list-group list-group-flush">
                    
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <?php if($wages_type == 1){?>
                      <div class="text-muted"><strong><?php echo $this->lang->line('xin_payroll_basic_salary');?>:</strong></div>
                      <div><?php echo $basic_salary;?></div>
                      <?php } else {?>
                      <div class="text-muted"><strong><?php echo $this->lang->line('xin_employee_daily_wages');?>:</strong></div>
                      <div><?php echo $daily_wages;?></div>
                      <?php } ?>
                    </li>
                  </ul>
                    </div>
                      </div>
                  </div>
                </div>
              </div>
              <?php $count_allowances = $this->Employees_model->count_employee_allowances_payslip($make_payment_id);?>
              <?php $allowances = $this->Employees_model->set_employee_allowances_payslip($make_payment_id);?>
              <?php if($count_allowances > 0):?>
              <div class="card mb-2">
                <div class="card-header">
                  <a class="text-dark collapsed" data-toggle="collapse" href="#set_allowances" aria-expanded="false">
                    <strong><?php echo $this->lang->line('xin_employee_set_allowances');?></strong>
                  </a>
                </div>
                <div id="set_allowances" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body">
                    <ul class="list-group list-group-flush">
                    <?php $allowance_amount = 0; foreach($allowances->result() as $sl_allowances) { ?>
                    <?php $allowance_amount += $sl_allowances->allowance_amount;?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="text-muted"><strong><?php echo $sl_allowances->allowance_title;?>:</strong></div>
                      <div><?php echo $sl_allowances->allowance_amount;?></div></li>
                    <?php } ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="text-muted"><strong>&nbsp;</strong></div>
                      <div><strong><?php echo $this->lang->line('xin_acc_total');?>:</strong> <strong><?php echo $allowance_amount;?></strong></div></li>
                  </ul>
                  </div>
                </div>
              </div>
              <?php endif;?>
              <?php $count_loan = $this->Employees_model->count_employee_deductions_payslip($make_payment_id);?>
              <?php $loan = $this->Employees_model->set_employee_deductions_payslip($make_payment_id);?>
              <?php if($count_loan > 0):?>
              <div class="card mb-2">
                <div class="card-header">
                  <a class="text-dark collapsed" data-toggle="collapse" href="#set_loan_deductions" aria-expanded="false">
                    <strong><?php echo $this->lang->line('xin_employee_set_loan_deductions');?></strong>
                  </a>
                </div>
                <div id="set_loan_deductions" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body">
                    <ul class="list-group list-group-flush">
					<?php $loan_de_amount = 0; foreach($loan->result() as $r_loan) { ?>
                    <?php $loan_de_amount += $r_loan->loan_amount;?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="text-muted"><strong><?php echo $r_loan->loan_title;?>:</strong></div>
                      <div><?php echo $r_loan->loan_amount;?></div></li>
                    <?php } ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="text-muted"><strong>&nbsp;</strong></div>
                      <div><strong><?php echo $this->lang->line('xin_acc_total');?>:</strong> <strong><?php echo $loan_de_amount;?></strong></div></li>
                    </ul>
                  </div>
                </div>
              </div>
              <?php endif;?>
              <?php if(($salary_ssempee!='' && $salary_ssempee!=0) && ($salary_ssempee!='' && $salary_ssempee!=0) && ($salary_income_tax!='' && $salary_income_tax!=0)){?>
              <div class="card mb-2">
                <div class="card-header">
                  <a class="text-dark collapsed" data-toggle="collapse" href="#statutory_deductions" aria-expanded="false">
                    <strong><?php echo $this->lang->line('xin_employee_set_statutory_deductions');?></strong>
                  </a>
                </div>
                <div id="statutory_deductions" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body">
                    <ul class="list-group list-group-flush">
                    <?php if($salary_ssempee!='' && $salary_ssempee!=0){?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="text-muted"><strong><?php echo $this->lang->line('xin_employee_set_ssempee');?>:</strong></div>
                      <?php //$sta_salary = $allowance_amount + $basic_salary;?>
                      <?php //$salary_ssempee = $sta_salary / 100 * $salary_ssempee;?>
                      <div><?php echo $ssalary_ssempee = number_format((float)$salary_ssempee, 2, '.', '');?></div></li>
                      <?php } else {?>
                      	<?php $ssalary_ssempee = 0;?>
                      <?php } ?>
                      <?php if($salary_ssempeer!='' || $salary_ssempeer!=0){?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="text-muted"><strong><?php echo $this->lang->line('xin_employee_set_ssempeer');?>:</strong></div>
                      <?php //$sta_salary1 = $allowance_amount + $basic_salary;?>
                      <?php //$ssalary_ssempeer = $sta_salary1 / 100 * $salary_ssempeer;?>
                      <div><?php echo $ssalary_ssempeer = number_format((float)$salary_ssempeer, 2, '.', '');?></div></li>
                      <?php } else {?>
                      	<?php $ssalary_ssempeer = 0;?>
                      <?php } ?>
                      <?php if($salary_income_tax!='' || $salary_income_tax!=0){?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="text-muted"><strong><?php echo $this->lang->line('xin_employee_set_inc_tax');?>:</strong></div>
                      <?php //$sta_salary2 = $allowance_amount + $basic_salary;?>
                      <?php //$ssalary_income_tax = $sta_salary2 / 100 * $salary_income_tax;?>
                      <div><?php echo $ssalary_income_tax = number_format((float)$salary_income_tax, 2, '.', '');?></div></li>
                      <?php } else {?>
                      	<?php $ssalary_income_tax = 0;?>
                      <?php } ?>
                      <?php $statutory_deductions = $ssalary_ssempee + $ssalary_ssempeer + $ssalary_income_tax;?>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="text-muted"><strong>&nbsp;</strong></div>
                      <div><strong><?php echo $this->lang->line('xin_acc_total');?>:</strong> <strong><?php echo $statutory_deductions;?></strong></div></li>
                    </ul>
                  </div>
                </div>
              </div>
              <?php } ?>
              <?php if(($salary_commission!='' || $salary_commission!=0) && ($salary_claims!='' || $salary_claims!=0) && ($salary_paid_leave!='' || $salary_paid_leave!=0) && ($salary_director_fees!='' || $salary_director_fees!=0) && ($salary_advance_paid!='' || $salary_advance_paid!=0)){?>
              <div class="card mb-2">
                <div class="card-header">
                  <a class="text-dark collapsed" data-toggle="collapse" href="#other_payment" aria-expanded="false">
                    <strong><?php echo $this->lang->line('xin_employee_set_other_payment');?></strong>
                  </a>
                </div>
                <div id="other_payment" class="collapse" data-parent="#accordion" style="">
                  <div class="card-body">
                    <ul class="list-group list-group-flush">
					<?php if($salary_commission!='' && $salary_commission!=0){?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="text-muted"><strong><?php echo $this->lang->line('xin_employee_set_oth_commission');?>:</strong></div>
                      <div><?php echo $ssalary_commission = $salary_commission;?></div></li>
                      <?php } else {?>
                      	<?php $ssalary_commission = 0;?>
                      <?php } ?>
                      <?php if($salary_claims!='' && $salary_claims!=0){?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="text-muted"><strong><?php echo $this->lang->line('xin_employee_set_oth_claims');?>:</strong></div>
                      <div><?php echo $ssalary_claims = $salary_claims;?></div></li>
                      <?php } else {?>
                      	<?php $ssalary_claims = 0;?>
                      <?php } ?>
                      <?php if($salary_paid_leave!='' && $salary_paid_leave!=0){?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="text-muted"><strong><?php echo $this->lang->line('xin_employee_set_oth_paid_leave');?>:</strong></div>
                      <div><?php echo $ssalary_paid_leave = $salary_paid_leave;?></div></li>
                      <?php } else {?>
                      	<?php $ssalary_paid_leave = 0;?>
                      <?php } ?>
                      <?php if($salary_director_fees!='' && $salary_director_fees!=0){?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="text-muted"><strong><?php echo $this->lang->line('xin_employee_set_oth_director_fees');?>:</strong></div>
                      <div><?php echo $ssalary_director_fees = $salary_director_fees;?></div></li>
                      <?php } else {?>
                      	<?php $ssalary_director_fees = 0;?>
                      <?php } ?>
                      <?php if($salary_advance_paid!='' && $salary_advance_paid!=0){?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="text-muted"><strong><?php echo $this->lang->line('xin_employee_set_oth_ad_paid');?>:</strong></div>
                      <div><?php echo $ssalary_advance_paid = $salary_advance_paid;?></div></li>
                      <?php } else {?>
                      	<?php $ssalary_advance_paid = 0;?>
                      <?php } ?>
                      <?php $all_other_payment = $ssalary_commission + $ssalary_claims + $ssalary_paid_leave + $ssalary_director_fees + $ssalary_advance_paid;?>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="text-muted"><strong>&nbsp;</strong></div>
                      <div><strong><?php echo $this->lang->line('xin_acc_total');?>:</strong> <strong><?php echo $all_other_payment;?></strong></div></li>
                    </ul>  
                  </div>
                </div>
              </div>
              <?php } ?>
              <?php $count_overtime = $this->Employees_model->count_employee_overtime_payslip($make_payment_id);?>
              <?php $overtime = $this->Employees_model->set_employee_overtime_payslip($make_payment_id);?>
              <?php if($count_overtime > 0):?>
              <div class="card mb-2">
                <div class="card-header">
                  <a class="text-dark collapsed" data-toggle="collapse" href="#overtime" aria-expanded="false">
                    <strong><?php echo $this->lang->line('dashboard_overtime');?></strong>
                  </a>
                </div>
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
                            <td><?php echo $r_overtime->overtime_title;?></td>
                            <td><?php echo $r_overtime->overtime_no_of_days;?></td>
                            <td><?php echo $r_overtime->overtime_hours;?></td>
                            <td><?php echo $r_overtime->overtime_rate;?></td>
                          </tr>
                          <?php $i++; } ?>
                        </tbody>
                        <tfoot>
                        <tr>
                          <td colspan="4" align="right"><strong><?php echo $this->lang->line('xin_acc_total');?>:</strong></td>
                          <td><?php echo $overtime_amount;?></td>
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
  <div class="col-md-6">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header with-elements"> <span class="card-header-title mr-2"><?php echo $this->lang->line('xin_payslip_earning');?></span> </div>
          <div class="card-body">
            <div class="table-responsive" data-pattern="priority-columns">
              <table class="datatables-demo table table-striped table-bordered dataTable no-footer">
                <tbody>
                  <?php if($total_allowances!=0 || $total_allowances!=''):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_payroll_total_allowance');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($total_allowances);?></span></td>
                  </tr>
                  <?php endif;?>
                  <?php if($total_loan!=0 || $total_loan!=''):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_payroll_total_loan');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($total_loan);?></span></td>
                  </tr>
                  <?php endif;?>
                  <?php if($total_overtime!=0 || $total_overtime!=''):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_payroll_total_overtime');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($total_overtime);?></span></td>
                  </tr>
                  <?php endif;?>
                  <?php if($statutory_deductions!=0 || $statutory_deductions!=''):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_employee_set_statutory_deductions');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($statutory_deductions);?></span></td>
                  </tr>
                  <?php endif;?>
                  <?php if($other_payment!=0 || $other_payment!=''):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_employee_set_other_payment');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($other_payment);?></span></td>
                  </tr>
                  <?php endif;?>
                  <?php if($net_salary!=0 || $net_salary!=''):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_paid_amount');?>:</strong> <span class="pull-right">
                      <?php echo $this->Xin_model->currency_sign($net_salary);?></span></td>
                  </tr>
                  <?php endif;?>
                  <?php if($payment_method):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_payment_method');?>:</strong> <span class="pull-right"><?php echo $payment_method;?></span></td>
                  </tr>
                  <?php endif;?>
                  <?php if($net_salary!=0 || $net_salary!=''):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_payment_comment');?>:</strong> <span class="pull-right"><?php echo $pay_comments;?></span></td>
                  </tr>
                  <?php endif;?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- pd--> 
