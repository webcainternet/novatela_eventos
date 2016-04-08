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

	function count_time_posted($rastreios, $multiple_cod = true)
	{
		$diff_date_text = '';
		$temp_rastreio = $rastreios;
		if($multiple_cod)
		{
			$first_rastreio = array_shift($temp_rastreio);
		}
		else
		{
			$first_rastreio = $temp_rastreio;
		}

		$first_status = array_shift($first_rastreio);
		$date_first_status = strtotime($first_status['date_added']);
		$total_segundos = time() - $date_first_status;
		
		
		$dias_por_mes = ((((365+@date("L"))*4)/4)/12);
		
		$y = $m = $d = $h = $min = $seg = '';

		$y = floor( $total_segundos / (3600*24* $dias_por_mes *12) );
		$total_segundos = ($total_segundos % (3600*24* $dias_por_mes *12));
		
		$m = floor( $total_segundos / (3600*24* $dias_por_mes ) );
		$total_segundos = ($total_segundos % (3600*24* $dias_por_mes ));
		
		$d = floor( $total_segundos / (3600*24) );
		$total_segundos = ($total_segundos % (3600*24));
		
		$h = floor( $total_segundos / 3600 );
		$total_segundos = ($total_segundos % (60*60));
		
		$min = floor($total_segundos / 60);
		$total_segundos = ($total_segundos % 60);
		
		$seg = $total_segundos;
		
		$h = $h < 10 ? '0'.$h : $h;
		$min = $min < 10 ? '0'.$min : $min;
		$seg = $seg < 10 ? '0'.$seg : $seg;
		
		if($y)
		{
			$diff_date_text .= "{$y} anos, ";
		}
		if($m)
		{
			$diff_date_text .= "{$m} meses, ";
		}
		if($d)
		{
			$diff_date_text .= "{$d} dias, ";
		}

		$diff_date_text .= "{$h}:{$min}:{$seg}";

		if(!empty($diff_date_text))
		{
			$diff_date_text = "<b>Postado há {$diff_date_text}</b>";
		}
		
		return $diff_date_text;
	}

class Modrastreio
{
	const VERSION = '2.0.7';
	
	private $load;
	private $db;
	private $config;
	private $language;
	private $registry;
	private $response;
	public function __construct($registry)
	{
		$this->load = $registry->get("load");
		$this->db = $registry->get("db");
		$this->config = $registry->get("config");
		$this->language = $registry->get("language");
		$this->response = $registry->get("response");
		$this->registry = $registry;
	}

	public function rastrear($codigo = "")
	{
		$retorno = false;
		$url = 'http://websro.correios.com.br/sro_bin/txect01$.Inexistente?P_LINGUA=001&P_TIPO=002&P_COD_LIS=' . $codigo;

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$rtn = curl_exec($ch);
		curl_close($ch);
		
	   if(!empty($rtn))
	   {
			if(preg_match( '#<table.*>.*</table>#is', $rtn, $tabela))
			{
				if(count( $tabela ) == 1)
				{
					$retorno = utf8_encode(strip_tags($tabela[0], '<table><tr><td>'));
				}
			}
		}
		
		return $retorno;
	}
	
	public function parse($html)
	{
		$this->load->library('simple_html_dom');

		$results = array();
		$tabela = str_get_html($html);
		$tds = $tabela->find('td');
		$len = count($tds);
		for($i = 3; $i < $len; $i++)
		{
			$data = $local = $situacao = $descricao = '';
			$rowspan = (int)$tds[$i]->getAttribute('rowspan');

			if(isset($tds[$i]))
			{
				$data = trim(strip_tags($tds[$i]->innertext()));
			}
			
			if(isset($tds[$i+1]))
			{
				$local = trim(strip_tags($tds[$i+1]->innertext()));
			}

			if(isset($tds[$i+2]))
			{
				$situacao = trim(strip_tags($tds[$i+2]->innertext()));
			}

			if(isset($tds[$i+3]))
			{
				$descricao = "{$situacao}, {$local} - {$data}";
				//$descricao = trim(strip_tags($tds[$i+3]->innertext()));
			}
			
			if(!simple_html_dom_node::is_utf8($data))
			{
				$data = utf8_encode($data);
			}
				
			if(!simple_html_dom_node::is_utf8($local))
			{
				$local = utf8_encode($local);
			}
			
			if(!simple_html_dom_node::is_utf8($situacao))
			{
				$situacao = utf8_encode($situacao);
			}
			
			if(!simple_html_dom_node::is_utf8($descricao))
			{
				$descricao = utf8_encode($descricao);
			}
			
			if(empty($descricao) && stripos('postado', $situacao) !== false)
			{
				$descricao = "Postado";
			}
			
			$results[] = array(
				'data' => implode("-", array_reverse(explode("/", substr($data, 0, 10)))).substr($data, 10),
				'local' => $local,
				'situacao' => $situacao,
				'descricao' => $descricao
			);
			
			if($rowspan == 1)
			{
				$i += 2;
			}
			else
			{
				$i += 3;
			}
		}
		
		return $results;
	}
	
	// Rotinas para interação com Banco de Dados
	public function getOrder($order_id)
	{
		$query = $this->db->query("SELECT o.order_id, o.store_name, o.store_url, o.customer_id, o.firstname, o.email, o.order_status_id, o.date_modified, o.rastreio FROM `".DB_PREFIX."order` o WHERE o.order_id = '{$order_id}'");
		
		return $query->row;
    }
	
	public function getOrders($statuses)
	{
		$query = $this->db->query("SELECT o.order_id, o.store_name, o.store_url, o.customer_id, o.firstname, o.email, o.order_status_id, o.date_modified, o.rastreio FROM `".DB_PREFIX."order` o WHERE CHAR_LENGTH(o.rastreio) >= 13 AND order_status_id IN({$statuses})");
		
		return $query->rows;
    }
	
