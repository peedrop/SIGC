<?php
	class Produto{
        
        private  $idProduto;
        private  $nome;
        private  $idTipo;
        private  $idMarca;
        private  $estoqueMin;
        private  $descricao;
        private  $valor;
        private  $quantidade;
                
        function __construct() {
            $this->setIdProduto(0);
            $this->setNome("");
            $this->setIdTipo(0);
            $this->setIdMarca(0);
            $this->setEstoqueMin(0);
            $this->setDescricao("");
            $this->setValor(0.00);
            $this->setQuantidade(0);
        }
		
        public function getIdProduto(){
            return $this->idProduto;
	    }
        public function setIdProduto($idProduto){
            $this->idProduto = $idProduto;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function getIdTipo(){
            return $this->idTipo;
        }

        public function setIdTipo($idTipo){
            $this->idTipo = $idTipo;
        }

        public function getIdMarca(){
            return $this->idMarca;
        }

        public function setIdMarca($idMarca){
            $this->idMarca = $idMarca;
        }

        public function getEstoqueMin(){
            return $this->estoqueMin;
        }

        public function setEstoqueMin($estoqueMin){
            $this->estoqueMin = $estoqueMin;
        }

        public function getDescricao(){
            return $this->descricao;
        }

        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }
        public function getValor(){
            return $this->valor;
        }

        public function setValor($valor){
            $this->valor = $valor;
        }
        public function getQuantidade(){
            return $this->quantidade;
        }

        public function setQuantidade($quantidade){
            $this->quantidade = $quantidade;
        }
	}
?>
