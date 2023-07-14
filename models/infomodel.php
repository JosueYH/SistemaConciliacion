<?php

/**
*Revisado el 26/05/2021 9:15pm
*CLASE DE MATERIALMODEL, SE LA VE COMO UN OBJETO PADRE CONSUS HIJOS O SEA FUNCIONES
 *
 */
class InfoModel extends Modelo//extiende a modelo
{
   /*
    =======================================================
     Funcion constructor| Pariete::_constructor 
    =======================================================
  */
  public function __construct()
  {
    // pariente
    parent::__construct();
  }
 /*
    =======================================================
     Funcion actualizar | realizara el cambio de clave
    =======================================================
  */  public function nuevaClave($datos)
  {
    //consulta

    $consulta=$this->db->connect()->prepare("UPDATE usuario SET clave=:clave WHERE id_usuario=:id_usuario");//actualizar
    try {
      $consulta->execute(['clave'=>$datos['clave'],'id_usuario'=>$datos['id_usuario']]);
      return true;//retornamostrue para que mande una accion
    } catch (PDOException $e) {
      return false;//etornamos false para idnicar errores
    }
  }
}


 ?>
