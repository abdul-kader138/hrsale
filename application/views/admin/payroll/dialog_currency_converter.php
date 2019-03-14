<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && isset($_GET['currency_converter_id']) && $_GET['data']=='converter_data'){
?>

<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data"><?php echo $this->lang->line('xin_payroll_edit_currency_converter');?></h4>
</div>
<?php $attributes = array('name' => 'update_currency_converter', 'id' => 'update_currency_converter', 'autocomplete' => 'off', 'class'=>'m-b-1');?>
<?php $hidden = array('_method' => 'EDIT', '_token' => $currency_converter_id);?>
<?php echo form_open('admin/payroll/update_currency_converter_data/'.$currency_converter_id, $attributes, $hidden);?>
<div class="modal-body">
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="usd_currency"><?php echo $this->lang->line('xin_payroll_from_usd_currency');?></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('xin_payroll_from_usd_currency');?>" name="usd_currency" type="text" value="1" readonly="readonly">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="to_currency_title"><?php echo $this->lang->line('xin_payroll_to_currency_title');?></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('xin_payroll_to_currency_title');?>" name="to_currency_title" type="text" value="<?php echo $to_currency_title;?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="to_currency_rate"><?php echo $this->lang->line('xin_payroll_to_currency_rate');?></label>
        <input class="form-control" placeholder="<?php echo $this->lang->line('xin_payroll_to_currency_rate');?>" name="to_currency_rate" type="text" value="<?php echo $to_currency_rate;?>">
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
		$("#update_currency_converter").submit(function(e){
		e.preventDefault();
			var obj = $(this), action = obj.attr('name');
			$('.save').prop('disabled', true);
			
			$.ajax({
				type: "POST",
				url: e.target.action,
				data: obj.serialize()+"&is_ajax=1&edit_type=currency_data&form="+action,
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
								url : "<?php echo site_url("admin/payroll/currency_converter_list") ?>",
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
  </script>
<?php }
?>
