<?php
$session = $this->session->userdata('client_username');
$theme = $this->Xin_model->read_theme_info(1);
// set layout / fixed or static
if($theme[0]->right_side_icons=='true') {
	$icons_right = 'expanded menu-icon-right';
} else {
	$icons_right = '';
}
if($theme[0]->bordered_menu=='true') {
	$menu_bordered = 'menu-bordered';
} else {
	$menu_bordered = '';
}
$user_info = $this->Clients_model->read_client_info($session['client_id']);
if($user_info[0]->is_active!=1) {
	redirect('client/auth/');
}

?>
<?php $system = $this->Xin_model->read_setting_info(1);?>
<?php $arr_mod = $this->Xin_model->select_module_class($this->router->fetch_class(),$this->router->fetch_method()); ?>
<?php  if($user_info[0]->client_profile!='' && $user_info[0]->client_profile!='no file') {?>
	<?php $cpimg = base_url().'uploads/clients/'.$user_info[0]->client_profile;?>
<?php } else {?>
<?php  if($user_info[0]->gender=='Male') { ?>
<?php 	$de_file = base_url().'uploads/clients/default_male.jpg';?>
<?php } else { ?>
<?php 	$de_file = base_url().'uploads/clients/default_female.jpg';?>
<?php } ?>
    <?php $cpimg = $de_file;?>
<?php  } ?>
<!-- menu start-->
<section class="sidebar">
  <!-- Sidebar user panel -->
  
  <div class="user-panel">
    <div class="pull-left image"> <img src="<?php echo $cpimg;?>" class="img-circle" alt="User Image"> </div>
    <div class="pull-left info">
      <p><?php echo $user_info[0]->name;?></p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a> </div>
  </div>
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header"><?php echo $this->lang->line('xin_left_main');?></li>
    <li class="<?php if(!empty($arr_mod['active']))echo $arr_mod['active'];?>"> <a href="<?php echo site_url('client/dashboard');?>"> <i class="fa fa-dashboard"></i> <span><?php echo $this->lang->line('dashboard_title');?></span> </a> </li>
    <li class="<?php if(!empty($arr_mod['hr_client_project_active']))echo $arr_mod['hr_client_project_active'];?>"> <a href="<?php echo site_url('client/projects');?>"> <i class="fa fa-tasks"></i> <span><?php echo $this->lang->line('left_projects');?></span> </a> </li>
    <li class="<?php if(!empty($arr_mod['hr_client_invoices_active']))echo $arr_mod['hr_client_invoices_active'];?>"> <a href="<?php echo site_url('client/invoices');?>"> <i class="fa fa-info"></i> <span><?php echo $this->lang->line('xin_invoices_title');?></span> </a> </li>
    <li class="<?php if(!empty($arr_mod['hr_client_invoices_active']))echo $arr_mod['hr_client_invoices_active'];?>"> <a href="<?php echo site_url('client/profile?change_password=true');?>"> <i class="fa fa-lock"></i> <span><?php echo $this->lang->line('header_change_password');?></span> </a> </li>
    <li> <a href="<?php echo site_url('admin/logout');?>"> <i class="fa fa-sign-out"></i> <span><?php echo $this->lang->line('left_logout');?></span> </a> </li>
  </ul>
</section>