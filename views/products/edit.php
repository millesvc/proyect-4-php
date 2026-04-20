<section class="card form-card">
    <div class="panel-heading">
        <p class="eyebrow">Actualización</p>
        <h1>Editar producto</h1>
        <p class="muted">Modifica la información del producto manteniendo consistencia y control del inventario.</p>
    </div>

    <form method="POST" action="<?= BASE_URL ?>/?route=products/update" class="form-grid">
        <input type="hidden" name="_token" value="<?= e($csrf); ?>">
        <input type="hidden" name="id" value="<?= e((string)$product['id']); ?>">
        <?php require __DIR__ . '/partials/form.php'; ?>
        <div class="form-actions">
            <a href="<?= BASE_URL ?>/?route=products" class="btn btn-ghost">Volver</a>
            <button type="submit" class="btn btn-primary">Actualizar producto</button>
        </div>
    </form>
</section>
