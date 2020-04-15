<?php

	include("../../arquivos/mpdf/mpdf.php");
	require_once '../../class/PedidoDAO.php';
    require_once '../../class/ClienteDAO.php';
    require_once '../../class/PedidoProdutoDAO.php';

	$mpdf = new mPDF();
	$mpdf->SetDisplayMode("fullpage");

	$html = "<div id='area02'>
				<img  width = '100%' src='../../arquivos/img/cabecalho.png'>
			</div>";

	$inicio = $_POST["inicio"];
    $fim = $_POST["fim"];

    $datas = '<i> • Relatório gerado ' . $inicio . ' entre os dias <strong>' . date("d/m/Y", strtotime($inicio)) . '</strong> e <strong>' . date("d/m/Y", strtotime($fim)) . '</strong></i>';
    $html = $html . 
			"<div id = 'area04'>
				<h1 class='titulo' > Pedidos por Cliente </h1>	
			</div>{$datas}";

    

	$html = $html . "<div id='area03'> <hr>";

	$clienteDAO = new ClienteDAO();
	$pedidoDAO = new PedidoDAO();
	$pedidoProdutoDAO = new PedidoProdutoDAO();

	$lista = $clienteDAO->listarComPedidos($inicio,$fim);
    
    if ($lista == null){
        $html = $html . "<h3 id='ver'>Não ocorreram vendas nesse período!</h3>";
    }

	foreach($lista as $cliente){
        $html = $html . "<div class='fundo1'>";
		$html = $html .	"<td><strong>Nome do Cliente: </strong>{$cliente->getNome()}</td> <br>";
		$html = $html .	"<td><strong>CPF: </strong>{$cliente->getCpf()}</td> <br>";
		$html = $html .	"<td><strong>Telefone: </strong>{$cliente->getTelefone()}</td> <br>";

		$html = $html . "</div>";
		$html = $html . "<hr>";

		$lista2 = $pedidoDAO->listarPorCliente($cliente, $inicio, $fim);
		foreach($lista2 as $pedido){
            $html = $html . "<div id='idPed'>";
			$html = $html .	"<td><strong>Nº Pedido: </strong>{$pedido->getIdPedido()}</td>";
            $html = $html . "</div>";
            $dataPedido = date("d/m/Y", strtotime($pedido->getDataPedido()));
			$html = $html .	"<td><strong> Data do Pedido: </strong>{$dataPedido}</td> <br>";

				$lista3 = $pedidoProdutoDAO->listarPorPedido($pedido->getIdPedido());
				$html = $html . "<br><table><thead>";
				$html = $html .	" <tr><td width='40%'><strong>Produto</strong></td>";
				$html = $html .	" <td width='20%'><strong>Valor</strong></td> ";
				$html = $html .	" <td width='20%'><strong>Quant.</strong></td></tr> <br>";
				$html = $html .	" <td width='20%'><strong>SubTotal</strong></td> ";
				$html = $html . "</thead> <br> 	<tbody>";
				$total = 0;
				foreach($lista3 as $pedidoProduto){

					$html = $html .	"<tr><td>{$pedidoProduto->getProduto()->getNome() }</td>";
					$html = $html .	"<td>{$pedidoProduto->getValor()}</td>";
					$html = $html .	"<td>{$pedidoProduto->getQuantidade()}</td>";
					$subtotal = $pedidoProduto->getValor();
					$subtotal = $subtotal * $pedidoProduto->getQuantidade();
					$total = $total + $subtotal;
					$html = $html .	"<td>{$subtotal} </td></tr><br>";
				}
				$html = $html .	"<tr><td></td>";
				$html = $html .	"<td></td>";
				$html = $html .	"<td></td>";
				$html = $html .	"<td><hr>Total: R$ ".number_format($total, 2, ',', '.')."</td></tr>";

				$html = $html . "</tbody></table>";
			$html = $html . "<hr>";
		}

	}

	$html = $html . "</div>";


    
	$dataEmissao = date("d/m/Y H:i:s");

	$css = file_get_contents('../../arquivos/css/RelatorioPedidoUsuarioImpressao.css');

	$mpdf->WriteHTML($css, 1);
	$mpdf->SetHeader('');
	$mpdf->setFooter("Emissão: {$dataEmissao} | | {PAGENO} de {nb}"); 
	$mpdf->WriteHTML($html, 2);

	$mpdf->Output('RelatorioPedidoUsuarioImpressao.pdf',I);

	exit();

?>
