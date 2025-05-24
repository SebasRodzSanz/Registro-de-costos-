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


init();