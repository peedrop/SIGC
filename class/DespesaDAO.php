<?php	
	require_once 'Banco.php';
	require_once 'Despesa.php';

	class DespesaDAO{

		public function salvar($despesa){	
			$situacao = FALSE;
			try{
				
				if($despesa->getIdDespesa()==0){

					$situacao = $this->incluir($despesa);

				}else{	
					$situacao = $this->atualizar($despesa);
				}

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}			

			return $situacao;
		}

		public function incluir($despesa){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	

				$sql = "INSERT INTO tbdespesa(nome, descricao, dataVencimento, valor, situacao) VALUES (:nome, :descricao, :dataVencimento, :valor, :situacao)";

				$run = $pdo->prepare($sql);
				$run->bindValue(':nome', $despesa->getNome(), PDO::PARAM_STR); 
				$run->bindValue(':descricao', $despesa->getDescricao(), PDO::PARAM_STR);
                $run->bindValue(':dataVencimento', $despesa->getDataVencimento(), PDO::PARAM_STR);
                $run->bindValue(':valor', $despesa->getValor(), PDO::PARAM_STR);
                $run->bindValue(':situacao', $despesa->getSituacao(), PDO::PARAM_INT);
	  			$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}

				$despesa->setIdDespesa($pdo->lastInsertId());
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $situacao;
		}

		public function atualizar($despesa){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();
					
				$sql = "UPDATE tbdespesa SET nome = :nome, descricao = :descricao, dataVencimento = :dataVencimento, valor = :valor, situacao = :situacao WHERE idDespesa = :idDespesa";

				$run = $pdo->prepare($sql);
                $run->bindValue(':idDespesa', $despesa->getIdDespesa(), PDO::PARAM_INT);
				$run->bindValue(':nome', $despesa->getNome(), PDO::PARAM_STR); 
				$run->bindValue(':descricao', $despesa->getDescricao(), PDO::PARAM_STR);
                $run->bindValue(':dataVencimento', $despesa->getDataVencimento(), PDO::PARAM_STR);
                $run->bindValue(':valor', $despesa->getValor(), PDO::PARAM_STR);
				$run->bindValue(':situacao', $despesa->getSituacao(), PDO::PARAM_INT); 
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

		public function excluir($despesa){

			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	
					
				$sql = "DELETE FROM tbdespesa WHERE idDespesa = :idDespesa";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idDespesa', $despesa->getIdDespesa(), PDO::PARAM_INT);			
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
				
				$sql = "DELETE FROM tbdespesa WHERE idDespesa = :idDespesa";	

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idDespesa', $codigo, PDO::PARAM_INT);			
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
					
				$sql = "SELECT * FROM tbdespesa";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $objeto){

					$despesa = new Despesa();
					$despesa->setIdDespesa($objeto['idDespesa']);
                    $despesa->setNome($objeto['nome']);
                    $despesa->setDescricao($objeto['descricao']);
                    $despesa->setDataVencimento($objeto['dataVencimento']);
                    $despesa->setValor($objeto['valor']);
                    $despesa->setSituacao($objeto['situacao']);
					array_push($objetos, $despesa);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $objetos;

		}			
        
        public function listarSaidas($dataInicio, $dataFim){

			$objetos = array();	

			try{
				
				$pdo = Banco::conectar();
                
				$sql = "SELECT dataVencimento, SUM(valor)
                        FROM tbdespesa
                        WHERE dataVencimento BETWEEN :dataInicio AND :dataFim
                        GROUP BY dataVencimento
                        ORDER BY dataVencimento;";

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
		public function buscarPorId($codigo){

			$despesa = new Despesa();
						
			try{

				$pdo = Banco::conectar();

				$sql = "SELECT * FROM tbdespesa WHERE idDespesa = :idDespesa";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idDespesa', $codigo, PDO::PARAM_INT);			
				$run->execute(); 
				$resultado = $run->fetch();

				$despesa = new Despesa();
                $despesa->setIdDespesa($resultado['idDespesa']);
                $despesa->setNome($resultado['nome']);
                $despesa->setDescricao($resultado['descricao']);
                $despesa->setDataVencimento($resultado['dataVencimento']);
                $despesa->setValor($resultado['valor']);
                $despesa->setSituacao($resultado['situacao']);
                
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}
			
			return $despesa;
		}	
	}
?>
