<?php
$session = $this->session->userdata('client_username');
$system = $this->Xin_model->read_setting_info(1);
$company_info = $this->Xin_model->read_company_setting_info(1);
$clientinfo = $this->Clients_model->read_client_info($session['client_id']);
$theme = $this->Xin_model->read_theme_info(1);
?>
<?php $site_lang = $this->load->helper('language');?>
<?php $wz_lang = $site_lang->session->userdata('site_lang');?>
<?php
if(empty($wz_lang)):
	$flg_icn = '<img src="'.base_url().'uploads/languages_flag/gb.gif">';
elseif($wz_lang == 'english'):
	$lang_code = $this->Xin_model->get_language_info($wz_lang);
	$flg_icn = $lang_code[0]->language_flag;
	$flg_icn = '<img src="'.base_url().'uploads/languages_flag/'.$flg_icn.'">';
else:
	$lang_code = $this->Xin_model->get_language_info($wz_lang);
	$flg_icn = $lang_code[0]->language_flag;
	$flg_icn = '<img src="'.base_url().'uploads/languages_flag/'.$flg_icn.'">';
endif;
?>
<?php //echo $system[0]->application_name;?>
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url('client/dashboard/');?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>HR</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><?php echo $system[0]->application_name;?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          	<?php if($system[0]->module_language=='true'){?>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="true">
                  <?php echo $flg_icn;?>
                </a>
                <ul class="dropdown-menu">
                <?php $languages = $this->Xin_model->all_languages();?>
				<?php foreach($languages as $lang):?>
                <?php $flag = '<img src="'.base_url().'uploads/languages_flag/'.$lang->language_flag.'">';?>
                  <li role="presentation">
                  <a role="menuitem" tabindex="-1" href="<?php echo site_url('client/dashboard/set_language/').$lang->language_code;?>"><?php echo $flag;?> &nbsp; <?php echo $lang->language_name;?></a></li>
                  <?php endforeach;?>
                </ul>
              </li>
            <?php } ?>             
          <li class="dropdown user user-menu">
			<?php  if($clientinfo[0]->client_profile!='' && $clientinfo[0]->client_profile!='no file') {?>
            	<?php $cpimg = base_url().'uploads/clients/'.$clientinfo[0]->client_profile;?>
            	<?php $cimg = '<img src="'.$cpimg.'" alt="" id="user_avatar" 
            class="img-circle rounded-circle user_profile_avatar">';?>
            <?php } else {?>
            <?php  if($clientinfo[0]->gender=='Male') { ?>
            <?php 	$de_file = base_url().'uploads/clients/default_male.jpg';?>
            <?php } else { ?>
            <?php 	$de_file = base_url().'uploads/clients/default_female.jpg';?>
            <?php } ?>
            	<?php $cpimg = $de_file;?>
            	<?php $cimg = '<img src="'.$de_file.'" alt="" id="user_avatar" class="img-circle rounded-circle user_profile_avatar">';?>
            <?php  } ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $cpimg;?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $clientinfo[0]->name;?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php echo $cimg;?>
                <p>
                  <?php echo $clientinfo[0]->name;?>
                  <small><?php echo $this->lang->line('xin_emp_member_since');?> <?php echo date('M. Y',strtotime($clientinfo[0]->created_at));?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-12 text-center">
                    <a href="<?php echo site_url('client/profile?change_password=true')?>"><?php echo $this->lang->line('header_change_password');?></a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo site_url('client/profile');?>" class="btn btn-default btn-flat"><?php echo $this->lang->line('header_my_profile');?></a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo site_url('client/logout');?>" class="btn btn-default btn-flat text-red"><?php echo $this->lang->line('header_sign_out');?></a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>