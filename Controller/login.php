<?php

include_once '../config/database_mysql.php';
$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
$pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
$sql = "SELECT COUNT(id) AS contar, id, login,nome_extenso, id_setor,admin FROM usuarios where status in (1) and login = ? AND pass = ?";
$q = $pdo->prepare($sql);
$q->execute(array($user, $pass));
$data = $q->fetch(PDO::FETCH_ASSOC);
$logando = $data['contar'] == 1 ? TRUE : FALSE;
session_start();
$_SESSION['user'] = $user;
$_SESSION['user_id'] = $data['id'];
$_SESSION['setor'] = $data['id_setor'];
$_SESSION['admin'] = $data['admin'];
$_SESSION['nome_extenso'] = $data['nome_extenso'];
$logando == true ? header('Location: ../View/index.php') : header('Location: ../../index.html');
