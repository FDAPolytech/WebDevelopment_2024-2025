<?php

class Product {
    public int $id;
    public string $name;
    public float $price;
    public int $stock;
    public ?string $image_url;
    public DateTime $created_at;
    public DateTime $updated_at;
}

class ProductRepository {
    private PDO $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function getById(int $id): ?Product {
        $query = $this->connection->prepare("
            SELECT *
              FROM products
             WHERE id = :id
        ");

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $rawResult = $query->fetch();

        if (!$rawResult) {
            return null;
        }

        $product = new Product();
        $product->id = $rawResult['id'];
        $product->name = $rawResult['name'];
        $product->price = $rawResult['price'];
        $product->stock = $rawResult['stock'];
        $product->image_url = $rawResult['image_url'];
        $product->created_at = new DateTime($rawResult['created_at']);
        $product->updated_at = new DateTime($rawResult['updated_at']);

        return $product;
    }

    public function getAll(int $offset, int $limit): array {
        $stmt = $this->connection->prepare("
            SELECT *
              FROM products
             LIMIT :offset, :limit
        ");

        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit,   PDO::PARAM_INT);

        $stmt->execute();

        $rawResult = $stmt->fetchAll();

        $result = [];
        foreach ($rawResult as $row) {
            $product = new Product();
            $product->id = $row['id'];
            $product->name = $row['name'];
            $product->price = $row['price'];
            $product->stock = $row['stock'];
            $product->image_url = $row['image_url'];
            $product->created_at = new DateTime($row['created_at']);
            $product->updated_at = new DateTime($row['updated_at']);

            $result[] = $product;
        }

        return $result;
    }

    public function getByCategoryId(int $id, int $offset, int $limit): array {
        $stmt = $this->connection->prepare("
            SELECT p.*
              FROM categories c
                   INNER JOIN product_category pc ON c.id = pc.category_id
                   INNER JOIN products p ON pc.product_id = p.id
             WHERE pc.category_id = :category_id
             LIMIT :offset, :limit
        ");

        $stmt->bindValue(':category_id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit,   PDO::PARAM_INT);

        $stmt->execute();

        $rawResult = $stmt->fetchAll();

        $result = [];
        foreach ($rawResult as $row) {
            $product = new Product();
            $product->id = $row['id'];
            $product->name = $row['name'];
            $product->price = $row['price'];
            $product->stock = $row['stock'];
            $product->image_url = $row['image_url'];
            $product->created_at = new DateTime($row['created_at']);
            $product->updated_at = new DateTime($row['updated_at']);

            $result[] = $product;
        }

        return $result;
    }

    public function getBySearch(string $search, int $offset, int $limit): array {
        $stmt = $this->connection->prepare("
            SELECT *
              FROM products
             WHERE MATCH(name) AGAINST(:search IN BOOLEAN MODE)
             LIMIT :offset, :limit
        ");

        $stmt->bindValue(':search', $search, PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();


        $rawResult = $stmt->fetchAll();

        $result = [];
        foreach ($rawResult as $row) {
            $product = new Product();
            $product->id = $row['id'];
            $product->name = $row['name'];
            $product->price = $row['price'];
            $product->stock = $row['stock'];
            $product->image_url = $row['image_url'];
            $product->created_at = new DateTime($row['created_at']);
            $product->updated_at = new DateTime($row['updated_at']);

            $result[] = $product;
        }

        return $result;
    }

    public function getBySearchWithCategoryId(string $search, int $category_id, int $offset, int $limit): array {
        $stmt = $this->connection->prepare("
            SELECT p.*
              FROM categories c
                   INNER JOIN product_category pc ON c.id = pc.category_id
                   INNER JOIN products p ON pc.product_id = p.id
             WHERE MATCH(p.name) AGAINST(:search IN BOOLEAN MODE)
               AND pc.category_id = :category_id
             LIMIT :offset, :limit
        ");

        $stmt->bindValue(':search', $search, PDO::PARAM_STR);
        $stmt->bindValue(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();


        $rawResult = $stmt->fetchAll();

        $result = [];
        foreach ($rawResult as $row) {
            $product = new Product();
            $product->id = $row['id'];
            $product->name = $row['name'];
            $product->price = $row['price'];
            $product->stock = $row['stock'];
            $product->image_url = $row['image_url'];
            $product->created_at = new DateTime($row['created_at']);
            $product->updated_at = new DateTime($row['updated_at']);

            $result[] = $product;
        }

        return $result;
    }

    public function getByOrderId(int $order_id): array {
        $stmt = $this->connection->prepare("
            SELECT p.*,
                   COUNT(oi.id) AS count,
                   oi.price_per_unit
              FROM orders o
                   INNER JOIN order_items oi ON o.id = oi.order_id
                   INNER JOIN products p ON oi.product_id = p.id
             WHERE o.id = :order_id
          GROUP BY p.id, oi.price_per_unit
        ");

        $stmt->bindValue(':order_id', $order_id, PDO::PARAM_INT);

        $stmt->execute();

        $result = $stmt->fetchAll();

        $products = [];
        foreach ($result as $row) {
            $product = new Product();
            $product->id = $row['id'];
            $product->name = $row['name'];
            $product->stock = $row['stock'];
            $product->image_url = $row['image_url'];
            $product->price = $row['price_per_unit'];
            $product->created_at = new DateTime($row['created_at']);
            $product->updated_at = new DateTime($row['updated_at']);

            $products[$row['count']] = $product;
        }

        return $products;
    }
}
