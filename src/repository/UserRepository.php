<?php

require __DIR__ . '/../dto/UserDTO.php';
require __DIR__ . '/../util/PdoManager.php';

class UserRepository {
    private static $pdo = PdoManager::getPdo();
    private static $TABLE_NAME = 'users';
    private static $ID_COLUMN = 'id';
    private static $NAME_COLUMN = 'name';
    private static $EMAIL_COLUMN = 'email';
    private static $PASSWORD_HASH_COLUMN = 'password_hash';
    private static $REGISTERED_AT_COLUMN = 'registered_at';

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
        $sql = "INSERT INTO " . self::$TABLE_NAME . " (" . self::$ID_COLUMN . "," . self::$NAME_COLUMN . "," . self::$EMAIL_COLUMN . "," . self::$PASSWORD_HASH_COLUMN . ") VALUES (:id, :name, :email, :password_hash)";

        // パスワードのハッシュ化
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // SQLの実行
        $stmt = self::$pdo->prepare($sql);
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
        $sql = "SELECT * FROM " . self::$TABLE_NAME . " WHERE " . self::$ID_COLUMN . " = :id";

        // SQLの実行
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $user = $this->rowToDto($result);
        return $user;
    }

    /**
     * emailをもとにユーザー検索を行う
     * @param string $email
     * @return UserDTO|null
     */
    public function findByEmail($email) {
        // SQLの準備
        $sql = "SELECT * FROM " . self::$TABLE_NAME . " WHERE " . self::$EMAIL_COLUMN . " = :email";

        // SQLの実行
        $stmt = self::$pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $user = $this->rowToDto($result);
        return $user;
    }


    /**
     * Dtoに登録されたIDに一致するユーザー情報を更新する
     * @param UserDto $dto
     * @return void
     */
    public function updateById($dto) {
        // SQLの準備
        $sql = "UPDATE " . self::$TABLE_NAME . " SET " . self::$NAME_COLUMN . " = :name, " . self::$EMAIL_COLUMN . " = :email, " . self::$PASSWORD_HASH_COLUMN . " = :password_hash WHERE " . self::$ID_COLUMN . " = :id";

        // SQLの実行
        $stmt = self::$pdo->prepare($sql);
        $name = $dto->getName();
        $email = $dto->getEmail();
        $password_hash = $dto->getPasswordHash();
        $id = $dto->getId();
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password_hash', $password_hash, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * Dtoに登録されたメールアドレスに一致するユーザー情報を更新する
     * @param UserDTO $dto
     * @return void
     */
    public function updateByEmail($dto) {
        // SQLの準備
        $sql = "UPDATE " . self::$TABLE_NAME . " SET " . self::$NAME_COLUMN . " = :name, " . self::$PASSWORD_HASH_COLUMN . " = :password_hash WHERE " . self::$EMAIL_COLUMN . " = :email";

        // SQLの実行
        $stmt = self::$pdo->prepare($sql);
        $name = $dto->getName();
        $email = $dto->getEmail();
        $password_hash = $dto->getPasswordHash();
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password_hash', $password_hash, PDO::PARAM_STR);
        $stmt->execute();
    }


    /**
     * DBアクセスの結果をDtoに変換する
     * @param array $row
     * @return UserDTO
     */
    private function rowToDto($row) {
        $user = new UserDTO($row[self::$ID_COLUMN], $row[self::$EMAIL_COLUMN], $row[self::$PASSWORD_HASH_COLUMN], $row[self::$NAME_COLUMN], $row[self::$REGISTERED_AT_COLUMN]);
        return $user;
    }
}
