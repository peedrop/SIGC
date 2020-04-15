<?php
	require_once '../../class/Banco.php';

    try{	
            $pdo = Banco::conectar();

            $sql = "select SUBSTRING_INDEX(SUBSTRING_INDEX(nome, ' ', 1), ' ', -1)  AS nome, sum(valor) as valor
            from tbcliente c, tbpedido p
            where c.idcliente = p.idcliente
            and MONTH(dataPedido) = MONTH(now())
            and YEAR(dataPedido) = YEAR(now())
            group by nome
            order by valor desc;";

            $run = $pdo->prepare($sql);			
            $run->execute(); 
            $resultado = $run->fetchAll();

            $valores = array();	
	        $nomes = array();
            
            foreach ($resultado as $linha){	
                array_push($valores, $linha['valor']); 
                array_push($nomes, $linha['nome']);
            }
        
            $dados = array(array('nomes' => $nomes, 'valores' => $valores));
	        echo json_encode($dados);

        }catch(Exception $ex){
            echo $ex->getFile().' : '.$ex->getLine().' : '.$ex->getMessage();
        }finally {
            Banco::desconectar();
        }
?>
