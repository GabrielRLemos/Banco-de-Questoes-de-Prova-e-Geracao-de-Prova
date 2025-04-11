<?php
require __DIR__ . '/../includes/connection.php';

$acao = $_POST['acao'] ?? $_GET['acao'] ?? '';

if ($acao === 'editar') {
    $id = $_POST['id_questao'];
    $pergunta = $_POST['pergunta'];
    $id_assuntos = $_POST['id_assuntos'];
    $id_disciplina = $_POST['id_disciplina'];

    $stmt = $conn->prepare("UPDATE questoes SET pergunta = ?, id_assuntos = ?, id_disciplina = ? WHERE id_questao = ?");
    $stmt->bind_param("siii", $pergunta, $id_assuntos, $id_disciplina, $id);
    $stmt->execute();
    $stmt->close();
}

if ($acao === 'remover') {
    $id = $_POST['id_questao'];
    $stmt = $conn->prepare("DELETE FROM questoes WHERE id_questao = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
?>
