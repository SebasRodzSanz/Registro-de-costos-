//contantes y variables
var table;
// funciones
function init(){
    mostrarForm(false);
    listar();
}//Init permite inicializar los elementos del dataTable
function listar(){
    //Pide al ajax el los datos del departamento
    //llamado tipo jquery
    table = $('#tblistadoReg').dataTable(
        {
            "Processing":true, //Activa el procesamiento de la tabla
            "ServerSide": true, //Paginación y filtros se procese en el servidor.
            responsive : true, //Active capacidades responsivas a la tabla
            dom:'<"top"Bfl>rt<"bottom"ip><"clear">', //Definir los elementos de control de datatable
            //B - Bottom, f -filtro sencillo, l selector de filas, 
            // r - mensaje de procesomiento, t - table como tal, i - información
            //p - paginación
            buttons :[
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ], //Ponemos los botones que queremos para la aplicación
            "ajax":{
                url: '../ajax/departamento.php?op=listar',//Establecemos la opción en donde ajax va a interactuar los datos
                type:'get', //El tipo de metodo http (procesamiento)
                dataType:'json', //Los datos recibidos en formato json,
                error:(e)=>{
                    //función que captura en el error
                    console.log(e.responseText);
                }
            },
            "destroy": true, //Cada vez que se ejecute se reinicializa el dataTable
            "iDisplayLength":5, //Indica cuantos registros vamos a en el table 
            "order":[[1,"desc"]] //Tipo de ordenamiento
        }
    ).DataTable();//Funcion de jquery que trae el elememto dataTable
    // .DataTable() inicializa el data table
}

//limpiar formulario
const limpiar = ()=>{
    $("#idDepartamento").val(""); //Selecciona con jquery el idDepartamento y pone el valor un string vacio
    $("#descripcion").val(""); //Selecciona con jquery la descripción y pone el valor un string vacio
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
//eventos
init();//se llama a init