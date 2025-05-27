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
        $password =(empty($pwd))?"":"pwd = '{$pwd}',";
        $sql = "UPDATE empleados SET 
        nombre = '{$nombre}',apellido_paterno='{$apellido_paterno}',apellido_paterno = '{$apellido_materno}',email = '{$email}',fecha_entrada ='{$fecha_entrada}',fecha_baja ='{$fecha_baja}',
        idDepartamento = {$idDepartamento}, idJefe = {$idJefe}, esJefe = {$esJefe}, usuario = '{$usuario}', {$password} foto = '{$foto}',
        fechaActualizacion = '{$fechaActualizacion}',idEmpActualiza = {$idEmpActualiza}
        WHERE idEmpleado = {$idEmpleado};";
        write_log("Modelo empleado-editar: query editar = {$pwd}");
        return ejecutarConsulta($sql);
    }
    public function activar($idEmpleado ,$fechaActualizacion, $idEmpActualiza){
        $sql = "UPDATE empleados SET activo = 1,fecha_entrada ='{$fechaActualizacion}',
        idEmpActualiza = {$idEmpActualiza} 
        WHERE idEmpleado = {$idEmpleado}  ;";
        return ejecutarConsulta($sql);
    }
    public function desactivar($idEmpleado ,$fechaActualizacion, $idEmpActualiza){
        $sql = "UPDATE empleados SET activo = 0,fecha_baja ='{$fechaActualizacion}',
        idEmpActualiza = {$idEmpActualiza}
        WHERE idEmpleado = {$idEmpleado}  ;";
        return ejecutarConsulta($sql);
    }
    public function mostrar($idEmpleado){
        $sql = "SELECT idEmpleado,nombre,apellido_paterno,apellido_materno,email,fecha_entrada,fecha_baja,
        idDepartamento,idJefe,esJefe,usuario,pwd,foto,activo,fechaCreacion,fechaActualizacion,idEmpActualiza
        FROM empleados WHERE idEmpleado = {$idEmpleado};";
        return ejecutarConsultaSimpleFila($sql);
    }
    public function listar(){
        $sql = "SELECT 
        em.idEmpleado,em.nombre,em.apellido_paterno,em.email,em.fecha_entrada,em.fecha_baja,
        em.idDepartamento,dep.descripcion,em.idJefe,emd.nombre as jefeNombre ,emd.apellido_paterno as jefePrimerApellido,
        em.esJefe,em.usuario,em.pwd,em.foto,em.fechaCreacion,em.activo,em.idEmpActualiza,em.fechaActualizacion,
        emt.nombre as empActualizaNombre ,emt.apellido_paterno as empActualizaPrimerApellido
        FROM empleados em INNER JOIN departamentos dep ON em.idDepartamento = dep.idDepartamento
        INNER JOIN empleados emd ON em.idJefe = emd.idEmpleado
        INNER JOIN empleados emt ON em.idEmpActualiza = emt.idEmpleado
        WHERE em.idEmpleado <> 1;";
        return ejecutarConsulta($sql);
    }
    public function select_active(){
        $sql = "SELECT idEmpleado,nombre,apellido_paterno,apellido_materno,email,fecha_entrada,fecha_baja,
        idDepartamento,idJefe,esJefe,usuario,pwd,foto
        FROM empleados WHERE activo = 1 ;";
        return ejecutarConsultaRetornaId($sql);
    }
    public function selectJefe(){
        $sql = "SELECT idEmpleado,nombre,apellido_paterno
        FROM empleados WHERE esJefe = 1 AND activo=1 ;";
        return ejecutarConsulta($sql);
    }
}
?>