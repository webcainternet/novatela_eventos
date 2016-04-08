<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">

				<?php if($config->get("mod_rastreio_msg_email")) {
					$ptbr = false;
					//$rastreio = $order['rastreio'];

					if(defined('JPATH_MIJOSHOP_OC'))
					{
						$_lang = JFactory::getLanguage();
						$ptbr = stristr($_lang->getTag(), 'pt-br');
					}
					else
					{
						$ptbr = stristr($config->get('config_admin_language'), 'pt-br');
					}

					if($ptbr)
					{
						$save_tracking = 'Salvar Rastreamento';
						$generate_labels = 'Gerar Etiquetas';
						$tracking_code = 'Código de Rastreio';
						$zip_code = 'CEP';
						$separated = 'Código de Rastreio';
					}
					else
					{
						$save_tracking = 'Save Tracking';
						$generate_labels = 'Generate Labels';
						$tracking_code = 'Tracking code';
						$zip_code = 'Zip Code';
						$separated = 'Código de Rastreio';
					}
					
					$url_tracking = $url->link('sale/order', 'token=' . $session->data['token'], 'SSL');
				?>
				
				<button id="button-generate-labels" onclick="get_etiquetas()" data-toggle="tooltip" title="<?php echo $generate_labels; ?>" class="btn btn-success"><i class="glyphicon glyphicon-send"></i><i class="glyphicon glyphicon-envelope"></i></button>
				<button onclick="$('#form-order').removeAttr('target').attr('action', '').submit();" data-toggle="tooltip" title="<?php echo $save_tracking; ?>" class="btn btn-success"><i class="glyphicon glyphicon-barcode"></i></button>
				<?php }?>
			
        <button type="submit" id="button-shipping" form="form-order" formaction="<?php echo $shipping; ?>" data-toggle="tooltip" title="<?php echo $button_shipping_print; ?>" class="btn btn-info"><i class="fa fa-truck"></i></button>
        <button type="submit" id="button-invoice" form="form-order" formaction="<?php echo $invoice; ?>" data-toggle="tooltip" title="<?php echo $button_invoice_print; ?>" class="btn btn-info"><i class="fa fa-print"></i></button>
        <a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-order-id"><?php echo $entry_order_id; ?></label>
                <input type="text" name="filter_order_id" value="<?php echo $filter_order_id; ?>" placeholder="<?php echo $entry_order_id; ?>" id="input-order-id" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-customer"><?php echo $entry_customer; ?></label>
                <input type="text" name="filter_customer" value="<?php echo $filter_customer; ?>" placeholder="<?php echo $entry_customer; ?>" id="input-customer" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-order-status"><?php echo $entry_order_status; ?></label>
                <select name="filter_order_status" id="input-order-status" class="form-control">
                  <option value="*"></option>
                  <?php if ($filter_order_status == '0') { ?>
                  <option value="0" selected="selected"><?php echo $text_missing; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_missing; ?></option>
                  <?php } ?>
                  <?php foreach ($order_statuses as $order_status) { ?>
                  <?php if ($order_status['order_status_id'] == $filter_order_status) { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-total"><?php echo $entry_total; ?></label>
                <input type="text" name="filter_total" value="<?php echo $filter_total; ?>" placeholder="<?php echo $entry_total; ?>" id="input-total" class="form-control" />
              </div>
            </div>

			<div class="col-sm-4">
				<div class="form-group">
                <label class="control-label" for="input-product"><?php echo $entry_product_filter; ?></label>
                <input type="text" name="filter_product" value="" placeholder="<?php echo $filter_product; ?>" id="input-product" class="form-control" />
              </div>
            </div>
			
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-date-added"><?php echo $entry_date_added; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_date_added" value="<?php echo $filter_date_added; ?>" placeholder="<?php echo $entry_date_added; ?>" data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>
              <div class="form-group">
                <label class="control-label" for="input-date-modified"><?php echo $entry_date_modified; ?></label>
                <div class="input-group date">
                  <input type="text" name="filter_date_modified" value="<?php echo $filter_date_modified; ?>" placeholder="<?php echo $entry_date_modified; ?>" data-date-format="YYYY-MM-DD" id="input-date-modified" class="form-control" />
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                  </span></div>
              </div>
              <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
            </div>
          </div>
        </div>
        <form method="post" enctype="multipart/form-data" target="_blank" id="form-order">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked).trigger('change');" /></td>
                  <td class="text-right"><?php if ($sort == 'o.order_id') { ?>
                    <a href="<?php echo $sort_order; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_order_id; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_order; ?>"><?php echo $column_order_id; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'customer') { ?>
                    <a href="<?php echo $sort_customer; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_customer; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_customer; ?>"><?php echo $column_customer; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'status') { ?>
                    <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                    <?php } ?></td>

				<?php if($config->get("mod_rastreio_msg_email")) { ?>
				<td class="text-left">Rastreamento</td>
				<?php } ?>
			
                  <td class="text-right"><?php if ($sort == 'o.total') { ?>
                    <a href="<?php echo $sort_total; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_total; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_total; ?>"><?php echo $column_total; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'o.date_added') { ?>
                    <a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php if ($sort == 'o.date_modified') { ?>
                    <a href="<?php echo $sort_date_modified; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_modified; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_date_modified; ?>"><?php echo $column_date_modified; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($orders) { ?>
                <?php foreach ($orders as $order) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($order['order_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $order['order_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $order['order_id']; ?>" />
                    <?php } ?>
                    <input type="hidden" name="shipping_code[]" value="<?php echo $order['shipping_code']; ?>" /></td>
                  <td class="text-right"><?php echo $order['order_id']; ?></td>
                  <td class="text-left"><?php echo $order['customer']; ?></td>
                  <td class="text-left"><?php echo $order['status']; ?></td>

				<?php
				$shipping_select = $config->get("mod_rastreio_shipping_select") ? $config->get("mod_rastreio_shipping_select") : '-1';
				$shipping_postcode = preg_replace('@\D@','', $order['shipping_postcode']);
				$shipping_postcode = preg_replace('#^(\d{5})(\d{3})$#i', '$1-$2', $shipping_postcode);
				$shipping_code = explode('.', $order['shipping_code']);
				$diff_date_text = '';
				if(strstr($order['rastreio'], "{"))
				{
					$order['rastreio'] = @unserialize($order['rastreio']);
					if($order['rastreio'])
					{
						$diff_date_text = count_time_posted($order['rastreio']);
						
						$rastreios = array();
						foreach($order['rastreio'] as $codigo => $rastreio)
						{
							$rastreios[] = $codigo;
						}
						
						$order['rastreio'] = implode(",", $rastreios);
					}
					else
					{
						$order['rastreio'] = '';
					}
				}
				?>
				<?php if($config->get("mod_rastreio_msg_email")) { ?>
				<?php if($shipping_select == '-1' || $shipping_select == $shipping_code[0]){ ?>
					<?php if(empty($order['rastreio'])){ ?>
					  <?php if($config->get('mod_rastreio_show_cep')){ ?>
						<?php echo $zip_code; ?>: <?php echo $shipping_postcode; ?>
					  <?php } ?>
					  <td class="text-left">
						<input type="text" value="<?php echo $order['rastreio']; ?>" name="rastreio[<?php echo $order['order_id']; ?>]" size="15" style="text-align: right;" placeholder="<?php echo $separated; ?>" class="form-control" />
						<?php if($config->get("mod_rastreio_show_count_time")){ ?>
						<br />
						<?php echo $diff_date_text; ?>
						<?php } ?>
					  </td>
					<?php }elseif(!$config->get('mod_rastreio_hidden_code') && $order['order_status_id'] != $config->get("mod_rastreio_order_status_final")){ ?>
					  <?php if($config->get('mod_rastreio_show_cep')){ ?>
						<?php echo $zip_code; ?>: <?php echo $shipping_postcode; ?>
					  <?php } ?>
					  <td class="text-left">
						<input type="text" value="<?php echo $order['rastreio']; ?>" name="rastreio[<?php echo $order['order_id']; ?>]" size="15" style="text-align: right;" placeholder="<?php echo $separated; ?>" class="form-control" />
						<?php if($config->get("mod_rastreio_show_count_time")){ ?>
						<br />
							<?php echo $diff_date_text; ?>
						<?php } ?>
						</td>
					<?php }else{ ?>
					  <td class="text-left"></td>
					<?php } ?>
				<?php } ?>
				<?php } ?>
			
                  <td class="text-right"><?php echo $order['total']; ?></td>
                  <td class="text-left"><?php echo $order['date_added']; ?></td>
                  <td class="text-left"><?php echo $order['date_modified']; ?></td>
                  <td class="text-right"><a href="<?php echo $order['view']; ?>" data-toggle="tooltip" title="<?php echo $button_view; ?>" class="btn btn-info"><i class="fa fa-eye"></i></a> <a href="<?php echo $order['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a> <a href="<?php echo $order['delete']; ?>" id="button-delete<?php echo $order['order_id']; ?>" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$('#button-filter').on('click', function() {
	url = 'index.php?route=sale/order&token=<?php echo $token; ?>';
	
	var filter_order_id = $('input[name=\'filter_order_id\']').val();
	
	if (filter_order_id) {
		url += '&filter_order_id=' + encodeURIComponent(filter_order_id);
	}
	

				var filter_product = $('input[name=\'filter_product\']').val();
				if (filter_product) {
					url += '&filter_product=' + encodeURIComponent(filter_product);
				}
			
	var filter_customer = $('input[name=\'filter_customer\']').val();
	
	if (filter_customer) {
		url += '&filter_customer=' + encodeURIComponent(filter_customer);
	}
	
	var filter_order_status = $('select[name=\'filter_order_status\']').val();
	
	if (filter_order_status != '*') {
		url += '&filter_order_status=' + encodeURIComponent(filter_order_status);
	}	

	var filter_total = $('input[name=\'filter_total\']').val();

	if (filter_total) {
		url += '&filter_total=' + encodeURIComponent(filter_total);
	}	
	
	var filter_date_added = $('input[name=\'filter_date_added\']').val();
	
	if (filter_date_added) {
		url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
	}
	
	var filter_date_modified = $('input[name=\'filter_date_modified\']').val();
	
	if (filter_date_modified) {
		url += '&filter_date_modified=' + encodeURIComponent(filter_date_modified);
	}
				
	location = url;
});
//--></script> 
  <script type="text/javascript"><!--

			$('input[name=\'filter_product\']').autocomplete({
			'source': function(request, response) {
				$.ajax({
					url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_product=' +  encodeURIComponent(request),
					dataType: 'json',			
					success: function(json) {
						response($.map(json, function(item) {
							return {
								label: item['name'],
								value: item['product_id']
							}
						}));
					}
				});
			},
			'select': function(item) {
				$('input[name=\'filter_product\']').val(item['label']);
			}	
			});
			
$('input[name=\'filter_customer\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
			dataType: 'json',			
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['customer_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_customer\']').val(item['label']);
	}	
});
//--></script> 
  <script type="text/javascript"><!--
$('input[name^=\'selected\']').on('change', function() {
	$('#button-shipping, #button-invoice, #button-generate-labels').prop('disabled', true);
	
	var selected = $('input[name^=\'selected\']:checked');
	
	if (selected.length) {
		$('#button-invoice').prop('disabled', false);
$('#button-generate-labels').prop('disabled', false);
	}
	
	for (i = 0; i < selected.length; i++) {
		if ($(selected[i]).parent().find('input[name^=\'shipping_code\']').val()) {
			$('#button-shipping').prop('disabled', false);
			
			break;
		}
	}
});

$('input[name^=\'selected\']:first').trigger('change');

$('a[id^=\'button-delete\']').on('click', function(e) {
	e.preventDefault();
	
	if (confirm('<?php echo $text_confirm; ?>')) {
		location = $(this).attr('href');
	}
});
//--></script> 
  <script src="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
  <link href="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
  <script type="text/javascript"><!--
$('.date').datetimepicker({
	pickTime: false
});
//--></script></div>

			<?php if($config->get("mod_rastreio_msg_email")) { ?>
			<style>
			#modal-generate-labels .modal-dialog
			{
				width: 700px;
			}
			</style>
			<script type="text/javascript"><!--
			$("body").append('<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal-generate-labels"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h4 class="modal-title"><?php echo $generate_labels; ?></h4></div><div class="modal-body"></div><div class="modal-footer"></div></div></div></div>');
			function get_etiquetas()
			{
				//selecteds = $("input[name='selected[]']").prop("checked");
				var selecteds = $("input[name='selected[]']:checked");
				if(selecteds.length)
				{
					//generate_labels
					selecteds = selecteds.serialize();
					var url = 'index.php?route=sale/order/generate_labels&token=<?php echo $token; ?>&'+selecteds;
					$(".modal-body").load(url, function()
					{
						$(".modal-footer").html('<center><button class="btn btn-primary" onclick="$(\'.modal-body\').print();">print</button></center>');
						$('#modal-generate-labels').modal("show");
					});
					
					
					//$.colorbox({href: 'index.php?route=sale/order/generate_labels&token=<?php echo $token; ?>&'+selecteds, overlayClose: false, iframe: true, width: "750", height: "100%"});
				}
			}
			//--></script> 
			<?php } ?>
			
<?php echo $footer; ?>