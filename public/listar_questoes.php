<?php
require __DIR__ . '/../includes/connection.php';

$sql = "SELECT * FROM questoes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='table table-striped'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pergunta</th>
                    <th>ID Assunto</th>
                    <th>ID Disciplina</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>";

    while ($row = $result->fetch_assoc()) {
        $id = $row['id_questao'];
        echo "<tr>
                <td>{$id}</td>
                <td><input type='text' class='form-control' id='pergunta_{$id}' value='" . htmlspecialchars($row['pergunta']) . "' readonly></td>
                <td><input type='number' class='form-control' id='assunto_{$id}' value='{$row['id_assuntos']}' readonly></td>
                <td><input type='number' class='form-control' id='disciplina_{$id}' value='{$row['id_disciplina']}' readonly></td>
                <td>
                    <button class='btn btn-warning btn-sm' id='btnEditar_{$id}' onclick='editarQuestao($id)'>Editar</button>
                    <button class='btn btn-success btn-sm' id='btnSalvar_{$id}' onclick='salvarEdicao($id)' style='display:none;'>Salvar</button>
                    <button class='btn btn-danger btn-sm' onclick='removerQuestao($id)'>Remover</button>
                </td>
              </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p class='text-muted'>Nenhuma questão cadastrada.</p>";
}

$conn->close();
?>
