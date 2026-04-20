<?php

declare(strict_types=1);

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Product.php';

class ProductController extends Controller
{
    private Product $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

    public function index(): void
    {
        $search = trim((string)($_GET['search'] ?? ''));
        $products = $this->productModel->getAll($search);

        $this->view('products/index', [
            'title' => 'Gestión de productos',
            'products' => $products,
            'search' => $search,
            'csrf' => $this->csrfToken(),
        ]);
    }

    public function show(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $product = $this->productModel->find($id);

        if (!$product) {
            $this->setFlash('error', 'Producto no encontrado.');
            $this->redirect('/?route=products');
        }

        $this->view('products/show', [
            'title' => 'Detalle del producto',
            'product' => $product,
            'csrf' => $this->csrfToken(),
        ]);
    }

    public function create(): void
    {
        $this->view('products/create', [
            'title' => 'Crear producto',
            'csrf' => $this->csrfToken(),
            'errors' => $_SESSION['errors'] ?? [],
        ]);
        unset($_SESSION['errors']);
    }

    public function store(): void
    {
        $this->validateCsrf();
        $data = $this->sanitizeProductInput();
        $errors = $this->validateProduct($data);

        if ($errors !== []) {
            $_SESSION['errors'] = $errors;
            $this->withOldInput($data);
            $this->setFlash('error', 'Corrige los errores del formulario.');
            $this->redirect('/?route=products/create');
        }

        $this->productModel->create($data);
        $this->clearOldInput();
        $this->setFlash('success', 'Producto creado correctamente.');
        $this->redirect('/?route=products');
    }

    public function edit(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $product = $this->productModel->find($id);

        if (!$product) {
            $this->setFlash('error', 'Producto no encontrado.');
            $this->redirect('/?route=products');
        }

        $this->view('products/edit', [
            'title' => 'Editar producto',
            'product' => $product,
            'csrf' => $this->csrfToken(),
            'errors' => $_SESSION['errors'] ?? [],
        ]);
        unset($_SESSION['errors']);
    }

    public function update(): void
    {
        $this->validateCsrf();
        $id = (int)($_POST['id'] ?? 0);
        $product = $this->productModel->find($id);

        if (!$product) {
            $this->setFlash('error', 'Producto no encontrado.');
            $this->redirect('/?route=products');
        }

        $data = $this->sanitizeProductInput();
        $errors = $this->validateProduct($data);

        if ($errors !== []) {
            $_SESSION['errors'] = $errors;
            $this->withOldInput($data);
            $this->setFlash('error', 'Corrige los errores del formulario.');
            $this->redirect('/?route=products/edit&id=' . $id);
        }

        $this->productModel->update($id, $data);
        $this->clearOldInput();
        $this->setFlash('success', 'Producto actualizado correctamente.');
        $this->redirect('/?route=products');
    }

    public function destroy(): void
    {
        $this->validateCsrf();
        $id = (int)($_POST['id'] ?? 0);
        $product = $this->productModel->find($id);

        if (!$product) {
            $this->setFlash('error', 'Producto no encontrado.');
            $this->redirect('/?route=products');
        }

        $this->productModel->delete($id);
        $this->setFlash('success', 'Producto eliminado correctamente.');
        $this->redirect('/?route=products');
    }

    private function sanitizeProductInput(): array
    {
        return [
            'name' => trim((string)filter_input(INPUT_POST, 'name', FILTER_UNSAFE_RAW)),
            'description' => trim((string)filter_input(INPUT_POST, 'description', FILTER_UNSAFE_RAW)),
            'price' => trim((string)filter_input(INPUT_POST, 'price', FILTER_UNSAFE_RAW)),
            'stock' => trim((string)filter_input(INPUT_POST, 'stock', FILTER_UNSAFE_RAW)),
        ];
    }

    private function validateProduct(array $data): array
    {
        $errors = [];

        if ($data['name'] === '' || mb_strlen($data['name']) > 150) {
            $errors['name'] = 'El nombre es obligatorio y debe tener máximo 150 caracteres.';
        }

        if ($data['description'] !== '' && mb_strlen($data['description']) > 5000) {
            $errors['description'] = 'La descripción es demasiado extensa.';
        }

        if (!is_numeric($data['price']) || (float)$data['price'] < 0) {
            $errors['price'] = 'El precio debe ser un número válido mayor o igual a 0.';
        }

        if (filter_var($data['stock'], FILTER_VALIDATE_INT) === false || (int)$data['stock'] < 0) {
            $errors['stock'] = 'El stock debe ser un número entero válido mayor o igual a 0.';
        }

        return $errors;
    }
}
