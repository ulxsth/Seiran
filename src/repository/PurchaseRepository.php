<?php

require __DIR__ . '/../dto/PurchaseDTO.php';
require __DIR__ . '/../util/PdoManager.php';

class PurchaseRepository {
    private $pdo = PdoManager::getPdo();

    public function insert($purchase) {
        $query = 'INSERT INTO purchases (userId, bookId, current_price, purchase_at) VALUES (?,?,?,?)';
        $stmt = $this->pdo->prepare($query);
        $stmt->bind_param('ssss', $purchase->getUserId(), $purchase->getBookId(), $purchase->getCurrentPrice(), $purchase->getPurchaseAt());
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function findByUserId($userId) {
        $query = 'SELECT * FROM purchases WHERE userId = ?';
        $stmt = $this->pdo->prepare($query);
        $stmt->bind_param('s', $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return null;
        }

        // 購入情報が複数存在する可能性があるため、配列に格納します。
        $purchases = [];
        while ($row = $result->fetch_assoc()) {
            $purchase = new PurchaseDTO($row['userId'], $row['bookId'], $row['current_price'], $row['purchase_at']);
            array_push($purchases, $purchase);
        }

        return $purchases;
    }

    // 本のIDから購入情報を取得します。（執筆者用）
    /* public function findByBookId($bookId) {
        $query = 'SELECT * FROM purchases WHERE bookId = ?';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $bookId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return null;
        }

        // 購入情報が複数存在する可能性があるため、配列に格納します。
        $purchases = [];
        while ($row = $result->fetch_assoc()) {
            $purchase = new PurchaseDTO($row['userId'], $row['bookId'], $row['current_price'], $row['purchase_at']);
            array_push($purchases, $purchase);
        }

        return $purchases;
    } */
}
?>
