<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['employee_id']) && $_GET['data']=='payment' && $_GET['type']=='monthly_payment'){ ?>
<?php
$payment_month = strtotime($this->input->get('pay_date'));
$p_month = date('F Y',$payment_month);
if($wages_type==1){
	$basic_salary = $basic_salary;
} else {
	$basic_salary = $daily_wages;
}
?>
<?php
$salary_allowances = $this->Employees_model->read_salary_allowances($user_id);
$count_allowances = $this->Employees_model->count_employee_allowances($user_id);
$allowance_amount = 0;
if($count_allowances > 0) {
	foreach($salary_allowances as $sl_allowances){
		$allowance_amount += $sl_allowances->allowance_amount;
	}
} else {
	$allowance_amount = 0;
}
// 3: all loan/deductions
$salary_loan_deduction = $this->Employees_model->read_salary_loan_deductions($user_id);
$count_loan_deduction = $this->Employees_model->count_employee_deductions($user_id);
$loan_de_amount = 0;
if($count_loan_deduction > 0) {
	foreach($salary_loan_deduction as $sl_salary_loan_deduction){
		$loan_de_amount += $sl_salary_loan_deduction->loan_deduction_amount;
	}
} else {
	$loan_de_amount = 0;
}
// 4: other payment
$s_acommission = 0;
if($salary_commission == ''){
	$s_acommission = 0;
} else {
	$s_acommission = $salary_commission;
}
$s_paid_leave = 0;
if($salary_paid_leave == ''){
	$s_paid_leave = 0;
} else {
	$s_paid_leave = $salary_paid_leave;
}
$s_director_fees = 0;
if($salary_director_fees == ''){
	$s_director_fees = 0;
} else {
	$s_director_fees = $salary_director_fees;
}
$s_advance_paid = 0;
if($salary_advance_paid == ''){
	$s_advance_paid = 0;
} else {
	$s_advance_paid = $salary_advance_paid;
}
$s_claims = 0;
if($salary_claims == ''){
	$s_claims = 0;
} else {
	$s_claims = $salary_claims;
}

// all other payment
$all_other_payment = $s_acommission + $s_paid_leave + $s_director_fees + $s_advance_paid + $s_claims;

// 5: overtime
$salary_overtime = $this->Employees_model->read_salary_overtime($user_id);
$count_overtime = $this->Employees_model->count_employee_overtime($user_id);
$overtime_amount = 0;
if($count_overtime > 0) {
	foreach($salary_overtime as $sl_overtime){
		$overtime_total = $sl_overtime->overtime_hours * $sl_overtime->overtime_rate;
		$overtime_amount += $overtime_total;
	}
} else {
	$overtime_amount = 0;
}


// add amount
$add_salary = $allowance_amount + $basic_salary + $overtime_amount + $all_other_payment;
// add amount
$net_salary_default = $add_salary - $loan_de_amount;
$sta_salary = $allowance_amount + $basic_salary;
// 6: statutory deductions
$s_ssempee = 0;
if($salary_ssempee == '' && $salary_ssempee == 0){
	$s_ssempee = 0;
} else {
	$s_ssempee = $sta_salary / 100 * $salary_ssempee;
}
$s_ssempeer = 0;
/*if($salary_ssempeer == '' && $salary_ssempeer == 0){
	$s_ssempeer = 0;
} else {
	$s_ssempeer = $sta_salary / 100 * $salary_ssempeer;
}*/
$s_income_tax = 0;
if($salary_income_tax == '' && $salary_income_tax == 0){
	$s_income_tax = 0;
} else {
	$s_income_tax = $sta_salary / 100 * $salary_income_tax;
}

// esi deduction
    $s_esiempee = 0;
    if($salary_ssempee == '' && $salary_ssempee == 0){
        $s_esiempee = 0;
    } else {
        $s_esiempee = $sta_salary / 100 * $salary_esi_employee;
    }

 // professional tax
    $s_protax = 0;
    if($salary_professional_tax == '' && $salary_professional_tax == 0){
        $s_protax = 0;
    } else {
        $s_protax = $salary_professional_tax;
    }

$statutory_deductions = $s_ssempee + $s_income_tax +$s_esiempee +$s_protax;
//if($r->salary_advance_paid == ''){
//$data1 = $add_salary. ' - ' .$loan_de_amount. ' - ' .$net_salary . ' - ' .$salary_ssempee . ' - ' .$statutory_deductions;
$net_salary = $net_salary_default - $statutory_deductions;
$net_salary = number_format((float)$net_salary, 2, '.', '');
?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data"><strong><?php echo $this->lang->line('xin_payment_for');?></strong> <?php echo $p_month;?></h4>
</div>
<div class="modal-body" style="overflow:auto; height:530px;">
<?php $attributes = array('name' => 'pay_monthly', 'id' => 'pay_monthly', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'ADD');?>
<?php echo form_open('admin/payroll/add_pay_monthly/', $attributes, $hidden);?>
   <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <input type="hidden" name="department_id" value="<?php echo $department_id;?>" />
          <input type="hidden" name="designation_id" value="<?php echo $designation_id;?>" />
          <input type="hidden" name="company_id" value="<?php echo $company_id;?>" />
          <label for="name"><?php echo $this->lang->line('xin_payroll_basic_salary');?></label>
          <input type="text" name="gross_salary" class="form-control" readonly value="<?php echo $basic_salary;?>">
          <input type="hidden" id="emp_id" value="<?php echo $user_id?>" name="emp_id">
          <input type="hidden" value="<?php echo $user_id;?>" name="u_id">
          <input type="hidden" value="<?php echo $basic_salary;?>" name="basic_salary">
          <input type="hidden" value="<?php echo $wages_type;?>" name="wages_type">
          <input type="hidden" value="<?php echo $this->input->get('pay_date');?>" name="pay_date" id="pay_date">
        </div>
      </div>
    </div>
    <input type="hidden" name="salary_commission" value="<?php echo $s_acommission;?>">
    <input type="hidden" name="salary_paid_leave" value="<?php echo $s_paid_leave;?>">
    <input type="hidden" name="salary_director_fees" value="<?php echo $s_director_fees;?>">
    <input type="hidden" name="salary_advance_paid" value="<?php echo $s_advance_paid;?>">
    <input type="hidden" name="salary_claims" value="<?php echo $s_claims;?>">
    <input type="hidden" name="salary_ssempee" value="<?php echo $s_ssempee;?>">
    <input type="hidden" name="salary_ssempeer" value="<?php echo $s_ssempeer;?>">
    <input type="hidden" name="salary_income_tax" value="<?php echo $s_income_tax;?>">
    <input type="hidden" name="salary_professional_tax" value="<?php echo $s_protax;?>">
    <input type="hidden" name="salary_esi_employee" value="<?php echo $s_esiempee;?>">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="name"><?php echo $this->lang->line('xin_payroll_total_allowance');?></label>
          <input type="text" name="total_allowances" class="form-control" value="<?php echo $allowance_amount;?>" readonly>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="name"><?php echo $this->lang->line('xin_payroll_total_loan');?></label>
          <input type="text" name="total_loan" class="form-control" value="<?php echo $loan_de_amount;?>" readonly>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="name"><?php echo $this->lang->line('xin_payroll_total_overtime');?></label>
          <input type="text" name="total_overtime" class="form-control" value="<?php echo $overtime_amount;?>" readonly>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="name"><?php echo $this->lang->line('xin_employee_set_statutory_deductions');?></label>
          <input type="text" name="statutory_deductions" class="form-control" value="<?php echo $statutory_deductions;?>" readonly>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="name"><?php echo $this->lang->line('xin_employee_set_other_payment');?></label>
          <input type="text" name="other_payment" class="form-control" value="<?php echo $all_other_payment;?>" readonly>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="name"><?php echo $this->lang->line('xin_payroll_net_salary');?></label>
          <input type="text" name="net_salary" class="form-control" value="<?php echo $net_salary;?>">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="name"><?php echo $this->lang->line('xin_payroll_payment_amount');?></label>
          <input type="text" name="payment_amount" class="form-control" value="<?php echo $net_salary;?>" readonly>
        </div>
      </div>
    </div>
    
    <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('xin_pay');?></button>
  <?php echo form_close(); ?>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });
	
	// On page load: datatable					
	$("#pay_monthly").submit(function(e){
	
	/*Form Submit*/
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		//$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=11&data=monthly&add_type=add_monthly_payment&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				} else {
					$('.emo_monthly_pay').modal('toggle');
					var xin_table = $('#xin_table').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?php echo site_url("admin/payroll/payslip_list") ?>?employee_id=0&company_id=<?php echo $company_id;?>&month_year=<?php echo $this->input->get('pay_date');?>",
							type : 'GET'
						},
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}
					});
					xin_table.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);
					$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				}
			}
		});
	});
});	
</script>
<?php } else if(isset($_GET['jd']) && isset($_GET['employee_id']) && $_GET['data']=='payment' && $_GET['type']=='hourly_payment'){ ?>
<?php
$payment_month = strtotime($_GET['pay_date']);
$p_month = date('F Y',$payment_month);
$company_id = $_GET['company_id'];
//
$result = $this->Payroll_model->total_hours_worked($_GET['employee_id'],$_GET['pay_date']);

/* total work clock-in > clock-out  */
/*$sql_tw = "SELECT * FROM hrm_attendance_time where `employee_id` = '".$_GET['emp_id']."' and attendance_date like '%".$_GET['pay_date']."%'";
$results_tw = mysqli_query($db_connection, $sql_tw);*/
$hrs_old_int1 = 0;
$Total = '';
$Trest = '';
$total_time_rs = '';
$hrs_old_int_res1 = '';
foreach ($result->result() as $hour_work){
	// total work			
	$clock_in =  new DateTime($hour_work->clock_in);
	$clock_out =  new DateTime($hour_work->clock_out);
	$interval_late = $clock_in->diff($clock_out);
	$hours_r  = $interval_late->format('%h');
	$minutes_r = $interval_late->format('%i');			
	$total_time = $hours_r .":".$minutes_r.":".'00';
	
	$str_time = $total_time;

	$str_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $str_time);
	
	sscanf($str_time, "%d:%d:%d", $hours, $minutes, $seconds);
	
	$hrs_old_seconds = $hours * 3600 + $minutes * 60 + $seconds;
	
	$hrs_old_int1 += $hrs_old_seconds;
	
	$Total = gmdate("H", $hrs_old_int1);			
}

