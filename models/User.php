<?php
class User {
    private $conn;
    private $table = "users";

    public $id;
    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function findByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create() {
        $stmt = $this->conn->prepare("INSERT INTO $this->table (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $this->email, $this->password);
        return $stmt->execute();
    }
}
