<?php
$session = $this->session->userdata('username');
$system = $this->Xin_model->read_setting_info(1);
$company_info = $this->Xin_model->read_company_setting_info(1);
$user = $this->Xin_model->read_employee_info($session['user_id']);
$theme = $this->Xin_model->read_theme_info(1);
?>
<div class="box-widget widget-user-2">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header">
      <div class="widget-user-image">
        <?php  if($user[0]->profile_picture!='' && $user[0]->profile_picture!='no file') {?>
        <img src="<?php  echo base_url().'uploads/profile/'.$user[0]->profile_picture;?>" alt="" class="img-circle ui-w-50 rounded-circle">
        <?php } else {?>
        <?php  if($user[0]->gender=='Male') { ?>
        <?php 	$de_file = base_url().'uploads/profile/default_male.jpg';?>
        <?php } else { ?>
        <?php 	$de_file = base_url().'uploads/profile/default_female.jpg';?>
        <?php } ?>
        <img src="<?php  echo $de_file;?>" alt="" id="user_avatar" class="img-circle ui-w-50 rounded-circle">
        <?php  } ?>
      </div>
      <h4 class="widget-user-username welcome-hrsale-user">Welcome back, <?php echo $user[0]->first_name.' '.$user[0]->last_name;?>!</h4>
      <h5 class="widget-user-desc welcome-hrsale-user-text">Today is <?php echo date('l, j F Y');?></h5>
    </div>
  </div>
                      

