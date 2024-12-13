<?php 

require_once __DIR__ . '/product.php';

class OrderStatus {
    const IN_PROGRESS = 'progress';
    const COMPLETED = 'completed';
    const CANCELED = 'canceled';
}

class Order {
    public int $id;
    public int $user_id;
    public int $address_id;
    public string $status;
    public string $comment;
    public DateTime $created_at;
    public DateTime $updated_at;
}

class OrderItems {
    public int $id;
    public int $product_id;
    public int $amount;
    public int $price_per_unit;
    public DateTime $created_at;
    public DateTime $updated_at;
}

class OrderRepository {
    private PDO $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function insert(Order $order, array $items) {
        try {
            $this->connection->beginTransaction();

            $stmtOrder = $this->connection->prepare('
                INSERT INTO orders (user_id, address_id, status, comment)
                     VALUES (:user_id, :address_id, :status, :comment)
            ');
            $stmtOrder->bindValue(':user_id', $order->user_id, PDO::PARAM_INT);
            $stmtOrder->bindValue(':address_id', $order->address_id, PDO::PARAM_INT);
            $stmtOrder->bindValue(':status', $order->status, PDO::PARAM_STR);
            $stmtOrder->bindValue(':comment', $order->comment ?? '', PDO::PARAM_STR);
            $stmtOrder->execute();

            $orderId = $this->connection->lastInsertId();

            $stmtItems = $this->connection->prepare('
                INSERT INTO order_items (order_id, product_id, amount, price_per_unit)
                     VALUES (:order_id, :product_id, :amount, :price_per_unit)
            ');

            foreach ($items as $item) {
                $stmtItems->bindValue(':order_id', $orderId, PDO::PARAM_INT);
                $stmtItems->bindValue(':product_id', $item->product_id, PDO::PARAM_INT);
                $stmtItems->bindValue(':amount', $item->amount, PDO::PARAM_INT);
                $stmtItems->bindValue(':price_per_unit', $item->price_per_unit, PDO::PARAM_INT);
                $stmtItems->execute();
            }

            $this->connection->commit();
        } catch (Exception $e) {
            $this->connection->rollBack();
            throw $e;
        }
    }

    public function getByUserID(int $user_id): array {
        $stmt = $this->connection->prepare("
            SELECT *
              FROM orders
             WHERE user_id = :user_id
        ");

        $stmt->bindValue(':user_id', $user_id,   PDO::PARAM_INT);
        
        $stmt->execute();

        $rawResult = $stmt->fetchAll();

        $orders = [];
        foreach ($rawResult as $row) {
            $order = new Order();
            $order->id = $row['id'];
            $order->user_id = $row['user_id'];
            $order->status = $row['status'];
            $order->created_at = new DateTime($row['created_at']);
            $order->updated_at = new DateTime($row['updated_at']);

            $orders[] = $order;
        }

        return $orders;
    }

    public function getByUserIDWithStatus(int $user_id, string $status): array {
        $stmt = $this->connection->prepare("
            SELECT *
              FROM orders
             WHERE user_id = :user_id
               AND status = :status
        ");

        $stmt->bindValue(':user_id', $user_id,   PDO::PARAM_INT);
        $stmt->bindValue(':status',  $status,    PDO::PARAM_STR);
        
        $stmt->execute();

        $rawResult = $stmt->fetchAll();

        $orders = [];
        foreach ($rawResult as $row) {
            $order = new Order();
            $order->id = $row['id'];
            $order->user_id = $row['user_id'];
            $order->status = $row['status'];
            $order->created_at = new DateTime($row['created_at']);
            $order->updated_at = new DateTime($row['updated_at']);

            $orders[] = $order;
        }

        return $orders;
    }
}