<?php
require __DIR__ . '/../includes/connection.php';

$pergunta = $_POST['pergunta'];
$disciplina = $_POST['disciplina'];
$assunto = $_POST['assunto'];

$sql = "INSERT INTO questoes (pergunta, id_disciplina, id_assuntos) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $pergunta, $disciplina, $assunto);

if($stmt->execute()) {
    echo "<script>alert('Questão cadastrada com sucesso!'); window.location.href='formulario_questao.php';</script>";
} else {
    echo "<script>alert('Erro ao cadastrar questão: " . addslashes($stmt->error) . "'); window.location.href='formulario_questao.php';</script>";
}

$stmt->close();
mysqli_close($conn);
?>