	public function getHistory($order_id)
	{
		$query = $this->db->query("SELECT oh.order_status_id, oh.comment, oh.date_added FROM `".DB_PREFIX."order_history` oh WHERE oh.order_id = " .(int)$order_id. "");
		
		return $query->rows;
    }
	
	public function setOrderStart($order_id, $data)
	{
		$this->db->query("UPDATE `".DB_PREFIX."order` SET `order_status_id` = " .(int)$data['order_status_id']. ", `date_modified` = NOW() WHERE order_id = ". (int)$data['order_id'] ."");

		$this->db->query("INSERT INTO `".DB_PREFIX."order_history` SET `order_history_id` = 0, `order_id` = " .(int)$data['order_id']. ", `order_status_id` = " .(int)$data['order_status_id']. ", `notify` = 1, `comment` = '" . $this->db->escape($data_status['comment']) . "', `date_added` = '" .$data_status['data']. "'");
	}
	
	public function addOrRemoverCodRastreio($data, $remover = false)
	{
		$order_ids = array();
		$update = false;
		$mod_rastreio_order_status_final = $this->config->get("mod_rastreio_order_status_final");
		$mod_rastreio_order_statuses = $this->config->get("mod_rastreio_order_statuses");
		foreach($data as $order_id => $codigos)
		{
			$order_info = $this->getOrder($order_id);
			if($order_info)
			{
				$codigos = trim($codigos);
				if(!empty($codigos))
				{
					$codigos = explode(',', $codigos);
					$rastreios = $order_info['rastreio'];
					
					if(strlen($rastreios) >= 13 && strstr($rastreios, '{'))
					{
						$rastreios = @unserialize($rastreios);
					}
					elseif(!empty($rastreios))
					{
						$rastreios = explode(",", $rastreios);
					}
					else
					{
						$rastreios = array();
					}

					foreach($codigos as $codigo)
					{
						if(!empty($codigo) && count($rastreios) > 0)
						{
							if(!array_key_exists($codigo, $rastreios))
							{
								$rastreios[$codigo][0] = array('status' => 'Aguarde...', 'date_added' => date("Y-m-d H:i:s"));
								$update = true;
							}
							elseif($remover)
							{
								unset($rastreios[$codigo]);
								$update = true;
							}
						}
						elseif(!empty($codigo))
						{
							$rastreios[$codigo][0] = array("status" => "Aguarde...", "date_added" => date("Y-m-d H:i:s"));
							$update = true;
						}

						/*
						if(!empty($codigo) && strlen($rastreios) >= 13 && strstr($rastreios, '{'))
						{
							$rastreios = @unserialize($rastreios);
						
							if(!array_key_exists($codigo, $rastreios))
							{
								$rastreios[$codigo][0] = array('status' => 'Aguarde...', 'date_added' => date("Y-m-d H:i:s"));
							}
							elseif($remover)
							{
								unset($rastreios[$codigo]);
							}
						}
						else
						{
							if(!empty($codigo) && !empty($rastreios))
							{
								$rastreios = explode(",", $rastreios);
								if(!array_key_exists($codigo, $rastreios))
								{
									$rastreios[$codigo][0] = array('status' => 'Aguarde...', 'date_added' => date("Y-m-d H:i:s"));
								}
								elseif($remover)
								{
									unset($rastreios[$codigo]);
								}
							}
							elseif(!empty($codigo))
							{
								$rastreios[$codigo][0] = array("status" => "Aguarde...", "date_added" => date("Y-m-d H:i:s"));
							}
						}
						*/
					}
				}
				else
				{
					$rastreios = array();
				}

				//$update = count($rastreios) > 0;
				if($update && is_array($codigos))
				{
					$user_notify = count($codigo);
					foreach($codigos as $codigo)
					{
						if(isset($rastreios[$codigo][0]['status']) && strstr($rastreios[$codigo][0]['status'], 'Aguarde...'))
						{ // se acabou de postar e o código for igual aguarde eu tento ver se já está nos correios e atualizo ele
							$tabela = $this->rastrear($codigo);
							if(!empty($tabela))
							{
								$tblParseado = $this->parse($tabela);
								if(count($tblParseado))
								{
									$firstStatus = array_pop($tblParseado);

									$rastreios[$codigo][0]['status'] = $firstStatus['descricao'];
									$rastreios[$codigo][0]['date_added'] = $firstStatus['data'];
									$user_notify--;
								}

							}
						}
					}
					
					if($user_notify > 0 && empty($order_info['rastreio']) && $this->config->get('mod_rastreio_user_notify'))
					{ // se postou agora, eu notifico o ciente

						$number_order = $order_info["order_id"];
						$url_order = $order_info["store_url"].'index.php?route=account/order/info&order_id='.$order_info["order_id"];
						$urlRastreio = '';
						foreach($codigos as $codigo)
						{
							$urlRastreio = 'http://websro.correios.com.br/sro_bin/txect01$.QueryList?P_LINGUA=001&P_TIPO=001&P_COD_UNI='.$codigo.'<br />';
						}

						$search = array(
							'%name_user%',
							'%number_order%',
							'%url_order%',
							'%number_tracker%',
							'%url_tracker%'
						);
						
						$replace = array(
							$order_info["firstname"],
							$number_order,
							$url_order,
							implode(', ', $codigos),
							$urlRastreio
						);
						
						$msgEmail = $this->config->get("mod_rastreio_msg_email_registered");
						$html = html_entity_decode(str_replace($search, $replace, $msgEmail), ENT_QUOTES, 'UTF-8');
					
						//$mail = new Mail();
						//$mail->protocol = $this->config->get('config_mail_protocol');
						//$mail->parameter = $this->config->get('config_mail_parameter');
						//$mail->smtp_hostname = $this->config->get('config_smtp_host');
						//$mail->smtp_username = $this->config->get('config_smtp_username');
						//$mail->smtp_password = $this->config->get('config_smtp_password');
						//$mail->smtp_port = $this->config->get('config_smtp_port');
						//$mail->smtp_timeout = $this->config->get('config_smtp_timeout');
						//$mail->setTo($order_info['email']);
						//$mail = new Mail($this->config->get('config_mail'));
						$mail = new Mail;
						$mail->setTo($order_info['email']);					
						$mail->setFrom($this->config->get('config_email'));
						$mail->setSender($order_info["store_name"]);
						//$mail->setSubject(html_entity_decode($order_info["store_name"], ENT_QUOTES, 'UTF-8'));
						$mail->setSubject(html_entity_decode($order_info["store_name"].' - Rastreamento de Objetos', ENT_QUOTES, 'UTF-8'));
						$mail->setHtml(html_entity_decode($html, ENT_QUOTES, 'UTF-8'));
						$mail->setText(html_entity_decode(strip_tags($html), ENT_QUOTES, 'UTF-8'));
						$mail->send();
						
						if($this->config->get("mod_rastreio_copy_email_admin"))
						{
							$mail->setTo($this->config->get('config_email'));
							$mail->send();
						}
					}
				}
				
				if(count($rastreios) > 0)
				{
					$rastreios = serialize($rastreios);
				}
				else
				{
					$rastreios = '';
				}
				
				//if(!empty($codigo) && $this->config->get('mod_rastreio_order_status_posted'))
				$sql = '';
				if($update && $this->config->get('mod_rastreio_order_status_posted'))
				{
					if(!empty($rastreios))
					{
						$sql = "UPDATE `" . DB_PREFIX . "order` SET order_status_id = " .$this->config->get('mod_rastreio_order_status_posted'). ", rastreio = '" .$this->db->escape($rastreios). "' WHERE order_id = '" . (int)$order_id . "' and order_status_id != '" . (int)$mod_rastreio_order_status_final . "'";
					}
					else
					{
						$sql = "UPDATE `" . DB_PREFIX . "order` SET rastreio = '' WHERE order_id = '" . (int)$order_id . "' and order_status_id != '" . (int)$mod_rastreio_order_status_final . "'";
					}
					//$sql = "UPDATE `" . DB_PREFIX . "order` SET order_status_id = " .$this->config->get('mod_rastreio_order_status_posted'). ", rastreio = '" .$this->db->escape($rastreios). "' WHERE order_id = '" . (int)$order_id . "' and order_status_id != '" . (int)$mod_rastreio_order_status_final . "'";
					//$sql = "UPDATE `" . DB_PREFIX . "order` SET order_status_id = " .$this->config->get('mod_rastreio_order_status_posted'). ", rastreio = '" .$this->db->escape($codigo). "' WHERE order_id = '" . (int)$order_id . "' and order_status_id != '" . (int)$mod_rastreio_order_status_final . "'";
				}
				elseif(empty($rastreios))
				{
					$sql = "UPDATE `" . DB_PREFIX . "order` SET rastreio = '' WHERE order_id = '" . (int)$order_id . "' and order_status_id != '" . (int)$mod_rastreio_order_status_final . "'";
					$codigo = '';
				}

				if(!empty($sql))
				{
					$this->db->query($sql);
					if(!empty($codigo) && $this->db->countAffected() > 0)
					{
						$order_ids[] = $order_id;
					}
				}
			}
		}
		
		return $order_ids;
	}
	

