<?php
require_once "../modelos/categoria.php";

$categoria = new Categoria();

#Verificamos si se envia idDepartemento y lo limpiamos. De lo contrario ponemos una cadena vacia
$idCategoria = isset($_POST['idCategoria'])?limpiarCadenas($_POST['idCategoria']):"";
#Verificamos si se envia descripcion y lo limpiamos. De lo contrario ponemos una cadena vacia
$descripcion = isset($_POST['descripcion'])?limpiarCadenas($_POST['descripcion']):"";
$fechaActualizacion = date("Y-m-d H:i:s");#Generamos la fecha
$idEmpActualiza = 1; #Cambiar por el usuario de la sesion cuando se implemente

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
        if(empty($idCategoria)){
            #nuevo registro
            $rpse = $categoria->insertar($descripcion);
            $mensaje =($rpse != 0)?"Categoria registrada":"Error, categoria no registrada";
            echo $mensaje;
        }else{
            #editar registro
            $rpse = $categoria->editar($idCategoria,$descripcion,$fechaActualizacion,$idEmpActualiza);
            $mensaje =($rpse != 0)?"Categoria actualizada":"Error, categoria no actualizada";
            echo $mensaje;
        }
    break;
    case 'mostrar':
        $rpse = $categoria->mostrar($idCategoria);
        echo json_encode($rpse);
    break;
    case 'desactivar':
        $rpse = $categoria->desactivar($idCategoria);
        $mensaje = ($rpse)?"Categoria desactivada":"Error, la categoria no se pudo desactivar";
        echo $mensaje;
    break;
    case 'activar':
        $rpse = $categoria->activar($idCategoria);
        $mensaje = ($rpse)?"Categoria activada":"Error, la categoria no se pudo activar";
        echo $mensaje;
    break;
    default:
        #code
    break;
}
?>