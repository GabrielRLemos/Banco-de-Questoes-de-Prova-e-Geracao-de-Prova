<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar'])) {
    $id_professor = intval($_POST['id_professor']);
    $nome_professor = $_POST['nome_professor'];
    $id_disciplina = intval($_POST['id_disciplina']);

    $sql_update = "UPDATE professores SET nome_professor = ?, id_disciplina = ? WHERE id_professor = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sii", $nome_professor, $id_disciplina, $id_professor);

    if ($stmt_update->execute()) {
        echo "<script>alert('Professor atualizado com sucesso!'); window.location.href='consultar_professores.php';</script>";
    } else {
        echo "Erro ao atualizar professor: " . $stmt_update->error;
    }
}
?>