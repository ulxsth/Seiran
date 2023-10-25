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
  public function create($name) {
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
  public function getById($id) {
    // SQLの準備
    $sql = 'SELECT * FROM book WHERE id = :id';

    // SQLの実行
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // 結果の取得,DTOに詰め替え
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $book = new BookDTO($result['id']);
    $book->setThumbnailPath($result['thumbnail_path']);
    $book->setName($result['name']);
    $book->setRegisteredAt($result['registered_at']);
    $book->setDescription($result['description']);
    $book->setUserId($result['user_id']);
    $book->setPrice($result['price']);
    $book->setIsPublic($result['is_public']);

    return $book;
  }

  public function updateBook($book) {

  }

  public function deleteBook($id) {
    // TODO: Implement deleteBook method
  }
}


?>
