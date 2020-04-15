<?php
	
	include("../../class/Banco.php");
	include("../../arquivos/mpdf/mpdf.php");
	require_once '../../class/ProdutoDAO.php';
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
				<h1 class='titulo'> Venda de Produtos </h1>	
			</div>
			<div id='area03'>
                {$datas}
				<table class='tabela' border=1 cellspacing=0 cellpadding=2 >
					<thead>
						<tr>
							<th width='40%' class='corAzul'><center>Nome</center></th>
							<th width='30%' class='corVermelha'><center>Quantidade Vendida</center></th>
                            <th width='30%' class='corVerde'><center>Valor Vendido</center></th>
						</tr>
					</thead>
					<tbody>";
				
    $produtoDAO = new ProdutoDAO();
    $pedidoProdutoDAO = new PedidoProdutoDAO();

    $lista = $pedidoProdutoDAO->listarAgrProd();
    $totalQnt = 0;
    $totalValor = 0.00;

    foreach($lista as $pedidoProduto){
        if (strtotime($pedidoProduto->getPedido()->getDataPedido()) >= strtotime($inicio) &&
            strtotime($pedidoProduto->getPedido()->getDataPedido()) <= strtotime($fim)){
        $qntVendProd = $pedidoProdutoDAO->buscarQntVendProd($pedidoProduto->getProduto()->getIdProduto());
        $totalQnt += $qntVendProd;
        
        $valorVendProd = $pedidoProdutoDAO->buscarValorVendProd($pedidoProduto->getProduto()->getIdProduto());
        $totalValor += $valorVendProd;
   
    	$html = $html .	"<tr>";	
    	$html = $html .	"<td><center>{$pedidoProduto->getProduto()->getNome()}</center></td>";
        $html = $html .	"<td><center>{$qntVendProd}</center></td>";
        $html = $html .	"<td><center>R$ ".number_format($valorVendProd, 2, ',', '.')."</center></td>";
        $html = $html . "</tr>";
        
    }
    }
    $html = $html .	"<tr>
                        <td class='corVermelha'><strong><center>Total:</center></strong></td>
                        <td><strong><center>{$totalQnt}</center></strong></td>
                        <td><strong><center>R$ ".number_format($totalValor, 2, ',', '.')."</center></strong></td>
                    </tr>";
					
	$html = $html . "</tbody>
                        </table>
                    </div>";

	$dataEmissao = date("d/m/Y H:i:s");
	
	$css = file_get_contents('../../arquivos/css/relatorios.css');
	
	$mpdf->WriteHTML($css, 1);		
	$mpdf->SetHeader('');
	$mpdf->setFooter("Emissão: {$dataEmissao} | | {PAGENO} de {nb}"); 
	$mpdf->WriteHTML($html, 2);
	
	$mpdf->Output('RelatorioLucroProdutos.pdf',I);
    
	exit();


?>
