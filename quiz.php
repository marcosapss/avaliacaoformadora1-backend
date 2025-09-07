<?php
session_start();
include 'perguntas.php';

if (!isset($_SESSION['indice']))  $_SESSION['indice']  = 0;
if (!isset($_SESSION['acertos'])) $_SESSION['acertos'] = 0;

// Iniciar
if (isset($_GET['action']) && $_GET['action'] === 'start') {
    $_SESSION['indice']  = 1;
    $_SESSION['acertos'] = 0;
    unset($_SESSION['feedback']); // limpa feedback ao iniciar
    header('Location: index.php'); exit;
}

// Resetar
if (isset($_GET['action']) && $_GET['action'] === 'reset') {
    session_destroy();
    header('Location: index.php'); exit;
}

// Responder
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $i = $_SESSION['indice'] - 1;

    // Segurança
    if ($i < 0 || $i >= count($perguntas)) {
        header('Location: index.php'); exit;
    }

    $opcao    = $_POST['opcao'] ?? '';
    $gabarito = $perguntas[$i]['gabarito'];

    if ($opcao === $gabarito) {
        $_SESSION['acertos']++;
        $_SESSION['feedback'] = 'acertou';
    } else {
        $_SESSION['feedback'] = 'errou';
    }

    $_SESSION['indice']++; // avança
    header('Location: index.php'); exit;
}

// fallback
header('Location: index.php'); exit;
