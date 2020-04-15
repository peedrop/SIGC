<?php
	class Cliente{
        
        private  $idCliente;
        private  $nome;
        private  $cpf;
        private  $rg;
        private  $telefone;
        private  $dataNascimento;
        
        private  $estado;
        private  $cidade;
        private  $bairro;
        private  $rua;
        private  $cep;
        private  $numero;
        private  $complemento;
                
        function __construct() {
            $this->setIdCliente(0);
            $this->setNome("");
            $this->setCpf("");
            $this->setRg("");
            $this->setTelefone("");
            $this->setDataNascimento("");
            
            $this->setEstado("");
            $this->setCidade("");
            $this->setBairro("");
            $this->setRua("");
            $this->setCep("");
            $this->setNumero("");
            $this->setComplemento("");
        }

		function __toString(){
			return $this->getIdCliente();
		}
        public function getIdCliente(){
            return $this->idCliente;
	    }
        public function setIdCliente($idCliente){
            $this->idCliente = $idCliente;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function getCpf(){
            return $this->cpf;
        }

        public function setCpf($cpf){
            $this->cpf = $cpf;
        }

        public function getRg(){
            return $this->rg;
        }

        public function setRg($rg){
            $this->rg = $rg;
        }

        public function getTelefone(){
            return $this->telefone;
        }

        public function setTelefone($telefone){
            $this->telefone = $telefone;
        }

        public function getDataNascimento(){
            return $this->dataNascimento;
        }

        public function setDataNascimento($dataNascimento){
            $this->dataNascimento = $dataNascimento;
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
