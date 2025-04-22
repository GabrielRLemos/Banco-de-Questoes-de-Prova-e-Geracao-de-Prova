<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - Banco de Questões</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex flex-column justify-content-center align-items-center vh-100">

<?php
// Exibe alerta se houver erro de login
if (isset($_SESSION['erro_login'])) {
    $mensagemErro = $_SESSION['erro_login'];
    unset($_SESSION['erro_login']);
    echo "<script>alert('" . addslashes($mensagemErro) . "');</script>";
}
?>

<div class="card shadow p-4" style="width: 100%; max-width: 600px;">
    <h2 class="text-center mb-4">Login do Professor</h2>
    <form action="login_actions.php" method="POST">
        <div class="mb-3">
            <label for="nome_professor" class="form-label">Nome:</label>
            <input type="text" name="nome_professor" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="senha" class="form-label">Senha:</label>
            <input type="password" name="senha" class="form-control" required>
        </div>
        
        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-primary">Entrar</button>
            <a href="cadastrar.html" class="btn btn-secondary">Ir para o Cadastro</a>
        </div>
    </form>
</div>

</body>
</html>
