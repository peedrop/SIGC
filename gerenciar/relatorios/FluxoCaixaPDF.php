<?php
    
	include("../../class/Banco.php");
	include("../../arquivos/mpdf/mpdf.php");
	require_once '../../class/PedidoDAO.php';
	require_once '../../class/DespesaDAO.php';

	$mpdf = new mPDF();
	$mpdf->SetDisplayMode("fullpage");
    
$dataInicio = $_POST["inicio"];
    $dataFim = $_POST["fim"];
$datas = '<i> • Relatório gerado entre os dias <strong>' . date("d/m/Y", strtotime($dataInicio)) . '</strong> e <strong>' . date("d/m/Y", strtotime($dataFim)) . '</strong></i>';
	$html = "
					 		<img  width = '100%' src='../../arquivos/img/cabecalho.png'>
				   
					 
							<h1 class='titulo'> Fluxo de caixa </h1>
					   {$datas}
					    <h3 class='titulo'>↑ Entradas ↑</h3>
							<table class='tabela' border=1 cellspacing=0 cellpadding=2 >
								<thead>
									<tr>
										<th width='30%' class='corAzul'><center>Data</center></th>
										<th width='35%' class='corVerde'><center>Entrada</center></th>
										<th width='35%' class='corVermelha'><center>Saldo</center></th>
									</tr>
								</thead>
								<tbody>";



	$pedidoDAO = new PedidoDAO();
    $entradas = $pedidoDAO->listarEntradas($dataInicio, $dataFim);
    $qntEnt = count($entradas);
	$saldoEntrada = 0;

	$despesaDAO = new DespesaDAO();
    $saidas = $despesaDAO->listarSaidas($dataInicio, $dataFim);
    $qntSai = count($saidas);
	$saldoSaida = 0;

    foreach($entradas as $entrada){
        $html = $html .	"<tr>";
        $data = date("d/m/Y", strtotime($entrada[0]));
        $html = $html .	"<td><center>{$data}</center></td>";
        $html = $html .	"<td><center>R$ ".number_format($entrada[1], 2, ',', '.')."</center></td>";
        $saldoEntrada += $entrada[1];
        $html = $html .	"<td><center>R$ ".number_format($saldoEntrada, 2, ',', '.')."</center></td>";
        $html = $html . "</tr>";
    }
		$html = $html .	"<tr>";
		$html = $html .	"<td></td>";
		$html = $html .	"<td class='corVermelha'><strong><center>Saldo final entradas:</center></strong></td>";
		$html = $html .	"<td><center>R$ ".number_format($saldoEntrada, 2, ',', '.')."</center></td>";
		$html = $html .	"</tr>";

	$html = $html . "</tbody>
                        </table>";

    $html = $html . "<h3 class='titulo'>↓ Saidas ↓</h3>
				<table class='tabela' border=1 cellspacing=0 cellpadding=2 >
					<thead>
						<tr>
							<th width='30%' class='corAzul'><center>Data</center></th>
							<th width='35%' class='corVerde'><center>Saida</center></th>
							<th width='35%' class='corVermelha'><center>Saldo</center></th>
						</tr>
					</thead>
					<tbody>";
    foreach($saidas as $saida){
        $html = $html .	"<tr>";
        $data = date("d/m/Y", strtotime($saida[0]));
        $html = $html .	"<td><center>{$data}</center></td>";
        $html = $html .	"<td><center>R$ ".number_format($saida[1] * -1, 2, ',', '.')."</center></td>";
        $saldoSaida += $saida[1];
        $html = $html .	"<td><center>R$ ".number_format($saldoSaida * -1, 2, ',', '.')."</center></td>";
        $html = $html . "</tr>";
    }
    $html = $html .	"<tr>";
    $html = $html .	"<td></td>";
    $html = $html .	"<td class='corVermelha'><strong><center>Saldo final saídas:</center></strong></td>";
    $html = $html .	"<td><center>R$ ".number_format($saldoSaida * -1, 2, ',', '.')."</center></td>";
    $html = $html .	"</tr>";

    $html = $html . "</tbody>
                        </table> ";
    
    $saldoTotal = $saldoEntrada - $saldoSaida;
     $html = $html . "<h3 class='titulo'>+ Total +</h3>
				<table class='tabela' border=1 cellspacing=0 cellpadding=2 >
					<thead>
						<tr>
							<th width='50%' class='corVermelha'><center>Total:</center></th>
				            <th width='50%' ><center>R$ ".number_format($saldoTotal, 2, ',', '.')."</center></th>
						</tr>
					</thead>
				</table>";
    

	$dataEmissao = date("d/m/Y H:i:s");

	$css = file_get_contents('../../arquivos/css/relatorios.css');

	$mpdf->WriteHTML($css, 1);
	$mpdf->SetHeader('');
	$mpdf->setFooter("Emissão: {$dataEmissao} | | {PAGENO} de {nb}");
	$mpdf->WriteHTML($html,2);

	$mpdf->Output('RelatorioCaixa.pdf',I);

	exit();





?>
