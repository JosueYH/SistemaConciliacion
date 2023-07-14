<!--crud de registro de Usuario-->
<?php require 'views/header.php';

if (!empty($this->mensaje)) {
  echo $this->mensaje;
}
$url = constant('URL') . "consultarusuario/buscarUsuario";

?>
<div class="card shadow mb-1">
  <div class="card-header py-3">
    <?php require "views/info/buscar.php" ?>
    <?php require 'views/info/pagination.php'; ?>

    <div class="table-responsive">
      <table class="table table-bordered order-table" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Usuario</th>
            <th>Nombre y Apellido</th>
            <th>Clave</th>
            <!--Botones de Activo, Inactivo y Suspendido-->
            <th>
              <!--Icono Activos btn btn-link d-md-none rounded-circle mr-3-->
              <a data-bs-toggle="tooltip" data-bs-placement="top" title="Solo Activos" class="btn btn-outline-success " href="<?php echo constant('URL') ?>consultarusuario/activoUsuario">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-check" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                </svg>
              </a>
            </th>
            <th>
              <!--Icono Inactivos-->
              <a data-bs-toggle="tooltip" data-bs-placement="top" title="Solo Inactivos" class="btn btn-outline-warning" href="<?php echo constant('URL') ?>consultarusuario/inactivoUsuario">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-dash" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M5.5 6.5A.5.5 0 0 1 6 6h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
                  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                </svg>

              </a>
            </th>
            <th>

              <!--Icono Suspendidos-->
              <a data-bs-toggle="tooltip" data-bs-placement="top" title="Solo Suspendido" class="btn btn-outline-danger" href="<?php echo constant('URL') ?>consultarusuario/suspendidoUsuario">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-x" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M6.146 5.146a.5.5 0 0 1 .708 0L8 6.293l1.146-1.147a.5.5 0 1 1 .708.708L8.707 7l1.147 1.146a.5.5 0 0 1-.708.708L8 7.707 6.854 8.854a.5.5 0 1 1-.708-.708L7.293 7 6.146 5.854a.5.5 0 0 1 0-.708z" />
                  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                </svg>

              </a>
              <!--Icono Global-->
            </th>
          </tr>
        </thead>
        <tbody id="tbody-usuario">

          <?php

          //inversa
          foreach ($this->usuariomap as $row) {
            $usuarios = new UsuarioMap(); //
            $usuarios = $row;
          ?>
            <tr id="fila-<?php echo $usuarios->id_usuario ?>">
              <!--REFERENCIA PADRE-->
              <td><?php echo $usuarios->usuario; ?></td>
              <td><?php echo $usuarios->nombre_usuario; ?></td>
              <td>********</td>
              <td>
                <button class="botonEliminar btn btn-outline-primary " data-idusuario="<?php echo $usuarios->id_usuario ?>" name="button" <?php
                                                                                                                                          session_start();
                                                                                                                                          if ($usuarios->id_usuario == $_SESSION['id_usuario']) {
                                                                                                                                            echo 'disabled'; //para desabilitar el boton
                                                                                                                                          }
                                                                                                                                          ?>>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                  </svg>
                </button>
              </td>
              <td>
                <a class="btn btn-outline-secondary" href="<?php echo constant('URL') . 'consultarusuario/verUsuario/' . $usuarios->id_usuario ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                  </svg>
                </a>
              </td>
            </tr>
          <?php } ?>

        </tbody>
      </table>

    </div>

  </div>
  <!--JS PARA LOS BOTONES DE ELIMINAR Marteriales-->


  <script src="<?php echo constant('URL'); ?>libs/js/boton/eliminarUsuario.js"></script>
  <script src="<?php echo constant('URL') ?>libs/js/buscar/buscarRegistro.js"></script>
  <script src="<?php echo constant('URL') ?>libs/js/pagination.js"></script>

  <?php require 'views/footer.php'; ?>
