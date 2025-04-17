<?php
require __DIR__ . '/../includes/connection.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Questão</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Cadastrar Nova Questão</h3>
            </div>
            <div class="card-body">
                <form action="carregar_assuntos.php" method="post">
                    <div class="mb-3">
                        <label for="pergunta" class="form-label">Pergunta:</label>
                        <textarea name="pergunta" class="form-control" rows="5" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Disciplinas:</label>
                        <select name="disciplina" class="form-select" required>
                            <option value="" selected disabled>Selecione uma disciplina</option>
                            <?php
                            include('connection.php');
                            $disciplinas = mysqli_query($conn, "SELECT * FROM disciplinas");
                            while($d = mysqli_fetch_assoc($disciplinas)){
                                echo '<option value="'.$d['id_disciplina'].'">'.$d['nome'].'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Carregar Assuntos</button>
                </form>
            </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-3">
            <a href="hub.php" class="btn btn-warning">
                <i class="bi bi-arrow-left"></i> Voltar ao hub 
            </a>
        </div>
        <!-- Botão alinhado à esquerda -->
        <div class="text-start mt-3">
            <a href="consultar_questoes.php" class="btn btn-secondary">Consultar Questões</a>
        </div>
    </div>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
