<?php

	require_once '../../class/ClienteDAO.php';
	$clienteDAO = new ClienteDAO();
	$cliente = new Cliente();

	$operacao = $_GET["operacao"];

	switch($operacao) 
	{
        case 'salvar':
    
            //cliente
			$cliente->setIdCliente($_POST["idCliente"]);
			$cliente->setNome($_POST["nome"]);
            $cliente->setCpf($_POST["cpf"]);
            $cliente->setRg($_POST["rg"]);
            $cliente->setTelefone($_POST["telefone"]);
            $cliente->setDataNascimento($_POST["dataNascimento"]);
            
            //endereco
            $cliente->setEstado($_POST["estado"]);
            $cliente->setCidade($_POST["cidade"]);
            $cliente->setBairro($_POST["bairro"]);
            $cliente->setRua($_POST["rua"]);
            $cliente->setCep($_POST["cep"]);
            $cliente->setNumero($_POST["numero"]);
            $cliente->setComplemento($_POST["complemento"]);
            
            $resultado = $clienteDAO->salvar($cliente);

			if($resultado == 1){
				echo "<script>alert('Registro salvo com sucesso !!!'); location.href='TabelaCliente.php';</script>"; 
			}else{
				echo "<script>alert('Erro ao salvar o registro'); location.href='TabelaCliente.php';</script>"; 			
			}

        	break; 

        case 'excluir':
            $resultado = $clienteDAO->excluirPorId($_GET["idCliente"]);

			if($resultado == 1){
				echo "<script>alert('Registro excluido com sucesso !!!'); location.href='TabelaCliente.php';</script>"; 
			}else{
				echo "<script>alert('Erro ao excluir o registro'); location.href='TabelaCliente.php';</script>"; 			
			}			
        	break;  
        
        case 'verificarCpf':
			
			$cpf = $_POST["cpf"];
			$idCliente = $_GET["idCliente"];

			$resultado = $clienteDAO->verificarCpf($idCliente, $cpf);

			echo json_encode( $resultado );

		
        	break;
	}
			
?>
