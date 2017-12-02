<?php
  class User {
    // we define 3 attributes
    // they are public so that we can access them using $post->username directly
    public $id;
    public $username;
    public $password;

    public function __construct($id, $username, $password, $role = 'read-only') {
      $this->id   = $id;
      $this->username   = $username;
      $this->password = $password;
    }

    public static function all() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM energy_consumptions');

      // we create a list of Post objects from the database results
      foreach($req->fetchAll() as $user) {
        $list[] = new User($user['id'], $user['username'], $user['password']);
      }

      return $list;
    }

    public static function find($id) {
      $db = Db::getInstance();
      // we make sure $id is an integer
      $id = intval($id);
      $req = $db->prepare('SELECT * FROM energy_consumptions WHERE id = :id');
      // the query was prepared, now we replace :id with our actual $id value
      $req->execute(array('id' => $id));
      $user = $req->fetch();

      return new User($user['id'], $user['username'], $user['password']);
    }
  }
?>