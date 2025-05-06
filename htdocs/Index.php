<?php
session_start(); // Inicia a sessão para armazenar dados do usuário enquanto ele navega

// Inicia o array de agendamentos na sessão, se não existir
if (!isset($_SESSION['agendamentos'])) {
    $_SESSION['agendamentos'] = []; // Inicializa o array de agendamentos
}

// Processa o formulário e armazena o agendamento
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cria um array associativo para armazenar os dados do agendamento
    $agendamento = [
        'nome' => $_POST['nome'],
        'telefone' => $_POST['telefone'],
        'servico' => $_POST['servico'],
        'data' => $_POST['data'],
        'horario' => $_POST['horario']
    ];
    // Adiciona o novo agendamento ao array na sessão
    $_SESSION['agendamentos'][] = $agendamento;
    echo "<script>alert('Agendado com sucesso!'); window.location.href='index.php';</script>"; // Exibe mensagem de confirmação
}
?>

<!DOCTYPE html>
    <html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Agendamento - BARBEARIA ALPHA</title>
        <link rel="stylesheet" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>

        <!-- Seção Superior com Imagem de Fundo -->
        <section id="top-section">
            <!-- Espaço para a imagem -->
        </section>

        <!-- Logo Central -->
        <div id="logo-container">
        </div>

        <!-- Seção Inferior com Conteúdo Principal -->
        <section id="bottom-section">
            <h1>BARBEARIA ALPHA</h1>
            <p>AGENDE SEU HORÁRIO ON-LINE</p>

            <!-- Botão para abrir o modal -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agendamentoModal">Faça seu agendamento</button>
        <br>
        <a href="barbeiro.php" target="_blank" class="btn btn-secondary">Área do Barbeiro</a>
        </section>

  <!-- Modal do formulário de agendamento -->
  <div class="modal fade" id="agendamentoModal" tabindex="-1" aria-labelledby="agendamentoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agendamentoModalLabel">Agendamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php" method="post">
                <div class="modal-body">
                    <!-- Contato -->
                    <h6>Contato:</h6>
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" name="nome" id="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone:</label>
                        <input type="tel" class="form-control" name="telefone" id="telefone" required>
                    </div>

                    <!-- Serviços -->
                    <h6>Serviços:</h6>
                    <select name="servico" class="form-select" required>
                        <option value="Escolha o servico">Escolha o Serviço</option>
                        <option value="Corte infantil">Corte infantil (1-5 Anos) - 30R$</option>
                        <option value="Corte">Corte - 30R$</option>
                        <option value="Barba">Barba - 15R$</option>
                        <option value="Corte e Barba">Corte + Barba - 45R$</option>
                    </select>

                    <!-- Calendário -->
                    <div class="mb-3 mt-3">
                        <label for="data" class="form-label">Data:</label>
                        <input type="date" class="form-control" name="data" id="data" required>
                    </div>

                    <!-- Horários -->
                    <h6>Horários:</h6>
                    <select name="horario" class="form-select" required>
                        <option value="Escolha um Horario">Escolha um Horário</option>
                        <option value="08:00">08:00</option>
                        <option value="10:00">10:00</option>
                        <option value="10:40">10:40</option>
                        <option value="13:00">13:00</option>
                        <option value="14:30">14:30</option>
                        <option value="16:45">16:45</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Agendar</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
