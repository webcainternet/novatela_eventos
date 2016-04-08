<?php 
class ControllerPaymentBancoSantander extends Controller {
	private $error = array(); 
	 
	public function index() { 
		$this->language->load('payment/bancosantander');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('bancosantander', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_all_zones'] = $this->language->get('text_all_zones');
		
		$data['entry_nome'] = $this->language->get('entry_nome');
		$data['help_nome'] = $this->language->get('help_nome');
		$data['error_nome'] = $this->language->get('error_nome');
		
		$data['entry_cedente'] = $this->language->get('entry_cedente');
		$data['help_cedente'] = $this->language->get('help_cedente');
		$data['error_cedente'] = $this->language->get('error_cedente');
		
		$data['entry_cpfcnpj'] = $this->language->get('entry_cpfcnpj');
		$data['help_cpfcnpj'] = $this->language->get('help_cpfcnpj');
		$data['error_cpfcnpj'] = $this->language->get('error_cpfcnpj');
		
		$data['entry_endereco'] = $this->language->get('entry_endereco');
		$data['help_endereco'] = $this->language->get('help_endereco');
		$data['error_endereco'] = $this->language->get('error_endereco');
		
		$data['entry_cliente'] = $this->language->get('entry_cliente');
		$data['help_cliente'] = $this->language->get('help_cliente');
		$data['error_cliente'] = $this->language->get('error_cliente');
		
		$data['entry_venda'] = $this->language->get('entry_venda');
		$data['help_venda'] = $this->language->get('help_venda');
		$data['error_venda'] = $this->language->get('error_venda');
		
		$data['entry_taxa'] = $this->language->get('entry_taxa');
		$data['help_taxa'] = $this->language->get('help_taxa');
		
		$data['entry_dias'] = $this->language->get('entry_dias');
		$data['help_dias'] = $this->language->get('help_dias');
		$data['error_dias'] = $this->language->get('error_dias');
		
		$data['entry_demo1'] = $this->language->get('entry_demo1');
		$data['help_demo'] = $this->language->get('help_demo');
		$data['entry_demo2'] = $this->language->get('entry_demo2');
		$data['entry_demo3'] = $this->language->get('entry_demo3');
		
		$data['entry_ins1'] = $this->language->get('entry_ins1');
		$data['help_ins'] = $this->language->get('help_ins');
		$data['entry_ins2'] = $this->language->get('entry_ins2');
		$data['entry_ins3'] = $this->language->get('entry_ins3');
		$data['entry_ins4'] = $this->language->get('entry_ins4');
		
				
		$data['entry_order_status'] = $this->language->get('entry_order_status');
		$data['help_order_status'] = $this->language->get('help_order_status');	
		
		$data['entry_total'] = $this->language->get('entry_total');
		$data['help_total'] = $this->language->get('help_total');
		
		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['help_geo_zone'] = $this->language->get('help_geo_zone');
		
		$data['entry_status'] = $this->language->get('entry_status');
		$data['help_status'] = $this->language->get('help_status');
		
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['help_sort_order'] = $this->language->get('help_sort_order');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

 		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['nome'])) {
		  $data['error_nome'] = $this->error['nome'];
		} else {
		  $data['error_nome'] = '';
		}
		
		if (isset($this->error['cedente'])) {
		  $data['error_cedente'] = $this->error['cedente'];
		} else {
		  $data['error_cedente'] = '';
		}
		
		if (isset($this->error['cpfcnpj'])) {
		  $data['error_cpfcnpj'] = $this->error['cpfcnpj'];
		} else {
		  $data['error_cpfcnpj'] = '';
		}
		
		if (isset($this->error['endereco'])) {
		  $data['error_endereco'] = $this->error['endereco'];
		} else {
		  $data['error_endereco'] = '';
		}
		
		if (isset($this->error['cliente'])) {
		  $data['error_cliente'] = $this->error['cliente'];
		} else {
		  $data['error_cliente'] = '';
		}
		
		if (isset($this->error['venda'])) {
		  $data['error_venda'] = $this->error['venda'];
		} else {
		  $data['error_venda'] = '';
		}
		
