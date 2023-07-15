import { url_base, language } from "./exports.js";

// LOAD TABLE
function loadTable() {
  $("#table_tipo").DataTable({
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

$("#new_tipo").click(function (e) {
  e.preventDefault();
  $("#accion").val("create");
});

$("#form_tipos input").on("input", function () {
  if (this.checkValidity()) {
    $(this).removeClass("is-invalid");
  }
});

// ? Agregar nuevo tipo
$("#form_tipos").submit(function (e) {
  e.preventDefault();
  $("#form_tipos input").each(function () {
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
      },
      dataType: "json",
      success: function (response) {
        $("#form_tipos")[0].reset();
        $("#modal_tipos").modal("toggle");
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

// ? Consultar tipo
$(document).on("click", "button.edit", function () {
  $("#accion").val("edit");
  $("#modal_tipos").modal("toggle");
  $.ajax({
    type: "POST",
    url: url_base + "/get",
    data: { id: $(this).attr("id") },
    dataType: "json",
    success: function (response) {
      if ("success" in response) {
        $("#id").val(response.tipos.id);
        $("#nombre").val(response.tipos.nombre);
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

// ? Eliminar tipo
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
            $("#table_tipo").DataTable().row(row).remove().draw();
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
