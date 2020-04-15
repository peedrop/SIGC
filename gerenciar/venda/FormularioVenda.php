<?php
	session_start();
	if(isset($_SESSION['USUARIO'])){
	}else{
		echo "<script>alert('É preciso estar logado para acessar essa página!');location.href='../login/Login.php';</script>";
	}

	require_once '../../class/PedidoDAO.php';
	require_once '../../class/ClienteDAO.php';
	require_once '../../class/ProdutoDAO.php';
	require_once '../../class/PedidoProdutoDAO.php';

    $pedido = new Pedido();
	
	$operacao = "visualizar";

	if(isset($_GET["operacao"])){
		$operacao = $_GET["operacao"];
	}

    $valorTotal = 0;
	if(isset($_GET["idPedido"])){
		$idPedido = $_GET["idPedido"];

		$pedidoDAO = new PedidoDAO();
		$pedido = $pedidoDAO->buscarPorId($idPedido);
        $valorTotal = $pedidoDAO->buscarValorIdPedido($idPedido);
       // $pedido->setValor($valorTotal);
	}
 $total = 0;
    date_default_timezone_set('America/Sao_Paulo');
    $pedido->setDataPedido(date('Y-m-d'));	
    $pedido->setHoraPedido(date('H:i'));
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>Venda</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="../../arquivos/css/pedido.css" rel="stylesheet" type="text/css" />
        <link href="../../arquivos/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="../../arquivos/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <link href="../../arquivos/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
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
                    <a href="index.php" class="logo"><b>SIGC</b></a>
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
                            <li class="treeview">
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
                            <li class="treeview active">
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
                        Venda
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Venda</a></li>
                    </ol>
                </section>
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <form id="formVenda" action="VendaControlador.php?operacao=salvar" method="post">
                                <div class="box box-info">
                                    <div class="box-header">
                                        <h3 class="box-title">Dados Venda</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">

                                            <div class="col-xs-8">
                                                <input type="hidden" name="idPedido" id="idPedido" value="<?php echo $pedido->getIdPedido() ?>">

                                                <label>Cliente</label>
                                                <select id="idCliente" name="idCliente" class="form-control">
                                                <?php
                                                    $clienteDAO = new ClienteDAO();
                                                    $lista = $clienteDAO->listar();

                                                    if($pedido->getCliente()->getIdCliente() == 0){
                                                        echo "<option 
                                                             value='' disabled selected>Selecione um cliente</option>";
                                                    }

                                                    foreach($lista as $cliente){	
                                                        if($cliente->getIdCliente() == $pedido->getCliente()->getIdCliente()){
                                                            echo "<option selected 
                                                                    value='{$cliente->getIdCliente()}'>{$cliente->getNome()}
                                                                  </option>";
                                                        }
                                                        else{
                                                            echo "<option 
                                                                    value='{$cliente->getIdCliente()}'>{$cliente->getNome()}
                                                                 </option>";
                                                        }

                                                    }
                                                ?>
                                            </select>
                                            </div>

                                            <div class="col-xs-2">
                                                <label>Data</label>

                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" readonly name="dataPedido" id="dataPedido" value="<?php echo $pedido->getDataPedido() ?>" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-xs-2">
                                                <label>Horário</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="glyphicon glyphicon-time"></i>
                                                    </div>
                                                    <input type="text" readonly class="form-control" name="horaPedido" id="horaPedido" value="<?php echo $pedido->getHoraPedido() ?>" />
                                                </div>
                                            </div>


                                            <div class="col-xs-4">
                                                <label>Forma de pagamento</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-usd"></i>
                                                    </div>

                                                    <select class="form-control" value="<?php echo $pedido->getFormaPagamento() ?>" name="formaPagamento" id="formaPagamento">
                                                    <?php
    
                                                    
                                                    if($pedido->getFormaPagamento() == 0){
                                                        echo "<option 
                                                             value='' disabled selected>Selecione uma forma de pagamento</option>";
                                                        echo "<option selected 
                                                                        value='1'>Dinheiro
                                                                      </option>";
                                                            echo "<option  
                                                                        value='2'>Cartão
                                                                      </option>";
                                                            echo "<option  
                                                                        value='3'>Crediário
                                                                      </option>";
                                                        
                                                    }else{
                                                        if($pedido->getFormaPagamento() == 1){
                                                            echo "<option selected 
                                                                        value='1'>Dinheiro
                                                                      </option>";
                                                            echo "<option  
                                                                        value='2'>Cartão
                                                                      </option>";
                                                            echo "<option  
                                                                        value='3'>Crediário
                                                                      </option>";
                                                        }
                                                        if($pedido->getFormaPagamento() == 2){
                                                              echo "<option 
                                                                        value='1'>Dinheiro
                                                                      </option>";
                                                            echo "<option selected
                                                                        value='2'>Cartão
                                                                      </option>";
                                                            echo "<option  
                                                                        value='3'>Crediário
                                                                      </option>";
                                                        }
                                                        if($pedido->getFormaPagamento() == 3){    
                                                            echo "<option 
                                                                        value='1'>Dinheiro
                                                                      </option>";
                                                            echo "<option  
                                                                        value='2'>Cartão
                                                                      </option>";
                                                            echo "<option selected
                                                                        value='3'>Crediário
                                                                      </option>";                                                       
                                                        }
                                                    }
                                                            
                                                ?>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <label>Parcelas</label>
                                                <input type="text" class="form-control" value="<?php echo $pedido->getParcelas() ?>" name="parcelas" id="parcelas" />
                                            </div>
                                            <div class="col-xs-4">
                                                <label>Valor Final</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-usd"></i>
                                                    </div>
                                                    <input type="text" class="form-control" value="<?php echo $pedido->getValor() ?>" name="valor" id="valor" />
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-primary btn-block" type="submit" name='salvarVoltar' id='salvarVoltar' value='salvarVoltar'>Salvar + Voltar</button>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-success btn-block" type="submit" name='salvar' id='salvar' value='salvar'>Salvar</button>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-danger btn-block" type="reset" name="action">Cancelar</button>
                                    </div>
                                </div>
                            </form>
                            <?php 
                                    if($pedido->getIdPedido()==0){
                                        echo "<div class='ocultar'> ";
                                    }
                                ?>
                            <form id="formPedidoProduto" action="PedidoProdutoControlador.php?operacao=salvar" method="post">

                                <div class="box box-info">
                                    <div class="box-header">
                                        <h3 class="box-title">Produtos</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-xs-7">
                                                <input type="hidden" name="idPedido" id="idPedido" value="<?php echo $pedido->getIdPedido() ?>">
                                                <label for="idProduto">Produto</label>
                                                <select id="idProduto" name="idProduto" class="form-control" required>		
                                                    
                                                    <?php
                                                        $produtoDAO = new ProdutoDAO();
										                $lista = $produtoDAO->listar();

                                                        echo "<option value='' disabled selected>Selecione um produto</option>";

                                                        foreach($lista as $produto){	
                                                            echo "<option value='{$produto->getIdProduto()}'>{$produto->getNome()}</option>";								
                                                        }
                                                    ?>						
                                                </select>
                                            </div>
                                            <div class="col-xs-3">
                                                <label>Quantidade</label>
                                                <input class="form-control campo" name="quantidade" id="quantidade" type="text" value="0">
                                            </div>


                                            <div class="col-xs-2">
                                                <label></label>
                                                <button type="submit" class="btn btn-primary btn-lg btn-block">Adicionar</button>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="box-body">
                                        <table id="example1" class="table table-bordered table-striped">

                                            <thead>
                                                <tr>
                                                    <th class="col-md-5">Produto</th>
                                                    <th class="col-md-3">Quantidade</th>
                                                    <th class="col-md-3">SubTotal</th>
                                                    <th class="col-md-1"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            
                                                if($pedido->getIdPedido()!=0){
                                                        
                                                    $pedidoProdutoDAO = new PedidoProdutoDAO();
										            $lista = $pedidoProdutoDAO->listarPorPedido($pedido->getIdPedido());
                                                    
                                                    foreach($lista as $pedidoProduto){						
                                                        echo"<tr>";	
                                                        
                                                        echo"<td>{$pedidoProduto->getProduto()->getNome()}</td>";
                                                        $qnt = $pedidoProduto->getQuantidade();
                                                        echo"<td>{$qnt} </td>";
                                                        $valor = $pedidoProduto->getProduto()->getValor();
                                                        $valor = $valor * $qnt;
                                                        echo"<td>{$valor} </td>";
                                                        
                                                        echo"<td class='float-right'> <a class='btn btn-danger btn-block' href='PedidoProdutoControlador.php?operacao=excluir&idPedidoProduto={$pedidoProduto->getIdPedidoProduto()}&idPedido={$pedidoProduto->getPedido()->getIdPedido()}'>Excluir</a></td>";	
                                                        
                                                        $total += $valor;
                                                        echo"</tr>";							
                                                    }
                                                
                                                }						

                                            ?>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Produto</th>
                                                    <th>Quantidade</th>
                                                    <th><strong>Total: </strong>
                                                        <?php echo $total ?> </th>
                                                    <th></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                </div>
                            </form>
                            <?php 
                                if($pedido->getIdPedido()==0){
                                    echo "</div>";
                                   
                                }
                            ?>

                        </div>
                    </div>
                </section>
            </div>

            <footer class="main-footer">
                <strong>Copyright &copy; 2018 <a href="http://almsaeedstudio.com">Pedro e Rafaela - Desenvolvedores Web</a>.</strong> Todos os direitos reservados.
            </footer>
        </div>
        <script src="../../arquivos/js/relogio.js" type="text/javascript"></script>
        <script src="../../arquivos/plugins/jQuery/jQuery-2.1.3.min.js"></script>
        <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
        <script src="../../arquivos/js/bootstrap.min.js" type="text/javascript"></script>
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
        <script src="../../arquivos/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src='../../arquivos/plugins/fastclick/fastclick.min.js'></script>
        <script src="../../arquivos/js/app.min.js" type="text/javascript"></script>
        <script src="../../arquivos/js/pages/dashboard.js" type="text/javascript"></script>
        <script src="../../arquivos/js/demo.js" type="text/javascript"></script>
        <script type="text/javascript" src="../../arquivos/js/jquery.validate.js"></script>
        <script type="text/javascript" src="../../arquivos/js/jquery.mask.js"></script>
        <script type="text/javascript" src="../../arquivos/js/venda.js"></script>
        <script type="text/javascript" src="../../arquivos/js/vendaPro.js"></script>
    </body>

    </html>
