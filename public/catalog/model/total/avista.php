<?php
class ModelTotalAVista extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {
		if ($this->config->get('avista_status')) {
			$methods_aplicaveis = explode(",", $this->config->get('avista_methods'));
			
			if (isset($this->session->data['payment_method']['code'])) $paymethod = $this->session->data['payment_method']['code'];
			
			if (isset($paymethod)) {
				if (in_array($paymethod, $methods_aplicaveis)) {
					$this->load->language('total/avista');
					$float = ($this->config->get('avista_total')<10) ? '0.0'.str_replace(array(',','.'),'',$this->config->get('avista_total')) : '0.'.str_replace(array(',','.'),'',$this->config->get('avista_total'));
					$percent = $total * $float;
					$total_data[] = array( 
						'code'		 => 'avista',
						'title'      => $this->language->get('text_discount') . $this->config->get('avista_total'). '%',
						'value'      => $percent*-1,
						'sort_order' => $this->config->get('avista_sort_order')
					);
					$total -= $percent;
				}
			}
		}
	}
}
?>