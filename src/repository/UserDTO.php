<?php

class UserDTO {
    private $userId;
    private $email;
    private $passwordHash;
    private $name;
    private $registeredAt;
    private $isPublic;
    private $description;

    public function __construct($userId) {
        $this->userId = $userId;
    }

    public function getId() {
        return $this->userId;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPasswordHash() {
        return $this->passwordHash;
    }

    public function setPasswordHash($passwordHash) {
        $this->passwordHash = $passwordHash;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getRegisteredAt() {
        return $this->registeredAt;
    }

    public function setRegisteredAt($registeredAt) {
        $this->registeredAt = $registeredAt;
    }

    public function getIsPublic() {
        return $this->isPublic;
    }

    public function setIsPublic($isPublic) {
        $this->isPublic = $isPublic;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }
}
?>