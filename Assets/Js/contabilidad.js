$(document).ready(function(){
    tablaContabilidad = $("#tablaContabilidad").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
       }],
        
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
$("#btnNuevo").click(function(){
    $("#formContabilidad").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $("#exampleModalLabel").text("Nueva Contabilidad");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    fecha = fila.find('td:eq(1)').text();
    servicio = fila.find('td:eq(2)').text();
    detalle = fila.find('td:eq(3)').text();
    tipo = fila.find('td:eq(4)').text();
    precio = parseFloat(fila.find('td:eq(5)').text());
    
    $("#fecha").val(fecha);
    $("#servicio").val(servicio);
    $("#detalle").val(detalle);
    $("#tipo").val(tipo);
    $("#precio").val(precio);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $("#exampleModalLabel").text("Editar Contabilidad");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "../Database/crudContabilidad.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaContabilidad.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formContabilidad").submit(function(e){
    e.preventDefault();    
    fecha = $.trim($("#fecha").val());
    servicio = $.trim($("#servicio").val());
    detalle = $.trim($("#detalle").val());
    tipo = $.trim($("#tipo").val());
    precio = $.trim($("#precio").val());
    
    $.ajax({
        url: "../Database/crudContabilidad.php",
        type: "POST",
        dataType: "json",
        data: {fecha:fecha, servicio:servicio, detalle:detalle, tipo:tipo, precio:precio, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;            
            fecha = data[0].fecha;
            servicio = data[0].servicio;
            detalle = data[0].detalle;
            tipo = data[0].tipo;
            precio = data[0].precio;
            if(opcion == 1){tablaContabilidad.row.add([id,fecha,servicio,detalle, tipo, precio]).draw();}
            else{tablaContabilidad.row(fila).data([id,fecha,servicio,detalle, tipo, precio]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    
    
});