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
        }
    );//Funcion de jquery que trae el elememto dataTable
}
//eventos
init();//se llama a init