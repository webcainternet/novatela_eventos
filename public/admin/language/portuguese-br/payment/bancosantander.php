<?php
// Heading
$_['heading_title']      = 'Boleto Banco Santander';


// Text
$_['text_payment']       = 'Pagamento';
$_['text_success']       = 'Sucesso: Dados do módulo foram salvos com sucesso!';
$_['text_edit']                 = 'Editar o Boleto Banco Santander';
$_['text_bancosantander'] 	 = '<a onclick="window.open(\'http://www.Santander.com.br/\');"><img src="view/image/boleto/boleto_santander.png" alt="Boleto Banco Santander" title="Boleto Banco Santader" style="border: 1px solid #EEEEEE;" /></a>';


// Entry
$_['entry_nome']   = 'Nome do Módulo:';
$_['help_nome']   = 'Nome que será mostrado ao cliente na lista de meios de pagamento.';
$_['error_nome']   = 'Nome do Módulo é um campo obrigatório!';

$_['entry_cedente']   = 'Identificação de Cedente:';
$_['help_cedente']   = 'Nome ou Razão Social.';
$_['error_cedente']   = 'Identificação de Cedente é um campo obrigatório!';

$_['entry_cpfcnpj']   = 'CPF/CNPJ:';
$_['help_cpfcnpj']   = 'Número do CPF ou CNPJ do logista.';
$_['error_cpfcnpj']   = 'CPF/CNPJ é um campo obrigatório!';

$_['entry_endereco']   = 'Endereço do Cedente:';
$_['help_endereco']   = 'Endereço da loja (rua, numero, bairro, cidade, estado, CEP, etc...';
$_['error_endereco']   = 'Endereço do Cedente é um campo obrigatório!';

$_['entry_cliente']   = 'Cliente:';
$_['help_cliente']   = 'Código do Cliente (PSK) (Somente 7 digitos).';
$_['error_cliente']   = 'Cliente é um campo obrigatório!';

$_['entry_venda']   = 'Ponto de Venda:';
$_['help_venda']   = 'Ponto de Venda = Agência.';
$_['error_venda']   = 'Ponto de Venda é um campo obrigatório!';

$_['entry_taxa']   = 'Taxa do Boleto:';
$_['help_taxa']   = 'Taxa do Boleto caso seja cobrada.';

$_['entry_dias']   = 'Dias para o Vencimento:';
$_['help_dias']   = 'Número de dias para o vencimento.';
$_['error_dias']   = 'Dias para o Vencimento é um compo obrigatório!';

$_['help_demo']   = 'Dados complementares ao conteúdo do boleto.';
$_['entry_demo1']   = 'Demostrativo 01:';
$_['entry_demo2']   = 'Demostrativo 02:';
$_['entry_demo3']   = 'Demostrativo 03:';

$_['help_ins']   = 'Instruções para o boleto, juros, etc...';
$_['entry_ins1']   = 'Instruções 01:';
$_['entry_ins2']   = 'Instruções 02:';
$_['entry_ins3']   = 'Instruções 03:';
$_['entry_ins4']   = 'Instruções 04:';


$_['entry_total']        = 'Valor Mínimo:';
$_['help_total']        = 'O valor mínimo que um pedido deverá ter para ser aplicado a este módulo de pagamento.';

$_['entry_order_status'] = 'Status Padrão:';
$_['help_order_status'] = 'Status padrão que os pedidos serão criados.';

$_['entry_geo_zone']     = 'Zona:';
$_['help_geo_zone']     = 'Zona de limite de uso deste módulo.';

$_['entry_status']       = 'Status:';
$_['help_status']       = 'Hábilitar ou desabilitar o módulo na loja.';

$_['entry_sort_order']   = 'Ordem:';
$_['help_sort_order']   = 'Ordem de aparecimento na lista de formas de pagamentos na loja.';

// Error
$_['error_permission']   = 'Você não tem permissão para editar este módulo!';
?>