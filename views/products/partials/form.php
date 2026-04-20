<div class="form-group full-width">
    <label for="name">Nombre</label>
    <input id="name" name="name" type="text" maxlength="150" value="<?= $this->old('name', $product['name'] ?? ''); ?>" required>
    <?php if (!empty($errors['name'])): ?><small class="error-text"><?= e($errors['name']); ?></small><?php endif; ?>
</div>

<div class="form-group full-width">
    <label for="description">Descripción</label>
    <textarea id="description" name="description" rows="5" placeholder="Describe el producto, uso, categoría o características."><?= $this->old('description', $product['description'] ?? ''); ?></textarea>
    <?php if (!empty($errors['description'])): ?><small class="error-text"><?= e($errors['description']); ?></small><?php endif; ?>
</div>

<div class="form-group">
    <label for="price">Precio</label>
    <input id="price" name="price" type="number" step="0.01" min="0" value="<?= $this->old('price', isset($product['price']) ? (string)$product['price'] : ''); ?>" required>
    <?php if (!empty($errors['price'])): ?><small class="error-text"><?= e($errors['price']); ?></small><?php endif; ?>
</div>

<div class="form-group">
    <label for="stock">Stock</label>
    <input id="stock" name="stock" type="number" min="0" step="1" value="<?= $this->old('stock', isset($product['stock']) ? (string)$product['stock'] : ''); ?>" required>
    <?php if (!empty($errors['stock'])): ?><small class="error-text"><?= e($errors['stock']); ?></small><?php endif; ?>
</div>
