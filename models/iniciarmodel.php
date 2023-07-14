<?php

class IniciarModel extends Modelo
{
  public function __construct()
  {
    parent::__construct();
  }

  public function iniciarCuenta($datos)
  {
    $consulta = $this->db->connect()->prepare("SELECT * FROM usuario WHERE usuario=:usuario AND clave=:clave AND estado='activo'");
    try {
      //ejecutamos en orden
      $consulta->execute(['usuario' => $datos['usuario'], 'clave' => $datos['clave']]);
      while ($row = $consulta->fetch()) { //estraemos lo encontrado
        session_start(); //abrumos
        $_SESSION['id_usuario'] = $row['id_usuario']; //alamcenamos en $_SESSION['']
        $_SESSION['nombre_usuario'] = $row['nombre_usuario']; //alamcenamos en $_SESSION['']
        $_SESSION['usuario'] = $row['usuario']; //alamcenamos en $_SESSION['']
        $_SESSION['clave'] = $row['clave']; //alamcenamos en $_SESSION['']
      }
      return true; //retornamos en cuenta->if(true){...}
    } catch (PDOException $e) {
      return false; //retornamos en cuenta->if(false){...}
    }
  }
  //excelente
  public function salirCuenta($id)
  {
    //retornamos false
    return true;
  }
}
