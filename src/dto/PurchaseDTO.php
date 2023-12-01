<?php

class PurchaseDTO
{
    private $userId;
    private $bookId;
    private $current_price;
    private $purchase_at;

    public function __construct($userId, $bookId, $current_price) {
        $this->userId = $userId;
        $this->bookId = $bookId;
        $this->current_price = $current_price;
        $this->purchase_at = "";
    }

    public function getUserId() {
        return $this->userId;
    }
    public function getBookId() {
        return $this->bookId;
    }
    public function getCurrentPrice() {
        return $this->current_price;
    }
    public function getPurchaseAt() {
        return $this->purchase_at;
    }
}
