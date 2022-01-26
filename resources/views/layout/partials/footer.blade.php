<!-- jQuery -->
<script type="text/javascript" src="/assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script type="text/javascript" src="/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script type="text/javascript">
  $.widget.bridge('uibutton', $.ui.button)
  
  APP.token = '{{ csrf_token() }}';
  
</script>
<!-- Bootstrap 4 -->
<script type="text/javascript" src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script type="text/javascript" src="/assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script type="text/javascript" src="/assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script type="text/javascript" src="/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script type="text/javascript" src="/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script type="text/javascript" src="/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="/assets/plugins/moment/moment.min.js"></script>
<script type="text/javascript" src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script type="text/javascript" src="/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script type="text/javascript" src="/assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script type="text/javascript" src="/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script type="text/javascript" src="/assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="/assets/dist/js/demo.js"></script>-->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script type="text/javascript" src="/assets/dist/js/pages/dashboard.js"></script>

<script type="text/javascript" src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script type="text/javascript" src="/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>

<script type="text/javascript" src="/js/app.js"></script>

@yield('javascript')