<?php
class FollowDTO {
  private $followee_id;
  private $follower_id;

  public function __construct($followee_id, $follower_id) {
    $this->followee_id = $followee_id;
    $this->follower_id = $follower_id;
  }

  public function getFolloweeId() {
    return $this->followee_id;
  }
  public function getFollowerId() {
    return $this->follower_id;
  }
}
?>
