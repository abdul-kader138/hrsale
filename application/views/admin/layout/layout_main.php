<?php
$session = $this->session->userdata('username');
$system = $this->Xin_model->read_setting_info(1);
$company_info = $this->Xin_model->read_company_setting_info(1);
$layout = $this->Xin_model->system_layout();
$user_info = $this->Xin_model->read_user_info($session['user_id']);
//material-design
$theme = $this->Xin_model->read_theme_info(1);
// set layout / fixed or static
if($user_info[0]->fixed_header=='fixed_layout_hrsale') {
	$fixed_header = 'fixed';
} else {
	$fixed_header = '';
}
if($user_info[0]->boxed_wrapper=='boxed_layout_hrsale') {
	$boxed_wrapper = 'layout-boxed';
} else {
	$boxed_wrapper = '';
}
if($user_info[0]->compact_sidebar=='sidebar_layout_hrsale') {
	$compact_sidebar = 'sidebar-collapse';
} else {
	$compact_sidebar = '';
}
/*
if($this->router->fetch_class() =='chat'){
	$chat_app = 'chat-application';
} else {
	$chat_app = '';
}*/
?>
<?php $this->load->view('admin/components/htmlheader');?>
<body class="hrsale-layout hold-transition skin-yellow-light sidebar-mini <?php echo $fixed_header;?> <?php echo $boxed_wrapper;?> <?php echo $compact_sidebar;?>">
<div class="wrapper">

  <?php $this->load->view('admin/components/header');?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <!-- Links -->
    <?php $this->load->view('admin/components/left_menu');?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php if($this->router->fetch_class() !='dashboard' && $this->router->fetch_class() !='chat' && $this->router->fetch_class() !='calendar' && $this->router->fetch_class() !='profile'){?>
    <section class="content-header">
      <h1>
        <?php echo $breadcrumbs;?>
        <!--<small><?php echo $breadcrumbs;?></small>-->
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url('admin/dashboard/');?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('xin_e_details_home');?></a></li>
        <li class="active"><?php echo $breadcrumbs;?></li>
      </ol>
    </section>
    <?php } ?>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      
      <!-- /.row -->
      <!-- Main row -->
      <?php // get the required layout..?>
	   <?php echo $subview;?>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php $this->load->view('admin/components/footer');?>
 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- Layout footer -->
<?php $this->load->view('admin/components/htmlfooter');?>
<!-- / Layout footer -->
          
</body>
</html>