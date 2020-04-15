<?php

	require_once '../../class/ProdutoDAO.php';
	$produtoDAO = new ProdutoDAO();
	$produto = new Produto();

	$operacao = $_GET["operacao"];

	switch($operacao) 
	{
        case 'salvar':
            
			$produto->setIdProduto($_POST["idProduto"]);
			$produto->setNome($_POST["nome"]);
            $produto->setIdTipo($_POST["idTipo"]);
            $produto->setIdMarca($_POST["idMarca"]);
            $produto->setEstoqueMin($_POST["estoqueMin"]);
            $produto->setDescricao($_POST["descricao"]);
            $produto->setQuantidade($_POST["quantidade"]);
            $produto->setValor($_POST["valor"]);
            
            $resultado = $produtoDAO->salvar($produto);
            
                if($resultado == 1){
				echo "<script>alert('Registro salvo com sucesso !!!'); location.href='TabelaProduto.php';</script>"; 
                }else{
                    echo "<script>alert('Erro ao salvar o registro'); location.href='TabelaProduto.php';</script>"; 			
                }

        	break; 

        case 'excluir':
			$produto = $produtoDAO->buscarPorId($_GET["idProduto"]);
            
            $resultado = $produtoDAO->excluirPorId($_GET["idProduto"]);
            
            if($resultado == 1){
                    echo "<script>alert('Registro excluido com sucesso !!!'); location.href='TabelaProduto.php';</script>"; 
            }
            else{
                echo "<script>alert('Erro ao excluir o registro'); location.href='TabelaProduto.php';</script>"; 			
            }
           
            
        	break; 
	}
			
?>
