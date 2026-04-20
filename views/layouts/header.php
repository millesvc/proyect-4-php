<?php
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$user = $_SESSION['user'] ?? null;
function e(string $value): string { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($title ?? 'Sistema Administrativo'); ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/app.css">
</head>
<body>
<div class="app-shell">
    <nav class="navbar">
        <div>
            <span class="brand">Enterprise Product Admin</span>
            <span class="brand-sub">Panel interno de gestión</span>
        </div>

        <?php if ($user): ?>
            <div class="nav-actions">
                <span class="user-chip"><?= e($user['name']); ?></span>
                <form action="<?= BASE_URL ?>/?route=logout" method="POST">
                    <input type="hidden" name="_token" value="<?= e($_SESSION['csrf_token'] ?? ''); ?>">
                    <button type="submit" class="btn btn-outline">Cerrar sesión</button>
                </form>
            </div>
        <?php endif; ?>
    </nav>

    <main class="container">
        <?php if ($flash): ?>
            <div class="flash flash-<?= e($flash['type']); ?>">
                <?= e($flash['message']); ?>
            </div>
        <?php endif; ?>
