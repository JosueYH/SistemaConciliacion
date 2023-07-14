<?php
/*
===============================================================================
Modelo de ConsultarCliente... Se extiende a modelo, para estraer estraer funciones
===============================================================================
*/
include_once 'models/mapas.php';//mapeo y ovjeto cliente

class ConsultarClienteModel extends Modelo //nos estnendemos al modelo de libs/model
{
//consructor
  public function __construct()
  {
    // pariente
    parent::__construct();
  }
  /*
    =======================================================================================
     Funcion darcliente sin parametros y arreglo vacios para hacer una consulta en cliente
    =======================================================================================
  */
  //funcion darcliente sin parametros
  public function darCliente()
  {
    $items=[];//arreglovacio
    //si funciona
    try {
      $consulta=$this->db->connect()->query("SELECT *  FROM cliente WHERE estado='activo' ORDER BY nombre ASC");//consulta sencilla
      while ($row=$consulta->fetch()) {//while, la fila que contiene al array que tare el fetch al vincularse con la consulta
        $item= new ClienteMap();//objeto
        //valores del array<-$row
        $item->id_cliente=$row['id_cliente'];//propiedades
        $item->tipo_cliente=$row['tipo_cliente'];
        $item->cedula_ruc=$row['cedula_ruc'];
        $item->nombre=$row['nombre'];
        $item->correo=$row['correo'];
        $item->celular=$row['celular'];
        $item->telefono=$row['telefono'];
        $item->direccion=$row['direccion'];
        $item->estado=$row['estado'];
        //ingresar en un arreglo un nuevo valor
        array_push($items,$item);//
      }
      return $items;//sifunciona
    } catch (PDOException $e) {//excepciones pero de PDO
      return [];//nofunciona
    }
  }
  /*
    ========================================================================================================
     Funcion para hallarCliente con arreglos vacios | una vez hecha la consulta los encuentra y los muestra
    ========================================================================================================
  */

