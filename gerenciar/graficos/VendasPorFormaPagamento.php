<?php
	require_once '../../class/Banco.php';

    try{	
            $pdo = Banco::conectar();

            $sql = "select formaPagamento as formaPagamento, sum(valor) as valor
            from tbpedido
            where MONTH(dataPedido) = MONTH(now())
            and YEAR(dataPedido) = YEAR(now())
            group by formaPagamento";

            $run = $pdo->prepare($sql);			
            $run->execute(); 
            $resultado = $run->fetchAll();

            $valores = array();	
	        $formasPagamentos = array();
            
            foreach ($resultado as $linha){	
                array_push($valores, $linha['valor']);
                if ($linha['formaPagamento'] == 1){
                    array_push($formasPagamentos, 'Dinheiro');
                }
                if ($linha['formaPagamento'] == 2){
                    array_push($formasPagamentos, 'Cartão');
                }
                if ($linha['formaPagamento'] == 3){
                    array_push($formasPagamentos, 'Crediário');
                }
                	
            }
        
            $dados = array(array('formasPagamentos' => $formasPagamentos, 'valores' => $valores));
	        echo json_encode($dados);

        }catch(Exception $ex){
            echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
        }finally {
            Banco::desconectar();
        }
?>
