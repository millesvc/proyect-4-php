<section class="detail-grid">
    <article class="card detail-card">
        <div class="panel-heading">
            <p class="eyebrow">Ficha del producto</p>
            <h1><?= e($product['name']); ?></h1>
            <p class="muted">Información completa del registro dentro del sistema administrativo.</p>
        </div>

        <div class="detail-list">
            <div><span>ID</span><strong>#<?= e((string)$product['id']); ?></strong></div>
            <div><span>Precio</span><strong>$<?= e(number_format((float)$product['price'], 2, ',', '.')); ?></strong></div>
            <div><span>Stock</span><strong><?= e((string)$product['stock']); ?> unidades</strong></div>
            <div><span>Fecha de creación</span><strong><?= e(date('d/m/Y H:i', strtotime($product['created_at']))); ?></strong></div>
        </div>

        <div class="description-box">
            <h3>Descripción</h3>
            <p><?= nl2br(e($product['description'] ?: 'Sin descripción registrada.')); ?></p>
        </div>

        <div class="form-actions">
            <a href="<?= BASE_URL ?>/?route=products" class="btn btn-ghost">Volver</a>
            <a href="<?= BASE_URL ?>/?route=products/edit&id=<?= e((string)$product['id']); ?>" class="btn btn-primary">Editar producto</a>
        </div>
    </article>
</section>
