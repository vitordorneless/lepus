<?php

class ReservaSalasController {

    public function listar() {
        session_start();
        require '../Model/Queries.php';
        include '../config/database_mysql.php';
        $pdo = Database::connect();
        $querie = new Queries();
        $retorno = '';
        foreach ($pdo->query($querie->salas_listar()) as $value) {
            foreach ($pdo->query($querie->listar_inicio()) as $values) {
                $qqqq = $pdo->prepare($querie->marcar_mesmo_horario_sala($values['horario'], $value['id']));
                $qqqq->execute();
                $temos_nesse_horario = $qqqq->fetch(PDO::FETCH_ASSOC);

                if ($temos_nesse_horario['temos'] < 1) {
                    $sala = $value['sala'];
                    $funcionario = '...';
                    $inicio = $values['horario'];
                    $qqqqq = $pdo->prepare($querie->pegar_inicio(bcadd($values['id'], 1)));
                    $qqqqq->execute();
                    $fim_array = $qqqqq->fetch(PDO::FETCH_ASSOC);
                    $fim = $fim_array['horario'];
                    $situation = "Livre";
                } else {
                    $qqqqqq = $pdo->prepare($querie->pega_nome_funcionario($temos_nesse_horario['id_user']));
                    $qqqqqq->execute();
                    $nome_funcionario = $qqqqqq->fetch(PDO::FETCH_ASSOC);
                    $sala = '<strong>' . $value['sala'] . '</strong>';
                    $funcionario = '<strong>' . $nome_funcionario['nome_extenso'] . '</strong>';
                    $inicio = '<strong>' . substr($temos_nesse_horario['inicio'], 0, 5) . '</strong>';
                    $qqqqq = $pdo->prepare($querie->pegar_inicio(bcadd($values['id'], 1)));
                    $qqqqq->execute();
                    $fim_array = $qqqqq->fetch(PDO::FETCH_ASSOC);
                    $fim = '<strong>' . $fim_array['horario'] . '</strong>';
                    $situation = $temos_nesse_horario['status'] == 1 ? "<strong>Reservado</strong>" : "Livre";
                }
                $botao = $_SESSION['user_id'] == $temos_nesse_horario['id_user'] ? '<td><a href="../Controller/cancelar_sala.php?id=' . $temos_nesse_horario['id'] . '" class="btn btn-default btn-danger">Cancelar Sala</a></td>' : '<td>...</td>';
                $retorno .= '<tr>';
                $retorno .= '<td>' . $sala . '</td>';
                $retorno .= '<td>' . $funcionario . '</td>';
                $retorno .= '<td>' . $inicio . '</td>';
                $retorno .= '<td>' . $fim . '</td>';
                $retorno .= '<td>' . $situation . '</td>';
                $retorno .= $botao;
                $retorno .= '</tr>';
            }
        }

        Database::disconnect();
        return $retorno;
    }

}
