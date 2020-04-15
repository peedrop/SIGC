<?php
	require_once '../../class/Banco.php';

    try{	
            $pdo = Banco::conectar();

            $sql = "select dataPedido, sum(valor) as valor
            from tbpedido
            group by dataPedido
            order by dataPedido desc
            limit 4;";

            $run = $pdo->prepare($sql);			
            $run->execute(); 
            $resultado = $run->fetchAll();

            $dias = array();	
	        $valores = array();
            
            foreach ($resultado as $linha){	
                array_push($dias, date("d/m/Y", strtotime($linha['dataPedido']))); 
                array_push($valores, $linha['valor']);
            }
        
            $dados = array(array('dias' => $dias, 'valores' => $valores));
	        echo json_encode($dados);

        }catch(Exception $ex){
            echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
        }finally {
            Banco::desconectar();
        }
?>
