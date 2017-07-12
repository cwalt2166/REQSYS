<?php


  date_default_timezone_set('America/New_York');

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

  require_once('inserts/setUpDB.php');

		if(session_id() == ''){
	    //session has not started
	    session_start();
	    $requestorID = $_SESSION['sessCustomerID'];
	  }

			include('inserts/xcrud/xcrud.php');

			$purchasers_xcrud = Xcrud::get_instance()->table('tblemployees');
			$purchasers_xcrud->relation('GroupID','tblgroups','GroupID',array('aFirstName','aLastName'));
			$purchasers_xcrud->relation('UserLevel','tblroles','roleID','roleType');

			// hide columns
			$purchasers_xcrud->columns('PID,role', true);
			$purchasers_xcrud->label('UID','Directory ID');
			$purchasers_xcrud->label('FirstName','First Name');
			$purchasers_xcrud->label('LastName','Last Name');
			$purchasers_xcrud->label('Telephone','Telephone');
			$purchasers_xcrud->label('GroupID','Approver');
			$purchasers_xcrud->label('UserLevel','Role');
			$purchasers_xcrud->label('CreditLevel','Spending Limit');
			$purchasers_xcrud->change_type('UserLevel','select','UserLevel','0,2');
			$purchasers_xcrud->validation_required('UID');
			$purchasers_xcrud->validation_required('GroupID');
			$purchasers_xcrud->validation_required('CreditLevel');
			$purchasers_xcrud->validation_required('FirstName');
			$purchasers_xcrud->validation_required('LastName');
			$purchasers_xcrud->validation_required('Email');
			$purchasers_xcrud->validation_required('UserLevel');
			$purchasers_xcrud->after_insert('send_email_confirmation', 'functions.php');

			$purchasers_xcrud->unset_view();

			//$purchasers_xcrud->validation_required(array('VENDOR_NAME' => 1, 'VENDOR_PHONE' => 3, 'VENDOR_URL' => 3));
			//$purchasers_xcrud->before_insert('encode_vendor_name');
			$purchasers_xcrud->order_by('LastName','asc');
			$purchasers_xcrud->limit(25);
			$purchasers_xcrud->unset_title();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Department of Chemistry & Biochemistry | Purchasing System</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="shortcut icon" href="assets/img/favicon.ico" />
<!-- Bootstrap 3.3.6 -->
<link rel="stylesheet" href="bootstrap/3/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
<link rel="stylesheet" href="dist/css/skins/skin-red.min.css">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<link href="assets/css/bootstrap-datepicker.css" rel="stylesheet" />
<link rel="stylesheet" href="dist/css/animate.css">
<link rel="stylesheet" href="dist/css/custom.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-red sidebar-mini fuelux" id="dashboard">
<div class="wrapper">

  <!-- Main Header -->
     <?php include_once dirname(__FILE__) . '/dist/includes/header.inc';?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->


      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <?php include_once dirname(__FILE__) . '/dist/includes/side_bar_menu.inc';?>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

      <?php include_once dirname(__FILE__) . '/dist/includes/top_menu.inc';?>
    <!-- Main content -->
    <section class="content">

<h1><i class="fa fa-users" aria-hidden="true"></i> All Purchasers</h1>

<?php
 echo $purchasers_xcrud->render();?>

<div class="ui divider"></div>


  </div>


  <!-- Your Content Ends Here -->

</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
    <?php include_once dirname(__FILE__) . '/dist/includes/footer.inc';?>


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/plugins/canvas-to-blob.min.js" type="text/javascript"></script>
<script src="js/fileinput.min.js" type="text/javascript"></script>
<script src="responsive/responsive-nav.min.js" type="text/javascript"></script>
<script src="//www.fuelcdn.com/fuelux/3.13.0/js/fuelux.min.js"></script>
<script src="http://getfuelux.com/assets/vendor/requirejs/require.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<script src="js/jquery.maskedinput.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/notify.min.js"></script>
<script src="js/ct-navbar.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="semantic/dist/semantic.min.js"></script>
</div>
</div>
</body>
</html>
