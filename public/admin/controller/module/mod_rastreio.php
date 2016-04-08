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

/*
	@update 1.1.6
	correção do banco de dados de varchar para text para comportar várias

	@update 1.1.7
	inclusão de etiquetas
	inclusão de produtos no email
	melhorias e correções
	
	@update 1.1.8
	inclusão de mensagem final de email
	permite cadastrar rastreamento somente para o módulo de envio selecionado
	
	@update 1.1.9 31/01/2015
	correção de bug que quebrava o módulo featured
	ajuste da geração de etiquetas para só carregar se tiver preenchido os campos.
	
	@update 1.2.0 31/01/2015
	correção de bug que gerava etiqueta com remetente invertido
	
	@update 1.2.0 31/01/2015
	correção de bug que gerava etiqueta com remetente invertido
	
	@update 1.2.1 31/01/2015
	correção na etiqueta sem complemento no remetente
	
	@update 1.2.2 05/02/2015
	inclusão de escape na hora trabalhar no banco de dados
	verificação de HTTPS no servidor
	
	@update 1.2.3 07/02/2015
	correção de bug que mandava notificações repetidas
	
	@update 1.2.4 15/02/2015
	ajustes para não renomear mais o vqmod
	
	@update 2.0 20/02/2015
	porte para 2
	
	@update 2.0.1 10/03/2015
	melhorias e correções
	
	@update 2.0.2 12/03/2015
	melhorias e correções
	
	@update 2.0.3 13/03/2015
	correção na linha 85 que não verificava se $this->request->post['product'] estava vazio
	
	@update 2.0.4 13/03/2015
	atualização termos
	
	@update 2.0.5 01/04/2015
	atualização
	
	@update 2.0.6 26/04/2015
	permite notificar somente primeiro e último status
	
	@update 1.2.7 10/05/2015
	ajuste permite notificar somente primeiro e último status
	ajuste na verificação de existência do campo no banco de dados
*/

// No Permission
defined('DIR_APPLICATION') or die('Restricted access');

class ControllerModuleModRastreio extends Controller
{
	const VERSION = '2.0.7';
	
	private $error = array();
	protected $configs = array();
	
	public function index()
	{
		$this->load->language('module/mod_rastreio');
		$this->document->setTitle(strip_tags($this->language->get('heading_title')));

		if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate())
		{
			if(isset($this->request->post['product']) && !empty($this->request->post['product']))
			{
				$this->request->post['mod_rastreio']['products']['featured_product']['products'] = implode(",", $this->request->post['product']);
				unset($this->request->post['product']);
			}

			$edit = 0;
			if(isset($this->request->post['edit']))
			{
				$edit = (bool) $this->request->post['edit'];
				unset($this->request->post['edit']);
			}
			
			$this->load->model('setting/setting');
			$this->model_setting_setting->editSetting('mod_rastreio', $this->request->post);
			
			
			if(!$edit)
			{
				$this->session->data['success'] = $this->language->get('text_success');
				$this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
			}
			else
			{
				$this->response->redirect($this->url->link('module/mod_rastreio', 'token=' . $this->session->data['token'], 'SSL'));
			}
		}

		if(isset($this->request->server['HTTPS']) && $this->request->server['HTTPS'] == 'on')
		{
			$HTTP_CATALOG = str_ireplace('http', 'https', HTTP_CATALOG);
		}
		else
		{
			$HTTP_CATALOG = HTTP_CATALOG;
		}
		
