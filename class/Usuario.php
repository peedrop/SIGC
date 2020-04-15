<?php
	class Usuario
	{
        private  $idUsuario;
        private  $login;
        private  $senha;
        private  $email;
                
        function __construct() {
            $this->setIdUsuario(0);
            $this->setLogin("");
            $this->setSenha("");
            $this->setEmail("");
        }

		function __toString() 
		{
			return $this->getLogin();
		}

        function getIdUsuario(){
            return $this->idUsuario;
        }
        function setIdUsuario($idUsuario){
            $this->idUsuario = intval($idUsuario);
        }

        function getLogin(){
            return $this->login;
        }
        function setLogin($login){
            $this->login = $login;
        }        

        function getSenha(){
            return $this->senha;
        }
        function setSenha($senha){
            $this->senha = $senha;
        }   

        function getEmail(){
            return $this->email;
        }
        function setEmail($email){
            $this->email = $email;
        }  

	}
?>
