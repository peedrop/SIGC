<?php	
	require_once 'ClienteDAO.php';
	require_once 'Pedido.php';

	class PedidoDAO
	{

		public function salvar($pedido){	
			$situacao = FALSE;
			try{
				
				if($pedido->getIdPedido()==0){

					$situacao = $this->incluir($pedido);

				}else{	
					$situacao = $this->atualizar($pedido);
				}

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}			

			return $situacao;
		}

		public function incluir($pedido){	    
			$situacao = FALSE;

			try{
				
				$pdo = Banco::conectar();	

				$sql = "INSERT INTO tbpedido VALUES (null, :idCliente, :dataPedido, :horaPedido, :formaPagamento, :parcelas, :valor);";

				$run = $pdo->prepare($sql);
				$run->bindValue(':idCliente', $pedido->getCliente()->getIdCliente());
				$run->bindValue(':dataPedido', $pedido->getDataPedido()); 
                $run->bindValue(':horaPedido', $pedido->getHoraPedido()); 
                $run->bindValue(':formaPagamento', $pedido->getFormaPagamento()); 
                $run->bindValue(':parcelas', $pedido->getParcelas()); 
                $run->bindValue(':valor', $pedido->getValor()); 
				
	  			$run->execute();

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}
				
				$pedido->setIdPedido($pdo->lastInsertId());
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
                Banco::desconectar();
			}		

			return $situacao;
		}

		public function atualizar($pedido){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();
					
				$sql = "UPDATE tbpedido SET idCliente = :idCliente, dataPedido = :dataPedido, horaPedido = :horaPedido, formaPagamento = :formaPagamento, parcelas = :parcelas, valor = :valor WHERE idPedido = :idPedido";
				

				$run = $pdo->prepare($sql);
				$run->bindValue(':idPedido', $pedido->getIdPedido());  
				$run->bindValue(':idCliente', $pedido->getCliente()->getIdCliente());
				$run->bindValue(':dataPedido', $pedido->getDataPedido()); 
                $run->bindValue(':horaPedido', $pedido->getHoraPedido()); 
                $run->bindValue(':formaPagamento', $pedido->getFormaPagamento()); 
                $run->bindValue(':parcelas', $pedido->getParcelas()); 
                $run->bindValue(':valor', $pedido->getValor());    
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
		public function atualizarPrecoTotal($valor, $idPedido){	
			try{
				
				$pdo = Banco::conectar();
					
				$sql = "UPDATE tbpedido SET valor = :valor WHERE idPedido = :idPedido";
				

				$run = $pdo->prepare($sql);
				$run->bindValue(':idPedido', $idPedido);  
                $run->bindValue(':valor', $valor);    
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
            
        
        public function buscarValorIdPedido($codigo){

			$valor = 0;
						
			try{

				$pdo = Banco::conectar();

				$sql = "SELECT idPedido, SUM(valor) as valor
                        FROM tbpedidoproduto
                        WHERE idPedido = :idPedido;";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idPedido', $codigo);			
				$run->execute(); 
				$registro = $run->fetch();

				
				$valor = $registro['valor'];

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}
			
			return $valor;
		}
        public function alterValTotalPorId($idPedido, $valorTotal){
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();
					
				$sql = "UPDATE tbpedido SET valor = :valor WHERE idPedido = :idPedido";

				$run = $pdo->prepare($sql);
				$run->bindValue(':idPedido', $idPedido);  
                $run->bindValue(':valor', $valorTotal);   
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
            
		public function excluir($pedido){

			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	
					
				$sql = "DELETE FROM tbpedido WHERE idPedido = :idPedido";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idPedido', $pedido->getIdPedido());			
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
					
				$sql = "DELETE FROM tbpedido WHERE idPedido = :idPedido";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idPedido', $codigo);			
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
        
        public function listarEntreDatas($inicio, $fim){

			$objetos = array();	

			try{
				
				$pdo = Banco::conectar();
					
				$sql = "SELECT * FROM tbpedido WHERE date(dataPedido) BETWEEN :inicio AND :fim";

				$run = $pdo->prepare($sql);	
                $run->bindValue(':inicio', $inicio);
                $run->bindValue(':fim', $fim);
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $registro){

					$pedido = new Pedido();
					$pedido->setIdPedido($registro['idPedido']);
					
					$clienteDAO = new ClienteDAO();
					$cliente = $clienteDAO->buscarPorId($registro['idCliente']);
					$pedido->setCliente($cliente);	
					$pedido->setDataPedido($registro['dataPedido']);
					$pedido->setFormaPagamento($registro['formaPagamento']);
                    $pedido->setParcelas($registro['parcelas']);
                    $pedido->setValor($registro['valor']);
									
					array_push($objetos, $pedido);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $objetos;

		}
        
        public function listarEntradas($dataInicio, $dataFim){

			$objetos = array();	

			try{
				
				$pdo = Banco::conectar();
					
				$sql = "SELECT DATE(dataPedido), SUM(valor)
                        FROM tbpedido 
                        WHERE DATE(dataPedido) BETWEEN :dataInicio AND :dataFim
                        GROUP BY DATE(dataPedido)
                        ORDER BY DATE(dataPedido);";

				$run = $pdo->prepare($sql);	
                $run->bindValue(':dataInicio', $dataInicio);
                $run->bindValue(':dataFim', $dataFim);
				$run->execute(); 
				$resultado = $run->fetchAll();

				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $resultado;

		}    
		public function listar(){

			$objetos = array();	

			try{
				
				$pdo = Banco::conectar();
					
				$sql = "SELECT * FROM tbpedido";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $registro){

					$pedido = new Pedido();
					$pedido->setIdPedido($registro['idPedido']);
					
					$clienteDAO = new ClienteDAO();
					$cliente = $clienteDAO->buscarPorId($registro['idCliente']);
					$pedido->setCliente($cliente);	
					$pedido->setDataPedido($registro['dataPedido']);
                    $pedido->setHoraPedido($registro['horaPedido']);
					$pedido->setFormaPagamento($registro['formaPagamento']);
                    $pedido->setParcelas($registro['parcelas']);
                    $pedido->setValor($registro['valor']);
									
					array_push($objetos, $pedido);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $objetos;

		}	
        public function listarPorCliente($cliente,$inicio,$fim){

			$objetos = array();	

			try{
				
				$pdo = Banco::conectar();
					
				$sql = "SELECT * FROM tbpedido WHERE idCliente = :id AND dataPedido BETWEEN 
                IFNULL(:inicio, dataPedido) AND IFNULL(:fim, dataPedido);";

				$run = $pdo->prepare($sql);	
                $run->bindValue(':id', $cliente->getIdCliente());
                $run->bindValue(':inicio', $inicio);
                $run->bindValue(':fim', $fim);
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $registro){

					$pedido = new Pedido();
					$pedido->setIdPedido($registro['idPedido']);
					
					$clienteDAO = new ClienteDAO();
					$cliente = $clienteDAO->buscarPorId($registro['idCliente']);
					$pedido->setCliente($cliente);	
					$pedido->setDataPedido($registro['dataPedido']);
                    $pedido->setHoraPedido($registro['horaPedido']);
					$pedido->setFormaPagamento($registro['formaPagamento']);
                    $pedido->setParcelas($registro['parcelas']);
                    $pedido->setValor($registro['valor']);
									
					array_push($objetos, $pedido);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $objetos;

		}
		public function buscarPorId($codigo){

			$pedido = new Pedido();
						
			try{

				$pdo = Banco::conectar();

				$sql = "SELECT * FROM tbpedido WHERE idPedido = :idPedido";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idPedido', $codigo);			
				$run->execute(); 
				$registro = $run->fetch();

                $pedido->setIdPedido($registro['idPedido']);
				$clienteDAO = new ClienteDAO();
                $cliente = $clienteDAO->buscarPorId($registro['idCliente']);
                $pedido->setCliente($cliente);	
                $pedido->setDataPedido($registro['dataPedido']);
                $pedido->setHoraPedido($registro['horaPedido']);
                $pedido->setFormaPagamento($registro['formaPagamento']);
                $pedido->setParcelas($registro['parcelas']);
                $pedido->setValor($registro['valor']);

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}
			
			return $pedido;
		}
        
        
        /*
		public function filtrar($usuario, $dataInicio, $dataFim, $produto){

			$objetos = array();	

			try{
				
				$pdo = Banco::conectar();
					

				if( $dataInicio != NULL){
					$dataInicio = date("Y-m-d H:i:s",strtotime(str_replace('/','-', $dataInicio)));	
					$dataInicio = "'".$dataInicio."'";
				}else{
					$dataInicio = 'NULL';
				}
				
				if( $dataFim != NULL){
					$dataFim = date("Y-m-d H:i:s",strtotime(str_replace('/','-', $dataFim)));
					$dataFim = "'".$dataFim."'";
				}else{
					$dataFim = 'NULL';
				}

				$sql = "SELECT DISTINCT ped.idPedido, ped.idUsuario, ped.dataPedido
                        FROM tbPedido AS ped 
                        LEFT JOIN tbUsuario AS usu ON ped.idUsuario = usu.idUsuario 
                        LEFT JOIN tbPedidoProduto AS pedpro ON ped.idPedido = pedpro.idPedido  
                        LEFT JOIN tbProduto AS pro ON pedpro.idProduto = pro.idProduto  
                        WHERE 
                            IFNULL(pro.nome, '') LIKE '%{$produto}%'     
                        AND usu.nome LIKE '%{$usuario}%' 
                        AND dataPedido BETWEEN IFNULL({$dataInicio}, dataPedido) AND IFNULL({$dataFim}, dataPedido);";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $registro){

					$pedido = new Pedido();
					$pedido->setIdPedido($registro['idPedido']);
					
					$usuarioDAO = new UsuarioDAO();
					$usuario = $usuarioDAO->buscarPorId($registro['idUsuario']);
					$pedido->setUsuario($usuario);
					$pedido->setDataPedido($registro['dataPedido']);
					
									
					array_push($objetos, $pedido);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $objetos;

		}	
        */

	}
	
?>
