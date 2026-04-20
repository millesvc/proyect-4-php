<?php

declare(strict_types=1);

require_once __DIR__ . '/../core/Model.php';

class Product extends Model
{
    public function getAll(?string $search = null): array
    {
        if ($search !== null && $search !== '') {
            $stmt = $this->db->prepare(
                'SELECT * FROM products WHERE name LIKE :search ORDER BY created_at DESC, id DESC'
            );
            $stmt->execute(['search' => '%' . $search . '%']);
            return $stmt->fetchAll();
        }

        $stmt = $this->db->query('SELECT * FROM products ORDER BY created_at DESC, id DESC');
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $product = $stmt->fetch();

        return $product ?: null;
    }

    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            'INSERT INTO products (name, description, price, stock) VALUES (:name, :description, :price, :stock)'
        );

        return $stmt->execute([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'stock' => $data['stock'],
        ]);
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE products SET name = :name, description = :description, price = :price, stock = :stock WHERE id = :id'
        );

        return $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'stock' => $data['stock'],
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM products WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
