<?php

$hostname = 'localhost';
$username = 'id6898045_root';
$password = 'pptmg1';
$database = 'id6898045_sigc';
 
try {
    $conexao = new PDO("mysql:host=$hostname;dbname=$database", $username, $password,
	array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	    //echo 'Conexao efetuada com sucesso!';
    }
catch(PDOException $e)
    {
    	echo $e->getMessage();
    }
?>
