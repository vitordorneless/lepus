<?php

class SalasController {

    public function listar() {
        session_start();
        require '../Model/Queries.php';
        include '../config/database_mysql.php';
        $pdo = Database::connect();
        $querie = new Queries();
        $retorno = '';
        foreach ($pdo->query($querie->salas_listar()) as $value) {
            $situation = $value['status'] == 1 ? "Ativo" : "Inativo";
            $retorno .= '<tr>';
            $retorno .= '<td>' . $value['sala'] . '</td>';
            $retorno .= '<td>' . $situation . '</td>';
            $retorno .= '<td><a href="salas.php?id=' . $value['id'] . '" class="btn btn-default btn-danger">Editar Sala</a></td>';
            $retorno .= '</tr>';
        }
        Database::disconnect();
        return $retorno;
    }

}
