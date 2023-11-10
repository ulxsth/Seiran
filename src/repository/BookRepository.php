<?php
require('/seiran/src/util/PdoManager.php');
require('/seiran/src/dto/BookDTO.php');

class BookRepository {

  private static $pdo = PdoManager::getPdo();

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
  const CONTEXT_COLUMN = 'category_id';

  /**
   * 本を新しく追加する
   * @param string $name
   * @return void
   */
  public function insert($name) {
    // SQLの準備
    $sql = <<<SQL
    INSERT INTO {self::TABLE_NAME} ( {self::NAME_COLUMN} )
    VALUES (:name)
    SQL;

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
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
    $sql = <<<SQL
    SELECT * FROM {self::TABLE_NAME} WHERE {self::ID_COLUMN} = :id
    SQL;

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
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
    $sql = <<<SQL
    UPDATE {self::TABLE_NAME} SET {self::THUMBNAIL_PATH_COLUMN} = :{self::THUMBNAIL_PATH_COLUMN}, {self::NAME_COLUMN} = :{self::NAME_COLUMN}, {self::REGISTERED_AT_COLUMN} = :{self::REGISTERED_AT_COLUMN}, {self::DESCRIPTION_COLUMN} = :{self::DESCRIPTION_COLUMN}, {self::USER_ID_COLUMN} = :{self::USER_ID_COLUMN}, {self::PRICE_COLUMN} = :{self::PRICE_COLUMN}, {self::IS_PUBLIC_COLUMN} = :{self::IS_PUBLIC_COLUMN} WHERE {self::ID_COLUMN} = :{self::ID_COLUMN}
    SQL;

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':' . self::THUMBNAIL_PATH_COLUMN, $book->getThumbnailPath(), PDO::PARAM_STR);
    $stmt->bindValue(':' . self::NAME_COLUMN, $book->getName(), PDO::PARAM_STR);
    $stmt->bindValue(':' . self::REGISTERED_AT_COLUMN, $book->getRegisteredAt(), PDO::PARAM_STR);
    $stmt->bindValue(':' . self::DESCRIPTION_COLUMN, $book->getDescription(), PDO::PARAM_STR);
    $stmt->bindValue(':' . self::USER_ID_COLUMN, $book->getUserId(), PDO::PARAM_INT);
    $stmt->bindValue(':' . self::PRICE_COLUMN, $book->getPrice(), PDO::PARAM_INT);
    $stmt->bindValue(':' . self::IS_PUBLIC_COLUMN, $book->getIsPublic(), PDO::PARAM_INT);
    $stmt->bindValue(':' . self::ID_COLUMN, $book->getId(), PDO::PARAM_INT);
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
    $book = new BookDTO($row[self::ID_COLUMN]);

    $book->setThumbnailPath($row[self::THUMBNAIL_PATH_COLUMN]);
    $book->setName($row[self::NAME_COLUMN]);
    $book->setRegisteredAt($row[self::REGISTERED_AT_COLUMN]);
    $book->setDescription($row[self::DESCRIPTION_COLUMN]);
    $book->setUserId($row[self::USER_ID_COLUMN]);
    $book->setPrice($row[self::PRICE_COLUMN]);
    $book->setIsPublic($row[self::IS_PUBLIC_COLUMN]);

    return $book;
  }
}
