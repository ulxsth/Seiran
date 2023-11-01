<?php

require __DIR__ . '/../dto/PurchaseDTO.php';
require __DIR__ . '/../util/PdoManager.php';

class PurchaseRepository {
    private $pdo = PdoManager::getPdo();

    /**
     * 購入情報を新しく追加する
     * @param PurchaseDto $dto
     * @return void
     */
    public function insert($dto) {
        // SQLの準備
        $query = 'INSERT INTO purchases (user_id, book_id, current_price, purchase_at) VALUES (:user_id, :book_id, :current_price, :purchase_at)';
        $stmt = $this->pdo->prepare($query);

        // SQLの実行
        $stmt->bindValue(':user_id', $dto->getUserId(), PDO::PARAM_STR);
        $stmt->bindValue(':book_id', $dto->getBookId(), PDO::PARAM_STR);
        $stmt->bindValue(':current_price', $dto->getCurrentPrice(), PDO::PARAM_INT);
        $stmt->bindValue(':purchase_at', $dto->getPurchaseAt(), PDO::PARAM_STR);
        $stmt->execute();
    }

    /**
     * 指定したユーザーIDに一致する購入情報を取得する
     * @param string $userId
     * @return array[PurchaseDto] purchases
     */
    public function findByUserId($userId) {
        // SQLの準備
        $sql = 'SELECT * FROM purchases WHERE userId = :user_id';
        $stmt = $this->pdo->prepare($sql);

        // SQLの実行
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 購入情報が複数存在する場合があるため、配列に格納する
        return $this->resultToDtoArray($result);
    }

    /**
     * 指定した本のIDに一致する購入情報を取得する
     * @param int $bookId
     * @return array[PurchaseDto] purchases
     */
    public function findByBookId($bookId) {
        // SQLの準備
        $sql = 'SELECT * FROM purchases WHERE bookId = :book_id';
        $stmt = $this->pdo->prepare($sql);

        // SQLの実行
        $stmt->bindParam(':book_id', $bookId);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 購入情報が複数存在する場合があるため、配列に格納する
        return $this->resultToDtoArray($result);
    }

    /**
     * DBの結果レコードの一行を受け取り、PurchaseDTOに詰め替える
     * @param array $row
     * @return PurchaseDTO
     */
    private function rowToDto($row) {
        $purchase = new PurchaseDTO($row['userId'], $row['bookId'], $row['current_price']);
        return $purchase;
    }

    /**
     * DBの結果レコードの配列を受け取り、PurchaseDTOの配列に詰め替える
     * @param array $result
     * @return array[PurchaseDTO] purchases
     */
    private function resultToDtoArray($result)
    {
        $purchases = [];
        foreach ($result as $row) {
            $purchase = $this->rowToDto($row);
            array_push($purchases, $purchase);
        }
        return $purchases;
    }
}
?>
