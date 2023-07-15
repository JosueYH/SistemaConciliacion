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
          <h1 class="m-0">Mantenimiento de cargos</h1>
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
              <button id="new_cargo" class="btn btn-primary" data-toggle="modal" data-target="#modal_cargos">
                <i class="fas fa-plus"></i> Añadir cargo</button>
            </div>

            <div class="card-body">
              <table id="table_cargo" class="table table-bordered table-hover w-100">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Códgio</th>
                    <th>Cargo</th>
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

    <div id="modal_cargos" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Formulario de cargo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" id="form_cargos" novalidate>
              <input type="hidden" id="accion" value="create">
              <input type="hidden" id="id">
              <div class="row">
                <div class="col-12">
                  <div class="mb-3">
                    <label class="form-label" for="codigo">Código</label>
                    <input type="text" class="form-control" id="codigo" placeholder="codigo" required pattern="[a-zA-ZáéíóúÁÉÍÓÚÑñ ]+">
                    <div class="invalid-feedback">Ingrese Código</div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="mb-3">
                    <label class="form-label" for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" placeholder="Nombre" required pattern="[a-zA-ZáéíóúÁÉÍÓÚÑñ ]+">
                    <div class="invalid-feedback">Ingrese nombre</div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="mb-3">
                    <label class="form-label" for="tipo">Tipo</label>
                    <input type="text" class="form-control" id="tipo" placeholder="Tipo" required pattern="[a-zA-ZáéíóúÁÉÍÓÚÑñ ]+">
                    <div class="invalid-feedback">Ingrese tipo</div>
                  </div>
                </div>

                <div class="col-md-12 mt-3 text-right">
                  <button class="btn btn-primary" id="btn_add" type="submit">Guardar cargo</button>
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

<script src="<?= URL ?>dist/js/pages/cargo.js" type="module"></script>

<?php require 'views/footer.php'; ?>