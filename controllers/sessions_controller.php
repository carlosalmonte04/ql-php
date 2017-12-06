<?php
  require 'vendor/autoload.php';

  use \Firebase\JWT\JWT;

  class SessionsController {

    public function create() {
      require_once('views/sessions/create.php');
    }

    public function store() {
      $conn = Db::getInstance();
      $content = $this->content_to_obj(file_get_contents('php://input'));
      var_dump($content);
      $user->username = $content[0];
      $user->password = $content[1];
      var_dump($user);
      $statement = $conn->prepare("USE heroku_96c5d443b8d5d0f;SELECT username, password FROM users WHERE username=:username;");
      $statement->execute(array(':username' => $content->username));
      $user = $statement->fetchAll()[0];
      var_dump($user);
      if ($user && password_verify($content->password, $user['password'])) {
        $key = "secure_key_that_no_one_knows";
        $token = array(
          "password" => $user,
        );
        $jwt = JWT::encode($token, $key);
        $just_logged_in = true;
        require_once('views/pages/dashboard.php');
      }
      else {
        $flash_message = "error while login in. Try Again.";
        require_once('views/sessions/create.php');
      }
      // $decoded = JWT::decode($jwt, $key, array('HS256'));
      // we store all the posts in a variable
    }

    public function show() {
      // we expect a url of form ?controller=posts&action=show&id=x
      // without an id we just redirect to the error page as we need the post id to find it in the database
      if (!isset($_GET['id']))
        return call('pages', 'error');

      // we use the given id to get the right post
      $energyConsumption = EnergyConsumption::find($_GET['id']);
      require_once('views/energy_consumptions/show.php');
    }

    private function content_to_obj($content) {
      $content_array = preg_split("/[\s,=,&]+/", $content);
      $obj = new stdClass();

      for ($i = 0; $i < count($content_array) - 1; $i += 2) { 
        $obj->$content_array[$i] = $content_array[$i + 1];
      }
      return $obj;
    }
  }

?>

