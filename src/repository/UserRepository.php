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
     * @param string $userId ユーザーID
     * @param string $name ユーザー名
     * @param string $email メールアドレス
     * @param string $password パスワードの平文
     * @return void
     */
    public function insert($userId,$name,$email,$password) {
        // SQLの準備
        $sql = 'INSERT INTO users (id,name,email,password_hash) VALUES (:id, :name, :email, :password_hash)';

        // パスワードのハッシュ化
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // SQLの実行
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $userId, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password_hash', $hashed_password, PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * IDをもとにユーザー検索を行う
     * @param string $id
     * @return UserDTO|null
     */
    public function findById($id) {
        // SQLの準備
        $sql = 'SELECT * FROM users WHERE id = :id';

        // SQLの実行
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $user = $this->toDto($result);
        return $user;
    }

    /**
     * emailをもとにユーザー検索を行う
     * @param string $email
     * @return UserDTO|null
     */
    public function findByEmail($email) {
        $query = 'SELECT * FROM users WHERE mail = :email';
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $user = $this->toDto($result);
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


    private function toDto($result) {
        $row = $result->fetch_assoc();
        $user = new UserDTO($row['id']);
        $user->setName($row['name']);
        $user->setEmail($row['email']);
        $user->setPasswordHash($row['password_hash']);

        return $user;
    }
}



?>
