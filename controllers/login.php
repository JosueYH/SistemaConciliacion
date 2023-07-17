<?php

class Login extends Controller
{
  public $model;
  public $view;

  public function __construct()
  {
    parent::__construct();
  }

  public function render()
  {
    $this->view->render('login/index', ["message" => 'vacio']);
  }

  public function auth()
  {
    if (empty($_POST['email']) || empty($_POST['password'])) {
      $this->view->render('login/index', [
        "message" => "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>Complete sus datos</strong>
        </div>"
      ]);
      return;
    }

    $user = $this->model->login($_POST['email']);

    if (isset($user['email']) && ($user["email"] == $_POST["email"])) {
      if (password_verify($_POST["password"], $user["password"])) {
        $_SESSION['session'] = 'init';
        header("Location: " . URL);
      } else {
        $this->view->render('login/index', [
          "message" => "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Contraseña no valida</strong>
          </div>"
        ]);
      }
    } else {
      $this->view->render('login/index', [
        "message" => "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>Correo no valido</strong>
        </div>"
      ]);
    }
  }

  public function close()
  {
    session_unset();
    session_destroy();
    header("Location: " . URL);
  }
}
