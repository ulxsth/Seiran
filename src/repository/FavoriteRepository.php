<?php
require( __DIR__ . '/../util/PdoManager.php');
require( __DIR__ . '/../dto/FavoriteDTO.php');

class FavoriteRepository {
  private static $pdo = PdoManager::getPdo();
  
  const TABLE_NAME = 'favorite';
  const BOOK_ID_COLUMN_NAME = 'book_id';
  const USER_ID_COLUMN_NAME = 'user_id';
  const COUNT_COLUMN_NAME = 'count';

  /**
   * いいねを新しく追加する
   * @param FavoriteDTO $dto
   * @return void
   */
  public function insert(FavoriteDTO $dto) {
    // SQLの準備
    $sql = <<<SQL
    INSERT INTO {self::TABLE_NAME} ({self::BOOK_ID_COLUMN_NAME}, {self::USER_ID_COLUMN_NAME})
    VALUES (:book_id, :user_id)
    SQL;

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':book_id', $dto->getBookId(), PDO::PARAM_INT);
    $stmt->bindValue(':user_id', $dto->getUserId(), PDO::PARAM_INT);
    $stmt->execute();
  }

  /**
   * 指定されたidのいいね数を取得する
   * @param int $bookId
   * @return int
   */
  public function getLikeCount($bookId) {
    // SQLの準備
    $sql = <<<SQL
    SELECT COUNT(*) AS {self::COUNT_COLUMN_NAME}
    FROM {self::TABLE_NAME}
    WHERE {self::BOOK_ID_COLUMN_NAME} = :book_id
    SQL;

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':book_id', $bookId, PDO::PARAM_INT);
    $stmt->execute();

    // 結果の取得
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $result[self::COUNT_COLUMN_NAME];

    return $count;
  }

  /**
   * いいねを削除する
   * @param mixed $dto
   * @return void
   */
  public function delete($dto) {
    // SQLの準備
    $sql = <<<SQL
    DELETE FROM {self::TABLE_NAME}
    WHERE {self::BOOK_ID_COLUMN_NAME} = :book_id
    AND {self::USER_ID_COLUMN_NAME} = :user_id
    SQL;

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':book_id', $dto->getBookId(), PDO::PARAM_INT);
    $stmt->bindValue(':user_id', $dto->getUserId(), PDO::PARAM_INT);
    $stmt->execute();
  }
}
