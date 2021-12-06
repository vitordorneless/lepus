<?php
session_start();

$id = $_GET['id'];
include '../config/database_mysql.php';
require '../Model/Queries.php';
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$querie = new Queries();
if ($id > 0) {
    $q = $pdo->prepare($querie->dados_user($id));
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
                <h2><strong>Incluir / Editar Usuário</strong></h2>                
                <div class="modal-body">
                    <form id="form" method="POST" action="../Controller/usuarios.php">
                        <div class="form-group">
                            <label for="label_nome">Nome do Usuário:</label>
                            <input required="required" type="text" value="<?= $id == 0 ? '' : $data['nome_extenso'] ?>" class="form-control" id="nome_extenso" name="nome_extenso" placeholder="Informe o nome do Usuário(a)..." autofocus>            
                            <input type="hidden" value="<?= $id == 0 ? 0 : $data['id'] ?>" class="form-control" id="id" name="id">                            
                        </div>
                        <div class="form-group">
                            <label for="label_nome">Login:</label>
                            <input required="required" type="text" value="<?= $id == 0 ? '' : $data['login'] ?>" class="form-control" id="login" name="login" placeholder="Informe o login">                            
                        </div>
                        <div class="form-group">
                            <label for="label_nome">Senha:</label>
                            <input required="required" type="password" value="<?= $id == 0 ? '' : $data['pass'] ?>" class="form-control" id="pass" name="pass" placeholder="Informe a senha">                            
                        </div>
                        <div class="form-group">
                            <label for="agencia_label">Setor:</label>
                            <select class="form-control" id="id_setor" name="id_setor">
                                <option selected value="na">
                                    Selecione...
                                </option>
                                <?php
                                foreach ($pdo->query($querie->listar_setor()) as $value) {
                                    $option = $value['id'] == $data['id_setor'] ? 'value="' . $value['id'] . '" selected' : 'value="' . $value['id'] . '"';
                                    echo '<option ' . $option . '>' . $value['setor'] . '</option>';
                                }

                                Database::disconnect();
                                ?>
                            </select>                            
                        </div>        
                        <div class="form-group">
                            <label for="agencia_label">Admin:</label>
                            <select class="form-control" id="admin" name="admin">
                                <?php
                                if ($id <> 0) {
                                    $seleciona11 = $data['admin'] == '1' ? "selected" : " ";
                                    $seleciona22 = $data['admin'] == '0' ? "selected" : " ";
                                } else {
                                    $seleciona11 = " ";
                                    $seleciona22 = " ";
                                }
                                ?>
                                <option selected value="0">
                                    Aguardando...
                                </option>
                                <option value="1" <?php echo $seleciona11; ?>>
                                    Sim
                                </option>
                                <option value="0" <?php echo $seleciona22; ?>>
                                    Não
                                </option>
                            </select>                                   
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