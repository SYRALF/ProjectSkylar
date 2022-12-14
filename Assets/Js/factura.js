$(document).ready(function () {
  tablaFactura = $("#tablaFactura").DataTable({
    columnDefs: [
      {
        targets: -1,
        data: null,
        defaultContent:
          "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>",
      },
    ],

    language: {
      lengthMenu: "Mostrar _MENU_ registros",
      zeroRecords: "No se encontraron resultados",
      info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      infoFiltered: "(filtrado de un total de _MAX_ registros)",
      sSearch: "Buscar:",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      sProcessing: "Procesando...",
    },
  });

  $("#btnNuevo").click(function () {

    id = null;
    opcion = 1; //alta
  });

  var fila; //capturar la fila para editar o borrar el registro

  //botón EDITAR
  $(document).on("click", ".btnEditar", function () {
    opcion = 2; //editar
  });

  //botón BORRAR
  $(document).on("click", ".btnBorrar", function () {
    fila = $(this);
    id = parseInt($(this).closest("tr").find("td:eq(0)").text());
    opcion = 3; //borrar
    var respuesta = confirm(
      "¿Está seguro de eliminar el registro: " + id + "?"
    );
    if (respuesta) {
      $.ajax({
        url: "../Database/crudFactura.php",
        type: "POST",
        dataType: "json",
        data: { opcion: opcion, id: id },
        success: function () {
          tablaFactura.row(fila.parents("tr")).remove().draw();
        },
      });
    }
    location.reload();
  });

  $("#formFactura").submit(function (e) {
    e.preventDefault();
    cedula = $.trim($("#cedula").val());
    nombre = $.trim($("#nombre").val());
    apellido = $.trim($("#apellido").val());
    telefono = $.trim($("#telefono").val());
    direccion = $.trim($("#direccion").val());
    correo = $.trim($("#correo").val());
    $.ajax({
      url: "../Database/crudFactura.php",
      type: "POST",
      dataType: "json",
      data: {
        cedula: cedula,
        nombre: nombre,
        apellido: apellido,
        telefono: telefono,
        direccion: direccion,
        correo: correo,
        id: id,
        opcion: opcion,
      },
      success: function (data) {
        console.log(data);
        id = data[0].id;
        cedula = data[0].cedula;
        nombre = data[0].nombre;
        apellido = data[0].apellido;
        telefono = data[0].telefono;
        direccion = data[0].direccion;
        correo = data[0].correo;
        if (opcion == 1) {
          tablaFactura.row
            .add([id, cedula, nombre, apellido, telefono, direccion, correo])
            .draw();
        } else {
          tablaFactura
            .row(fila)
            .data([id, cedula, nombre, apellido, telefono, direccion, correo])
            .draw();
        }
      },
    });
    $("#modalCRUD").modal("hide");
    location.reload();
  });
});
