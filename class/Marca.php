<?php
	class Marca{
        
        private  $idMarca;
        private  $nome;
       
                
        function __construct() {
            $this->setIdMarca(0);
            $this->setNome("");
        }
        function __toString(){
			return $this->getNome();
		}
        public function getIdMarca(){
            return $this->idMarca;
	    }
        public function setIdMarca($idMarca){
            $this->idMarca = $idMarca;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }
	}
?>
