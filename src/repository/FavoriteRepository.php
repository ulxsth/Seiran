<?php
require_once __DIR__ . '/../util/PdoManager.php';
require_once __DIR__ . '/../dto/FavoriteDTO.php';

class FavoriteRepository {
  private static $pdo;

  public function __construct() {
    self::$pdo = PdoManager::getPdo();
  }

  const TABLE_NAME = 'favorites';
  const BOOK_ID_COLUMN_NAME = 'book_id';
  const USER_ID_COLUMN_NAME = 'user_id';

  /**
   * いいねを新しく追加する
   * @param FavoriteDTO $dto
   * @return void
   */
  public function insert(FavoriteDTO $dto) {
    // SQLの準備
    $sql = sprintf(
      "INSERT INTO %s (%s, %s) VALUES (:book_id, :user_id)",
      self::TABLE_NAME,
      self::BOOK_ID_COLUMN_NAME,
      self::USER_ID_COLUMN_NAME
    );

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':book_id', $dto->getBookId(), PDO::PARAM_INT);
    $stmt->bindValue(':user_id', $dto->getUserId(), PDO::PARAM_INT);
    $stmt->execute();
  }

  /**
   * 指定したユーザーが、指定した本をいいね済みかどうかを判定する
   * @param int $userId
   * @param int $bookId
   * @return bool
   */
  public function isExist($userId, $bookId) {
    // SQLの準備
    $sql = sprintf(
      "SELECT * FROM %s WHERE %s = :user_id AND %s = :book_id",
      self::TABLE_NAME,
      self::USER_ID_COLUMN_NAME,
      self::BOOK_ID_COLUMN_NAME
    );

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindValue(':book_id', $bookId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // いいね情報が存在するかどうかで判定する
    return !empty($result);
  }

  /**
   * 指定されたidのいいね数を取得する
   * @param int $bookId
   * @return int
   */
  public function getCount($bookId) {
    // SQLの準備
    $sql = sprintf(
      "SELECT COUNT(*) AS count
      FROM %s
      WHERE %s = :book_id",
      self::TABLE_NAME,
      self::BOOK_ID_COLUMN_NAME
    );

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':book_id', $bookId, PDO::PARAM_INT);
    $stmt->execute();

    // 結果の取得
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $result["count"];

    return $count;
  }

  /**
   * いいねを削除する
   * @param mixed $dto
   * @return void
   */
  public function delete($dto) {
    // SQLの準備
    $sql = sprintf(
      "DELETE FROM %s
      WHERE %s = :book_id
      AND %s = :user_id",
      self::TABLE_NAME,
      self::BOOK_ID_COLUMN_NAME,
      self::USER_ID_COLUMN_NAME
    );
    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':book_id', $dto->getBookId(), PDO::PARAM_INT);
    $stmt->bindValue(':user_id', $dto->getUserId(), PDO::PARAM_INT);
    $stmt->execute();
  }
}
