<?php
/*
===============================================================================
Modelo de Cliente... Se extiende a modelo, para estraer estraer funciones
===============================================================================
*/
class ClienteModel extends Modelo
{
  public function __construct()
  {
    parent::__construct();
  }
  
  /*
    ================================================================================
     Funcion para insertar un nuevo cliente si este no se encuantra registrado
    ================================================================================
  */
  public function insertarCliente($datos){
    //INSERT INTO Cliente (id_cliente_proveedor,producto,stock,valor,medida,estado)
    //VALUES ('1','sss','5','120.22','ki','activo')
    $consulta=$this->db->connect()->prepare("INSERT INTO cliente (cedula_ruc,tipo_cliente,nombre,correo,celular,telefono,direccion)VALUES (:cedula_ruc,:tipo_cliente,:nombre,:correo,:celular,:telefono,:direccion)");
    try {
      //variable para alamcenar el query, cojiendo el nombre d ela base de datos y utilizacndo la funcion connect()
      //interna no por default, y preparamos el codigo sql
      //executamos e indicamosque va con quien
      $consulta->execute(['cedula_ruc'=>$datos['cedula_ruc'],'tipo_cliente'=>$datos['tipo_cliente'],'nombre'=>$datos['nombre'],'correo'=>$datos['correo'] ,'celular'=>$datos['celular'],'telefono'=>$datos['telefono'],'direccion'=>$datos['direccion']]);
      //return cuando sea afirmativa, caso que no
      return true;
    } catch (PDOException $e) {
      //mostramos el false
      return false;
    }
  }
  /*============================================================================
  FUNCION PARA BUSCAR Y EVITAR QUE EL USUARIO INGRESE UN REGISTRO
    ============================================================================
  */
  public function buscarCliente($datos)
  {
    $consulta=$this->db->connect()->prepare("SELECT * FROM cliente WHERE cedula_ruc=:cedula_ruc AND estado='activo'");
    try {
      $consulta->execute(['cedula_ruc'=>$datos['cedula_ruc']]);
      if ($row=$consulta->fetch()) {
        // code...
        return true;
      }
    } catch (PDOException $e) {
      return false;
    }
  }
}
?>
