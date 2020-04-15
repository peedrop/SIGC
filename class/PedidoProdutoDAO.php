<?php	
	require_once 'PedidoDAO.php';	
	require_once 'ProdutoDAO.php';
	require_once 'PedidoProduto.php';

	class PedidoProdutoDAO
	{

		public function salvar($pedidoProduto){	
			$situacao = FALSE;
			try{
				
				if($pedidoProduto->getIdPedidoProduto()==0){

					$situacao = $this->incluir($pedidoProduto);

				}else{	
					$situacao = $this->atualizar($pedidoProduto);
				}

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}			

			return $situacao;
		}

		public function incluir($pedidoProduto){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	

				$sql = "INSERT INTO tbpedidoproduto(idPedido, idProduto, quantidade, valor) VALUES (:idPedido, :idProduto, :quantidade, :valor)";
				
				$run = $pdo->prepare($sql);
				$run->bindValue(':idPedido', $pedidoProduto->getPedido()->getIdPedido()); 
				$run->bindValue(':idProduto', $pedidoProduto->getProduto()->getIdProduto()); 
				$run->bindValue(':valor', $pedidoProduto->getValor()); 
				$run->bindValue(':quantidade', $pedidoProduto->getQuantidade()); 
	  			$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}

				$pedidoProduto->setIdPedidoProduto($pdo->lastInsertId());
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $situacao;
		}

		public function atualizar($pedidoProduto){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();
					
				$sql = "UPDATE tbpedidoproduto SET idPedido = :idPedido, idProduto = :idProduto, valor = :valor, quantidade = :quantidade WHERE idPedidoProduto = :idPedidoProduto";
				
				$run = $pdo->prepare($sql);
				$run->bindValue(':idPedidoProduto', $pedidoProduto->getIdPedidoProduto()); 
				$run->bindValue(':idPedido', $pedidoProduto->getPedido()->getIdPedido()); 
				$run->bindValue(':idProduto', $pedidoProduto->getProduto()->getIdProduto()); 
				$run->bindValue(':valor', $pedidoProduto->getValor()); 
				$run->bindValue(':quantidade', $pedidoProduto->getQuantidade()); 
	  			$run->execute(); 
			
				if($run->rowCount() > 0){
					$situacao = TRUE;
				}
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}			

			return $situacao;
		}						

		public function excluir($pedidoProduto){

			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	
					
				$sql = "DELETE FROM tbpedidoproduto WHERE idPedidoProduto = :idPedidoProduto";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idPedidoProduto', $pedidoProduto->getIdPedidoProduto());			
				$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}			

			return $situacao;

		}

		public function excluirPorId($codigo){

			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	
					
				$sql = "DELETE FROM tbpedidoproduto WHERE idPedidoProduto = :idPedidoProduto";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idPedidoProduto', $codigo);			
				$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}			

			return $situacao;

		}					
        public function listarAgrProd(){

			$objetos = array();	

			try{
				
				$pdo = Banco::conectar();
					
				$sql = "SELECT * FROM tbpedidoproduto GROUP BY idProduto";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();
				
				$pedidoDAO = new PedidoDAO();
				$produtoDAO = new ProdutoDAO();

				foreach ($resultado as $registro){

					$pedidoProduto = new PedidoProduto();

					$pedidoProduto->setIdPedidoProduto($registro['idPedidoProduto']);

					$pedido = $pedidoDAO->buscarPorId($registro['idPedido']);
					$pedidoProduto->setPedido($pedido);					

					$produto = $produtoDAO->buscarPorId($registro['idProduto']);
					$pedidoProduto->setProduto($produto);		

					$pedidoProduto->setValor($registro['valor']);
					$pedidoProduto->setQuantidade($registro['quantidade']);						
					array_push($objetos, $pedidoProduto);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $objetos;

		}
		public function listar(){

			$objetos = array();	

			try{
				
				$pdo = Banco::conectar();
					
				$sql = "SELECT * FROM tbpedidoproduto";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();
				
				$pedidoDAO = new PedidoDAO();
				$produtoDAO = new ProdutoDAO();

				foreach ($resultado as $registro){

					$pedidoProduto = new PedidoProduto();

					$pedidoProduto->setIdPedidoProduto($registro['idPedidoProduto']);

					$pedido = $pedidoDAO->buscarPorId($registro['idPedido']);
					$pedidoProduto->setPedido($pedido);					

					$produto = $produtoDAO->buscarPorId($registro['idProduto']);
					$pedidoProduto->setProduto($produto);		

					$pedidoProduto->setValor($registro['valor']);
					$pedidoProduto->setQuantidade($registro['quantidade']);						
					array_push($objetos, $pedidoProduto);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $objetos;

		}
        public function buscarValorVendProd($idProduto){

			$valorVendProd = 0;	

			try{
				
				$pdo = Banco::conectar();
					
				$sql = "SELECT SUM(valor) as Valor
                        FROM tbpedidoproduto
                        WHERE idProduto = :idProduto;";

				$run = $pdo->prepare($sql);		
                $run->bindValue(':idProduto', $idProduto);	
				$run->execute(); 
                $resultado = $run->fetchcolumn();
                if ($resultado > 0){
                    $valorVendProd = $resultado;
                }
				
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $valorVendProd;

		}
        public function buscarQntVendProd($idProduto){

			$qntVendProd = 0;	

			try{
				
				$pdo = Banco::conectar();
					
				$sql = "SELECT SUM(quantidade) as QntVendProd
                        FROM tbpedidoproduto
                        WHERE idProduto = :idProduto;";

				$run = $pdo->prepare($sql);		
                $run->bindValue(':idProduto', $idProduto);	
				$run->execute(); 
                $resultado = $run->fetchcolumn();
                if ($resultado > 0){
                    $qntVendProd = $resultado;
                }
				
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $qntVendProd;

		}
		
		public function buscarPorId($codigo){

			$produto = new Produto();
						
			try{

				$pdo = Banco::conectar();

				$sql = "SELECT * FROM tbpedidoproduto WHERE idPedidoProduto = :idPedidoProduto";

				$run = $pdo->prepare($sql);
	  			$run->bindParam(':idPedidoProduto', $codigo);			
				$run->execute(); 
				$registro = $run->fetch();

				$pedidoDAO = new PedidoDAO();
				$produtoDAO = new ProdutoDAO();

				$pedidoProduto = new PedidoProduto();

				$pedidoProduto->setIdPedidoProduto($registro['idPedidoProduto']);

				$pedido = $pedidoDAO->buscarPorId($registro['idPedido']);
				$pedidoProduto->setPedido($pedido);					

				$produto = $produtoDAO->buscarPorId($registro['idProduto']);
				$pedidoProduto->setProduto($produto);		

				$pedidoProduto->setValor($registro['valor']);
				$pedidoProduto->setQuantidade($registro['quantidade']);	


			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}
			
			return $produto;
		}	
		
	public function listarPorPedido($codigo){

			$objetos = array();	

			try{
				
				$pdo = Banco::conectar();
					
				$sql = "SELECT * FROM tbpedidoproduto WHERE idPedido = :idPedido; ";

				$run = $pdo->prepare($sql);	
				$run->bindValue(':idPedido', $codigo);		


				
				$run->execute(); 
				$resultado = $run->fetchAll();
				
				$pedidoDAO = new PedidoDAO();
				$produtoDAO = new ProdutoDAO();

				foreach ($resultado as $registro){

					$pedidoProduto = new PedidoProduto();

					$pedidoProduto->setIdPedidoProduto($registro['idPedidoProduto']);

					$pedido = $pedidoDAO->buscarPorId($registro['idPedido']);
					$pedidoProduto->setPedido($pedido);					

					$produto = $produtoDAO->buscarPorId($registro['idProduto']);
					$pedidoProduto->setProduto($produto);		

					$pedidoProduto->setValor($registro['valor']);
					$pedidoProduto->setQuantidade($registro['quantidade']);						
					array_push($objetos, $pedidoProduto);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $objetos;

		}	
			public function listarPorPedidoAgrupado($codigo){

			$objetos = array();	

			try{
				
				$pdo = Banco::conectar();
					
				$sql = "SELECT nome
                FROM tbproduto, tbpedidoproduto, tbpedido
                WHERE tbproduto.idProduto = tbpedidoproduto.idProduto
                AND tbpedidoproduto.idPedido = tbpedido.idPedido
                AND tbpedido.idPedido = :idPedido
                GROUP BY nome;";

				$run = $pdo->prepare($sql);	
				$run->bindValue(':idPedido', $codigo);		

				
				$run->execute(); 
				$resultado = $run->fetchAll();
				

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $resultado;

		}

	}
	
?>
