<?php
  class BookDTO {
    private $id;
    private $title;
    private $author;
    private $description;
    private $price;

    public function __construct($id) {
      $this->id = $id;
    }

    // getter
    public function getId() {
      return $this->id;
    }

    public function getTitle() {
      return $this->title;
    }

    public function getAuthor() {
      return $this->author;
    }

    public function getDescription() {
      return $this->description;
    }

    public function getPrice() {
      return $this->price;
    }

    // setter
    public function setTitle($title) {
      $this->title = $title;
    }

    public function setAuthor($author) {
      $this->author = $author;
    }

    public function setDescription($description) {
      $this->description = $description;
    }

    public function setPrice($price) {
      $this->price = $price;
    }
  }
