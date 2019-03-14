<?php $session = $this->session->userdata('client_username'); ?>
<?php $clientinfo = $this->Clients_model->read_client_info($session['client_id']); ?>
<?php  if($clientinfo[0]->client_profile!='' && $clientinfo[0]->client_profile!='no file') {?>
<?php $client_img = '<img src="'.base_url()."uploads/clients/".$clientinfo[0]->client_profile.'" alt="" id="user_avatar" 
    class="img-circle rounded-circle user_profile_avatar">'; ?>
<?php } else {?>
<?php  if($clientinfo[0]->gender=='Male') { ?>
<?php 	$de_file = base_url().'uploads/clients/default_male.jpg';?>
<?php } else { ?>
<?php 	$de_file = base_url().'uploads/clients/default_female.jpg';?>
<?php } ?>
<?php $client_img = '<img src="'.$de_file.'" alt="" id="user_avatar" class="img-circle rounded-circle user_profile_avatar">';?>
<?php  } ?>

<div class="box-widget widget-user-2">
  <div class="widget-user-header">
    <div class="widget-user-image"> <?php echo $client_img; ?> </div>
    <h4 class="widget-user-username welcome-hrsale-user">Welcome back, <?php echo $clientinfo[0]->name;?>!</h4>
    <h5 class="widget-user-desc welcome-hrsale-user-text">Today is <?php echo date('l, j F Y');?></h5>
  </div>
</div>
<hr class="container-m--x mt-0 mb-4">
<div class="row"> 
  <!-- Left col -->
  <div class="col-md-12"> 
    <!-- TABLE: LATEST ORDERS -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $this->lang->line('dashboard_my_projects');?></h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
          <table class="table no-margin">
            <thead>
              <tr>
                <th><?php echo $this->lang->line('xin_project_summary');?></th>
                <th><?php echo $this->lang->line('xin_p_priority');?></th>
                <th><?php echo $this->lang->line('xin_p_enddate');?></th>
                <th><?php echo $this->lang->line('dashboard_xin_progress');?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($this->Xin_model->last_five_client_projects($session['client_id']) as $_project) {?>
              <?php
                    if($_project->priority == 1) {
                    	$priority = '<span class="badge badge-danger">'.$this->lang->line('xin_highest').'</span>';
                    } else if($_project->priority ==2){
                    	$priority = '<span class="badge badge-danger">'.$this->lang->line('xin_high').'</span>';
                    } else if($_project->priority ==3){
                    	$priority = '<span class="badge badge-primary">'.$this->lang->line('xin_normal').'</span>';
                    } else {
                    	$priority = '<span class="badge badge-success">'.$this->lang->line('xin_low').'</span>';
                    }
                    	$pdate = '<i class="far fa-calendar-alt position-left"></i> '.$this->Xin_model->set_date_format($_project->end_date);
					//project_progress
					if($_project->project_progress <= 20) {
						$progress_class = 'progress-danger';
					} else if($_project->project_progress > 20 && $_project->project_progress <= 50){
						$progress_class = 'progress-warning';
					} else if($_project->project_progress > 50 && $_project->project_progress <= 75){
						$progress_class = 'progress-info';
					} else {
						$progress_class = 'progress-success';
					}
					// progress
				$pbar = '<p class="m-b-0-5">'.$this->lang->line('xin_completed').' <span class="pull-xs-right">'.$_project->project_progress.'%</span></p><progress class="progress '.$progress_class.' progress-sm" value="'.$_project->project_progress.'" max="100">'.$_project->project_progress.'%</progress>';
                    ?>
              <tr>
                <td><a href="<?php echo site_url().'client/projects/detail/'.$_project->project_id;?>"><?php echo $_project->title.'<br>'.'<div class="text-muted">'.$_project->summary.'</div>';?></a></td>
                <td><?php echo $priority;?></td>
                <td><?php echo $pdate;?></td>
                <td><?php echo $pbar;?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.table-responsive --> 
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix"> <a href="<?php echo site_url('client/projects/');?>" class="btn btn-sm btn-info btn-flat pull-left"><?php echo $this->lang->line('xin_role_view');?></a> </div>
      <!-- /.box-footer --> 
    </div>
    <!-- /.box --> 
  </div>
  <!-- /.col --> 
</div>
<hr class="container-m--x mt-0 mb-4">
<div class="row"> 
  <!-- Left col -->
  <div class="col-md-12"> 
    <!-- TABLE: LATEST ORDERS -->
    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo $this->lang->line('xin_list_all');?> <?php echo $this->lang->line('xin_invoices_title');?></h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="table-responsive">
          <table class="table no-margin">
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
            <tbody>
              <?php $client = $this->Invoices_model->get_invoices();?>
              <?php foreach($client->result() as $r) {?>
              <?php
                   // get country
                     $grand_total = $this->Xin_model->currency_sign($r->grand_total);
                      // get project
                      $project = $this->Project_model->read_project_information($r->project_id); 
                      if(!is_null($project)){
                        $project_name = $project[0]->title;
                        if($project[0]->client_id==$session['client_id']) {
                     
                      $invoice_date = '<i class="far fa-calendar-alt position-left"></i> '.$this->Xin_model->set_date_format($r->invoice_date);
                      $invoice_due_date = '<i class="far fa-calendar-alt position-left"></i> '.$this->Xin_model->set_date_format($r->invoice_due_date);
                      //invoice_number
                      $invoice_number = '<a href="'.site_url().'client/invoices/view/'.$r->invoice_id.'/">'.$r->invoice_number.'</a>';
                      ?>
              <tr>
                <td><?php echo '<span data-toggle="tooltip" data-placement="top" title="'.$this->lang->line('xin_view').'"><a href="'.site_url().'client/invoices/view/'.$r->invoice_id.'/"><button type="button" class="btn icon-btn btn-xs btn-outline-info waves-effect waves-light""><span class="fa fa-arrow-circle-right"></span></button></a></span>';?></td>
                <td><?php echo $r->invoice_id;?></td>
                <td><?php echo $invoice_number;?></td>
                <td><?php echo $project_name;?></td>
                <td><?php echo $grand_total;?></td>
                <td><?php echo $invoice_date;?></td>
                <td><?php echo $invoice_due_date;?></td>
                <td><?php echo $this->lang->line('xin_payment_paid');?></td>
              </tr>
              <?php } ?>
              <?php } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <!-- /.table-responsive --> 
      </div>
      <!-- /.box-body -->
      <div class="box-footer clearfix"> <a href="<?php echo site_url('client/invoices/');?>" class="btn btn-sm btn-info btn-flat pull-left"><?php echo $this->lang->line('xin_invoices_all');?></a> </div>
      <!-- /.box-footer --> 
    </div>
    <!-- /.box --> 
  </div>
  <!-- /.col --> 
</div>
