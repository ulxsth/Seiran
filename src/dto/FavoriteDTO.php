<?php
    class FavoriteDTO{
        private $book_id;
        private $user_id;

        public function __construct($book_id, $user_id){
            $this->book_id = $book_id;
            $this->user_id = $user_id;
        }

        public function getBookId(){
            return $this->book_id;
        }

        public function getUserId(){
            return $this->user_id;
        }
    }
?>