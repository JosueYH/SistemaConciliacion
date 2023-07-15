import { url_base, language } from "./exports.js";

// LOAD TABLE
function loadTable() {
  $("#table_distrito").DataTable({
    destroy: true,
    ajax: {
      type: "post",
      url: url_base + "/index",
      data: {},
    },
    language,
    order: [[0, "desc"]],
  });
}

$(document).ready(function () {
  loadTable();
});

$("#new_distrito").click(function (e) {
  e.preventDefault();
  $("#accion").val("create");
});

$("#form_distritos input, #form_distritos select").on(
  "input change",
  function () {
    if (this.checkValidity()) {
      $(this).removeClass("is-invalid");
    }
  }
);

// ? Agregar nuevo distrito
$("#form_distritos").submit(function (e) {
  e.preventDefault();
  $("#form_distritos input, #form_distritos select").each(function () {
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
        nombre: $("#nombre").val(),
        provincia: $("#provincia").val(),
      },
      dataType: "json",
      success: function (response) {
        $("#form_distritos")[0].reset();
        $("#modal_distritos").modal("toggle");
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

// ? Consultar distrito
$(document).on("click", "button.edit", function () {
  $("#accion").val("edit");
  $("#modal_distritos").modal("toggle");
  $.ajax({
    type: "POST",
    url: url_base + "/get",
    data: { id: $(this).attr("id") },
    dataType: "json",
    success: function (response) {
      if ("success" in response) {
        $("#id").val(response.distrito.id);
        $("#provincia").val(response.distrito.idprovincia);
        $("#nombre").val(response.distrito.nombre);
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

// ? Eliminar distrito
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
            $('#table_distrito').DataTable().row(row).remove().draw();
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
