<?php
require __DIR__ . '/../includes/connection.php';

if (isset($_POST['remover'])) {
    $id_professor = intval($_POST['id_professor']);
    $sql_delete = "DELETE FROM professores WHERE id_professor = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id_professor);

    if ($stmt_delete->execute()) {
        $_SESSION['mensagem'] = "Professor removido com sucesso!";
        $_SESSION['tipo_mensagem'] = "success";
    } else {
        $_SESSION['mensagem'] = "Erro ao remover professor: " . $stmt_delete->error;
        $_SESSION['tipo_mensagem'] = "danger";
    }
    
    header("Location: consultar_professores.php");
    exit();
}
?>