<?php

require __DIR__ . '/../dto/UserDTO.php';
require __DIR__ . '/../util/PdoManager.php';

class UserRepository {
    private $pdo;

    public function __construct() {
        $this->pdo = PdoManager::getPdo();
    }

    /**
     * ユーザーを新しく登録する
     * @param mixed $userId ユーザーID
     * @param mixed $name ユーザー名
     * @param mixed $email メールアドレス
     * @param mixed $password パスワードの平文
     * @return void
     */
    public function insert($userId,$name,$email,$password) {
        // SQLの準備
        $sql = 'INSERT INTO users (id,name,email,password_hash) VALUES (?,?,?,?)';

        // パスワードのハッシュ化
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // SQLの実行
        $stmt = $this->pdo->prepare($sql);
        $stmt->bind_param('isss', $userId,$name,$email,$hashed_password);
        $stmt->execute();
    }

    public function findById($userid) {
        $query = 'SELECT * FROM users WHERE id = ?';
        $stmt = $this->pdo->prepare($query);
        $stmt->bind_param('i', $userid);
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
        $stmt = $this->pdo->prepare($query);
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
        $stmt = $this->pdo->prepare($query);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param('sssi', $name,$email,$hashed_password,$userId);
        $stmt->execute();

        return $stmt->affected_rows;
    }

    public function updateByEmail($email,$name,$password) {
        $query = 'UPDATE users SET name = ?, password_hash = ? WHERE email = ?';
        $stmt = $this->pdo->prepare($query);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param('sss', $name,$hashed_password,$email);
        $stmt->execute();

        return $stmt->affected_rows;
    }
}



?>
