<?php
	session_start();
	if(isset($_SESSION['USUARIO'])){
		echo "<script>location.href='../../Index.php';</script>";
	}
?>
    <html>

    <head>
        <meta charset="UTF-8">
        <title>AdminLTE 2 | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="../../arquivos/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Font Awesome Icons -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../arquivos/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
        <!-- iCheck -->
        <link href="../../arquivos/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <b>Recuperar Senha</b>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <form id="formRecuSenha" action="LoginControlador.php?operacao=recuperarSenha" method="post">
                    <div class="form-group has-feedback">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="glyphicon glyphicon-envelope"></i>
                            </div>
                            <input type="text" class="form-control" name="email" id="email" placeholder="E-mail" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-5">
                            <a href="Login.php">Fazer login</a>
                        </div>
                        <div class="col-xs-2">

                        </div>
                        <!-- /.col -->
                        <div class="col-xs-5">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Enviar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-box-body -->
        </div>

        <!-- /.login-box -->

        <!-- jQuery 2.1.3 -->
        <script src="../../arquivos/plugins/jQuery/jQuery-2.1.3.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script src="../../arquivos/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="../../arquivos/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <script>
            $(function() {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });

        </script>
        <script type="text/javascript" src="../../arquivos/js/jquery.validate.js"></script>
        <script type="text/javascript" src="../../arquivos/js/jquery.mask.js"></script>
        <script src="../../arquivos/js/recuperarSenha.js"></script>
    </body>

    </html>
