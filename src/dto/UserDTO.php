<?php
class UserDTO {
    private $id;
    private $email;
    private $passwordHash;
    private $name;
    private $registeredAt;
    private $isPublic;
    private $description;

    public function __construct($id, $email, $passwordHash, $name, $registeredAt) {
        $this->id = $id;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->name = $name;
        $this->registeredAt = $registeredAt;
    }

    // getter
    public function getId()
    {
        return $this->id;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPasswordHash()
    {
        return $this->passwordHash;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getRegisteredAt()
    {
        return $this->registeredAt;
    }
    public function getIsPublic()
    {
        return $this->isPublic;
    }
    public function getDescription()
    {
        return $this->description;
    }

    // setter
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setPasswordHash($passwordHash) {
        $this->passwordHash = $passwordHash;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function setRegisteredAt($registeredAt) {
        $this->registeredAt = $registeredAt;
    }
    public function setIsPublic($isPublic) {
        $this->isPublic = $isPublic;
    }
    public function setDescription($description) {
        $this->description = $description;
    }
}
