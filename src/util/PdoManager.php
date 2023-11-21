<?php
class PdoManager {
  private static $pdo = null;

  private function __construct() {}

  public static function getPdo() {
    if (self::$pdo === null) {
      $config = yaml_parse_file('../../seiran_dbconfig.yaml');
      $dsn = 'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'];
      $username = $config['user'];
      $password = $config['pass'];
      self::$pdo = new PDO($dsn, $username, $password);
    }
    return self::$pdo;
  }
}
?>
