<?php require 'views/header.php'; ?>

<!-- DataTables -->
<link rel="stylesheet" href="<?= URL ?>dist/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= URL ?>dist/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= URL ?>dist/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Mantenimiento de Usuarios</h1>
        </div>
        <div class="col-sm-6">
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <button id="new_usuario" class="btn btn-primary" data-toggle="modal" data-target="#modal_usuarios">
                <i class="fas fa-plus"></i> Añadir Usuario</button>
            </div>

            <div class="card-body">
              <table id="table_usuario" class="table table-bordered table-hover w-100">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Documento</th>
                    <th>Nombres</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Estado</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="modal_usuarios" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Formulario de Usuario</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" id="form_usuarios" novalidate>
              <input type="hidden" id="accion" value="create">
              <input type="hidden" id="id">
              <div class="row">
                <div class="col-md-4">
                  <div class="mb-3">
                    <label class="form-label" for="documento">Documento</label>
                    <input type="text" class="form-control" id="documento" placeholder="12345678" required pattern="[0-9]+">
                    <div class="invalid-feedback">Ingrese Documento</div>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="mb-3">
                    <label class="form-label" for="nombres">Nombres</label>
                    <input type="text" class="form-control" id="nombres" placeholder="Nombres y Appellidos" required pattern="[a-zA-ZáéíóúÁÉÍÓÚÑñ ]+">
                    <div class="invalid-feedback">Ingrese Nombres y Appellidos</div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="email">Correo</label>
                    <input type="email" class="form-control" id="email" placeholder="correo@correo.com" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}">
                    <div class="invalid-feedback">Ingrese Correo</div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="password">Contraseña</label>
                    <input type="password" class="form-control" id="password" placeholder="Contraseña" required>
                    <div class="invalid-feedback">Ingrese Contraseña</div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="telefono">Telefono</label>
                    <input type="tel" class="form-control" id="telefono" placeholder="987654321" required pattern="[0-9]+">
                    <div class="invalid-feedback">Ingrese Teléfono</div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="direccion">Dirección</label>
                    <input type="text" class="form-control" id="direccion" placeholder="AV Lima etc" pattern="[0-9a-zA-ZáéíóúÁÉÍÓÚÑñ ]+" required>
                    <div class="invalid-feedback">Ingrese Dirección</div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="tipoUsuario">Tipo de Usuario</label>
                    <select class="form-control" id="tipoUsuario" required>
                      <option value="" selected disabled>__ Seleccione __</option>
                      <option value="1">Admin</option>
                      <option value="2">Secretaria</option>
                      <option value="3">Abogado</option>
                    </select>
                    <div class="invalid-feedback">Seleccione tipo de usuario</div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label" for="direccion">Tipo de cargo</label>
                    <select class="form-control" id="tipoCargo" required>
                      <option value="" selected disabled>__ Seleccione __</option>
                      <option value="1">Admin</option>
                      <option value="2">Secretaria</option>
                      <option value="3">Abogado</option>
                    </select>
                    <div class="invalid-feedback">Seleccione tipo de cargo</div>
                  </div>
                </div>

                <div class="col-md-12 mt-3 text-right">
                  <button class="btn btn-primary" id="btn_add" type="submit">Guardar Usuario</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script src="<?= URL ?>dist/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= URL ?>dist/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= URL ?>dist/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= URL ?>dist/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= URL ?>dist/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= URL ?>dist/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= URL ?>dist/plugins/jszip/jszip.min.js"></script>
<script src="<?= URL ?>dist/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= URL ?>dist/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= URL ?>dist/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= URL ?>dist/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= URL ?>dist/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="<?= URL ?>dist/js/pages/usuario.js" type="module"></script>

<?php require 'views/footer.php'; ?>