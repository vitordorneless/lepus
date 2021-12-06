<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Teste Vítor Dorneles</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="description" content="Teste Vítor Dorneles">
        <link href="../../css/bootstrap/css/bootstrap.min.css" rel="stylesheet" />        
    </head>    
    <body>        
        <div class="container">
            <header>
                <nav class="navbar navbar-default">
                    <div class="container-fluid">                                                
                        <div class="navbar-header">
                            <ul class="nav navbar-nav">
                                <li><a href="usuario_listar.php">Usuários</a></li>
                                <li><a href="salas_listar.php">Salas</a></li>
                                <li><a href="reserva_salas_listar.php">Reservar Salas</a></li>            
                            </ul>
                        </div><!-- /.navbar-collapse -->
                    </div><!-- /.container-fluid -->
                </nav>
            </header>
            <p class="text-center">Desafio <strong>Vítor Dorneles</strong></p>            
            <div class="jumbotron">
                <h2><strong>Listar </strong>Usuários</h2>
                <div class="row">
                    <div class="col-md-8">
                        <a href="usuarios.php?id=0" class="btn btn-default btn-success">Incluir Usuário</a><br>
                    </div>
                </div>
                <table id="funcionarios" class="table table-bordered table-condensed table-responsive table-striped" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nome</th>                                        
                            <th>Setor</th>
                            <th>Admin?</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nome</th>                                        
                            <th>Setor</th>
                            <th>Admin?</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        require '../Controller/UsuarioController.php';
                        $user = new UsuarioController();
                        echo $user->listar();
                        ?>
                    </tbody>
                </table>                
            </div>
        </div>
        <script src="../js/jquery-1.11.1.min.js"></script>
        <script src="../../css/bootstrap/js/bootstrap.min.js"></script>        
    </body>
</html>