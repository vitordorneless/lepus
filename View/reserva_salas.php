<?php
session_start();
$id = $_GET['id'];
include '../config/database_mysql.php';
require '../Model/Queries.php';
require '../Model/Usuarios.php';

$pdo = Database::connect();
$user = new Usuarios();
$querie = new Queries();
$dados_user = $user->Dados_User($_SESSION['user_id']);
$setor = $user->Dados_User_setor($dados_user['id_setor']);
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
                <h2><strong>Incluir Reunião</strong></h2>                
                <div class="modal-body">
                    <form id="form" method="POST" action="../Controller/reuniao.php">
                        <div class="form-group">
                            <label for="label_nome_extenso">Nome do Usuário:</label>
                            <input type="text" class="form-control" value="<?php echo $dados_user['nome_extenso']; ?>" disabled="disabled">
                            <input type="hidden" id="id_user" name="id_user" value="<?php echo $dados_user['id']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="setor_label">Sala:</label>
                            <select class="form-control" id="id_sala" name="id_sala" required>
                                <option selected value="0">
                                    Selecione...
                                </option>
                                <?php
                                foreach ($pdo->query($querie->salas_listar()) as $value) {
                                    echo '<option value="' . $value['id'] . '">' . $value['sala'] . '</option>';
                                }
                                ?>
                            </select>                            
                        </div>                    
                        <div class="form-group">
                            <label for="setor_label">Início:</label>
                            <select class="form-control" id="inicio" name="inicio" required>
                                <option selected value="0">
                                    Selecione...
                                </option>
                                <?php
                                foreach ($pdo->query($querie->listar_inicio()) as $value) {
                                    echo '<option value="' . $value['id'] . '">' . $value['horario'] . '</option>';
                                }
                                ?>
                            </select>                            
                        </div>
                        <button class="btn btn-primary btn-dropbox" id="envia" type="submit">Gravar Horário de Reunião</button>
                    </form>                
                </div>
            </div>
        </div>
        <script src="../js/jquery-1.11.1.min.js"></script>
        <script src="../../css/bootstrap/js/bootstrap.min.js"></script>        
    </body>
</html>
