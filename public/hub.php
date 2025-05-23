<?php
// Inicia a sessão

session_start();

if (!isset($_SESSION['id_professor'])) {
    header("Location: login.php");
    exit();
}

$nome_professor = htmlspecialchars($_SESSION['nome_professor']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bem-vindo</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="text-white d-flex justify-content-center align-items-center" style="height: 100vh; background-image: url(../assets/background.jpg); background-size: cover; background-position: center;">

  <div class="container text-center">
    <div class="card bg-light text-dark shadow-lg p-5 rounded-4 mx-auto" style="width: 100%;">
     <h1 class="display-4 fw-bold">Bem-vindo ao hub, Professor <?php echo htmlspecialchars($_SESSION['nome_professor']); ?>!</h1>
      <p class="lead mt-3">É um prazer ter você aqui. Sinta-se à vontade para explorar.</p>
      
      <div class="row mt-4 g-3">
        <div class="col-md-3 col-6">
          <a href="formulario_questao.php"><button class="btn btn-primary btn-lg w-100">Criar Questões</button></a>
        </div>
        <div class="col-md-3 col-6">
          <a href="consultar_professores.php"><button class="btn btn-primary btn-lg w-100">Consultar Professores</button></a>
        </div>
        <div class="col-md-3 col-6">
          <a href="consultar_questoes.php"><button class="btn btn-primary btn-lg w-100">Consultar Questões</button></a>
        </div>
        <div class="col-md-3 col-6">
          <a href="logout.php"><button class="btn btn-danger btn-lg w-100">Sair</button></a>
        </div>
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
