<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$base_path = __DIR__;

require $base_path . '/../includes/connection.php';
require $base_path . '/../includes/listar_disciplinas.php';
require $base_path . '/../includes/editar_professores.php';
require $base_path . '/../includes/remover_professores.php';
require_once $base_path . '/../includes/filtro_disciplina.php';

// Obtém a lista de disciplinas
$disciplinas = getDisciplinas($conn);

// Verifica se há um filtro aplicado
$filtro_disciplina = isset($_POST['filtro_disciplina']) ? intval($_POST['filtro_disciplina']) : '';

// Busca os Professores (com filtro, se aplicável)
$result = getProfessoresFiltrados($conn, $filtro_disciplina);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Professores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>
<body class="d-flex" style="height: 100vh; background-image: url(../assets/background.jpg); background-size: cover; background-position: center;">
    <div class="container mt-5">
        <!-- Exibição de mensagens -->
        <?php if (isset($_SESSION['mensagem'])): ?>
            <div class="alert alert-<?= $_SESSION['tipo_mensagem'] ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['mensagem'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
            unset($_SESSION['mensagem']);
            unset($_SESSION['tipo_mensagem']);
            ?>
        <?php endif; ?>
    <div class="card shadow">
        <div class="card-header bg-info text-white">
            <h1 class="mb-0">Consultar Professores</h1>
        </div>
    <div class="card-body">

        <!-- Filtro por Disciplina -->
        <form method="post" class="row g-3 mb-4 align-items-center">
            <div class="col-md-5">
                <select class="form-select" name="filtro_disciplina">
                    <option value="">Todas as Disciplinas</option>
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

        <!-- Tabela de Professores -->
        <?php if ($result->num_rows > 0) { ?>
            <div class="table-responsive" style="width: 100%;">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Nome do Professor</th>
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
            <a href="hub.php" class="btn btn-warning">
                <i class="bi bi-arrow-left"></i> Voltar ao hub 
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Fecha a conexão com o banco
$conn->close();
?>
