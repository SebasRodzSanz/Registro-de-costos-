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
        $rpse = $empleado->listar();
        $data = Array();
        while ($renglon = $rpse->fetch_object()) {
        # los "0,1,2,3,..." son las columnas de la tabla que queremos
            $data[] = array(
                "0"=>($renglon->activo)?"<button class='btn btn-warning' onclick='mostrar({$renglon->idEmpleado})'> <i class='far fa-edit'></i> </button>".
                "<button class='btn btn-danger' onclick='desactivar({$renglon->idEmpleado})'> <i class='far fa-window-close'></i> </button>":
                "<button class='btn btn-warning' onclick='mostrar({$renglon->idEmpleado})'> <i class='far fa-edit'></i> </button>".
                "<button class='btn btn-primary' onclick='activar({$renglon->idEmpleado})'> <i class='far fa-check-square'></i> </button>",
                "1" => decryption($renglon->nombre),
                "2" => decryption($renglon->apellido_paterno),
                "3" => $renglon->descripcion,
                "4" => decryption($renglon->jefeNombre)." ".decryption($renglon->jefePrimerApellido),
                "5" => $renglon->fecha_entrada,
                "6" => $renglon->fechaCreacion,
                "7" => $renglon->fechaActualizacion,
                "8" => ($renglon->activo)?"<span class='badge badge-success'>Activados</span>" : "<span class='badge badge-danger'>Desactivado</span>",
                "9" => decryption($renglon ->empActualizaNombre)." ".decryption($renglon->empActualizaPrimerApellido)
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
            $pwd = set_pass($pwd);

            $rpse = $empleado->insertar($nombre,$apellido_p,$apellido_m,$email,$fecha_entrada,$fecha_baja,$idDepartamento,$idJefe,$esJefe,$usuario,$pwd,$imagen,$idEmpActualiza);
            $mensaje =($rpse != 0)?"Empleado registrado":"Error, empleado no registrada";
            echo $mensaje;
        }else{
            #editar registro
            $hashValidado = hash("SHA256","Contraseña no actualizada");
            write_log("Ajax empleado-editar: valor de hashValidado: {$hashValidado} || pwd = {$pwd}");
            if($pwd == $hashValidado){
                write_log("Ajax empleado-editar: iguales valor de hashValidado: {$hashValidado} || pwd = {$pwd}");
                $pwd = "";
            }else{
                write_log("Ajax empleado-editar: diferentes valor de hashValidado: {$hashValidado} || pwd = {$pwd}");
                $pwd = set_pass($pwd);
            }

            $nombre = encryption($nombre);
            $apellido_p = encryption($apellido_p);
            $apellido_m = encryption($apellido_m);
            $esJefe =(strlen($esJefe)<1)?0:1;

            $rpse = $empleado -> editar($idEmpleado,$nombre,$apellido_p,$apellido_m,$email,$fecha_entrada,$fecha_baja,$idDepartamento,$idJefe,$esJefe,$usuario,$pwd,$imagen,$fechaActualizacion,$idEmpActualiza);
            $mensaje =($rpse != 0)?"Empleado actualizado":"Error, empleado no actualizado";
            echo $mensaje;
        }
    break;
    case 'selectJefe':
        $rsp = $empleado->selectJefe();
        while($row = $rsp->fetch_object()){
            $name = decryption($row->nombre);
            $f_name = decryption($row->apellido_paterno);
            echo "<option value='{$row->idEmpleado}'>{$name} {$f_name}</option>";
        }
    break;
    case 'mostrar':
        $rpse = $empleado->mostrar($idEmpleado);
        write_log("Ajax empleado caso mostrar");
        write_log(json_encode($rpse));

        $rpse["nombre"] = decryption($rpse["nombre"]);
        $rpse["apellido_paterno"] = decryption($rpse["apellido_paterno"]);
        $rpse["apellido_materno"] = decryption($rpse["apellido_materno"]);
        
        #verificamos el formato correcto de la fecha para el input date
        if(strlen(strtotime($rpse["fecha_entrada"])) > 1){
            $rpse["fecha_entrada"] = date("Y-m-d",strtotime($rpse["fecha_entrada"]));
        }
        if(strlen(strtotime($rpse["fecha_baja"])) > 1){
            $rpse["fecha_baja"] = date("Y-m-d",strtotime($rpse["fecha_baja"]));
        }
        $rpse["pwd"] = hash("SHA256","Contraseña no actualizada");

        echo json_encode($rpse);
    break;
    case 'desactivar':
        $rpse = $empleado->desactivar($idEmpleado ,$fechaActualizacion, $idEmpActualiza);
        $mensaje = ($rpse)?"Empleado dado de baja":"Error, el empleado no se dar de baja al empleado";
        echo $mensaje;
    break;
    case 'activar':
        $rpse = $empleado->activar($idEmpleado ,$fechaActualizacion, $idEmpActualiza);
        $mensaje = ($rpse)?"Empleado reactivado":"Error, el empleado no se pudo reactivar";
        echo $mensaje;
    break;
    default:
        #code
    break;
}
?>