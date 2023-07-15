export const url_base = window.location.href;

export const language = {
  sProcessing: "Procesando...",
  sLengthMenu: "Mostrar _MENU_ registros",
  sZeroRecords: "No se encontraron resultados",
  sEmptyTable: "Ningún dato disponible en esta tabla",
  sInfo:
    "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
  sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
  sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
  sInfoPostFix: "",
  sSearch: "Buscar:",
  sUrl: "",
  sInfoThousands: ",",
  sLoadingRecords: "Cargando...",
  oPaginate: {
    sFirst: "Primero",
    sLast: "Último",
    sNext: "Siguiente",
    sPrevious: "Anterior",
  },
  oAria: {
    sSortAscending: ": Activar para ordenar la columna de manera ascendente",
    sSortDescending: ": Activar para ordenar la columna de manera descendente",
  },
};

// Clientes para el vendedor
export function getClientes(tipo = null) {
  $.ajax({
    type: "post",
    url: "ajax/campaigns.php",
    data: { accion: "clientes", idusuario: $("#idusuario").val(), tipo },
    dataType: "json",
    success: function (response) {
      if (response.length > 0) {
        $("#cliente").append(
          `<option value="" disabled selected>Seleccione</option>`
        );
        response.forEach((item) => {
          $("#cliente").append(
            `<option value="${item.id}">${item.nombres}</option>`
          );
        });
      }
    },
  });
}
