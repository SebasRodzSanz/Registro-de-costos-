<?php
require_once "../modelos/Empleados.php";

$empleado= new Empleado();

// #Verificamos si se envia la variable y lo limpiamos. De lo contrario ponemos una cadena vacia
$idEmpleado = isset($_POST['idEmpleado'])?limpiarCadenas($_POST['idEmpleado']):"";
$nombre = isset($_POST['nombre'])?limpiarCadenas($_POST['nombre']):"";
$apellido_p = isset($_POST['apellido_p'])?limpiarCadenas($_POST['apellido_p']):"";
$apellido_m = isset($_POST['apellido_m'])?limpiarCadenas($_POST['apellido_m']):"";
$email = isset($_POST['email'])?limpiarCadenas($_POST['email']):"";
$fecha_entrada = isset($_POST['fecha_entrada'])?limpiarCadenas($_POST['fecha_entrada']):"";
$fecha_baja= isset($_POST['fecha_baja'])?limpiarCadenas($_POST['fecha_baja']):"";
$idDepartamento= isset($_POST['idDepartamento'])?limpiarCadenas($_POST['idDepartamento']):"";
$idJefe= isset($_POST['idJefe'])?limpiarCadenas($_POST['idJefe']):0;
$esJefe= isset($_POST['esJefe'])?limpiarCadenas($_POST['esJefe']):"";
$usuario = isset($_POST['usuario'])?limpiarCadenas($_POST['usuario']):"";
$pwd = isset($_POST['pwd'])?limpiarCadenas($_POST['pwd']):"";
$fotoActual = isset($_POST['fotoActual'])?limpiarCadenas($_POST['fotoActual']):"";
$fechaActualizacion = date("Y-m-d H:i:s");#Generamos la fecha
$idEmpActualiza = 1; #Cambiar por el usuario de la sesion cuando se implemente

#============================= 2025-05-24 05:18:27================
#{"foto":{"name":"linux_pin.png","full_path":"linux_pin.png","type":"image\/png","tmp_name":"C:\\Users\\basti\\AppData\\Local\\Temp\\php9A04.tmp","error":0,"size":298996}}

write_log(json_encode($_POST));#mandamos a debug el arreglo post 
write_log(json_encode($_FILES));#mandamos a debug el arreglo files de los archivos


#Se reciben las instrucciones de javascript mediante el formulario
#op = opción
switch ($_GET['op']){
    case 'listar':
        $rpse = $categoria->listar();
        $data = Array();
        while ($renglon = $rpse->fetch_object()) {
        # los "0,1,2,3,..." son las columnas de la tabla que queremos
            $data[] = array(
                "0"=>($renglon->activo)?"<button class='btn btn-warning' onclick='mostrar({$renglon->idCategoria})'> <i class='far fa-edit'></i> </button>".
                "<button class='btn btn-danger' onclick='desactivar({$renglon->idCategoria})'> <i class='far fa-window-close'></i> </button>":
                "<button class='btn btn-warning' onclick='mostrar({$renglon->idCategoria})'> <i class='far fa-edit'></i> </button>".
                "<button class='btn btn-primary' onclick='activar({$renglon->idCategoria})'> <i class='far fa-check-square'></i> </button>",
                "1" => $renglon->descripcion,
                "2" => $renglon->fechaCreacion,
                "3" => $renglon->fechaActualizacion,
                "4" => ($renglon->activo)?"<span class='badge badge-success'>Activados</span>" : "<span class='badge badge-danger'>Desactivado</span>",
                "5" => $renglon ->idEmpActualiza
            );
        }
        #Se guarda información para el datatables
        $results = array(
            "sEcho" =>1,
            "iTotalRecords" =>count($data),
            "iTotalDisplayRecords" =>count($data),
            "aaData" => $data);
        echo json_encode($results); #Imprime los datos en formato json para el metodo get
    break;
    case 'guardarEditar':
        #validar archivo y su carga
        $imagen;
        if(!file_exists($_FILES['foto']['tmp_name']) || !is_uploaded_file($_FILES['foto']['tmp_name'])){
            $imagen = $fotoActual;
        }else{
            $extencion = explode(".",$_FILES['foto']['name']);
            #validar el tipo de archivo que aceptamos
            if($_FILES['foto']['type'] == "image/jpg" || $_FILES['foto']['type'] == "image/jpeg" || $_FILES['foto']['type'] == "image/png"){
                $imagen =round(microtime(true)); #creamos la fecha en microsegundos
                $imagen = $imagen.".".end($extencion); #end() => toma un arreglo y apunta hacia la ultime posición
                move_uploaded_file($_FILES['foto']['tmp_name'],"../files/img/".$imagen);#movemos el archivo temporal a la carpeta de nuestro proyecto
            }
        }
        if(strlen($imagen)<1){$imagen="default.png";}

        if(empty($idEmpleado)){
            #nuevo registro
            $nombre = encryption($nombre);
            $apellido_p = encryption($apellido_p);
            $apellido_m = encryption($apellido_m);
            $esJefe =(strlen($esJefe)<1)?0:1;

            $rpse = $empleado->insertar($nombre,$apellido_p,$apellido_m,$email,$fecha_entrada,$fecha_baja,$idDepartamento,$idJefe,$esJefe,$usuario,$pwd,$imagen,$idEmpActualiza);
            $mensaje =($rpse != 0)?"Empleado registrado":"Error, empleado no registrada";
            echo $mensaje;
        }else{
            #editar registro
            // $rpse = $categoria->editar($idCategoria,$descripcion,$fechaActualizacion,$idEmpActualiza);
            // $mensaje =($rpse != 0)?"Categoria actualizada":"Error, categoria no actualizada";
            // echo $mensaje;
        }
    break;
    // case 'mostrar':
    //     $rpse = $categoria->mostrar($idCategoria);
    //     echo json_encode($rpse);
    // break;
    // case 'desactivar':
    //     $rpse = $categoria->desactivar($idCategoria);
    //     $mensaje = ($rpse)?"Categoria desactivada":"Error, la categoria no se pudo desactivar";
    //     echo $mensaje;
    // break;
    // case 'activar':
    //     $rpse = $categoria->activar($idCategoria);
    //     $mensaje = ($rpse)?"Categoria activada":"Error, la categoria no se pudo activar";
    //     echo $mensaje;
    // break;
    // default:
    //     #code
    // break;
}
?>