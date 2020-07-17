		              </div>
		            </div>
		          </div>	
				<!-- /.col-md-6 -->             
         	</div>
         </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


 



  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap 4 -->
<script src="<?=url?>assent/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=url?>assent/dist/js/adminlte.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?=url?>assent/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="<?=url?>assent/plugins/moment/moment.min.js"></script>
<script src="<?=url?>assent/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
<!-- date-range-picker -->
<script src="<?=url?>assent/plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?=url?>assent/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?=url?>assent/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?=url?>assent/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=url?>assent/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=url?>assent/dist/js/demo.js"></script>
<!-- Page script -->
<!-- SweetAlert2 -->
<script src="<?=url?>assent/plugins/sweetalert2/sweetalert2.min.js"></script>

  <script type="text/javascript">
    $(document).ready( function () {
        $('#table_id').DataTable({
        language: {
          processing:     "Traitement en cours...",
          search:         "Buscar:",
          lengthMenu:    "De _MENU_ Elementos",
          info:           "Registro _START_ de _END_  _TOTAL_ Elementos",
          infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
          infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
          infoPostFix:    "",
          loadingRecords: "Chargement en cours...",
          zeroRecords:    "Tabla de datos vacia",
          emptyTable:     "Tabla de Datos Vacia",
          paginate: {
              first:      "Primero",
              previous:   "Atras",
              next:       "Sigueinte",
              last:       "Atras"
          },
          aria: {
              sortAscending:  ": activer pour trier la colonne par ordre croissant",
              sortDescending: ": activer pour trier la colonne par ordre décroissant"
            }
        }

        });
      
    } );
  </script>


</script>
  <script type="text/javascript">
  
    $(document).ready(function(){
        $('#miunidad').select2();
    });

    $(document).ready(function(){
      $('#talleres').select2();
    });

    $(document).ready(function(){
      $('#sucursales').select2();
    });

    $(document).ready(function(){
      $('#estatus').select2();
    });

  </script>


</body>
<?php borrarErrores(); ?>
</html>

