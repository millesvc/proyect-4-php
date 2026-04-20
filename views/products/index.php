<section class="hero-panel">
    <div>
        <p class="eyebrow">Dashboard</p>
        <h1>Gestión de productos</h1>
        <p class="muted">Administra inventario, precios y stock desde un panel interno limpio, seguro y profesional.</p>
    </div>
    <a href="<?= BASE_URL ?>/?route=products/create" class="btn btn-primary">Nuevo producto</a>
</section>

<section class="card search-card">
    <form method="GET" class="search-form">
        <input type="hidden" name="route" value="products">
        <input type="text" name="search" placeholder="Buscar por nombre..." value="<?= e($search); ?>">
        <button type="submit" class="btn btn-secondary">Buscar</button>
        <a href="<?= BASE_URL ?>/?route=products" class="btn btn-ghost">Limpiar</a>
    </form>
</section>

<section class="card table-card">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($products)): ?>
                <tr>
                    <td colspan="6" class="empty-state">No se encontraron productos.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td>#<?= e((string)$product['id']); ?></td>
                        <td><?= e($product['name']); ?></td>
                        <td>$<?= e(number_format((float)$product['price'], 2, ',', '.')); ?></td>
                        <td><?= e((string)$product['stock']); ?></td>
                        <td><?= e(date('d/m/Y H:i', strtotime($product['created_at']))); ?></td>
                        <td>
                            <div class="actions">
                                <a class="btn btn-small btn-ghost" href="<?= BASE_URL ?>/?route=products/show&id=<?= e((string)$product['id']); ?>">Ver</a>
                                <a class="btn btn-small btn-secondary" href="<?= BASE_URL ?>/?route=products/edit&id=<?= e((string)$product['id']); ?>">Editar</a>
                                <form action="<?= BASE_URL ?>/?route=products/delete" method="POST" data-confirm="¿Deseas eliminar este producto? Esta acción no se puede deshacer.">
                                    <input type="hidden" name="_token" value="<?= e($csrf); ?>">
                                    <input type="hidden" name="id" value="<?= e((string)$product['id']); ?>">
                                    <button type="submit" class="btn btn-small btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