<hr class="container-m--x mt-0 mb-4">
<?php if($theme[0]->statistics_cards=='4' || $theme[0]->statistics_cards=='8' || $theme[0]->statistics_cards=='12'){?>
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon info-box-icon-hrsale"><i class="fa fa-users text-green"></i></span>
    
        <div class="info-box-content info-box-content-hrsale">
          <span class="info-box-text"><?php echo $this->lang->line('xin_people');?></span>
          <span class="info-box-number"><a class="text-muted" href="<?php echo site_url('admin/employees');?>"><i class="ft-arrow-up"></i><?php echo $this->Employees_model->get_total_employees();?></a></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon info-box-icon-hrsale"><i class="fa fa-building-o text-aqua"></i></span>
    
        <div class="info-box-content info-box-content-hrsale">
          <span class="info-box-text"><?php echo $this->lang->line('module_company_title');?></span>
          <span class="info-box-number"><a class="text-muted" href="<?php echo site_url('admin/company');?>"><i class="ft-arrow-up"></i><?php echo $this->Xin_model->get_all_companies();?></a></span>
        </div>
        <!-- /.info-box-content info-box-content-hrsale -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon info-box-icon-hrsale"><i class="fa fa-calendar text-red"></i></span>
    
        <div class="info-box-content info-box-content-hrsale">
          <span class="info-box-text"><?php echo $this->lang->line('left_leave');?></span>
          <span class="info-box-number"><a class="text-muted" href="<?php echo site_url('admin/timesheet/leave');?>"> <?php echo $this->lang->line('xin_performance_management');?></a></span>
        </div>
        <!-- /.info-box-content info-box-content-hrsale -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon info-box-icon-hrsale"><i class="fa fa-cog text-yellow"></i></span>
    
        <div class="info-box-content info-box-content-hrsale">
          <span class="info-box-text"><?php echo $this->lang->line('xin_configure_hr');?></span>
          <span class="info-box-number"><a class="text-muted" href="<?php echo site_url('admin/settings');?>"> <?php echo $this->lang->line('left_settings');?></a></span>
        </div>
        <!-- /.info-box-content info-box-content-hrsale -->
      </div>
      <!-- /.info-box -->
    </div>
</div>
<?php } ?>
<?php if($theme[0]->statistics_cards=='8' || $theme[0]->statistics_cards=='12'){?>
<div class="row">
  <?php if($system[0]->module_files=='true'){?>
  <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon info-box-icon-hrsale"><i class="fa fa-files-o text-yellow"></i></span>
    
        <div class="info-box-content info-box-content-hrsale">
          <span class="info-box-text"><?php echo $this->lang->line('xin_e_details_document');?></span>
          <span class="info-box-number"><a class="text-muted" href="<?php echo site_url('admin/files');?>"> <?php echo $this->lang->line('xin_performance_management');?></a></span>
        </div>
        <!-- /.info-box-content info-box-content-hrsale -->
      </div>
      <!-- /.info-box -->
    </div>
  <?php } else {?>
  <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon info-box-icon-hrsale"><i class="fa fa-plane text-yellow"></i></span>
    
        <div class="info-box-content info-box-content-hrsale">
          <span class="info-box-text"><?php echo $this->lang->line('xin_view');?></span>
          <span class="info-box-number"><a class="text-muted" href="<?php echo site_url('admin/timesheet/holidays');?>"> <?php echo $this->lang->line('left_holidays');?></a></span>
        </div>
        <!-- /.info-box-content info-box-content-hrsale -->
      </div>
      <!-- /.info-box -->
    </div>
  <?php } ?>
  <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon info-box-icon-hrsale"><i class="fa fa-table text-yellow"></i></span>
    
        <div class="info-box-content info-box-content-hrsale">
          <span class="info-box-text"><?php echo $this->lang->line('xin_theme_title');?></span>
          <span class="info-box-number"><a class="text-muted" href="<?php echo site_url('admin/theme');?>"> <?php echo $this->lang->line('left_settings');?></a></span>
        </div>
        <!-- /.info-box-content info-box-content-hrsale -->
      </div>
      <!-- /.info-box -->
    </div>
  <?php if($system[0]->module_projects_tasks=='true'){?>
  <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon info-box-icon-hrsale"><i class="fa fa-tasks text-green"></i></span>
    
        <div class="info-box-content info-box-content-hrsale">
          <span class="info-box-text"><?php echo $this->lang->line('dashboard_projects');?></span>
          <span class="info-box-number"><a class="text-muted" href="<?php echo site_url('admin/project');?>"><i class="ft-arrow-up"></i><?php echo $this->Xin_model->get_all_projects();?></a></span>
        </div>
        <!-- /.info-box-content info-box-content-hrsale -->
      </div>
      <!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon info-box-icon-hrsale"><i class="fa fa-calendar-check-o text-aqua"></i></span>
    
        <div class="info-box-content info-box-content-hrsale">
          <span class="info-box-text"><?php echo $this->lang->line('xin_tasks');?></span>
          <span class="info-box-number"><a class="text-muted" href="<?php echo site_url('admin/timesheet/tasks');?>"><i class="ft-arrow-up"></i><?php echo $this->Xin_model->get_all_tasks();?></a></span>
        </div>
        <!-- /.info-box-content info-box-content-hrsale -->
      </div>
      <!-- /.info-box -->
    </div>
  <?php } else {?>
  <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon info-box-icon-hrsale"><i class="fa fa-list text-green"></i></span>
    
        <div class="info-box-content info-box-content-hrsale">
          <span class="info-box-text"><?php echo $this->lang->line('xin_view');?></span>
          <span class="info-box-number"><a class="text-muted" href="<?php echo site_url('admin/designation');?>"> <?php echo $this->lang->line('left_designation');?></a></span>
        </div>
        <!-- /.info-box-content info-box-content-hrsale -->
      </div>
      <!-- /.info-box -->
    </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon info-box-icon-hrsale"><i class="fa fa-calendar-plus-o text-yellow"></i></span>
        <div class="info-box-content info-box-content-hrsale">
          <span class="info-box-text"><?php echo $this->lang->line('xin_view');?></span>
          <span class="info-box-number"><a class="text-muted" href="<?php echo site_url('admin/timesheet/office_shift');?>"> <?php echo $this->lang->line('left_office_shifts');?></a></span>
        </div>
        <!-- /.info-box-content info-box-content-hrsale -->
      </div>
      <!-- /.info-box -->
    </div>
  <?php } ?>
</div>
<?php } ?>
<?php if($theme[0]->statistics_cards=='12'){?>
<div class="row">
  <?php if($system[0]->module_training=='true'){?>
  <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon info-box-icon-hrsale"><i class="fa fa-graduation-cap text-green"></i></span>
    
        <div class="info-box-content info-box-content-hrsale">
          <span class="info-box-text"><?php echo $this->lang->line('left_training');?></span>
          <span class="info-box-number"><a class="text-muted" href="<?php echo site_url('admin/training');?>"><i class="ft-arrow-up"></i><?php echo $this->lang->line('xin_performance_management');?></a></span>
        </div>
        <!-- /.info-box-content info-box-content-hrsale -->
      </div>
      <!-- /.info-box -->
    </div>
  <?php } else {?>
  <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon info-box-icon-hrsale"><i class="fa fa-life-ring text-aqua"></i></span>
    
        <div class="info-box-content info-box-content-hrsale">
          <span class="info-box-text"><?php echo $this->lang->line('xin_setup');?></span>
          <span class="info-box-number"><a class="text-muted" href="<?php echo site_url('admin/settings/modules');?>"><i class="ft-arrow-up"></i><?php echo $this->lang->line('xin_modules');?></a></span>
        </div>
        <!-- /.info-box-content info-box-content-hrsale -->
      </div>
      <!-- /.info-box -->
    </div>
  <?php }?>
  <?php if($system[0]->module_travel=='true'){?>
  <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon info-box-icon-hrsale"><i class="fa fa-plane text-red"></i></span>
    
        <div class="info-box-content info-box-content-hrsale">
          <span class="info-box-text"><?php echo $this->lang->line('xin_travel');?></span>
          <span class="info-box-number"><a class="text-muted" href="<?php echo site_url('admin/travel');?>"> <?php echo $this->lang->line('xin_requests');?></a></span>
        </div>
        <!-- /.info-box-content info-box-content-hrsale -->
      </div>
      <!-- /.info-box -->
    </div>
  <?php } else {?>
  <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon info-box-icon-hrsale"><i class="fa fa-calendar-o text-red"></i></span>
    
        <div class="info-box-content info-box-content-hrsale">
          <span class="info-box-text"><?php echo $this->lang->line('xin_view');?></span>
          <span class="info-box-number"><a class="text-muted" href="<?php echo site_url('admin/timesheet/attendance');?>"> <?php echo $this->lang->line('dashboard_attendance');?></a></span>
        </div>
        <!-- /.info-box-content info-box-content-hrsale -->
      </div>
      <!-- /.info-box -->
    </div>
  <?php } ?>
  <?php if($system[0]->module_inquiry=='true'){?>
  <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon info-box-icon-hrsale"><i class="fa fa-tags text-yellow"></i></span>
    
        <div class="info-box-content info-box-content-hrsale">
          <span class="info-box-text"><?php echo $this->lang->line('left_tickets');?></span>
          <span class="info-box-number"><a class="text-muted" href="<?php echo site_url('admin/tickets');?>"> <?php echo $this->Xin_model->get_all_tickets();?></a></span>
        </div>
        <!-- /.info-box-content info-box-content-hrsale -->
      </div>
      <!-- /.info-box -->
    </div>
  <?php } else {?>
  <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon info-box-icon-hrsale"><i class="fa fa-building-o text-yellow"></i></span>
    
        <div class="info-box-content info-box-content-hrsale">
          <span class="info-box-text"><?php echo $this->lang->line('xin_view');?></span>
          <span class="info-box-number"><a class="text-muted" href="<?php echo site_url('admin/department');?>"> <?php echo $this->lang->line('left_department');?></a></span>
        </div>
        <!-- /.info-box-content info-box-content-hrsale -->
      </div>
      <!-- /.info-box -->
    </div>
  <?php } ?>
  <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon info-box-icon-hrsale"><i class="fa fa-lock text-light-blue"></i></span>
    
        <div class="info-box-content info-box-content-hrsale">
          <span class="info-box-text"><?php echo $this->lang->line('xin_permission');?></span>
          <span class="info-box-number"><a class="text-muted" href="<?php echo site_url('admin/roles');?>"> <?php echo $this->lang->line('xin_roles');?></a></span>
        </div>
        <!-- /.info-box-content info-box-content-hrsale -->
      </div>
      <!-- /.info-box -->
    </div>
</div>
<?php } ?>
<hr class="container-m--x mt-0 mb-4">
<?php $this->load->view('admin/calendar/calendar_hr');?>
<div class="row">
<?php $exp_am = $this->Expense_model->get_total_expenses();?>
<hr class="container-m--x mt-0 mb-4">
<div class="col-md-6 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon info-box-icon-hrsale"><i class="fa fa-money text-red"></i></span>
    
        <div class="info-box-content info-box-content-hrsale">
          <span class="info-box-text"><?php echo $this->lang->line('dashboard_total_expenses');?> <span class="pull-right text-green"><?php echo $this->Xin_model->currency_sign($exp_am[0]->exp_amount);?></span></span>
          <span class="info-box-number"><a class="text-muted" href="<?php echo site_url('admin/expense');?>"> <?php echo $this->lang->line('xin_view');?> <i class="fa fa-arrow-right"></i></a></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <?php $all_sal = $this->Xin_model->get_total_salaries_paid();?>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon info-box-icon-hrsale"><i class="fa fa-dollar text-red"></i></span>
    
        <div class="info-box-content info-box-content-hrsale">
          <span class="info-box-text"><?php echo $this->lang->line('dashboard_total_salaries');?> <span class="pull-right text-green"><?php echo $this->Xin_model->currency_sign($all_sal[0]->paid_amount);?></span></span>
          <span class="info-box-number"><a class="text-muted" href="<?php echo site_url('admin/payroll/payment_history');?>"> <?php echo $this->lang->line('xin_view');?> <i class="fa fa-arrow-right"></i></a></span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
