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
   * @param bool $includePrivate
   * @return BookDTO|null
   */
  public function findById($id, $includePrivate = false)
  {
    // SQLの準備
    $sql = sprintf("SELECT * FROM %s WHERE %s = :id", self::TABLE_NAME, self::ID_COLUMN);

    if (!$includePrivate) {
      $sql .= sprintf(" AND %s = 1", self::IS_PUBLIC_COLUMN);
    }

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
   * すべての本を取得する
   * @param int $limit
   * @param string $sortedBy 'registeredAt_asc', 'registeredAt_desc' 'favCount_asc', 'favCount_desc'
   * @param bool $includePrivate
   * @return BookDTO[]
   */
  public function fetchAll($limit = 10, $sortedBy = 'registeredAt_asc', $includePrivate = false) {
    // SQLの準備
    $sql = sprintf("SELECT * FROM %s", self::TABLE_NAME);

    if($sortedBy == 'favCount_asc' || $sortedBy == 'favCount_desc') {
      $sql .= " LEFT JOIN favorites ON books.id = favorites.book_id";
    }

    if (!$includePrivate) {
      $sql = sprintf("%s WHERE %s = 1", $sql, self::IS_PUBLIC_COLUMN);
    }

    switch ($sortedBy) {
      case 'registeredAt_asc':
        $sql .= " ORDER BY registered_at ASC";
        break;
      case 'registeredAt_desc':
        $sql .= " ORDER BY registered_at DESC";
        break;
      case 'favCount_asc':
      case 'favCount_desc':
        $sql .= " GROUP BY books.id";
        $sql .= $sortedBy == 'favCount_asc' ? " ORDER BY COUNT(favorites.book_id) ASC" : " ORDER BY COUNT(favorites.book_id) DESC";
    }

    $sql .= " LIMIT :limit";

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
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
   * 指定されたユーザIDのユーザーが書いた本を取得する
   *
   * @param int $userId
   * @param int $limit
   * @param string $sortedBy 'registeredAt_asc', 'registeredAt_desc' 'favCount_asc', 'favCount_desc'
   * @param bool $includePrivate
   * @return BookDTO[]
   */
  public function fetchByUserId($userId, $limit = 10, $sortedBy = 'registeredAt_asc', $includePrivate = false){
    // SQLの準備
    $sql = sprintf("SELECT * FROM %s", self::TABLE_NAME);

    if ($sortedBy == 'favCount_asc' || $sortedBy == 'favCount_desc'
    ) {
      $sql .= " LEFT JOIN favorites ON books.id = favorites.book_id";
    }

    $sql .= sprintf(" WHERE %s = :user_id", self::USER_ID_COLUMN);
    if (!$includePrivate) {
      $sql .= sprintf(" AND %s = 1", self::IS_PUBLIC_COLUMN);
    }

    switch ($sortedBy) {
      case 'registeredAt_asc':
        $sql .= " ORDER BY registered_at ASC";
        break;
      case 'registeredAt_desc':
        $sql .= " ORDER BY registered_at DESC";
        break;
      case 'favCount_asc':
      case 'favCount_desc':
        $sql .= " GROUP BY books.id";
        $sql .= $sortedBy == 'favCount_asc' ? " ORDER BY COUNT(favorites.book_id) ASC" : " ORDER BY COUNT(favorites.book_id) DESC";
    }

    $sql .= " LIMIT :limit";

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
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
   * 指定したユーザーがフォローしているユーザーの小説を取得する
   * @param int $userId
   * @param int $limit
   * @param string $sortedBy 'registeredAt_asc', 'registeredAt_desc' 'favCount_asc', 'favCount_desc'
   * @param bool $includePrivate
   * @return BookDTO[]
   */
  public function fetchByFollowedUserId($userId, $limit = 10, $sortedBy = 'registeredAt_asc', $includePrivate = false)
  {
    // SQLの準備
    $sql = sprintf("SELECT * FROM %s", self::TABLE_NAME);

    if ($sortedBy == 'favCount_asc' || $sortedBy == 'favCount_desc'
    ) {
      $sql .= " LEFT JOIN favorites ON books.id = favorites.book_id";
    }

    $sql .= " INNER JOIN follows ON books.user_id = follows.follower_id";
    $sql .= sprintf(" WHERE follows.followee_id = :user_id", self::USER_ID_COLUMN);
    if (!$includePrivate) {
      $sql .= sprintf(" AND %s = 1", self::IS_PUBLIC_COLUMN);
    }

    switch ($sortedBy) {
      case 'registeredAt_asc':
        $sql .= " ORDER BY registered_at ASC";
        break;
      case 'registeredAt_desc':
        $sql .= " ORDER BY registered_at DESC";
        break;
      case 'favCount_asc':
      case 'favCount_desc':
        $sql .= " GROUP BY books.id";
        $sql .= $sortedBy == 'favCount_asc' ? " ORDER BY COUNT(favorites.book_id) ASC" : " ORDER BY COUNT(favorites.book_id) DESC";
    }

    $sql .= " LIMIT :limit";

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
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
   * カテゴリIDをもとに絞り込み検索する
   * @param int $categoryId
   * @param int $limit
   * @param string $sortedBy 'registeredAt_asc', 'registeredAt_desc' 'favCount_asc', 'favCount_desc'
   * @param bool $includePrivate
   * @return BookDTO[]
   */
  public function fetchByCategoryId($categoryId, $limit = 10, $sortedBy = 'registeredAt_asc', $includePrivate = false)
  {
    // SQLの準備
    $sql = sprintf("SELECT * FROM %s", self::TABLE_NAME);

    if (
      $sortedBy == 'favCount_asc' || $sortedBy == 'favCount_desc'
    ) {
      $sql .= " LEFT JOIN favorites ON books.id = favorites.book_id";
    }

    $sql .= sprintf(" WHERE %s = :category_id", self::CATEGORY_ID_COLUMN);
    if (!$includePrivate) {
      $sql .= sprintf(" AND %s = 1", self::IS_PUBLIC_COLUMN);
    }

    switch ($sortedBy) {
      case 'registeredAt_asc':
        $sql .= " ORDER BY registered_at ASC";
        break;
      case 'registeredAt_desc':
        $sql .= " ORDER BY registered_at DESC";
        break;
      case 'favCount_asc':
      case 'favCount_desc':
        $sql .= " GROUP BY books.id";
        $sql .= $sortedBy == 'favCount_asc' ? " ORDER BY COUNT(favorites.book_id) ASC" : " ORDER BY COUNT(favorites.book_id) DESC";
    }

    $sql .= " LIMIT :limit";

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
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
   * 小説名をもとにあいまい検索する
   * @param string $name
   * @param int $limit
   * @param bool $includePrivate
   * @return BookDTO[]
   */
  public function FuzzyFetchByName($name, $limit = 10, $includePrivate = false)
  {
    // SQLの準備
    $sql = sprintf("SELECT * FROM %s WHERE %s LIKE :name", self::TABLE_NAME, self::NAME_COLUMN);

    if (!$includePrivate) {
      $sql .= sprintf(" AND %s = 1", self::IS_PUBLIC_COLUMN);
    }

    $sql .= " LIMIT :limit";

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':name', '%' . $name . '%', PDO::PARAM_STR);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
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
      "UPDATE %s SET %s = :thumbnail_path, %s = :name, %s = :registered_at, %s = :description, %s = :user_id, %s = :price, %s = :is_public, %s = :context, %s = :category_id WHERE %s = :id",
      self::TABLE_NAME,
      self::THUMBNAIL_PATH_COLUMN,
      self::NAME_COLUMN,
      self::REGISTERED_AT_COLUMN,
      self::DESCRIPTION_COLUMN,
      self::USER_ID_COLUMN,
      self::PRICE_COLUMN,
      self::IS_PUBLIC_COLUMN,
      self::CONTEXT_COLUMN,
      self::CATEGORY_ID_COLUMN,
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
    $stmt->bindValue(':is_public', $book->getIsPublic(), PDO::PARAM_BOOL);
    $stmt->bindValue(':context', $book->getContext(), PDO::PARAM_STR);
    $stmt->bindValue(':category_id', $book->getCategoryId(), PDO::PARAM_INT);
    $stmt->bindValue(':id', $book->getId(), PDO::PARAM_INT);
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
