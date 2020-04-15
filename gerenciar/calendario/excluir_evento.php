<?php

	require_once '../../class/EventoDAO.php';
	$eventoDAO = new EventoDAO();

	$operacao = $_GET["operacao"];

	switch($operacao) 
	{
        case 'excluirPassados':
            date_default_timezone_set('America/Sao_Paulo');
            $date = date('Y-m-d');
            
            $lista = $eventoDAO->listar();
            
            $resultado = 0;
            foreach($lista as $evento){
                if ($evento->getStart() < $date){
                    $resultado = $eventoDAO->excluirPorId($evento->getId());
                }
            }

			if($resultado == 1){
				echo "<script>alert('Eventos excluidos com sucesso!'); location.href='Calendario.php';</script>"; 
			}else{
				echo "<script>alert('Erro ao excluir!'); location.href='Calendario.php';</script>"; 			
			}

        	break; 

        case 'excluir':
            $resultado = $eventoDAO->excluirPorId($_GET["id"]);

			if($resultado == 1){
				echo "<script>alert('Registro excluido com sucesso !!!'); location.href='Calendario.php';</script>"; 
			}else{
				echo "<script>alert('Erro ao excluir o registro'); location.href='Calendario.php';</script>"; 			
			}			
        	break;  
        
	}
			
?>