</div>    
<hr class="container-m--x mt-0 mb-4">
<div class="row">
<div class="col-sm-7 col-xl-8">
<div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo $this->lang->line('left_payment_history');?></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="table-responsive">
        <table class="table no-margin">
          <thead>
          <tr>
              <th><?php echo $this->lang->line('xin_employee_name');?></th>
              <th><?php echo $this->lang->line('xin_paid_amount');?></th>
              <th><?php echo $this->lang->line('dashboard_xin_status');?></th>
              <th><?php echo $this->lang->line('xin_payment_month');?></th>
              <th><?php echo $this->lang->line('xin_payslip');?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($get_last_payment_history as $last_payments):?>
            <?php $user = $this->Xin_model->read_user_info($last_payments->employee_id);?>
            <?php if(!is_null($user)){?>
            <?php $full_name = $user[0]->first_name.' '.$user[0]->last_name;?>
            <?php
            $month_payment = date("F, Y", strtotime($last_payments->salary_month));
            
			if($last_payments->wages_type == 1){
				$bs = $last_payments->basic_salary;
			} else {
				$bs = $last_payments->daily_wages;
			}
			$total_earning = $bs + $last_payments->total_allowances + $last_payments->total_overtime;
			$total_deduction = $last_payments->total_loan + $last_payments->salary_income_tax + $last_payments->salary_ssempee;
			$total_net_salary = $total_earning - $total_deduction;
			$p_amount = $this->Xin_model->currency_sign($total_net_salary);
            ?>
             <tr>
            <td><a target="_blank" href="<?php echo site_url().'admin/employees/detail/'.$last_payments->employee_id;?>/"><?php echo $full_name;?></a></td>
            <td><?php echo $p_amount;?></td>
            <td><span class="label label-success"><?php echo $this->lang->line('xin_payment_paid');?></span></td>
            <td><?php echo $month_payment;?></td>
            <td><a target="_blank" href="<?php echo site_url().'admin/payroll/payslip/id/'.$last_payments->payslip_id;?>/"><?php echo $this->lang->line('xin_payslip');?></a></td>
          </tr>
          <?php } ?>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
      <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->
    <div class="box-footer clearfix">
      <a href="<?php echo site_url('admin/payroll/payment_history');?>" target="_blank" class="btn btn-sm btn-default btn-flat pull-right"><?php echo $this->lang->line('xin_all_payslips');?></a>
    </div>
    <!-- /.box-footer -->
  </div>
          </div>
          <div class="col-md-5">
              <!-- USERS LIST -->
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"><?php echo $this->lang->line('dashboard_new');?> <?php echo $this->lang->line('dashboard_employees');?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    <?php foreach($last_four_employees as $employee) {?>
        			<?php 
                    if($employee->profile_picture!='' && $employee->profile_picture!='no file') {
                        $de_file = base_url().'uploads/profile/'.$employee->profile_picture;
                    } else { 
                        if($employee->gender=='Male') {  
                        $de_file = base_url().'uploads/profile/default_male.jpg'; 
                        } else {  
                        $de_file = base_url().'uploads/profile/default_female.jpg';
                        }
                    }
                    $fname = $employee->first_name.' '.$employee->last_name;
                    ?>
                    <li>
                      <a class="users-list-name" href="<?php echo site_url();?>admin/employees/detail/<?php echo $employee->user_id;?>/"><img src="<?php echo $de_file;?>" alt="<?php echo $fname;?>"></a>
                      <a class="users-list-name" href="<?php echo site_url();?>admin/employees/detail/<?php echo $employee->user_id;?>/">
					  <?php echo $fname;?></a>
                    </li>
                    <?php } ?>
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="<?php echo site_url('admin/employees/');?>" class="uppercase">View All Users</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>
          </div>
