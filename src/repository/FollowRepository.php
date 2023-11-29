<?php
require_once __DIR__ . '/../util/PdoManager.php';
require_once __DIR__ . '/../dto/FollowDTO.php';

class FollowRepository {
  private static $pdo;

  public function __construct() {
    self::$pdo = PdoManager::getPdo();
  }

  const TABLE_NAME = 'follows';
  const FOLLOWEE_ID = 'followee_id';
  const FOLLOWER_ID = 'follower_id';

    /**
     * フォロー情報を新しく追加する
     * @param string $followeeId
     * @param string $followerId
     * @return void
     */
  public function insert($followeeId, $followerId) {
    // SQLの準備
    $sql = sprintf(
      "INSERT INTO %s (%s, %s) VALUES (:followee_id, :follower_id)",
      self::TABLE_NAME,
      self::FOLLOWEE_ID,
      self::FOLLOWER_ID
    );

    // SQLの実行
    $stmt = self::$pdo->prepare($sql);
    $stmt->bindValue(':followee_id', $followeeId, PDO::PARAM_STR);
    $stmt->bindValue(':follower_id', $followerId, PDO::PARAM_STR);
    $stmt->execute();
  }

    /**
     * フォローしているかどうか取得する
     * @param FollowDTO $dto
     * @return boolean
     */
    public function isExist($dto) {
      // SQLの準備
      $sql = sprintf(
        "SELECT * FROM %s WHERE %s = :user_id AND %s = :follow_user_id",
        self::TABLE_NAME,
        self::FOLLOWEE_ID,
        self::FOLLOWER_ID
      );

      // SQLの実行
      $stmt = self::$pdo->prepare($sql);
      $stmt->bindValue(':user_id', $dto->getFolloweeId(), PDO::PARAM_STR);
      $stmt->bindValue(':follow_user_id', $dto->getFollowerId(), PDO::PARAM_STR);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      return $result !== false;
    }

    /**
     * ユーザーがフォローしているユーザーの数を取得する
     * @param string $userId
     * @return integer
     */
    public function getFolloweeCount($userId)
    {
      // SQLの準備
      $sql = sprintf(
        "SELECT COUNT(*) FROM %s WHERE %s = :user_id",
        self::TABLE_NAME,
        self::FOLLOWER_ID
      );

      // SQLの実行
      $stmt = self::$pdo->prepare($sql);
      $stmt->bindValue(':user_id', $userId, PDO::PARAM_STR);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      return $result['COUNT(*)'];
    }

    /**
     * ユーザーをフォローしているユーザーの数を取得する
     * @param string $userId
     * @return integer
     */
    public function getFollowerCount($userId)
    {
      // SQLの準備
      $sql = sprintf(
        "SELECT COUNT(*) FROM %s WHERE %s = :user_id",
        self::TABLE_NAME,
        self::FOLLOWEE_ID
      );

      // SQLの実行
      $stmt = self::$pdo->prepare($sql);
      $stmt->bindValue(':user_id', $userId, PDO::PARAM_STR);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      return $result['COUNT(*)'];
    }

    /**
     * フォロー情報を削除する
     * @param FollowDTO $dto
     * @return void
     */
    public function delete($dto)
    {
      // SQLの準備
      $sql = sprintf(
        "DELETE FROM %s WHERE %s = :user_id AND %s = :follow_user_id",
        self::TABLE_NAME,
        self::FOLLOWEE_ID,
        self::FOLLOWER_ID
      );

      // SQLの実行
      $stmt = self::$pdo->prepare($sql);
      $stmt->bindValue(':user_id', $dto->getFolloweeId(), PDO::PARAM_STR);
      $stmt->bindValue(':follow_user_id', $dto->getFollowerId(), PDO::PARAM_STR);
      $stmt->execute();
    }
  }