	/*
		@update 1.1.6
		comentei linha //$rastreios = $getRastreio[0]["rastreio"];
		coloquei no lugar $rastreios = $query->rows[0]["rastreio"]; para pegar rastreio do banco
	*/
	public function updateOrder($order_id, $data, $codigo = "")
	{
		//$end_status = $data['statuses'][0];
		$statuses = array_reverse($data['statuses']);
		$query = $this->db->query("SELECT o.date_modified, o.rastreio FROM `" . DB_PREFIX . "order` o WHERE o.order_id = '{$order_id}' AND o.rastreio != ''");
		if($query->row)
		{
			$rastreios = $query->row["rastreio"];
			if(strlen($rastreios) >= 13 && strstr($rastreios, "{"))
			{
				$rastreios = @unserialize($rastreios);
				if(isset($rastreios[$codigo]))
				{
					//$rastreios[$codigo]["status"] = $end_status["descricao"];
					//$rastreios[$codigo]["date_added"] = $end_status['data'];
					foreach($statuses as $current_status)
					{
						array_push($rastreios[$codigo], array('status' => $current_status["descricao"], 'date_added' => $current_status['data']));
					}
					//array_push($rastreios[$codigo], array('status' => $end_status["descricao"], 'date_added' => $end_status['data']));
				}
			}
			else
			{
				$_rastreios = array();
				$rastreios = explode(",", $rastreios);
				foreach($rastreios as $rastreio)
				{
					$_rastreios[$rastreio] = array("status" => "Aguarde...", "date_added" => $query->row["date_modified"]);
				}

				//$_rastreios[$codigo]["status"] = $end_status["descricao"];
				//$_rastreios[$codigo]["date_added"] = $end_status['data'];
				foreach($statuses as $current_status)
				{
					array_push($_rastreios[$codigo], array('status' => $current_status["descricao"], 'date_added' => $current_status['data']));
				}
				//array_push($_rastreios[$codigo], array('status' => $end_status["descricao"], 'date_added' => $end_status['data']));
				$rastreios = $_rastreios;
			}
			
			$rastreios = serialize($rastreios);
		}

		if(isset($rastreios))
		{
			//$this->db->query("UPDATE `".DB_PREFIX."order` SET `date_modified` = NOW(), `rastreio` = '{$rastreios}' WHERE order_id = ".(int)$data['order_id']."");
			$this->db->query("UPDATE `".DB_PREFIX."order` SET `date_modified` = NOW(), `rastreio` = '". $this->db->escape($rastreios) ."' WHERE order_id = ".(int)$data['order_id']."");
		}
		else
		{
			$this->db->query("UPDATE `".DB_PREFIX."order` SET `date_modified` = NOW() WHERE order_id = ".(int)$data['order_id']."");		
		}
		
		if($this->config->get("mod_rastreio_include_status_history"))
		{
			foreach($data['statuses'] as $data_status)
			{
				$this->db->query("INSERT INTO `".DB_PREFIX."order_history` SET `order_history_id` = 0, `order_id` = " .(int)$data['order_id']. ", `order_status_id` = " .(int)$data['order_status_id']. ", `notify` = 1, `comment` = '" . $this->db->escape($data_status['descricao']). "', `date_added` = '" .$data_status['data']. "'");
			}
		}
		else
		{ // deixo apenas as mudanças de status registradas
			foreach($data['statuses'] as $data_status)
			{
				$this->db->query("INSERT INTO `".DB_PREFIX."order_history` SET `order_history_id` = 0, `order_id` = " .(int)$data['order_id']. ", `order_status_id` = " .(int)$data['order_status_id']. ", `notify` = 1, `comment` = '', `date_added` = '" .$data_status['data']. "'");
			}
		}
	}
	