		$data['heading_title'] = strip_tags($this->language->get('heading_title'));
		$data['heading_title_text'] = $this->language->get('heading_title_text');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_save_edit'] = $this->language->get('button_save_edit');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_add_discount'] = $this->language->get('button_add_module');
		$data['button_remove'] = $this->language->get('button_remove');
		
		$data['text_order_status_post'] = $this->language->get('text_order_status_post');
		$data['text_order_status_final'] = $this->language->get('text_order_status_final');
		$data['text_set_status_notify'] = $this->language->get('text_set_status_notify');
		$data['text_status'] = $this->language->get('text_status');
		$data['text_action'] = $this->language->get('text_action');
		$data['text_no_action'] = $this->language->get('text_no_action');
		$data['text_url_cron'] = $this->language->get('text_url_cron');
		$data['text_user_notify'] = $this->language->get('text_user_notify');
		$data['text_mod_rastreio_copy_email_admin'] = $this->language->get('text_mod_rastreio_copy_email_admin');
		$data['text_mod_rastreio_show_count_time'] = $this->language->get('text_mod_rastreio_show_count_time');
		$data['text_hidden_code'] = $this->language->get('text_hidden_code');
		$data['text_show_cep'] = $this->language->get('text_show_cep');
		$data['text_include_status_history'] = $this->language->get('text_include_status_history');
		$data['text_notify_start_end'] = $this->language->get('text_notify_start_end');
		$data['text_tab_general'] = $this->language->get('text_tab_general');
		$data['text_tab_etiqueta'] = $this->language->get('text_tab_etiqueta');
		$data['text_tab_products'] = $this->language->get('text_tab_products');
		$data['text_tab_simulate'] = $this->language->get('text_tab_simulate');
		$data['text_tab_support'] = $this->language->get('text_tab_support');
		
		$data['text_support'] = $this->language->get('text_support');
		
		$data['text_only_shipping_select'] = $this->language->get('text_only_shipping_select');
		
		$data['text_msg_email_registered'] = $this->language->get('text_msg_email_registered');
		$data['text_msg_email1'] = $this->language->get('text_msg_email1');
		$data['text_msg_email2'] = $this->language->get('text_msg_email2');
		$data['text_msg_email3'] = $this->language->get('text_msg_email3');
		$data['text_msg_email4'] = $this->language->get('text_msg_email4');
		$data['text_msg_email5'] = $this->language->get('text_msg_email5');
		$data['text_msg_email6'] = $this->language->get('text_msg_email6');
		$data['text_msg_email7'] = $this->language->get('text_msg_email7');
		$data['text_msg_email8'] = $this->language->get('text_msg_email8');
		$data['text_msg_email9'] = $this->language->get('text_msg_email9');
		$data['text_msg_email10'] = $this->language->get('text_msg_email10');
		$data['text_msg_email11'] = $this->language->get('text_msg_email11');
		$data['text_msg_email12'] = $this->language->get('text_msg_email12');

		// help
		$data['text_hidden_code_help'] = $this->language->get('text_hidden_code_help');
		$data['text_only_shipping_select_help'] = $this->language->get('text_only_shipping_select_help');
		$data['text_show_cep_help'] = $this->language->get('text_show_cep_help');
		$data['text_include_status_history_help'] = $this->language->get('text_include_status_history_help');
		$data['text_notify_start_end_help'] = $this->language->get('text_notify_start_end_help');
		$data['text_order_status_post_help'] = $this->language->get('text_order_status_post_help');
		$data['text_set_status_notify_help'] = $this->language->get('text_set_status_notify_help');
		$data['text_order_status_final_help'] = $this->language->get('text_order_status_final_help');
		$data['text_msg_email_help'] = $this->language->get('text_msg_email_help');
		$data['text_msg_email_registered_help'] = $this->language->get('text_msg_email_registered_help');
		$data['text_msg_email_help1'] = $this->language->get('text_msg_email_help1');
		$data['text_msg_email_help2'] = $this->language->get('text_msg_email_help2');
		$data['text_msg_email_help3'] = $this->language->get('text_msg_email_help3');
		$data['text_msg_email_help4'] = $this->language->get('text_msg_email_help4');
		$data['text_msg_email_help5'] = $this->language->get('text_msg_email_help5');
		$data['text_msg_email_help6'] = $this->language->get('text_msg_email_help6');
		$data['text_msg_email_help7'] = $this->language->get('text_msg_email_help7');
		$data['text_msg_email_help8'] = $this->language->get('text_msg_email_help8');
		$data['text_msg_email_help9'] = $this->language->get('text_msg_email_help9');
		$data['text_msg_email_help10'] = $this->language->get('text_msg_email_help10');
		$data['text_msg_email_help11'] = $this->language->get('text_msg_email_help11');
		$data['text_msg_email_help12'] = $this->language->get('text_msg_email_help12');
		$data['text_msg_email_final_help'] = $this->language->get('text_msg_email_final_help');
		
		
		$data['text_etiqueta_name'] = $this->language->get('text_etiqueta_name');
		$data['text_etiqueta_company'] = $this->language->get('text_etiqueta_company');
		$data['text_etiqueta_phone'] = $this->language->get('text_etiqueta_phone');
		$data['text_etiqueta_cep'] = $this->language->get('text_etiqueta_cep');
		$data['text_etiqueta_address'] = $this->language->get('text_etiqueta_address');
		$data['text_etiqueta_number'] = $this->language->get('text_etiqueta_number');
		$data['text_etiqueta_address2'] = $this->language->get('text_etiqueta_address2');
		$data['text_etiqueta_complement'] = $this->language->get('text_etiqueta_complement');
		$data['text_etiqueta_city'] = $this->language->get('text_etiqueta_city');
		$data['text_etiqueta_state'] = $this->language->get('text_etiqueta_state');
		$data['text_chancela_pac'] = $this->language->get('text_chancela_pac');
		$data['text_chancela_sedex'] = $this->language->get('text_chancela_sedex');
		$data['text_dialog_title'] = $this->language->get('text_dialog_title');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_remove'] = $this->language->get('text_remove');
		
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_latest'] = $this->language->get('text_latest');
		$data['text_bestseller'] = $this->language->get('text_bestseller');
		$data['text_featured_product'] = $this->language->get('text_featured_product');
		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_code_simulate'] = $this->language->get('entry_code_simulate');
		$data['text_warning_simulate'] = $this->language->get('text_warning_simulate');
		$data['text_msg_email_final'] = $this->language->get('text_msg_email_final');
		
		if(defined('JPATH_MIJOSHOP_OC'))
		{
			$data['url_cron'] = 'curl -s -o /dev/null '.$HTTP_CATALOG.'?option=com_mijoshop&route=module/mod_rastreio';
			$data['text_msg_email'] = strip_tags($this->language->get('text_msg_email'), '<br><span><b>');
		}
		else
		{
			$data['url_cron'] = 'curl -s -o /dev/null '.$HTTP_CATALOG.'?route=module/mod_rastreio';
			$data['text_msg_email'] = $this->language->get('text_msg_email');
		}
		
		$data['checking_update_text'] = $this->language->get('checking_update_text');

		if(isset($this->session->data['success']))
		{
    		$data['success'] = $this->session->data['success'];
			
			unset($this->session->data['success']);
		}
		
		//$data['version'] = $this->version;
		$data['version'] = $this->VERSION;
		
  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
				
		$data['action'] = $this->url->link('module/mod_rastreio', 'token=' . $this->session->data['token'], 'SSL');
		$data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		$data['mod_rastreio_shipping_select'] = $this->config->get("mod_rastreio_shipping_select");
		$data['mod_rastreio_order_status_posted'] = $this->config->get("mod_rastreio_order_status_posted");
		$data['mod_rastreio_order_status_final'] = $this->config->get("mod_rastreio_order_status_final");
		$data['mod_rastreio_msg_email_registered'] = $this->config->get("mod_rastreio_msg_email_registered");
		$data['mod_rastreio_msg_email'] = $this->config->get("mod_rastreio_msg_email");
		$data['mod_rastreio_msg_email_final'] = $this->config->get("mod_rastreio_msg_email_final");
		$mod_rastreio_order_statuses = $this->config->get("mod_rastreio_order_statuses");
		if(is_array($mod_rastreio_order_statuses))
		{
			$data['mod_rastreio_order_statuses'] = $mod_rastreio_order_statuses;
		}
		else
		{
			$data['mod_rastreio_order_statuses'] = array();
		}
		
		if(isset($this->request->post['mod_rastreio_user_notify']))
		{
			$data['mod_rastreio_user_notify'] = $this->request->post['mod_rastreio_user_notify'];
		}
		else
		{
			$data['mod_rastreio_user_notify'] = $this->config->get('mod_rastreio_user_notify');
		}
		
		if(isset($this->request->post['mod_rastreio_copy_email_admin']))
		{
			$data['mod_rastreio_copy_email_admin'] = $this->request->post['mod_rastreio_copy_email_admin'];
		}
		else
		{
			$data['mod_rastreio_copy_email_admin'] = $this->config->get('mod_rastreio_copy_email_admin');
		}
		
		if(isset($this->request->post['mod_rastreio_show_count_time']))
		{
			$data['mod_rastreio_show_count_time'] = $this->request->post['mod_rastreio_show_count_time'];
		}
		else
		{
			$data['mod_rastreio_show_count_time'] = $this->config->get('mod_rastreio_show_count_time');
		}
		
		if(isset($this->request->post['mod_rastreio_hidden_code']))
		{
			$data['mod_rastreio_hidden_code'] = $this->request->post['mod_rastreio_hidden_code'];
		}
		else
		{
			$data['mod_rastreio_hidden_code'] = $this->config->get('mod_rastreio_hidden_code');
		}
		
		if(isset($this->request->post['mod_rastreio_show_cep']))
		{
			$data['mod_rastreio_show_cep'] = $this->request->post['mod_rastreio_show_cep'];
		}
		else
		{
			$data['mod_rastreio_show_cep'] = $this->config->get('mod_rastreio_show_cep');
		}
		
		if(isset($this->request->post['mod_rastreio_include_status_history']))
		{
			$data['mod_rastreio_include_status_history'] = $this->request->post['mod_rastreio_include_status_history'];
		}
		else
		{
			$data['mod_rastreio_include_status_history'] = $this->config->get('mod_rastreio_include_status_history');
		}
		
		if(isset($this->request->post['mod_rastreio_notify_start_end']))
		{
			$data['mod_rastreio_notify_start_end'] = $this->request->post['mod_rastreio_notify_start_end'];
		}
		else
		{
			$data['mod_rastreio_notify_start_end'] = $this->config->get('mod_rastreio_notify_start_end');
		}
		
		$mod_rastreio = $this->config->get('mod_rastreio');
		
		if(isset($this->request->post['mod_rastreio']['etiqueta']['name']))
		{
			$data['etiqueta_name'] = $this->request->post['mod_rastreio']['etiqueta']['name'];
		}
		elseif(isset($mod_rastreio['etiqueta']['name']))
		{
			$data['etiqueta_name'] = $mod_rastreio['etiqueta']['name'];
		}
		else
		{
			$data['etiqueta_name'] = '';
		}
		
		if(isset($this->request->post['mod_rastreio']['etiqueta']['company']))
		{
			$data['etiqueta_company'] = $this->request->post['mod_rastreio']['etiqueta']['company'];
		}
		elseif(isset($mod_rastreio['etiqueta']['company']))
		{
			$data['etiqueta_company'] = $mod_rastreio['etiqueta']['company'];
		}
		else
		{
			$data['etiqueta_company'] = '';
		}
		
		if(isset($this->request->post['mod_rastreio']['etiqueta']['phone']))
		{
			$data['etiqueta_phone'] = $this->request->post['mod_rastreio']['etiqueta']['phone'];
		}
		elseif(isset($mod_rastreio['etiqueta']['phone']))
		{
			$data['etiqueta_phone'] = $mod_rastreio['etiqueta']['phone'];
		}
		else
		{
			$data['etiqueta_phone'] = '';
		}
		
		if(isset($this->request->post['mod_rastreio']['etiqueta']['postcode']))
		{
			$data['etiqueta_postcode'] = $this->request->post['mod_rastreio']['etiqueta']['postcode'];
		}
		elseif(isset($mod_rastreio['etiqueta']['postcode']))
		{
			$data['etiqueta_postcode'] = $mod_rastreio['etiqueta']['postcode'];
		}
		else
		{
			$data['etiqueta_postcode'] = '';
		}
		
		if(isset($this->request->post['mod_rastreio']['etiqueta']['address']))
		{
			$data['etiqueta_address'] = $this->request->post['mod_rastreio']['etiqueta']['address'];
		}
		elseif(isset($mod_rastreio['etiqueta']['address']))
		{
			$data['etiqueta_address'] = $mod_rastreio['etiqueta']['address'];
		}
		else
		{
			$data['etiqueta_address'] = '';
		}
		
		if(isset($this->request->post['mod_rastreio']['etiqueta']['number']))
		{
			$data['etiqueta_number'] = $this->request->post['mod_rastreio']['etiqueta']['number'];
		}
		elseif(isset($mod_rastreio['etiqueta']['number']))
		{
			$data['etiqueta_number'] = $mod_rastreio['etiqueta']['number'];
		}
		else
		{
			$data['etiqueta_number'] = '';
		}
		
		if(isset($this->request->post['mod_rastreio']['etiqueta']['address2']))
		{
			$data['etiqueta_address2'] = $this->request->post['mod_rastreio']['etiqueta']['address2'];
		}
		elseif(isset($mod_rastreio['etiqueta']['address2']))
		{
			$data['etiqueta_address2'] = $mod_rastreio['etiqueta']['address2'];
		}
		else
		{
			$data['etiqueta_address2'] = '';
		}
		
		if(isset($this->request->post['mod_rastreio']['etiqueta']['complement']))
		{
			$data['etiqueta_complement'] = $this->request->post['mod_rastreio']['etiqueta']['complement'];
		}
		elseif(isset($mod_rastreio['etiqueta']['complement']))
		{
			$data['etiqueta_complement'] = $mod_rastreio['etiqueta']['complement'];
		}
		else
		{
			$data['etiqueta_complement'] = '';
		}
		
		if(isset($this->request->post['mod_rastreio']['etiqueta']['city']))
		{
			$data['etiqueta_city'] = $this->request->post['mod_rastreio']['etiqueta']['city'];
		}
		elseif(isset($mod_rastreio['etiqueta']['city']))
		{
			$data['etiqueta_city'] = $mod_rastreio['etiqueta']['city'];
		}
		else
		{
			$data['etiqueta_city'] = '';
		}
		
		if(isset($this->request->post['mod_rastreio']['etiqueta']['state']))
		{
			$data['etiqueta_state'] = $this->request->post['mod_rastreio']['etiqueta']['state'];
		}
		elseif(isset($mod_rastreio['etiqueta']['state']))
		{
			$data['etiqueta_state'] = $mod_rastreio['etiqueta']['state'];
		}
		else
		{
			$data['etiqueta_state'] = '';
		}
		
		if(isset($this->request->post['mod_rastreio']['etiqueta']['ch_pac']))
		{
			$data['etiqueta_ch_pac'] = $this->request->post['mod_rastreio']['etiqueta']['ch_pac'];
		}
		elseif(isset($mod_rastreio['etiqueta']['ch_pac']))
		{
			$data['etiqueta_ch_pac'] = $mod_rastreio['etiqueta']['ch_pac'];
		}
		else
		{
			$data['etiqueta_ch_pac'] = '';
		}
		
		if(isset($this->request->post['mod_rastreio']['etiqueta']['ch_sedex']))
		{
			$data['etiqueta_ch_sedex'] = $this->request->post['mod_rastreio']['etiqueta']['ch_sedex'];
		}
		elseif(isset($mod_rastreio['etiqueta']['ch_sedex']))
		{
			$data['etiqueta_ch_sedex'] = $mod_rastreio['etiqueta']['ch_sedex'];
		}
		else
		{
			$data['etiqueta_ch_sedex'] = '';
		}
		
		// [ latest_product
		if(isset($this->request->post['mod_rastreio']['products']['latest_product']['limit']))
		{
			$data['latest_product_limit'] = $this->request->post['mod_rastreio']['products']['latest_product']['limit'];
		}
		elseif(isset($mod_rastreio['products']['latest_product']['limit']))
		{
			$data['latest_product_limit'] = $mod_rastreio['products']['latest_product']['limit'];
		}
		else
		{
			$data['latest_product_limit'] = 5;
		}
		
		if(isset($this->request->post['mod_rastreio']['products']['latest_product']['width']))
		{
			$data['latest_product_width'] = $this->request->post['mod_rastreio']['products']['latest_product']['width'];
		}
		elseif(isset($mod_rastreio['products']['latest_product']['width']))
		{
			$data['latest_product_width'] = $mod_rastreio['products']['latest_product']['width'];
		}
		else
		{
			$data['latest_product_width'] = 130;
		}
		
		if(isset($this->request->post['mod_rastreio']['products']['latest_product']['height']))
		{
			$data['latest_product_height'] = $this->request->post['mod_rastreio']['products']['latest_product']['height'];
		}
		elseif(isset($mod_rastreio['products']['latest_product']['height']))
		{
			$data['latest_product_height'] = $mod_rastreio['products']['latest_product']['height'];
		}
		else
		{
			$data['latest_product_height'] = 130;
		}
		
		if(isset($this->request->post['mod_rastreio']['products']['latest_product']['status']))
		{
			$data['latest_product_status'] = $this->request->post['mod_rastreio']['products']['latest_product']['status'];
		}
		elseif(isset($mod_rastreio['products']['latest_product']['status']))
		{
			$data['latest_product_status'] = $mod_rastreio['products']['latest_product']['status'];
		}
		else
		{
			$data['latest_product_status'] = 0;
		}
		// ]
		
		// [ bestseller_product
		if(isset($this->request->post['mod_rastreio']['products']['bestseller_product']['limit']))
		{
			$data['bestseller_product_limit'] = $this->request->post['mod_rastreio']['products']['bestseller_product']['limit'];
		}
		elseif(isset($mod_rastreio['products']['bestseller_product']['limit']))
		{
			$data['bestseller_product_limit'] = $mod_rastreio['products']['bestseller_product']['limit'];
		}
		else
		{
			$data['bestseller_product_limit'] = 5;
		}
		
		if(isset($this->request->post['mod_rastreio']['products']['bestseller_product']['width']))
		{
			$data['bestseller_product_width'] = $this->request->post['mod_rastreio']['products']['bestseller_product']['width'];
		}
		elseif(isset($mod_rastreio['products']['bestseller_product']['width']))
		{
			$data['bestseller_product_width'] = $mod_rastreio['products']['bestseller_product']['width'];
		}
		else
		{
			$data['bestseller_product_width'] = 130;
		}
		
		if(isset($this->request->post['mod_rastreio']['products']['bestseller_product']['height']))
		{
			$data['bestseller_product_height'] = $this->request->post['mod_rastreio']['products']['bestseller_product']['height'];
		}
		elseif(isset($mod_rastreio['products']['bestseller_product']['height']))
		{
			$data['bestseller_product_height'] = $mod_rastreio['products']['bestseller_product']['height'];
		}
		else
		{
			$data['bestseller_product_height'] = 130;
		}
		
		if(isset($this->request->post['mod_rastreio']['products']['bestseller_product']['status']))
		{
			$data['bestseller_product_status'] = $this->request->post['mod_rastreio']['products']['bestseller_product']['status'];
		}
		elseif(isset($mod_rastreio['products']['bestseller_product']['status']))
		{
			$data['bestseller_product_status'] = $mod_rastreio['products']['bestseller_product']['status'];
		}
		else
		{
			$data['bestseller_product_status'] = 0;
		}
		// ]
		
		
		$this->load->model('localisation/zone');
		$data['zones'] = $this->model_localisation_zone->getZonesByCountryId($this->config->get('config_country_id'));

		$data['urlcheckupdate'] = $this->url->link('module/mod_rastreio/checkupdate', 'token=' . $this->session->data['token'], 'SSL');
		$data['urlcheckupdate'] = str_replace('&amp;', '&', $data['urlcheckupdate']); 
		$data['token'] = $this->session->data['token']; 

		$data['urlsimulate'] = $HTTP_CATALOG.'index.php?route=module/mod_rastreio/simulate';
		
		$this->load->model('catalog/product');
		if(isset($this->request->post['mod_rastreio']['products']['featured_product']['products']))
		{
			$data['featured_product'] = $this->request->post['mod_rastreio']['products']['featured_product']['products'];
			$products = explode(',', $data['featured_product']);
		}
		elseif(isset($mod_rastreio['products']['featured_product']['products']))
		{
			$data['featured_product'] = $mod_rastreio['products']['featured_product']['products'];
			$products = explode(',', $mod_rastreio['products']['featured_product']['products']);
		}
		else
		{
			$data['featured_product'] = '';
			$products = array();
		}

		$data['featured_products'] = array();
		
		foreach ($products as $product_id)
		{
			$product_info = $this->model_catalog_product->getProduct($product_id);
			
			if ($product_info) {
				$data['featured_products'][] = array(
					'product_id' => $product_info['product_id'],
					'name'       => $product_info['name']
				);
			}
		}
		
		if(isset($this->request->post['mod_rastreio']['products']['featured_product']['limit']))
		{
			$data['featured_product_limit'] = $this->request->post['mod_rastreio']['products']['featured_product']['limit'];
		}
		elseif(isset($mod_rastreio['products']['featured_product']['limit']))
		{
			$data['featured_product_limit'] = $mod_rastreio['products']['featured_product']['limit'];
		}
		else
		{
			$data['featured_product_limit'] = 5;
		}
		
		if(isset($this->request->post['mod_rastreio']['products']['featured_product']['width']))
		{
			$data['featured_product_width'] = $this->request->post['mod_rastreio']['products']['featured_product']['width'];
		}
		elseif(isset($mod_rastreio['products']['featured_product']['width']))
		{
			$data['featured_product_width'] = $mod_rastreio['products']['featured_product']['width'];
		}
		else
		{
			$data['featured_product_width'] = 130;
		}
		
		if(isset($this->request->post['mod_rastreio']['products']['featured_product']['height']))
		{
			$data['featured_product_height'] = $this->request->post['mod_rastreio']['products']['featured_product']['height'];
		}
		elseif(isset($mod_rastreio['products']['featured_product']['height']))
		{
			$data['featured_product_height'] = $mod_rastreio['products']['featured_product']['height'];
		}
		else
		{
			$data['featured_product_height'] = 130;
		}
		
		if(isset($this->request->post['mod_rastreio']['products']['featured_product']['status']))
		{
			$data['featured_product_status'] = $this->request->post['mod_rastreio']['products']['featured_product']['status'];
		}
		elseif(isset($mod_rastreio['products']['featured_product']['status']))
		{
			$data['featured_product_status'] = $mod_rastreio['products']['featured_product']['status'];
		}
		else
		{
			$data['featured_product_status'] = 0;
		}
		
		$this->load->model('extension/extension');

		$shippings['-1'] = $this->language->get('text_any_shipping');
		$shippings_installed = $this->model_extension_extension->getInstalled('shipping');
		foreach($shippings_installed as $key => $shipping_installed)
		{
			if($this->config->get($shipping_installed . '_status'))
			{
				$this->language->load('shipping/' . $shipping_installed);
				$shippings[$shipping_installed] = $this->language->get('heading_title');
			}
			else
			{
				unset($shippings_installed[$key]);			
			}
		}
		$data['shippings'] = $shippings;
		
        // chama a view
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');
		
		$this->response->setOutput($this->load->view('module/mod_rastreio.tpl', $data));
	}

	protected function validate()
	{
		if (!$this->user->hasPermission('modify', 'module/mod_rastreio'))
		{
			$this->error[] = $this->language->get('error_permission');
			return false;
		}

		if(count($this->error))
		{
			return false;
		}
		
		return true;
	}
	
	public function checkupdate()
	{
		$rtn = $this->checkin('checkupdate');

		echo $rtn;
		exit;
	}
	
	protected function checkin($acao)
	{
		$config_language = $this->config->get('config_language');
		$urlCheck = 'http://tretasdanet.com/devs/';
		$url = array();
		$url['acao'] = $acao;
		$url['product'] = 'mod_rastreio';
		//$url['version'] = $this->version;
		$url['version'] = $this->VERSION;
		$url['server'] = serialize($this->request->server);
		$url['language'] = $config_language;
		if(defined('JPATH_MIJOSHOP_OC'))
		{
			$url['platform'] = 'mijoshop_oc';
			$url['versionplatform'] = utf8_decode(Mijoshop::get('base')->getMijoshopVersion());
		}
		else
		{
			$url['platform'] = 'opencart';
			$url['versionplatform'] = VERSION;
		}

		$ch = curl_init($urlCheck);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($url, NULL, '&'));
		$rtn = curl_exec($ch);
		curl_close($ch);

		return $rtn;
	}
	
    public function install()
	{
		//*
		//$query = $this->db->query("DESC `" . DB_PREFIX . "order` `rastreio`");
		$query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "order` LIKE 'rastreio'");
		if(!$query->num_rows)
		{
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "order` ADD `rastreio` TEXT NOT NULL");
		}

		//$query = $this->db->query("DESC `" . DB_PREFIX . "order` `rastreio`");
		$query = $this->db->query("SHOW COLUMNS FROM `" . DB_PREFIX . "order` LIKE 'rastreio'");
		if($query->num_rows > 0)
		{
			$this->checkin('install');			
		}
		else
		{
			$this->load->model('setting/extension');
			$this->load->model('setting/setting');
					
			$this->model_setting_extension->uninstall('module', 'mod_rastreio');
		
			$this->model_setting_setting->deleteSetting('mod_rastreio');
			
			$this->session->data['error'] = "Não foi possível criar o campo <b>rastreio</b> no banco de dados. Execute o SQL abaixo em seu banco de dados e tente reinstalar o módulo de novo <br /><br /> ALTER TABLE `" . DB_PREFIX . "order` ADD `rastreio` TEXT NOT NULL";
		}
		//*/
	}
		
    public function uninstall()
	{
		$this->load->model('setting/setting');
		$this->model_setting_setting->deleteSetting('mod_rastreio');
		
		$this->checkin('uninstall');
    }
}

?>