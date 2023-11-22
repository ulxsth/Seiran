<?php
  class BookDTO {
    private $id;
    private $thumbnail_path;
    private $name;
    private $registered_at;
    private $description;
    private $user_id;
    private $price;
    private $is_public;
    private $context;

    public function __construct($id, $userId) {
      $this->id = $id;
      $name = '';
      $registered_at = '';
      $description = '';
      $user_id = $userId;
      $price = 0;
      $is_public = false;
      $context = '';
    }

    // getter
    public function getId() {
      return $this->id;
    }

    public function getThumbnailPath() {
      return $this->thumbnail_path;
    }

    public function getName() {
      return $this->name;
    }

    public function getRegisteredAt() {
      return $this->registered_at;
    }

    public function getDescription() {
      return $this->description;
    }

    public function getUserId() {
      return $this->user_id;
    }

    public function getPrice() {
      return $this->price;
    }

    public function getIsPublic() {
      return $this->is_public;
    }

    // setter
    public function setThumbnailPath($thumbnail_path) {
      $this->thumbnail_path = $thumbnail_path;
    }

    public function setName($name) {
      $this->name = $name;
    }

    public function setRegisteredAt($registered_at) {
      $this->registered_at = $registered_at;
    }

    public function setDescription($description) {
      $this->description = $description;
    }

    public function setUserId($user_id) {
      $this->user_id = $user_id;
    }

    public function setPrice($price) {
      $this->price = $price;
    }

    public function setIsPublic($is_public) {
      $this->is_public = $is_public;
    }

    public function setContext($context) {
      $this->context = $context;
    }

    public function getContext() {
      return $this->context;
    }
  }
