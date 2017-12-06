<?php
  include_once('connection.php');
  class UsersController {
    public function store() {
      var_dump(file_get_contents('php://input'));
      $user = $this->content_to_json(file_get_contents('php://input'));

      if($user->password === $user->passwordConf) {
        $conn = Db::getInstance();
        $statement = $conn->prepare("CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(200) DEFAULT 'read-only',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `username_index` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1");
        $hashed_password = password_hash($user->password, PASSWORD_DEFAULT);
        
        $statement->execute(array(':username' => $user->username, 'password' => $hashed_password));

      }
      require_once('views/pages/users.php');
    }

    public function create() {
      require_once('views/users/create.php');
    }

    private function content_to_json($content) {
      $content_array = preg_split("/[\s,=,&]+/", $content);
      $obj = new stdClass();

      for ($i = 0; $i < count($content_array) - 1; $i += 2) { 
        $obj->$content_array[$i] = $content_array[$i + 1];
      }
      return $obj;
    }
  }
?>