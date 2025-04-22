<?php
if (!function_exists('getQuestoesFiltrados')) {
    function getQuestoesFiltrados($conn, $filtro_questao = '') {
        $where = '';
        if (!empty($filtro_questao)) {
            $filtro_questao = intval($filtro_questao);
            $where = " WHERE q.id_disciplina = $filtro_questao";
        }

        $sql = "SELECT q.*, a.nome_assunto, d.nome as nome_disciplina
                FROM questoes q
                JOIN assuntos a ON q.id_assuntos = a.id_assuntos
                JOIN disciplinas d ON q.id_disciplina = d.id_disciplina
                $where";

        $result = $conn->query($sql);

        if (!$result) {
            error_log("Erro SQL: " . $conn->error);
            return false;
        }

        return $result;
    }
}
?>
