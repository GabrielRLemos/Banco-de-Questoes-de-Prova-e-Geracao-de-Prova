<?php
include 'connection.php';

if (isset($_POST['remover'])) {
    $id_disciplina = intval($_POST['id_disciplina']);
    $sql_delete = "DELETE FROM professores WHERE id_professor = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id_professor);

    if ($stmt_delete->execute()) {
        echo "<script>alert('Professor removido com sucesso!'); window.location.href='consultar_professores.php';</script>";
    } else {
        echo "Erro ao remover professor: " . $stmt_delete->error;
    }
}
?>