<?php
// Dados de conexão
$servername = "localhost";
$username = "root";
$password = ""; // ou sua senha
$dbname = "QuestoesDB";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("<div style='padding:20px; font-family:sans-serif; color:red;'>Conexão falhou: " . $conn->connect_error . "</div>");
}

// Verificar se os dados foram enviados corretamente
if (isset($_POST['questao'], $_POST['materia'], $_POST['assunto'])) {
    // Receber dados do formulário
    $questao = $_POST['questao'];
    $materia = $_POST['materia'];
    $assunto = $_POST['assunto'];

    // Preparar e executar inserção
    $sql = "INSERT INTO Questoes (questao, materia, assunto) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("<div style='padding:20px; font-family:sans-serif; color:red;'>Erro na preparação da query: " . $conn->error . "</div>");
    }

    $stmt->bind_param("sss", $questao, $materia, $assunto);

    if ($stmt->execute()) {
        echo "<div style='padding:20px; font-family:sans-serif; color:green;'>
                <h2>Questão enviada com sucesso!</h2>
                <a href='formulario.html'>Voltar ao formulário</a>
              </div>";
    } else {
        echo "<div style='padding:20px; font-family:sans-serif; color:red;'>
                Erro ao enviar questão: " . $stmt->error . "
              </div>";
    }

    $stmt->close();
} else {
    echo "<div style='padding:20px; font-family:sans-serif; color:red;'>Todos os campos são obrigatórios.</div>";
}

$conn->close();
?>