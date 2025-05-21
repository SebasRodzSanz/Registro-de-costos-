CREATE SCHEMA IF NOT EXISTS dbgtoadmin;
CREATE TABLE IF NOT EXISTS departamentos(
    idDepartamento INT NOT NULL AUTO_INCREMENT,
    descripcion VARCHAR(100) NOT NULL,
    activo TINYINT NOT NULL DEFAULT 1,
    fechaCreacion DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
    fechaActualizacion DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
    idEmpActualiza INT NULL DEFAULT 1,
    PRIMARY KEY(idDepartamento)
);
-- creación de la tabla categorias
CREATE TABLE IF NOT EXISTS categorias(
    idCategoria INT NOT NULL AUTO_INCREMENT,
    descripcion VARCHAR(100) NOT NULL,
    activo TINYINT NOT NULL DEFAULT 1,
    fechaCreacion DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
    fechaActualizacion DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
    idEmpActualiza INT NULL DEFAULT 1,
    PRIMARY KEY(idCategoria)
);
CREATE TABLE IF NOT EXISTS empleados(
    idEmpleado INT NOT NULL AUTO_INCREMENT,
    nombre text not null,
    apellido_paterno text not null,
    apellido_materno text NULL,
    email varchar (100) not null,
    fecha_entrada datetime not null default CURRENT_TIMESTAMP,
    fecha_baja datetime null,
    idDepartamento int not null,
    idJefe int  null,
    esJefe tinyint not null default 0,
    usuario varchar(255) not null,
    pwd varchar (255) not null,
    foto varchar (200),
    activo TINYINT NOT NULL DEFAULT 1,
    fechaCreacion DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
    fechaActualizacion DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
    idEmpActualiza INT NULL DEFAULT 1,
    PRIMARY KEY(idEmpleado),
    FOREIGN KEY (idDepartamento) REFERENCES departamentos(idDepartamento)
    on delete restrict
    on update cascade
);
ENGINE = InnoDB