<?php
	class Endereco{
        
        private  $idEndereco;
        private  $estado;
        private  $cidade;
        private  $bairro;
        private  $rua;
        private  $cep;
        private  $numero;
        private  $complemento;
                
        function __construct() {
            $this->setIdEndereco(0);
            $this->setEstado("");
            $this->setCidade("");
            $this->setBairro("");
            $this->setRua("");
            $this->setCep("");
            $this->setNumero("");
            $this->setComplemento("");
        }

		function __toString(){
			return $this->getIdConta();
		}
        public function getIdEndereco(){
            return $this->idEndereco;
	   }

        public function setIdEndereco($idEndereco){
            $this->idEndereco = $idEndereco;
        }

        public function getEstado(){
            return $this->estado;
        }

        public function setEstado($estado){
            $this->estado = $estado;
        }

        public function getCidade(){
            return $this->cidade;
        }

        public function setCidade($cidade){
            $this->cidade = $cidade;
        }

        public function getBairro(){
            return $this->bairro;
        }

        public function setBairro($bairro){
            $this->bairro = $bairro;
        }

        public function getRua(){
            return $this->rua;
        }

        public function setRua($rua){
            $this->rua = $rua;
        }

        public function getCep(){
            return $this->cep;
        }

        public function setCep($cep){
            $this->cep = $cep;
        }

        public function getNumero(){
            return $this->numero;
        }

        public function setNumero($numero){
            $this->numero = $numero;
        }

        public function getComplemento(){
            return $this->complemento;
        }

        public function setComplemento($complemento){
            $this->complemento = $complemento;
        }
	}
?>
