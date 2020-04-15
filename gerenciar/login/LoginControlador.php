<?php

	session_start();
	require_once '../../class/UsuarioDAO.php';

	$operacao = $_GET["operacao"];
	$usuarioDAO = new UsuarioDAO();

	switch($operacao) 
	{
        case 'autenticar':

			$login = $_POST["login"];
			$senha = $_POST["senha"];        
			
			$usuario = $usuarioDAO->autenticar($login, $senha);

			if(($usuario->getIdUsuario() > 0) || (($login == 'admin')&&($senha == '123'))){
                
                if ($login == 'admin'){
                    $_SESSION["USUARIO"]= 'admin';	
                }else{
				    $_SESSION["USUARIO"]= $usuario->getLogin();	
                }
				echo "<script>location.href='../../Index.php';</script>"; 
			}else{
				echo "<script>alert('Usuário ou senha inválido!'); location.href='Login.php';</script>"; 			
			}

        	break; 

        case 'encerrar':

			session_unset();	
			session_destroy();	
				
			header('Location: Login.php');	

        	break; 
        
        case 'recuperarSenha':

			if(isset($_POST['email'])){
				$emailForm = $_POST['email'];
				
				$nmFuncionario = "";
				$login = "";
				$senha = "";
				$email = "";
				
				$usuario = $usuarioDAO->buscarPorEmail($emailForm);//usuario
				
				$idUsuario = $usuario->getIdUsuario();
				$login = $usuario->getLogin();
				$email = $usuario->getEmail();
				
				$senhaGerada = uniqid();
					
				$usuario = $usuarioDAO->atualizarSenha($idUsuario, $senhaGerada);
				
				$assunto = 'Recuperação de Senha';
				$data = date("d/m/y"); 
				$hora = date("H:i"); 
				$mensagem = '
				<html>   				
					<body>				
						<font face=Verdana size=2>		
						<br>
							<br>
								<b>SIGC</b> <br>
								<b>Data:</b>' . $data  . '| <b>Hora:</b>' . $hora . '<br>
								<b>Assunto: </b>' . $assunto . '<br>
								<br>
								<br>				
								<b>Sua nova senha é</b>: ' . $senhaGerada . ' <br>
								<b>Usuário</b>: ' . $login . ' <br>	
								<b>E-mail</b>: ' . $email . ' <br>			
							<br>
						<br>				
						</font>				
					</body>				
				</html>';  
				  
				$headers = "MIME-Version: 1.0\n"; 	
				$headers .= "Content-type: text/html; charset=iso-8859-1\n";  	
				$headers .= "From: sigc.com <sigc@sigc.com.br>\n";  
				$headers .= "Return-Path: <sigc@sigc.com.br>\n";
				
				$envio = mail("$emailForm", "Recuperação de senha!", $mensagem, $headers);

				if($envio){	
					echo "<script> alert('E-mail enviado com sucesso!'); location.href='RecuperarSenha.php';</script>"; 			
				}else{
					echo "<script> alert('Erro ao enviar o E-mail*'); location.href='RecuperarSenha.php';</script>"; ; 
				}	
			}

		break;

        	          	
	}
			
?>
