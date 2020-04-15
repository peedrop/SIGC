<?php
	
	include("../../class/Banco.php");
	include("../../arquivos/mpdf/mpdf.php");
	require_once '../../class/PedidoDAO.php';
	require_once '../../class/PedidoProdutoDAO.php';

	$mpdf = new mPDF();
	$mpdf->SetDisplayMode("fullpage");
	
	$html = "<div id='area02'>
				<img  width = '100%' src='../../arquivos/img/cabecalho.png'>
			</div>		
			";
	$inicio = $_POST["inicio"];
    $fim = $_POST["fim"];
    $datas = '<i> • Relatório gerado entre os dias <strong>' . date("d/m/Y", strtotime($inicio)) . '</strong> e <strong>' . date("d/m/Y", strtotime($fim)) . '</strong></i>';
	$html = $html . 
			"<div id = 'area04'>
				<h1 class='titulo' > Vendas por Período </h1>	
			</div>
			<div id='area03'>
            {$datas}
				<table class='tabela' border=1 cellspacing=0 cellpadding=2 >
					<thead>
						<tr>
							<th width='30%' class='corAzul'><center>Cliente</center></th>
                            <th width='20%' class='corVermelha'><center>Produtos</center></th>
							<th width='15%' class='corVerde'><center>Forma de pagamento</center></th>
							<th width='20%' class='corVermelha'><center>Data</center></th>
							<th width='15%' class='corAzul'><center>Valor</center></th>
						</tr>
					</thead>
					<tbody>";
    
	$pedidoDAO = new PedidoDAO();
    $pedidoProdutoDAO = new PedidoProdutoDAO();
    $lista = $pedidoDAO->listarEntreDatas($inicio, $fim);	
    $formaPagamento = null;
	$total = 0;
    
    foreach($lista as $pedido){	
    	$html = $html .	"<tr>";	
    	$nomeCliente = $pedido->getCliente()->getNome();
    	$html = $html .	"<td><center>{$nomeCliente}</center></td>";
        
        $lista = $pedidoProdutoDAO->listarPorPedidoAgrupado($pedido->getIdPedido());
        
        $html = $html ."<td>";
        foreach($lista as $pedidoProduto){
            $html = $html ."{$pedidoProduto[0]} / ";				
        }
        $html = $html ."</td>";
        	
        if ($pedido->getFormaPagamento() == 1){
            $formaPagamento = 'Dinheiro';
        }
        if ($pedido->getFormaPagamento() == 2){
            $formaPagamento = 'Cartão';
        }
        if ($pedido->getFormaPagamento() == 3){
            $formaPagamento = 'Crediário';
        }

        $html = $html .	"<td><center>{$formaPagamento}</center></td>";

        $data = date("d/m/Y", strtotime($pedido->getDataPedido()));
        
        $html = $html .	"<td><center>{$data}</center></td>";								
        $valor = $pedido->getValor();
        $html = $html .	"<td><center>R$ ".number_format($valor, 2, ',', '.')."</center></td>";
        $html = $html . "</tr>";
		$total += $valor;
    }

	$html = $html .	"<tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class='corVermelha'><strong><center>Total:</center></strong></td>
                        <td><strong><center>R$ ".number_format($total, 2, ',', '.')."</center></strong></td>
                    </tr>";
					
	$html = $html . "</tbody> </table> </div>";

	
	$dataEmissao = date("d/m/Y H:i:s");
	
	$css = file_get_contents('../../arquivos/css/relatorios.css');
	
	$mpdf->WriteHTML($css, 1);		
	$mpdf->SetHeader('');
	$mpdf->setFooter("Emissão: {$dataEmissao} | | {PAGENO} de {nb}"); 
	$mpdf->WriteHTML($html, 2);
	
	$mpdf->Output('RelatorioVenda.pdf',I);

	exit();
	
	

	

?>
