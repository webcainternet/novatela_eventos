<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button type="submit" form="form-mod_rastreio" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
			</div>
			<h1><?php echo $heading_title; ?></h1>
			<ul class="breadcrumb">
				<?php foreach ($breadcrumbs as $breadcrumb) { ?>
				<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<div class="container-fluid">
		<?php if (isset($error_warning)) { ?>
		<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i>
		<?php echo $error_warning; ?>
		</div>
		<?php } ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h3>
			</div>
		</div>
		<div class="panel-body">
			<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-mod_rastreio" class="form-horizontal">
				<input type="hidden" name="edit" id="edit" value="0" />
				
				<div role="tabpanel">

					  <!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#tab-geral" aria-controls="tab-geral" role="tab" data-toggle="tab"><?php echo $text_tab_general; ?></a></li>
						<li role="presentation"><a href="#tab-etiqueta" aria-controls="tab-etiqueta" role="tab" data-toggle="tab"><?php echo $text_tab_etiqueta; ?></a></li>
						<li role="presentation"><a href="#tab-products" aria-controls="tab-products" role="tab" data-toggle="tab"><?php echo $text_tab_products; ?></a></li>
						<li role="presentation"><a href="#tab-simulate" aria-controls="tab-simulate" role="tab" data-toggle="tab"><?php echo $text_tab_simulate; ?></a></li>
						<li role="presentation"><a href="#tab-support" aria-controls="tab-support" role="tab" data-toggle="tab"><?php echo $text_tab_support; ?></a></li>
					</ul>

					  <!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="tab-geral">
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $text_url_cron; ?></label>
								<div class="col-sm-10">
									<?php echo $url_cron; ?>
								</div>
							</div>
							<div class="form-group">
								<label for="mod_rastreio_shipping_select" class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $text_only_shipping_select_help; ?>"><?php echo $text_only_shipping_select; ?></span></label>
								<div class="col-sm-10">
									<select name="mod_rastreio_shipping_select" class="form-control" id="mod_rastreio_shipping_select">
										<?php foreach($shippings as $name_shipping => $shipping) { ?>
											<?php if($mod_rastreio_shipping_select == $name_shipping) { ?>
												<option value="<?php echo $name_shipping; ?>" selected><?php echo $shipping; ?></option>
											<?php }else { ?>
												<option value="<?php echo $name_shipping; ?>"><?php echo $shipping; ?></option>
											<?php } ?>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="mod_rastreio_user_notify" class="col-sm-2 control-label"><?php echo $text_user_notify; ?></label>
								<div class="col-sm-10">
									<input type="checkbox" name="mod_rastreio_user_notify" class="form-control" id="mod_rastreio_user_notify" value="1" <?php echo ($mod_rastreio_user_notify ? 'checked' : ''); ?> />
								</div>
							</div>
							<div class="form-group">
								<label for="mod_rastreio_copy_email_admin" class="col-sm-2 control-label"><?php echo $text_mod_rastreio_copy_email_admin; ?></label>
								<div class="col-sm-10">
									<input type="checkbox" name="mod_rastreio_copy_email_admin" class="form-control" id="mod_rastreio_copy_email_admin" value="1" <?php echo ($mod_rastreio_copy_email_admin ? 'checked' : ''); ?> />
								</div>
							</div>
							<div class="form-group">
								<label for="mod_rastreio_show_count_time" class="col-sm-2 control-label"><?php echo $text_mod_rastreio_show_count_time; ?></label>
								<div class="col-sm-10">
									<input type="checkbox" name="mod_rastreio_show_count_time" class="form-control" id="mod_rastreio_show_count_time" value="1" <?php echo ($mod_rastreio_show_count_time ? 'checked' : ''); ?> />
								</div>
							</div>
							<div class="form-group">
								<label for="mod_rastreio_show_cep" class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $text_show_cep_help; ?>"><?php echo $text_show_cep; ?></span></label>
								<div class="col-sm-10">
									<input type="checkbox" name="mod_rastreio_show_cep" class="form-control" id="mod_rastreio_show_cep" value="1" <?php echo ($mod_rastreio_show_cep ? 'checked' : ''); ?> />
								</div>
							</div>
							<div class="form-group">
								<label for="mod_rastreio_include_status_history" class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $text_include_status_history_help; ?>"><?php echo $text_include_status_history; ?></span></label>
								<div class="col-sm-10">
									<input type="checkbox" name="mod_rastreio_include_status_history" class="form-control" id="mod_rastreio_include_status_history" value="1" <?php echo ($mod_rastreio_include_status_history ? 'checked' : ''); ?> />
								</div>
							</div>
							<div class="form-group">
								<label for="mod_rastreio_notify_start_end" class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $text_notify_start_end_help; ?>"><?php echo $text_notify_start_end; ?></span></label>
								<div class="col-sm-10">
									<input type="checkbox" name="mod_rastreio_notify_start_end" class="form-control" id="mod_rastreio_notify_start_end" value="1" <?php echo ($mod_rastreio_notify_start_end ? 'checked' : ''); ?> />
								</div>
							</div>
							<div class="form-group">
								<label for="mod_rastreio_order_status_posted" class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $text_order_status_post_help; ?>"><?php echo $text_order_status_post; ?></span></label>
								<div class="col-sm-10">
									<select name="mod_rastreio_order_status_posted" class="form-control" id="mod_rastreio_order_status_posted">
										<option value=""><?php echo $text_no_action; ?></option>
										<?php foreach ($order_statuses as $order_status) { ?>
											<?php if($order_status['order_status_id'] == $mod_rastreio_order_status_posted) { ?>
												<option value="<?php echo $order_status['order_status_id']; ?>" selected><?php echo $order_status["name"]; ?></option>
											<?php }else { ?>
												<option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status["name"]; ?></option>
											<?php } ?>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $text_order_status_post_help; ?>"><?php echo $text_set_status_notify_help; ?></span></label>
								<div class="col-sm-10">

									<table id="statusOrder" class="table table-bordered">
										<tbody>
											<tr>
												<td class="left"></td>
												<td class="left"><a onclick="addOrder_statuses();" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a></td>
											</tr>
											<thead>
												<tr>
													<td><?php echo $text_status; ?></td>
													<td><?php echo $text_action; ?></td>
												</tr>
											</thead>
											<?php $mod_rastreio_statuscount = 0; ?>
											<?php foreach ($mod_rastreio_order_statuses as $mod_rastreio_order_status) { ?>
											<tbody id="row<?php echo $mod_rastreio_statuscount; ?>">
												<tr>
													<td class="left">
													<select name="mod_rastreio_order_statuses[<?php echo $mod_rastreio_statuscount; ?>]">
														<?php foreach ($order_statuses as $order_status) { ?>
															<?php if($order_status['order_status_id'] == $mod_rastreio_order_status) { ?>
																<option value="<?php echo $order_status['order_status_id']; ?>" selected><?php echo $order_status["name"]; ?></option>
															<?php }else { ?>
																<option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status["name"]; ?></option>
															<?php } ?>
														<?php } ?>
													</select>
													</td>
													<td class="left"><a onclick="$('#row<?php echo $mod_rastreio_statuscount; ?>').remove();" class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a></td>
												</tr>
											</tbody>
											<?php $mod_rastreio_statuscount++; ?>
											<?php } ?>
										</tbody>
									</table>
								
								</div>
							</div>
							<div class="form-group">
								<label for="mod_rastreio_order_status_final" class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $text_order_status_final_help; ?>"><?php echo $text_order_status_final; ?></span></label>
								<div class="col-sm-10">
									<select name="mod_rastreio_order_status_final" class="form-control" id="mod_rastreio_order_status_final">
										<?php foreach ($order_statuses as $order_status) { ?>
											<?php if($order_status['order_status_id'] == $mod_rastreio_order_status_final) { ?>
												<option value="<?php echo $order_status['order_status_id']; ?>" selected><?php echo $order_status["name"]; ?></option>
											<?php }else { ?>
												<option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status["name"]; ?></option>
											<?php } ?>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="mod_rastreio_msg_email" class="col-sm-2 control-label">
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_registered_help; ?>"><?php echo $text_msg_email_registered; ?></span>
									<br />
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help1; ?>"><?php echo str_replace('ckInsert', 'ckInsert_registered', $text_msg_email1); ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help2; ?>"><?php echo str_replace('ckInsert', 'ckInsert_registered', $text_msg_email2); ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help3; ?>"><?php echo str_replace('ckInsert', 'ckInsert_registered', $text_msg_email3); ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help4; ?>"><?php echo str_replace('ckInsert', 'ckInsert_registered', $text_msg_email4); ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help12; ?>"><?php echo str_replace('ckInsert', 'ckInsert_registered', $text_msg_email12); ?></span>
								</label>
								<div class="col-sm-10">
									<?php if(defined('JPATH_MIJOSHOP_OC')) { ?>
									<?php echo MijoShop::get('base')->editor()->display("mod_rastreio_msg_email_registered", $mod_rastreio_msg_email_registered, '97% !important', '320', '50', '11'); ?>
									<?php }else{ ?>
										<textarea name="mod_rastreio_msg_email_registered" cols="40" rows="5" id="mod_rastreio_msg_email_registered"><?php echo $mod_rastreio_msg_email_registered; ?></textarea>
									<?php } ?>
								</div>
							</div>
							<div class="form-group">
								<label for="mod_rastreio_msg_email" class="col-sm-2 control-label">
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help; ?>"><?php echo $text_msg_email; ?></span>
									<br />
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help1; ?>"><?php echo $text_msg_email1; ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help2; ?>"><?php echo $text_msg_email2; ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help3; ?>"><?php echo $text_msg_email3; ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help4; ?>"><?php echo $text_msg_email4; ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help12; ?>"><?php echo $text_msg_email12; ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help5; ?>"><?php echo $text_msg_email5; ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help6; ?>"><?php echo $text_msg_email6; ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help7; ?>"><?php echo $text_msg_email7; ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help8; ?>"><?php echo $text_msg_email8; ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help9; ?>"><?php echo $text_msg_email9; ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help10; ?>"><?php echo $text_msg_email10; ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help11; ?>"><?php echo $text_msg_email11; ?></span>
								</label>
								<div class="col-sm-10">
									<?php if(defined('JPATH_MIJOSHOP_OC')) { ?>
									<?php echo MijoShop::get('base')->editor()->display("mod_rastreio_msg_email", $mod_rastreio_msg_email, '97% !important', '320', '50', '11'); ?>
									<?php }else{ ?>
										<textarea name="mod_rastreio_msg_email" cols="40" rows="5" id="mod_rastreio_msg_email"><?php echo $mod_rastreio_msg_email; ?></textarea>
									<?php } ?>
								</div>
							</div>
							<div class="form-group">
								<label for="mod_rastreio_msg_email_final" class="col-sm-2 control-label">
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_final_help; ?>"><?php echo $text_msg_email_final; ?></span>
									<br />
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help1; ?>"><?php echo str_replace('ckInsert', 'ckInsert_final', $text_msg_email1); ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help2; ?>"><?php echo str_replace('ckInsert', 'ckInsert_final', $text_msg_email2); ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help3; ?>"><?php echo str_replace('ckInsert', 'ckInsert_final', $text_msg_email3); ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help4; ?>"><?php echo str_replace('ckInsert', 'ckInsert_final', $text_msg_email4); ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help12; ?>"><?php echo str_replace('ckInsert', 'ckInsert_final', $text_msg_email12); ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help5; ?>"><?php echo str_replace('ckInsert', 'ckInsert_final', $text_msg_email5); ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help6; ?>"><?php echo str_replace('ckInsert', 'ckInsert_final', $text_msg_email6); ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help7; ?>"><?php echo str_replace('ckInsert', 'ckInsert_final', $text_msg_email7); ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help8; ?>"><?php echo str_replace('ckInsert', 'ckInsert_final', $text_msg_email8); ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help9; ?>"><?php echo str_replace('ckInsert', 'ckInsert_final', $text_msg_email9); ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help10; ?>"><?php echo str_replace('ckInsert', 'ckInsert_final', $text_msg_email10); ?></span>
									<br />
									<span data-toggle="tooltip" title="<?php echo $text_msg_email_help11; ?>"><?php echo str_replace('ckInsert', 'ckInsert_final', $text_msg_email11); ?></span>
								</label>
								<div class="col-sm-10">
									<?php if(defined('JPATH_MIJOSHOP_OC')) { ?>
									<?php echo MijoShop::get('base')->editor()->display("mod_rastreio_msg_email_final", $mod_rastreio_msg_email_final, '97% !important', '320', '50', '11'); ?>
									<?php }else{ ?>
										<textarea name="mod_rastreio_msg_email_final" cols="40" rows="5" id="mod_rastreio_msg_email_final"><?php echo $mod_rastreio_msg_email_final; ?></textarea>
									<?php } ?>
								</div>
							</div>
						</div>
						
						<div role="tabpanel" class="tab-pane" id="tab-etiqueta">
							<div class="form-group">
								<label for="etiqueta_name" class="col-sm-2 control-label"><?php echo $text_etiqueta_name; ?></label>
								<div class="col-sm-10">
									<input type="text" name="mod_rastreio[etiqueta][name]" class="form-control" id="etiqueta_name" value="<?php echo $etiqueta_name; ?>" />
								</div>
							</div>
							<div class="form-group">
								<label for="etiqueta_company" class="col-sm-2 control-label"><?php echo $text_etiqueta_company; ?></label>
								<div class="col-sm-10">
									<input type="text" name="mod_rastreio[etiqueta][company]" class="form-control" id="etiqueta_company" value="<?php echo $etiqueta_company; ?>" />
								</div>
							</div>
							<div class="form-group">
								<label for="etiqueta_phone" class="col-sm-2 control-label"><?php echo $text_etiqueta_phone; ?></label>
								<div class="col-sm-10">
									<input type="text" name="mod_rastreio[etiqueta][phone]" class="form-control" id="etiqueta_phone" value="<?php echo $etiqueta_phone; ?>" />
								</div>
							</div>
							<div class="form-group">
								<label for="etiqueta_postcode" class="col-sm-2 control-label"><?php echo $text_etiqueta_cep; ?></label>
								<div class="col-sm-10">
									<input type="text" name="mod_rastreio[etiqueta][postcode]" class="form-control" id="etiqueta_postcode" value="<?php echo $etiqueta_postcode; ?>" />
								</div>
							</div>
							<div class="form-group">
								<label for="etiqueta_address" class="col-sm-2 control-label"><?php echo $text_etiqueta_address; ?></label>
								<div class="col-sm-10">
									<input type="text" name="mod_rastreio[etiqueta][address]" class="form-control" id="etiqueta_address" value="<?php echo $etiqueta_address; ?>" />
								</div>
							</div>
							<div class="form-group">
								<label for="etiqueta_number" class="col-sm-2 control-label"><?php echo $text_etiqueta_number; ?></label>
								<div class="col-sm-10">
									<input type="text" name="mod_rastreio[etiqueta][number]" class="form-control" id="etiqueta_number" value="<?php echo $etiqueta_number; ?>" />
								</div>
							</div>
							<div class="form-group">
								<label for="etiqueta_complement" class="col-sm-2 control-label"><?php echo $text_etiqueta_complement; ?></label>
								<div class="col-sm-10">
									<input type="text" name="mod_rastreio[etiqueta][complement]" class="form-control" id="etiqueta_complement" value="<?php echo $etiqueta_complement; ?>" />
								</div>
							</div>
							<div class="form-group">
								<label for="etiqueta_address2" class="col-sm-2 control-label"><?php echo $text_etiqueta_address2; ?></label>
								<div class="col-sm-10">
									<input type="text" name="mod_rastreio[etiqueta][address2]" class="form-control" id="etiqueta_address2" value="<?php echo $etiqueta_address2; ?>" />
								</div>
							</div>
							<div class="form-group">
								<label for="etiqueta_city" class="col-sm-2 control-label"><?php echo $text_etiqueta_city; ?></label>
								<div class="col-sm-10">
									<input type="text" name="mod_rastreio[etiqueta][city]" class="form-control" id="etiqueta_city" value="<?php echo $etiqueta_city; ?>" />
								</div>
							</div>
							<div class="form-group">
								<label for="etiqueta_state" class="col-sm-2 control-label"><?php echo $text_etiqueta_state; ?></label>
								<div class="col-sm-10">
									<select name="mod_rastreio[etiqueta][state]" class="form-control" id="etiqueta_state">
										<?php foreach($zones as $zone) { ?>
										<?php if($zone['code'] == $etiqueta_state) { ?>
											<option value="<?php echo $zone['code']; ?>" selected><?php echo $zone['name']; ?></option>
										<?php }else { ?>
											<option value="<?php echo $zone['code']; ?>"><?php echo $zone['name']; ?></option>
										<?php } ?>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $text_chancela_pac; ?></label>
								<div class="col-sm-10">
									<?php if(!empty($etiqueta_ch_pac)){ ?>
										<a href="" id="thumb-image-pac" data-toggle="image" class="img-thumbnail"><img src="<?php echo $etiqueta_ch_pac; ?>" alt="" title="" data-placeholder="" /></a>
									<?php }else{ ?>
										<a href="" id="thumb-image-pac" data-toggle="image" class="img-thumbnail"><img src="view/image/mod_rastreio/chancelas.jpg" alt="" title="" data-placeholder="" /></a>
									<?php } ?>
									<input name="mod_rastreio[etiqueta][ch_pac]" type="hidden" value="<?php echo $etiqueta_ch_pac; ?>" id="input-image-pac" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $text_chancela_sedex; ?></label>
								<div class="col-sm-10">
									<?php if(!empty($etiqueta_ch_sedex)){ ?>
										<a href="" id="thumb-image-sedex" data-toggle="image" class="img-thumbnail"><img src="<?php echo $etiqueta_ch_sedex; ?>" alt="" title="" data-placeholder="" /></a>
									<?php }else{ ?>
										<a href="" id="thumb-image-sedex" data-toggle="image" class="img-thumbnail"><img src="view/image/mod_rastreio/chancelas.jpg" alt="" title="" data-placeholder="" /></a>
									<?php } ?>
									<input name="mod_rastreio[etiqueta][ch_sedex]" type="hidden"value="<?php echo $etiqueta_ch_sedex; ?>" id="input-image-sedex"/>
								</div>
							</div>
						</div>
						
						<div role="tabpanel" class="tab-pane" id="tab-products">
							<fieldset>
								<legend><?php echo $text_latest; ?></legend>
								
								<div class="form-group">
									<label for="latest_product_limit" class="col-sm-2 control-label"><?php echo $entry_limit; ?></label>
									<div class="col-sm-10">
										<input type="text" name="mod_rastreio[products][latest_product][limit]" class="form-control" id="latest_product_limit" value="<?php echo $latest_product_limit; ?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="latest_product_width" class="col-sm-2 control-label"><?php echo $entry_width; ?></label>
									<div class="col-sm-10">
										<input type="text" name="mod_rastreio[products][latest_product][width]" class="form-control" id="latest_product_width" value="<?php echo $latest_product_width; ?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="latest_product_height" class="col-sm-2 control-label"><?php echo $entry_height; ?></label>
									<div class="col-sm-10">
										<input type="text" name="mod_rastreio[products][latest_product][height]" class="form-control" id="latest_product_height" value="<?php echo $latest_product_height; ?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="latest_product_status" class="col-sm-2 control-label"><?php echo $entry_status; ?></label>
									<div class="col-sm-10">
										<select name="mod_rastreio[products][latest_product][status]" class="form-control" id="latest_product_status">
										  <?php if ($latest_product_status) { ?>
										  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
										  <option value="0"><?php echo $text_disabled; ?></option>
										  <?php } else { ?>
										  <option value="1"><?php echo $text_enabled; ?></option>
										  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
										   <?php } ?>
										</select>
									</div>
								</div>
							</fieldset>

							<fieldset>
								<legend><?php echo $text_bestseller; ?></legend>

								<div class="form-group">
									<label for="bestseller_product_limit" class="col-sm-2 control-label"><?php echo $entry_limit; ?></label>
									<div class="col-sm-10">
										<input type="text" name="mod_rastreio[products][bestseller_product][limit]" class="form-control" id="bestseller_product_limit" value="<?php echo $bestseller_product_limit; ?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="bestseller_product_width" class="col-sm-2 control-label"><?php echo $entry_width; ?></label>
									<div class="col-sm-10">
										<input type="text" name="mod_rastreio[products][bestseller_product][width]" class="form-control" id="bestseller_product_width" value="<?php echo $bestseller_product_width; ?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="bestseller_product_height" class="col-sm-2 control-label"><?php echo $entry_height; ?></label>
									<div class="col-sm-10">
										<input type="text" name="mod_rastreio[products][bestseller_product][height]" class="form-control" id="bestseller_product_height" value="<?php echo $bestseller_product_height; ?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="bestseller_product_status" class="col-sm-2 control-label"><?php echo $entry_status; ?></label>
									<div class="col-sm-10">
										<select name="mod_rastreio[products][bestseller_product][status]" class="form-control" id="bestseller_product_status">
										  <?php if ($bestseller_product_status) { ?>
										  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
										  <option value="0"><?php echo $text_disabled; ?></option>
										  <?php } else { ?>
										  <option value="1"><?php echo $text_enabled; ?></option>
										  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
										   <?php } ?>
										</select>
									</div>
								</div>
							</fieldset>
							
							<fieldset>
								<legend><?php echo $text_featured_product; ?></legend>

								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-product"><?php echo $text_tab_products; ?></label>
									<div class="col-sm-10">
										<input type="text" name="product" value="" placeholder="" id="input-product" class="form-control" />
										<div id="featured-product" class="well well-sm" style="height: 150px; overflow: auto;">
											<?php foreach ($featured_products as $product) { ?>
											<div id="featured-product<?php echo $product['product_id']; ?>"><i class="fa fa-minus-circle"></i> <?php echo $product['name']; ?>
												<input type="hidden" name="product[]" value="<?php echo $product['product_id']; ?>" />
											</div>
											<?php } ?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="featured_product_limit" class="col-sm-2 control-label"><?php echo $entry_limit; ?></label>
									<div class="col-sm-10">
										<input type="text" name="mod_rastreio[products][featured_product][limit]" class="form-control" id="featured_product_limit" value="<?php echo $featured_product_limit; ?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="featured_product_width" class="col-sm-2 control-label"><?php echo $entry_width; ?></label>
									<div class="col-sm-10">
										<input type="text" name="mod_rastreio[products][featured_product][width]" class="form-control" id="featured_product_width" value="<?php echo $featured_product_width; ?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="featured_product_height" class="col-sm-2 control-label"><?php echo $entry_height; ?></label>
									<div class="col-sm-10">
										<input type="text" name="mod_rastreio[products][featured_product][height]" class="form-control" id="featured_product_height" value="<?php echo $featured_product_height; ?>" />
									</div>
								</div>
								<div class="form-group">
									<label for="featured_product_status" class="col-sm-2 control-label"><?php echo $entry_status; ?></label>
									<div class="col-sm-10">
										<select name="mod_rastreio[products][featured_product][status]" class="form-control" id="featured_product_status">
										  <?php if ($featured_product_status) { ?>
										  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
										  <option value="0"><?php echo $text_disabled; ?></option>
										  <?php } else { ?>
										  <option value="1"><?php echo $text_enabled; ?></option>
										  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
										   <?php } ?>
										</select>
									</div>
								</div>
							</fieldset>
						</div>
						<div role="tabpanel" class="tab-pane" id="tab-simulate">
							<div class="form-group" id="simule">
								<label for="mod_rastreio_user_notify" class="col-sm-2 control-label"><?php echo $entry_code_simulate; ?></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="simulate_codigo" value="" />
									<a href="javascript:;" id="simulate_button" class="btn btn-primary"><?php echo $text_tab_simulate; ?></a>
								</div>
							</div>
							<div id="result_simulate"></div>
						</div>
						
						<div role="tabpanel" class="tab-pane" id="tab-support">
							<div class="col-md-4">
								<?php echo $text_support; ?>
							</div>
							<div class="col-md-8">
								<iframe width="560" height="315" src="https://www.youtube.com/embed/IWEQ_pCHlqQ" frameborder="0" allowfullscreen></iframe>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>		
	</div>

</div>
<?php if(!defined('JPATH_MIJOSHOP_OC')) { ?>
<script type="text/javascript"><!--
$('#mod_rastreio_msg_email_registered').summernote({height: 300});
$('#mod_rastreio_msg_email').summernote({height: 300});
$('#mod_rastreio_msg_email_final').summernote({height: 300});

function ckInsert_registered(html)
{
	$('#mod_rastreio_msg_email_registered').summernote({focus: true});
	$(document.getSelection().anchorNode).append(html);
}

function ckInsert(html)
{
	$('#mod_rastreio_msg_email').summernote({focus: true});
	$(document.getSelection().anchorNode).append(html);
}

function ckInsert_final(html)
{
	$('#mod_rastreio_msg_email_final').summernote({focus: true});
	$(document.getSelection().anchorNode).append(html);
}

//--></script>
<?php } ?>

<script type="text/javascript"><!--
var mod_rastreio_statuscount = <?php echo $mod_rastreio_statuscount; ?>;

function addOrder_statuses() {	
	html  = '<tbody id="row' + mod_rastreio_statuscount + '">';
	html += '  <tr>';	
	html += '    <td class="left"><select name="mod_rastreio_order_statuses[' + mod_rastreio_statuscount + ']">';
	<?php foreach ($order_statuses as $order_status) { ?>
	html += '      <option value="<?php echo $order_status["order_status_id"]; ?>"><?php echo $order_status["name"]; ?></option>';
	<?php } ?>
	html += '    </select></td>';
	html += '    <td class="left"><a onclick="$(\'#row' + mod_rastreio_statuscount + '\').remove();" class="btn btn-danger"><span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#statusOrder').append(html);
	
	mod_rastreio_statuscount++;
}

function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $txt_dialog_title; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
					dataType: 'text',
					success: function(text) {
						$('#' + thumb).replaceWith('<img src="' + text + '" alt="" id="' + thumb + '" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
};

checking_update_text = "<?php echo $checking_update_text; ?>";
$(function()
{
	$.ajax(
	{
		url: '<?php echo $urlcheckupdate; ?>',
		dataType: 'json',
		beforeSend: function()
		{
			$("#checkupdate").text(checking_update_text);
		},
		success: function(data)
		{
			if(data.update)
			{
				$("#checkupdate").html(data.html);
			}
			else
			{
				$("#checkupdate").html(data.html);
				setTimeout(function()
				{
					$("#checkupdate").hide();
				}, 5000);
			}
		},
		error: function(xhr, ajaxOptions, thrownError)
		{
			setTimeout(function()
			{
				$("#checkupdate").hide();
			}, 5000);
		}
	});
	
	$("#simulate_button").click(function(e)
	{
		e.preventDefault();
		var codigo = $("#simulate_codigo").val();
		if($.trim(codigo) != "")
		{
			$("#result_simulate").html('');
			$("#simule").hide("slow");
			var urlsimulate = '<?php echo $urlsimulate; ?>&codigo='+codigo;
			$("#result_simulate").load(urlsimulate);
			setTimeout(function()
			{
				$("#simule").show("slow");
			}, 5000);
		}

		return false;
	});
	
	$('#tabsContainer a').tabs();
});
//--></script>

<script type="text/javascript"><!--
$('input[name=\'product\']').autocomplete({
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
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
	select: function(item) {
		$('input[name=\'product\']').val('');
		
		$('#featured-product' + item['value']).remove();
		
		$('#featured-product').append('<div id="featured-product' + item['value'] + '"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product[]" value="' + item['value'] + '" /></div>');	
	}
});
	
$('#featured-product').delegate('.fa-minus-circle', 'click', function() {
	$(this).parent().remove();
});
//--></script> 
<?php echo $footer; ?>