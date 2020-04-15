<?php

	require_once '../../class/MarcaDAO.php';
	$marcaDAO = new MarcaDAO();
	$marca = new Marca();

	$operacao = $_GET["operacao"];

	switch($operacao) 
	{
        case 'salvar':
            
			$marca->setIdMarca($_POST["idMarca"]);
			$marca->setNome($_POST["nome"]);
            $resultado = $marcaDAO->salvar($marca);
            
                if($resultado == 1){
				echo "<script>alert('Registro salvo com sucesso !!!'); location.href='TabelaMarca.php';</script>"; 
                }else{
                    echo "<script>alert('Erro ao salvar o registro'); location.href='TabelaMarca.php';</script>"; 			
                }

        	break; 

        case 'excluir':
			$marca = $marcaDAO->buscarPorId($_GET["idMarca"]);
            
            $resultado = $marcaDAO->excluirPorId($_GET["idMarca"]);
            
            if($resultado == 1){
                    echo "<script>alert('Registro excluido com sucesso !!!'); location.href='TabelaMarca.php';</script>"; 
            }
            else{
                echo "<script>alert('Erro ao excluir o registro'); location.href='TabelaMarca.php';</script>"; 			
            }
           
            
        	break; 
	}
			
?>