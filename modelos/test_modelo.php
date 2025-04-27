<?php
require_once "Departamento.php";
$departamento = new Departamento();

// $id01 = $departamento->insertar("Sistemas");
// echo "id departamento: $id01 <br>";

// $id01 = $departamento->insertar("Ventas");
// echo "id departamento: $id01 <br>";
// $id01 = $departamento->insertar("Recursos Humanos");
// echo "id departamento: $id01 <br>";
// $id01 = $departamento->insertar("Marketing");
// echo "id departamento: $id01 <br>";

$fechaActualizacion = date("Y-m-d H:i:s");
$departamento->editar('6','Ventas internacionales', $fechaActualizacion,'3');
?>