<?php
session_start();
require '../Model/Usuarios.php';
$user = new Usuarios();
$login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
$pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
$nome_extenso = filter_input(INPUT_POST, 'nome_extenso', FILTER_SANITIZE_STRING);
$id_setor = filter_input(INPUT_POST, 'id_setor', FILTER_SANITIZE_NUMBER_INT);
$admin = filter_input(INPUT_POST, 'admin', FILTER_SANITIZE_NUMBER_INT);
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$temos = $user->Dados_User_existe($login);

if ($id == 0) {
    if ($temos === true) {
        $confirm = $user->saveUser($login, $pass, $nome_extenso, $id_setor, $admin);
    }
} else {
    $confirm = $user->edit_User($id, $login, $pass, $nome_extenso, $id_setor, $admin, 1);
}

if ($confirm === TRUE) {
    header('Location: ../View/sucesso.php');
} else {
    header('Location: ../View/erro.php');
}


