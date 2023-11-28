<?php
require_once __DIR__ . '/../util/PdoManager.php';
require_once __DIR__ . '/../dto/BookDTO.php';

class BookRepository {
  private static $pdo;

  const TABLE_NAME = 'books';
  const ID_COLUMN = 'id';
  const THUMBNAIL_PATH_COLUMN = 'thumbnail_path';
  const NAME_COLUMN = 'name';
  const REGISTERED_AT_COLUMN = 'registered_at';
  const DESCRIPTION_COLUMN = 'description';
  const USER_ID_COLUMN = 'user_id';
  const PRICE_COLUMN = 'price';
  const IS_PUBLIC_COLUMN = 'is_public';
  const CATEGORY_ID_COLUMN = 'category_id';
  const CONTEXT_COLUMN = 'context';

  public function __construct() {
    self::$pdo = PdoManager::getPdo();
  }

  /**
   * 本を新しく追加する
   * @param string $name
   * @return int
   */
  public function insert($name, $userId, $categoryId) {
    // SQLの準備
    $sql = sprintf(
      "INSERT INTO %s (%s, %s, %s) VALUES (:name, :user_id, :category_id)",
      self::TABLE_NAME,
      self::NAME_COLUMN,
      self::USER_ID_COLUMN,
      self::CATEGORY_ID_COLUMN
    );

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $userId, PDO::PARAM_STR);
    $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
    $stmt->execute();

    return self::$pdo->lastInsertId();
  }

  /**
   * 指定されたidの本を取得する
   * @param int $id
   * @return BookDTO|null
   */
  public function findById($id)
  {
    // SQLの準備
    $sql = sprintf("SELECT * FROM %s WHERE %s = :id", self::TABLE_NAME, self::ID_COLUMN);

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // 結果の取得,DTOに詰め替え
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
      return null;
    }
    $book = $this->rowToDto($result);
    return $book;
  }

  /**
   * 指定されたユーザIDの本を取得する
   * @param int $userId
   * @return BookDTO[]
   */
  public function fetchByUserId($userId) {
    // SQLの準備
    $sql = sprintf("SELECT * FROM %s WHERE %s = :user_id", self::TABLE_NAME, self::USER_ID_COLUMN);

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    // 結果の取得,DTOに詰め替え
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (!$result) {
      return [];
    }
    $books = [];
    foreach ($result as $row) {
      $book = $this->rowToDto($row);
      $books[] = $book;
    }
    return $books;
  }

  /**
   * IDが一致する本の情報を更新する
   * @param BookDTO $book
   * @return void
   */
  public function update($book) {
    // SQLの準備
    $sql = sprintf(
      "UPDATE %s SET %s = :thumbnail_path, %s = :name, %s = :registered_at, %s = :description, %s = :user_id, %s = :price, %s = :is_public, %s = :context WHERE %s = :id",
      self::TABLE_NAME,
      self::THUMBNAIL_PATH_COLUMN,
      self::NAME_COLUMN,
      self::REGISTERED_AT_COLUMN,
      self::DESCRIPTION_COLUMN,
      self::USER_ID_COLUMN,
      self::PRICE_COLUMN,
      self::IS_PUBLIC_COLUMN,
      self::CONTEXT_COLUMN,
      self::ID_COLUMN
    );

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':thumbnail_path', $book->getThumbnailPath(), PDO::PARAM_STR);
    $stmt->bindValue(':name', $book->getName(), PDO::PARAM_STR);
    $stmt->bindValue(':registered_at', $book->getRegisteredAt(), PDO::PARAM_STR);
    $stmt->bindValue(':description', $book->getDescription(), PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $book->getUserId(), PDO::PARAM_STR);
    $stmt->bindValue(':price', $book->getPrice(), PDO::PARAM_INT);
    $stmt->bindValue(':is_public', $book->getIsPublic(), PDO::PARAM_INT);
    $stmt->bindValue(':context', $book->getContext(), PDO::PARAM_STR);
    $stmt->bindValue(':id', $book->getId(), PDO::PARAM_INT);
    $stmt->execute();
  }

  /**
   * 同じIDの本があればそのカラムを更新し、なければ新しく追加する
   * @param BookDTO $book
   * @return void
   */
  public function upsert($book) {
    // SQLの準備
    $sql = sprintf(
      "INSERT INTO %s (%s, %s, %s, %s, %s, %s, %s, %s)
      VALUES (:id, :thumbnail_path, :name, :registered_at, :description, :user_id, :price, :is_public)
      ON DUPLICATE KEY UPDATE %s = :thumbnail_path, %s = :name, %s = :registered_at, %s = :description, %s = :user_id, %s = :price, %s = :is_public",
      self::TABLE_NAME,
      self::ID_COLUMN,
      self::THUMBNAIL_PATH_COLUMN,
      self::NAME_COLUMN,
      self::REGISTERED_AT_COLUMN,
      self::DESCRIPTION_COLUMN,
      self::USER_ID_COLUMN,
      self::PRICE_COLUMN,
      self::IS_PUBLIC_COLUMN,
      self::THUMBNAIL_PATH_COLUMN,
      self::NAME_COLUMN,
      self::REGISTERED_AT_COLUMN,
      self::DESCRIPTION_COLUMN,
      self::USER_ID_COLUMN,
      self::PRICE_COLUMN,
      self::IS_PUBLIC_COLUMN
    );

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':id', $book->getId(), PDO::PARAM_INT);
    $stmt->bindValue(':thumbnail_path', $book->getThumbnailPath(), PDO::PARAM_STR);
    $stmt->bindValue(':name', $book->getName(), PDO::PARAM_STR);
    $stmt->bindValue(':registered_at', $book->getRegisteredAt(), PDO::PARAM_STR);
    $stmt->bindValue(':description', $book->getDescription(), PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $book->getUserId(), PDO::PARAM_INT);
    $stmt->bindValue(':price', $book->getPrice(), PDO::PARAM_INT);
    $stmt->bindValue(':is_public', $book->getIsPublic(), PDO::PARAM_INT);
    $stmt->execute();
  }

  /**
   * PDOStatementの処理結果のうち一行を引数にとり、
   * BookDTOに詰め替えて返す。
   * @param array $row
   * @return BookDTO
   */
  private function rowToDto($row) {
    if (empty($row)) {
      throw new Exception('$row is empty.');
    }

    $book = new BookDTO($row[self::ID_COLUMN], $row[self::USER_ID_COLUMN], $row[self::CATEGORY_ID_COLUMN]);

    $book->setThumbnailPath($row[self::THUMBNAIL_PATH_COLUMN]);
    $book->setName($row[self::NAME_COLUMN]);
    $book->setRegisteredAt($row[self::REGISTERED_AT_COLUMN]);
    $book->setDescription($row[self::DESCRIPTION_COLUMN]);
    $book->setPrice($row[self::PRICE_COLUMN]);
    $book->setIsPublic($row[self::IS_PUBLIC_COLUMN]);
    $book->setContext($row[self::CONTEXT_COLUMN]);

    return $book;
  }
}
