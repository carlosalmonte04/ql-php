<?php

  class Db {
    private static $instance = NULL;

    private function __construct() {}

    private function __clone() {}

    public static function getInstance() {
      if (!isset(self::$instance)) {
          $dbstr = 'mysql://becae04500022e:efb33258@us-cdbr-iron-east-05.cleardb.net/heroku_96c5d443b8d5d0f?reconnect=true';
          $dbstr = substr("$dbstr", 8);
          $dbstrarruser = explode(":", $dbstr);
          $dbstrarrhost = explode("@", $dbstrarruser[1]);
          $dbstrarrrecon = explode("?", $dbstrarrhost[1]);
          $dbstrarrport = explode("/", $dbstrarrrecon[0]);
          $dbpassword = $dbstrarrhost[0];
          $dbhost = $dbstrarrport[0];
          $dbport = $dbstrarrport[0];
          $dbuser = $dbstrarruser[0];
          $dbname = $dbstrarrport[1];
          unset($dbstrarrrecon);
          unset($dbstrarrport);
          unset($dbstrarruser);
          unset($dbstrarrhost);
          unset($dbstr);
          $dbanfang = 'mysql:host=' . $dbhost . ';dbname=' . $dbname;
          var_dump($dbhost);
          echo $dbhost;
          Db::$instance = new PDO($dbanfang, $dbuser, $dbpassword);
      }
      return self::$instance;
    }
  }
?>