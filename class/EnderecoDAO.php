<?php	
	require_once 'Banco.php';
	require_once 'Endereco.php';

	class EnderecoDAO{

		public function salvar($endereco){	
			$situacao = FALSE;
			try{
				
				if($endereco->getIdEndereco()==0){

					$situacao = $this->incluir($endereco);

				}else{	
					$situacao = $this->atualizar($endereco);
				}

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}			

			return $situacao;
		}

		public function incluir($endereco){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	

				$sql = "INSERT INTO tbendereco(estado, cidade, bairro, rua, cep, numero, complemento) VALUES (:estado, :cidade, :bairro, :rua, :cep, :numero, :complemento)";

				$run = $pdo->prepare($sql);
				$run->bindValue(':estado', $endereco->getEstado(), PDO::PARAM_STR); 
				$run->bindValue(':cidade', $endereco->getCidade(), PDO::PARAM_STR);
                $run->bindValue(':bairro', $endereco->getBairro(), PDO::PARAM_STR);
                $run->bindValue(':rua', $endereco->getRua(), PDO::PARAM_STR);
                $run->bindValue(':cep', $endereco->getCep(), PDO::PARAM_STR);
                $run->bindValue(':numero', $endereco->getNumero(), PDO::PARAM_STR);
                $run->bindValue(':complemento', $endereco->getComplemento(), PDO::PARAM_STR);
	  			$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}

				$endereco->setIdEndereco($pdo->lastInsertId());
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $situacao;
		}

		public function atualizar($endereco){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();
					
				$sql = "UPDATE tbendereco SET estado = :estado, cidade = :cidade, bairro = :bairro, rua = :rua, cep = :cep, numero = :numero, complemento = :complemento WHERE idEndereco = :idEndereco";

				$run = $pdo->prepare($sql);
                $run->bindValue(':idEndereco', $endereco->getIdEndereco(), PDO::PARAM_INT);
				$run->bindValue(':estado', $endereco->getEstado(), PDO::PARAM_STR); 
				$run->bindValue(':cidade', $endereco->getCidade(), PDO::PARAM_STR);
                $run->bindValue(':bairro', $endereco->getBairro(), PDO::PARAM_STR);
                $run->bindValue(':rua', $endereco->getRua(), PDO::PARAM_STR);
                $run->bindValue(':cep', $endereco->getCep(), PDO::PARAM_STR);
                $run->bindValue(':numero', $endereco->getNumero(), PDO::PARAM_STR);
                $run->bindValue(':complemento', $endereco->getComplemento(), PDO::PARAM_STR);
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

		public function excluir($endereco){

			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	
					
				$sql = "DELETE FROM tbendereco WHERE idEndereco = :idEndereco";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idEndereco', $endereco->getIdEndereco(), PDO::PARAM_INT);			
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
				
				$sql = "DELETE FROM tbendereco WHERE idEndereco = :idEndereco";	

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idEndereco', $codigo, PDO::PARAM_INT);			
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
					
				$sql = "SELECT * FROM tbendereco";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $objeto){

					$endereco = new Endereco();
					$endereco->setIdEndereco($objeto['idEndereco']);
                    $endereco->setEstado($objeto['estado']);
                    $endereco->setCidade($objeto['cidade']);
                    $endereco->setBairro($objeto['bairro']);
                    $endereco->setRua($objeto['rua']);
                    $endereco->setCep($objeto['cep']);
                    $endereco->setNumero($objeto['numero']);
                    $endereco->setComplemento($objeto['complemento']);
					array_push($objetos, $endereco);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $objetos;

		}			
		
		public function buscarPorId($codigo){

			$endereco = new Endereco();
						
			try{

				$pdo = Banco::conectar();

				$sql = "SELECT * FROM tbendereco WHERE idEndereco = :idEndereco";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idEndereco', $codigo, PDO::PARAM_INT);			
				$run->execute(); 
				$resultado = $run->fetch();

				$endereco = new Endereco();
                $endereco->setIdEndereco($resultado['idEndereco']);
                $endereco->setEstado($resultado['estado']);
                $endereco->setCidade($resultado['cidade']);
                $endereco->setBairro($resultado['bairro']);
                $endereco->setRua($resultado['rua']);
                $endereco->setCep($resultado['cep']);
                $endereco->setNumero($resultado['numero']);
                $endereco->setComplemento($resultado['complemento']);

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}
			
			return $endereco;
		}	
	}
?>
