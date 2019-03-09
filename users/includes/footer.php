<!-- Footer -->
<footer class="py-5 bg-primary">
  <div class="container">
    <p class="m-0 text-center text-white"><?php echo _l_copyright; ?> &copy; <script>document.write(new Date().getFullYear());</script> <?php echo _l_topic; ?></p>
  </div>
  <!-- /.container -->
</footer>
<!-- page script -->
<!-- jQuery 3 -->
<script src="../admin/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../admin/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="../admin/bower_components/raphael/raphael.min.js"></script>
<script src="../admin/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="../admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../admin/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../admin/bower_components/moment/min/moment.min.js"></script>
<script src="../admin/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- DataTables -->
<script src="../admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="../admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- Select2 -->
<script src="../admin/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- FastClick -->
<script src="../admin/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<!-- CK Editor -->
<script src="../admin/bower_components/ckeditor/ckeditor.js"></script>
<script src="../admin/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../admin/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../admin/dist/js/demo.js"></script>

<script>
  $(function () {
   
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  });
  $(function(){
        //Initialize Select2 Elements
    $('.select2').select2()    
    
    CKEDITOR.replace('editor1')
  });
</script>

  </body>

</html>
