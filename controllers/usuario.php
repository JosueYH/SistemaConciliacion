<?php

class Usuario extends Controller
{
  public $model;
  public $view;

  public function __construct()
  {
    parent::__construct();
  }

  public function render()
  {
    $this->view->render('usuario/index');
  }

  public function create()
  {
    if (empty($_POST['nombres']) && empty($_POST['direccion']) && empty($_POST['passowrd']) && empty($_POST['idcargo']) && empty($_POST['documento']) && empty($_POST['telefono']) && empty($_POST['email']) && empty($_POST['idtipo_usuario'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    //regla, y si lo retrona un true se manda el mensaje
    if ($this->model->save([
      'nombres' => $_POST['nombres'],
      'direccion' => $_POST['direccion'],
      'password' => $_POST['password'],
      'idcargo' => $_POST['idcargo'],
      'documento' => $_POST['documento'],
      'telefono' => $_POST['telefono'],
      'email' => $_POST['email'],
      'idtipo_usuario' => $_POST['idtipo_usuario'],
    ])) {
      echo json_encode(["success" => "Usuario registrado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al registrar usuario"]);
      return;
    }
  }

  public function buscarRegistro()
  {
    if ($this->model->buscarUsuario(['usuario' => $_GET['usuario']])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    } else {
      return true;
    }
  }
}
