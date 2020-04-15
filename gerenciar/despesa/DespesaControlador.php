<?php

	require_once '../../class/DespesaDAO.php';
	$despesaDAO = new DespesaDAO();
	$despesa = new Despesa();

	$operacao = $_GET["operacao"];

	switch($operacao) 
	{
        case 'salvar':

			$despesa->setIdDespesa($_POST["idDespesa"]);
			$despesa->setNome($_POST["nome"]);
            $despesa->setDescricao($_POST["descricao"]);
            $despesa->setDataVencimento($_POST["dataVencimento"]);
            $despesa->setValor($_POST["valor"]);
            $despesa->setSituacao($_POST["situacao"]);
            
            $resultado = $despesaDAO->salvar($despesa);

			if($resultado == 1){
				echo "<script>alert('Registro salvo com sucesso !!!'); location.href='TabelaDespesa.php';</script>"; 
			}else{
				echo "<script>alert('Erro ao salvar o registro'); location.href='TabelaDespesa.php';</script>"; 			
			}

        	break; 

        case 'excluir':
			
			$resultado = $despesaDAO->excluirPorId($_GET["idDespesa"]);

			if($resultado == 1){
				echo "<script>alert('Registro excluido com sucesso !!!'); location.href='TabelaDespesa.php';</script>"; 
			}else{
				echo "<script>alert('Erro ao excluir o registro'); location.href='TabelaDespesa.php';</script>"; 			
			}			
        	break;         	
	}
			
?>
