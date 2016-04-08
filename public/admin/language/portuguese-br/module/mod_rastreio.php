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
$_['heading_title_text']			= 'Correios - Rastrear Encomendas';
$_['text_module']					= 'Módulos';


$_['button_save_edit']				= 'Salvar e Editar';

// Text
$_['text_user_notify']				= 'Notificar usuário quando código de rastreio for cadastrado';
$_['text_mod_rastreio_copy_email_admin'] = 'Enviar cópia do email para o Administrador';
$_['text_mod_rastreio_show_count_time'] = 'Exibir contador de dias';
$_['text_hidden_code']				= 'Ocultar código de rastreio após cadastro';
$_['text_show_cep']					= 'Mostrar CEP acima do código de rastreio cadastrado';
$_['text_include_status_history']	= 'Incluir status de rastreamento no histórico do pedido';
$_['text_notify_start_end']			= 'Notificar somente início e fim';
$_['text_order_status_post']		= 'Quando código de rastreio for cadastrado, mudar status do pedido para';
$_['text_order_status_final']		= 'Status quando a mercadoria for entregue';
$_['text_set_status_notify']		= 'Selecione em quais status o rastreamento deve ser acompanhado';
$_['text_success']					= 'Configurações salvas com sucesso';
$_['text_url_cron']					= 'Habilite o Cron de seu servidor nesta URL';
$_['text_status']					= 'Status';
$_['text_action']					= 'Ação';
$_['text_no_action']				= 'Nenhuma Ação';
$_['text_only_shipping_select']		= 'Habilitar Cadastro de códigos';
$_['text_any_shipping']				= 'Qualquer Módulo';
$_['text_notify_cad_cod']			= '%s seu pedido %s foi postado com sucesso, utilize este código: <b>%s</b> para rastrea-lo nos correios ou acesse essa url %s para rastrea-lo.';
$_['text_email_subject']			= "%s - rastreamento de objetos nos correios";
$_['text_tracking_code']			= "Pedido postado com sucesso, use o seguinte código <b>%s</b> para rastrea-lo ou acesse o seguinte link %s";
$_['text_insert_tracking_code']		= "Códigos(s) de rastreamento inserido(s) com sucesso";
$_['text_user_notify_success']		= "Código(s) de rastreamento inserido(s) com sucesso. <br />%d usuário(s) notificado(s) com sucesso";
$_['text_checking_update_text']		= 'Verificando se existem novas atualizações';
$_['text_msg_email']				= 'Mensagem de Email. Inclua na mensagem os seguintes códigos para:';
$_['text_msg_email_registered']		= 'Mensagem de Email quando postado. Inclua na mensagem os seguintes códigos para:';
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

$_['text_msg_email_final']			= 'Mensagem de email quando a entrega for completada';

// help
$_['text_hidden_code_help']			= 'O campo para cadastro do código será removido e só será possível alterar os códigos através do painel contido dentro de cada pedido';
$_['text_only_shipping_select_help']= 'Só habilitar o cadastro de códigos no pedido se estiver usando essa forma de envio';
$_['text_show_cep_help']			= 'Acima do código de rastreio cadastrado será mostrado o CEP de destino do pedido';
$_['text_include_status_history_help']	= 'O rastreamento será incluído no histórico do pedido';
$_['text_notify_start_end_help']	= 'Irá notificar o cliente somente quando o código for cadastrado e quando o pedido for entregue';
$_['text_order_status_post_help']	= 'recomendamos que mude para algum que indique a postagem';
$_['text_set_status_notify_help']	= 'Exemplo: despachado, pendente, processando';
$_['text_order_status_final_help']	= 'Para qual status o pedido deve avançar quando a mercadoria for entregue no cliente. Recomendamos que seja diferente dos status definidos acima';
$_['text_msg_email_help']			= 'Use o editor para compor a mensagem de email que será enviada para informar ao usuário';
$_['text_msg_email_registered_help']	= 'Essa mensagem será enviada ao cliente para informar que o produto foi postado, porém ainda não encontra-se disponível no site dos correios para rastreamento';
$_['text_msg_email_help1']			= 'será substituido pelo nome do usuário';
$_['text_msg_email_help2']			= 'será substituido pelo número do pedido';
$_['text_msg_email_help3']			= 'será substituido por link para visualizar o pedido';
$_['text_msg_email_help4']			= 'será substituido pelo número do código de rastreio';
$_['text_msg_email_help5']			= 'será substituido pela data atual do status nos correios.';
$_['text_msg_email_help6']			= 'será substituido pela tabela de rastreamento dos correios';
$_['text_msg_email_help7']			= 'será substituido pelo status atual do objeto nos correios';
$_['text_msg_email_help8']			= 'utilize para separar a mensagem principal dos status caso esteja cadastrando mais de um código por pedido. name_user, number_order, url_order não serão considerados abaixo de divider_msg';
$_['text_msg_email_help9']			= 'será substituido pelos últimos produtos da loja';
$_['text_msg_email_help10']			= 'será substituido pelos produtos mais vendidos da loja';
$_['text_msg_email_help11']			= 'será substituido pelos produtos selecionados';
$_['text_msg_email_help12']			= 'será substituida pela url de rastreio do objeto nos correios';
$_['text_msg_email_final_help']		= 'Ideal para mandar algum produto e/ou uma mensagem solicitando algum tipo de qualificação';



