<?php

class UsuarioController {

    public function listar() {
        session_start();
        require '../Model/Queries.php';
        include '../config/database_mysql.php';
        $pdo = Database::connect();
        $querie = new Queries();
        $retorno = '';
        foreach ($pdo->query($querie->usuarios_listar()) as $value) {
            $qq = $pdo->prepare($querie->usuarios_setor($value['id_setor']));
            $qq->execute();
            $setor = $qq->fetch(PDO::FETCH_ASSOC);
            $situation = $value['status'] == 1 ? "Ativo" : "Inativo";
            $admin = $value['admin'] == 1 ? "Sim" : "Não";
            $retorno .= '<tr>';
            $retorno .= '<td>' . $value['nome_extenso'] . '</td>';
            $retorno .= '<td>' . $setor['setor'] . '</td>';
            $retorno .= '<td>' . $admin . '</td>';
            $retorno .= '<td>' . $situation . '</td>';
            $retorno .= '<td><a href="usuarios.php?id=' . $value['id'] . '" class="btn btn-default btn-danger">Editar Usuário</a></td>';
            $retorno .= '</tr>';
        }
        Database::disconnect();
        return $retorno;
    }

    public function dadoseditar($id) {
        require '../Model/Usuarios.php';
        $user = new Usuarios();
        return $user->Dados_User($id);
    }

}
