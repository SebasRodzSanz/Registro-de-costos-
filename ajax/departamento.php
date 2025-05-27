<?php
require_once "../modelos/Departamento.php";

$departamento = new Departamento();

#Verificamos si se envia idDepartemento y lo limpiamos. De lo contrario ponemos una cadena vacia
$idDepartamento = isset($_POST['idDepartamento'])?limpiarCadenas($_POST['idDepartamento']):"";
#Verificamos si se envia descripcion y lo limpiamos. De lo contrario ponemos una cadena vacia
$descripcion = isset($_POST['descripcion'])?limpiarCadenas($_POST['descripcion']):"";
$fechaActualizacion = date("Y-m-d H:i:s");#Generamos la fecha
$idEmpActualiza = 1; #Cambiar por el usuario de la sesion cuando se implemente

#Se reciben las instrucciones de javascript mediante el formulario
#op = opción
switch ($_GET['op']){
    case 'listar':
        $rpse = $departamento->listar();
        $data = Array();
        while ($renglon = $rpse->fetch_object()) {
        # los "0,1,2,3,..." son las columnas de la tabla que queremos
            $data[] = array(
                "0"=>($renglon->activo)?"<button class='btn btn-warning' onclick='mostrar({$renglon->idDepartamento})'> <i class='far fa-edit'></i> </button>".
                "<button class='btn btn-danger' onclick='desactivar({$renglon->idDepartamento})'> <i class='far fa-window-close'></i> </button>":
                "<button class='btn btn-warning' onclick='mostrar({$renglon->idDepartamento})'> <i class='far fa-edit'></i> </button>".
                "<button class='btn btn-primary' onclick='activar({$renglon->idDepartamento})'> <i class='far fa-check-square'></i> </button>",
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
        if(empty($idDepartamento)){
            #nuevo registro
            $rpse = $departamento->insertar($descripcion);
            $mensaje =($rpse != 0)?"Departamento registrado":"Error, departamento no registrado";
            echo $mensaje;
        }else{
            #editar registro
            $rpse = $departamento->editar($idDepartamento,$descripcion,$fechaActualizacion,$idEmpActualiza);
            $mensaje =($rpse != 0)?"Departamento actualizado":"Error, departamento no actualizado";
            echo $mensaje;
        }
    break;
    case 'mostrar':
        $rpse = $departamento->mostrar($idDepartamento);
        echo json_encode($rpse);
    break;
    case 'desactivar':
        $rpse = $departamento->desactivar($idDepartamento);
        $mensaje = ($rpse)?"Departamento desactivado":"Error, el departamento no se pudo desactivar";
        echo $mensaje;
    break;
    case 'activar':
        $rpse = $departamento->activar($idDepartamento);
        $mensaje = ($rpse)?"Departamento activado":"Error, el departamento no se pudo activar";
        echo $mensaje;
    break;
    case 'select':
        $rsp = $departamento->select_active();
        while($row = $rsp->fetch_object()){
            echo "<option value='{$row->idDepartamento}'>{$row->descripcion}</option>";
        }
    break;
    default:
        #code
    break;
}
?>