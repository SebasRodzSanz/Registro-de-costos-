<?php
require_once "../modelos/Departamento.php";

$departamento = new Departamento();

#Se reciben las instrucciones de javascript mediante el formulario
switch ($_GET['opcion']){
    case 'listar':
        $rspta = $departamento->listar();
        $data = Array();
        while ($renglon = $rspta->fetch_objetc()) {
            $data[] = array(
                "0" -> ($renglon->activo) ? "<button class='btn btn-warning' onclick='mostrar('{$renglon->idDepartamento}')> <i class='fa fa-pencil'></i> </button>".
                "<button class='btn btn-danger' onclick='desactivar('{$renglon->idDepartamento}')'> <i class='fa fa-pencil'></i> </button>" :
                "<button class='btn btn-warning' onclick='mostrar('{$renglon->idDepartamento}')'> <i class='fa fa-pencil'></i> </button>".
                "<button class='btn btn-primary' onclick='activar('{$renglon->idDepartamento}')'> <i class='fa fa-pencil'></i> </button>",
                "1" -> $renglon->descripcion,
                "2" -> $renglon->fechaCreacion,
                "3" -> ($renglon->activo)?"<span class='label bg-green'>Activados</span>" : "<span class='label bg-red'>Desactivado</span>"
            );
        }
        #Se guarda información para el datatables
        $results = array(
            "sEcho" ->1,
            "iTotalRecords" ->count($data);
            "iTotalDisplayRecords" ->count($data),
            "asData" -> $data;
        );

    break;
    case '':
        #code
    break;
    default:
        #code
    break;
}


?>