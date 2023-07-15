import { url_base, language } from "./exports.js";

// LOAD TABLE
function loadTable() {
  $("#table_usuario").DataTable({
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

$("#new_usuario").click(function (e) {
  e.preventDefault();
  $("#accion").val("create");
});

$("#form_usuarios input, #form_usuarios select").on(
  "input change",
  function () {
    if (this.checkValidity()) {
      $(this).removeClass("is-invalid");
    }
  }
);

// ? Agregar nuevo usuario
$("#form_usuarios").submit(function (e) {
  e.preventDefault();
  $("#form_usuarios input, #form_usuarios select").each(function () {
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
        nombres: $("#nombres").val(),
        email: $("#email").val(),
        password: $("#password").val(),
        telefono: $("#telefono").val(),
        direccion: $("#direccion").val(),
        tipoUsuario: $("#tipoUsuario").val(),
        tipoCargo: $("#tipoCargo").val(),
      },
      dataType: "json",
      success: function (response) {
        $("#form_usuarios")[0].reset();
        $("#modal_usuarios").modal("toggle");
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

// ? Consultar usuario
$(document).on("click", "button.edit", function () {
  $("#accion").val("edit");
  $("#modal_usuarios").modal("toggle");
  $("#password").removeAttr("required");
  $.ajax({
    type: "POST",
    url: url_base + "/get",
    data: { id: $(this).attr("id") },
    dataType: "json",
    success: function (response) {
      if ("success" in response) {
        $("#id").val(response.user.id);
        $("#documento").val(response.user.documento);
        $("#nombres").val(response.user.nombres);
        $("#email").val(response.user.email);
        $("#telefono").val(response.user.telefono);
        $("#direccion").val(response.user.direccion);
        $("#tipoUsuario").val(response.user.idtipo_usuario);
        $("#tipoCargo").val(response.user.idcargo);
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

// ? Eliminar usuario
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
            row.remove();
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
