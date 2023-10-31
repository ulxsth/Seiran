<?php

require_once(__DIR__ . 'UserDTO.php');

class UserRepository {
    private $conn;

    public function insert($userId,$name,$email,$password) {
        $query = 'INSERT INTO users (id,name,email,password_hash) VALUES (?,?,?,?)';
        $stmt = $this->conn->prepare($query);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param('ssss', $userId,$name,$email,$hashed_password);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function findById($userid) {
        $query = 'SELECT * FROM users WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $userid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return null;
        }

        $row = $result->fetch_assoc();
        $user = new UserDTO($row['id']);
        $user->setName($row['name']);
        $user->setEmail($row['email']);
        $user->setPasswordHash($row['password_hash']);

        return $user;
    }

    public function findByEmail($email) {
        $query = 'SELECT * FROM users WHERE mail = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return null;
        }

        $row = $result->fetch_assoc();
        $user = new UserDTO($row['id']);
        $user->setName($row['name']);
        $user->setEmail($row['email']);
        $user->setPasswordHash($row['password_hash']);

        return $user;
    }
    
    public function updateById($userId,$name,$email,$password) {
        $query = 'UPDATE users SET name = ?, email = ?, password_hash = ? WHERE id = ?';
        $stmt = $this->conn->prepare($query);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param('sssi', $name,$email,$hashed_password,$userId);
        $stmt->execute();

        return $stmt->affected_rows;
    }

    public function updateByEmail($email,$name,$password) {
        $query = 'UPDATE users SET name = ?, password_hash = ? WHERE email = ?';
        $stmt = $this->conn->prepare($query);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param('sss', $name,$hashed_password,$email);
        $stmt->execute();

        return $stmt->affected_rows;
    }
}
    


?>
