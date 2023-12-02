<?php
require_once __DIR__ . '/../util/PdoManager.php';
require_once __DIR__ . '/../dto/CategoryDTO.php';

class CategoryRepository {
  private static $pdo;

  const TABLE_NAME = 'categories';
  const ID_COLUMN = 'id';
  const NAME_COLUMN = 'name';

  public function __construct() {
    self::$pdo = PdoManager::getPdo();
  }

  /**
   * 全てのカテゴリーを取得する
   * @return array[CategoryDTO]
   */
  public function fetchAll()
  {
    // SQLの準備
    $sql = sprintf("SELECT * FROM %s", self::TABLE_NAME);

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->execute();

    // 結果の取得,DTOに詰め替え
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $categories = array();
    foreach ($result as $row) {
      $category = $this->rowToDto($row);
      $categories[] = $category;
    }

    return $categories;
  }


  /**
   * idに合致するカテゴリーを取得する
   * @param int $id
   * @return CategoryDTO
   */
  public function findById($id) {
    // SQLの準備
    $sql = sprintf("SELECT * FROM %s WHERE %s = :id", self::TABLE_NAME, self::ID_COLUMN);

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // 結果の取得,DTOに詰め替え
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $category = $this->rowToDto($result);

    return $category;
  }


  /**
   * 名前からカテゴリーをあいまい検索する
   * @param string $keyword
   * @return array[CategoryDTO]
   */
  public function findByName($keyword)
  {
    // SQLの準備
    $sql = sprintf("SELECT * FROM %s WHERE %s LIKE :keyword", self::TABLE_NAME, self::NAME_COLUMN);

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
    $stmt->execute();

    // 結果の取得,DTOに詰め替え
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $categories = array();
    foreach ($result as $row) {
      $category = $this->rowToDto($row);
      $categories[] = $category;
    }

    return $categories;
  }

  /**
   * 名前からカテゴリーを完全一致検索する
   * @param string $keyword
   * @return array[CategoryDTO]
   */
  public function findByNameExact($keyword) {
    // SQLの準備
    $sql = sprintf("SELECT * FROM %s WHERE %s = :keyword", self::TABLE_NAME, self::NAME_COLUMN);

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':keyword', $keyword, PDO::PARAM_STR);
    $stmt->execute();

    // 結果の取得,DTOに詰め替え
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $categories = array();
    foreach ($result as $row) {
      $category = $this->rowToDto($row);
      $categories[] = $category;
    }

    return $categories;
  }


  /**
   * 問い合わせの結果をDTOに詰め替える
   * @param array $row
   */
  private function rowToDto($row) {
    if (empty($row)) {
      throw new Exception('$row is empty.');
    }

    $id = $row[self::ID_COLUMN];
    $name = $row[self::NAME_COLUMN];

    $category = new CategoryDTO($id, $name);
    return $category;
  }
}
?>
