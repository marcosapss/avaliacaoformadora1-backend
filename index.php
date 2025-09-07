<?php
session_start();
include 'perguntas.php';

if (!isset($_SESSION['indice']))  $_SESSION['indice']  = 0;
if (!isset($_SESSION['acertos'])) $_SESSION['acertos'] = 0;

$total = count($perguntas);

// Verifica se tem feedback salvo na sessão
$classeFeedback = '';
if (isset($_SESSION['feedback'])) {
  if ($_SESSION['feedback'] === 'acertou') {
    $classeFeedback = 'feedback-acerto';
  } elseif ($_SESSION['feedback'] === 'errou') {
    $classeFeedback = 'feedback-erro';
  }
  unset($_SESSION['feedback']); // limpa após exibir
}
?>
<!doctype html>
<html lang="pt-BR" data-bs-theme="dark">
<head>
  <meta charset="UTF-8">
  <title>Quiz</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body class="bg-grid">

<main class="container my-5">
  <div class="row justify-content-center">
    <div class="col-12 col-lg-8">
      <div class="card neo-card border-0 overflow-hidden <?php echo $classeFeedback; ?>">
        <div class="card-body p-4 p-md-5">

          <header class="mb-4 text-center">
            <h1 class="display-6 fw-bold text-gradient">Quiz - Avaliação Formadora 1</h1>
            <p class="text-secondary mb-0">Perguntas focadas em: HTML • CSS • JS • PHP</p>
          </header>

          <!-- Barra de progresso (quando o quiz já começou) -->
          <?php if ($_SESSION['indice'] > 0 && $_SESSION['indice'] <= $total): ?>
            <div class="mb-4">
              <?php
                $atual = $_SESSION['indice'];
                $percent = (int) floor(($atual-1) / max(1,$total) * 100);
              ?>
              <div class="progress neo-progress" role="progressbar" aria-valuenow="<?php echo $percent; ?>" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: <?php echo $percent; ?>%"></div>
              </div>
              <small class="text-secondary d-block mt-2 text-center">
                Pergunta <span class="text-neon"><?php echo $atual; ?></span> de <?php echo $total; ?>
              </small>
            </div>
          <?php endif; ?>

          <!-- TELA INICIAL -->
          <?php if ($_SESSION['indice'] == 0): ?>
            <section class="text-center py-4">
              <form action="Quiz.php" method="get" class="d-inline">
                <button type="submit" name="action" value="start" class="btn btn-neon btn-lg px-4">
                  <i class="bi bi-play-fill me-1"></i> Começar
                </button>
              </form>
            </section>
          <?php endif; ?>

          <!-- TELA DE PERGUNTA -->
          <?php if ($_SESSION['indice'] > 0 && $_SESSION['indice'] <= $total): ?>
            <?php $i = $_SESSION['indice'] - 1; $q = $perguntas[$i]; ?>
            <section>
              <h2 class="h4 mb-4">
                <span class="text-secondary me-2">Questão <?php echo $i+1; ?>)</span>
                <?php echo htmlspecialchars($q['enunciado']); ?>
              </h2>

              <!-- Form principal: RESPONDER -->
              <form id="form-quiz" action="Quiz.php" method="post" class="d-grid gap-3">
                <?php foreach ($q['respostas'] as $letra => $texto): ?>
                  <label class="neo-option v1 p-3">
                    <input type="radio" name="opcao" value="<?php echo $letra; ?>" required>
                    <span>
                      <strong class="me-2 text-neon"><?php echo $letra; ?>)</strong>
                      <?php echo htmlspecialchars($texto); ?>
                    </span>
                  </label>
                <?php endforeach; ?>
              </form>

              <!-- Linha de ações (lado a lado, sem forms aninhados) -->
              <div class="d-flex justify-content-between align-items-center gap-2 mt-3">
                <!-- RECOMEÇAR: form separado (GET) -->
                <form action="Quiz.php" method="get" class="m-0">
                  <button type="submit" name="action" value="reset" class="btn btn-outline-danger">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Recomeçar
                  </button>
                </form>

                <!-- RESPONDER: botão que envia o form de cima -->
                <button type="submit" form="form-quiz" class="btn btn-outline-light">
                  Responder <i class="bi bi-arrow-right-short ms-1"></i>
                </button>
              </div>
            </section>
          <?php endif; ?>

          <!-- TELA FINAL -->
          <?php if ($_SESSION['indice'] > $total): ?>
            <section class="text-center py-4">
              <h2 class="mb-3">Fim do Quiz!</h2>
              <p class="lead">
                Pontuação:
                <span class="badge bg-neon fs-6 ms-1"><?php echo $_SESSION['acertos']; ?></span>
                <span class="text-secondary">/ <?php echo $total; ?></span>
              </p>

              <div class="ratio ratio-21x9 mb-4 neo-scanlines rounded-4">
                <div class="w-100 h-100 d-flex align-items-center justify-content-center text-secondary-50">
                  <i class="bi bi-joystick display-4 text-neon"></i>
                </div>
              </div>

              <form action="Quiz.php" method="get" class="d-inline">
                <button type="submit" name="action" value="reset" class="btn btn-neon">
                  <i class="bi bi-arrow-counterclockwise me-1"></i> Recomeçar
                </button>
              </form>
            </section>
          <?php endif; ?>

        </div>
        <!-- glows decorativos -->
        <span class="neo-glow neo-glow-1"></span>
        <span class="neo-glow neo-glow-2"></span>
      </div>
    </div>
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
