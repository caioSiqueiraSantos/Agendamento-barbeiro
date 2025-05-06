<?php
session_start(); // Continua a sessão para acessar os agendamentos

// Verifica se o índice de agendamento existe para exclusão
if (isset($_GET['delete'])) {
    $index = $_GET['delete'];
    unset($_SESSION['agendamentos'][$index]); // Remove o agendamento selecionado
    $_SESSION['agendamentos'] = array_values($_SESSION['agendamentos']); // Reindexa o array
    header("Location: barbeiro.php");
    exit;
}

// Atualiza um agendamento existente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_index'])) {
    $index = $_POST['edit_index'];
    // Atualiza os dados do agendamento no índice especificado
    $_SESSION['agendamentos'][$index] = [
        'nome' => $_POST['nome'],
        'telefone' => $_POST['telefone'],
        'servico' => $_POST['servico'],
        'data' => $_POST['data'],
        'horario' => $_POST['horario']
    ];
    header("Location: barbeiro.php");
    exit;
}

// Obtém os agendamentos da sessão
$agendamentos = $_SESSION['agendamentos'] ?? [];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamentos - Barbearia</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- CSS Customizado -->
    <link rel="stylesheet" href="style.css">
</head>
<body>


<div class="container mt-5">
    <!-- Caixa principal com o fundo estilizado -->
    <div class="main-content p-4 shadow">
        <h1 class="text-center mb-4">AGENDAMENTOS DOS CLIENTES</h1>

        <?php if (!empty($agendamentos)): ?>
            <!-- Tabela de agendamentos -->
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Serviço</th>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($agendamentos as $index => $agendamento): ?>
                        <tr>
                            <td><?= htmlspecialchars($agendamento['nome']) ?></td>
                            <td><?= htmlspecialchars($agendamento['telefone']) ?></td>
                            <td><?= htmlspecialchars($agendamento['servico']) ?></td>
                            <td><?= htmlspecialchars($agendamento['data']) ?></td>
                            <td><?= htmlspecialchars($agendamento['horario']) ?></td>
                            <td>
                                <!-- Botão de Edição -->
                                <button class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $index ?>">Editar</button>
                                <!-- Botão de Exclusão -->
                                <a href="?delete=<?= $index ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este agendamento?')">Excluir</a>
                            </td>
                        </tr>

                        <!-- Modal de Edição -->
                        <div class="modal fade" id="editModal<?= $index ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Editar Agendamento</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post">
                                        <div class="modal-body">
                                            <input type="hidden" name="edit_index" value="<?= $index ?>">
                                            <div class="mb-3">
                                                <label for="nome" class="form-label">Nome</label>
                                                <input type="text" class="form-control" name="nome" value="<?= htmlspecialchars($agendamento['nome']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="telefone" class="form-label">Telefone</label>
                                                <input type="text" class="form-control" name="telefone" value="<?= htmlspecialchars($agendamento['telefone']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="servico" class="form-label">Serviço</label>
                                                <input type="text" class="form-control" name="servico" value="<?= htmlspecialchars($agendamento['servico']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="data" class="form-label">Data</label>
                                                <input type="date" class="form-control" name="data" value="<?= htmlspecialchars($agendamento['data']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="horario" class="form-label">Horário</label>
                                                <input type="time" class="form-control" name="horario" value="<?= htmlspecialchars($agendamento['horario']) ?>" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <!-- Mensagem de ausência de agendamentos -->
            <p class="text-center fs-4 text-muted">Nenhum agendamento foi feito até o momento.</p>
        <?php endif; ?>
    </div>
</div>

<!-- Bootstrap JS e Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>