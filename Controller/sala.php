<?php
session_start();
require '../Model/Salas.php';
$sala = new Salas();
$salas = filter_input(INPUT_POST, 'sala', FILTER_SANITIZE_STRING);
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$temos = $sala->Dados_Sala_existe($salas);

if ($id == 0) {
    if ($temos === true) {
        $confirm = $sala->saveSala($salas);
    }
} else {
    $confirm = $sala->edit_Sala($id, $salas, 1);
}

if ($confirm === TRUE) {
    header('Location: ../View/sucesso.php');
} else {
    header('Location: ../View/erro.php');
}


