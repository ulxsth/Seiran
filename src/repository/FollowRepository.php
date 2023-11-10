<?php
require_once( __DIR__ .'./../util/PdoManager.php');
require( __DIR__ . '/../dto/FollowDTO.php');

class FollowRepository {
  private static $pdo = PdoManager::getPdo();

    /**
     * フォロー情報を取得する
     * @param FollowDTO $dto
     * @return void
     */
    public function insert($dto) {
      // SQLの準備
      $sql = 'INSERT INTO follow (user_id, follow_user_id) VALUES (:user_id, :follow_user_id)';

      // SQLの実行
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':followee_id', $dto->getFolloweeId(), PDO::PARAM_INT);
      $stmt->bindValue(':follower_id', $dto->getFollowerId(), PDO::PARAM_INT);
      $stmt->execute();
    }

    /**
     * フォローしているかどうか取得する
     * @param FollowDTO $dto
     * @return boolean
     */
    public function isExist($dto) {
      // SQLの準備
      $sql = 'SELECT * FROM follow WHERE user_id = :user_id AND follow_user_id = :follow_user_id';

      // SQLの実行
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':followee_id', $dto->getFolloweeId(), PDO::PARAM_INT);
      $stmt->bindValue(':follower_id', $dto->getFollowerId(), PDO::PARAM_INT);
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
      $sql = 'DELETE FROM follow WHERE user_id = :user_id AND follow_user_id = :follow_user_id';

      // SQLの実行
      $stmt = $this->pdo->prepare($sql);
      $stmt->bindValue(':followee_id', $dto->getFolloweeId(), PDO::PARAM_INT);
      $stmt->bindValue(':follower_id', $dto->getFollowerId(), PDO::PARAM_INT);
      $stmt->execute();
    }
  }
