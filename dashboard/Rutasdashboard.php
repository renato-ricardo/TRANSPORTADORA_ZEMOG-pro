<?php $numeroRutas = contarRegistros("rutas");  ?>

<div class="container">
 <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h2>Registros</h2>
              <p>Numero de Rutas : <?php echo $numeroRutas; ?></p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
              <a href="logica/excelUnidades.php" class="small-box-footer">Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h2>Registros</h2>

              <p>Numero de Unidades Activas</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="logica/excelUnidades.php"class="small-box-footer">Mas Informacion<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h2>Registros</h2>

              <p>Unidades Inactivas</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="logica/excelUnidades.php" class="small-box-footer">Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h2>Registros</h2>

              <p>Unidades Inactivas</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="logica/excelUnidades.php" class="small-box-footer">Mas Informacion <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
    </div>
  </div>