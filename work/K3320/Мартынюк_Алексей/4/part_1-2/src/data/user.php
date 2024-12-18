<?php

class User {
    public int $id;
    public string $email;
    public string $password_hash;
    public string $first_name;
    public string $last_name;
    public DateTime $created_at;
    public DateTime $updated_at;
}

class Address {
    public int $id;
    public int $user_id;
    public string $address;
    public string $postcode;
    public DateTime $created_at;
    public DateTime $updated_at;
}

class UserRepository {
    private PDO $connection;

    public function __construct(PDO $connection) {
        $this->connection = $connection;
    }

    public function insert(User $user): bool {
        $stmt = $this->connection->prepare("
            INSERT INTO users (email, password_hash, first_name, last_name) 
                 VALUES (:email, :password_hash, :first_name, :last_name)
        ");

        return $stmt->execute([
            ':email' => $user->email,
            ':password_hash' => $user->password_hash,
            ':first_name' => $user->first_name,
            ':last_name' => $user->last_name
        ]);
    }

    public function getById(int $id): ?User {
        $stmt = $this->connection->prepare("
            SELECT *
              FROM users
             WHERE id = :id
        ");
    
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        $row = $stmt->fetchObject();
    
        if ($row) {
            $user = new User();
            $user->id = $row->id;
            $user->email = $row->email;
            $user->password_hash = $row->password_hash;
            $user->first_name = $row->first_name;
            $user->last_name = $row->last_name;
            $user->created_at = new DateTime($row->created_at);
            $user->updated_at = new DateTime($row->updated_at);

            return $user;
        }
    
        return null;
    }

    public function getByEmail(string $email): ?User {
        $stmt = $this->connection->prepare("
            SELECT *
              FROM users
             WHERE email = :email
        ");
    
        $stmt->execute([':email' => $email]);
    
        $row = $stmt->fetchObject();
    
        if ($row) {
            $user = new User();
            $user->id = $row->id;
            $user->email = $row->email;
            $user->password_hash = $row->password_hash;
            $user->first_name = $row->first_name;
            $user->last_name = $row->last_name;
            $user->created_at = new DateTime($row->created_at);
            $user->updated_at = new DateTime($row->updated_at);

            return $user;
        }
    
        return null;
    }

    public function getAdressesById(int $id): array {
        $stmt = $this->connection->prepare("
            SELECT *
              FROM user_addresses
             WHERE user_id = :user_id
        "); 

        $stmt->bindValue(':user_id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $rawResult = $stmt->fetchAll();

        $result = [];
        foreach ($rawResult as $row) {
            $address = new Address();
            $address->id = $row['id'];
            $address->user_id = $row['user_id'];
            $address->address = $row['address'];
            $address->postcode = $row['postcode'];
            $address->created_at = new DateTime($row['created_at']);
            $address->updated_at = new DateTime($row['updated_at']);

            $result[] = $address;
        }
        
        return $result;
    }
}