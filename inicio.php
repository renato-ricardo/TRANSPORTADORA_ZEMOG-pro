<?php 

require 'includes/redireccion.php';
require_once 'includes/tipoUsuario.php';
//require 'includes/layout/header.php';



 ?>
<div class="card-header">
	<h3>Bienvenido</h3>
	<?php require_once 'dashboard/Unidadesdashboard.php'; ?>
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











<?php require 'includes/layout/footer.php'; ?>