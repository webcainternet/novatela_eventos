<?php
/*
* @package		Comércio BR
* @copyright	2014
* @site			http://comerciobr.com
* @license		http://www.gnu.org/licenses/gpl-2.0.html
*
* @Donate		1G3xTNh512PRDbfoEoeWWacigVVR9tYHAp Bitcoin
* @Donate		LXjsKahtNEmtZCQPXyRnw7c7mU4iKJbYWJ Litcoin
* @Donate		DFLaTxkhVeA84juzLBmxL8uRA1A7KJGnbL DogeCoin
*/

// Heading
$_['heading_title']					= '<a href="http://comerciobr.com" target="_blank"><img src="view/image/comerciobr.png" alt="Comércio BR - Correios - Rastrear Encomendas" title="Comércio BR - Correios - Rastrear Encomendas" /></a> <b>Correios - Rastrear Encomendas</b>';
$_['text_module']					= 'Modules';


$_['button_save_edit']				= 'Save and Edit';

// Text
$_['text_user_notify']				= 'Notify user when tracing code is registered';
$_['text_mod_rastreio_copy_email_admin'] = 'Send email copy to the Administrator';
$_['text_mod_rastreio_show_count_time'] = 'View of days counter';
$_['text_hidden_code']				= 'Hide tracking code after registration';
$_['text_show_cep']					= 'Show ZIP code above tracking code registered';
$_['text_include_status_history']	= 'Include tracking status in order history';
$_['text_order_status_post']		= 'When tracking code is registered, change order status to';
$_['text_order_status_final']		= 'Status when the goods are delivered';
$_['text_set_status_notify']		= 'Select at which the tracking status must be accompanied';
$_['text_success']					= 'Successfully saved settings';
$_['text_url_cron']					= 'Enable Cron your server at this URL';
$_['text_status']					= 'Status';
$_['text_action']					= 'Action';
$_['text_no_action']				= 'No Action';
$_['text_only_shipping_select']		= 'Enable Registration codes';
$_['text_any_shipping']				= 'any Module';
$_['text_notify_cad_cod']			= '%s your request %s was successfully posted, use this code: <b>%s</b> it traces it to the post office or visit this url %s for it traces it.';
$_['text_email_subject']			= "%s - Tracking objects at the post office";
$_['text_tracking_code']			= "Order successfully posted, use the following code <b>%s</b> to track him or go to the following link %s";
$_['text_insert_tracking_code']		= "Code (s) inserted tracking (s) successfully";
$_['text_user_notify_success']		= "Code (s) inserted tracking (s) successfully. <br />%d user (s) notified (s) successfully";
$_['text_checking_update_text']		= 'Checking for new updates';
$_['text_msg_email']				= 'E-Mail message. Include in the message the following codes to:';
$_['text_msg_email1']				= '<a href="javascript:;" onclick="ckInsert(\'%name_user%\')">%name_user%</a>';
$_['text_msg_email2']				= '<a href="javascript:;" onclick="ckInsert(\'%number_order%\')">%number_order%</a>';
$_['text_msg_email3']				= '<a href="javascript:;" onclick="ckInsert(\'<a href=\\\'%url_order%\\\'>DESCRIÇÃO LINK</a>\')">%url_order%</a>';
$_['text_msg_email4']				= '<a href="javascript:;" onclick="ckInsert(\'%number_tracker%\')">%number_tracker%</a>';
$_['text_msg_email5']				= '<a href="javascript:;" onclick="ckInsert(\'%date_tracker_status%\')">%date_tracker_status%</a>';
$_['text_msg_email6']				= '<a href="javascript:;" onclick="ckInsert(\'%table_tracker%\')">%table_tracker%</a>';
$_['text_msg_email7']				= '<a href="javascript:;" onclick="ckInsert(\'%tracker_status%\')">%tracker_status%</a>';
$_['text_msg_email8']				= '<a href="javascript:;" onclick="ckInsert(\'%divider_msg%\')">%divider_msg%</a>, <b class="danger"><a href="view/image/mod_rastreio/example_divider.jpg" target="_blank">Exemplo</a></b>';
$_['text_msg_email9']				= '<a href="javascript:;" onclick="ckInsert(\'%latest%\')">%latest%</a>';
$_['text_msg_email10']				= '<a href="javascript:;" onclick="ckInsert(\'%bestseller%\')">%bestseller%</a>';
$_['text_msg_email11']				= '<a href="javascript:;" onclick="ckInsert(\'%featured%\')">%featured%</a>';
$_['text_msg_email12']				= '<a href="javascript:;" onclick="ckInsert(\'%url_tracker%\')">%url_tracker%</a>';

$_['text_msg_email_final']			= 'E-mail message when the supply is completed';

