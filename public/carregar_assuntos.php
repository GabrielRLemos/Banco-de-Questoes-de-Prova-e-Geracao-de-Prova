<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/../includes/connection.php';

// Recebe os dados do formulário principal
$pergunta = $_POST['pergunta'] ?? '';
$disciplina_id = $_POST['disciplina'] ?? '';

// Cadastrar novo assunto, se enviado
if (isset($_POST['novo_assunto']) && !empty($_POST['novo_assunto'])) {
    $novo_assunto = $conn->real_escape_string($_POST['novo_assunto']);
    $disciplina_id = intval($_POST['disciplina']); // garantir integridade
    $conn->query("INSERT INTO assuntos (nome_assunto, id_disciplina) VALUES ('$novo_assunto', $disciplina_id)");
}

// Buscar nome da disciplina
$disciplina = mysqli_query($conn, "SELECT nome FROM disciplinas WHERE id_disciplina = $disciplina_id");
$disciplina_nome = mysqli_fetch_assoc($disciplina)['nome'] ?? '';

// Buscar assuntos atualizados
$assuntos = mysqli_query($conn, "SELECT * FROM assuntos WHERE id_disciplina = $disciplina_id");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Selecione o Assunto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Selecione o Assunto - <?= htmlspecialchars($disciplina_nome) ?></h3>
            </div>
            <div class="card-body">

                <!-- Formulário para cadastrar nova questão -->
                <form action="processar_questao.php" method="post">
                    <input type="hidden" name="pergunta" value="<?= htmlspecialchars($pergunta) ?>">
                    <input type="hidden" name="disciplina" value="<?= $disciplina_id ?>">

                    <div class="mb-3">
                        <label class="form-label">Assuntos:</label>
                        <select name="assunto" class="form-select" required>
                            <?php while($a = mysqli_fetch_assoc($assuntos)): ?>
                                <option value="<?= $a['id_assuntos'] ?>"><?= $a['nome_assunto'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Cadastrar Questão</button>
                </form>

                <hr>    

                <!-- Formulário para adicionar novo assunto -->
                <form method="post" class="mt-4">
                    <input type="hidden" name="pergunta" value="<?= htmlspecialchars($pergunta) ?>">
                    <input type="hidden" name="disciplina" value="<?= $disciplina_id ?>">

                    <div class="mb-3">
                        <label class="form-label">Novo Assunto:</label>
                        <input type="text" name="novo_assunto" class="form-control" placeholder="Digite o novo assunto..." required>
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar Assunto</button>

                </form>
            </div>
        </div>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-3">
                        <a href="formulario_questao.php" class="btn btn-warning">
                            <i class="bi bi-arrow-left"></i> Voltar
                        </a>
                    </div>
    </div>
    
</body>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</html>

<?php mysqli_close($conn); ?>
