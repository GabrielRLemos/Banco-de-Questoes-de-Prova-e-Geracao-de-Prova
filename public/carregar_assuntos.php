<?php
require __DIR__ . '/../includes/connection.php';

// Recebe os dados do formulário
$pergunta = $_POST['pergunta'];
$disciplina_id = $_POST['disciplina'];

// Busca a disciplina selecionada
$disciplina = mysqli_query($conn, "SELECT nome FROM disciplinas WHERE id_disciplina = $disciplina_id");
$disciplina_nome = mysqli_fetch_assoc($disciplina)['nome'];

// Busca os assuntos da disciplina
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
                <h3 class="mb-0">Selecione o Assunto - <?= $disciplina_nome ?></h3>
            </div>
            <div class="card-body">
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
            </div>
        </div>
    </div>
</body>
</html>
<?php mysqli_close($conn); ?>