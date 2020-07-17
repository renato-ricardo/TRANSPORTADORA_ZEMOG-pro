<?php 

  require 'includes/redireccion.php';
  require_once 'includes/tipoUsuario.php';
  require_once 'includes/metricasFunciones.php';

  $funcionesMetrica = new metricasFunciones();
  $indicadores = $funcionesMetrica->mostrarDatos();
  $indicadoresRemolque = $funcionesMetrica->mostrarRemolques();
  $estatus_sucursales = $funcionesMetrica->mostrarEstatus();

?>
<div class="card-header">
	<h3>Bienvenido</h3>

</div>


 <div class="card">
  <div class="card-header border-transparent">
    <h3 class="card-title">Numero de Tractores</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body p-0">
    <div class="table-responsive">

    </div>
    <!-- /.table-responsive -->
  </div>
  <!-- /.card-body -->
  <div class="card-footer clearfix">

  </div>
  <!-- /.card-footer -->
  <div class="card-footer">	
<h1>Numero de Unidades Detenidas MOTRIZ </h1>
<a href="#" class="btn btn-primary">Exportar Excel</a><br>
<table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>OPERACION</th>	
        <th>SUCURSAL</th>	
        <th>TOTAL UNIDADES</th>	
        <th>TALLER</th>	
        <th>% EN TALLER</th>	
        <th>TOTAL CONSIGNADOS</th>	
        <th>% DE CONSIGNADOS</th>	
        <th>SINIESTRO</th>	
        <th>% DE SINIESTROS</th>	
        <th>TOTAL INSIDENCIAS</th>	
        <th>DISPONIBLES</th>	
        <th>% DISPONIBILIDAD</th>	
      </tr>
        </thead>
          <tbody>
            <?php foreach($indicadores as $rows): ?>
          <tr>
          <td><?php echo $rows['nombreOperacion']; ?></td>
          <td><?php echo $rows['nombreSucursal']; ?></td>
          <td><?php echo $rows['NUMERO_TOTAL_UNIDADES']; ?></td>
          <td><?php echo $rows['TALLER']; ?></td>
          <td><?php echo $rows['%HOY_TALLER'] . '%'; ?></td>
          <td><?php echo $rows['CONSIGNADOS']; ?></td>
          <td><?php echo $rows['%HOY_CONSIGNADOS'] . '%'; ?></td>
          <td><?php echo $rows['SINIESTRO']; ?></td>
          <td><?php echo $rows['%HOY_SINIESTRO'] . '%'; ?></td>
          <td><?php echo $rows['TOTAL_DE_DETENIDAS']; ?></td>
          <td><?php echo $rows['DISPONIBLES']; ?></td>
          <td><?php echo $rows['%HOY'] . '%'; ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
        </table >	

        <h1>TOP 10 dias detenidas </h1>
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>#</th>	
                    <th>ECONOMICO</th>	
                    <th>OPERACION</th>	
                    <th>FECHA INGRESO</th>	
                    <th>FECHA PROMESA</th>	
                    <th>DIAS FUERA</th>	
                    <th>ESTATUS</th>	
                  </tr>
                    </thead>
                      <tbody>
                        <?php $conn = 1; foreach($estatus_sucursales as $rows): ?>
                      <tr>
                      <td><?php echo $conn; ?></td>
                      <td><?php echo $rows['ECONOMICO']; ?></td>
                      <td><?php echo $rows['OPERACION']; ?></td>
                      <td><?php echo $rows['fechaIngreso']; ?></td>
                      <td><?php echo $rows['fechaPromesa']; ?></td>
                      <td><?php echo $rows['DiasFuera']; ?></td>
                      <td><?php echo $rows['ESTATUS']; ?></td>
                    </tr>
                    <?php
                      $conn ++;
                  endforeach; ?>
                    </tbody>
                    </table >	

                  </div>

              <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Numero de Remolques</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">

                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">

              </div>
              <!-- /.card-footer -->
              <div class="card-footer">	
        <h1>Numero de Unidades Detenidas ARRASTRE </h1>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>OPERACION</th>	
          <th>SUCURSAL</th>	
          <th>UNIDADES DETENIDAS</th>	
          <th>DISPONIBLES</th>	
          <th>TOTAL_UNIDADES</th>	
          <th>% PORCENTAJE DISPONIBLE</th>	
        </tr>
          </thead>
            <tbody>
              <?php foreach($indicadoresRemolque as $rows): ?>
            <tr>
            <td><?php echo $rows['OPERACION']; ?></td>
            <td><?php echo $rows['SUCURSALES']; ?></td>
            <td><?php echo $rows['DETENIDAS']; ?></td>
            <td><?php echo $rows['DISPONIBLES']; ?></td>
            <td><?php echo $rows['TOTAL_UNIDADES']; ?></td>
            <td><?php echo $rows['% PORCENTAJE DISPONIBLE'] . '%'; ?></td>
          </tr>
          <?php endforeach; ?>
          </tbody>
          </table >	
          
                  </div>


              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">

                </div>
                <!-- /.table-responsive -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">

              </div>
              <!-- /.card-footer -->
              <div class="card-footer">	
 
        
              <?php require 'includes/layout/footer.php'; ?>

        