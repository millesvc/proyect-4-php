<section class="card form-card">
    <div class="panel-heading">
        <p class="eyebrow">Nuevo registro</p>
        <h1>Crear producto</h1>
        <p class="muted">Completa los datos principales para registrar un producto empresarial.</p>
    </div>

    <form method="POST" action="<?= BASE_URL ?>/?route=products/store" class="form-grid">
        <input type="hidden" name="_token" value="<?= e($csrf); ?>">
        <?php require __DIR__ . '/partials/form.php'; ?>
        <div class="form-actions">
            <a href="<?= BASE_URL ?>/?route=products" class="btn btn-ghost">Volver</a>
            <button type="submit" class="btn btn-primary">Guardar producto</button>
        </div>
    </form>
</section>
