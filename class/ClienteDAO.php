<?php	
	require_once 'Banco.php';
	require_once 'Cliente.php';

	class ClienteDAO{

		public function salvar($cliente){	
			$situacao = FALSE;
			try{
				
				if($cliente->getIdCliente()==0){

					$situacao = $this->incluir($cliente);

				}else{	
					$situacao = $this->atualizar($cliente);
				}

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}			

			return $situacao;
		}

		public function incluir($cliente){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	

				$sql = "INSERT INTO tbcliente VALUES (null, :nome, :cpf, :rg, :telefone, :dataNascimento, :estado, :cidade, :bairro, :rua, :cep, :numero, :complemento);";
                
				$run = $pdo->prepare($sql);
				$run->bindValue(':nome', $cliente->getNome(), PDO::PARAM_STR); 
				$run->bindValue(':cpf', $cliente->getCpf(), PDO::PARAM_STR);
                $run->bindValue(':rg', $cliente->getRg(), PDO::PARAM_STR);
                $run->bindValue(':telefone', $cliente->getTelefone(), PDO::PARAM_STR);
				$run->bindValue(':dataNascimento', $cliente->getDataNascimento(), PDO::PARAM_STR); 
                $run->bindValue(':estado', $cliente->getEstado(), PDO::PARAM_STR);
                $run->bindValue(':cidade', $cliente->getCidade(), PDO::PARAM_STR);
                $run->bindValue(':bairro', $cliente->getBairro(), PDO::PARAM_STR);
                $run->bindValue(':rua', $cliente->getRua(), PDO::PARAM_STR);
                $run->bindValue(':cep', $cliente->getCep(), PDO::PARAM_STR);
                $run->bindValue(':numero', $cliente->getNumero(), PDO::PARAM_STR);
                $run->bindValue(':complemento', $cliente->getComplemento(), PDO::PARAM_STR);
	  			$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}

				$cliente->setIdCliente($pdo->lastInsertId());
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $situacao;
		}

		public function atualizar($cliente){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();
					
				$sql = "UPDATE tbcliente SET nome = :nome, cpf = :cpf, rg = :rg, telefone = :telefone, dataNascimento = :dataNascimento, estado = :estado, cidade = :cidade, bairro = :bairro, rua = :rua, cep = :cep, numero = :numero, complemento = :complemento WHERE idCliente = :idCliente";

				$run = $pdo->prepare($sql);
                $run->bindValue(':idCliente', $cliente->getIdCliente(), PDO::PARAM_INT);
				$run->bindValue(':nome', $cliente->getNome(), PDO::PARAM_STR); 
				$run->bindValue(':cpf', $cliente->getCpf(), PDO::PARAM_STR);
                $run->bindValue(':rg', $cliente->getRg(), PDO::PARAM_STR);
                $run->bindValue(':telefone', $cliente->getTelefone(), PDO::PARAM_STR);
				$run->bindValue(':dataNascimento', $cliente->getDataNascimento(), PDO::PARAM_STR); 
                $run->bindValue(':estado', $cliente->getEstado(), PDO::PARAM_STR);
                $run->bindValue(':cidade', $cliente->getCidade(), PDO::PARAM_STR);
                $run->bindValue(':bairro', $cliente->getBairro(), PDO::PARAM_STR);
                $run->bindValue(':rua', $cliente->getRua(), PDO::PARAM_STR);
                $run->bindValue(':cep', $cliente->getCep(), PDO::PARAM_STR);
                $run->bindValue(':numero', $cliente->getNumero(), PDO::PARAM_STR);
                $run->bindValue(':complemento', $cliente->getComplemento(), PDO::PARAM_STR);
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

		public function excluir($cliente){

			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	
					
				$sql = "DELETE FROM tbcliente WHERE idCliente = :idCliente";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idCliente', $cliente->getIdCliente(), PDO::PARAM_INT);			
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
				
				$sql = "DELETE FROM tbcliente WHERE idCliente = :idCliente";	

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idCliente', $codigo);			
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
					
				$sql = "SELECT * FROM tbcliente";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $objeto){

					$cliente = new Cliente();
					$cliente->setIdCliente($objeto['idCliente']);
                    $cliente->setNome($objeto['nome']);
                    $cliente->setCpf($objeto['cpf']);
                    $cliente->setRg($objeto['rg']);
                    $cliente->setTelefone($objeto['telefone']);
                    $cliente->setDataNascimento($objeto['dataNascimento']);
                    $cliente->setEstado($objeto['estado']);
                    $cliente->setCidade($objeto['cidade']);
                    $cliente->setBairro($objeto['bairro']);
                    $cliente->setRua($objeto['rua']);
                    $cliente->setCep($objeto['cep']);
                    $cliente->setNumero($objeto['numero']);
                    $cliente->setComplemento($objeto['complemento']);
					array_push($objetos, $cliente);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $objetos;

		}	
        public function listarComPedidos($inicio,$fim){

			$objetos = array();	

			try{
				
				$pdo = Banco::conectar();
					
				$sql = "SELECT * FROM tbcliente, tbpedido WHERE tbcliente.idCliente = tbpedido.idCliente AND dataPedido BETWEEN 
                IFNULL(:inicio, dataPedido) AND IFNULL(:fim, dataPedido) GROUP BY tbcliente.idCliente";

				$run = $pdo->prepare($sql);		
                $run->bindValue(':inicio', $inicio);
                $run->bindValue(':fim', $fim);
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $objeto){

					$cliente = new Cliente();
					$cliente->setIdCliente($objeto['idCliente']);
                    $cliente->setNome($objeto['nome']);
                    $cliente->setCpf($objeto['cpf']);
                    $cliente->setRg($objeto['rg']);
                    $cliente->setTelefone($objeto['telefone']);
                    $cliente->setDataNascimento($objeto['dataNascimento']);
                    $cliente->setEstado($objeto['estado']);
                    $cliente->setCidade($objeto['cidade']);
                    $cliente->setBairro($objeto['bairro']);
                    $cliente->setRua($objeto['rua']);
                    $cliente->setCep($objeto['cep']);
                    $cliente->setNumero($objeto['numero']);
                    $cliente->setComplemento($objeto['complemento']);
					array_push($objetos, $cliente);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $objetos;

		}
		
		public function buscarPorId($codigo){

			$cliente = new Cliente();
						
			try{

				$pdo = Banco::conectar();

				$sql = "SELECT * FROM tbcliente WHERE idCliente = :idCliente";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idCliente', $codigo, PDO::PARAM_INT);			
				$run->execute(); 
				$resultado = $run->fetch();

				$cliente = new Cliente();
                $cliente->setIdCliente($resultado['idCliente']);
                $cliente->setNome($resultado['nome']);
                $cliente->setCpf($resultado['cpf']);
                $cliente->setRg($resultado['rg']);
                $cliente->setTelefone($resultado['telefone']);
                $cliente->setDataNascimento($resultado['dataNascimento']);
                $cliente->setEstado($resultado['estado']);
                $cliente->setCidade($resultado['cidade']);
                $cliente->setBairro($resultado['bairro']);
                $cliente->setRua($resultado['rua']);
                $cliente->setCep($resultado['cep']);
                $cliente->setNumero($resultado['numero']);
                $cliente->setComplemento($resultado['complemento']);

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}
			
			return $cliente;
		}	
        public function verificarCpf($codigo, $cpf){

			$situacao = TRUE;
			try{
				
				$pdo = Banco::conectar();	
					
				$sql = "SELECT * FROM tbcliente WHERE idCliente <> :idCliente AND cpf = :cpf";

				$run = $pdo->prepare($sql);
	  			$run->bindParam(':idCliente', $codigo, PDO::PARAM_INT);			
	  			$run->bindParam(':cpf', $cpf, PDO::PARAM_STR);	
				$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = FALSE;
				}
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}			

			return $situacao;

		}
	}
?>
