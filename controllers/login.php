<?php

class Login extends Controller
{
  public $model;
  public $view;

  function __construct()
  {
    parent::__construct();
  }

  function render()
  {
    error_log('Login -> render');
    $this->view->render('login/index');
  }

  function init()
  {
    if (empty($_POST['email']) && empty($_POST['passowrd'])) {
      header("Location: " . URL);
    }
    error_log('Login init');

    $user = $this->model->login(['email' => $_POST['email'], 'passowrd' => $_POST['passowrd']]);

    if ($user["email"] == $_POST["email"]) {

      if (password_verify($_POST["password"], $user["password"])) {
        session_start();
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
          <strong>Cuenta Iniciada</strong> <br>Espere unos Momentos segundo para entrar
        </div>";
      } else {
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>Datos Incorrecto</strong> Su Clave o Nombre de Usuario son Incorrectas
        </div>";
      }
    } else {
      error_log('Login failed');
      echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
        <strong>Datos Incorrecto</strong> Su Clave o Nombre de Usuario son Incorrectas
      </div>";
    }
  }

  function close()
  {
    session_unset();
    session_destroy();
    header("Location: " . URL);
  }
}