	public function setOrderFinal($order_id, $data, $codigo = "")
	{
		$data_status = $data['statuses'];
		$query = $this->db->query("SELECT o.date_modified, o.rastreio FROM `" . DB_PREFIX . "order` o WHERE o.order_id = '{$order_id}' AND o.rastreio != ''");
		if($query->rows)
		{
			$rastreios = $query->row["rastreio"];
			if(strstr($rastreios, "{"))
			{
				$rastreios = @unserialize($rastreios);
				if(isset($rastreios[$codigo]))
				{
					//$rastreios[$codigo]["status"] = $data_status["descricao"];
					//$rastreios[$codigo]["date_added"] = $data_status['data'];
					array_push($rastreios[$codigo], array('status' => $data_status["descricao"], 'date_added' => $data_status['data']));
				}
			}
			else
			{
				$_rastreios = array();
				$rastreios = explode(",", $rastreios);
				foreach($rastreios as $rastreio)
				{
					$_rastreios[$rastreio] = array("status" => "Aguarde...", "date_added" => $query->row["date_modified"]);
				}

				//$_rastreios[$codigo]["status"] = $data_status["descricao"];
				//$_rastreios[$codigo]["date_added"] = $data_status['data'];
				array_push($_rastreios[$codigo], array('status' => $end_status["descricao"], 'date_added' => $end_status['data']));
				$rastreios = $_rastreios;
			}

			$rastreios = serialize($rastreios);
		}

		if(isset($rastreios))
		{
			$this->db->query("UPDATE `".DB_PREFIX."order` SET `order_status_id` = " .(int)$data['order_status_id']. ", `date_modified` = NOW(), `rastreio` = '". $this->db->escape($rastreios) ."' WHERE order_id = ". (int)$data['order_id'] ."");
		}
		else
		{
			$this->db->query("UPDATE `".DB_PREFIX."order` SET `order_status_id` = " .(int)$data['order_status_id']. ", `date_modified` = NOW() WHERE order_id = ". (int)$data['order_id'] ."");
		}

		if($this->config->get("mod_rastreio_include_status_history"))
		{
			$this->db->query("INSERT INTO `".DB_PREFIX."order_history` SET `order_history_id` = 0, `order_id` = " .(int)$data['order_id']. ", `order_status_id` = " .(int)$data['order_status_id']. ", `notify` = 1, `comment` = '" .  $this->db->escape($data_status['descricao']) ."', `date_added` = '" .$data_status['data']. "'");
		}
		else
		{ // deixo apenas as mudanças de status registradas
			$this->db->query("INSERT INTO `".DB_PREFIX."order_history` SET `order_history_id` = 0, `order_id` = " .(int)$data['order_id']. ", `order_status_id` = " .(int)$data['order_status_id']. ", `notify` = 1, `comment` = '', `date_added` = '" .$data_status['data']. "'");
		}
		
		//$this->db->query("INSERT INTO `".DB_PREFIX."order_history` SET `order_history_id` = 0, `order_id` = " .(int)$data['order_id']. ", `order_status_id` = " .(int)$data['order_status_id']. ", `notify` = 1, `comment` = '" .$data_status['situacao'].' '.$data_status['descricao'].' em '.$data_status['local']. "', `date_added` = '" .$data_status['data']. "'");
	}
	
