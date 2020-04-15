<?php	
	require_once 'Banco.php';
	require_once 'Tipo.php';

	class TipoDAO{

		public function salvar($tipo){	
			$situacao = FALSE;
			try{
				
				if($tipo->getIdTipo()==0){

					$situacao = $this->incluir($tipo);

				}else{	
					$situacao = $this->atualizar($tipo);
				}

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}			

			return $situacao;
		}

		public function incluir($tipo){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	

				$sql = "INSERT INTO tbtipo(nome) VALUES (:nome)";

				$run = $pdo->prepare($sql);
				$run->bindValue(':nome', $tipo->getNome(), PDO::PARAM_STR); 
	  			$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}

				$tipo->setIdTipo($pdo->lastInsertId());
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $situacao;
		}

		public function atualizar($tipo){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();
					
				$sql = "UPDATE tbtipo SET nome = :nome WHERE idTipo = :idTipo";

				$run = $pdo->prepare($sql);
                $run->bindValue(':idTipo', $tipo->getIdTipo(), PDO::PARAM_INT);
				$run->bindValue(':nome', $tipo->getNome(), PDO::PARAM_STR); 
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

		public function excluir($tipo){

			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	
					
				$sql = "DELETE FROM tbtipo WHERE idTipo = :idTipo";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idTipo', $tipo->getIdTipo(), PDO::PARAM_INT);			
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
				
				$sql = "DELETE FROM tbtipo WHERE idTipo = :idTipo";	

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idTipo', $codigo, PDO::PARAM_INT);			
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
					
				$sql = "SELECT * FROM tbtipo";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $objeto){

					$tipo = new Tipo();
					$tipo->setIdTipo($objeto['idTipo']);
                    $tipo->setNome($objeto['nome']);
					array_push($objetos, $tipo);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $objetos;

		}			
		
		public function buscarPorId($codigo){

			$tipo = new Tipo();
						
			try{

				$pdo = Banco::conectar();

				$sql = "SELECT * FROM tbtipo WHERE idTipo = :idTipo";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idTipo', $codigo, PDO::PARAM_INT);			
				$run->execute(); 
				$resultado = $run->fetch();

				$tipo = new Tipo();
                $tipo->setIdTipo($resultado['idTipo']);
                $tipo->setNome($resultado['nome']);

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}
			
			return $tipo;
		}	
	}
?>
