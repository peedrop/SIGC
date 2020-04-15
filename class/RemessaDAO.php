<?php	
	require_once 'Banco.php';
	require_once 'Remessa.php';

	class RemessaDAO{

		public function salvar($remessa){	
			$situacao = FALSE;
			try{
				
				if($remessa->getIdRemessa()==0){

					$situacao = $this->incluir($remessa);

				}else{	
					$situacao = $this->atualizar($remessa);
				}

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}			

			return $situacao;
		}

		public function incluir($remessa){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	

				$sql = "INSERT INTO tbremessa VALUES (null, :idProduto, :precoCusto, :precoVarejo, :quantidade, :dataRemessa)";
                
                
				$run = $pdo->prepare($sql);
				$run->bindValue(':idProduto', $remessa->getidProduto()); 
				$run->bindValue(':precoCusto', $remessa->getPrecoCusto());
                $run->bindValue(':precoVarejo', $remessa->getPrecoVarejo());
                $run->bindValue(':quantidade', $remessa->getQuantidade());
                $run->bindValue(':dataRemessa', $remessa->getDataRemessa());
	  			$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}

				$remessa->setIdRemessa($pdo->lastInsertId());
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $situacao;
		}

		public function atualizar($remessa){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();
					
				$sql = "UPDATE tbremessa SET idProduto = :idProduto, precoCusto = :precoCusto, precoVarejo = :precoVarejo, quantidade = :quantidade, dataRemessa = :dataRemessa WHERE idRemessa = :idRemessa";
                
				$run = $pdo->prepare($sql);
                $run->bindValue(':idRemessa', $remessa->getIdRemessa());
				$run->bindValue(':idProduto', $remessa->getIdProduto()); 
				$run->bindValue(':precoCusto', $remessa->getPrecoCusto());
                $run->bindValue(':precoVarejo', $remessa->getPrecoVarejo());
                $run->bindValue(':quantidade', $remessa->getQuantidade());
                $run->bindValue(':dataRemessa', $remessa->getDataRemessa());
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

		public function excluir($remessa){

			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	
					
				$sql = "DELETE FROM tbremessa WHERE idRemessa = :idRemessa";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idRemessa', $remessa->getIdRemessa(), PDO::PARAM_INT);			
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
				
				$sql = "DELETE FROM tbremessa WHERE idRemessa = :idRemessa";	

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idRemessa', $codigo, PDO::PARAM_INT);			
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
					
				$sql = "SELECT * FROM tbremessa";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $objeto){

					$remessa = new Remessa();
					$remessa->setIdRemessa($objeto['idRemessa']);
                    $remessa->setIdProduto($objeto['idProduto']);
                    $remessa->setPrecoCusto($objeto['precoCusto']);
                    $remessa->setPrecoVarejo($objeto['precoVarejo']);
                    $remessa->setQuantidade($objeto['quantidade']);
                    $remessa->setDataRemessa($objeto['dataRemessa']);
					array_push($objetos, $remessa);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $objetos;

		}
        public function buscarVendaProd($idProduto){

			$vendaProd = 0;	

			try{
				
				$pdo = Banco::conectar();
					
				$sql = "SELECT SUM(precoVarejo * quantidade) as PV
                        FROM tbremessa
                        WHERE idProduto = :idProduto;";

				$run = $pdo->prepare($sql);		
                $run->bindValue(':idProduto', $idProduto);	
				$run->execute(); 
                $resultado = $run->fetchcolumn();
                if ($resultado > 0){
                    $vendaProd = $resultado;
                }
				
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $vendaProd;

		}
        public function buscarCustoProd($idProduto){

			$custoProd = 0;	

			try{
				
				$pdo = Banco::conectar();
					
				$sql = "SELECT SUM(precoCusto * quantidade) as PC
                        FROM tbremessa
                        WHERE idProduto = :idProduto;";

				$run = $pdo->prepare($sql);		
                $run->bindValue(':idProduto', $idProduto);	
				$run->execute(); 
                $resultado = $run->fetchcolumn();
                if ($resultado > 0){
                    $custoProd = $resultado;
                }
				
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $custoProd;

		}
        public function listarPorProduto($idProduto){

			$objetos = array();	

			try{
				
				$pdo = Banco::conectar();
					
				$sql = "SELECT * FROM tbremessa WHERE idProduto = :idProduto";

				$run = $pdo->prepare($sql);	
                $run->bindValue(':idProduto', $idProduto);	
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $objeto){

					$remessa = new Remessa();
					$remessa->setIdRemessa($objeto['idRemessa']);
                    $remessa->setIdProduto($objeto['idProduto']);
                    $remessa->setPrecoCusto($objeto['precoCusto']);
                    $remessa->setPrecoVarejo($objeto['precoVarejo']);
                    $remessa->setQuantidade($objeto['quantidade']);
                    $remessa->setDataRemessa($objeto['dataRemessa']);
					array_push($objetos, $remessa);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $objetos;

		}
		
		public function buscarPorId($codigo){

			$remessa = new Remessa();
						
			try{

				$pdo = Banco::conectar();

				$sql = "SELECT * FROM tbremessa WHERE idRemessa = :idRemessa";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idRemessa', $codigo, PDO::PARAM_INT);			
				$run->execute(); 
				$resultado = $run->fetch();

				$remessa = new Remessa ();
					$remessa->setIdRemessa($resultado['idRemessa']);
                    $remessa->setIdProduto($resultado['idProduto']);
                    $remessa->setPrecoCusto($resultado['precoCusto']);
                    $remessa->setPrecoVarejo($resultado['precoVarejo']);
                    $remessa->setQuantidade($resultado['quantidade']);
                    $remessa->setDataRemessa($resultado['dataRemessa']);

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}
			
			return $remessa;
		}	
	}
?>