	public function simulate($codigo)
	{
		$tabela = $this->rastrear($codigo);
		$urlRastreio = '<a href="http://websro.correios.com.br/sro_bin/txect01$.QueryList?P_LINGUA=001&P_TIPO=001&P_COD_UNI='.$codigo.'" target="_blank">http://websro.correios.com.br/sro_bin/txect01$.QueryList?P_LINGUA=001&P_TIPO=001&P_COD_UNI='.$codigo.'</a>';
		if(!empty($tabela))
		{
			$tblParseado = $this->parse($tabela);
			if(count($tblParseado))
			{
				$ultimoStatus = $tblParseado[0];
				if(strtotime($ultimoStatus['data']))
				{
				
					$get_products = $this->get_products();
					$latest = isset($get_products[0]) ? $get_products[0] : '';
					$bestseller = isset($get_products[1]) ? $get_products[1] : '';
					$featured = isset($get_products[2]) ? $get_products[2] : '';
				
					$search = array(
						'%name_user%',
						'%number_order%',
						'%url_order%',
						'%number_tracker%',
						'%tracker_status%',
						'%date_tracker_status%',
						'%url_tracker%',
						'%table_tracker%',
						'%divider_msg%',
						'%latest%',
						'%bestseller%',
						'%featured%'
					);
					
					$replace = array(
						$this->config->get('config_name'),
						001,
						HTTP_SERVER,
						$codigo,
						$ultimoStatus["descricao"],
						date("d/m/Y H:i:s", strtotime($ultimoStatus["data"])),
						$urlRastreio,
						$tabela,
						"<br ><hr /><br />",
						$latest,
						$bestseller,
						$featured
					);
					
					$html = '';					
					if(!empty($html) && stristr($this->config->get("mod_rastreio_msg_email"), "%divider_msg%"))
					{
						$msgEmail = explode("%divider_msg%", $this->config->get("mod_rastreio_msg_email"));
						if(count($msgEmail) > 1)
						{
							$msgEmail = $msgEmail[1];
						}
						else
						{
							$msgEmail = $this->config->get("mod_rastreio_msg_email");
						}
					}
					else
					{
						$msgEmail = $this->config->get("mod_rastreio_msg_email");
					}
					
					if(stristr($ultimoStatus['situacao'], "entrega efetuada") || stristr($ultimoStatus['situacao'], "entregue"))
					{
						$msgEmail = $this->config->get("mod_rastreio_msg_email_final");
					}

					$html .= str_replace($search, $replace, $msgEmail)."<br />";
					$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');
					
					
					//$html .= '<br /><br />'.$this->get_products();

					//$mail = new Mail();
					//$mail->protocol = $this->config->get('config_mail_protocol');
					//$mail->parameter = $this->config->get('config_mail_parameter');
					//$mail->smtp_hostname = $this->config->get('config_smtp_host');
					//$mail->smtp_username = $this->config->get('config_smtp_username');
					//$mail->smtp_password = $this->config->get('config_smtp_password');
					//$mail->smtp_port = $this->config->get('config_smtp_port');
					//$mail->smtp_timeout = $this->config->get('config_smtp_timeout');
					//$mail = new Mail($this->config->get('config_mail'));
					$mail = new Mail;
					$mail->setTo($this->config->get('config_email'));
					$mail->setFrom($this->config->get('config_email'));
					$mail->setSender($this->config->get('config_name'));
					//$mail->setSubject(html_entity_decode(sprintf($this->language->get('text_email_subject'), $this->config->get('config_name')), ENT_QUOTES, 'UTF-8'));
					$mail->setSubject(html_entity_decode($this->config->get('config_name').' - Rastreamento de Objetos', ENT_QUOTES, 'UTF-8'));
					$mail->setHtml($html);
					$mail->setText(strip_tags($html));
					$mail->send();
					
					return $html;
				}
			}
		}

		return false;
	}
	
	public function generate_labels($orders)
	{
		$mod_rastreio = $this->config->get('mod_rastreio');
		if(!isset($mod_rastreio['etiqueta']))
		{
			echo 'não configurado';
			exit;
		}
		
		$etiqueta = $mod_rastreio['etiqueta'];		
		if((empty($etiqueta['company']) && empty($etiqueta['name'])) || empty($etiqueta['postcode']) || empty($etiqueta['address']) || $etiqueta['number'] == '' || empty($etiqueta['address2']) || empty($etiqueta['city']))
		{
			echo 'não configurado';
			exit;
		}
		
		
		//echo '<script type="text/javascript" src="view/javascript/jquery/jquery-1.7.1.min.js"></script>';
		echo '
		<style type="text/css">
		@media print
		{
			*
			{
				background:transparent !important;
				color:#000 !important;
				text-shadow:none !important;
				filter:none !important;
				-ms-filter:none !important;
			}
			 
			body
			{
				margin:0px;
				padding:0;
				line-height: 1.4em;
			}
			
			@page
			{
				margin: 0.5cm;
			}
			
			#button_print
			{
				display: none;
				visibility: hidden;
			}
		}
		</style>
		';
		
		$labels = '';		
		$num_orders = count($orders);
		foreach($orders as $count => $order_id)
		{
			$sql = "SELECT ";
			$sql .= "if(o.shipping_firstname != '', concat(o.shipping_firstname, ' ', o.shipping_lastname), concat(o.payment_firstname, ' ', o.payment_lastname)) as fullname, ";
			$sql .= "if(o.shipping_postcode != '', o.shipping_postcode, o.payment_postcode) as postcode, ";
			$sql .= "if(o.shipping_company != '', o.shipping_company, o.payment_company) as company, ";
			$sql .= "if(o.shipping_address_1 != '', o.shipping_address_1, o.payment_address_1) as address_1, ";
			$sql .= "o.telephone, ";
			$sql .= "if(o.shipping_address_2 != '', o.shipping_address_2, o.payment_address_2) as address_2, ";
			$sql .= "if(o.shipping_city != '', o.shipping_city, o.payment_city) as city, ";
			$sql .= "if(o.shipping_zone != '', o.shipping_zone, o.payment_zone) as zone, ";
			$sql .= "if(o.shipping_zone != '', o.shipping_zone, o.payment_zone) as zone, ";
			$sql .= "(SELECT z.code FROM `".DB_PREFIX."zone` z WHERE z.zone_id = if(o.shipping_zone_id != '', o.shipping_zone_id, o.payment_zone_id)) as zone_uf, ";
			$sql .= "o.shipping_method ";
			$sql .= "FROM `".DB_PREFIX."order` o WHERE o.order_id = '{$order_id}'";
			$query = $this->db->query($sql);

			if($query->num_rows)
			{
				$order_info = $query->row;

				$chancela = "";
				if(!empty($etiqueta['ch_pac']) || !empty($etiqueta['ch_sedex']))
				{
					if(stristr($order_info["shipping_method"], "pac"))
					{
						$chancela = '<img src="'. HTTPS_CATALOG .'image/'. $etiqueta['ch_pac'] .'" width="150" />';
					}
					elseif(stristr($order_info["shipping_method"], "sedex"))
					{
						$chancela = '<img src="'. HTTPS_CATALOG .'image/'. $etiqueta['ch_sedex'] .'" width="150" />';
					}
				}

				$labels .= '
				<div style="float:left; width: 670px; border: 1px solid #222; padding: 10px; font-family: arial; font-size: 14px;">
					<div style="float:left; margin-bottom: 15px;">
						<div style="float:left; width: 100%;">
							<img style="float:left;" src="view/image/mod_rastreio/destinatario.gif" alt="" />												
							<div style="position: absolute; right: 40px;">
								<img src="view/image/mod_rastreio/logo_correios.gif" />
								<br />
								<br />
								'. $chancela .'
							</div>
						</div>						
						<div style="float:left; width: 100%; padding: 1px 0;">'. $order_info['fullname'] .'</div>
						<div style="float:left; width: 100%; padding: 1px 0;">'. $order_info['address_1'] .'</div>
						<div style="float:left; width: 100%; padding: 1px 0;">'. $order_info['address_2'] .'</div>
						<div style="float:left; width: 100%; padding: 1px 0;">'. $order_info['city'] .' - '. $order_info['zone_uf'] .'</div>
						<div style="float:left; width: 100%; padding: 1px 0;">'. $order_info['postcode'] .'</div>
						<div></div>
					</div>
					<div style="float:left;">
						<div style="font-weight:bold; font-size: 13px;">Remetente:</div>
						<div style="float:left; width: 100%; padding: 5px 0 0 0;">'. (!empty($etiqueta['name']) ? $etiqueta['name'] : $etiqueta['company']) .'</div>
						<div style="float:left; width: 100%; padding: 1px 0;">'. $etiqueta['address'] .', ' .$etiqueta['number']. '</div>
						<div style="float:left; width: 100%; padding: 1px 0;">'. $etiqueta['complement'] .'</div>
						<div style="float:left; width: 100%; padding: 1px 0;">'. $etiqueta['address2'] .'</div>
						<div style="float:left; width: 100%; padding: 1px 0;">'. $etiqueta['city'] .' - '. $etiqueta['state'] .'</div>
						<div style="float:left; width: 100%; padding: 1px 0;">'. $etiqueta['postcode'] .'</div>
					</div>
				</div>
				<div style="clear: both"></div>
				<br />
				';

				if($num_orders > 1 && ($count+1) < $num_orders)
				{
					$labels .= '<div style="border-top: 1px dashed #000;"></div><br />';
				}
			}
		}
		
		echo $labels;
		exit;
	}
	
