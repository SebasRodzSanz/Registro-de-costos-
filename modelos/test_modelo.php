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

#$fechaActualizacion = date("Y-m-d H:i:s");
#$departamento->editar('6','Ventas internacionales', $fechaActualizacion,'3');

#prueba del arreglo de lo departamentos en la bd

#prueba de función desactivar
$departamento->desactivar(5);
$departamento->desactivar(7);
echo "todo bien";
?>