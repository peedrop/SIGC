<?php	
	require_once 'Banco.php';
	require_once 'Marca.php';

	class MarcaDAO{

		public function salvar($marca){	
			$situacao = FALSE;
			try{
				
				if($marca->getIdMarca()==0){

					$situacao = $this->incluir($marca);

				}else{	
					$situacao = $this->atualizar($marca);
				}

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}			

			return $situacao;
		}

		public function incluir($marca){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	

				$sql = "INSERT INTO tbmarca(nome) VALUES (:nome)";

				$run = $pdo->prepare($sql);
				$run->bindValue(':nome', $marca->getNome(), PDO::PARAM_STR); 
	  			$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}

				$marca->setIdMarca($pdo->lastInsertId());
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $situacao;
		}

		public function atualizar($marca){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();
					
				$sql = "UPDATE tbmarca SET nome = :nome WHERE idMarca = :idMarca";

				$run = $pdo->prepare($sql);
                $run->bindValue(':idMarca', $marca->getIdMarca(), PDO::PARAM_INT);
				$run->bindValue(':nome', $marca->getNome(), PDO::PARAM_STR); 
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

		public function excluir($marca){

			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	
					
				$sql = "DELETE FROM tbmarca WHERE idMarca = :idMarca";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idMarca', $marca->getIdMarca(), PDO::PARAM_INT);			
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
				
				$sql = "DELETE FROM tbmarca WHERE idMarca = :idMarca";	

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idMarca', $codigo, PDO::PARAM_INT);			
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
					
				$sql = "SELECT * FROM tbmarca";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $objeto){

					$marca = new Marca();
					$marca->setIdMarca($objeto['idMarca']);
                    $marca->setNome($objeto['nome']);
					array_push($objetos, $marca);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $objetos;

		}			
		
		public function buscarPorId($codigo){

			$marca = new Marca();
						
			try{

				$pdo = Banco::conectar();

				$sql = "SELECT * FROM tbmarca WHERE idMarca = :idMarca";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idMarca', $codigo, PDO::PARAM_INT);			
				$run->execute(); 
				$resultado = $run->fetch();

				$marca = new Marca();
                $marca->setIdMarca($resultado['idMarca']);
                $marca->setNome($resultado['nome']);

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}
			
			return $marca;
		}	
	}
?>
