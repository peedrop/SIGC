<?php

	require_once '../../class/PedidoDAO.php';
	require_once '../../class/ClienteDAO.php';
    require_once '../../class/PedidoProdutoDAO.php';
	$pedidoDAO = new PedidoDAO();
	$clienteDAO = new ClienteDAO();	
    $pedidoProdutoDAO = new PedidoProdutoDAO();	

	$operacao = $_GET["operacao"];

	switch($operacao) 
	{
        case 'salvar':
			$pedido = new Pedido();
			$pedido->setIdPedido($_POST["idPedido"]);			
			$cliente = $clienteDAO->buscarPorId($_POST["idCliente"]);			
			$pedido->setCliente($cliente);	
            
            $pedido->setDataPedido($_POST["dataPedido"]);
            $pedido->setHoraPedido($_POST["horaPedido"]);
            $pedido->setFormaPagamento($_POST["formaPagamento"]);
            $pedido->setParcelas($_POST["parcelas"]);
            $pedido->setValor($_POST["valor"]);

			$resultado = $pedidoDAO->salvar($pedido);

			if(isset($_POST["salvar"])){		
				$pagina = "FormularioVenda.php?operacao=editar&idPedido={$pedido->getIdPedido()}";
			}else{
				if(isset($_POST["salvarVoltar"])){
					$pagina = "TabelaVenda.php";
				}			
			}

			if($resultado == 1){
				echo "<script>alert('Registro salvo com sucesso !!!'); location.href='{$pagina}';</script>"; 
			}else{
				echo "<script>alert('Erro ao salvar o registro'); location.href='{$pagina}';</script>"; 			
			}
			

        	break; 

        case 'excluir':
        
			$rs = 1;
            $lista = $pedidoProdutoDAO->listarPorPedido($_GET["idPedido"]);
           
            foreach($lista as $pedidoProduto){	
                if ($pedidoProduto->getPedido()->getIdPedido() == $_GET["idPedido"]){
                    $idPedidoProduto = $pedidoProduto->getIdPedidoProduto();
                    $rs = $pedidoProdutoDAO->excluirPorId($idPedidoProduto);
                }
            }
            if ($rs == 1){    
			     $resultado = $pedidoDAO->excluirPorId($_GET["idPedido"]);
            
                if($resultado == 1){
                    echo "<script>alert('Registro excluido com sucesso !!!'); location.href='TabelaVenda.php';</script>"; 
                }else{
                    echo "<script>alert('Erro ao excluir o registro'); location.href='TabelaVenda.php';</script>"; 			
                }
            }
        	break;     

	}
			
?>
