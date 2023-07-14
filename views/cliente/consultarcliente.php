
<?php
  /*
  ====================================================================================
  VISTA DE CLIENTE EN CONSULTAR CLIENTE...
  ====================================================================================

  */
  require 'views/header.php';
  $url = constant('URL') . "consultarcliente/buscarCliente";//es para tener una accion en la hoja buscar.php

?>

<!--READ, DELETE de registro de cliente-->
<div class="card shadow mb-1">
  <div class="card-header py-3">
    <!--diseño de encabezado!-->
    <?php require "views/info/buscar.php"; ?>
    <?php require "views/info/pagination.php"; ?>

    <div class="table-responsive">
      <table class="table table-bordered order-table" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <!--Campos-->
            <th>Cédula/Ruc</th>
            <th>Tipo Persona</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Celular</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <!--Funciones de Clasificacion (Vistas)-->
            <!--Icono Activos btn btn-link d-md-none rounded-circle mr-3-->
            <th>
              <a data-bs-toggle="tooltip" data-bs-placement="top" title="Solo Activos" class="btn btn-outline-success " href="<?php echo constant('URL') ?>consultarcliente/activoCliente">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-check" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                </svg>
              </a>
            </th>
            <!--Icono Inactivos-->
            <th>
              <a data-bs-toggle="tooltip" data-bs-placement="top" title="Solo Inactivos" class="btn btn-outline-warning" href="<?php echo constant('URL') ?>consultarcliente/inactivoCliente">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-dash" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M5.5 6.5A.5.5 0 0 1 6 6h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
                  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                </svg>
              </a>
            </th>
            <!--Icono Suspendidos-->
            <th>
              <a data-bs-toggle="tooltip" data-bs-placement="top" title="Solo Suspendido" class="btn btn-outline-danger" href="<?php echo constant('URL') ?>consultarcliente/suspendidoCliente">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-x" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M6.146 5.146a.5.5 0 0 1 .708 0L8 6.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 7l1.147 1.146a.5.5 0 0 1-.708.708L8 7.707 6.854 8.854a.5.5 0 1 1-.708-.708L7.293 7 6.146 5.854a.5.5 0 0 1 0-.708z" />
                  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                </svg>
              </a>
            </th>
          </tr>
          <!--Fin Campos... y Funciones
            =============================================================================================================
            =============================================================================================================
            =============================================================================================================
          -->
        </thead>
        <!--Cuerpo de la Tabla-->
        <tbody id="tbody-cliente">
          <?php
          //For Each para estraer el mapa de cliente
          foreach ($this->clientemap as $row) {//este cliente map... viene llenado del control... pasa a $row
            $clientes = new ClienteMap(); //objeto
            $clientes = $row;//sucesor
          ?>
            <tr id="fila-<?php echo $clientes->id_cliente; ?>"><!--Cada tr que salga, sera con un id de su respectivo registro-->
              <!--Campos...O Extraccion de Campos del objeto clientes-->
              <td><?php echo $clientes->cedula_ruc; ?></td>
              <td><?php echo $clientes->tipo_cliente; ?></td>
              <td><?php echo $clientes->nombre; ?></td>
              <td><?php echo $clientes->correo; ?></td>
              <td><?php echo $clientes->celular; ?></td>
              <td><?php echo $clientes->telefono; ?></td>
              <!--campo de direccion-->
              <td>
                <textarea name="name" disabled rows="2" cols="15"><?php echo $clientes->direccion; ?></textarea>
              </td>
              <!--Funcion de Elminar-->
              <td>
                <button data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar Este Registro" class="botonEliminar btn btn-outline-primary col-12 " data-idcliente="<?php echo $clientes->id_cliente; ?>" name="button">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                  </svg>
                </button>
              </td>
              <!--Funcion de Actualizar-->
              <td>
                <a data-bs-toggle="tooltip" data-bs-placement="top" title="Actualizar Este Registro" class="btn btn-outline-secondary col-12" href="<?php echo constant('URL') . 'consultarcliente/verCliente/' . $clientes->id_cliente; ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                  </svg>
                </a>
              </td>
            </tr>
            <!--Fin de los campos-->
          <?php }//fin foreach ?>
        </tbody>
      </table><!--Fin Tabla-->
    </div>
  </div>
  <!--JS PARA LOS BOTONES DE ELIMINAR Clientes-->
  <script src="<?php echo constant('URL'); ?>libs/js/boton/eliminarCliente.js"></script>
  <!--JS PARA Buscar Clientes-->
  <script src="<?php echo constant('URL') ?>libs/js/buscar/buscarRegistro.js"></script>
  <!--Scrip pagination-->
  <script src="<?php echo constant('URL') ?>libs/js/pagination.js"></script>

<?php require 'views/footer.php'; ?>
