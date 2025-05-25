//contantes y variables
var table;
// funciones
function init(){
    mostrarForm(false);
    // listar();

    $("#formIns").on("submit",(e)=>{
        //Esta función atrapa el evento submit
        guardarEditar(e);
    });

    $.post("../ajax/departamento.php?op=select",(response)=>{
        $("#idDepartamento").html(response);
        $("#idDepartamento").selectpicker("refresh");
    });
}//Init permite inicializar los elementos del dataTable

const limpiar = ()=>{
    $("#idEmpleado").val(""); //Selecciona con jquery el idDepartamento y pone el valor un string vacio
    $("#nombre").val(""); //Selecciona con jquery la descripción y pone el valor un string vacio
    $("#apellido_p").val("");
    $("#apellido_m").val("");
    $("#email").val("");
    $("#fecha_entrada").val("");
    $("#fecha_baja").val("");
    $("#idDepartamento").val("");
    $("#idDepartamento").selectpicker("refresh");//refrescamos el valor selec picker
    $("#idJefe").val("");
    $("#idJefe").selectpicker("refresh");//refrescamos el valor selec picker
    $("#esJefe").prop("checked",false);
    $("#usuario").val("");
    $("#pwd").val("");
    $("#foto").val("");
    $("#fotoActual").val("");
    $("#imagenMuestra").attr("src","");//limpiamos la imagen
};
const mostrarForm = (flag)=>{
    //flag indica si muestra el form
    limpiar();
    if(flag){
        $("#listadoRegistro").hide();//Seleccionamos con jquery el listado de departamentos y lo ocultamos
        $("#formInsertData").show();//Seleccionamos con jquery el formulario y lo mostramos
        $("#btnAdd").hide(); //Seleccionamos con jquery el boton agregar y lo ocultamos
        $("btn_guardar").prop("disable", false); //Seleccionamos con jquery el boton guardar y cambiamos la propiedad disable
    }else{
        $("#listadoRegistro").show();//Seleccionamos con jquery el listado de departamentos y lo mostramos
        $("#formInsertData").hide();//Seleccionamos con jquery el formulario y lo ocultamos
        $("#btnAdd").show(); //Seleccionamos con jquery el boton agregar y lo mostramos
    }
};
const cancelarForm = ()=>{
    limpiar();
    mostrarForm(false);
};

const guardarEditar = (e)=>{
    e.preventDefault();//Cancela los eventos del boton 
    $("#btnAdd").prop("disable",true);//Seleccionamos con jquery el boton guardar y cambiamos la propiedad disable
    let formData = new FormData($("#formIns")[0]);//Forma de acceder al formulario
    $.ajax({
        url:"../ajax/empleado.php?op=guardarEditar",
        type:"POST", //Tipo de petición http
        data: formData,//datos 
        contentType:false, //no manda cabecero
        processData: false,//no combierte objetos en string
        
        success: (respuesta)=>{
            //funcion que se ejecuta en caso de que la petición sea correcta
            let valida = respuesta.indexOf("rror,");//busca la cadena en otra cadena
            if(valida != -1){
                toastr["error"](respuesta);//manda un modal de error con la respuesta
            }else{
                toastr["success"](respuesta);//manda un modal con la respuesta
            }
            // mostrarForm(false); //oculta el formulario
            // table.ajax.reload();//recargamos la tabla
        }
    });//Este ajax nos permite mandar los datos al formulario
    limpiar();
}

init();