<?php

require_once __DIR__ . '/../dto/UserDTO.php';
require_once __DIR__ . '/../util/PdoManager.php';

class UserRepository {
    private $pdo;

    const TABLE_NAME = 'users';
    const ID_COLUMN = 'id';
    const EMAIL_COLUMN = 'email';
    const PASSWORD_HASH_COLUMN = 'password_hash';
    const NAME_COLUMN = 'name';
    const REGISTERED_AT_COLUMN = 'registered_at';
    const IS_PUBLIC_COLUMN = 'is_public';
    const DESCRIPTION_COLUMN = 'description';

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
        $sql = sprintf(
            "INSERT INTO %s (%s, %s, %s, %s) VALUES (:id, :name, :email, :password_hash)",
            self::TABLE_NAME,
            self::ID_COLUMN,
            self::NAME_COLUMN,
            self::EMAIL_COLUMN,
            self::PASSWORD_HASH_COLUMN
        );

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
        $sql = sprintf(
            "SELECT * FROM %s WHERE %s = :id",
            self::TABLE_NAME,
            self::ID_COLUMN
        );

        // SQLの実行
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {
            return null;
        }
        
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
        $sql = sprintf(
            "SELECT * FROM %s WHERE %s = :email",
            self::TABLE_NAME,
            self::EMAIL_COLUMN
        );

        // SQLの実行
        $stmt = $this->pdo->prepare($sql);
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
        $sql = sprintf(
            "UPDATE %s SET %s = :name, %s = :email, %s = :password_hash WHERE %s = :id",
            self::TABLE_NAME,
            self::NAME_COLUMN,
            self::EMAIL_COLUMN,
            self::PASSWORD_HASH_COLUMN,
            self::ID_COLUMN
        );

        // SQLの実行
        $stmt = $this->pdo->prepare($sql);
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
        $sql = sprintf(
            "UPDATE %s SET %s = :name, %s = :password_hash WHERE %s = :email",
            self::TABLE_NAME,
            self::NAME_COLUMN,
            self::PASSWORD_HASH_COLUMN,
            self::EMAIL_COLUMN
        );

        // SQLの実行
        $stmt = $this->pdo->prepare($sql);
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
        if (empty($row)) {
            throw new Exception('$row is empty.');
        }

        $user = new UserDTO($row[self::ID_COLUMN], $row[self::EMAIL_COLUMN], $row[self::PASSWORD_HASH_COLUMN], $row[self::NAME_COLUMN], $row[self::REGISTERED_AT_COLUMN]);
        return $user;
    }
}
