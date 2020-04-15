<?php
	class Remessa{
        
        private  $idRemessa;
        private  $idProduto;
        private  $precoCusto;
        private  $precoVarejo;
        private  $quantidade;
        private  $dataRemessa;
                
        function __construct() {
            $this->setIdRemessa(0);
            $this->setIdProduto(0);
            $this->setPrecoCusto("");
            $this->setPrecoVarejo("");
            $this->setQuantidade("");
            $this->setDataRemessa("");
        }
		
        public function getIdRemessa(){
            return $this->idRemessa;
	    }
        public function setIdRemessa($idRemessa){
            $this->idRemessa = $idRemessa;
        }

        public function getIdProduto(){
            return $this->idProduto;
        }

        public function setIdProduto($idProduto){
            $this->idProduto = $idProduto;
        }

        public function getPrecoCusto(){
            return $this->precoCusto;
        }

        public function setPrecoCusto($precoCusto){
            $this->precoCusto = $precoCusto;
        }

        public function getPrecoVarejo(){
            return $this->precoVarejo;
        }

        public function setPrecoVarejo($precoVarejo){
            $this->precoVarejo = $precoVarejo;
        }

        public function getQuantidade(){
            return $this->quantidade;
        }

        public function setQuantidade($quantidade){
            $this->quantidade = $quantidade;
        }
        
        public function getDataRemessa(){
            return $this->dataRemessa;
        }

        public function setDataRemessa($dataRemessa){
            $this->dataRemessa = $dataRemessa;
        }

	}
?>
