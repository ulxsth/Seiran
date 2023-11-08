<?php
    class FavoriteDTO{
        private $bookId;
        private $userId;

        public function __construct($bookId, $userId){
            $this->bookId = $bookId;
            $this->userId = $userId;
        }

        public function getBookId(){
            return $this->bookId;
        }

        public function getUserId(){
            return $this->userId;
        }
    }
?>