	public function updateRastreio($orders)
	{
		$countUsersNotify = 0;
		foreach($orders as $order)
		{
			$countOrderFinal = 0;
			$notificar = false;
			$html = $text = '';
			if(strlen($order['rastreio']) >= 13 && strstr($order['rastreio'], "{"))
			{
				$codsRastreio = @unserialize($order['rastreio']);
			}
			else
			{
				$ts = explode(",", $order['rastreio']);
				foreach($ts as $_rastreio)
				{
					$codsRastreio[$_rastreio] = array("status" => "aguarde...", "date_added" => "0000-00-00 00:00:00");
				}
			}
			

			foreach($codsRastreio as $rastreio => $rastreio_attrib)
			{
				//$rastreio = $rastreio_attrib["codigo"];
				$final_notify = $start_notify = false;
				$tabela = $this->rastrear($rastreio);
				if(!empty($tabela))
				{
					$tblParseado = $this->parse($tabela);
					if(count($tblParseado))
					{
						$temp_rastreio_attrib = $rastreio_attrib;
						$ultimoStatusBd = array_pop($temp_rastreio_attrib);
						$ultimoStatus = $tblParseado[0];

						if(strtotime($ultimoStatus['data']))
						{
							$date_modified = $order['date_modified'];
							//if(isset($rastreio_attrib['date_added'][0]) && $rastreio_attrib['date_added'][0] != '0000-00-00 00:00:00')
							if(isset($ultimoStatusBd['date_added']) && $ultimoStatusBd['date_added'] != '0000-00-00 00:00:00')
							{
								$date_modified = $ultimoStatusBd['date_added'];
							}

							$urlRastreio = '<a href="http://websro.correios.com.br/sro_bin/txect01$.QueryList?P_LINGUA=001&P_TIPO=001&P_COD_UNI='.$rastreio.'" target="_blank">http://websro.correios.com.br/sro_bin/txect01$.QueryList?P_LINGUA=001&P_TIPO=001&P_COD_UNI='.$rastreio.'</a>';
							//if(strtotime($ultimoStatus['data']) != strtotime($order['date_modified']))
							if(strtotime($ultimoStatus['data']) != strtotime($date_modified) || $order['order_status_id'] != $this->config->get("mod_rastreio_order_status_final"))
							{
								if(stristr($ultimoStatus['situacao'], "entrega efetuada") || stristr($ultimoStatus['situacao'], "entregue"))
								{
									/* parei aqui, verificar na parte de multiplos códigos, quando tem mais de um enquanto não finaliza todos ele fica enviando notificação
									mesmo sem existir mudanças, preciso corrigir aqui para mudar para final somente do código que já foi entregue, assim
									evito ficar mandando notificações até finalizar todos
									
									*/
									$countOrderFinal++; // aqui está contando para caso se tiver mais de um só passar para entregue quando todos estiverem sidos entregues
									$data['order_id'] = $order['order_id'];
									$data['order_status_id'] = $this->config->get("mod_rastreio_order_status_final");
									$data['statuses'] = $ultimoStatus;
									if($countOrderFinal == count($codsRastreio))
									{
										$this->setOrderFinal($order['order_id'], $data, $rastreio);
										$final_notify = true;
										$notificar = true;
									}
									else
									{ // não foram todos ainda, estão atualizo somente o que foi entregue
										foreach($rastreio_attrib as $history)
										{
											foreach($tblParseado as $ch => $tbl)
											{
												if(strtotime($history['date_added']) == strtotime($tbl['data']))
												{
													unset($tblParseado[$ch]);
												}
											}
										}

										if(count($tblParseado))
										{
											$data = array();
											$current = current($tblParseado);
											if(count($tblParseado) == 1 && stristr($current['descricao'], "postado"))
											{ // postado
												$data['order_status_id'] = $this->config->get("mod_rastreio_order_status_posted");
												$current['descricao'] = sprintf($this->language->get('text_tracking_code'), $rastreio, $urlRastreio);
												$tblParseado[key($tblParseado)] = $current;
											}
											else
											{ // atualizando status
												$data['order_status_id'] = $order['order_status_id'];
											}
											
											$data['date_modified'] = $ultimoStatus['data'];
											$data['order_id'] = $order['order_id'];
											$data['statuses'] = $tblParseado;
											$this->updateOrder($order['order_id'], $data, $rastreio);
											$notificar = true;
										}
									}
								}
								else
								{ // NÃO FOI ENTREGUE AINDA
									//$getHistorys = $this->getHistory($order['order_id']);
									//foreach($getHistorys as $history)
									foreach($rastreio_attrib as $history)
									{
										foreach($tblParseado as $ch => $tbl)
										{
											if(strtotime($history['date_added']) == strtotime($tbl['data']))
											{
												unset($tblParseado[$ch]);
											}
										}
									}

									if(count($tblParseado))
									{
										$current = current($tblParseado);
										if(count($tblParseado) == 1 && stristr($current['descricao'], "postado"))
										{ // postado
											$data['order_status_id'] = $this->config->get("mod_rastreio_order_status_posted");
											$current['descricao'] = sprintf($this->language->get('text_tracking_code'), $rastreio, $urlRastreio);
											$tblParseado[key($tblParseado)] = $current;
											$start_notify = true;
										}
										else
										{ // atualizando status
											$data['order_status_id'] = $order['order_status_id'];
										}
										
										$data['date_modified'] = $ultimoStatus['data'];
										$data['order_id'] = $order['order_id'];
										$data['statuses'] = $tblParseado;
										$this->updateOrder($order['order_id'], $data, $rastreio);
										$notificar = true;
									}
								}
							}
							
							$get_products = $this->get_products();
							$latest = isset($get_products[0]) ? $get_products[0] : '';
							$bestseller = isset($get_products[1]) ? $get_products[1] : '';
							$featured = isset($get_products[2]) ? $get_products[2] : '';

							if($notificar)
							{
								$number_order = $order["order_id"];
								$url_order = $order["store_url"].'index.php?route=account/order/info&order_id='.$order["order_id"];
								$urlRastreio = 'http://websro.correios.com.br/sro_bin/txect01$.QueryList?P_LINGUA=001&P_TIPO=001&P_COD_UNI='.$rastreio;
								
								if(empty($html))
								{
									$search = array(
										'%name_user%',
										'%number_order%',
										'%url_order%',
										'%number_tracker%',
										'%tracker_status%',
										'%date_tracker_status%',
										'%url_tracker%',
										'%table_tracker%',
										'%divider_msg%',
										'%latest%',
										'%bestseller%',
										'%featured%'
									);
									
									$replace = array(
										$order["firstname"],
										$number_order,
										$url_order,
										$rastreio,
										$ultimoStatus["descricao"],
										date("d/m/Y H:i:s", strtotime($ultimoStatus["data"])),
										$urlRastreio,
										$tabela,
										"<br ><hr /><br />",
										$latest,
										$bestseller,
										$featured
									);
								}
								else
								{
									$search = array(
										'%name_user%',
										'%number_order%',
										'%url_order%',
										'%number_tracker%',
										'%tracker_status%',
										'%date_tracker_status%',
										'%url_tracker%',
										'%table_tracker%',
										'%latest%',
										'%bestseller%',
										'%featured%'
									);
									
									$replace = array(
										'',
										'',
										'',
										$rastreio,
										$ultimoStatus["descricao"],
										date("d/m/Y H:i:s", strtotime($ultimoStatus["data"])),
										$urlRastreio,
										$tabela,
										$latest,
										$bestseller,
										$featured
									);							
								}
								
								if($final_notify)
								{
									$msg_email = $this->config->get("mod_rastreio_msg_email_final");
								}
								else
								{
									$msg_email = $this->config->get("mod_rastreio_msg_email");
								}
								
								//if(!empty($html) && stristr($this->config->get("mod_rastreio_msg_email"), "%divider_msg%"))
								if(!empty($html) && stristr($msg_email, "%divider_msg%"))
								{
									//$msgEmail = explode("%divider_msg%", $this->config->get("mod_rastreio_msg_email"));
									$msgEmail = explode("%divider_msg%", $msg_email);
									if(count($msgEmail) > 1)
									{
										$msgEmail = $msgEmail[1];
									}
									else
									{
										//$msgEmail = $this->config->get("mod_rastreio_msg_email");
										$msgEmail = $msg_email;
									}
								}
								else
								{
									//$msgEmail = $this->config->get("mod_rastreio_msg_email");
									$msgEmail = $msg_email;
								}

								$html .= str_replace($search, $replace, $msgEmail)."<br /><hr /><br />";
								$text .= strip_tags($html)."\r\n\r\n";
							}
						}
					}
				}
			}
			
			// [ se for somente para notificar inicio e fim e esse não for o último eu desativo a notificação
			//if($this->config->get("mod_rastreio_notify_start_end") && !$final_notify)
			if($this->config->get("mod_rastreio_notify_start_end"))
			{
				if(!$start_notify && !$final_notify)
				{
					$notificar = false;
				}
			}
			// ]
			
			if($notificar)
			{
				//$mail = new Mail($this->config->get('config_mail'));
				$mail = new Mail;
				$mail->setTo($order['email']);				
				$mail->setFrom($this->config->get('config_email'));
				$mail->setSender($order["store_name"]);
				$mail->setSubject(html_entity_decode($order["store_name"].' - Rastreamento de Objetos', ENT_QUOTES, 'UTF-8'));
				$mail->setHtml(html_entity_decode($html, ENT_QUOTES, 'UTF-8'));
				$mail->setText(html_entity_decode($text, ENT_QUOTES, 'UTF-8'));
				$mail->send();
				
				if($this->config->get("mod_rastreio_copy_email_admin"))
				{
					$mail->setTo($this->config->get('config_email'));
					$mail->send();
				}
				
				$countUsersNotify++;
			}
		}

		return $countUsersNotify;
	}
	
