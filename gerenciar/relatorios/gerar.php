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
			";
	
	$html = $html . 
			"<div id = 'area04'>
				<h1 class='titulo'> Fluxo de caixa </h1>	
			</div>
			<div id='area03'>
				<table class='tabela' border=1 cellspacing=0 cellpadding=2 >
					<thead>
						<tr>
                            <th width='26%' class='corPreta'><center>Dia de</center></th>
							<th width='23%' class='corAzul'><center>Data</center></th>
							<th width='17%' class='corVerde'><center>Entrada</center></th>
							<th width='17%' class='corVermelha'><center>Saída</center></th>
							<th width='17%' class='corAzul'><center>Saldo</center></th>
						</tr>
					</thead>
					<tbody>";

    $dataInicio = $_POST["inicio"];
    $dataFim = $_POST["fim"];
    
	$pedidoDAO = new PedidoDAO();
    $entradas = $pedidoDAO->listarEntradas($dataInicio, $dataFim);	
    $qntEnt = count($entradas);
    
    $despesaDAO = new DespesaDAO();
    $saidas = $despesaDAO->listarSaidas($dataInicio, $dataFim);
    $qntSai = count($saidas);
    
    foreach($entradas as $entrada){ 
        $html = $html .	"<tr>";	
        $data = date("d/m/Y", strtotime($entrada[0]));
        $html = $html .	"<td><center>Só entrada</center></td>";
        $html = $html .	"<td>{$data}</td>";
        $html = $html .	"<td>{$entrada[1]}</td>";
        $html = $html .	"<td>0.00</td>";
        $html = $html .	"<td>{$entrada[1]}</td>";
        $html = $html . "</tr>";
    }
    $html = $html .	"<tr>";	
    $html = $html .	"<td class='corPreta'></td>";
    $html = $html .	"<td class='corPreta'></td>";
    $html = $html .	"<td class='corPreta'></td>";
    $html = $html .	"<td class='corPreta'></td>";
    $html = $html .	"<td class='corPreta'></td>";
    $html = $html . "</tr>";
    foreach($saidas as $saida){
        $html = $html .	"<tr>";	
        $data = date("d/m/Y", strtotime($saida[0]));
        $html = $html .	"<td><center>Só saída</center></td>";
        $html = $html .	"<td>{$data}</td>";
        $html = $html .	"<td>0.00</td>";
        $html = $html .	"<td>{$saida[1]}</td>";
        $html = $html .	"<td>-{$saida[1]}</td>";
        $html = $html . "</tr>";
    }
    $html = $html .	"<tr>";	
    $html = $html .	"<td class='corPreta'></td>";
    $html = $html .	"<td class='corPreta'></td>";
    $html = $html .	"<td class='corPreta'></td>";
    $html = $html .	"<td class='corPreta'></td>";
    $html = $html .	"<td class='corPreta'></td>";
    $html = $html . "</tr>";
    for ($i = 0; $i < $qntEnt; $i++){
        for ($j = 0; $j < $qntSai; $j++){
            $entrada = $entradas[$i];
            $saida = $saidas[$j];
            if ($entrada[0] == $saida[0]){
                $html = $html .	"<tr>";	
                $data = date("d/m/Y", strtotime($entrada[0]));
                $html = $html .	"<td><center>Entrada e Saída</center></td>";
                $html = $html .	"<td>{$data}</td>";
                $entrada[0] = null;
                $entradas[$i] = $entrada;
                $saida[0] = null;
                $saidas[$i] = $saida;
                $html = $html .	"<td>{$entrada[1]}</td>";
                $html = $html .	"<td>{$saida[1]}</td>";
                $soma = $entrada[1];
                $x = $saida[1];
                $soma = $soma - $x;
                $html = $html .	"<td>{$soma}.00</td>";
                $html = $html . "</tr>";
            }
        }
    }
    /*
    foreach($entradas as $entrada){	
        if ($entrada[0] != null){
            $html = $html .	"<tr>";	
            $html = $html .	"<td>{$entrada[0]}</td>";
            $html = $html .	"<td>{$entrada[1]}</td>";
            $html = $html .	"<td>0.00</td>";
            $html = $html .	"<td>{$entrada[1]}</td>";
            $html = $html . "</tr>";
        }
    }
    foreach($saidas as $saida){
        if ($saida[1] == null){
            $html = $html .	"<tr>";	
            $html = $html .	"<td>{$saida[0]}</td>";
            $html = $html .	"<td>0.00</td>";
            $html = $html .	"<td>{$saida[1]}</td>";
            $html = $html .	"<td>-{$saida[1]}</td>";
            $html = $html . "</tr>";
        }
    }
    */
					
	$html = $html . "</tbody>
                        </table>
                    </div>";
	
	$dataEmissao = date("d/m/Y H:i:s");
	
	$css = file_get_contents('../../arquivos/css/relatorios.css');
	
	$mpdf->WriteHTML($css, 1);		
	$mpdf->SetHeader('');
	$mpdf->setFooter("Emissão: {$dataEmissao} | | {PAGENO} de {nb}"); 
	$mpdf->WriteHTML($html, 2);
	
	$mpdf->Output('RelatorioCaixa.pdf',I);
    
	exit();
	
	

	

?>
