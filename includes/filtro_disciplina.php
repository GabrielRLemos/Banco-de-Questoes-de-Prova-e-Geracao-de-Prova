<?php
if (!function_exists('getProfessoresFiltrados')) {
    function getProfessoresFiltrados($conn, $filtro_disciplina = '') {
        // Prevenir SQL injection
        $where = '';
        if (!empty($filtro_disciplina)) {
            $filtro_disciplina = intval($filtro_disciplina);
            $where = " WHERE p.id_disciplina = " . $filtro_disciplina;
        }
        
        $sql = "SELECT p.id_professor, p.nome_professor, d.id_disciplina, d.nome 
                FROM professores p 
                JOIN disciplinas d ON p.id_disciplina = d.id_disciplina" . $where;
        
        $result = $conn->query($sql);
        
        if (!$result) {
            error_log("Erro SQL: " . $conn->error);
            return false;
        }
        
        return $result;
    }
}
?>