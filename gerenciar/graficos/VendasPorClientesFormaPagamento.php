<?php
	require_once '../../class/Banco.php';

    try{	
            $pdo = Banco::conectar();

            $sql = "SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(nome, ' ', 1), ' ', -1)  AS nome
              ,SUM(IFNULL((SELECT SUM(tbpedidoproduto.valor)
            FROM tbpedidoproduto
            WHERE 
                tbpedidoproduto.idPedido = tbpedido.idPedido
            AND tbpedido.formaPagamento = 1),0))  AS dinheiro  
              ,SUM(IFNULL((SELECT SUM(tbpedidoproduto.valor)
            FROM tbpedidoproduto
            WHERE 
                tbpedidoproduto.idPedido = tbpedido.idPedido
            AND tbpedido.formaPagamento = 2),0))  AS cartao 
            ,SUM(IFNULL((SELECT SUM(tbpedidoproduto.valor)
            FROM tbpedidoproduto
            WHERE 
                tbpedidoproduto.idPedido = tbpedido.idPedido
            AND tbpedido.formaPagamento = 3),0))  AS crediario
            FROM tbpedido, tbcliente
            WHERE tbpedido.idcliente = tbcliente.idcliente
            and MONTH(tbpedido.dataPedido)  =  MONTH(NOW())
            AND YEAR(tbpedido.dataPedido)  =  YEAR(NOW())
            GROUP BY nome
            ORDER BY nome;";

            $run = $pdo->prepare($sql);			
            $run->execute(); 
            $resultado = $run->fetchAll();

	        $nomes = array();
	        $dinheiros = array();
	        $cartoes = array();
	        $crediarios = array();
             
            foreach ($resultado as $linha){	
                array_push($nomes, $linha['nome']);
                array_push($dinheiros, $linha['dinheiro']);
                array_push($cartoes, $linha['cartao']);
                array_push($crediarios, $linha['crediario']);
            }
        
            $dados = array(array('nomes' => $nomes, 'dinheiros' => $dinheiros, 'cartoes' => $cartoes, 'crediarios' => $crediarios));
	        echo json_encode($dados);

        }catch(Exception $ex){
            echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
        }finally {
            Banco::desconectar();
        }
?>
