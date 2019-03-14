<?php
/* Invoice view
*/
?>
<?php $session = $this->session->userdata('username');?>
<?php $system_setting = $this->Xin_model->read_setting_info(1);?>
<?php
// get project
	$project = $this->Project_model->read_project_information($project_id);
	$result2 = $this->Clients_model->read_client_info($project[0]->client_id);
	if(!is_null($result2)) {
		$client_name = $result2[0]->name;
		$client_contact_number = $result2[0]->contact_number;
		$client_company_name = $result2[0]->company_name;
		$client_website_url = $result2[0]->website_url;
		$client_address_1 = $result2[0]->address_1;
		$client_address_2 = $result2[0]->address_2;
		$client_country = $result2[0]->country;
		$client_city = $result2[0]->city;
		$client_zipcode = $result2[0]->zipcode;
	} else {
		$client_name = '--';
	}
?>
<?php $get_animate = $this->Xin_model->get_content_animate();?>
<div class="invoice  <?php echo $get_animate;?>" style="margin:10px 10px;">
  <div id="print_invoice_hr"> 
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header"> <i class="fa fa-globe"></i> <?php echo $company_name;?> <small class="pull-right">Date: <?php echo date('d-m-Y');?></small> </h2>
      </div>
      <!-- /.col --> 
    </div>
    
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col"> From
        <address>
        <strong><?php echo $company_name;?></strong><br>
        <?php echo $company_address;?><br>
        <?php echo $company_zipcode;?>, <?php echo $company_city;?><br>
        <?php echo $company_country;?><br />
        Phone: <?php echo $company_phone;?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col"> To
        <address>
        <strong><?php echo $client_name;?></strong><br>
        <?php echo $client_company_name;?><br>
        <?php echo $client_address_1.' '.$client_address_2.' '.$client_city;?><br>
        Phone: <?php echo $client_contact_number;?><br>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col"> <b>Invoice #<?php echo $invoice_number;?></b><br>
        <br>
        <b>Date:</b> <?php echo $this->Xin_model->set_date_format($invoice_date);?><br>
        <b>Payment Due:</b> <?php echo $this->Xin_model->set_date_format($invoice_due_date);?> </div>
      <!-- /.col --> 
    </div>
    <!-- /.row --> 
    
    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th class="py-3"> # </th>
              <th class="py-3"> Item </th>
              <th class="py-3"> Tax Rate </th>
              <th class="py-3"> Qty/Hrs </th>
              <th class="py-3"> Unit Price </th>
              <th class="py-3"> Subtotal </th>
            </tr>
          </thead>
          <tbody>
            <?php
				$ar_sc = explode('- ',$system_setting[0]->default_currency_symbol);
				$sc_show = $ar_sc[1];
				?>
            <?php $prod = array(); $i=1; foreach($this->Invoices_model->get_invoice_items($invoice_id) as $_item):?>
            <tr>
              <td class="py-3"><div class="font-weight-semibold"><?php echo $i;?></div></td>
              <td class="py-3" style="width:"><div class="font-weight-semibold"><?php echo $_item->item_name;?></div></td>
              <td class="py-3"><strong><?php echo $this->Xin_model->currency_sign($_item->item_tax_rate);?></strong></td>
              <td class="py-3"><strong><?php echo $_item->item_qty;?></strong></td>
              <td class="py-3"><strong><?php echo $this->Xin_model->currency_sign($_item->item_unit_price);?></strong></td>
              <td class="py-3"><strong><?php echo $this->Xin_model->currency_sign($_item->item_sub_total);?></strong></td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.row -->
    
    <div class="row"> 
      <!-- /.col -->
      <div class="col-xs-6">
        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;"> <?php echo $invoice_note;?> </p>
      </div>
      <div class="col-lg-6">
        <div class="table-responsive">
          <table class="table">
            <tbody>
              <tr>
                <th style="width:50%">Subtotal:</th>
                <td><?php echo $this->Xin_model->currency_sign($sub_total_amount);?></td>
              </tr>
              <tr>
                <th>TAX</th>
                <td><?php echo $this->Xin_model->currency_sign($total_tax);?></td>
              </tr>
              <tr>
                <th>Discount:</th>
                <td><?php echo $this->Xin_model->currency_sign($total_discount);?></td>
              </tr>
              <tr>
                <th>Total:</th>
                <td><?php echo $this->Xin_model->currency_sign($grand_total);?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.row --> 
  </div>
  <!-- this row will not appear when printing -->
  <div class="row no-print">
    <div class="col-xs-12">
      <button type="button" class="btn btn-primary pull-right print-invoice" style="margin-right: 5px;"> <i class="fa fa-download"></i> Print </button>
    </div>
  </div>
</div>
