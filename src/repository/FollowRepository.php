<?php
require_once( __DIR__ .'./../util/PdoManager.php');
require( __DIR__ . '/../dto/FollowDTO.php');

class FollowRepository {
  private static $pdo = PdoManager::getPdo();

  const USER_ID = 'user_id';
  const FOLLOW_USER_ID = 'follow_user_id';

    /**
     * フォロー情報を取得する
     * @param FollowDTO $dto
     * @return void
     */
    public function insert($dto) {
      // SQLの準備
      $sql = <<<SQL
      INSERT INTO follow ({self::USER_ID}, {self::FOLLOW_USER_ID})
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
      SELECT * FROM follow
      WHERE {self::USER_ID} = :user_id
      AND {self::FOLLOW_USER_ID} = :follow_user_id
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
      DELETE FROM follow
      WHERE {self::USER_ID} = :user_id
      AND {self::FOLLOW_USER_ID} = :follow_user_id
      SQL;

      // SQLの実行
      $stmt = self::$pdo->prepare($sql);
      $stmt->bindValue(':user_id', $dto->getFolloweeId(), PDO::PARAM_INT);
      $stmt->bindValue(':follow_user_id', $dto->getFollowerId(), PDO::PARAM_INT);
      $stmt->execute();
    }
  }
