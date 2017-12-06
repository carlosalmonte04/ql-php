<?php
  class Db {
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
      if (!isset(self::$instance)) {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        Db::$instance = new PDO('mysql://us-cdbr-iron-east-05.cleardb.net/heroku_96c5d443b8d5d0f?reconnect=true', 'becae04500022e', 'efb33258', $pdo_options);
      }
      return self::$instance;
    }
  }
?>