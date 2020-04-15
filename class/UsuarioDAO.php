<?php	
	require_once 'Banco.php';
	require_once 'Usuario.php';

	class UsuarioDAO
	{

		public function salvar($usuario){	
			$situacao = FALSE;
			try{
				
				if($usuario->getIdUsuario()==0){

					$situacao = $this->incluir($usuario);

				}else{
                    $tam = strlen($usuario->getSenha());
                    if ($tam == 32){
                        $situacao = $this->atualizar($usuario);
                    }else{
                        $situacao = $this->atualizarCrip($usuario);
                    }
					
				}

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}			

			return $situacao;
		}

		public function incluir($usuario){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	

				$sql = "INSERT INTO tbusuario(login, senha, email) VALUES (:login, :senha, :email)";

				$run = $pdo->prepare($sql);
				$run->bindValue(':login', $usuario->getLogin(), PDO::PARAM_STR); 
				$run->bindValue(':senha', md5($usuario->getSenha()), PDO::PARAM_STR); 
				$run->bindValue(':email', $usuario->getEmail(), PDO::PARAM_STR);  
	  			$run->execute(); 

				if($run->rowCount() > 0){
					$situacao = TRUE;
				}

				$usuario->setIdUsuario($pdo->lastInsertId());
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $situacao;
		}

		public function atualizar($usuario){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();
					
				$sql = "UPDATE tbusuario SET login = :login, senha = :senha, email = :email WHERE idUsuario = :idUsuario";

				$run = $pdo->prepare($sql);
				$run->bindValue(':idUsuario', $usuario->getIdUsuario(), PDO::PARAM_INT); 
				$run->bindValue(':login', $usuario->getLogin(), PDO::PARAM_STR); 
				$run->bindValue(':senha', $usuario->getSenha(), PDO::PARAM_STR); 
				$run->bindValue(':email', $usuario->getEmail(), PDO::PARAM_STR); 
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
        public function atualizarCrip($usuario){	
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();
					
				$sql = "UPDATE tbusuario SET login = :login, senha = :senha, email = :email WHERE idUsuario = :idUsuario";

				$run = $pdo->prepare($sql);
				$run->bindValue(':idUsuario', $usuario->getIdUsuario(), PDO::PARAM_INT); 
				$run->bindValue(':login', $usuario->getLogin(), PDO::PARAM_STR); 
				$run->bindValue(':senha', md5($usuario->getSenha()), PDO::PARAM_STR); 
				$run->bindValue(':email', $usuario->getEmail(), PDO::PARAM_STR); 
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

		public function excluir($usuario){

			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();	
					
				$sql = "DELETE FROM tbusuario WHERE idUsuario = :idUsuario";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idUsuario', $usuario->getIdUsuario(), PDO::PARAM_INT);			
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
					
				$sql = "DELETE FROM tbusuario WHERE idUsuario = :idUsuario";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idUsuario', $codigo, PDO::PARAM_INT);			
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
					
				$sql = "SELECT * FROM tbusuario";

				$run = $pdo->prepare($sql);			
				$run->execute(); 
				$resultado = $run->fetchAll();

				foreach ($resultado as $objeto){

					$usuario = new Usuario();
					$usuario->setIdUsuario($objeto['idUsuario']);
					$usuario->setLogin($objeto['login']);
					$usuario->setSenha($objeto['senha']);
					$usuario->setEmail($objeto['email']);
					array_push($objetos, $usuario);
				}	
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $objetos;

		}			
		
		public function buscarPorId($codigo){

			$usuario = new Usuario();
						
			try{

				$pdo = Banco::conectar();

				$sql = "SELECT * FROM tbusuario WHERE idUsuario = :idUsuario";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idUsuario', $codigo, PDO::PARAM_INT);			
				$run->execute(); 
				$resultado = $run->fetch();

				$usuario = new Usuario();
				$usuario->setIdUsuario($resultado['idUsuario']);
				$usuario->setLogin($resultado['login']);
				$usuario->setSenha($resultado['senha']);
				$usuario->setEmail($resultado['email']);

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}
			
			return $usuario;
		}		

		public function autenticar($login, $senha){

			$usuario = new Usuario();
						
			try{

				$pdo = Banco::conectar();

				$sql = "SELECT * FROM tbusuario WHERE login = :login AND senha = :senha";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':login', $login, PDO::PARAM_STR);			
	  			$run->bindValue(':senha', md5($senha), PDO::PARAM_STR);	
				$run->execute(); 
				$resultado = $run->fetch();

				$usuario = new Usuario();
				$usuario->setIdUsuario($resultado['idUsuario']);
				$usuario->setLogin($resultado['login']);
				$usuario->setSenha($resultado['senha']);
				$usuario->setEmail($resultado['email']);

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}
			
			return $usuario;
		}	

		public function verificarLogin($codigo, $login){

			$situacao = TRUE;
			try{
				
				$pdo = Banco::conectar();	
					
				$sql = "SELECT * FROM tbusuario WHERE idUsuario <> :idUsuario AND login = :login";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':idUsuario', $codigo, PDO::PARAM_INT);			
	  			$run->bindValue(':login', $login, PDO::PARAM_STR);	
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
		public function buscarPorEmail($email){

			$usuario = new Usuario();
						
			try{

				$pdo = Banco::conectar();

				$sql = "SELECT * FROM tbusuario WHERE email = :email";

				$run = $pdo->prepare($sql);
	  			$run->bindValue(':email', $email, PDO::PARAM_STR);			
				$run->execute(); 
				$resultado = $run->fetch();

				$usuario = new Usuario();
				$usuario->setIdUsuario($resultado['idUsuario']);
				$usuario->setLogin($resultado['login']);
				$usuario->setEmail($resultado['email']);

			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}
			
			return $usuario;
		}
		
		public function atualizarSenha($idUsuario, $senhaGerada){
			$situacao = FALSE;
			try{
				
				$pdo = Banco::conectar();
					
				$sql = "UPDATE tbusuario SET senha = :senha WHERE idUsuario = :idUsuario";

				$run = $pdo->prepare($sql);
				$run->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);  
				$run->bindValue(':senha', md5($senhaGerada), PDO::PARAM_STR); 
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

	}
	
?>
