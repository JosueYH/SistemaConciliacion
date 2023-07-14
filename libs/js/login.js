//const formulariox = document.getElementById('formulario');
console.log("AJAX");
$(document).ready(function () {
  //FORMULARIO PARA LOGUARTE
  //console.log('Qasdas');
  $("#formulario_login").submit(function (e) {
    const url = "http://localhost/coop/iniciar/cuenta";
    e.preventDefault();
    //console.log('submiting');
    //objeto para conservar los datos
    const postData = {
      usuario: $("#usuario").val(),
      clave: $("#clave").val(),
    };
    //console.log(postData);
    $.post(url, postData, function (response) {
      //console.log(response);
      $("#formulario_login").trigger("reset");
      //$('#login').hide();
      $("#response").html(response);
    });
  });
  //formulario para nueva clave
  $("#formulario_newkey").submit(function (e) {
    const url = "http://localhost/coop/info/cambiarClave";
    e.preventDefault();
    //console.log('submiting');
    //objeto para conservar los datos
    const postData = {
      //usuario:$('#usuario').val(),
      clave: $("#clave").val(),
    };
    //console.log(postData);
    $.post(url, postData, function (response) {
      //console.log(response);
      //$('#formulario_login').trigger('reset');
      //$('#login').hide();
      $("#response").html(response);
    });
  });
  //formulario para material
  $("#formulario_material").submit(function (e) {
    const url = "http://localhost/coop/material/agregarMaterial";
    e.preventDefault();
    //console.log('submiting');
    //objeto para conservar los datos
    const postData = {
      codigo_material: $("#codigo_material").val(),
      producto: $("#producto").val(),
      medida: $("#medida").val(),
      id_categoria_material: $("#id_categoria_material").val(),
    };

    //console.log(postData);
    $.post(url, postData, function (response) {
      //console.log(response);
      $("#formulario_material").trigger("reset");
      //$('#login').hide();
      $("#response").html(response);
    });
  });

  //AJAX
  //formulario para producto
  $("#formulario_producto").submit(function (e) {
    const url = "http://localhost/coop/producto/agregarProducto";
    e.preventDefault();
    //console.log('submiting');
    //objeto para conservar los datos
    let foto = $("#foto").prop("files")[0];
    let codigo_producto = $("#codigo_producto").val();
    let precio = $("#precio").val();
    let descripcion = $("#descripcion").val();
    let id_categoria_producto = $("#id_categoria_producto").val();
    let producto = $("#producto").val();
    let stock = $("#stock").val();

    let formdata = new FormData();
    formdata.append("foto", foto);
    formdata.append("codigo_producto", codigo_producto);
    formdata.append("precio", precio);
    formdata.append("descripcion", descripcion);
    formdata.append("id_categoria_producto", id_categoria_producto);
    formdata.append("producto", producto);
    formdata.append("stock", stock);

    $.ajax({
      type: "POST",
      cache: false,
      contentType: false,
      processData: false,
      data: formdata,
      url: url,
    })
      .done(function (response) {
        $("#formulario_producto").trigger("reset");
        //$('#login').hide();
        $("#response").html(response);
      })
      .fail(function (response) {
        alert("No se puede usar ajax");
      });
  });
  //proveedor
  //formulario para proveedor
  $("#formulario_proveedor").submit(function (e) {
    const url = "http://localhost/coop/proveedor/agregarProveedor";
    e.preventDefault();
    //console.log('submiting');
    //objeto para conservar los datos
    const postData = {
      ruc: $("#ruc").val(),
      nombre: $("#nombre").val(),
      telefono: $("#telefono").val(),
      direccion: $("#direccion").val(),
      correo: $("#correo").val(),
    };

    //console.log(postData);
    $.post(url, postData, function (response) {
      showAlertaResponse();
      //console.log(response);
      $("#formulario_proveedor").trigger("reset");
      //$('#login').hide();
      $("#response").html(response);
    });
  });
  //**************************************************************
  //formulario para proveedor
  $("#formulario_socio").submit(function (e) {
    const url = "http://localhost/coop/socio/agregarSocio";
    e.preventDefault();
    //console.log('submiting');
    //objeto para conservar los datos
    const postData = {
      fecha_inicio: $("#fecha_inicio").val(),
      cedula: $("#cedula").val(),
      nombre: $("#nombre").val(),
      apellido: $("#apellido").val(),
      telefono: $("#telefono").val(),
      correo: $("#correo").val(),
      direccion: $("#direccion").val(),
    };
    $.post(url, postData, function (response) {
      showAlertaResponse();

      //console.log(response);
      $("#formulario_socio").trigger("reset");
      //$('#login').hide();
      $("#response").html(response);
    });
  });

  //=============================================================
  //formulario para proveedor
  $("#formulario_cliente").submit(function (e) {
    const url = "http://localhost/coop/cliente/agregarCliente";
    e.preventDefault();
    //console.log('submiting');
    //objeto para conservar los datos
    const postData = {
      cedula_ruc: $("#cedula_ruc").val(),
      nombre: $("#nombre").val(),
      correo: $("#correo").val(),
      celular: $("#celular").val(),
      telefono: $("#telefono").val(),
      tipo_cliente: $("#tipo_cliente").val(),
      direccion: $("#direccion").val(),
    };
    $.post(url, postData, function (response) {
      //console.log(response);
      showAlertaResponse();
      $("#formulario_cliente").trigger("reset");
      //$('#login').hide();
      $("#response").html(response);
    });
  });
  //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
  $("#formulario_usuario").submit(function (e) {
    const url = "http://localhost/coop/usuario/agregarUsuario";
    e.preventDefault();
    //console.log('submiting');
    //objeto para conservar los datos
    const postData = {
      usuario: $("#usuario").val(),
      nombre_usuario: $("#nombre_usuario").val(),
    };
    $.post(url, postData, function (response) {
      //console.log(response);
      showAlertaResponse();
      $("#formulario_usuario").trigger("reset");

      //$('#login').hide();
      $("#response").html(response);
    });
  });
  //DETALLES
  //FORMULARIOS PRINCIPALES DE LOS DETALLES
  ///FORMULARIO DE INGRESO MATERIAL
  //funciones de desabled enabled
  function disabledFooter() {
    $("#save").attr("disabled", true);
    $("#botonCancelarIngreso").attr("disabled", true);
    $("#botonCancelarPedido").attr("disabled", true);
    $("#botonCancelarSalida").attr("disabled", true);
  }
  //=========================================================================
  function disabled() {
    $("#save").attr("disabled", true);
    $("#botonCancelarIngreso").attr("disabled", true);
    $("#botonCancelarPedido").attr("disabled", true);
    $("#botonCancelarSalida").attr("disabled", true);
    $("#agregar").attr("disabled", true);
  }
  //=========================================================================

  function enabled() {
    $("#save").attr("disabled", false);
    $("#botonCancelarIngreso").attr("disabled", false);
    $("#botonCancelarPedido").attr("disabled", false);
    $("#botonCancelarSalida").attr("disabled", false);
    $("#agregar").attr("disabled", false);
  }
  //=========================================================================
  function hideAlertaResponse() {
    $("#response").hide();
    $("#alert").hide();
    $("#alert2").hide();
    $("#response").html("");
    $("#alert").html("");
    $("#alert2").html("");
  }
  //=========================================================================
  function showAlertaResponse() {
    $("#response").show();
    $("#alert").show();
    $("#alert2").show();
  }
  //=========================================================================
  $("#formulario_ingreso").submit(function (e) {
    e.preventDefault();
    let n = $("#tbodyIngreso tr").length;
    if (n != 0) {
      const url =
        "http://localhost/coop/ingresarmaterial/agregarIngresarMaterial";

      //console.log('submiting');
      //objeto para conservar los datos
      const postData = {
        id_proveedor: $("#id_proveedor").val(),
        porcentaje: $("#porcentajeiva").val(),
        fecha: $("#fecha").val(),
        subtotal_material: $("#subtotal").val(),
        numero_factura: $("#numero_factura").val(),
      };
      $.post(url, postData, function (response) {
        //console.log(response);
        $("#formulario_ingreso").trigger("reset");
        //se debe d eocultar el body que corresponde al detalleIngreso
        //$('.detalleIngreso').hide();
        darDetalleIngreso();
        $("#subtotal").val("0.00");
        $("#response").html(response);
        disabled();
      });
    } else {
      let template = `
      <div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>Falta Detalle</strong> Llene el Detalle del Ingreso Porfavor
      </div>
      `;
      $("#response").html(template);
    }
  }); //funcion guaradar info de formulario_ingreso
  $("#botonCancelarIngreso").click(cancelarDetalleIngreso); //cancelar
  //mostrar tabla
  $("#formulario_detalle_ingreso").ready(darDetalleIngreso);
  //formualrio para la tabla temporal
  $("#formulario_detalle_ingreso").submit(function (e) {
    //constar el numero de filas
    const url = "http://localhost/coop/ingresarmaterial/detalle";
    //$('#response').hide();
    e.preventDefault();
    //console.log('submiting');
    //objeto para conservar los datos

    const postData = {
      id_material: $("#id_material").attr("id_material_db"),
      cantidad: $("#cantidad").val(),
      valor: $("#valor").val(),
    };
    $.post(url, postData, function (response) {
      //console.log(response);
      //  $('.detalleIngreso').hide();//ocultar el body antiguo
      $("#id_material").val(""), $("#cantidad").val(""), $("#valor").val("");
      darDetalleIngreso();
      enabled();
    });
  }); //enviar detalle
  /*
  FUNCIONES PARA LAS TABLAS LA VISUALIZACION Y CANCELACION D ELOS DETALLES
  */
  //DETALLE INGRESO renderDetalle
  function darDetalleIngreso() {
    const url = "http://localhost/coop/ingresarmaterial/renderDetalle";
    $.ajax({
      url: url,
      type: "GET",
      success: function (response) {
        let detalles = JSON.parse(response);
        let template = "";
        //LLENAR DATOS CORRESPONDIENTES
        //IMPRIMIR LAS FILAS
        detalles.forEach((detalle) => {
          //plantilla
          template += `
          <tr detalleid="${detalle.id_temporal}" style="text-align:center;">
            <td>
              <input type="text" class="form-control"  value="${
                detalle.producto
              }" disabled required>
            </td>
            <td>
              <input type="text" name="cantidad" class="form-control" value="${
                detalle.cantidad
              }" disabled required>
            </td>
            <td>
              <input type="text" name="valor" class="form-control" value="${
                detalle.valor
              }" disabled required>
            </td>
            <td class="subtotal">
               ${detalle.total.toFixed(2)}
            </td>
            <td>
              <a  data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar Este Registro" class="botonEliminarDetalleIngreso btn btn-outline-primary "  name="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                </svg>
              </a>
            </td>
          </tr>
          `;
        });
        $("#tbodyIngreso").html(template);
        var sum = 0;
        $(".subtotal").each(function () {
          sum += parseFloat($(this).text().replace(/,/g, ""), 2);
        });
        $("#subtotal").val(sum.toFixed(2));
        impuesto();
      },
    });
  } //fin
  //funcion dd calculo deimpuestos
  const formingreso = document.getElementById("formulario_ingreso");
  $("#porcentajeiva").bind("keyup keydown change", impuesto);

  function impuesto() {
    const select_iva = formingreso.querySelector("#porcentajeiva");
    const subtotal_input = formingreso.querySelector("#subtotal");
    const iva = parseInt(select_iva.value);
    const subtotal = parseFloat(subtotal_input.value);

    const impuesto_iva = (iva * subtotal) / 100;
    const imp = impuesto_iva.toFixed(2);
    const totalIngreso = parseFloat(subtotal) + parseFloat(imp);
    const tingreso = totalIngreso.toFixed(2);

    document.getElementById("impuesto").value = imp;
    document.getElementById("totalIngreso").value = tingreso;
  }
  //boton eliminar una fila
  $(document).on("click", ".botonEliminarDetalleIngreso", function () {
    let element = $(this)[0].parentElement.parentElement;
    let id_temporal = $(element).attr("detalleid");
    eliminadoDetalleIngreso(id_temporal);
  });

  //DETALLE INGRESO CANCELADO
  function cancelarDetalleIngreso() {
    if (confirm("esta seguro de cancelar este ingreso?")) {
      const url = "http://localhost/coop/ingresarmaterial/cancelado";
      $.ajax({
        url: url,
        type: "GET",
        success: function (response) {
          $("#response").html(response);
          darDetalleIngreso();
          disabledFooter();
        },
      });
    }
  } //fin
  //eliminar filas
  function eliminadoDetalleIngreso(id) {
    if (confirm("esta seguro de cancelar este ingreso?")) {
      const url = "http://localhost/coop/ingresarmaterial/eliminado";
      const data = {
        id_temporal: id,
      };
      $.post(url, data, function (response) {
        $("#response").html(response);
        darDetalleIngreso();
      });
    }
  } //fin

  //=================================================================
  //=================================================================
  //=================================================================
  //=================================================================
  //FORMULARIO DE PEDIDOD

  //mostrar tabla
  $("#formulario_detalle_pedido").ready(darDetallePedido);

  $("#formulario_pedido").submit(function (e) {
    e.preventDefault();
    let n = $("#tbody tr").length;
    if (n != 0) {
      const url = "http://localhost/coop/pedido/agregarPedido";
      //console.log('submiting');
      //objeto para conservar los datos
      const postData = {
        id_cliente: $("#id_cliente").val(),
        fecha_entrada: $("#fecha_entrada").val(),
        fecha_salida: $("#fecha_salida").val(),
        comentario: $("#comentario").val(),
        total_pedido: $("#total").val(),
      };

      $.post(url, postData, function (response) {
        //console.log(response);
        $("#formulario_pedido").trigger("reset");
        //se debe d eocultar el body que corresponde al detalleIngreso
        //$('.detalleIngreso').hide();
        darDetallePedido();
        $("#total").val("0.00");
        $("#response").html(response);
        disabled();
      });
    } else {
      let template = `
      <div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>Falta Detalle</strong> Llene el Detalle del Factura Porfavor
      </div>
      `;
      $("#response").html(template);
    }
  }); //funcion guaradar info de formulario_ingreso
  $("#botonCancelarPedido").click(cancelarDetallePedido); //cancelar

  //mostrar tabla
  //DETALLE PEDIDO
  $("#formulario_detalle_pedido").submit(function (e) {
    const url = "http://localhost/coop/pedido/detalle";
    //$('#response').hide();
    e.preventDefault();
    //console.log('submiting');
    //objeto para conservar los datos
    const postData = {
      id_producto: $("#id_producto").val(),
      cantidad: $("#cantidad").val(),
    };
    $.post(url, postData, function (response) {
      //console.log(response);
      $("#response").html(response);
      //$('.detallePedido').hide();//ocultar el body antiguo
      $("#id_producto").val(""); //canpo
      $("#cantidad").val(""); //comap
      //$('#valor').val('');//campo
      darDetallePedido();
      enabled();
    });
  });
  //FUNCIONES NECESARIOAS
  //fun darDetallePedido(0)
  function darDetallePedido() {
    const url = "http://localhost/coop/pedido/renderPedido";
    $.ajax({
      url: url,
      type: "GET",
      success: function (response) {
        let detalles = JSON.parse(response);
        let template = "";
        //LLENAR DATOS CORRESPONDIENTES
        //IMPRIMIR LAS FILAS
        detalles.forEach((detalle) => {
          //plantilla
          template += `
          <tr pedidoid="${detalle.id_temporal}" style="text-align:center;">
            <td>
              <input type="text" class="form-control"  value="${
                detalle.producto
              }" disabled required>
            </td>
            <td>
              <input type="text" name="cantidad" class="form-control" value="${
                detalle.cantidad
              }" disabled>
            </td>
            <td>
              <input type="text" name="precio" class="form-control" value="${
                detalle.precio
              }" disabled required>
            </td>
            <td class="subtotal">
               ${detalle.total.toFixed(2)}
            </td>
            <td>
              <a  data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar Este Registro" class="botonEliminarDetallePedido btn btn-outline-primary "  name="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                </svg>
              </a>
            </td>
          </tr>
          `;
        });
        $("#tbody").html(template);
        var sum = 0;
        $(".subtotal").each(function () {
          sum += parseFloat($(this).text().replace(/,/g, ""), 2);
        });
        $("#total").val(sum.toFixed(2));
        //impuesto();
      },
    });
  }

  //boton eliminar una fila
  $(document).on("click", ".botonEliminarDetallePedido", function () {
    let element = $(this)[0].parentElement.parentElement;
    let id_temporal = $(element).attr("pedidoid");
    eliminadoDetallePedido(id_temporal);
  });

  //cancelarDetallePedido
  function cancelarDetallePedido() {
    if (confirm("esta seguro de cancelar este ingreso?")) {
      const url = "http://localhost/coop/pedido/cancelado";
      $.ajax({
        url: url,
        type: "GET",
        success: function (response) {
          $("#response").html(response);
          darDetallePedido();
          disabledFooter();
        },
      });
    }
  } //fin

  //eliminadoDetallePedido
  function eliminadoDetallePedido(id) {
    if (confirm("esta seguro de cancelar este ingreso?")) {
      const url = "http://localhost/coop/pedido/eliminado";
      const data = {
        id_temporal: id,
      };
      $.post(url, data, function (response) {
        $("#response").html(response);
        darDetallePedido();
      });
    }
  } //fin
  //=================================================================
  //FORMULARIO DE TAREA

  //mostrar tabla
  $("#formulario_detalle_tarea").ready(
    darDetalleTarea(),
    $("#id_producto").click("keyup keydown", function () {
      $("#agregar").attr("disabled", false);
    })
  );

  $("#formulario_tarea").submit(function (e) {
    e.preventDefault();
    let n = $("#tbodyTarea tr").length;
    if (n != 0) {
      const url = "http://localhost/coop/tarea/agregarTarea";
      //console.log('submiting');
      //objeto para conservar los datos
      const postData = {
        id_socio: $("#id_socio").val(),
        fecha_asignacion: $("#fecha_asignacion").val(),
        fecha_entrega: $("#fecha_entrega").val(),
        id_pedido: $("#id_pedido").val(),
      };

      $.post(url, postData, function (response) {
        //console.log(response);
        $("#formulario_tarea").trigger("reset");
        //se debe d eocultar el body que corresponde al detalleIngreso
        //$('.detalleIngreso').hide();
        darDetalleTarea();
        $("#response").html(response);
        disabled();
      });
    } else {
      let template = `
      <div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>Falta Detalle</strong> Llene el Detalle de la tarea Porfavor
      </div>
      `;
      $("#response").html(template);
    }
  }); //funcion guaradar info de formulario_ingreso
  $("#botonCancelarTarea").click(cancelarDetalleTarea); //cancelar

  //mostrar tabla

  //DETALLE PEDIDO
  $("#formulario_detalle_tarea").submit(function (e) {
    const url = "http://localhost/coop/tarea/detalle";
    //$('#response').hide();
    e.preventDefault();
    //console.log('submiting');
    //objeto para conservar los datos
    const postData = {
      id_producto: $("#id_producto").val(),
      cantidad: $("#cantidad").val(),
    };
    $.post(url, postData, function (response) {
      //console.log(response);
      //$('.detallePedido').hide();//ocultar el body antiguo
      $("#id_producto").val(""); //canpo
      $("#cantidad").val(""); //comap
      //$('#valor').val('');//campo
      darDetalleTarea();
      enabled();
    });
  });
  //FUNCIONES NECESARIOAS
  //fun darDetallePedido(0)
  function darDetalleTarea() {
    const url = "http://localhost/coop/tarea/renderTarea";
    $.ajax({
      url: url,
      type: "GET",
      success: function (response) {
        let detalles = JSON.parse(response);
        let template = "";
        //LLENAR DATOS CORRESPONDIENTES
        //IMPRIMIR LAS FILAS
        detalles.forEach((detalle) => {
          //plantilla
          template += `
          <tr tareaid="${detalle.id_temporal}" style="text-align:center;">
            <td>
              <input type="text" class="form-control"  value="${detalle.producto}" disabled required>
            </td>
            <td>
              <input type="text" name="cantidad" class="form-control" value="${detalle.cantidad}" disabled>
            </td>
            <td>
              <a  data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar Este Registro" class="botonEliminarDetalleTarea btn btn-outline-primary "  name="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                </svg>
              </a>
            </td>
          </tr>
          `;
        });
        $("#tbodyTarea").html(template);
      },
    });
  }

  //boton eliminar una fila
  $(document).on("click", ".botonEliminarDetalleTarea", function () {
    let element = $(this)[0].parentElement.parentElement;
    let id_temporal = $(element).attr("tareaid");
    eliminadoDetalleTarea(id_temporal);
  });

  //cancelarDetallePedido
  function cancelarDetalleTarea() {
    if (confirm("esta seguro de cancelar esta tarea?")) {
      const url = "http://localhost/coop/tarea/cancelado";
      $.ajax({
        url: url,
        type: "GET",
        success: function (response) {
          $("#response").html(response);
          darDetalleTarea();
          disabledFooter();
        },
      });
    }
  } //fin

  //eliminadoDetallePedido
  function eliminadoDetalleTarea(id) {
    if (confirm("esta seguro de cancelar este ingreso?")) {
      const url = "http://localhost/coop/tarea/eliminado";
      const data = {
        id_temporal: id,
      };
      $.post(url, data, function (response) {
        $("#response").html(response);
        darDetalleTarea();
      });
    }
  } //fin

  //=============================================================================
  //mostrar tabla
  $("#formulario_detalle_salida").ready(darDetalleSalida);
  //salidamaterial/agregarSalidaMaterial
  $("#formulario_salida").submit(function (e) {
    e.preventDefault();
    let n = $("#tbodySalida tr").length;
    if (n != 0) {
      const url = "http://localhost/coop/salidamaterial/agregarSalidaMaterial";

      //console.log('submiting');
      //objeto para conservar los datos
      const postData = {
        id_pedido: $("#id_pedido").val(),
        id_socio: $("#id_socio").val(),
        fecha: $("#fecha").val(),
        //fecha_salida:$('#fecha_salida').val(),
        //total_pedido:$('#total').val()
      };

      $.post(url, postData, function (response) {
        //console.log(response);
        $("#formulario_salida").trigger("reset");
        //se debe d eocultar el body que corresponde al detalleIngreso
        //$('.detalleIngreso').hide();
        darDetalleSalida();
        //$('#total').val('0.00');
        $("#response").html(response);
        disabled();
      });
    } else {
      let template = `
      <div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>Falta Detalle</strong> Llene el Detalle de la Salida Porfavor
      </div>
      `;
      $("#response").html(template);
    }
  }); //funcion guaradar info de formulario_ingreso
  $("#botonCancelarSalida").click(cancelarDetalleSalida); //cancelar

  //mostrar tabla
  //DETALLE SALIDA
  $("#formulario_detalle_salida").submit(function (e) {
    const url = "http://localhost/coop/salidamaterial/detalle";
    //$('#response').hide();
    e.preventDefault();
    //console.log('submiting');
    //objeto para conservar los datos
    const postData = {
      id_material: $("#id_material").attr("id_material_db"),
      cantidad: $("#cantidad").val(),
    };
    $.post(url, postData, function (response) {
      $("#response").html(response);

      if (response.length == 0) {
        $("#id_material").val(""); //canpo
        $("#cantidad").val(""); //comap
      }

      //console.log(response);
      //$('.detallePedido').hide();//ocultar el body antiguo
      //$('#valor').val('');//campo
      darDetalleSalida();
      enabled();
    });
  });
  //FUNCIONES NECESARIOAS
  //fun darDetallePedido(0)
  function darDetalleSalida() {
    const url = "http://localhost/coop/salidamaterial/renderSalida";
    $.ajax({
      url: url,
      type: "GET",
      success: function (response) {
        let detalles = JSON.parse(response);
        let template = "";
        //LLENAR DATOS CORRESPONDIENTES
        //IMPRIMIR LAS FILAS
        detalles.forEach((detalle) => {
          //plantilla
          template += `
          <tr salidaid="${detalle.id_temporal}" style="text-align:center;">
            <td>
              <input type="text" class="form-control"  value="${detalle.producto}" disabled required>
            </td>
            <td>
              <input type="text" name="cantidad" class="form-control" value="${detalle.cantidad}" disabled required>
            </td>
            <td>
              <a  data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar Este Registro" class="botonEliminarDetalleSalida btn btn-outline-primary "  name="button">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                </svg>
              </a>
            </td>
          </tr>
          `;
        });
        $("#tbodySalida").html(template);
        //impuesto();
      },
    });
  }

  //boton eliminar una fila
  $(document).on("click", ".botonEliminarDetalleSalida", function () {
    let element = $(this)[0].parentElement.parentElement;
    let id_temporal = $(element).attr("salidaid");
    eliminadoDetalleSalida(id_temporal);
  });

  //cancelarDetallePedido
  function cancelarDetalleSalida() {
    if (confirm("esta seguro de cancelar este ingreso?")) {
      const url = "http://localhost/coop/salidamaterial/cancelado";
      $.ajax({
        url: url,
        type: "GET",
        success: function (response) {
          $("#response").html(response);
          darDetallePedido();
          disabledFooter();
        },
      });
    }
  } //fin

  //eliminadoDetallePedido
  function eliminadoDetalleSalida(id) {
    if (confirm("esta seguro de cancelar este ingreso?")) {
      const url = "http://localhost/coop/salidamaterial/eliminado";
      const data = {
        id_temporal: id,
      };
      $.post(url, data, function (response) {
        $("#response").html(response);
        darDetalleSalida();
      });
    }
  }

  //===========================================================================
  //===========================================================================
  //===========================================================================
  //===========================================================================
  //===========================================================================
  //===========================================================================

  //FUNCIONES PARA EVITAR REPETIR RESGITROS

  //CLIENTE: const

  //
  $("#cedula_ruc").keyup(busqueda($("#cedula_ruc").val()));
  $("#cedula_ruc").keydown(busqueda($("#cedula_ruc").val()));
  $("#cedula_ruc").change(busqueda($("#cedula_ruc").val()));

  function busqueda(inicial) {
    $("#cedula_ruc").change(function () {
      if ($("#cedula_ruc").val() != inicial) {
        const url = "http://localhost/coop/cliente/buscarRegistro";
        $.ajax({
          url: url,
          type: "GET",
          data: { cedula_ruc: $("#cedula_ruc").val() },
          success: function (response) {
            if (response == 1) {
              enabled();
              hideAlertaResponse();
            } else {
              $("#alert").html(response);
              disabled();
              showAlertaResponse();
            }
          },
        });
      }
    });
  }
  //FIN CLIENTE
  //FUNCION PARA EVITAR REPETIR EL USUARIO
  //===========================================================================
  $("#usuario").keyup(busquedau($("#usuario").val()));
  $("#usuario").keydown(busquedau($("#usuario").val()));
  $("#usuario").change(busquedau($("#usuario").val()));

  function busquedau(inicial) {
    $("#usuario").change(function () {
      if ($("#usuario").val() != inicial) {
        const url = "http://localhost/coop/usuario/buscarRegistro";
        $.ajax({
          url: url,
          type: "GET",
          data: { usuario: $("#usuario").val() },
          success: function (response) {
            if (response == 1) {
              enabled();
              hideAlertaResponse();
            } else {
              $("#alert").html(response);
              disabled();
              showAlertaResponse();
            }
          },
        });
      }
    });
  }
  //===========================================================================
  //SOCIO
  $("#cedula").keyup(busquedas($("#cedula").val()));
  $("#cedula").keydown(busquedas($("#cedula").val()));
  $("#cedula").change(busquedas($("#cedula").val()));

  function busquedas(inicial) {
    $("#cedula").change(function () {
      if ($("#cedula").val() != inicial) {
        const url = "http://localhost/coop/socio/buscarRegistro";
        $.ajax({
          url: url,
          type: "GET",
          data: { cedula: $("#cedula").val() },
          success: function (response) {
            if (response == 1) {
              enabled();
              hideAlertaResponse();
            } else {
              $("#alert").html(response);
              disabled();
              showAlertaResponse();
            }
          },
        });
      }
    });
  }
  //===========================================================================
  //PROVEEDOR
  $("#ruc").keyup(busquedap($("#ruc").val()));
  $("#ruc").keydown(busquedap($("#ruc").val()));
  $("#ruc").change(busquedap($("#ruc").val()));
  function busquedap(inicial) {
    $("#ruc").change(function () {
      if ($("#ruc").val() != inicial) {
        const url = "http://localhost/coop/proveedor/buscarRegistro";
        $.ajax({
          url: url,
          type: "GET",
          data: { ruc: $("#ruc").val() },
          success: function (response) {
            if (response == 1) {
              enabled();
              hideAlertaResponse();
            } else {
              $("#alert").html(response);
              disabled();
              showAlertaResponse();
            }
          },
        });
      }
    });
  }
  //===========================================================================
  //===========================================================================
  //PRODUCTO
  $("#codigo_producto").keyup(busquedaproducto($("#codigo_producto").val()));
  $("#codigo_producto").keydown(busquedaproducto($("#codigo_producto").val()));
  $("#codigo_producto").change(busquedaproducto($("#codigo_producto").val()));
  function busquedaproducto(inicial) {
    $("#codigo_producto").change(function () {
      if ($("#codigo_producto").val() != inicial) {
        const url = "http://localhost/coop/producto/buscarRegistro";
        $.ajax({
          url: url,
          type: "GET",
          data: { codigo_producto: $("#codigo_producto").val() },
          success: function (response) {
            if (response == 1) {
              enabled();
              //hideAlertaResponse();
              $("#alert").hide();
            } else {
              $("#alert").html(response);
              disabled();
              showAlertaResponse();
            }
          },
        });
      }
    });
  }
  //PRODUCTO
  $("#producto").keyup(busquedaproducton($("#producto").val()));
  $("#producto").keydown(busquedaproducton($("#producto").val()));
  $("#producto").change(busquedaproducton($("#producto").val()));
  function busquedaproducton(inicial) {
    $("#producto").change(function () {
      if ($("#producto").val() != inicial) {
        const url = "http://localhost/coop/producto/buscarRegistroN";
        $.ajax({
          url: url,
          type: "GET",
          data: { producto: $("#producto").val() },
          success: function (response) {
            if (response == 1) {
              enabled();
              $("#alert2").hide();
            } else {
              $("#alert2").html(response);
              disabled();
              showAlertaResponse();
            }
          },
        });
      }
    });
  }
  //===========================================================================
  //PRODUCTO
  $("#codigo_material").keyup(busquedamaterial($("#codigo_material").val()));
  $("#codigo_material").keydown(busquedamaterial($("#codigo_material").val()));
  $("#codigo_material").change(busquedamaterial($("#codigo_material").val()));
  function busquedamaterial(inicial) {
    $("#codigo_material").change(function () {
      if ($("#codigo_material").val() != inicial) {
        const url = "http://localhost/coop/material/buscarRegistro";
        $.ajax({
          url: url,
          type: "GET",
          data: { codigo_material: $("#codigo_material").val() },
          success: function (response) {
            if (response == 1) {
              enabled();
              //hideAlertaResponse();
              $("#alert").hide();
            } else {
              $("#alert").html(response);
              disabled();
              showAlertaResponse();
            }
          },
        });
      }
    });
  }
  //PRODUCTO
  $("#producto").keyup(busquedamaterialn($("#producto").val()));
  $("#producto").keydown(busquedamaterialn($("#producto").val()));
  $("#producto").change(busquedamaterialn($("#producto").val()));
  function busquedamaterialn(inicial) {
    $("#producto").change(function () {
      if ($("#producto").val() != inicial) {
        const url = "http://localhost/coop/material/buscarRegistroN";
        $.ajax({
          url: url,
          type: "GET",
          data: { producto: $("#producto").val() },
          success: function (response) {
            if (response == 1) {
              enabled();
              $("#alert2").hide();
            } else {
              $("#alert2").html(response);
              disabled();
              showAlertaResponse();
            }
          },
        });
      }
    });
  }
  //===========================================================================
  //PRODUCTO
  $("#id_proveedor").keyup(busquedaFacturaProveedor($("#id_proveedor").val()));
  $("#id_proveedor").keydown(
    busquedaFacturaProveedor($("#id_proveedor").val())
  );
  $("#id_proveedor").change(busquedaFacturaProveedor($("#id_proveedor").val()));
  function busquedaFacturaProveedor(inicial) {
    $("#id_proveedor").change(function () {
      if ($("#id_proveedor").val() != inicial) {
        const url = "http://localhost/coop/ingresarmaterial/buscarRegistro";
        $.ajax({
          url: url,
          type: "GET",
          data: {
            id_proveedor: $("#id_proveedor").val(),
            numero_factura: $("#numero_factura").val(),
          },
          success: function (response) {
            if (response == 1) {
              enabled();
              //hideAlertaResponse();
              $("#alert").hide();
            } else {
              $("#alert").html(response);
              disabled();
              showAlertaResponse();
            }
          },
        });
      }
    });
    //llammamos una funcion de comprobacion
  }
  //PRODUCTO
  $("#numero_factura").keyup(
    busquedaFacturaProveedorn($("#numero_factura").val())
  );
  $("#numero_factura").keydown(
    busquedaFacturaProveedorn($("#numero_factura").val())
  );
  $("#numero_factura").change(
    busquedaFacturaProveedorn($("#numero_factura").val())
  );
  function busquedaFacturaProveedorn(inicial) {
    $("#numero_factura").change(function () {
      if ($("#numero_factura").val() != inicial) {
        const url = "http://localhost/coop/ingresarmaterial/buscarRegistro";
        $.ajax({
          url: url,
          type: "GET",
          data: {
            id_proveedor: $("#id_proveedor").val(),
            numero_factura: $("#numero_factura").val(),
          },
          success: function (response) {
            if (response == 1) {
              enabled();
              //hideAlertaResponse();
              $("#alert").hide();
            } else {
              $("#alert").html(response);
              disabled();
              showAlertaResponse();
            }
          },
        });
      }
    });
    //llammamos una funcion de comprobacion
  }
  //===========================================================================
  //===========================================================================
  //===========================================================================
  $("#id_material").on("keyup keydown change", confirmValueInput);
  $("#list-busqueda").hide();

  //===========================================================================
  function confirmValueInput() {
    let value = $("#id_material").val();
    if (value.length != 0) {
      $("#list-busqueda").show();
      buscarlistarMaterial();
    } else {
      $("#list-busqueda").hide();
    }
  }
  //===========================================================================
  function buscarlistarMaterial() {
    //console.log('Hola');
    const url = "http://localhost/coop/ingresarmaterial/buscarMaterialInput";
    const datos = {
      codigo_material: $("#id_material").val(),
      producto: $("#id_material").val(),
    };
    $.ajax({
      url: url,
      type: "GET",
      data: datos,
      success: function (response) {
        let detalles = JSON.parse(response);
        let template = "";
        disabled();

        //-------------------------------------
        if (detalles.length == 0) {
          template += `<b>No Encontrado</b>`;
          $("#list-busqueda").html(template);
          $("#list-busqueda").attr("style", "none");
        } else {
          $("#list-busqueda").attr(
            "style",
            "overflow-y:scroll; height: 100px;"
          );
          enabled();
        }
        //-------------------------------------

        detalles.forEach((detalle) => {
          template += `
              <tr idmaterial="${detalle.id_material}" datos="${detalle.producto}" >
                <td>
                   ${detalle.codigo_material}-${detalle.producto}            
                </td>
                <td >
                  <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" class="botonSelector btn btn-outline-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                      <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                  </button>
                </td>
                
              </tr>
            `;
        });
        //data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar Registro" class="btn btn-outline-secondary "
        $("#list-busqueda").html(template);

        //console.log(template);
      },
    });
    $(document).on("click", ".botonSelector", function () {
      let element = $(this)[0].parentElement.parentElement;
      let id_material = $(element).attr("idmaterial");
      let datos = $(element).attr("datos");
      console.log(datos);
      $("#id_material").attr("id_material_db", id_material);
      $("#id_material").val(datos);
      $("#list-busqueda").hide();
    });
  }

  //    console.log();

  //===========================================================================
});
