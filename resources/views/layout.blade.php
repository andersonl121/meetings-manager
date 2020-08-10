<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv=”Content-Type” content=”text/html; charset=iso-8859-1″>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Credcoop Meetings</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <link href="css/int.css" rel="stylesheet">
  <link rel="shortcut icon" href="<?php echo asset('img/favicon.ico')?>" />







</head>

<body id="page-top">

  <div id="wrapper">

    @yield('sidebar')




    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        @yield('topbar')


        @yield('content')



        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; Sicoob Credcoop 2020</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->

      </div>
      <!-- End of Content Wrapper -->
    </div>



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/int.js"></script>


    <script type="text/javascript">
      $('#documento').ready(function() {  
    setTimeout(function() {
       $('#documento').contents().find('#download').remove();
    }, 100);
 });
    </script>


<div class="row">
  @if($message = Session::get('errors'))
  
    <script type="text/javascript">
      $(document).ready(function(){
        alert("{{$message}}");
      });
    </script>

  
    @endif
  </div>


</body>