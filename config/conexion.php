<?php
require_once ("global.php");
#creamos un objeto mysqli para la conexion a la base de datos
$conex = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
#Conexión de prueba
mysqli_query($conex,'SET NAMES"'.DB_ENCODE.'"');
#Verificamos la conexion 
if(mysqli_connect_error()){
    printf("Error en la conexion a la base de datos: %s\n",mysqli_connect_error());
    exit();
}
#echo "hola mundo: \n".$conex->host_info."\n adios";

function ejecutarConsulta($sql){
    #Ejecuta una consulta sql que le pasemos
    global $conex; #indica que podemos acceder a la conexion de forma global.
    $query = $conex -> query($sql);
    return $query;
}
function ejecutarConsultaSimpleFila($sql){
    #Ejecuta una consulta  y devuelve los renglones recuperados
    global $conex;
    $query = $conex -> query($sql);
    $row = $query->fetch_assoc();
    return $row;
}
function ejecutarConsultaRetornaId($sql){
    #Ejecuta una consulta y devuleve el id del registro
    global $conex;
    $query = $conex -> query($sql);
    return $conex->insert_id;
    #$conex->insert_id es un atributo de la conexion que retorna 
    #el valor generado para una columna (id) auto-incrementable por
    #la ultima query(consulta)
}
function limpiarCadenas($str){
    global $conex;
    $str = mysqli_real_escape_string($conex, trim($str)); 
    #Trim: quita los espacios vacios en las cadenas de caracteres
    return htmlspecialchars($str);
    #htmlspecialchars convierte los caracteres especiales a entidades html
    #los convierte a caracteres de texto para que el navegador no lea el html incrustado
    #previene los ataques de XSS(Cross-Site Scrpting)
}
?>