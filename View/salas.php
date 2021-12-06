<?php
session_start();

$id = $_GET['id'];
include '../config/database_mysql.php';
require '../Model/Queries.php';
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$querie = new Queries();
if ($id > 0) {
    $q = $pdo->prepare($querie->dados_sala($id));
    $q->execute();
    $data = $q->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Teste Vítor Dorneles</title>
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
                <h2><strong>Incluir / Editar Sala</strong></h2>
                <div class="modal-body">
                    <form id="form" method="POST" action="../Controller/sala.php">
                        <div class="form-group">
                            <label for="label_nome">Nome da Sala:</label>
                            <input required="required" type="text" value="<?= $id == 0 ? '' : $data['sala'] ?>" class="form-control" id="sala" name="sala" placeholder="Informe o nome do Usuário(a)..." autofocus>
                            <input type="hidden" value="<?= $id == 0 ? 0 : $data['id'] ?>" class="form-control" id="id" name="id">
                        </div>
                        <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Salvar <span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span></button>
                    </form>
                </div>
            </div>
        </div>
        <script src="../js/jquery-1.11.1.min.js"></script>
        <script src="../../css/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>