$_['text_tab_general']				= 'Geral';
$_['text_tab_etiqueta']				= 'Etiquetas';
$_['text_tab_products']				= 'Produtos';
$_['text_tab_simulate']				= 'Simular';
$_['text_tab_support']				= 'Suporte';

$_['text_etiqueta_name']				= 'Nome:';
$_['text_etiqueta_company']			= 'Empresa:';
$_['text_etiqueta_phone']			= 'Telefone:';
$_['text_etiqueta_cep']				= 'CEP:';
$_['text_etiqueta_address']			= 'Endereço:';
$_['text_etiqueta_number']			= 'Número:';
$_['text_etiqueta_address2']			= 'Bairro';
$_['text_etiqueta_complement']		= 'Complemento:';
$_['text_etiqueta_city']				= 'Cidade:';
$_['text_etiqueta_state']			= 'Estado:';
$_['text_chancela_pac']				= 'Chancela PAC:';
$_['text_chancela_sedex']			= 'Chancela SEDEX:';
$_['text_select']					= 'Selecionar';
$_['text_remove']					= 'Remover';

$_['text_support']					= '<h3>Contato</h3><hr>O suporte será fornecido conforme os termos da licença que aceitou ao adquiri-lo. O termo pode ser visualizado em <a href="http://comerciobr.com/informacao/termos-e-condicoes" target="_blank">http://comerciobr.com/informacao/termos-e-condicoes</a>  <br /><br />O suporte só será prestado quando fornecer: <ul><li>nome da loja onde comprou o módulo</li><li>número da compra</li><li>nome usado na compra</li><li>email usado na compra</li><li>domínio(s) para qual o módulo se destina</li></ul> <br /><br /> <p>Cristiano Soares<br /><a href="mailto:contato@comerciobr.com" target="_blank">contato@comerciobr.com</a><br />facebook: <a href="http://fb.com/crisnao2" target="_blank">http://fb.com/crisnao2</a><br />skype: <a href="skype://crisnao2">crisnao2</a><br />+55 21 97498-1126 (claro) e WhatApp</p>';


$_['text_enabled']					= 'Habilitado';
$_['text_disabled']					= 'Desabilitado';
$_['text_latest']					= 'Novos Produtos';
$_['text_bestseller']				= 'Mais Vendidos';
$_['text_featured_product']			= 'Produtos em Destaque';
$_['entry_limit']					= 'Limite';
$_['entry_width']					= 'Largura';
$_['entry_height']					= 'Altura';
$_['entry_status']					= 'Situação';

$_['entry_code_simulate']			= 'Entre com o código para simulação';
$_['text_warning_simulate']			= '<div class="warning">Antes de efetuar a simulação, salve qualquer alteração que tenha feito no módulo para simular com as novas configurações.</div>';

// Error
$_['error_permission']				= 'Atenção: Você não possui permissão para modificar este módulo';
$_['error_message_not_defined']		= '<span class="error">É necessário configurar a mensagem de email no módulo, <a href="%s">clique aqui</a> para configurar agora.</span>';
$_['error_simulate_failed']			= 'Não foi possível efetuar a simulação no momento.';

?>