?>
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data"><strong><?php echo $this->lang->line('xin_payment_for');?></strong> <?php echo $p_month;?></h4>
</div>
<div class="modal-body">
<?php $attributes = array('name' => 'pay_hourly', 'id' => 'pay_hourly', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'ADD');?>
<?php echo form_open('admin/payroll/add_pay_hourly/', $attributes, $hidden);?>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="name"><?php echo $this->lang->line('xin_payroll_hourly_rate');?></label>
          <input type="text" name="hourly_rate" class="form-control" value="<?php echo $hourly_rate;?>" readonly>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <input type="hidden" id="emp_id" name="emp_id" value="<?php echo $user_id?>">
          <input type="hidden" value="<?php echo $user_id;?>" name="u_id">
          <input type="hidden" value="<?php echo $_GET['pay_date'];?>" name="pay_date" id="pay_date">
          <label for="name"><?php echo $this->lang->line('xin_total_hours_worked');?></label>
          <input type="text" name="total_hours_work" class="form-control" value="<?php echo $Total;?>" readonly>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <input type="hidden" name="department_id" value="<?php echo $department_id;?>" />
          <input type="hidden" name="company_id" value="<?php echo $company_id;?>" />
          <input type="hidden" name="designation_id" value="<?php echo $designation_id;?>" />
          <label for="name"><?php echo $this->lang->line('xin_payroll_payment_amount');?></label>
          <input type="text" name="payment_amount" class="form-control" value="<?php echo (int)$Total * (int)$hourly_rate;?>" readonly>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="payment_method"><?php echo $this->lang->line('xin_payment_method');?></label>
          <select name="payment_method" class="select2" data-plugin="select_hrm" data-placeholder="<?php echo $this->lang->line('xin_choose_payment_method');?>">
            <option value="">&nbsp;</option>
            <option value="1">Online</option>
            <option value="2">PayPal</option>
            <option value="3">Payoneer</option>
            <option value="4">Bank Transfer</option>
            <option value="5">Cheque</option>
            <option value="6">Cash</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="name"><?php echo $this->lang->line('xin_payment_comment');?></label>
          <input type="text" class="form-control" name="comments">
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary save"><?php echo $this->lang->line('xin_pay');?></button>
  <?php echo form_close(); ?>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
	$('[data-plugin="select_hrm"]').select2({ width:'100%' });
		
	$("#pay_hourly").submit(function(e){
	
	/*Form Submit*/
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$('.save').prop('disabled', true);
		$.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=12&data=hourly&add_type=pay_hourly&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				} else {
					$('.emo_hourly_pay').modal('toggle');
					// On page load: datatable
					var xin_table = $('#xin_table').dataTable({
						"bDestroy": true,
						"ajax": {
							url : "<?php echo site_url("admin/payroll/payslip_list") ?>?employee_id=0&company_id=<?php echo $company_id;?>&month_year=<?php echo $this->input->get('pay_date');?>",
							type : 'GET'
						},
						"fnDrawCallback": function(settings){
						$('[data-toggle="tooltip"]').tooltip();          
						}
					});
					xin_table.api().ajax.reload(function(){ 
						toastr.success(JSON.result);
					}, true);
					$('input[name="csrf_hrsale"]').val(JSON.csrf_hash);
					$('.save').prop('disabled', false);
				}
			}
		});
	});
});	
</script>
<?php }
?>
