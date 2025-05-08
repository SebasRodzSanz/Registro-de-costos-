<?php
require_once "../modelos/Departamento.php";

$departamento = new Departamento();

#Se reciben las instrucciones de javascript mediante el formulario
#op = opción
switch ($_GET['op']){
    case 'listar':
        $rspta = $departamento->listar();
        $data = Array();
        while ($renglon = $rspta->fetch_object()) {
        # los "0,1,2,3,..." son las columnas de la tabla que queremos
            $data[] = array(
                "0"=>($renglon->activo)?"<button class='btn btn-warning' onclick='mostrar('{$renglon->idDepartamento}')'> <i class='far fa-edit'></i> </button>".
                "<button class='btn btn-danger' onclick='desactivar('{$renglon->idDepartamento}')'> <i class='far fa-window-close'></i> </button>":
                "<button class='btn btn-warning' onclick='mostrar('{$renglon->idDepartamento}')'> <i class='far fa-edit'></i> </button>".
                "<button class='btn btn-primary' onclick='activar('{$renglon->idDepartamento}')'> <i class='far fa-check-square'></i> </button>",
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
    case '':
        #code
    break;
    default:
        #code
    break;
}
?>