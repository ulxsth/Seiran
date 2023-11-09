<?php
require( __DIR__ + '/../util/PdoManager.php');
require( __DIR__ + '/../dto/FavoriteDTO.php');

class FavoriteRepository {
  private static $pdo = PdoManager::getPdo();

  /**
   * いいねを新しく追加する
   * @param FavoriteDTO $dto
   * @return void
   */
  public static function insert(FavoriteDTO $dto) {
    // SQLの準備
    $sql = 'INSERT INTO favorite (book_id, user_id) VALUES (:book_id, :user_id)';

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
  public static function getLikeCount($bookId) {
    // SQLの準備
    $sql = 'SELECT COUNT(*) AS count FROM favorite WHERE book_id = :book_id';

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':book_id', $bookId, PDO::PARAM_INT);
    $stmt->execute();

    // 結果の取得
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $result['count'];

    return $count;
  }

  /**
   * いいねを削除する
   * @param mixed $dto
   * @return void
   */
  public static function delete($dto) {
    // SQLの準備
    $sql = 'DELETE FROM favorite WHERE book_id = :book_id AND user_id = :user_id';

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':book_id', $dto->getBookId(), PDO::PARAM_INT);
    $stmt->bindValue(':user_id', $dto->getUserId(), PDO::PARAM_INT);
    $stmt->execute();
  }
}
?>
