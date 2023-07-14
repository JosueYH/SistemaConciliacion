<?php
//referencia
include_once 'models/mapas.php';//mapeo y ovjeto usuario
/**
*CLASE DE PRODUCTO, SE LA VE COMO UN OBJETO PADRE CONSUS HIJOS O SEA FUNCIONES
 *revisado el 2021/05/26
 */
class ConsultarUsuarioModel extends Modelo //nos estnendemos al modelo de libs/model
{

 /*
    =======================================================
     Funcion dconstructor| Pariete::_constructor 
    =======================================================
  */
 public function __construct()
  {
    // pariente
    parent::__construct();
  }
/*
    =======================================================
     Funcion darUsuario sin parametros | Arreglo Vacios
    =======================================================
  */  public function darUsuario()
  {
    $items=[];//arreglovacio
    //si funciona
    try {
      $consulta=$this->db->connect()->query("SELECT * FROM usuario WHERE estado='activo'");//consulta sencilla
      while ($row=$consulta->fetch()) {//while, la fila que contiene al array que tare el fetch al vincularse con la consulta
        $item= new UsuarioMap();//objeto
        //valores del array<-$row
        $item->id_usuario=$row['id_usuario'];//propiedades
        $item->usuario=$row['usuario'];
        $item->nombre_usuario=$row['nombre_usuario'];
        $item->clave=$row['clave'];
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
  ==========================================
   Funcion hallarUsuario sin parametros 
  ==========================================
*/
  public function hallarUsuario($datos)
  {
    $buscar=$datos['buscar'];
    $items=[];//arreglovacio
    //si funciona
    try {
      $consulta=$this->db->connect()->query(
        "SELECT *
        FROM usuario
        WHERE estado!='eliminado'
        AND (usuario LIKE '%$buscar%'
        OR nombre_usuario LIKE '%$buscar%')");//consulta sencilla
      while ($row=$consulta->fetch()) {//while, la fila que contiene al array que tare el fetch al vincularse con la consulta
        $item= new UsuarioMap();//objeto
        //$item= new UsuarioMap();//objeto

        $item->id_usuario=$row['id_usuario'];//propiedades
        $item->usuario=$row['usuario'];
        $item->nombre_usuario=$row['nombre_usuario'];
        $item->clave=$row['clave'];
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
    =================================================================
     Funcion que mostrara el registro con su ID antes de Actualizar 
    =================================================================
  */
  public function darPorId($id)
  {
    $item= new UsuarioMap();//objeto
    $consulta=$this->db->connect()->prepare("SELECT * FROM usuario WHERE id_usuario=:id_usuario");//consulta
    try {
      $consulta->execute(['id_usuario'=>$id]);//execucion
      //recorrer resultado
      while ($row=$consulta->fetch()) {
        $item->id_usuario=$row['id_usuario'];//propiedades se las pasa
        $item->usuario=$row['usuario'];
        $item->nombre_usuario=$row['nombre_usuario'];
        $item->clave=$row['clave'];
        $item->estado=$row['estado'];
        // regresar objeto
        return $item;
      }
    } catch (PDOException $e) {//caso que nofuncione
      return null;//returnamos null
    }
  }
  /*
    ====================================================================
     Funcion que actualizara  la tabla | hara la busqueda de el ID
    ====================================================================
  */
  public function update($item)//parametro del item(contiene los POST nuevos), un array
  {

    //buscamos una cedula igual
    $consulta=$this->db->connect()->prepare("SELECT id_usuario FROM usuario WHERE usuario=:usuario AND estado=:estado AND id_usuario!=:id_usuario");
    try {
      $consulta->execute(['usuario'=>$item['usuario'],'estado'=>$item['estado'],'id_usuario'=>$item['id_usuario']]);
      //ifelse
      if ($row=$consulta->fetch()) {
        // code...
        $id_usuario=$row['id_usuario'];//id
        $consulta=$this->db->connect()->prepare("UPDATE usuario SET nombre_usuario=:nombre_usuario,clave=:clave,estado=:estado WHERE id_usuario='$id_usuario'");//actualizar
        //
        try {
          $consulta->execute(['nombre_usuario'=>$item['nombre_usuario'],'clave'=>$item['clave'],'estado'=>$item['estado']]);//executamos
          //return en true
          if ($this->delete($item['id_usuario'])) {
              //return en true
              return true;
          }
        } catch (PDOException $e) {
          //retornamos falso
          return false;
        }
      }else{

      //Consulta
      $consulta=$this->db->connect()->prepare("UPDATE usuario SET usuario=:usuario,nombre_usuario=:nombre_usuario,clave=:clave,estado=:estado WHERE id_usuario=:id_usuario");//actualizar
      try {
        $consulta->execute(['id_usuario'=>$item['id_usuario'],'usuario'=>$item['usuario'],'nombre_usuario'=>$item['nombre_usuario'],'clave'=>$item['clave'],'estado'=>$item['estado']]);
        return true;//retornamostrue para que mande una accion
      } catch (PDOException $e) {
        return false;//etornamos false para idnicar errores
      }
    }
  }catch (PDOException $e) {
    return false;
  }
}
  /*
    =========================================================================================
     Funcion Delete que Eliminara  la tabla por su ID | CONTIENE PARAMETRO (id)
    =========================================================================================
  */
  public function delete($id)//parametro
  {
    //cambiado...
    $consulta=$this->db->connect()->prepare("UPDATE usuario SET estado='eliminado' WHERE id_usuario=:id_usuario");//actualizar
    try {
      $consulta->execute(['id_usuario'=>$id]);
      return true;//retornamos
    } catch (PDOException $e) {
      return false;//retronamos
    }
    /*
    ===============================
      Antiguo codigo
    =============================== 

    $consulta=$this->db->connect()->prepare("DELETE FROM usuario  WHERE id_usuario=:id_usuario");//actualizar
    try {
      $consulta->execute(['id_usuario'=>$id]);

      return true;//retornamos
    } catch (PDOException $e) {
      return false;//retronamos
    }
    */

  }
   /*
    =========================================================================================
     Funcion darUsuario sin parametros | y muestra el estado del Usuario
    =========================================================================================
  */
  
  public function estadoUsuario($estado)
  {
    $items=[];//arreglovacio
    //si funciona
    $consulta=$this->db->connect()->prepare("SELECT * FROM usuario WHERE estado=:estado");//consulta sencilla
    try {
      $consulta->execute(['estado'=>$estado]);

      while ($row=$consulta->fetch()) {//while, la fila que contiene al array que tare el fetch al vincularse con la consulta
        $item= new UsuarioMap();//objeto
        //$item= new UsuarioMap();//objeto

        //valores del array<-$row
        $item->id_usuario=$row['id_usuario'];//propiedades
        $item->usuario=$row['usuario'];
        $item->nombre_usuario=$row['nombre_usuario'];
        $item->clave=$row['clave'];
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
