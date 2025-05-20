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
                CATEGORIAS
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
                    <th>Descripción</th>
                    <th>Fecha de creación</th>
                    <th>Fecha de actualización</th>
                    <th>Status</th>
                    <th>Empleado modifico</th>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                <tr>
                    <td>Opciones</td>
                    <td>Descripción</td>
                    <td>Fecha de creación</td>
                    <td>Fecha de actualización</td>
                    <td>Status</td>
                    <td>Empleado modifico</td>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.department table  -->
        <!-- insert new department form -->
            <div class="panel-body" id="formInsertData">
                <form name="formIns" id="formIns" method="POST">
                <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <label for="descripcion">Nombre de la Categoria</label>
                    <input type="hidden" name="idCategoria" id="idCategoria"> 
                    <input type="text" name="descripcion" id="descripcion" maxlength="256" placeholder="Nombre de la Categoria" required>
                </div>
                <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <button class="btn btn-primary" id="btn_guardar" type="submit">
                    <i class="fas fa-save"></i> Guardar
                    </button>
                    <button class="btn btn-warning" id="btn_cancelar" type="clear" onclick="cancelarForm()">
                    <i class="fas fa-arrow-circle-left"></i> Cancelar
                    </button>
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
<script type="text/javascript" src="../scripts/categoria.js"></script>