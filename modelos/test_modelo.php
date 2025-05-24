<?php
require_once "Empleados.php";
$empleado = new Empleado();

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
#$departamento->desactivar(5);
#$departamento->desactivar(7);

#Prueba insertar empleado:
$fecha = date('Y-m-d H:i:s');
$test=1;
#tener cuidado con null  --- 2025-05-23 19:05:24
#$res = $empleado ->insertar("Luis","Gomez","Padillo","luis@gmail.com",$fecha,$fecha,1,$test,0,"luis","luis123","../img/foto.png",1);
#Linea 16 hay un igual de mas en el where
#$res = $empleado ->editar(3,"Luis","Gomez","Padillo","luis2@gmail.com",$fecha,$fecha,1,$test,0,"luis2","luis123","../img/foto.png",$fecha,2);
#$res = $empleado ->desactivar(3);
#$res = $empleado ->activar(3);
#$res = $empleado ->mostrar(3);
#$res = $empleado ->listar();
$res = $empleado ->insertar("Luis","Gomez","Padillo","luis@gmail.com",$fecha,'',1,$test,0,"luis","luis123","../img/foto.png",1);
// if($res->num_rows != 0){
//     while($row = $res->fetch_object()){
//         echo ($row->idEmpleado." ,".$row->nombre." ,".$row->apellido_paterno." ,".$row->email." ,".$row->fecha_entrada." ,".$row->idDepartamento." ,".$row->descripcion." ,".$row->idJefe." ,".$row->jefeNombre." ,".$row->usuario." ,".$row->pwd." ,"."<br>");
//     }
// }else{
//     echo "algo mal";
// }
if($res != 0){
    echo "insertado";
}else{
    echo "algo mal";
}

#CACHE DEL NAVEGADOR DE MIGUEL
?>