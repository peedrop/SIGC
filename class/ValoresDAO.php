<?php	
    require_once 'Banco.php';
	class ValoresDAO
	{
        public function buscarEntradaHoje(){

			$entrada = 0;

			try{
				
				$pdo = Banco::conectar();
					
				$sql = "select sum(valor) as entrada
                from tbpedido
                where dataPedido = date(now())";

				$run = $pdo->prepare($sql); 			
				$run->execute();
				$resultado = $run->fetchcolumn();
                if ($resultado > 0){
                    $entrada = $resultado;
                }
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $entrada;

		}
        public function buscarSaidaHoje(){

			$saida = 0;

			try{
				
				$pdo = Banco::conectar();
					
				$sql = "select sum((IFNULL((select sum(precoCusto * quantidade) as saida
                from tbremessa
                where dataRemessa = date(now())),0))+(IFNULL((select sum(valor)
                from tbdespesa
                where dataVencimento = date(now())
                and situacao = 1),0))) as saida";

				$run = $pdo->prepare($sql); 			
				$run->execute();
				$resultado = $run->fetchcolumn();
                if ($resultado > 0){
                    $saida = $resultado;
                }
				
			}catch(Exception $ex){
				echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
			}finally {
				Banco::desconectar();
			}		

			return $saida;

		}	

	}
	
?>