	private function get_products()
	{
		$this->load->library('simple_html_dom');
		$layout_id = $this->config->get('config_layout_id');
		
		$mod_rastreio = $this->config->get('mod_rastreio');
		
		$module_data = array();
		if(isset($mod_rastreio['products']['latest_product']) && $mod_rastreio['products']['latest_product']['status'])
		{
			$module_data[] = array(
				'code' => 'latest',
				'setting' => $mod_rastreio['products']['latest_product'],
			);
		}
		
		if(isset($mod_rastreio['products']['bestseller_product']) && $mod_rastreio['products']['bestseller_product']['status'])
		{
			$module_data[] = array(
				'code' => 'bestseller',
				'setting' => $mod_rastreio['products']['bestseller_product'],
			);
		}
		
		if(isset($mod_rastreio['products']['featured_product']) && $mod_rastreio['products']['featured_product']['status'])
		{
			$module_data[] = array(
				'code' => 'featured',
				'setting' => $mod_rastreio['products']['featured_product'],
			);
		}
		
		$this->data['modules'] = array();
		foreach($module_data as $module)
		{
			$module_result = $this->getChild('module/' . $module['code'], $module['setting']);

			if($module_result)
			{
				$dom_html = str_get_html($module_result);
				foreach($dom_html->find('.button-group') as $button)
				{
					$button->outertext = '';
				}

				$this->data['modules'][] = $dom_html;
			}
		}
		
		$html = implode('<br /><||dividerproduct||/><div style="clear: both"></div>', $this->data['modules']);
		
		/*
		$html = str_replace('class="box"', 'style="margin-bottom: 20px;"', $html);
		$html = str_replace('class="box-heading"', 'style="-webkit-border-radius: 7px 7px 0px 0px;
			-moz-border-radius: 7px 7px 0px 0px;
			-khtml-border-radius: 7px 7px 0px 0px;
			border-radius: 7px 7px 0px 0px;
			border: 1px solid #DBDEE1;
			background: #F1F1F1;
			padding: 8px 10px 7px 10px;
			font-family: Arial, Helvetica, sans-serif;
			font-size: 14px;
			font-weight: bold;
			line-height: 14px;
			color: #333;"', $html);
		$html = str_replace('class="box-content"', 'style="background-color: #FFFFFF;
			-webkit-border-radius: 0px 0px 7px 7px;
			-moz-border-radius: 0px 0px 7px 7px;
			-khtml-border-radius: 0px 0px 7px 7px;
			border-radius: 0px 0px 7px 7px;
			border-left: 1px solid #DBDEE1;
			border-right: 1px solid #DBDEE1;
			border-bottom: 1px solid #DBDEE1;
			padding: 10px;"', $html);
		$html = str_replace('class="box-product"', 'style="width: 100%;
			overflow: auto;"', $html);
		$html = str_replace('<div>', '<div style="width: 130px;
			display: inline-block;
			vertical-align: top;
			margin-right: 20px;
			margin-bottom: 20px;">', $html);
			*/
		$html = str_replace('class="row"', 'style="margin-bottom: 40px; background-color: #FFFFFF;
			-webkit-border-radius: 0px 0px 7px 7px;
			-moz-border-radius: 0px 0px 7px 7px;
			-khtml-border-radius: 0px 0px 7px 7px;
			border-radius: 0px 0px 7px 7px;
			border-left: 1px solid #DBDEE1;
			border-right: 1px solid #DBDEE1;
			border-bottom: 1px solid #DBDEE1;
			padding: 10px; width: 97%; float: left"', $html);
		$html = str_replace('<h3>', '<div style="-webkit-border-radius: 7px 7px 0px 0px;
			-moz-border-radius: 7px 7px 0px 0px;
			-khtml-border-radius: 7px 7px 0px 0px;
			border-radius: 7px 7px 0px 0px;
			border: 1px solid #DBDEE1;
			background: #F1F1F1;
			padding: 8px 10px 7px 10px;
			font-family: Arial, Helvetica, sans-serif;
			font-size: 14px;
			font-weight: bold;
			line-height: 14px;
			color: #333;">', $html);
		$html = str_replace('</h3>', '</div>', $html);
		$html = str_replace('class="product-thumb transition"', 'style="text-align: center; border: 1px solid #DBDEE1; margin-right: 10px; margin-bottom: 10px; width: 210px; height: 390px; float: left; padding: 5px;"', $html);
		$html = str_replace('<div class="caption">', '<div style="width: 130px;
			display: inline-block;
			vertical-align: top;
			margin-right: 20px;
			margin-bottom: 20px;">', $html);
		$html = str_replace('class="image"', 'style="display: block;
			margin-bottom: 0px;"', $html);
		$html = str_replace('<img src=', '<img style="padding: 3px;
			border: 1px solid #E7E7E7;" src=', $html);
		$html = str_replace('<a href=', '<a style="color: #38B0E3;
			font-weight: bold;
			text-decoration: none;
			display: block;
			margin-bottom: 4px;
			text-align: center;" href=', $html);
		$html = str_replace('class="price"', 'style="display: block;
			font-weight: bold;
			color: #333333;
			margin-bottom: 4px;
			text-align: center;"', $html);
		$html = str_replace('class="price-old"', 'style="color: #F00;
			text-decoration: line-through;"', $html);
		$html = str_replace('class="price-new"', 'style="font-weight: bold;"', $html);
		$html = str_replace('<span class="price-tax">', '<br /><span class="price-tax" style="font-weight: normal;">', $html);
		$html = str_replace('class="rating"', 'style="display: block;
			margin-bottom: 4px;
			text-align: center;"', $html);
		$html = str_replace('admin/', '', $html);
		$html = str_replace('src="catalog/', 'src="'.HTTP_SERVER.'catalog/', $html);
		$html = str_replace('data-original', 'src', $html);
		
		$html = explode('<||dividerproduct||/>', $html);

		return $html;
	}
	
	private function getChild($route, $args = array())
	{
		$action = new Action($route, $args);
		
		//*
		
		if(file_exists($action->file))
		{
			include_once(modification($action->file));

			$class = $action->class;

			$controller = new $class($this->registry);

			$output = $controller->init($action->args);

			
			return $output;
		}
		//*/
	}
}
?>