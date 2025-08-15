<?php 
	require_once("config.php");

	date_default_timezone_set('America/Sao_Paulo');

	try {
		$pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha"); 
		
	} catch (Exception $e) {
		echo "<h2>Não foi possível conectar e autenticar no banco de dados</h2>
		<p>".$e ."</p>";
	}

	
 ?>