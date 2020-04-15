<?php	
	require_once 'Banco.php';
	require_once 'Produto.php';
	require_once 'Remessa.php';

	class ProdutoDAO{

		public function salvar($produto){	
			$situacao = FALSE;
			try{
				
				if($produto->getIdProduto()==0){

					$situacao = $this->incluir($produto);

				}else{	
					$situacao = $this->atualizar($produto);
				}

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}			

			return $situacao;
		}

		public function incluir($produto){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	

				$sql = "INSERT INTO tbproduto VALUES (null, :nome, :idTipo, :idMarca, :estoqueMin, :descricao, :valor, :quantidade)";

				$run = $pdo->prepare($sql);
				$run->bindValue(':nome', $produto->getNome()); 
				$run->bindValue(':idTipo', $produto->getIdTipo());
                $run->bindValue(':idMarca', $produto->getIdMarca());
                $run->bindValue(':estoqueMin', $produto->getEstoqueMin());
				$run->bindValue(':descricao', $produto->getDescricao());
                $run->bindValue(':valor', $produto->getValor());
                $run->bindValue(':quantidade', $produto->getQuantidade());
	  			$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}

				$produto->setIdProduto($pdo->lastInsertId());
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $situacao;
		}

		public function atualizar($produto){
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();
					
				$sql = "UPDATE tbproduto SET nome = :nome, idTipo = :idTipo, idMarca = :idMarca, estoqueMin = :estoqueMin, descricao = :descricao, valor = :valor, quantidade = :quantidade WHERE idProduto = :idProduto";

				$run = $pdo->prepare($sql);
                $run->bindValue(':idProduto', $produto->getIdProduto(), PDO::PARAM_INT);
				$run->bindValue(':nome', $produto->getNome()); 
				$run->bindValue(':idTipo', $produto->getIdTipo());
                $run->bindValue(':idMarca', $produto->getIdMarca());
                $run->bindValue(':estoqueMin', $produto->getEstoqueMin());
				$run->bindValue(':descricao', $produto->getDescricao());
                $run->bindValue(':valor', $produto->getValor());
                $run->bindValue(':quantidade', $produto->getQuantidade());
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
        public function atualizarQuantidadePorId($idProduto, $quantidade){
			$situacao = FALSE;
			try{
				$produto = new Produto();
				$produto = $this->buscarPorId($idProduto);
				$pdo = Banco::conectar();
					
				$sql = "UPDATE tbproduto SET quantidade = :quantidade  WHERE idProduto = :idProduto";

				$run = $pdo->prepare($sql);
                $run->bindValue(':idProduto', $idProduto);
                $run->bindValue(':quantidade', $produto->getQuantidade() - $quantidade);
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
		public function atualizarProduto($remessa){
			$situacao = FALSE;
			try{
				$produto = new Produto();
				$produto = $this->buscarPorId($remessa->getIdProduto());
				$pdo = Banco::conectar();
					
				$sql = "UPDATE tbproduto SET valor = :valor, quantidade = :quantidade  WHERE idProduto = :idProduto";

				$run = $pdo->prepare($sql);
                $run->bindValue(':idProduto', $produto->getIdProduto(), PDO::PARAM_INT);
                $run->bindValue(':valor', $remessa->getPrecoVarejo());
                $run->bindValue(':quantidade', $remessa->getQuantidade() + $produto->getQuantidade());
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
        public function buscarQuantidade($codigo){

			$qnt = 0;
						
			try{

				$pdo = Banco::conectar();

				$sql = "SELECT tbproduto.nome, SUM(tbremessa.quantidade) - SUM(tbpedidoproduto.quantidade) as qntRestante
                FROM tbproduto, tbremessa, tbpedidoproduto
                WHERE tbproduto.idProduto = tbremessa.idProduto
                AND tbproduto.idProduto = tbpedidoproduto.idProduto
                AND tbproduto.idProduto = :idProduto;";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idProduto', $codigo, PDO::PARAM_INT);			
				$run->execute(); 
				$resultado = $run->fetch();
                
                if ($resultado['qntRestante'] == null || $resultado['qntRestante'] == ''){
                    $qnt = 0;
                }else{
                    $qnt = $resultado['qntRestante'];
                }
               

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}
			
			return $qnt;
		}
		public function excluir($produto){

			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	
					
				$sql = "DELETE FROM tbproduto WHERE idProduto = :idProduto";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idProduto', $produto->getIdProduto(), PDO::PARAM_INT);			
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
				
				$sql = "DELETE FROM tbproduto WHERE idProduto = :idProduto";	

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idProduto', $codigo, PDO::PARAM_INT);			
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
          
		public function listar(){

			$objetos = array();	

			try{
				
				$pdo = Banco::conectar();
					
				$sql = "SELECT * FROM tbproduto";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $objeto){

					$produto = new Produto();
					$produto->setIdProduto($objeto['idProduto']);
                    $produto->setNome($objeto['nome']);
                    $produto->setIdTipo($objeto['idTipo']);
                    $produto->setIdMarca($objeto['idMarca']);
                    $produto->setEstoqueMin($objeto['estoqueMin']);
                    $produto->setDescricao($objeto['descricao']);
                    $produto->setValor($objeto['valor']);
                    $produto->setQuantidade($objeto['quantidade']);
					array_push($objetos, $produto);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $objetos;

		}			
		
		public function buscarPorId($codigo){

			$produto = new Produto();
						
			try{

				$pdo = Banco::conectar();

				$sql = "SELECT * FROM tbproduto WHERE idProduto = :idProduto";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idProduto', $codigo, PDO::PARAM_INT);			
				$run->execute(); 
				$resultado = $run->fetch();

				$produto = new Produto();
					$produto->setIdProduto($resultado['idProduto']);
                    $produto->setNome($resultado['nome']);
                    $produto->setIdTipo($resultado['idTipo']);
                    $produto->setIdMarca($resultado['idMarca']);
                    $produto->setEstoqueMin($resultado['estoqueMin']);
                    $produto->setDescricao($resultado['descricao']);
                    $produto->setValor($resultado['valor']);
                    $produto->setQuantidade($resultado['quantidade']);

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}
			
			return $produto;
		}	
	}
?>
