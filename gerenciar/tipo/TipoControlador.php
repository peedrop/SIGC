<?php

	require_once '../../class/TipoDAO.php';
	$tipoDAO = new TipoDAO();
	$tipo = new Tipo();

	$operacao = $_GET["operacao"];

	switch($operacao) 
	{
        case 'salvar':
            
			$tipo->setIdTipo($_POST["idTipo"]);
			$tipo->setNome($_POST["nome"]);
            $resultado = $tipoDAO->salvar($tipo);
            
                if($resultado == 1){
				echo "<script>alert('Registro salvo com sucesso !!!'); location.href='TabelaTipo.php';</script>"; 
                }else{
                    echo "<script>alert('Erro ao salvar o registro'); location.href='TabelaTipo.php';</script>"; 			
                }

        	break; 

        case 'excluir':
			$tipo = $tipoDAO->buscarPorId($_GET["idTipo"]);
            
            $resultado = $tipoDAO->excluirPorId($_GET["idTipo"]);
            
            if($resultado == 1){
                    echo "<script>alert('Registro excluido com sucesso !!!'); location.href='TabelaTipo.php';</script>"; 
            }
            else{
                echo "<script>alert('Erro ao excluir o registro'); location.href='TabelaTipo.php';</script>"; 			
            }
           
            
        	break; 
	}
			
?>