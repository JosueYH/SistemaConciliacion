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
          <h1 class="m-0">Mantenimiento de Distritos</h1>
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
              <button id="new_distrito" class="btn btn-primary" data-toggle="modal" data-target="#modal_distritos">
                <i class="fas fa-plus"></i> Añadir distrito</button>
            </div>

            <div class="card-body">
              <table id="table_distrito" class="table table-bordered table-hover w-100">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Provincia</th>
                    <th>Distrito</th>
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

    <div id="modal_distritos" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Formulario de distrito</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" id="form_distritos" novalidate>
              <input type="hidden" id="accion" value="create">
              <input type="hidden" id="id">
              <div class="row">
                <div class="col-12">
                  <div class="mb-3">
                    <label class="form-label" for="provincia">Provincia</label>
                    <select class="form-control" id="provincia" required>
                      <option value="" selected disabled>__ Seleccione __</option>
                      <?php
                      foreach ($this->d['provincias'] as $provi) {
                        echo "<option value='{$provi['id']}'>{$provi['nombre']}</option>";
                      }
                      ?>
                    </select>
                    <div class="invalid-feedback">Seleccione Provincia</div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="mb-3">
                    <label class="form-label" for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre" required pattern="[a-zA-ZáéíóúÁÉÍÓÚÑñ ]+">
                    <div class="invalid-feedback">Ingrese nombre</div>
                  </div>
                </div>

                <div class="col-md-12 mt-3 text-right">
                  <button class="btn btn-primary" id="btn_add" type="submit">Guardar distrito</button>
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

<script src="<?= URL ?>dist/js/pages/distrito.js" type="module"></script>

<?php require 'views/footer.php'; ?>