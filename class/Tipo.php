<?php
	class Tipo{
        
        private  $idTipo;
        private  $nome;
       
                
        function __construct() {
            $this->setIdTipo(0);
            $this->setNome("");
        }

		function __toString(){
			return $this->getIdConta();
		}
        public function getIdTipo(){
            return $this->idTipo;
	    }
        public function setIdTipo($idTipo){
            $this->idTipo = $idTipo;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }
	}
?>