  public function hallarCliente($datos)
  {
    $buscar=$datos['buscar'];
    $items=[];//arreglovacio
    //si funciona
    try {
      $consulta=$this->db->connect()->query(
        "SELECT *
        FROM cliente
        WHERE estado!='eliminado'
        AND (cedula_ruc LIKE '%$buscar%'
        OR tipo_cliente LIKE '%$buscar%'
        OR nombre LIKE '%$buscar%'
        OR correo LIKE '%$buscar%'
        OR celular LIKE '%$buscar%'
        OR telefono LIKE '%$buscar%'
        OR direccion LIKE '%$buscar%') ORDER BY nombre ASC");//consulta sencilla
      while ($row=$consulta->fetch()) {//while, la fila que contiene al array que tare el fetch al vincularse con la consulta
        $item= new ClienteMap();//objeto
        //$item= new ClienteMap();//objeto
        $item->id_cliente=$row['id_cliente'];//propiedades
        $item->tipo_cliente=$row['tipo_cliente'];
        $item->cedula_ruc=$row['cedula_ruc'];
        $item->nombre=$row['nombre'];
        $item->correo=$row['correo'];
        $item->celular=$row['celular'];
        $item->telefono=$row['telefono'];
        $item->direccion=$row['direccion'];
        $item->estado=$row['estado'];
        //ingresar en un arreglo un nuevo valor
        array_push($items,$item);//
      }
      return $items;//sifunciona
    } catch (PDOException $e) {//excepciones pero de PDO
      return [];//nofunciona
    }
  }
/*
    =========================================================
     Funcion con parametros para da run cliente especifico
    =========================================================
*/


  public function darPorId($id)
  {
    $item= new ClienteMap();//objeto
    $consulta=$this->db->connect()->prepare("SELECT *  FROM cliente WHERE id_cliente=:id_cliente");//consulta
    try {
      $consulta->execute(['id_cliente'=>$id]);//execucion
      //recorrer resultado
      while ($row=$consulta->fetch()) {
        $item->id_cliente=$row['id_cliente'];//propiedades
        $item->cedula_ruc=$row['cedula_ruc'];
        $item->tipo_cliente=$row['tipo_cliente'];
        $item->nombre=$row['nombre'];
        $item->correo=$row['correo'];
        $item->celular=$row['celular'];
        $item->telefono=$row['telefono'];
        $item->direccion=$row['direccion'];
        $item->estado=$row['estado'];
        // regresar objeto
        return $item;
      }
    } catch (PDOException $e) {//caso que nofuncione
      return null;//returnamos null
    }
  }
  /*
    =========================================================
     Funcion para actualizar con parametros (Array)
    =========================================================
  */

  
  public function update($item)//parametro del item(contiene los POST nuevos), un array
  {
    //ACA buscamos una cedula igual

    $consulta=$this->db->connect()->prepare("SELECT id_cliente FROM cliente WHERE id_cliente!=:id_cliente AND cedula_ruc=:cedula_ruc AND estado=:estado");
    try {
      $consulta->execute(['cedula_ruc'=>$item['cedula_ruc'],'id_cliente'=>$item['id_cliente'],'estado'=>$item['estado']]);
      //ifelse
      if ($row=$consulta->fetch()) {
        //actualizar el existente
        $id_cliente=$row['id_cliente'];//id
        //consulta
        $consulta=$this->db->connect()->prepare("UPDATE cliente SET tipo_cliente=:tipo_cliente,nombre=:nombre,correo=:correo,celular=:celular,telefono=:telefono,direccion=:direccion,estado=:estado WHERE id_cliente='$id_cliente'");//actualizar
        try {
          $consulta->execute(['tipo_cliente'=>$item['tipo_cliente'],'nombre'=>$item['nombre'],'correo'=>$item['correo'],'celular'=>$item['celular'],'telefono'=>$item['telefono'],'direccion'=>$item['direccion'],'estado'=>$item['estado']]);//executamos
          //return en true
          if ($this->delete($item['id_cliente'])) {//eliminar el que se repitio
              //return en true
              return true;
          }
        } catch (PDOException $e) {
          //retornamos falso
          return false;
        }
      }else{
        //consulta
        $consulta=$this->db->connect()->prepare("UPDATE cliente SET tipo_cliente=:tipo_cliente,cedula_ruc=:cedula_ruc,nombre=:nombre,correo=:correo,celular=:celular,telefono=:telefono,direccion=:direccion,estado=:estado WHERE id_cliente=:id_cliente");//actualizar
        try {
          $consulta->execute(['id_cliente'=>$item['id_cliente'],'tipo_cliente'=>$item['tipo_cliente'],'cedula_ruc'=>$item['cedula_ruc'],'nombre'=>$item['nombre'],'correo'=>$item['correo'],'celular'=>$item['celular'],'telefono'=>$item['telefono'],'direccion'=>$item['direccion'],'estado'=>$item['estado']]);
          return true;//retornamostrue para que mande una accion
        } catch (PDOException $e) {
          return false;//etornamos false para idnicar errores
        }
      }
    } catch (PDOException $e) {
      return false;
    }
  }
  /*
    ==================================================================
     Funcion con parametros para da Eliminar un cliente especifico
    ==================================================================
*/

  //delete
  public function delete($id)//parametro
  {
    //eliminar
    $consulta=$this->db->connect()->prepare("UPDATE cliente SET estado='eliminado' WHERE id_cliente=:id_cliente");//actualizar
    try {
      $consulta->execute(['id_cliente'=>$id]);
      return true;//retornamos
    } catch (PDOException $e) {
      return false;//retornamos
    }
  }

  /*
    ==========================================================================================
     Funcion sin parametros que mostrara el estado del cliente mediante una consulta sencilla
    ==========================================================================================
*/

  //funcion darCliente sin parametros
  public function estadoCliente($estado)
  {
    $items=[];//arreglovacio
    //si funciona
    $consulta=$this->db->connect()->prepare("SELECT * FROM cliente WHERE estado=:estado ORDER BY nombre ASC");//consulta sencilla
    try {
      $consulta->execute(['estado'=>$estado]);

      while ($row=$consulta->fetch()) {//while, la fila que contiene al array que tare el fetch al vincularse con la consulta
        $item= new ClienteMap();//objeto
        //valores del array<-$row
        $item->id_cliente=$row['id_cliente'];//propiedades
        $item->cedula_ruc=$row['cedula_ruc'];
        $item->tipo_cliente=$row['tipo_cliente'];
        $item->nombre=$row['nombre'];
        $item->correo=$row['correo'];
        $item->celular=$row['celular'];
        $item->telefono=$row['telefono'];
        $item->direccion=$row['direccion'];
        $item->estado=$row['estado'];
        //ingresar en un arreglo un nuevo valor
        array_push($items,$item);//
      }
      return $items;//sifunciona
    } catch (PDOException $e) {//excepciones pero de PDO
      return [];//nofunciona
    }
  }
}
 ?>
