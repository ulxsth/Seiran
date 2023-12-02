<?php

require_once __DIR__ . '/../dto/PurchaseDTO.php';
require_once __DIR__ . '/../util/PdoManager.php';

class PurchaseRepository {
    private static $pdo;

    public function __construct() {
        self::$pdo = PdoManager::getPdo();
    }

    const TABLE_NAME = 'purchases';
    const USER_ID_COLUMN = 'user_id';
    const BOOK_ID_COLUMN = 'book_id';
    const CURRENT_PRICE_COLUMN = 'current_price';
    const PURCHASE_AT_COLUMN = 'purchase_at';

    /**
     * 購入情報を新しく追加する
     * @param string userId
     * @param int bookId
     * @param int currentPrice
     * @return void
     */
    public function insert($userId, $bookId, $currentPrice)
    {
        // SQLの準備
        $sql = sprintf("INSERT INTO %s (%s, %s, %s) VALUES (:user_id, :book_id, :current_price)", self::TABLE_NAME, self::USER_ID_COLUMN, self::BOOK_ID_COLUMN, self::CURRENT_PRICE_COLUMN);
        $stmt = self::$pdo->prepare($sql);

        // SQLの実行
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':book_id', $bookId);
        $stmt->bindParam(':current_price', $currentPrice);
        $stmt->execute();
    }

    /**
     * 指定したユーザーが、指定した本を購入済みかどうかを判定する
     * @param string $userId
     * @param int $bookId
     * @return bool
     */
    public function isPurchased($userId, $bookId) {
        // SQLの準備
        $sql = sprintf("SELECT * FROM %s WHERE %s = :user_id AND %s = :book_id", self::TABLE_NAME, self::USER_ID_COLUMN, self::BOOK_ID_COLUMN);
        $stmt = self::$pdo->prepare($sql);


        // SQLの実行
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':book_id', $bookId);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // 購入情報が存在するかどうかで判定する
        return !empty($result);
    }

    /**
     * 指定したユーザーIDに一致する購入情報を取得する
     * @param string $userId
     * @return array[PurchaseDto] purchases
     */
    public function fetchByUserId($userId) {
        // SQLの準備
        $sql = sprintf("SELECT * FROM %s WHERE %s = :user_id", self::TABLE_NAME, self::USER_ID_COLUMN);
        $stmt = self::$pdo->prepare($sql);

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
    public function fetchByBookId($bookId) {
        // SQLの準備
        $sql = sprintf("SELECT * FROM %s WHERE %s = :book_id", self::TABLE_NAME, self::BOOK_ID_COLUMN);
        $stmt = self::$pdo->prepare($sql);

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
        if (empty($row)) {
            throw new Exception('$row is empty.');
        }

        $purchase = new PurchaseDTO($row[self::USER_ID_COLUMN], $row[self::BOOK_ID_COLUMN], $row[self::CURRENT_PRICE_COLUMN]);
        return $purchase;
    }

    /**
     * DBの結果レコードの配列を受け取り、PurchaseDTOの配列に詰め替える
     * @param array $result
     * @return array[PurchaseDTO] purchases
     */
    private function resultToDtoArray($result) {
        if (empty($result)) {
            throw new Exception('$result is empty.');
        }

        $purchases = [];
        foreach ($result as $row) {
            $purchase = $this->rowToDto($row);
            array_push($purchases, $purchase);
        }
        return $purchases;
    }
}
?>
