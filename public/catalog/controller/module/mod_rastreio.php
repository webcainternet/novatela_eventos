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

// No Permission
defined('DIR_APPLICATION') or die('Restricted access');

class ControllerModuleModrastreio extends Controller
{
	public function index()
	{
		if($this->config->get("mod_rastreio_msg_email"))
		{
			$this->language->load('module/mod_rastreio');
			$mod_rastreio_order_status_final = $this->config->get("mod_rastreio_order_status_final");
			$mod_rastreio_order_statuses = $this->config->get("mod_rastreio_order_statuses");
			if(is_array($mod_rastreio_order_statuses))
			{
				$this->load->library('mod_rastreio');
				$Modrastreio = new Modrastreio($this->registry, $this);
				
				$statuses = implode("," ,$mod_rastreio_order_statuses);
				
				$orders = $Modrastreio->getOrders($statuses);
				$countUsersNotify = $Modrastreio->updateRastreio($orders);
				
				if(isset($this->request->get["ajaxUpdate"]))
				{
					echo $countUsersNotify;
					exit;
				}
			}
		}
		exit('OK');
	}
	
	
	public function simulate()
	{
		$this->load->language('module/mod_rastreio');
		if(isset($this->request->get['codigo']))
		{
			$codigo = $this->request->get['codigo'];
			$this->load->library('mod_rastreio');
			$Modrastreio = new Modrastreio($this->registry);
		
			$simulate = $Modrastreio->simulate($codigo);
			if($simulate)
			{
				echo $simulate;
				exit;
			}
		}
		
		echo $this->language->get('error_simulate_failed');
		exit;
	}
}

?>