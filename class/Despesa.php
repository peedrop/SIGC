<?php
	class Despesa{
        
        private  $idDespesa;
        private  $nome;
        private  $descricao;
        private  $dataVencimento;
        private  $valor;
        private  $situacao;
                
        function __construct() {
            $this->setIdDespesa(0);
            $this->setNome("");
            $this->setDescricao("");
            $this->setDataVencimento("");
            $this->setValor("");
            $this->setSituacao(0);
        }

		function __toString(){
			return $this->getIdDespesa();
		}
        
        public function getIdDespesa(){
            return $this->idDespesa;
        }

        public function setIdDespesa($idDespesa){
            $this->idDespesa = $idDespesa;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function getDescricao(){
            return $this->descricao;
        }

        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }

        public function getDataVencimento(){
            return $this->dataVencimento;
        }

        public function setDataVencimento($dataVencimento){
            $this->dataVencimento = $dataVencimento;
        }

        public function getValor(){
            return $this->valor;
        }

        public function setValor($valor){
            $this->valor = $valor;
        }

        public function getSituacao(){
            return $this->situacao;
        }

        public function setSituacao($situacao){
            $this->situacao = $situacao;
        } 
	}
?>
