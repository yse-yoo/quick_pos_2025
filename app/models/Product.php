<?php
class Product
{
    public int $id;
    public string $code;
    public string $name;
    public int $price;
    public string $created_at;
    public string $updated_at;
}

class ProductRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance();
    }

    public function findByCode($code)
    {
        $sql = "SELECT * FROM products WHERE code = :code";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['code' => $code]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

class ProductService
{
    private $productRepository;

    public function __construct()
    {
        $this->productRepository = new ProductRepository();
    }

    public function findByCode($code)
    {
        return $this->productRepository->findByCode($code);
    }
}