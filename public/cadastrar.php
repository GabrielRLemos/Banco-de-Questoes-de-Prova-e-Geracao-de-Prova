<?php
require __DIR__ . '/../includes/connection.php'; 

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nome_professor = $_POST['nome_professor'];
        $senha = $_POST['senha'];
        $disciplina = $_POST['disciplina'];
    
        $stmt = $conn->prepare("INSERT INTO professores (nome_professor, senha, id_disciplina) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $nome_professor, $senha, $disciplina);
    
        if ($stmt->execute()) {
            echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='cadastrar.html';</script>";
        }        
        else {
            echo "<script>alert('Erro ao realizar cadastro! (erro na conexão).'); window.location.href='cadastrar.html';</script>";
        }
    }
    $stmt->close();
    $conn->close();
    exit();
?>