<?php	
	session_start();
	if(isset($_SESSION['USUARIO'])){
	}else{
		echo "<script>alert('É preciso estar logado para acessar essa página!');location.href='../login/Login.php';</script>";
	}
	
	require_once '../../class/ClienteDAO.php';
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>Tabela Cliente</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <link href="../../arquivos/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="../../arquivos/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <link href="../../arquivos/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
        <link href="../../arquivos/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="../../arquivos/plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
        <link href="../../arquivos/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="../../arquivos/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <link href="../../arquivos/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <link href="../../arquivos/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <link href="../../arquivos/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="skin-blue" onload="exibirRelogio()">
        <div class="wrapper">
            <div class="cabecalho">
                <header class="main-header">
                    <a href="../../Index.php" class="logo"><b>SIGC</b></a>
                    <nav class="navbar navbar-static-top" role="navigation">
                        <a href="#" class="sidebar-toggle" id="teste" data-toggle="offcanvas" role="button"></a>
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <h4 class="navbar-text">Expira em <span id='tempo'>05:00</span></h4>
                                <a class="btn btn-danger navbar-btn" href="../login/LoginControlador.php?operacao=encerrar">Sair</a>
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
                            <li class="treeview">
                                <a href="../../Index.php">
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
                                    <li><a href="../usuario/UsuarioFormulario.php"><i class="fa fa-circle-o"></i> Usuários</a></li>
                                    <li><a href="../cliente/FormularioCliente.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
                                    <li><a href="../produto/FormularioProduto.php"><i class="fa fa-circle-o"></i> Produtos</a></li>
                                    <li><a href="../tipo/FormularioTipo.php"><i class="fa fa-circle-o"></i> Tipos</a></li>
                                    <li><a href="../marca/FormularioMarca.php"><i class="fa fa-circle-o"></i> Marcas</a></li>
                                    <li><a href="../remessa/FormularioRemessa.php"><i class="fa fa-circle-o"></i> Remessas</a></li>
                                    <li><a href="../venda/FormularioVenda.php"><i class="fa fa-circle-o"></i> Vendas</a></li>
                                    <li><a href="../despesa/FormularioDespesa.php"><i class="fa fa-circle-o"></i> Despesas</a></li>

                                </ul>
                            </li>
                            <li class="treeview active">
                                <a href="#">
                                <i class="fa fa-table"></i> 
                                <span>Tabelas</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                                <ul class="treeview-menu">
                                    <li><a href="../usuario/UsuarioTabela.php"><i class="fa fa-circle-o"></i> Usuários</a></li>
                                    <li><a href="../cliente/TabelaCliente.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
                                    <li><a href="../produto/TabelaProduto.php"><i class="fa fa-circle-o"></i> Produtos</a></li>
                                    <li><a href="../tipo/TabelaTipo.php"><i class="fa fa-circle-o"></i> Tipos</a></li>
                                    <li><a href="../marca/TabelaMarca.php"><i class="fa fa-circle-o"></i> Marcas</a></li>
                                    <li><a href="../remessa/TabelaRemessa.php"><i class="fa fa-circle-o"></i> Remessas</a></li>
                                    <li><a href="../venda/TabelaVenda.php"><i class="fa fa-circle-o"></i> Vendas</a></li>
                                    <li><a href="../despesa/TabelaDespesa.php"><i class="fa fa-circle-o"></i> Despesas</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                <i class="glyphicon glyphicon-shopping-cart"></i> 
                                <span>Venda</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                                <ul class="treeview-menu">
                                    <li><a href="../venda/FormularioVenda.php"><i class="fa fa-circle-o"></i> Formulário</a></li>
                                    <li><a href="../venda/TabelaVenda.php"><i class="fa fa-circle-o"></i> Tabela</a></li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="../pagamento/FormularioPagamento.php">
                                <i class="glyphicon glyphicon-usd"></i> <span>Pagamento</span>
                            </a>
                            </li>
                            <li class="">
                                <a href="../orcamento/Orcamento.php">
                                <i class="glyphicon glyphicon-tag"></i> <span>Orçamento</span>
                            </a>
                            </li>
                            <li class="">
                                <a href="../calendario/Calendario.php">
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
                                    <li><a href="../relatorios/VendaProdutos.php"><i class="fa fa-circle-o"></i> Venda de produtos</a></li>
                                    <li><a href="../relatorios/FluxoCaixa.php"><i class="fa fa-circle-o"></i> Fluxo de caixa</a></li>
                                    <li><a href="../relatorios/VendasPeriodo.php"><i class="fa fa-circle-o"></i> Vendas por período</a></li>
                                    <li><a href="../relatorios/RelatorioPedidoUsuarioFormulario.php"><i class="fa fa-circle-o"></i> Pedidos por Cliente</a></li>
                                </ul>
                            </li>
                        </ul>
                    </section>
                </aside>
            </div>

            <div class="content-wrapper">
                <section class="content-header">
                    <h1>
                        Tabela Cliente
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Tabela Cliente</a></li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-info">
                                <div class="box-body">

                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th class="col-md-3">Nome</th>
                                                <th class="col-md-2">CPF</th>
                                                <th class="col-md-1">RG</th>
                                                <th class="col-md-2">Data de Nascimento</th>
                                                <th class="col-md-2">Endereço</th>
                                                <th class="col-md-2">Telefone</th>
                                                <th><button type="button" class="btn btn-primary btn-lg btn-block" onclick="window.location.href='FormularioCliente.php';">Adicionar</button></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $clienteDAO = new ClienteDAO();
                                                $lista = $clienteDAO->listar();

                                                foreach($lista as $cliente){
                                                    
                                                    $data = $cliente->getDataNascimento();
                                                    $dataP = explode('-', $data);
                                                    $dataParaExibir = $dataP[2].'/'.$dataP[1].'/'.$dataP[0];
                                                    
                                                    echo"<tr>";			
                                                    echo"<td>{$cliente->getNome()}</td>";
                                                    echo"<td>{$cliente->getCpf()}</td>";
                                                    echo"<td>{$cliente->getRg()}</td>";
                                                    echo"<td>{$dataParaExibir}</td>";
                                                    echo"<td>Cidade: {$cliente->getCidade()}-{$cliente->getEstado()}</br> Bairro: {$cliente->getBairro()}</br>{$cliente->getRua()}, nº: {$cliente->getNumero()}</td>";
                                                    echo"<td>{$cliente->getTelefone()}</td>";
                                                    echo"<td class='btn-block'>
                                                        <a type='button' class='btn btn-success btn-sm' href='FormularioCliente.php?idCliente={$cliente->getIdCliente()}'>editar</a>
                                                        <a type='button' class='btn btn-danger btn-sm' data-toggle='confirmation' data-placement='left' data-title='Deseja realmente excluir?' href='ClienteControlador.php?operacao=excluir&idCliente={$cliente->getIdCliente()}'>excluir</a>
                                                        </td>";						
                                                    echo"</tr>";					
                                                }
					                       ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nome</th>
                                                <th>CPF</th>
                                                <th>RG</th>
                                                <th>Data de Nascimento</th>
                                                <th>Endereço</th>
                                                <th>Telefone</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>

            <footer class="main-footer">
                <strong>Copyright &copy; 2018 <a href="http://almsaeedstudio.com">Pedro e Rafaela - Desenvolvedores Web</a>.</strong> Todos os direitos reservados.
            </footer>
        </div>
        <script src="../../arquivos/js/relogio.js" type="text/javascript"></script>
        <script src="../../arquivos/plugins/jQuery/jQuery-2.1.3.min.js"></script>
        <script src="../../arquivos/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../arquivos/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../arquivos/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script src="../../arquivos/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src='../../arquivos/plugins/fastclick/fastclick.min.js'></script>
        <script src="../../arquivos/js/app.min.js" type="text/javascript"></script>
        <script src="../../arquivos/js/tabela.js" type="text/javascript"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="../../arquivos/plugins/morris/morris.min.js" type="text/javascript"></script>
        <script src="../../arquivos/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="../../arquivos/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="../../arquivos/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <script src="arquivos/plugins/knob/jquery.knob.js" type="text/javascript"></script>
        <script src="../../arquivos/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <script src="../../arquivos/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="../../arquivos/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script src="../../arquivos/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <script src="../../arquivos/js/pages/dashboard.js" type="text/javascript"></script>
        <script src="../../arquivos/js/bootstrap-confirmation.min.js" type="text/javascript"></script>






    </body>

    </html>
