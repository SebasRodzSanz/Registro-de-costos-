<?php
require "../config/conexion.php";

Class Departamento{
    public function __construct() {
        
    }
    public function insertar($descripcion) {
        $sql = "INSERT INTO departamentos (descripcion) VALUES ('$descripcion')";
        return ejecutarConsultaRetornaId($sql);
    }
    public function editar($idDepartamento,$descripcion,$fechaActualizacion,$idEmpActualiza){
        $sql = "UPDATE departamentos SET descripcion='$descripcion',
        fechaActualizacion = '$fechaActualizacion', idEmpActualiza= '$idEmpActualiza' 
        WHERE idDepartamento = '$idDepartamento';";
        return ejecutarConsulta($sql);
    }
    public function activar($idDepartamento){
        $sql = "UPDATE departamentos SET activo ='1' 
        WHERE idDepartamento = '$idDepartamento'  ;";
        return ejecutarConsulta($sql);
    }
    public function desactivar($idDepartamento){
        $sql = "UPDATE departamentos SET activo ='0' 
        WHERE idDepartamento = '$idDepartamento'  ;";
        return ejecutarConsulta($sql);
    }
    public function mostrar($idDepartamento){
        $sql = "SELECT idDepartamento, descripcion, activo, fechaCreacion, fechaActualizacion
        idEmpActualiza FROM departamentos WHERE idDepartamento = '$idDepartamento'; ";
        return ejecutarConsultaSimpleFila($sql);
    }
    public function listar(){
        $sql = "SELECT idDepartamento, descripcion, activo, fechaCreacion, fechaActualizacion
        idEmpActualiza FROM departamentos;";
        return ejecutarConsulta($sql);
    }
    public function select_active(){
        $sql = "SELECT idDepartamento, descripcion, activo, fechaCreacion, fechaActualizacion
        idEmpActualiza FROM departamentos WHERE activo = '1'; ";
        return ejecutarConsultaRetornaId($sql);
    }
}
?>