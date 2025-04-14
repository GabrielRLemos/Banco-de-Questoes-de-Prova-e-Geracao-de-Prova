<?php
session_start();

// Verifica se o método é POST (quando o usuário envia o formulário)
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

    // Recebe dados do formulário
    $nome = $_POST['nome_professor'] ?? '';
    $senha = $_POST['senha'] ?? '';

    // Consulta SQL com prepared statement
    $sql = "SELECT * FROM professores WHERE nome_professor = ? AND senha = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $nome, $senha);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $professor = $result->fetch_assoc();

        $_SESSION['id_professor'] = $professor['id_professor']; // ajuste o nome conforme seu banco
        $_SESSION['nome_professor'] = $professor['nome_professor'];

        echo "<script>alert('Login realizado com sucesso!'); window.location.href='hub.php';</script>";
    } else {
        echo "<script>alert('Nome ou senha incorretos.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();

} else {
    echo "<script> window.location.href='login.html';</script>";
}
?>
