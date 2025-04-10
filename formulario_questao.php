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
                            <option value="1">Matemática</option>
                            <option value="2">Português</option>
                            <option value="3">Química</option>
                        </select>
                    </div>
                    <input type="hidden" name="pergunta" value="<?= htmlspecialchars($_POST['pergunta']) ?>">
                    <input type="hidden" name="disciplina" value="<?= $_POST['disciplina'] ?>">

                    <div class="mb-3">
                        <label class="form-label">Assuntos:</label>
                        <select name="assunto" class="form-select" required>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Carregar Assuntos</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>