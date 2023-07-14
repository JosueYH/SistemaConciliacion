<!--VIEWS-->
<?php
require 'views/header.php';
$url = constant('URL') . "consultarpedido"; //ruta para enviarle a la vista de views/info/buscar.php

?>

<div class="card shadow mb-1">
  <div class="card-header py-3">
    <table class="table table-bordered order-table">
      <tr style="text-align: center;">
        <td>
          <h2>
            <b>N ° Factura:</b> <?php echo $this->pedido->id_pedido ?>
          </h2>
        </td>
        <h6 class="m-2 font-weight-bold text-primary">Consulta de Registros
          <a href="<?php echo constant('URL') ?>consultarpedido">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
              <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
              <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
            </svg>
          </a>
        </h6>
          <td>
            <h5>Cliente:</h5>
            <b> <?php echo $this->pedido->id_cliente ?></b>
          </td>
          <td>
            <h5>Fecha de Ingreso: </h5>
            <b><?php echo $this->pedido->fecha_entrada ?></b>
          </td>
          <td>
            <h5>Fecha de Salida: </h5>
            <b><?php echo $this->pedido->fecha_salida ?></b>
          </td>
      </tr>
    </table>
    <hr>
    <div class="table-responsive">
      <table class="table table-bordered order-table" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr style="text-align: center;">
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
          //inversa
          foreach ($this->detalle as $row) {
            $obj = new DetallePedidoMap(); //
            $obj = $row;
          ?>
            <tr class="trow" style="text-align: center;">
              <!--REFERENCIA PADRE-->
              <td><?php echo $obj->producto; ?></td>
              <td><?php echo $obj->cantidad; ?></td>
              <td><?php echo $obj->precio; ?></td>
              <td><?php echo $obj->precio*$obj->cantidad ?></td>
            </tr>
          <?php } ?>
          <tr style="text-align: center;">
            <td colspan="2">
              <b> Comentario:</b>
             <p>
               <?php echo $this->pedido->comentario ?>             
             </p> 
            </td>
            <td class="border-primary">
              <b>
                Total:
              </b>
            </td>
            <td><?php echo $this->pedido->total ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>

<?php require 'views/footer.php'; ?>
