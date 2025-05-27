<?php
require "header.php"
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                EMPLEADOS
            <button class="btn btn-success" id="btnAdd" onclick="mostrarForm(true)">
                <i class="fas fa-plus-circle">Agregar</i>
            </button>
            </h3>
        </div>
        <div class="card-body">
        <!-- department table  -->
        <div class="panel-body" id="listadoRegistro">
            <table class="table table-striped table-bordered table-condensed table-over" id="tblistadoReg">
                <thead>
                    <th>Opciones</th>
                    <th>Nombre</th>
                    <th>Primer apellido</th>
                    <th>Departamento</th>
                    <th>Jefe</th>
                    <th>Fecha de ingreso</th>
                    <th>Fecha de creación</th>
                    <th>Fecha de actualización</th>
                    <th>Status</th>
                    <th>Empleado modifico</th>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <th>Opciones</th>
                    <th>Nombre</th>
                    <th>Primer apellido</th>
                    <th>Departamento</th>
                    <th>Jefe</th>
                    <th>Fechaa de ingreso</th>
                    <th>Fecha de creación</th>
                    <th>Fecha de actualización</th>
                    <th>Status</th>
                    <th>Empleado modifico</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.department table  -->
        <!-- insert new department form -->
            <div class="panel-body" id="formInsertData">
                <form name="formIns" id="formIns" method="POST" class="row">
                <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <label for="descripcion">Nombre del Empleado</label>
                    <input type="hidden" name="idEmpleado" id="idEmpleado"> 
                    <input type="text" class="form-control" name="nombre" id="nombre" maxlength="256" placeholder="Nombre del empleado" required>
                </div>
                <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <label for="apellido_p">Apellido paterno</label>
                    <input type="text" class="form-control" name="apellido_p" id="apellido_p" maxlength="256" placeholder="Apellido paterno" required>
                </div>
                <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <label for="apellido_m">Apellido materno</label>
                    <input type="text" class="form-control" name="apellido_m" id="apellido_m" maxlength="256" placeholder="Apellido materno" >
                </div>
                <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <label for="email">Email</label> 
                    <div class="input-group mb-2">
                        <div class="input-group-pretend">
                            <div class="input-group-text">@</div>
                        </div>
                        <input type="email" class="form-control" name="email" id="email" maxlength="256" placeholder="Email" required>
                    </div>
                </div>
                <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <label for="fecha_entrada">Fecha de entrada</label>
                    <input type="date" class="form-control" name="fecha_entrada" id="fecha_entrada" maxlength="256" placeholder="fecha" required>
                </div>
                <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <label for="fecha_baja">Fecha de baja</label>
                    <input type="date" class="form-control" name="fecha_baja" id="fecha_baja" maxlength="256" placeholder="fecha" >
                </div>
                <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <label for="idDepartamento">Departameto</label>
                    <select name="idDepartamento" class="form-control selectpicker" data-live-search="true" id="idDepartamento" required></select>
                </div>
                <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <label for="idJefe">Jefe</label>
                    <select name="idJefe" class="form-control selectpicker" data-live-search="true" id="idJefe" ></select>
                </div>
                <div class="form-check col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <label for="esJefe">¿Es jefe?</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" name="esJefe" id="esJefe" >
                        <label for="esJefe" class="custom-control-label">SI</label>
                    </div>
                </div>
                <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <label for="usuario">Nombre del usuario</label>
                    <input type="text" class="form-control" name="usuario" id="usuario" maxlength="256" placeholder="Usuario" required>
                </div>
                <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <label for="pwd">Contraseña</label>
                    <input type="password"class="form-control" name="pwd" id="pwd" maxlength="256" placeholder="Contraseña" required>
                </div>
                <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <label>Foto del empleado</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="foto" id="foto" >
                        <label for="foto" class="custom-file-label">Foto</label>
                    </div>
                </div>
                <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <button class="btn btn-primary" id="btn_guardar" type="submit">
                    <i class="fas fa-save"></i> Guardar
                    </button>
                    <button class="btn btn-warning" id="btn_cancelar" type="clear" onclick="cancelarForm()">
                    <i class="fas fa-arrow-circle-left"></i> Cancelar
                    </button>
                </div>
                <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <input type="hidden" id="fotoActual" name="fotoActual">
                    <img src="" width="150px" height="150px" id="imagenMuestra">
                </div>
                </form>
            </div>
            <!-- /.insert new department form -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
require "footer.php"
?>
<script type="text/javascript" src="../scripts/empleado.js"></script>