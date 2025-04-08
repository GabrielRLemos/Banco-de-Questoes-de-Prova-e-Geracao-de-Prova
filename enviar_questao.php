<?php
// Mostrar todos os erros do PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Mensagem padrão
$mensagem = "";

// Processar o envio do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco
    $conn = new mysqli("localhost", "root", "", "bancodequestoes");

    if ($conn->connect_error) {
        $mensagem = "<div class='alert alert-danger'>Erro de conexão: " . $conn->connect_error . "</div>";
    } else {
        // Dados do formulário
        $pergunta = $_POST['pergunta'];
        $disciplina = $_POST['disciplina'];
        $assunto = $_POST['assunto'];

        // Inserção no banco
        $sql = "INSERT INTO questoes (pergunta, id_disciplina, nome_assunto) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sii", $pergunta, $disciplina, $assunto);
            if ($stmt->execute()) {
                $mensagem = "<div class='alert alert-success mt-3'>Questão enviada com sucesso!</div>";
            } else {
                $mensagem = "<div class='alert alert-danger mt-3'>Erro ao enviar questão: " . $stmt->error . "</div>";
            }
            $stmt->close();
        } else {
            $mensagem = "<div class='alert alert-danger mt-3'>Erro na preparação da consulta: " . $conn->error . "</div>";
        }

        $conn->close();
    }
}
?>
