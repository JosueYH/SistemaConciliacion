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
    $this->view->render('usuario/index', [
      "tipos" => $this->getTipos(),
      "cargos" => $this->getCargos(),
    ]);
  }

  public function index()
  {
    $data = [];
    $users = $this->model->getAll();
    if (count($users) > 0) {
      foreach ($users as $user) {
        // if ($user["idtipo_usuario"] == 1) continue;

        $botones = "<button class='btn btn-warning edit' id='{$user["id"]}'><i class='fas fa-pencil-alt'></i></button>";
        $botones .= "<button class='ml-1 btn btn-danger delete' id='{$user["id"]}'><i class='fas fa-times'></i></button>";

        $class = "success";
        $txt = "Activo";
        if ($user["estado"] === "0") {
          $class = "danger";
          $txt = "Inactivo";
        }
        $estado = "<span class='badge badge-$class text-uppercase font-weight-bold cursor-pointer delete' id='{$user["id"]}' style='font-size:12px'>$txt</span>";

        if ($user["idtipo_usuario"] === "1") {
          $tipo = "Cliente";
        } else if ($user["idtipo_usuario"] === "3" && $user["estado"] === "2") {
          $tipo = "Vendedor <button class='btn btn-success activate_seller' id='{$user["id"]}'><i class='fa fa-check'></i></button>";
        } else {
          $tipo = "Vendedor";
        }

        $data[] = [
          $user["id"],
          $user["documento"],
          $user["nombres"],
          $user["email"],
          $user["telefono"],
          $estado,
          $tipo,
          $botones,
        ];
      }
    }

    echo json_encode(["data" => $data]);
  }

  public function create()
  {
    if (empty($_POST['nombres']) || empty($_POST['direccion']) || empty($_POST['password']) || empty($_POST['tipoCargo']) || empty($_POST['documento']) || empty($_POST['telefono']) || empty($_POST['email']) || empty($_POST['tipoUsuario'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    if ($this->model->save([
      'nombres' => $_POST['nombres'],
      'direccion' => $_POST['direccion'],
      'password' => password_hash($_POST['password'], PASSWORD_DEFAULT, ["cost" => 10]),
      'idcargo' => $_POST['tipoCargo'],
      'documento' => $_POST['documento'],
      'telefono' => $_POST['telefono'],
      'email' => $_POST['email'],
      'idtipo_usuario' => $_POST['tipoUsuario'],
    ])) {
      echo json_encode(["success" => "Usuario registrado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al registrar usuario"]);
      return;
    }
  }

  public function get()
  {
    if (empty($_POST['id'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    $user = $this->model->get($_POST['id']);
    if ($user) {
      unset($user["password"]);
      echo json_encode(["success" => "Usuario encontrado", "user" => $user]);
      return;
    } else {
      echo json_encode(["error" => "Error al buscar usuario"]);
      return;
    }
  }

  public function edit()
  {
    if (empty($_POST['id']) || empty($_POST['nombres']) || empty($_POST['direccion']) || empty($_POST['tipoCargo']) || empty($_POST['documento']) || empty($_POST['telefono']) || empty($_POST['email']) || empty($_POST['tipoUsuario'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    if ($this->model->update([
      'nombres' => $_POST['nombres'],
      'direccion' => $_POST['direccion'],
      'idcargo' => $_POST['tipoCargo'],
      'documento' => $_POST['documento'],
      'telefono' => $_POST['telefono'],
      'email' => $_POST['email'],
      'idtipo_usuario' => $_POST['tipoUsuario'],
    ], $_POST['id'])) {
      if (!empty($_POST['password']))
        $this->model->update([
          'password' => password_hash($_POST['password'], PASSWORD_DEFAULT, ["cost" => 10])
        ], $_POST['id']);

      echo json_encode(["success" => "Usuario actualizado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al actualizar usuario"]);
      return;
    }
  }

  public function delete()
  {
    if (empty($_POST['id'])) {
      echo json_encode(["error" => "Faltan parametros"]);
      return;
    }

    if ($this->model->delete($_POST['id'])) {
      echo json_encode(["success" => "Usuario eliminado"]);
      return;
    } else {
      echo json_encode(["error" => "Error al eliminar usuario"]);
      return;
    }
  }

  public function getTipos()
  {
    require_once 'models/usuarioTiposModel.php';
    $tipos = new UsuarioTiposModel();
    return $tipos->getAll();
  }

  public function getCargos()
  {
    require_once 'models/cargoModel.php';
    $tipos = new CargoModel();
    return $tipos->getAll();
  }
}
