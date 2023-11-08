<?php

require __DIR__ . '/../dto/FavoriteDTO.php';
require __DIR__ . '/../util/PdoManager.php';

class FavoriteRepository {
    private $pdo;

    public function __construct() {
        $this->pdo = PdoManager::getPdo();
    }

    /**
     * お気に入り情報を新しく追加する
     * @param FavoriteDTO $dto
     * @return void
     */
    public function insert($dto) {
        // SQLの準備
        $query = 'INSERT INTO favorites (user_id, book_id) VALUES (:user_id, :book_id)';
        $stmt = $this->pdo->prepare($query);

        // SQLの実行
        $stmt->bindValue(':user_id', $dto->getUserId(), PDO::PARAM_STR);
        $stmt->bindValue(':book_id', $dto->getBookId(), PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * 指定したユーザーIDに一致するお気に入り情報を取得する
     * @param string $userId
     * @return array[FavoriteDTO] favorites
     */
    public function findByUserId($userId) {
        // SQLの準備
        $sql = 'SELECT * FROM favorites WHERE user_id = :user_id';
        $stmt = $this->pdo->prepare($sql);

        // SQLの実行
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // お気に入り情報が複数存在する場合があるため、配列に格納する
        return $this->resultToDtoArray($result);
    }

    private function resultToDtoArray($result) {
        $favorites = [];
        foreach ($result as $row) {
            $dto = new FavoriteDTO();
            $dto->setUserId($row['user_id']);
            $dto->setBookId($row['book_id']);
            $favorites[] = $dto;
        }
        return $favorites;
    }
    

}
?>