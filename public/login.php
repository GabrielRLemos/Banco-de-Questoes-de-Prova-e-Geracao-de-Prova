<?php
// Conexão com o banco de dados
$host = "localhost";
$usuario = "root";
$senha_bd = ""; // ou "sua_senha" se tiver
$banco = "bancodequestoes";

$conn = new mysqli($host, $usuario, $senha_bd, $banco);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Recebe dados do formulário
$nome = $_POST['nome_professor'];
$senha = $_POST['senha'];

// Consulta SQL
$sql = "SELECT * FROM professores WHERE nome_professor = ? AND senha = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $nome, $senha);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('Login realizado com sucesso!'); window.location.href='hub.html';</script>";
} else {
    echo "<script>alert('Nome ou senha incorreto, Digite novamente!!.'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
