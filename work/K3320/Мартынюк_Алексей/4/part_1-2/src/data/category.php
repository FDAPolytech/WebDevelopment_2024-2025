<?php 

class Category {
    public int $id;
    public string $name;
    public string $description;
    public DateTime $created_at;
    public DateTime $updated_at;
}

class CategoryRepository {
    private PDO $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function getAll () {
        $stmt = $this->connection->prepare("
            SELECT *
              FROM categories
        ");

        $stmt->execute();

        $rawResult = $stmt->fetchAll();

        $result = [];
        foreach ($rawResult as $row) {
            $category = new Category();
            $category->id = $row['id'];
            $category->name = $row['name'];
            $category->description = $row['description'];
            $category->created_at = new DateTime($row['created_at']);
            $category->updated_at = new DateTime($row['updated_at']);

            $result[] = $category;
        }

        return $result;
    }
}