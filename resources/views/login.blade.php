<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Credcoop Meetings - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <link rel="shortcut icon" href="<?php echo asset('img/favicon.ico')?>" />

</head>

<body  >
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 mb-4" style="color:#00ae9d">Bem Vindo!</h1>
                  </div>
                  <form class="user" action="auth" method="post">
                    {!! csrf_field() !!}
                    <div class="form-group">
                      <input required type="text" class="form-control form-control-user" id="user" name="user" aria-describedby="emailHelp" placeholder="Digite o seu usuário">
                    </div>
                    <div class="form-group">
                      <input required type="password" class="form-control form-control-user" id="password" name="password" placeholder="Senha">
                    </div>
                    <hr>
                    <div class="form-group">
                      <input type="submit"  style="background-color:#00ae9d; color:#ffffff" class="btn btn-user btn-block" id="submitLogin" value="Login">
                    </div>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" style="color:#00ae9d" href="forgot-password.html">Esqueceu sua senha?</a>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      <div class="row">
			@if($message = Session::get('errors'))
			
			  <script type="text/javascript">
				  $(document).ready(function(){
  					alert("{{$message}}");
				  });
			  </script>

			
			  @endif
		  </div>
      </div>
      <div class="row justify-content-center">
          <img src="img/logo.png" width="30%">
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
