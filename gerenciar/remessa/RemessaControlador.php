<?php

	require_once '../../class/RemessaDAO.php';
    require_once '../../class/ProdutoDAO.php';
	$remessaDAO = new RemessaDAO();
	$remessa = new Remessa();
    $produtoDAO = new ProdutoDAO();
	$produto = new Produto();

	$operacao = $_GET["operacao"];

	switch($operacao) 
	{
        case 'salvar':
            $idProd = $_POST["idProduto"];
            $valor = $_POST["precoVarejo"];
            $qnt = $_POST["quantidade"];
            $idRem = $_POST["idRemessa"];
			$remessa->setIdRemessa($_POST["idRemessa"]);
			$remessa->setIdProduto($_POST["idProduto"]);
            $remessa->setPrecoCusto($_POST["precoCusto"]);
            $remessa->setPrecoVarejo($_POST["precoVarejo"]); //PASSAR PARA PROD
            $remessa->setQuantidade($_POST["quantidade"]);  //PASSAR PARA PROD
            $remessa->setDataRemessa($_POST["dataRemessa"]); 
            
            $resultado = $remessaDAO->salvar($remessa);
		
			if($resultado == 1){
				$resultadoProduto = $produtoDAO->atualizarProduto($remessa);
				if($resultadoProduto)
					echo "<script>alert('Registro salvo com sucesso !!!'); location.href='TabelaRemessa.php';</script>";
			}else{
				echo "<script>alert('Erro ao salvar o registro'); location.href='TabelaRemessa.php';</script>"; 
			}

        	break; 

        case 'excluir':
            
            $resultado = $remessaDAO->excluirPorId($_GET["idRemessa"]);
            
            if($resultado == 1){
                    echo "<script>alert('Registro excluido com sucesso !!!'); location.href='TabelaRemessa.php';</script>"; 
            }
            else{
                echo "<script>alert('Erro ao excluir o registro'); location.href='TabelaRemessa.php';</script>"; 			
            }
           
            
        	break; 
	}
			
?>
