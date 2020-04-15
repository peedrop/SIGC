<?php
	require_once 'Cliente.php';
	 
	class Pedido
	{
        private  $idPedido;        
		private  $cliente;
        private  $dataPedido;
        private  $horaPedido;
        private  $formaPagamento;
        private  $parcelas;
        private  $valor;
    
        function __construct() {
            $this->setIdPedido(0);
			$cliente = new Cliente();
			$this->setCliente($cliente);
			$this->setDataPedido("");
            $this->setHoraPedido("");
            $this->setFormaPagamento(0);
            $this->setParcelas(1);
            $this->setValor(0.00);
        }
        
		public function getIdPedido(){
            return $this->idPedido;
        }

        public function setIdPedido($idPedido){
            $this->idPedido = $idPedido;
        }

        public function getCliente(){
            return $this->cliente;
        }

        public function setCliente($cliente){
            $this->cliente = $cliente;
        }

        public function getDataPedido(){
            return $this->dataPedido;
        }

        public function setDataPedido($dataPedido){
            $this->dataPedido = $dataPedido;
        }
        
        public function getHoraPedido(){
            return $this->horaPedido;
        }

        public function setHoraPedido($horaPedido){
            $this->horaPedido = $horaPedido;
        }
        
        public function getFormaPagamento(){
            return $this->formaPagamento;
        }

        public function setFormaPagamento($formaPagamento){
            $this->formaPagamento = $formaPagamento;
        }
        
        public function getParcelas(){
            return $this->parcelas;
        }

        public function setParcelas($parcelas){
            $this->parcelas = $parcelas;
        }
        
        public function getValor(){
            return $this->valor;
        }

        public function setValor($valor){
            $this->valor = $valor;
        }
        
	}
?>
