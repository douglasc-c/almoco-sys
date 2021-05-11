<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<title>
	@section('title')
      {{{$title}}}
    @show
</title>
<link rel="icon" href="/assets/images/favicon.png" type="image/x-png">
<link rel="stylesheet" href="/assets/theme/plugins/bootstrap/css/bootstrap.min.css">

<link rel="stylesheet" href="/assets/theme/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css"/>
<link rel="stylesheet" href="/assets/theme/plugins/morrisjs/morris.min.css" />
<link rel="stylesheet" href="/assets/theme/css/amaze.style.min.css">

<link href="/assets/theme-v4/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/theme-v4/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/theme-v4/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@yield('styles')
        
@section('scripts_default')

<script src="/assets/theme/bundles/libscripts.bundle.js"></script>
<script src="/assets/theme/bundles/vendorscripts.bundle.js"></script>

<script src="/assets/theme/bundles/apexcharts.bundle.js"></script>
<script src="/assets/theme/bundles/jvectormap.bundle.js"></script>

<script src="/assets/theme/bundles/mainscripts.bundle.js"></script>
<script src="/assets/theme/js/pages/index.js"></script>
<!-- <script src="/assets/theme-v4/assets/libs/jquery/jquery.min.js"></script> -->
<script src="/assets/theme-v4/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/theme-v4/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/theme-v4/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="/assets/theme-v4/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="/assets/theme-v4/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="/assets/theme-v4/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="/assets/theme-v4/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="/assets/theme-v4/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/assets/theme-v4/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>


<script type="text/javascript">
    $(document).ready(function() {
      $('#modal-dialog').on('show.bs.modal', function (e) {
          href = $(e.relatedTarget).attr('data-href');
          console.log(href);
          $(this).find('.modal-footer #confirm').attr('href', href);
      });
    });
</script>

@stop