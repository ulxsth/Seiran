<?php

require_once __DIR__ . '/../dto/UserDTO.php';
require_once __DIR__ . '/../util/PdoManager.php';

class UserRepository
{
    private $pdo;

    const TABLE_NAME = 'users';
    const ID_COLUMN = 'id';
    const EMAIL_COLUMN = 'email';
    const PASSWORD_HASH_COLUMN = 'password_hash';
    const NAME_COLUMN = 'name';
    const REGISTERED_AT_COLUMN = 'registered_at';
    const IS_PUBLIC_COLUMN = 'is_public';
    const DESCRIPTION_COLUMN = 'description';
    const ICON_PATH_COLUMN = 'icon_path';

    public function __construct()
    {
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
    public function insert($userId, $name, $email, $password)
    {
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
     * @param bool $includePrivate 非公開のユーザーも含めるかどうか
     * @return UserDTO|null
     */
    public function findById($id, $includePrivate=false) {
        // SQLの準備
        $sql = sprintf(
            "SELECT * FROM %s WHERE %s = :id",
            self::TABLE_NAME,
            self::ID_COLUMN
        );

        if (!$includePrivate) {
            $sql .= sprintf(" AND %s = 1", self::IS_PUBLIC_COLUMN);
        }

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
     * @param bool $includePrivate 非公開のユーザーも含めるかどうか
     * @return UserDTO|null
     */
    public function findByEmail($email, $includePrivate=false)
    {
        // SQLの準備
        $sql = sprintf(
            "SELECT * FROM %s WHERE %s = :email",
            self::TABLE_NAME,
            self::EMAIL_COLUMN
        );

        if (!$includePrivate) {
            $sql .= sprintf(" AND %s = 1", self::IS_PUBLIC_COLUMN);
        }

        // SQLの実行
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {
            return null;
        }

        $user = $this->rowToDto($result);
        return $user;
    }

    /**
     * ユーザ一覧を取得する
     * @param bool $includePrivate 非公開のユーザーも含めるかどうか
     * @return UserDTO[]
     */
    public function fetchAll($includePrivate=false)
    {
        // SQLの準備
        $sql = sprintf(
            "SELECT * FROM %s",
            self::TABLE_NAME
        );

        if (!$includePrivate) {
            $sql .= sprintf(" WHERE %s = 1", self::IS_PUBLIC_COLUMN);
        }

        // SQLの実行
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($result)) {
            return [];
        }

        $users = [];
        foreach ($result as $row) {
            $user = $this->rowToDto($row);
            $users[] = $user;
        }
        return $users;
    }

    /**
     * ユーザー名をもとにあいまい検索を行う
     * @param string $name
     * @param bool $includePrivate 非公開のユーザーも含めるかどうか
     * @return UserDTO[]
     */
    public function FuzzyFetchByName($name, $includePrivate=false)
    {
        // SQLの準備
        $sql = sprintf(
            "SELECT * FROM %s WHERE %s LIKE :name",
            self::TABLE_NAME,
            self::NAME_COLUMN
        );

        if (!$includePrivate) {
            $sql .= sprintf(" AND %s = 1", self::IS_PUBLIC_COLUMN);
        }

        // SQLの実行
        $stmt = $this->pdo->prepare($sql);
        $name = '%' . $name . '%';
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if(empty($result)) {
            return [];
        }

        $users = [];
        foreach ($result as $row) {
            $user = $this->rowToDto($row);
            $users[] = $user;
        }
        return $users;
    }

    /**
     * Dtoに登録されたIDに一致するユーザー情報を更新する
     * @param UserDto $dto
     * @return void
     */
    public function update($dto)
    {
        // SQLの準備
        $sql = sprintf(
            "UPDATE %s SET ",
            self::TABLE_NAME
        );
        $columns = [
            self::NAME_COLUMN,
            self::EMAIL_COLUMN,
            self::PASSWORD_HASH_COLUMN,
            self::NAME_COLUMN,
            self::REGISTERED_AT_COLUMN,
            self::IS_PUBLIC_COLUMN,
            self::DESCRIPTION_COLUMN,
            self::ICON_PATH_COLUMN
        ];
        foreach ($columns as $column) {
            $sql .= sprintf("%s = :%s, ", $column, $column);
        }
        $sql = rtrim($sql, ', ');
        $sql .= sprintf(" WHERE %s = :id", self::ID_COLUMN);

        // SQLの実行
        $stmt = $this->pdo->prepare($sql);
        $id = $dto->getId();
        $name = $dto->getName();
        $email = $dto->getEmail();
        $passwordHash = $dto->getPasswordHash();
        $registeredAt = $dto->getRegisteredAt();
        $isPublic = $dto->getIsPublic();
        $description = $dto->getDescription();
        $iconPath = $dto->getIconPath();
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password_hash', $passwordHash, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':registered_at', $registeredAt, PDO::PARAM_STR);
        $stmt->bindParam(':is_public', $isPublic, PDO::PARAM_BOOL);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':icon_path', $iconPath, PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * DBアクセスの結果をDtoに変換する
     * @param array $row
     * @return UserDTO
     */
    private function rowToDto($row)
    {
        if (empty($row)) {
            throw new Exception('$row is empty.');
        }

        $user = new UserDTO($row[self::ID_COLUMN], $row[self::EMAIL_COLUMN], $row[self::PASSWORD_HASH_COLUMN], $row[self::NAME_COLUMN], $row[self::REGISTERED_AT_COLUMN]);
        $user->setIsPublic($row[self::IS_PUBLIC_COLUMN]);
        $user->setDescription($row[self::DESCRIPTION_COLUMN]);
        $user->setIconPath($row[self::ICON_PATH_COLUMN]);

        return $user;
    }
}
