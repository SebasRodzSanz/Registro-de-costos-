<?php
require "../config/conexion.php";

Class Empleado{
    public function __construct() {}
    public function insertar($nombre,$apellido_paterno,$apellido_materno,$email,$fecha_entrada,$fecha_baja,$idDepartamento,$idJefe,$esJefe,$usuario,$pwd,$foto,$idEmpActualiza) {
        $sql = "INSERT INTO empleados (nombre,apellido_paterno,apellido_materno,email,fecha_entrada,fecha_baja,idDepartamento,idJefe,esJefe,usuario,pwd,foto,idEmpActualiza) 
        VALUES ('{$nombre}','{$apellido_paterno}','{$apellido_materno}','{$email}','{$fecha_entrada}','{$fecha_baja}',{$idDepartamento},{$idJefe},{$esJefe},'{$usuario}','{$pwd}','{$foto}',{$idEmpActualiza});";
        return ejecutarConsultaRetornaId($sql);
    }
    public function editar($idEmpleado,$nombre,$apellido_paterno,$apellido_materno,$email,$fecha_entrada,$fecha_baja,$idDepartamento,$idJefe,$esJefe,$usuario,$pwd,$foto,$fechaActualizacion,$idEmpActualiza){
        $sql = "UPDATE empleados SET 
        nombre = '{$nombre}',apellido_paterno='{$apellido_paterno}',apellido_paterno = '{$apellido_materno}',email = '{$email}',fecha_entrada ='{$fecha_entrada}',fecha_baja ='{$fecha_baja}',
        idDepartamento = {$idDepartamento}, idJefe = {$idJefe}, esJefe = {$esJefe}, usuario = '{$usuario}', pwd = '{$pwd}', foto = '{$foto}',
        fechaActualizacion = '{$fechaActualizacion}',idEmpActualiza = {$idEmpActualiza}
        WHERE idEmpleado = {$idEmpleado};";
        return ejecutarConsulta($sql);
    }
    public function activar($idEmpleado){
        $sql = "UPDATE empleados SET activo ='1' 
        WHERE idEmpleado = {$idEmpleado}  ;";
        return ejecutarConsulta($sql);
    }
    public function desactivar($idEmpleado){
        $sql = "UPDATE empleados SET activo ='0' 
        WHERE idEmpleado = {$idEmpleado}  ;";
        return ejecutarConsulta($sql);
    }
    public function mostrar($idEmpleado){
        $sql = "SELECT idEmpleado,nombre,apellido_paterno,apellido_materno,email,fecha_entrada,fecha_baja,
        idDepartamento,idJefe,esJefe,usuario,pwd,foto
        FROM empleados WHERE idEmpleado = {$idEmpleado};";
        return ejecutarConsultaSimpleFila($sql);
    }
    public function listar(){
        $sql = "SELECT 
        em.idEmpleado,em.nombre,em.apellido_paterno,em.apellido_materno,em.email,em.fecha_entrada,em.fecha_baja,
        em.idDepartamento,dep.descripcion,em.idJefe,emd.nombre as jefeNombre ,emd.apellido_paterno as jefePrimerApellido,em.esJefe,em.usuario,em.pwd,em.foto
        FROM empleados em INNER JOIN departamentos dep ON em.idDepartamento = dep.idDepartamento
        INNER JOIN empleados emd ON em.idJefe = emd.idEmpleado;";
        return ejecutarConsulta($sql);
    }
    public function select_active(){
        $sql = "SELECT idEmpleado,nombre,apellido_paterno,apellido_materno,email,fecha_entrada,fecha_baja,
        idDepartamento,idJefe,esJefe,usuario,pwd,foto
        FROM empleados WHERE activo = 1 ;";
        return ejecutarConsultaRetornaId($sql);
    }
}
?>