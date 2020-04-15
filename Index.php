<?php
		session_start();
		if(isset($_SESSION['USUARIO'])){
		}else{ 
			echo "<script>location.href='gerenciar/login/Login.php';</script>";
		}
        require_once 'class/ProdutoDAO.php';
        require_once 'class/ValoresDAO.php';
        require_once 'class/MarcaDAO.php';
	    $produto = new Produto();
	    $marca = new Marca();
	?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>Página Inicial</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <link href="arquivos/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="arquivos/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <link href="arquivos/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <link href="arquivos/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
        <link href="arquivos/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="arquivos/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <link href="arquivos/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <link href="arquivos/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <link href="arquivos/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <link href="arquivos/css/menu.css" rel="stylesheet" type="text/css" />


    </head>

    <body class="skin-blue" onload="exibirRelogio()">
        <div class="wrapper">

            <div class="cabecalho">
                <header class="main-header">
                    <a href="index.php" class="logo"><b>SIGC</b></a>
                    <nav class="navbar navbar-static-top" role="navigation">
                        <a href="#" class="sidebar-toggle" id="teste" data-toggle="offcanvas" role="button"></a>
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <h4 class="navbar-text">Expira em <span id='tempo'>05:00</span></h4>
                                <a class="btn btn-danger navbar-btn" href="gerenciar/login/LoginControlador.php?operacao=encerrar">Sair</a>
                            </ul>
                        </div>
                    </nav>
                </header>
                <aside class="main-sidebar">
                    <section class="sidebar">
                        <form action="#" method="get" class="sidebar-form">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control" placeholder="Buscar..." />
                                <span class="input-group-btn">
                                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                            </div>
                        </form>
                        <ul class="sidebar-menu">
                            <li class="header">MENU</li>
                            <li class="treeview active">
                                <a href="Index.php">
                                <i class="fa fa-dashboard"></i> <span>Página inicial</span> 
                            </a>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                <i class="fa fa-edit"></i>
                                <span>Formulários</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                                <ul class="treeview-menu">
                                    <li><a href="gerenciar/usuario/UsuarioFormulario.php"><i class="fa fa-circle-o"></i> Usuários</a></li>
                                    <li><a href="gerenciar/cliente/FormularioCliente.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
                                    <li><a href="gerenciar/produto/FormularioProduto.php"><i class="fa fa-circle-o"></i> Produtos</a></li>
                                    <li><a href="gerenciar/tipo/FormularioTipo.php"><i class="fa fa-circle-o"></i> Tipos</a></li>
                                    <li><a href="gerenciar/marca/FormularioMarca.php"><i class="fa fa-circle-o"></i> Marcas</a></li>
                                    <li><a href="gerenciar/remessa/FormularioRemessa.php"><i class="fa fa-circle-o"></i> Remessas</a></li>
                                    <li><a href="gerenciar/venda/FormularioVenda.php"><i class="fa fa-circle-o"></i> Vendas</a></li>
                                    <li><a href="gerenciar/despesa/FormularioDespesa.php"><i class="fa fa-circle-o"></i> Despesas</a></li>

                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                <i class="fa fa-table"></i> 
                                <span>Tabelas</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                                <ul class="treeview-menu">
                                    <li><a href="gerenciar/usuario/UsuarioTabela.php"><i class="fa fa-circle-o"></i> Usuários</a></li>
                                    <li><a href="gerenciar/cliente/TabelaCliente.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
                                    <li><a href="gerenciar/produto/TabelaProduto.php"><i class="fa fa-circle-o"></i> Produtos</a></li>
                                    <li><a href="gerenciar/tipo/TabelaTipo.php"><i class="fa fa-circle-o"></i> Tipos</a></li>
                                    <li><a href="gerenciar/marca/TabelaMarca.php"><i class="fa fa-circle-o"></i> Marcas</a></li>
                                    <li><a href="gerenciar/remessa/TabelaRemessa.php"><i class="fa fa-circle-o"></i> Remessas</a></li>
                                    <li><a href="gerenciar/venda/TabelaVenda.php"><i class="fa fa-circle-o"></i> Vendas</a></li>
                                    <li><a href="gerenciar/despesa/TabelaDespesa.php"><i class="fa fa-circle-o"></i> Despesas</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                <i class="glyphicon glyphicon-shopping-cart"></i> 
                                <span>Venda</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                                <ul class="treeview-menu">
                                    <li><a href="gerenciar/venda/FormularioVenda.php"><i class="fa fa-circle-o"></i> Formulário</a></li>
                                    <li><a href="gerenciar/venda/TabelaVenda.php"><i class="fa fa-circle-o"></i> Tabela</a></li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="gerenciar/pagamento/FormularioPagamento.php">
                                <i class="glyphicon glyphicon-usd"></i> <span>Pagamento</span>
                            </a>
                            </li>
                            <li class="">
                                <a href="gerenciar/orcamento/Orcamento.php">
                                <i class="glyphicon glyphicon-tag"></i> <span>Orçamento</span>
                            </a>
                            </li>
                            <li class="">
                                <a href="gerenciar/calendario/Calendario.php">
                                <i class="fa fa-calendar"></i> <span>Calendário</span>
                            </a>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                <i class="fa fa-files-o"></i>
                                <span>Relatórios</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                                <ul class="treeview-menu">
                                    <li><a href="gerenciar/relatorios/VendaProdutos.php"><i class="fa fa-circle-o"></i> Venda de produtos</a></li>
                                    <li><a href="gerenciar/relatorios/FluxoCaixa.php"><i class="fa fa-circle-o"></i> Fluxo de caixa</a></li>
                                    <li><a href="gerenciar/relatorios/VendasPeriodo.php"><i class="fa fa-circle-o"></i> Vendas por período</a></li>
                                    <li><a href="gerenciar/relatorios/RelatorioPedidoUsuarioFormulario.php"><i class="fa fa-circle-o"></i> Pedidos por Cliente</a></li>
                                </ul>
                            </li>
                        </ul>
                    </section>
                </aside>
            </div>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Página inicial
                        <small><a class="btn btn-danger btn-block btn-ms" href="PedroPauloSilvaFiLogonio_Ds2_Trab2.zip" download>Download site completo</a></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Página inicial</a></li>
                    </ol>
                </section>
                <section class="content">

                    <div class="row abacate">
                        <div id="vendasPorFormaPagamento">
                            <label class="text-sm-left textoLabel">Total mensal das vendas por forma de pagamento</label>
                            <hr/>
                            <canvas id="graficoVendasPorFormaPagamento"></canvas>
                        </div>
                        <?php
                            $valoresDAO = new ValoresDAO();
                            $entrada = $valoresDAO->buscarEntradaHoje();
                            $saida = $valoresDAO->buscarSaidaHoje();
                            $saldo = $entrada - $saida;
                            ?>


                            <div id="estoqueBaixo">
                                <p id="textCenterVerm">ATENÇÃO - Estoque abaixo do mínimo</p>
                                <hr/>
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th class="col-md-6">Produto</th>
                                            <th class="col-md-3">Marca</th>
                                            <th class="col-md-3">Estoque</th>
                                            <th class="col-md-3">Mínimo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

							$produtoDAO = new ProdutoDAO();
							$marcaDAO = new MarcaDAO();
							$lista = $produtoDAO->listar();

							foreach($lista as $produto){
								if($produto->getQuantidade() < $produto->getEstoqueMin()){
									echo"<tr>";								
									echo"<td>{$produto->getNome()}</td>";
                                    echo"<td>{$marcaDAO->buscarPorID($produto->getIdMarca())}</td>";
									echo"<td>{$produto->getQuantidade()}</td>";
									echo"<td>{$produto->getEstoqueMin()}</td>";
									echo"</tr>";
								}					
							}
						?>
                                    </tbody>
                                </table>
                            </div>
                            <div id="entradaSaida">
                                <p id="textCenter">Fluxo Caixa Diário</p>
                                <h3 class="verde"><i class="fa fa-plus"></i> Entrada: R$
                                    <?php echo number_format($entrada, 2, ',', '.') ?>
                                </h3>
                                <h3 class="vermelho"><i class="fa fa-minus"></i> Saída: R$
                                    <?php echo number_format($saida, 2, ',', '.') ?>
                                </h3>
                                <h3><i class="fa fa-usd"></i> Saldo: R$
                                    <?php echo number_format($saldo, 2, ',', '.') ?>
                                </h3>
                            </div>


                    </div>
                    <div class="row">

                        <div id="vendasPorClienteFormaPagamento">
                            <label class="text-sm-left textoLabel">Total mensal das vendas por clientes e por forma de pagamento </label>
                            <div id="dinheiro">Dinheiro</div>
                            <div id="cartao">Cartão</div>
                            <div id="crediario">Crediário</div>
                            <hr/>
                            <canvas id="graficoVendasPorClientesFormaPagamento"></canvas>
                            <canvas id="lineLegend"></canvas>
                        </div>
                        <div id="valorVendidoPorDia">
                            <label class="text-sm-left textoLabel">Total do valor vendido nos ultimos 4 dias de venda</label>
                            <hr/>
                            <canvas id="graficoValoresPorDia"></canvas>
                        </div>

                        <div id="vendasPorClientes">
                            <label class="text-sm-left textoLabel">Total mensal das vendas por clientes</label>
                            <hr/>
                            <canvas id="graficoVendasPorClientes"></canvas>
                        </div>
                    </div>

                </section>

            </div>
            <footer class="main-footer">
                <strong>Copyright &copy; 2018 <a href="#">Pedro e Rafaela - Desenvolvedores Web</a>.</strong> Todos os direitos reservados.
            </footer>
        </div>

        <script src="arquivos/js/relogio1.js" type="text/javascript"></script>
        <script src="arquivos/plugins/jQuery/jQuery-2.1.3.min.js"></script>
        <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
        <script src="arquivos/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="arquivos/js/Chart.js" type="text/javascript"></script>
        <script src="arquivos/js/menu.js" type="text/javascript"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="arquivos/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="arquivos/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="arquivos/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="arquivos/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <script src="arquivos/plugins/knob/jquery.knob.js" type="text/javascript"></script>
        <script src="arquivos/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <script src="arquivos/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="arquivos/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script src="arquivos/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <script src="arquivos/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src='arquivos/plugins/fastclick/fastclick.min.js'></script>
        <script src="arquivos/js/app.min.js" type="text/javascript"></script>
        <script src="arquivos/js/pages/dashboard.js" type="text/javascript"></script>
        <script src="arquivos/js/demo.js" type="text/javascript"></script>

    </body>

    </html>