// help
$_['text_hidden_code_help']			= 'The code for registration field will be removed and you can only change the codes through the panel contained within each application';
$_['text_only_shipping_select_help']= 'Only enable the registration code in the application if you are using this form of sending';
$_['text_show_cep_help']			= 'Above the registered tracking code will show the request destination ZIP code';
$_['text_include_status_history_help']	= 'The screening will be included in the order history';
$_['text_order_status_post_help']	= 'recommend switching to some indicating the posting';
$_['text_set_status_notify_help']	= 'Example: dispatched, pending, processing';
$_['text_order_status_final_help']	= 'For which the status request should advance when the goods are delivered to the customer. We recommend that is different from the status defined above';
$_['text_msg_email_help']			= 'Use the editor to compose the email message that will be sent to inform the user';
$_['text_msg_email_help1']			= 'will be replaced by the user name';
$_['text_msg_email_help2']			= 'will be replaced by order number';
$_['text_msg_email_help3']			= 'will be replaced by link to view the request';
$_['text_msg_email_help4']			= 'will be replaced by the tracking code number';
$_['text_msg_email_help5']			= 'will be replaced by the current date status at the post office.';
$_['text_msg_email_help6']			= 'will be replaced by the trace table postal';
$_['text_msg_email_help7']			= 'will be replaced by the current status of the object at the post office';
$_['text_msg_email_help8']			= 'use to separate the main message of status if you are registering more than one code per order. name_user, number_order, url_order will not be considered below divider_msg';
$_['text_msg_email_help9']			= 'will be replaced by the latest products store';
$_['text_msg_email_help10']			= 'will be replaced by top selling products store';
$_['text_msg_email_help11']			= 'will be replaced by the selected products';
$_['text_msg_email_help12']			= 'will be replaced by object tracking url in the post';
$_['text_msg_email_final_help']		= 'Ideal to have a product and / or a message requesting some sort of qualification';



$_['text_tab_general']				= 'General';
$_['text_tab_etiqueta']				= 'Labels';
$_['text_tab_products']				= 'Products';
$_['text_tab_simulate']				= 'Simule';
$_['text_tab_support']				= 'Support';

$_['text_etiqueta_name']			= 'Name:';
$_['text_etiqueta_company']			= 'Company:';
$_['text_etiqueta_phone']			= 'Phone:';
$_['text_etiqueta_cep']				= 'CEP:';
$_['text_etiqueta_address']			= 'Address:';
$_['text_etiqueta_number']			= 'Number:';
$_['text_etiqueta_address2']		= 'Address2';
$_['text_etiqueta_complement']		= 'Complement:';
$_['text_etiqueta_city']			= 'City:';
$_['text_etiqueta_state']			= 'State:';
$_['text_chancela_pac']				= 'Seal PAC:';
$_['text_chancela_sedex']			= 'Seal SEDEX:';
$_['text_select']					= 'Select';
$_['text_remove']					= 'Remove';

$_['text_support']					= '<h3>Contact</h3><hr>Support will be provided in accordance with the license terms that agreed to buy it. The term can be viewed in <a href="http://comerciobr.com/informacao/termos-e-condicoes" target="_blank">http://comerciobr.com/informacao/termos-e-condicoes</a>  <br /><br />Support will only be provided when providing: <ul><li>Store name where you purchased the module</li><li>order number</li><li>name used to purchase</li><li>email used to purchase</li><li>domain (s) to which the module is intended</li></ul> <br /><br /> <p>Cristiano Soares<br /><a href="mailto:contato@comerciobr.com" target="_blank">contato@comerciobr.com</a><br />facebook: <a href="http://fb.com/crisnao2" target="_blank">http://fb.com/crisnao2</a><br />skype: <a href="skype://crisnao2">crisnao2</a><br />+55 21 97498-1126 (claro) e WhatApp</p>';


$_['text_enabled']					= 'Enable';
$_['text_disabled']					= 'Disable';
$_['text_latest']					= 'Latest';
$_['text_bestseller']				= 'Bestseller';
$_['text_featured_product']			= 'Featured';
$_['entry_limit']					= 'Limit';
$_['entry_width']					= 'Width';
$_['entry_height']					= 'Height';
$_['entry_status']					= 'Status';

$_['entry_code_simulate']			= 'Enter the code for simulation';
$_['text_warning_simulate']			= '<div class="warning">Before performing the simulation, save any changes you have made in the module to simulate with the new settings.</div>';

// Error
$_['error_permission']				= 'Warning: You do not have permission to modify this module';
$_['error_message_not_defined']		= '<span class="error">You must configure the e-mail message in module, <a href="%s">click here</a> now to configure.</span>';
$_['error_simulate_failed']			= 'Unable to simulation when.';

?>