<!--<div class="row">
  <div class="col-sm-6 col-xl-8">
    <div class="card mb-4">
      <h6 class="card-header with-elements">
        <div class="card-header-title"><?php echo $this->lang->line('left_payment_history');?></div>
        <div class="card-header-elements ml-auto"> <a href="<?php echo site_url('admin/payroll/payment_history');?>" target="_blank">
          <button type="button" class="btn btn-default btn-xs md-btn-flat"><?php echo $this->lang->line('xin_all_payslips');?> <i class="ion ion-md-arrow-round-forward text-tiny"></i></button>
          </a> </div>
      </h6>
      <div class="table-responsive">
        <table class="table card-table">
          <thead>
            <tr>
              <th><?php echo $this->lang->line('xin_employee_name');?></th>
              <th><?php echo $this->lang->line('xin_paid_amount');?></th>
              <th><?php echo $this->lang->line('dashboard_xin_status');?></th>
              <th><?php echo $this->lang->line('xin_payment_month');?></th>
              <th><?php echo $this->lang->line('xin_payslip');?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($get_last_payment_history as $last_payments):?>
            <?php $user = $this->Xin_model->read_user_info($last_payments->employee_id);?>
            <?php if(!is_null($user)){?>
            <?php $full_name = $user[0]->first_name.' '.$user[0]->last_name;?>
            <?php
                             $month_payment = date("F, Y", strtotime($last_payments->payment_date));
                             $p_amount = $this->Xin_model->currency_sign($last_payments->payment_amount);
                             ?>
            <tr>
              <td class="text-truncate"><a target="_blank" href="<?php echo site_url().'admin/employees/detail/'.$last_payments->employee_id;?>/"><?php echo $full_name;?></a></td>
              <td class="text-truncate"><?php echo $p_amount;?></td>
              <td class="text-truncate"><span class="tag tag-success"><?php echo $this->lang->line('xin_payment_paid');?></span></td>
              <td class="text-truncate"><?php echo $month_payment;?></td>
              <td class="text-truncate"><a target="_blank" href="<?php echo site_url().'admin/payroll/payslip/id/'.$last_payments->make_payment_id;?>/"><?php echo $this->lang->line('xin_payslip');?></a></td>
            </tr>
            <?php } ?>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
      <a href="<?php echo site_url('admin/payroll/payment_history/');?>" class="card-footer d-block text-center text-dark small font-weight-semibold">SHOW MORE</a> </div>
  </div>
  <div class="col-sm-4 col-xl-4">
    <div class="card mb-4">
      <div class="card-header with-elements"> <span class="card-header-title"><?php echo $this->lang->line('dashboard_new');?> <?php echo $this->lang->line('dashboard_employees');?> &nbsp; </span>
        <div class="card-header-elements ml-md-auto"> <a href="javascript:void(0)" class="btn btn-default md-btn-flat btn-xs">Show Alls</a> </div>
      </div>
      <div class="row no-gutters row-bordered row-border-light">
        <?php foreach($last_four_employees as $employee) {?>
        <?php 
                    if($employee->profile_picture!='' && $employee->profile_picture!='no file') {
                        $de_file = base_url().'uploads/profile/'.$employee->profile_picture;
                    } else { 
                        if($employee->gender=='Male') {  
                        $de_file = base_url().'uploads/profile/default_male.jpg'; 
                        } else {  
                        $de_file = base_url().'uploads/profile/default_female.jpg';
                        }
                    }
                    $fname = $employee->first_name.' '.$employee->last_name;
                    ?>
        <a href="<?php echo site_url();?>admin/employees/detail/<?php echo $employee->user_id;?>/" class="d-flex col-4 col-sm-3 col-md-4 flex-column align-items-center text-dark py-3 px-2"> <img src="<?php  echo $de_file;?>" alt="" class="d-block ui-w-40 rounded-circle mb-2">
        <div class="text-center small"><?php echo $fname;?></div>
        </a>
        <?php } ?>
      </div>
      <a href="<?php echo site_url('admin/employees/');?>" class="card-footer d-block text-center text-dark small font-weight-semibold">SHOW MORE</a> </div>
  </div>
</div>-->
