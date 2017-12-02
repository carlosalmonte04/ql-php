<?php
  class Db {
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
      if (!isset(self::$instance)) {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        Db::$instance = new PDO('mysql:host=127.0.0.1;dbname=ql', 'root', '', $pdo_options);
      }
      return self::$instance;
    }
  }
?>