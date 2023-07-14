<?php
/*Todos los mapas*/
/*
==============================================================================
CLASE QUE MAPEA... O ES UTILIZADA PARA HACER EL INTERCAMBICO CON EL CONTROLADOR
==============================================================================
  POO->
*/
class ClienteMap
{
  //var publicas para el cliente
  public $id_cliente;
  public $cedula_ruc;
  public $tipo_cliente;
  public $nombre;
  public $correo;
  public $celular;
  public $telefono;
  public $direccion;
  public $estado;
}
/*
==============================================================================
CLASE QUE MAPEA... O ES UTILIZADA PARA HACER EL INTERCAMBICO CON EL CONTROLADOR
==============================================================================
*/


/*
================================================================================
================================================================================
CLASE PARA EL INGRESAR MATERIAL
================================================================================
*/
/**
 *
 */

/**
*CLASE DE MproductoMapp, SE LA VE COMO UN OBJETO PADRE CONSUS HIJOS O SEA FUNCIONES

 */
class ProductoMap
{
  //var publicas para el mproducto
  public $id_producto;
  public $producto;
  public $descripcion;
  public $foto;
  public $id_categoria_producto;
  public $categoria_producto;
  public $codigo_producto;
  //public $direccion;
  public $estado;
  public $stock;
}
/**
*CLASE DE MproveedorMapp, SE LA VE COMO UN OBJETO PADRE CONSUS HIJOS O SEA FUNCIONES
*revisado el 2021/05/26
 */

class UsuarioMap
{
  //var publicas para el mUsuario
  public $id_usuario;
  public $usuario;
  public $nombre_usuario;
  public $clave;
  public $estado;
}
/**
*CLASE DE MSocioMapp, SE LA VE COMO UN OBJETO PADRE CONSUS HIJOS O SEA FUNCIONES
*revisado el 2021/05/26
 */

/**
 *
 * CLASE DE MATERIAL, SE LA VE CM UN OBJETO PADRE CON SUS HIJOSO FUNCIOENS
 *
 */
class CategoriaMaterialMap
{
  //var publicas para el mSocio
  public $id_categoria_material;
  public $categoria_material;
  public $estado;
}
/*CATEGORIA PRODUCTO*/

class CategoriaProductoMap
{
  public $id_categoria_producto;
  public $categoria_producto;
  public $estado;
}

/**
 *
 */
class DetalleIngresoMap
{
  public $id_temporal;
  public $id_material;
  public $id_usuario;
  public $producto;
  public $codigo_material;
  public $cantidad;
  public $valor;
  public $total;
  public $id_detalle_ingreso;
}

class PedidoMap
{
  public $id_pedido;
  public $id_cliente;
  public $fecha_entrada;
  public $fecha_salida;
  public $comentario;
  public $cantidad;
  public $estado;

}

class DetallePedidoMap
{
  public $id_temporal;
  public $id_producto;
  public $id_usuario;
  public $producto;
  public $codigo_producto;
  public $cantidad;
  public $precio;
  public $total;
  public $id_detalle_pedido;

}

?>
