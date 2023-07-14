<!--
==========================================================================
==========================================================================
==========================================================================
https://www.youtube.com/watch?v=GeCNShiLdpc&t=5354s->hacer esto.....
DETALLE_INGRESO
-->

<div class="table-responsive col-12">
  <table class="table table-bordered order-table" id="dataTable" cellspacing="0">
    <thead>
      <tr style="text-align: center;">
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th>Total</th>
        <th>Opciones</th>
      </tr>
    </thead>
    <div>Pulse en la Cruz Para Agregar ese Producto</div>
    <tbody id="tbody">

    </tbody>

    <!--Formulario para el ingreso de detalle pedido/detalle-->
    <tr id="formulariorow" style="text-align:center;">

      <form id="formulario_detalle_pedido">
        <td>
          <!--ID_MATERIAL-->
          <select name="id_producto" id="id_producto" class="form-control" required>
            <option value="" selected disabled>Elija El Producto</option>
            <!--Solo se Hace una funion... que estese en el mapProveedor-->
            <?php
            foreach ($this->productomap as $row) {
              $obj = new ProductoMap();
              $obj = $row;
            ?>
              <option value="<?php echo $obj->id_producto ?>"><?php echo $obj->producto; ?></option>
            <?php } ?>
          </select>
        </td>
        <td>
          <!--Cantidad-->

          <input name="cantidad" type="text" class="form-control" id="cantidad" required>

        </td>
        <td>
          <!--Precio-->
          <input disabled type="text" class="form-control" id="precio" value="0.00" required>
        </td>
        <td>
          <!--Total Temporal-->
          <input type="text" class="form-control" id="totalTemporal" value="0.00" disabled>
        </td>
        <td>

          <button id="reset" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar Este Registro" class=" btn btn-outline-primary" type="reset">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eraser" viewBox="0 0 16 16">
              <path d="M8.086 2.207a2 2 0 0 1 2.828 0l3.879 3.879a2 2 0 0 1 0 2.828l-5.5 5.5A2 2 0 0 1 7.879 15H5.12a2 2 0 0 1-1.414-.586l-2.5-2.5a2 2 0 0 1 0-2.828l6.879-6.879zm2.121.707a1 1 0 0 0-1.414 0L4.16 7.547l5.293 5.293 4.633-4.633a1 1 0 0 0 0-1.414l-3.879-3.879zM8.746 13.547 3.453 8.254 1.914 9.793a1 1 0 0 0 0 1.414l2.5 2.5a1 1 0 0 0 .707.293H7.88a1 1 0 0 0 .707-.293l.16-.16z" />
            </svg>
          </button>

          <button id="agregar" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar Registro" class="btn btn-outline-secondary ">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
              <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
          </button>
        </td>
      </form>
    </tr>

  </table>
</div>