<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$base_path = __DIR__;

require $base_path . '/../includes/connection.php';
require $base_path . '/../includes/listar_disciplinas.php';
require $base_path . '/../includes/editar_professores.php';
require $base_path . '/../includes/remover_professores.php';
require_once $base_path . '/../includes/filtro_disciplina.php';

// Obtém a lista de departamentos
$disciplinas = getDisciplinas($conn);

// Verifica se há um filtro aplicado
$filtro_disciplina = isset($_POST['filtro_disciplina']) ? intval($_POST['filtro_disciplina']) : '';

// Busca os funcionários (com filtro, se aplicável)
$result = getProfessoresFiltrados($conn, $filtro_disciplina);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Professores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex">
    <div class="container mt-4 align-items-center">
        <div class="d-flex align-items-center mb-3">
            <h3 class="mb-0">Consulta de Professores</h3>
        </div>

        <!-- Filtro por Disciplina -->
<form method="post" class="row g-3 mb-4 align-items-center">
    <div class="col-md-5">
        <select class="form-select" name="filtro_disciplina">
            <option value="">Selecione uma disciplina</option>
            <?php foreach ($disciplinas as $disciplina) { ?>
                <option value="<?= $disciplina['id_disciplina'] ?>" <?= ($disciplina['id_disciplina'] == $filtro_disciplina) ? "selected" : "" ?>>
                    <?= $disciplina['nome'] ?>
                </option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100">Filtrar</button>
    </div>
</form>

        <!-- Tabela de Funcionários -->
        <?php if ($result->num_rows > 0) { ?>
            <div class="table-responsive" style="width: 100%;">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Nome</th>
                            <th class="text-center">Disciplina</th>
                            <th class="text-center" style="width: 250px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { 
                            $id_disciplina_atual = $row['id_disciplina'];
                        ?>
                            <tr>
                                <form method="post">
                                    <td class="align-middle"><?= $row['id_professor'] ?></td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm" name="nome_professor" value="<?= htmlspecialchars($row['nome_professor']) ?>" required>
                                    </td>
                                    <td>
                                        <select class="form-select form-select-sm" name="id_disciplina">
                                            <?php foreach ($disciplinas as $disciplina) { ?>
                                                <option value="<?= $disciplina['id_disciplina'] ?>" <?= ($disciplina['id_disciplina'] == $id_disciplina_atual) ? "selected" : "" ?>>
                                                    <?= $disciplina['nome'] ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex gap-2 justify-content-center">
                                            <input type="hidden" name="id_professor" value="<?= $row['id_professor'] ?>">
                                            <button type="submit" name="editar" class="btn btn-sm btn-success">
                                                <i class="bi bi-check-lg"></i> Salvar
                                            </button>
                                            <button type="submit" name="remover" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir este professor?');">
                                                <i class="bi bi-trash"></i> Remover
                                            </button>
                                        </div>
                                    </td>
                                </form>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="alert alert-warning text-center">Nenhum professor encontrado.</div>
        <?php } ?>


        <div class="d-grid gap-2 d-md-flex justify-content-md-start mt-3">
            <a href="cadastrar.html" class="btn btn-warning">
                <i class="bi bi-arrow-left"></i> Voltar ao Cadastro
            </a>
        </div>
    </div>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Fecha a conexão com o banco
$conn->close();
?>