		if (isset($this->error['dias'])) {
		  $data['error_dias'] = $this->error['dias'];
		} else {
		  $data['error_dias'] = '';
		}

  		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/bancosantander', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$data['action'] = $this->url->link('payment/bancosantander', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');	
		
		if (isset($this->request->post['bancosantander_nome'])) {
			$data['bancosantander_nome'] = $this->request->post['bancosantander_nome'];
		} else {
			$data['bancosantander_nome'] = $this->config->get('bancosantander_nome'); 
		}
		
		if (isset($this->request->post['bancosantander_cedente'])) {
			$data['bancosantander_cedente'] = $this->request->post['bancosantander_cedente'];
		} else {
			$data['bancosantander_cedente'] = $this->config->get('bancosantander_cedente'); 
		}
		
		if (isset($this->request->post['bancosantander_cpfcnpj'])) {
			$data['bancosantander_cpfcnpj'] = $this->request->post['bancosantander_cpfcnpj'];
		} else {
			$data['bancosantander_cpfcnpj'] = $this->config->get('bancosantander_cpfcnpj'); 
		}
		
		if (isset($this->request->post['bancosantander_endereco'])) {
			$data['bancosantander_endereco'] = $this->request->post['bancosantander_endereco'];
		} else {
			$data['bancosantander_endereco'] = $this->config->get('bancosantander_endereco'); 
		}
		
		if (isset($this->request->post['bancosantander_cliente'])) {
			$data['bancosantander_cliente'] = $this->request->post['bancosantander_cliente'];
		} else {
			$data['bancosantander_cliente'] = $this->config->get('bancosantander_cliente'); 
		}
		
		if (isset($this->request->post['bancosantander_venda'])) {
			$data['bancosantander_venda'] = $this->request->post['bancosantander_venda'];
		} else {
			$data['bancosantander_venda'] = $this->config->get('bancosantander_venda'); 
		}
		
		if (isset($this->request->post['bancosantander_taxa'])) {
			$data['bancosantander_taxa'] = $this->request->post['bancosantander_taxa'];
		} else {
			$data['bancosantander_taxa'] = $this->config->get('bancosantander_taxa'); 
		}
		
		if (isset($this->request->post['bancosantander_dias'])) {
			$data['bancosantander_dias'] = $this->request->post['bancosantander_dias'];
		} else {
			$data['bancosantander_dias'] = $this->config->get('bancosantander_dias'); 
		}
		
		if (isset($this->request->post['bancosantander_demo1'])) {
			$data['bancosantander_demo1'] = $this->request->post['bancosantander_demo1'];
		} else {
			$data['bancosantander_demo1'] = $this->config->get('bancosantander_demo1'); 
		}
		
		if (isset($this->request->post['bancosantander_demo2'])) {
			$data['bancosantander_demo2'] = $this->request->post['bancosantander_demo2'];
		} else {
			$data['bancosantander_demo2'] = $this->config->get('bancosantander_demo2'); 
		}
		
		if (isset($this->request->post['bancosantander_demo3'])) {
			$data['bancosantander_demo3'] = $this->request->post['bancosantander_demo3'];
		} else {
			$data['bancosantander_demo3'] = $this->config->get('bancosantander_demo3'); 
		}
		
		if (isset($this->request->post['bancosantander_ins1'])) {
			$data['bancosantander_ins1'] = $this->request->post['bancosantander_ins1'];
		} else {
			$data['bancosantander_ins1'] = $this->config->get('bancosantander_ins1'); 
		}
		
		if (isset($this->request->post['bancosantander_ins2'])) {
			$data['bancosantander_ins2'] = $this->request->post['bancosantander_ins2'];
		} else {
			$data['bancosantander_ins2'] = $this->config->get('bancosantander_ins2'); 
		}
		
		if (isset($this->request->post['bancosantander_ins3'])) {
			$data['bancosantander_ins3'] = $this->request->post['bancosantander_ins3'];
		} else {
			$data['bancosantander_ins3'] = $this->config->get('bancosantander_ins3'); 
		}
		
		if (isset($this->request->post['bancosantander_ins4'])) {
			$data['bancosantander_ins4'] = $this->request->post['bancosantander_ins4'];
		} else {
			$data['bancosantander_ins4'] = $this->config->get('bancosantander_ins4'); 
		}
		
		if (isset($this->request->post['bancosantander_total'])) {
			$data['bancosantander_total'] = $this->request->post['bancosantander_total'];
		} else {
			$data['bancosantander_total'] = $this->config->get('bancosantander_total'); 
		}
				
		if (isset($this->request->post['bancosantander_order_status_id'])) {
			$data['bancosantander_order_status_id'] = $this->request->post['bancosantander_order_status_id'];
		} else {
			$data['bancosantander_order_status_id'] = $this->config->get('bancosantander_order_status_id'); 
		} 
		
		$this->load->model('localisation/order_status');
		
		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['bancosantander_geo_zone_id'])) {
			$data['bancosantander_geo_zone_id'] = $this->request->post['bancosantander_geo_zone_id'];
		} else {
			$data['bancosantander_geo_zone_id'] = $this->config->get('bancosantander_geo_zone_id'); 
		} 
		
		$this->load->model('localisation/geo_zone');						
		
		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
		if (isset($this->request->post['bancosantander_status'])) {
			$data['bancosantander_status'] = $this->request->post['bancosantander_status'];
		} else {
			$data['bancosantander_status'] = $this->config->get('bancosantander_status');
		}
		
		if (isset($this->request->post['bancosantander_sort_order'])) {
			$data['bancosantander_sort_order'] = $this->request->post['bancosantander_sort_order'];
		} else {
			$data['bancosantander_sort_order'] = $this->config->get('bancosantander_sort_order');
		}

		//layout
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('payment/bancosantander.tpl', $data));
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'payment/bancosantander')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['bancosantander_nome']) {
		  $this->error['nome'] = $this->language->get('error_nome');
		}
		
		if (!$this->request->post['bancosantander_cedente']) {
		  $this->error['cedente'] = $this->language->get('error_cedente');
		}
		
		if (!$this->request->post['bancosantander_cpfcnpj']) {
		  $this->error['cpfcnpj'] = $this->language->get('error_cpfcnpj');
		}
		
		if (!$this->request->post['bancosantander_endereco']) {
		  $this->error['endereco'] = $this->language->get('error_endereco');
		}
		
		if (!$this->request->post['bancosantander_cliente']) {
		  $this->error['cliente'] = $this->language->get('error_cliente');
		}
		
		if (!$this->request->post['bancosantander_venda']) {
		  $this->error['venda'] = $this->language->get('error_venda');
		}
		
		if (!$this->request->post['bancosantander_dias']) {
		  $this->error['dias'] = $this->language->get('error_dias');
		}

		return !$this->error;
	}
}
?>