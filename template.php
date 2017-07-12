<?php

	// Turn off all error reporting
	error_reporting(0);
	
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
	  
  include('lazy_mofo.php');
	
	// required for csv export
	ob_start();
	
	// connect to database with pdo
	$dbh = new PDO("mysql:host=localhost;dbname=proms2;", 'root', '');
	
	// create LM object, pass in PDO connection
	$lm = new lazy_mofo($dbh); 
	
	// table name for updates, inserts and deletes
	$lm->table = 'market';
	
	// identity / primary key column name
	$lm->identity_name = 'market_id';

  
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
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
    	
<h1>Order Status</h1>

<?php 	// use the lm controller 
	$lm->run();
	?>

<div class="ui divider"></div>

 	<?php if ($_SESSION['counter'] > 0) {?>  
    <table class="table">
    <thead>
      <tr>
      	<th>#</th>
      	<th>Requisition #</th>
      	<th>Workflow Status</th>
      	<th>Submitted</th>
        <th>Charged To</th>
        <th>Order Total</th>
    	  <th>Supplier</th>
        <th>Tracking Number</th>
        <th>Notes</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    	<?php  
    	$tmpCount = 1;
    	foreach($getOrderDashboards as $orderDashboardItem){?>
      <tr>
      	<td><?php echo ($start < 10)  ? $tmpCount++ : $start + $tmpCount++; ?></td>
      	<td><?php echo $orderDashboardItem["reqNumber"]; ?></td>
      
      	<td>
      		<?php echo ($orderDashboardItem["orderStatus"] > 0 )  ? '  <a class="ui" data-tooltip="pending" data-position="top center" href="#"><img src="images/icon-check-circle.png"></a>' : '<img src="images/icon-empty-circle.png">';?>
      		<?php echo ($orderDashboardItem["orderStatus"] > 1 )  ? '  <a class="ui" data-tooltip="approved" data-position="top center" href="#"><img src="images/icon-check-circle.png"></a>' : '<img src="images/icon-empty-circle.png">';?>	
      		<?php echo ($orderDashboardItem["orderStatus"] > 2 )  ? '  <a class="ui" data-tooltip="ordered" data-position="top center" href="#"><img src="images/icon-check-circle.png"></a>' : '<img src="images/icon-empty-circle.png">';?>	
      		<?php echo ($orderDashboardItem["orderStatus"] > 3 )  ? '  <a class="ui" data-tooltip="receiving" data-position="top center" href="#"><img src="images/icon-check-circle.png"></a>' : '<img src="images/icon-empty-circle.png">';?>	
      		</td>
      		<td><?php echo date("m/d/Y  g:i A", strtotime($orderDashboardItem["dateSubmitted"])); ?></td>
        <td><?php echo $orderDashboardItem["frsNumber"]; ?></td>
        <td>$ <?php echo $orderDashboardItem["ordertotal"]; ?></td>
     	  <td><?php echo $orderDashboardItem["VENDOR_NAME"]; ?></td>
        <td><?php isset($orderDashboardItem["tracking_number"])? print '<a href="https://www.google.com/search?q='.$orderDashboardItem["tracking_number"].'">'.$orderDashboardItem["tracking_number"].'</a>': '--';?></td>
        <td><?php echo ($orderDashboardItem["AdminNotes"] !='')?'<i class="big sticky note outline icon"></i>' : ''; ?>
        	
        	 
        	 </td>
        
        <td><?php echo ($orderDashboardItem["orderStatus"] == 'NEW'? '<div class="ui icon buttons">
				  <a class="ui button" data-tooltip="RESUME ORDER" data-position="top center" href="viewCart.php?ref='.$orderDashboardItem["orderID"].'">
				    <i class="mail forward icon"></i>
				  </a>
				  <button class="negative ui button" data-tooltip="DELETE ORDER" data-position="top center">
				    <i class="trash icon"></i>
				  </button>' : '<div class="ui icon buttons">
				  <a class="ui button" data-tooltip="VIEW DETAILS" data-position="top center" href="viewDetails.php?ref='.$orderDashboardItem["orderID"].'">
				    <i class="external icon"></i>
				  </a>
				  <button class="disabled ui button">
				    <i class="lock icon"></i>
				  </button>');?></td>
      </tr>
      
       <?php 
       
       } ?>
    </tbody>
  </table>
<?php }else {
	
	print '<div class="ui error message"><strong>No Active Orders Found:</strong> Your search query did not return any results, or you have no open requisition requests</div>';
	
}?>
  
  <div class="ui divider"></div>
  <div class="ui buttons">
  <?php
		  if($id>1)
				{
				echo "<a href='?id=".($id-1)."' class='ui labeled icon button'><i class='left chevron icon'></i>Previous</a>";
				}
				if($id!=$total)
				{
				echo "<a href='?id=".($id+1)."' class='ui right labeled icon button'>Next<i class='right chevron icon'></i></a>";
				}
				echo " </div>";
				echo "<ul class='page'>";
				for($i=1;$i<=$total;$i++)
				{
				if($i==$id) { echo "<li class='current'>".$i."</li>"; }
				
				else { echo "<li><a href='?id=".$i."'>".$i."</a></li>"; }
				}
				echo "</ul>";
	 ?>
	
  
  <div class="ui divider"></div>
  
  </div>
  <div class="jumbotron">
<p>The Procurement/Requisition and Order Management System allows designated departmental personnel to create, modify, and track purchase requisitions online. 
If you have questions concerning the Purchasing System, please consult the HELP section of this application</p>

<p>All Puchasers- The Requisition System allows you to create, modify, and view only the requisitions that you have initiated. Buyers can submit requisitions for departmental funding approval and monitor the receipt of the items online. Persons with 'Approver' privileges have the additional capability of making approve/reject decisions.</p>
      
      

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
