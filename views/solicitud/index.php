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
          <h1 class="m-0">Mantenimiento de Solicitudes</h1>
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
              <button id="new_solicitud" class="btn btn-primary" data-toggle="modal" data-target="#modal_solicitud">
                <i class="fas fa-plus"></i> Añadir solicitud</button>
            </div>

            <div class="card-body">
              <table id="table_solicitud" class="table table-bordered table-hover w-100">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>N° Exp.</th>
                    <th>Cliente</th>
                    <th>Docs</th>
                    <th>Abogado</th>
                    <th>Fecha</th>
                    <th>Estado</th>
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

    <div id="modal_solicitud" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Formulario de solicitud</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" id="form_solicitud" novalidate>
              <input type="hidden" id="accion" value="create">
              <input type="hidden" id="id">
              <div class="row">
                <div class="col-md-6">
                  <fieldset>
                    <legend>Datos de cliente</legend>

                    <div class="col-12">
                      <div class="mb-3">
                        <label class="form-label" for="documento">Documento</label>
                        <input type="text" class="form-control" id="documento" placeholder="12345678" required pattern="[0-9]+">
                        <div class="invalid-feedback">Ingrese Documento</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="mb-3">
                        <label class="form-label" for="razon_social">Nombres / Razón Social</label>
                        <input type="text" class="form-control" id="razon_social" placeholder="Nombres / Razón Social" required pattern="[a-zA-ZáéíóúÁÉÍÓÚÑñ ]+">
                        <div class="invalid-feedback">Ingrese Nombres / Razón Social</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="mb-3">
                        <label class="form-label" for="telefono">Telefono</label>
                        <input type="tel" class="form-control" id="telefono" placeholder="987654321" required pattern="[0-9]+">
                        <div class="invalid-feedback">Ingrese Teléfono</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="mb-3">
                        <label class="form-label" for="direccion">Dirección</label>
                        <input type="text" class="form-control" id="direccion" placeholder="AV Lima etc" pattern="[0-9a-zA-ZáéíóúÁÉÍÓÚÑñ ]+" required>
                        <div class="invalid-feedback">Ingrese Dirección</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="mb-3">
                        <label class="form-label" for="tipo">Tipo de cliente</label>
                        <select class="form-control" id="tipo" required>
                          <option value="" selected disabled>__ Seleccione __</option>
                          <?php
                          foreach ($this->d['clientesTipos'] as $tipo) {
                            echo "<option value='{$tipo['id']}'>{$tipo['nombre']}</option>";
                          }
                          ?>
                        </select>
                        <div class="invalid-feedback">Seleccione tipo de cliente</div>
                      </div>
                    </div>
                  </fieldset>
                </div>
                <div class="col-md-6">
                  <fieldset>
                    <legend>Solicitud</legend>

                    <div class="col-12">
                      <div class="mb-3">
                        <label class="form-label" for="abogado">Abogado a cargo</label>
                        <select class="form-control" id="abogado" required>
                          <option value="" selected disabled>__ Seleccione __</option>
                          <?php
                          foreach ($this->d['abogados'] as $abogado) {
                            echo "<option value='{$abogado['id']}'>{$abogado['nombres']}</option>";
                          }
                          ?>
                        </select>
                        <div class="invalid-feedback">Seleccione abogado</div>
                      </div>
                    </div>
                  </fieldset>
                </div>
                <div class="col-md-12 mt-3 text-right">
                  <button class="btn btn-primary" id="btn_add" type="submit">Guardar cliente</button>
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

<script src="<?= URL ?>dist/js/pages/solicitud.js" type="module"></script>

<?php require 'views/footer.php'; ?>