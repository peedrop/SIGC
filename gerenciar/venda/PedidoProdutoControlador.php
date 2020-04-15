<?php

	require_once '../../class/PedidoProdutoDAO.php';
    $pedidoProdutoDAO = new PedidoProdutoDAO();
	$pedidoDAO = new PedidoDAO();
	$produtoDAO = new ProdutoDAO();
	

	$operacao = $_GET["operacao"];

	switch($operacao) 
	{
        case 'salvar':
           
			$pedidoProduto = new PedidoProduto();

			$pedido = $pedidoDAO->buscarPorId($_POST["idPedido"]);
			$produto = $produtoDAO->buscarPorId($_POST["idProduto"]);
            
            $idProduto = $_POST["idProduto"];
            $quantidade = $_POST["quantidade"];
            
            if ($quantidade <= $produto->getQuantidade()){
                $pedidoProduto->setPedido($pedido);
                $pedidoProduto->setProduto($produto);
                $pedidoProduto->setQuantidade($quantidade);

                $qtd = $_POST["quantidade"];
                $valor = $produto->getValor();
                $total = $qtd * $valor;
                $pedidoProduto->setValor($total);

                $resultado = $pedidoProdutoDAO->salvar($pedidoProduto);

                $valorTotal = $pedidoDAO->buscarValorIdPedido($pedido->getIdPedido());

                $pedidoDAO->atualizarPrecoTotal($valorTotal, $pedido->getIdPedido());
            }else{
                echo "<script>alert('Quantidade insuficiente. Disponível: {$produto->getQuantidade()} peças'); location.href='FormularioVenda.php?operacao=editar&idPedido={$_POST["idPedido"]}';</script>"; 
            }
			if($resultado == 1){
                $resultadoProduto = $produtoDAO->atualizarQuantidadePorId($idProduto, $quantidade);
				if($resultadoProduto)
				    echo "<script>location.href='FormularioVenda.php?operacao=editar&idPedido={$_POST["idPedido"]}';</script>"; 
			}else{
				echo "<script>alert('Erro ao salvar o registro'); location.href='FormularioVenda.php?operacao=editar&idPedido={$_POST["idPedido"]}';</script>"; 			
			}

        	break; 

        case 'excluir':
			
			$idPedido = $_GET["idPedido"];
			$resultado = $pedidoProdutoDAO->excluirPorId($_GET["idPedidoProduto"]);

			if($resultado == 1){
				echo "<script>alert('Registro excluido com sucesso !!!'); location.href='FormularioVenda.php?operacao=editar&idPedido={$idPedido}';</script>"; 
			}else{
				echo "<script>alert('Erro ao excluir o registro'); location.href='FormularioVenda.php?operacao=editar&idPedido={$idPedido}';</script>"; 			
			}			
        	break;         	
	}
			
?>
