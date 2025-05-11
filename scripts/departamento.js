//contantes y variables
var table;
// funciones
function init(){
    mostrarForm(false);
    listar();

    $("#formIns").on("submit",(e)=>{
        //Esta función atrapa el evento submit
        guardarEditar(e);
    });
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
const guardarEditar = (e)=>{
    e.preventDefault();//Cancela los eventos del boton 
    $("#btnAdd").prop("disable",true);//Seleccionamos con jquery el boton guardar y cambiamos la propiedad disable
    let formData = new FormData($("#formIns")[0]);//Forma de acceder al formulario
    $.ajax({
        url:"../ajax/departamento.php?op=guardarEditar",
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
            mostrarForm(false); //oculta el formulario
            table.ajax.reload();//recargamos la tabla
        }
    });//Este ajax nos permite mandar los datos al formulario
    limpiar();
}
const mostrar = (idDepartamento)=>{
    //$.post("url",{dato:dato,datos:datos},(dataResponse)=>{regreso}); es una funcion asincrona que simplifica la opción post de $.ajax
    //es decir, tiene el mismo funcionamiento, pero esta es especial para post
    $.post("../ajax/departamento.php?op=mostrar",{idDepartamento:idDepartamento},(data)=>{
        //console.log(data);//String en formato json
        data = JSON.parse(data);//transforma el json en objeto
        //console.log(data);//objeto js
        mostrarForm(true);
        $('#idDepartamento').val(data.idDepartamento);//Selecciona con jquery el idDepartamento y pone el valor idDepartamento del data
        $('#descripcion').val(data.descripcion);//Selecciona con jquery el descripcion y pone el valor descripcion del data
    });
}
const desactivar = (idDepartamento)=>{
    let ventanaEleccion = toastr.warning("¿Deseas desactivar el departamento seleccionado?"+
        "<br><button type='button' id='rptaSi' class='btn btn-success'>SI</button>"+
        "<button type='button' id='rptaNo' class='btn btn-danger'>NO</button>"
    ,"Alerta");//Modal de pregunta y respuesta
    $("#rptaSi").click(()=>{
        // console.log("click si ");
        toastr.clear(ventanaEleccion);// deshacer el toastr de elección
        $.post("../ajax/departamento.php?op=desactivar",{idDepartamento:idDepartamento},(respuesta)=>{
            let valida = respuesta.indexOf("rror,");//busca la cadena en otra cadena
            if(valida != -1){
                toastr["error"](respuesta);//manda un modal de error con la respuesta
            }else{
                toastr["success"](respuesta);//manda un modal con la respuesta
            }
            table.ajax.reload();//recargamos la tabla
        });
    });
    $("#rptaNo").click(()=>{
        // console.log("click no");
        toastr.clear(ventanaEleccion);// deshacer el toastr de elección
    });
}
const activar = (idDepartamento)=>{
    let ventanaEleccion = toastr.warning("¿Deseas desactivar el departamento seleccionado?"+
        "<br><button type='button' id='rptaSi' class='btn btn-success'>SI</button>"+
        "<button type='button' id='rptaNo' class='btn btn-danger'>NO</button>"
        ,"Alerta");
    $("#rptaSi").click(()=>{
        toastr.clear(ventanaEleccion);
        $.post("../ajax/departamento.php?op=activar",{idDepartamento:idDepartamento},(respuesta)=>{
            let valida = respuesta.indexOf("rror,");
            if(valida != -1){
                toastr["error"](respuesta);
            }else{
                toastr["success"](respuesta);
            }
            table.ajax.reload();
        });
    });
    $("rptaNo").click(()=>{
        toastr.clear(ventanaEleccion);
    });
}
//eventos
init();//se llama a init