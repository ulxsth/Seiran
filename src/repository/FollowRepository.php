<?php
require_once( __DIR__ .'./../util/PdoManager.php');
require( __DIR__ . '/../dto/FollowDTO.php');

class FollowRepository {
  private static $pdo = PdoManager::getPdo();

  const TABLE_NAME = 'follows';
  const FOLLOWEE_ID = 'followee_id';
  const FOLLOWER_ID = 'follower_id';

    /**
     * フォロー情報を取得する
     * @param FollowDTO $dto
     * @return void
     */
    public function insert($dto) {
      // SQLの準備
      $sql = <<<SQL
      INSERT INTO {self::TABLE_NAME} ({self::FOLLOWEE_ID}, {self::FOLLOWER_ID})
      VALUES (:user_id, :follow_user_id)
      SQL;

      // SQLの実行
      $stmt = self::$pdo->prepare($sql);
      $stmt->bindValue(':user_id', $dto->getFolloweeId(), PDO::PARAM_INT);
      $stmt->bindValue(':follow_user_id', $dto->getFollowerId(), PDO::PARAM_INT);
      $stmt->execute();
    }

    /**
     * フォローしているかどうか取得する
     * @param FollowDTO $dto
     * @return boolean
     */
    public function isExist($dto) {
      // SQLの準備
      $sql = <<<SQL
      SELECT * FROM {self::TABLE_NAME}
      WHERE {self::FOLLOWEE_ID} = :user_id
      AND {self::FOLLOWER_ID} = :follow_user_id
      SQL;

      // SQLの実行
      $stmt = self::$pdo->prepare($sql);
      $stmt->bindValue(':user_id', $dto->getFolloweeId(), PDO::PARAM_INT);
      $stmt->bindValue(':follow_user_id', $dto->getFollowerId(), PDO::PARAM_INT);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      return $result !== false;
    }

    /**
     * フォロー情報を削除する
     * @param FollowDTO $dto
     * @return void
     */
    public function delete($dto)
    {
      // SQLの準備
      $sql = <<<SQL
      DELETE FROM {self::TABLE_NAME}
      WHERE {self::FOLLOWEE_ID} = :user_id
      AND {self::FOLLOWER_ID} = :follow_user_id
      SQL;

      // SQLの実行
      $stmt = self::$pdo->prepare($sql);
      $stmt->bindValue(':user_id', $dto->getFolloweeId(), PDO::PARAM_INT);
      $stmt->bindValue(':follow_user_id', $dto->getFollowerId(), PDO::PARAM_INT);
      $stmt->execute();
    }
  }
