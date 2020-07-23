<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/')?>images/favicon.png">
    <title><?= NAMA_APLIKASI?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('assets/')?>node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- page css -->
    <link href="<?= base_url('assets/')?>css/pages/login-register-lock.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('assets/')?>css/style.css" rel="stylesheet">
    
    <!-- You can change the theme colors from here -->
    <link href="<?= base_url('assets/')?>css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="card-no-border">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label"><?= NAMA_APLIKASI?></p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper">
        <div class="login-register">
            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginform">
                    	<h2 class="text-center"><b>Pilih Menu Login </b></h2>
                    	<br/>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <a href="<?=site_url('auth/login');?>" class="btn btn-block btn-md btn-warning">Puskeswan</a>
                            </div>
                            <div class="col-xs-12 p-b-20">
                                <a href="<?=site_url('member');?>" class="btn btn-block btn-md btn-primary">Member</a>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <a href="<?= site_url('user/index')?>">Kembali ke Beranda</a>
                                <p><?= NAMA_APLIKASI?></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= base_url('assets/')?>node_modules/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url('assets/')?>node_modules/bootstrap/js/popper.min.js"></script>
    <script src="<?= base_url('assets/')?>node_modules/bootstrap/js/bootstrap.min.js"></script>
    <!--Custom JavaScript -->
    <script type="text/javascript">
        $(function() {
            $(".preloader").fadeOut();
        });
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
        // ============================================================== 
        // Login and Recover Password 
        // ============================================================== 
        $('#to-recover').on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
        
        $("#loginform").submit(function(e){
			e.preventDefault();
			$.ajax({
				url : "<?= site_url('Auth/prosessLogin')?>",
				data : new FormData($(this)[0]),
				type: 'POST',
			    contentType: false,
			    processData: false,
				success : function(e){
					if(e==1){
						window.location = "<?= site_url('dashboard')?>";
					}else{
						
					}
				}
			});
		});
    </script>
    
</body>

</html>