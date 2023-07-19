import { url_base, language } from "./exports.js";

// LOAD TABLE
function loadTable() {
  $("#table_solicitud").DataTable({
    destroy: true,
    ajax: {
      type: "post",
      url: url_base + "/index",
      data: { usuario: $("#usuario").val() },
    },
    language,
    order: [[0, "desc"]],
  });
}

$(document).ready(function () {
  loadTable();
});

$("#new_solicitud").click(function (e) {
  e.preventDefault();
  $("#accion").val("create");
});

$("#form_solicitud input, #form_solicitud select").on(
  "input change",
  function () {
    if (this.checkValidity()) {
      $(this).removeClass("is-invalid");
    }
  }
);

// ? Agregar nuevo solicitud
$("#form_solicitud").submit(function (e) {
  e.preventDefault();
  $("#form_solicitud input, #form_solicitud select").each(function () {
    if (!this.checkValidity()) {
      $(this).addClass("is-invalid");
    } else {
      $(this).removeClass("is-invalid");
    }
  });

  if (this.checkValidity()) {
    $("#btn_add").attr("disabled", "disabled");
    $.ajax({
      type: "POST",
      url: `${url_base}/${$("#accion").val()}`,
      data: {
        id: $("#id").val(),
        documento: $("#documento").val(),
        razon_social: $("#razon_social").val(),
        telefono: $("#telefono").val(),
        direccion: $("#direccion").val(),
        tipo: $("#tipo").val(),
        abogado: $("#abogado").val(),
      },
      dataType: "json",
      success: function (response) {
        $("#form_solicitud")[0].reset();
        $("#modal_solicitud").modal("toggle");
        if ("success" in response) {
          Swal.fire({
            title: "¡Éxito!",
            text: response.success,
            icon: "success",
          });
          loadTable();
        } else {
          Swal.fire({
            title: "¡Error!",
            text: response.error,
            icon: "error",
          });
        }
        $("#btn_add").removeAttr("disabled");
      },
    });
  }
});

// ? Consultar solicitud
$(document).on("click", "button.edit", function () {
  $("#accion").val("edit");
  $("#modal_solicitud").modal("toggle");
  $.ajax({
    type: "POST",
    url: url_base + "/get",
    data: { id: $(this).attr("id") },
    dataType: "json",
    success: function (response) {
      if ("success" in response) {
        $("#id").val(response.solicitud.id);
        $("#documento").val(response.solicitud.documento);
        $("#razon_social").val(response.solicitud.razon_social);
        $("#telefono").val(response.solicitud.telefono);
        $("#direccion").val(response.solicitud.direccion);
        $("#tipo").val(response.solicitud.idtipo_cliente);
        $("#abogado").val(response.solicitud.idusuario);
      } else {
        Swal.fire({
          title: "¡Error!",
          text: response.error,
          icon: "error",
        });
      }
    },
  });
});

// ? Eliminar solicitud
$(document).on("click", "button.delete", function () {
  let row = $(this).parent().parent();
  let id = $(this).attr("id");
  Swal.fire({
    title: "¿Seguro de Eliminar?",
    text: "",
    icon: "warning",
    showCancelButton: !0,
    confirmButtonColor: "#34c38f",
    cancelButtonColor: "#f46a6a",
    confirmButtonText: "Si, eliminar",
  }).then(function (t) {
    if (t.value) {
      $.ajax({
        type: "POST",
        url: `${url_base}/delete`,
        data: { id },
        dataType: "json",
        success: function (response) {
          if ("success" in response) {
            Swal.fire({
              title: "¡Éxito!",
              text: response.success,
              icon: "success",
            });
            $("#table_solicitud").DataTable().row(row).remove().draw();
          } else {
            Swal.fire({
              title: "¡Error!",
              text: response.error,
              icon: "error",
            });
          }
        },
      });
    }
  });
});

// ? Subir acta
$("#upload_acta").click(function (e) {
  e.preventDefault();
  let data = new FormData();
  data.append("solicitud", $("#id").val());
  data.append("acta", $("#file")[0].files[0]);
  $.ajax({
    type: "post",
    url: url_base + "/uploadActa",
    data,
    contentType: false,
    processData: false,
    success: function (response) {
      response = JSON.parse(response);
      if ("success" in response) {
        Swal.fire({
          position: "center",
          icon: "success",
          title: response.success,
        });
        loadTable();
      } else {
        Swal.fire({
          position: "center",
          icon: "warning",
          title: response.error,
        });
      }
    },
  });
});

// ? Cambiar estado
$(document).on("click", "button.estado", function () {
  $.ajax({
    type: "POST",
    url: `${url_base}/updateStatus`,
    data: { id: $(this).attr("id") },
    dataType: "json",
    success: function (response) {
      if ("success" in response) {
        Swal.fire({
          title: "¡Éxito!",
          text: response.success,
          icon: "success",
        });
        loadTable();
      } else {
        Swal.fire({
          title: "¡Error!",
          text: response.error,
          icon: "error",
        });
      }
    },
  });
});
