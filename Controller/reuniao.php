<?php

session_start();
require '../Model/Reuniao.php';
require '../Model/Queries.php';
include '../config/database_mysql.php';

$pdo = Database::connect();
$querie = new Queries();
$reuniao = new Reuniao();

$id_user = filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_NUMBER_INT);
$id_sala = filter_input(INPUT_POST, 'id_sala', FILTER_SANITIZE_NUMBER_INT);
$inicio = filter_input(INPUT_POST, 'inicio', FILTER_SANITIZE_NUMBER_INT);

if (($id_sala == 0) or ($inicio == 0)) {
    $_SESSION['msg'] = 'Erro!! Você deve marcar o início da reunião para marcar, tente novamente!';
    header('Location: ../View/erro.php');
    exit();
} else {
    $qq = $pdo->prepare($querie->pegar_fim($inicio));
    $qq->execute();
    $horario = $qq->fetch(PDO::FETCH_ASSOC);

    $qqq = $pdo->prepare($querie->pegar_inicio($inicio));
    $qqq->execute();
    $horarios_inicio = $qqq->fetch(PDO::FETCH_ASSOC);

    $qqqq = $pdo->prepare($querie->marcar_mesmo_horario($horarios_inicio['horario'], $id_user, $id_sala));
    $qqqq->execute();
    $mesmo_horario = $qqqq->fetch(PDO::FETCH_ASSOC);

    $qqqqh = $pdo->prepare($querie->marcar_mesmo_horario_sala_diferente($horarios_inicio['horario'], $id_user));
    $qqqqh->execute();
    $mesmo_horario_sala_diferente = $qqqqh->fetch(PDO::FETCH_ASSOC);

    if ($mesmo_horario_sala_diferente['temos'] < 1) {
        $_SESSION['msg'] = 'Erro!! Não pode marcar mesmo horário para Salas Diferentes...';
        header('Location: ../View/erro.php');
        exit();
    }

    if ($mesmo_horario['temos'] < 1) {
        $qqqqs = $pdo->prepare($querie->marcar_mesmo_horario_salas($horarios_inicio['horario'], $id_sala));
        $qqqqs->execute();
        $mesmo_sala = $qqqqs->fetch(PDO::FETCH_ASSOC);

        if ($mesmo_sala['temos'] < 1) {
            $confirm = $reuniao->save($id_user, $id_sala, $horarios_inicio['horario'] . ':00', $horario['horario'] . ':00');
            if ($confirm === TRUE) {
                header('Location: ../View/sucesso.php');
            } else {
                $_SESSION['msg'] = 'Erro!! Contate a TI...';
            }
        } else {
            $_SESSION['msg'] = 'Erro!! Esta Sala tem reunião nesse horário...';
            header('Location: ../View/erro.php');
        }
    } else {
        $_SESSION['msg'] = 'Erro!! Você já tem reunião nesse horário e nessa Sala...';
        header('Location: ../View/erro.php');
    }
}