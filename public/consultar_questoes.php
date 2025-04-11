<?php
require __DIR__ . '/../includes/connection.php';

// Lógica de remoção
if (isset($_GET['remover'])) {
    $id = intval($_GET['remover']);
    $conn->query("DELETE FROM questoes WHERE id_questao = $id");
    header("Location: consultar_questoes.php");
    exit;
}

// Lógica de edição
if (isset($_POST['editar'])) {
    $id = intval($_POST['id_questao']);
    $pergunta = $conn->real_escape_string($_POST['pergunta']);
    $id_assunto = intval($_POST['id_assuntos']);
    $id_disciplina = intval($_POST['id_disciplina']);

    $conn->query("UPDATE questoes SET pergunta='$pergunta', id_assuntos=$id_assunto, id_disciplina=$id_disciplina WHERE id_questao=$id");
    header("Location: consultar_questoes.php?editado=1");
    exit;
}

// Carregar todos os assuntos para preencher os <select>
$assuntos_result = $conn->query("SELECT id_assuntos, nome_assunto FROM assuntos");
$assuntos = [];
while ($row = $assuntos_result->fetch_assoc()) {
    $assuntos[$row['id_assuntos']] = $row['nome_assunto'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Questões Cadastradas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h3 class="mb-0">Questões Cadastradas</h3>
            </div>
            <div class="card-body">

                <?php if (isset($_GET['editado']) && $_GET['editado'] == 1): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        A questão foi <strong>alterada com sucesso!</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                    </div>
                <?php endif; ?>

                <?php
                // Consulta com JOIN para pegar o nome do assunto
                $sql = "SELECT q.*, a.nome_assunto 
                        FROM questoes q
                        JOIN assuntos a ON q.id_assuntos = a.id_assuntos";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table class='table table-bordered'>
                            <thead class='table-light'>
                                <tr>
                                    <th>ID</th>
                                    <th>Pergunta</th>
                                    <th>Assunto</th>
                                    <th>ID Disciplina</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <form method='post' action='consultar_questoes.php'>
                                <td>{$row['id_questao']}<input type='hidden' name='id_questao' value='{$row['id_questao']}'></td>
                                <td><input type='text' name='pergunta' class='form-control' value='".htmlspecialchars($row['pergunta'], ENT_QUOTES)."'></td>
                                <td>
                                    <select name='id_assuntos' class='form-select'>";
                        foreach ($assuntos as $id_assunto => $nome_assunto) {
                            $selected = $id_assunto == $row['id_assuntos'] ? "selected" : "";
                            echo "<option value='$id_assunto' $selected>$nome_assunto</option>";
                        }
                        echo "</select>
                                </td>
                                <td><input type='number' name='id_disciplina' class='form-control' value='{$row['id_disciplina']}'></td>
                                <td>
                                    <button type='submit' name='editar' class='btn btn-success btn-sm'>Salvar</button>
                                    <a href='consultar_questoes.php?remover={$row['id_questao']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Deseja remover esta questão?\")'>Remover</a>
                                </td>
                            </form>
                        </tr>";
                    }

                    echo "</tbody></table>";
                } else {
                    echo "<p class='text-muted'>Nenhuma questão cadastrada ainda.</p>";
                }

                $conn->close();
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
