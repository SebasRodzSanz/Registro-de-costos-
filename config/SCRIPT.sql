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
ENGINE = InnoDB