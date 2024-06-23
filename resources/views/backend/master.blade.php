<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard 2</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('include/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('include/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('include/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('include/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('include/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('include/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{asset('include/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
  </div>
  @include('backend.header')
  @include('backend.sidebar')
@yield('container')
@include('backend.footer')
<!-- ./wrapper -->
</div>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('include/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('include/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('include/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('include/dist/js/adminlte.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('include/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('include/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('include/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('include/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('include/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('include/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('include/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('include/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('include/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('include/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('include/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('include/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('include/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('include/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('include/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('include/plugins/chart.js/Chart.min.js')}}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('include/dist/js/demo.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('include/dist/js/pages/dashboard2.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $(".btn-success").click(function(){ 
          var lsthmtl = $(".clone").html();
          $(".increment").after(lsthmtl);
      });
      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".hdtuto").remove();
      });
    });
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
