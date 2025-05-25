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

if(!function_exists('encryption')){
    function encryption($string){
        $output = FALSE;
        $key = hash('sha256',SECRET_KEY);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length(METHOD));
        $output = openssl_encrypt($string,METHOD,$key,0,$iv);
        $output = base64_encode($output.'::'.$iv);
        return  $output;
    }
    function decryption($string){
        $key = hash('sha256',SECRET_KEY);
        list($string,$iv) = array_pad(explode('::',base64_decode($string),2),2,null);
        $output = openssl_decrypt($string,METHOD,$key,0,$iv);
        return $output;
    }
}

#metodo para hacer debug
function write_log($message){
    $log_filename = "gastos_log_debug"; #crea el nombre de la carpeta
    if(!file_exists($log_filename)){
        mkdir($log_filename,0777,true);#crea la carpeta
    }
    $log_file_data = $log_filename.'/debug.log';#archivo
    #mandamos a salida
    file_put_contents($log_file_data,"============================= ".date("Y-m-d H:i:s")."================"."\n",FILE_APPEND);
    file_put_contents($log_file_data,$message."\n",FILE_APPEND);
}
?>