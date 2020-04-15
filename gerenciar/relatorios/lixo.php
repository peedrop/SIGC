<?php

	include("../../class/Banco.php");
	include("../../arquivos/mpdf/mpdf.php");
	require_once '../../class/PedidoDAO.php';
	require_once '../../class/DespesaDAO.php';

	$mpdf = new mPDF();
	$mpdf->SetDisplayMode("fullpage");

	$html = "<div id='area02'>
					 		<img  width = '100%' src='../../arquivos/img/cabecalho.png'>
				   </div>
					 <div id = 'area04'>
							<h1 class='titulo1'> Fluxo de caixa </h1>
					 </div>
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

    $dataInicio = $_POST["inicio"];
    $dataFim = $_POST["fim"];

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
        $html = $html .	"<td><center>{$entrada[1]}</center></td>";
				$saldoEntrada += $entrada[1];
        $html = $html .	"<td><center>{$saldoEntrada}</center></td>";
        $html = $html . "</tr>";
    }
		$html = $html .	"<tr>";
		$html = $html .	"<td></td>";
		$html = $html .	"<td class='corVermelha'><strong><center>Total entradas:</center></strong></td>";
		$html = $html .	"<td><center>{$saldoEntrada}</center></td>";
		$html = $html .	"</tr>";

	$html = $html . "</tbody>
                        </table>";


	$html = $html .
			"
			<h3 class='titulo'>↓ Saidas ↓</h3>
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
				$saldoSaida += $saida[1];
        $html = $html .	"<tr>";
        $data = date("d/m/Y", strtotime($saida[0]));
        $html = $html .	"<td><center>{$data}</center></td>
	      <td><center>{$saida[1]}</center></td>
			<td><center> -{$saldoSaida}</center></td>
        </tr>";
    }
		$saldoEntrada = $saldoEntrada - $saldoSaida;
		$html = $html .	"<tr>
		<td></td>
		<td class='corVermelha'><strong><center>Total saídas:</center></strong></td>
		<td><center>-{$saldoSaida}</center></td>
		</tr>
		</tbody>
      </table>
			<h3 class='titulo'> + Total +</h3>
			<table class='tabela' border=1 cellspacing=0 cellpadding=2 >
				<thead>
					<tr>
				<th width='50%' class='corVermelha'><center>Total:</center></th>
				<th width='50%' ><center>$saldoEntrada</center></th>
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
