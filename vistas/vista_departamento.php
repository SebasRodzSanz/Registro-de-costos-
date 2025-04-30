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
            <h3 class="card-title">DEPARTAMENTOS</h3>
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
                      <tr>
                          <td>Opciones</td>
                          <td>Sistemas</td>
                          <td>27/04/2025</td>
                          <td>27/04/2025</td>
                          <td>1</td>
                          <td>12</td>
                      </tr>
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
                    <label for="descripcion">Nombre del departamento</label>
                    <input type="hidden" name="idDepartamento" id="idDepartamento"> 
                    <input type="text" name="descripcion" id="descripcion" maxlength="256" placeholder="Nombre Departamento" required>
                  </div>
                  <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <button class="btn btn-primary" id="btn_guardar" type="submit">Guardar</button>
                    <button class="btn btn-warning" id="btn_cancelar" type="clear">Cancelar</button>
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
