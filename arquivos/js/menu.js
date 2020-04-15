//https://gist.github.com/girol/4a606d5cc6286ce1e9755faa3b7746df
function gera_cor() {
    var hexadecimais = '0123456789ABCDEF';
    var cor = '#';

    // Pega um nÃºmero aleatÃ³rio no array acima
    for (var i = 0; i < 6; i++) {
        //E concatena Ã  variÃ¡vel cor
        cor += hexadecimais[Math.floor(Math.random() * 16)];
    }
    return cor;
}

var cores = ["#7FFF00", "#9932CC", "#FF8C00"];

$(document).ready(function () {
    exibirGrafico01();
    exibirGrafico02();
    exibirGrafico03();
    exibirGrafico04();
});

function exibirGrafico01() {
    $.ajax({
        type: 'POST',
        url: 'gerenciar/graficos/VendasPorClientes.php',

        success: function (retorno) {

            dados = JSON.parse(retorno)

            var data = {
                labels: dados[0].nomes,
                datasets: [
                    {
                        label: "Fechado",
                        fillColor: gera_cor(),
                        data: dados[0].valores
						}
					]
            }

            var ctx = document.getElementById("graficoVendasPorClientes").getContext("2d");
            var BarChart = new Chart(ctx).Bar(data, {
                responsive: true
            });

        }
    });
    return false;
}

function exibirGrafico02() {
    $.ajax({
        type: 'POST',
        url: 'gerenciar/graficos/VendasPorFormaPagamento.php',

        success: function (retorno) {

            dados = JSON.parse(retorno)

            var data = new Array();

            for (var i = 0; i < dados[0].formasPagamentos.length; i++) {
                var registro = new Object();
                registro.value = dados[0].valores[i]
                registro.color = gera_cor()
                registro.label = dados[0].formasPagamentos[i]
                data.push(registro)
            }

            var options = {
                responsive: true
            };

            var ctx = document.getElementById("graficoVendasPorFormaPagamento").getContext("2d");
            var PizzaChart = new Chart(ctx).Doughnut(data, options);

        }
    });
    return false;
}

function exibirGrafico03() {
    $.ajax({
        type: 'POST',
        url: 'gerenciar/graficos/ValorPorDia.php',

        success: function (retorno) {

            dados = JSON.parse(retorno)

            var data = {
                labels: dados[0].dias,
                datasets: [
                    {
                        fillColor: gera_cor(),
                        data: dados[0].valores
						}
					]
            }

            var ctx = document.getElementById("graficoValoresPorDia").getContext("2d");
            var BarChart = new Chart(ctx).Bar(data, {
                responsive: true
            });

        }
    });
    return false;
}

function exibirGrafico04() {
    $.ajax({
        type: 'POST',
        url: 'gerenciar/graficos/VendasPorClientesFormaPagamento.php',

        success: function (retorno) {

            dados = JSON.parse(retorno)

            var data = {
                labels: dados[0].nomes,
                datasets: [
                    {
                        fillColor: cores[0],
                        data: dados[0].dinheiros,
						},
                    {
                        fillColor: cores[1],
                        data: dados[0].cartoes,
						},
                    {
                        fillColor: cores[2],
                        data: dados[0].crediarios,
						}
					]
            }

            var ctx = document.getElementById("graficoVendasPorClientesFormaPagamento").getContext("2d");
            var BarChart = new Chart(ctx).Bar(data, {
                responsive: true
            });

        }
    });
    return false;
}
