<?php
require 'connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $pergunta = $_POST['pergunta'];
        $disciplina = $_POST['disciplina'];
        $assunto = $_POST['assunto'];
    
        $stmt = $conn->prepare("INSERT INTO questoes (pergunta, id_disciplina) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $nome_, $disciplina);
    
        if ($stmt->execute()) {
            echo "<script>alert('Login realizado com sucesso!'); window.location.href='cadastrar.html';</script>";
        }        
        else {
            echo "<script>alert('Erro ao realizar login! (erro na conexão).'); window.location.href='cadastrar.html';</script>";
        }
    }
    $stmt->close();
    $conn->close();
    exit();
?>
