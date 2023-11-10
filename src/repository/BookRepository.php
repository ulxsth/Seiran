<?php
require('/seiran/src/util/PdoManager.php');
require('/seiran/src/dto/BookDTO.php');

class BookRepository {

  private $pdo = null;

  public function __construct() {
    $this->pdo = PdoManager::getPdo();
  }

  /**
   * 本を新しく追加する
   * @param string $name
   * @return void
   */
  public function insert($name) {
    // SQLの準備
    $sql = 'INSERT INTO book (name) VALUES (:name)';

    // SQLの実行
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
  }

  /**
   * 指定されたidの本を取得する
   * @param int $id
   * @return BookDTO
   */
  public function findById($id) {
    // SQLの準備
    $sql = 'SELECT * FROM book WHERE id = :id';

    // SQLの実行
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // 結果の取得,DTOに詰め替え
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $book = $this->rowToDto($result);

    return $book;
  }

  /**
   * IDが一致する本の情報を更新する
   * @param BookDTO $book
   * @return void
   */
  public function update($book) {
    // SQLの準備
    $sql = 'UPDATE book SET thumbnail_path = :thumbnail_path, name = :name, registered_at = :registered_at, description = :description, user_id = :user_id, price = :price, is_public = :is_public WHERE id = :id';

    // SQLの実行
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':thumbnail_path', $book->getThumbnailPath(), PDO::PARAM_STR);
    $stmt->bindValue(':name', $book->getName(), PDO::PARAM_STR);
    $stmt->bindValue(':registered_at', $book->getRegisteredAt(), PDO::PARAM_STR);
    $stmt->bindValue(':description', $book->getDescription(), PDO::PARAM_STR);
    $stmt->bindValue(':user_id', $book->getUserId(), PDO::PARAM_INT);
    $stmt->bindValue(':price', $book->getPrice(), PDO::PARAM_INT);
    $stmt->bindValue(':is_public', $book->getIsPublic(), PDO::PARAM_INT);
    $stmt->bindValue(':id', $book->getId(), PDO::PARAM_INT);
    $stmt->execute();
  }

  /**
   * PDOStatementの処理結果のうち一行を引数にとり、
   * BookDTOに詰め替えて返す。
   * @param array $row
   * @return BookDTO
   */
  private function rowToDto($row)
  {
    $book = new BookDTO($row['id']);

    $book->setThumbnailPath($row['thumbnail_path']);
    $book->setName($row['name']);
    $book->setRegisteredAt($row['registered_at']);
    $book->setDescription($row['description']);
    $book->setUserId($row['user_id']);
    $book->setPrice($row['price']);
    $book->setIsPublic($row['is_public']);

    return $book;
  }
}


?>
