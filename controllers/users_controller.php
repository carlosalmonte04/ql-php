<?php
  require 'vendor/autoload.php';

  use \Firebase\JWT\JWT;

  class UsersController {
    public function store() {
      $user = $this->content_to_json(file_get_contents('php://input'));

      if($user->password === $user->passwordConf) {
        $conn = Db::getInstance();
        $statement = $conn->prepare("USE heroku_96c5d443b8d5d0f;INSERT INTO users (username, password) VALUES (:username, :password);");
        $hashed_password = password_hash($user->password, PASSWORD_DEFAULT);
        var_dump($hashed_password);
        $statement->execute(array(':username' => $user->username, 'password' => $hashed_password));
        
        $key = "secure_key_that_no_one_knows";
        $token = array(
          "password" => $user,
        );
        $jwt = JWT::encode($token, $key);
        $just_logged_in = true;

        require_once('views/pages/dashboard.php');
      }
      else {
        $flash_message = "could not create user";
        $username = $user->username;
        require_once('views/users/create.php');
      }
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