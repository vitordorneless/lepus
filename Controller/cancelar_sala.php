<?php

session_start();
require '../Model/Reuniao.php';
$reuniao = new Reuniao();
$id = $_GET['id'];
$cancelar_sala = $reuniao->delete($id);
if ($cancelar_sala === TRUE) {
    $_SESSION['msg'] = 'Reunião / Sala Cancelada!!';
    header('Location: ../View/sucesso.php');
} else {
    $_SESSION['msg'] = 'Erro!!';
    header('Location: ../View/erro.php');
}