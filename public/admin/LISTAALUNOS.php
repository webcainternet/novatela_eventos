<html>

<head>


<style type="text/css">
	.div1 {
		display: inline-block;
		width: 50%;
	}
	h1 {
		font-size: 14px;
	}
	h3 {
		font-size: 12px;
	}
</style>
</head>


<?php

//Conexão com o banco
	require "config.php";
	$mysqli = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
	if (mysqli_connect_errno()) { printf("Connect failed: %s\n", mysqli_connect_error()); exit(); }

	//Consulta
	$sql = utf8_decode("SELECT op.order_product_id,  o.order_id,  op.product_id,  os.name as status,  ooname.value as nome,  op.name as curso,  oocpf.value as cpf,  ooemail.value as email,  oocelular.value as celular,  ooformacao.value as formacao  FROM oc_order o  inner join oc_order_product op  ON o.order_id = op.order_id  inner join oc_order_option ooname  ON op.order_product_id = ooname.order_product_id inner join oc_order_option oocpf  ON op.order_product_id = oocpf.order_product_id inner join oc_order_option ooemail  ON op.order_product_id = ooemail.order_product_id inner join oc_order_option oocelular  ON op.order_product_id = oocelular.order_product_id inner join oc_order_option ooformacao  ON op.order_product_id = ooformacao.order_product_id inner join oc_order_status os  ON o.order_status_id = os.order_status_id  WHERE ooname.name = 'Nome Completo' AND oocpf.name = 'CPF'  AND ooemail.name = 'E-Mail'  AND oocelular.name = 'Celular'  AND ooformacao.name = 'Formação' AND product_id = ".$_GET["product_id"]." ORDER BY nome");


	if ($result = $mysqli->query($sql)) { 

		$row_cnt = $result->num_rows;

		if ($row_cnt > 0) {

			echo "<table border=1><tr>";
	    	echo "<td>order_product_id</td>";
	    	echo "<td>order_id</td>";
	    	echo "<td>product_id</td>";
	    	echo "<td>status</td>";
	    	echo "<td>nome</td>";
	    	echo "<td>curso</td>";
	    	echo "<td>cpf</td>";
	    	echo "<td>email</td>";
	    	echo "<td>celular</td>";
	    	echo "<td>formacao</td>";
	    	echo "</tr>";

	        while($obj = $result->fetch_object()){
	        	echo "<tr>";
	        	echo "<td>".$obj->order_product_id."</td>";
	        	echo "<td>".$obj->order_id."</td>";
	        	echo "<td>".$obj->product_id."</td>";
	        	echo "<td>".$obj->status."</td>";
	        	echo "<td>".$obj->nome."</td>";
	        	echo "<td>".$obj->curso."</td>";
	        	echo "<td>".$obj->cpf."</td>";
	        	echo "<td>".$obj->email."</td>";
	        	echo "<td>".$obj->celular."</td>";
	        	echo "<td>".$obj->formacao."</td>";
	        	echo "</tr>";
			}
			echo "</table>";
		} else {
			echo "Sem inscri&ccedil;&otilde;es at&eacute; o momento!";
		}
	}
?>
