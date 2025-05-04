//contantes y variables
var table;
// funciones
function init(){
    listar();
}//Init permite inicializar los elementos del dataTable
function listar(){
    //Pide al ajax el los datos del departamento
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
//eventos
init();//se llama a init