<?php

require_once(__DIR__ . '/../config/Database.php');
require_once(__DIR__ . '/../models/User.php');

class UserRepository {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAllUsers() {
        $query = 'SELECT * FROM users';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $users = array();
        while ($row = $result->fetch_assoc()) {
            $user = new User($row['id'], $row['name'], $row['email']);
            array_push($users, $user);
        }

        return $users;
    }

    public function getUserById($id) {
        $query = 'SELECT * FROM users WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return null;
        }

        $row = $result->fetch_assoc();
        $user = new User($row['id'], $row['name'], $row['email']);

        return $user;
    }

    public function createUser($name, $email) {
        $query = 'INSERT INTO users (name, email) VALUES (?, ?)';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ss', $name, $email);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function updateUser($id, $name, $email) {
        $query = 'UPDATE users SET name = ?, email = ? WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ssi', $name, $email, $id);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function deleteUser($id) {
        $query = 'DELETE FROM users WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }
}

?>
