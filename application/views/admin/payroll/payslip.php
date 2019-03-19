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
    <div class="box mb-4">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $this->lang->line('xin_payslip');?> - </strong><?php echo date("F, Y", strtotime($payment_date));?></h3>
        <div class="box-tools pull-right"> <a href="<?php echo site_url();?>admin/payroll/pdf_create/p/<?php echo $make_payment_id;?>/" class="btn btn-social-icon mb-1 btn-outline-github" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $this->lang->line('xin_payroll_download_payslip');?>"><i class="fa fa-file-pdf-o"></i></a> </div>
      </div>
      <div class="box-body">
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
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"> <?php echo $this->lang->line('xin_payment_details');?> </h3>
      </div>
      <div class="box-body">
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
          <?php $count_allowances = $this->Employees_model->count_employee_allowances_payslip($make_payment_id);?>
          <?php $allowances = $this->Employees_model->set_employee_allowances_payslip($make_payment_id);?>
          <?php if($count_allowances > 0):?>
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
          <?php $count_loan = $this->Employees_model->count_employee_deductions_payslip($make_payment_id);?>
          <?php $loan = $this->Employees_model->set_employee_deductions_payslip($make_payment_id);?>
          <?php if($count_loan > 0):?>
          <div class="card mb-2">
            <div class="card-header"> <a class="text-dark collapsed" data-toggle="collapse" href="#set_loan_deductions" aria-expanded="false"> <strong><?php echo $this->lang->line('xin_employee_set_loan_deductions');?></strong> </a> </div>
            <div id="set_loan_deductions" class="collapse" data-parent="#accordion" style="">
              <div class="box-body">
                <div class="table-responsive" data-pattern="priority-columns">
                  <table class="datatables-demo table table-striped table-bordered dataTable no-footer">
                    <tbody>
                      <?php $loan_de_amount = 0; foreach($loan->result() as $r_loan) { ?>
					  <?php $loan_de_amount += $r_loan->loan_amount;?>
                      <tr>
                        <td><strong><?php echo $r_loan->loan_title;?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign($r_loan->loan_amount);?></span></td>
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
          <?php else:?>
          <?php $loan_de_amount = 0;?>
          <?php endif;?>
          <?php if(($salary_ssempee!='' && $salary_ssempee!=0) || ($salary_ssempeer!='' && $salary_ssempeer!=0) || ($salary_income_tax!='' && $salary_income_tax!=0) || ($salary_esi_employee!='' && $salary_esi_employee!=0) || ($salary_professional_tax!='' && $salary_professional_tax!=0)){?>
          <div class="card mb-2">
            <div class="card-header"> <a class="text-dark collapsed" data-toggle="collapse" href="#statutory_deductions" aria-expanded="false"> <strong><?php echo $this->lang->line('xin_employee_set_statutory_deductions');?></strong> </a> </div>
            <div id="statutory_deductions" class="collapse" data-parent="#accordion" style="">
              <div class="box-body">
                <div class="table-responsive" data-pattern="priority-columns">
                  <table class="datatables-demo table table-striped table-bordered dataTable no-footer">
                    <tbody>
                      <tr>
                        <td><strong><?php echo $this->lang->line('xin_employee_set_ssempee');?>:</strong> <span class="pull-right">
                        <?php if($salary_ssempee!='' && $salary_ssempee!=0){?>
                        	<?php echo $ssalary_ssempee = $this->Xin_model->currency_sign($salary_ssempee);?>
                        <?php } else {?>
                        	<?php echo $ssalary_ssempee = $this->Xin_model->currency_sign($salary_ssempee);?>
							<?php $ssalary_ssempee = 0;?>
                        <?php } ?>
                        </span></td>
                      </tr>
<!--                      <tr>-->
<!--                        <td><strong>--><?php //echo $this->lang->line('xin_employee_set_ssempeer');?><!--:</strong> <span class="pull-right">-->
<!--                        --><?php //if($salary_ssempeer!='' && $salary_ssempeer!=0){?>
<!--							--><?php //echo $salary_ssempeer = $this->Xin_model->currency_sign($salary_ssempeer);?>
<!--                        --><?php //} else {?>
<!--							--><?php //$salary_ssempeer = 0;?>
<!--                            --><?php //echo $salary_ssempeer = $this->Xin_model->currency_sign($salary_ssempeer);?>
<!--                        --><?php //} ?>
<!--                        </span></td>-->
<!--                      </tr>-->
                      <tr>
                        <td><strong><?php echo $this->lang->line('xin_employee_set_inc_tax');?>:</strong> <span class="pull-right">
                        <?php if($salary_income_tax!='' && $salary_income_tax!=0){?>
                        	<?php echo $ssalary_income_tax = $this->Xin_model->currency_sign($salary_income_tax);?>
                        <?php } else {?>
                        	<?php echo $ssalary_income_tax = $this->Xin_model->currency_sign($salary_income_tax);?>
							<?php $ssalary_income_tax = 0;?>
                        <?php } ?>
                        </span></td>
                      </tr>
                      <tr>
                          <td><strong><?php echo $this->lang->line('xin_employee_set_esi');?>:</strong> <span class="pull-right">
                        <?php if($salary_esi_employee!='' && $salary_esi_employee!=0){?>
                            <?php echo $salary_esi_employee = $this->Xin_model->currency_sign($salary_esi_employee);?>
                        <?php } else {?>
                            <?php echo $salary_esi_employee = $this->Xin_model->currency_sign($salary_esi_employee);?>
                            <?php $salary_esi_employee = 0;?>
                        <?php } ?>
                        </span></td>
                      </tr>
                      <tr>
                          <td><strong><?php echo $this->lang->line('xin_employee_set_inc_tax_pro');?>:</strong> <span class="pull-right">
                        <?php if($salary_professional_tax!='' && $salary_professional_tax!=0){?>
                            <?php echo $salary_professional_tax = $this->Xin_model->currency_sign($salary_professional_tax);?>
                        <?php } else {?>
                            <?php echo $salary_professional_tax = $this->Xin_model->currency_sign($salary_professional_tax);?>
                            <?php $salary_professional_tax = 0;?>
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
          <?php $count_overtime = $this->Employees_model->count_employee_overtime_payslip($make_payment_id);?>
          <?php $overtime = $this->Employees_model->set_employee_overtime_payslip($make_payment_id);?>
          <?php if($count_overtime > 0):?>
          <div class="card mb-2">
            <div class="card-header"> <a class="text-dark collapsed" data-toggle="collapse" href="#overtime" aria-expanded="false"> <strong><?php echo $this->lang->line('dashboard_overtime');?></strong> </a> </div>
            <div id="overtime" class="collapse" data-parent="#accordion" style="">
              <div class="box-body">
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
                        <td><?php echo $this->Xin_model->currency_sign($overtime_amount);?></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php else:?>
          <?php $overtime_amount = 0;?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title"> <?php echo $this->lang->line('xin_payslip_earning');?> </h3>
          </div>
          <div class="box-body">
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
                    <td><strong><?php echo $this->lang->line('xin_payroll_total_loan');?>:</strong> <span class="pull-right"><?php echo $this->Xin_model->currency_sign(number_format($total_loan, 2, '.', ','));?></span></td>
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
                  <?php
				  	if($wages_type == 1){
						$bs = $basic_salary;
					} else {
						$bs = $daily_wages;
					}
					$total_earning = $bs + $total_allowances + $overtime_amount;
//					$total_deduction = $loan_de_amount + $salary_income_tax + $salary_ssempee + $salary_professional_tax + $salary_esi_employee;
					$total_deduction = $loan_de_amount + $statutory_deductions;
					$total_net_salary = $total_earning - $total_deduction;
				  ?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_paid_amount');?>:</strong> <span class="pull-right"> <?php echo $this->Xin_model->currency_sign(number_format($total_net_salary, 2, '.', ','));?></span></td>
                  </tr>
                  <?php endif;?>
                  <?php /*?><?php if($payment_method):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_payment_method');?>:</strong> <span class="pull-right"><?php echo $payment_method;?></span></td>
                  </tr>
                  <?php endif;?>
                  <?php if($net_salary!=0 || $net_salary!=''):?>
                  <tr>
                    <td><strong><?php echo $this->lang->line('xin_payment_comment');?>:</strong> <span class="pull-right"><?php echo $pay_comments;?></span></td>
                  </tr>
                  <?php endif;?><?php */?>
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
