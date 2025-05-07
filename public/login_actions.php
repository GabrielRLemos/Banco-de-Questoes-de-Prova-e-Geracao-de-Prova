<?php
session_start();

// Verifica se o método é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conexão com o banco de dados
    $host = "localhost";
    $usuario = "root";
    $senha_bd = "";
    $banco = "bancodequestoes";

    $conn = new mysqli($host, $usuario, $senha_bd, $banco);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Define o charset para UTF-8
    $conn->set_charset("utf8mb4");

    // Recebe dados do formulário
    $nome = $conn->real_escape_string($_POST['nome_professor'] ?? '');
    $senha = $_POST['senha'] ?? '';

    // Consulta SQL com prepared statement
    $sql = "SELECT * FROM professores WHERE nome_professor = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $conn->error);
    }

    $stmt->bind_param("ss", $nome, $senha);
    
    if (!$stmt->execute()) {
        die("Erro na execução da consulta: " . $stmt->error);
    }

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $professor = $result->fetch_assoc();

        $_SESSION['id_professor'] = $professor['id_professor'];
        $_SESSION['nome_professor'] = $professor['nome_professor'];

        header("Location: hub.php");
        exit();
    } else {
        $_SESSION['erro_login'] = "Nome ou senha incorretos.";
        header("Location: login.php");
        exit();
    }

    $stmt->close();
    $conn->close();

} else {
    header("Location: login.php");
    exit();
}
?>