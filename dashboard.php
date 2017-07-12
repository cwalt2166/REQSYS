<?php
require_once('inserts/secureApp.php');
require_once('inserts/setUpDB.php');

  $requestorID = $_SESSION['sessCustomerID'];
  $id=0;
  $start=0;
  $limit=25;

    if (isset($_GET['id'])) {
        $id=$_GET['id'];
        $start=($id-1)*$limit;
    }

  //Format widget dates into something MYSQL understands

  $_POST['reqNumber'] = isset($_POST['reqNumber']) ? $_POST['reqNumber'] : '';
  //$_POST['frsNumber'] = isset($_POST['frsNumber']) ? $_POST['frsNumber'] : '';
  $_POST['VENDOR_NAME'] = isset($_POST['VENDOR_NAME']) ? $_POST['VENDOR_NAME'] : '';


    if (
    ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['dash-search']))
    && (!(empty($_POST['reqNumber'])) || !(empty($_POST['frsNumber'])))) {
        $where = new WhereClause('and'); // create a WHERE statement of pieces joined by ANDs
        $where->add('requestorID=%s', $requestorID);
        $where->add('reqNumber LIKE %s', $_POST['reqNumber']);
        //$where->add('frsNumber LIKE %s', $_POST['frsNumber']);
        $subclause = $where->addClause('or'); // add a sub-clause with ORs
        //$subclause->add('dateSubmitted LIKE %s', $_POST['dateSubmitted']);
        //$subclause->add('dateOrdered LIKE %s', $_POST['dateOrdered']);

        $subclause->add('orderStatus = %s', 'NEW');
        $subclause->add('orderStatus = %s', 'PENDING');
        $subclause->add('orderStatus = %s', 'APPROVED');
        $subclause->add('orderStatus = %s', 'ORDERED');
        $subclause->add('orderStatus = %s', 'NOTIFICATION SENT');
        $subclause->add('orderStatus = %s', 'PARTIALLY-SHIPPED');


        $getOrderDashboards = DB::query("SELECT * FROM tblorders WHERE %l  AND dateSubmitted >= DATE_ADD( NOW(), INTERVAL -6 MONTH ) ORDER BY requisitionID DESC LIMIT  $start, $limit", $where);
        //$_SESSION['counter'] = DB::count();
    } else {
        $where = new WhereClause('and'); // create a WHERE statement of pieces joined by ANDs
        $where->add('requestorID=%s', $requestorID);
        $subclause = $where->addClause('or'); // add a sub-clause with ORs
        $subclause->add('orderStatus = %s', 'NEW');
        $subclause->add('orderStatus = %s', 'PENDING');
        $subclause->add('orderStatus = %s', 'ORDERED');
        $subclause->add('orderStatus = %s', 'NOTIFICATION SENT');
        $subclause->add('orderStatus = %s', 'PARTIALLY-SHIPPED');

        $getOrderDashboards = DB::query("SELECT * FROM tblorders WHERE %l AND dateSubmitted >= DATE_ADD( NOW(), INTERVAL -6 MONTH ) ORDER BY requisitionID DESC LIMIT $start, $limit", $where);
        $_SESSION['counter'] = DB::count();
    }



         $getOrderCnt = DB::query("SELECT * FROM tblorders WHERE requestorID='$requestorID' AND orderStatus IN('NEW', 'PENDING','ORDERED','NOTIFICATION SENT','PARTIALLY-SHIPPED') AND dateSubmitted >= DATE_ADD( NOW(), INTERVAL -6 MONTH )");
         $_SESSION['counter'] = DB::count();
         $total = ceil(DB::count()/$limit);


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
<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Raleway:800" rel="stylesheet">
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

<h1>MY ACCOUNT DASHBOARD</h1>
<p>The My Account Dashboard page gives you a realtime view of your recent account activity and order management information. Select a link above or to the left of this screen to view or edit information.</p>
<form action="" method="POST" name="searchForm"  class="ui form">
<div class="ui form">
  <div class="three fields">

    <div class="field">
      <label><strong>Filter By Requisition #<strong></label>
      <input type="text" name="reqNumber" id="reqNumber" placeholder="<?php print $_POST['reqNumber'];?>">
    </div>

    <div class="field">

    </div>
    <div class="field">

    </div>

  </div>
   <button class="ui compact labeled icon button" name="dash-search">
  <i class="search icon"></i>
 Search
</button>
   <a href="dashboard.php" class="ui compact labeled icon button" name="dash-search">
  <i class="history icon"></i>
 Reset
</a>
</div>
</form>


<div class="ui divider"></div>
 <div class="table-responsive">
 	<?php if ($_SESSION['counter'] > 0) {
    ?>
    <table class="table">
    <thead>
      <tr>
      	<th>#</th>
      	<th>Requisition #</th>
      	<th>Workflow Status</th>
      	<th>Submitted</th>
        <th>Order Total</th>
    	  <th>Supplier</th>
        <th>Tracking Number</th>
        <th>Order Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    	<?php
        $tmpCount = 1;
    foreach ($getOrderDashboards as $orderDashboardItem) {
      switch ($orderDashboardItem["orderStatus"]) {

           case 'PENDING':
               $circled = 1;
               break;
           case 'APPROVED':
               $circled = 2;
               break;
           case 'ORDERED':
               $circled = 3;
               break;
           case 'PARTIALLY-SHIPPED':
               $circled = 4;
               break;
           case 'NOTIFICATION SENT':
               $circled = 5;
               break;
           //case 'COMPLETE':
               //$circled = 4;
              // break;
           default:
               $circled = -1;
       }
        ?>
      <tr>
      	<td>  <a data-toggle="collapse" href="#collapse-<?php echo $orderDashboardItem["reqNumber"];?>" aria-expanded="false" aria-controls="collapse-<?php echo $orderDashboardItem["reqNumber"];?>">
    <i class="fa fa-plus-square" aria-hidden="true"></i>
  </a></td>
      	<td><?php echo $orderDashboardItem["reqNumber"]; ?></td>

      	<td>
      		<?php echo ($circled > 0)  ? '  <a class="ui" data-tooltip="pending" data-position="top center" href="#"><img src="images/icon-check-circle.png"></a>' : '<img src="images/icon-empty-circle.png">'; ?>
      		<?php echo ($circled > 1)  ? '  <a class="ui" data-tooltip="approved" data-position="top center" href="#"><img src="images/icon-check-circle.png"></a>' : '<img src="images/icon-empty-circle.png">'; ?>
      		<?php echo ($circled > 2)  ? '  <a class="ui" data-tooltip="ordered" data-position="top center" href="#"><img src="images/icon-check-circle.png"></a>' : '<img src="images/icon-empty-circle.png">'; ?>
          <?php echo ($circled > 3)  ? '  <a class="ui" data-tooltip="received" data-position="top center" href="#"><img src="images/icon-check-circle.png"></a>' : '<img src="images/icon-empty-circle.png">'; ?>
      		<?php echo ($circled > 4)  ? '  <a class="ui" data-tooltip="ready for pickup" data-position="top center" href="#"><img src="images/icon-check-circle.png"></a>' : '<img src="images/icon-empty-circle.png">'; ?>
      		</td>
      		<td><?php echo date("m/d/Y  g:i A", strtotime($orderDashboardItem["dateSubmitted"])); ?></td>
        <td><?php echo money_format('%(#6.2n', $orderDashboardItem["ordertotal"]); ?></td>
     	  <td><?php echo $orderDashboardItem["VENDOR_NAME"]; ?></td>
        <td><?php isset($orderDashboardItem["tracking_number"])? print '<a href="https://www.google.com/search?q='.$orderDashboardItem["tracking_number"].'">'.$orderDashboardItem["tracking_number"].'</a>': '--'; ?></td>
        <td><?php echo "<span class='badge label-default'>".strtolower($orderDashboardItem["orderStatus"])."</span>";?></td>

        <td style="background-color:#fff;">
          <div class="ui icon buttons">
            <?php echo (isset($orderDashboardItem["AdminNotes"]) && $orderDashboardItem["AdminNotes"] !="")?
            '<a class="ui button"  data-toggle="modal" data-target="#'.$orderDashboardItem["requisitionID"].'-ModalLong">
            <i class="fa fa-pencil-square" aria-hidden="true"></i>
          </a>':''; ?>

          <?php echo($orderDashboardItem["orderStatus"] == 'NEW'? '
				  <a class="ui button" data-tooltip="resume" data-position="top center" href="viewCart.php?ref='.$orderDashboardItem["requisitionID"].'">
				    <i class="mail forward icon"></i>
				  </a>
				  <a href="inserts/cartAction.php?action=cancelOrder&id='.$orderDashboardItem["orderID"].'" class="negative ui button" data-tooltip="delete" data-position="top center"  onclick="return confirm(\'Are you sure you want to cancel this order?\')">
				    <i class="trash icon"></i>
				  </a>' : '<div class="ui icon buttons">
				  <a class="ui button" data-tooltip="view details" data-position="top center" href="viewDetails.php?ref='.$orderDashboardItem["orderID"].'">
				    <i class="external icon"></i>
				  </a>
				  '); ?></td>
      </tr>
      <tr>
        <td colspan="10">
        <div class="collapse" id="collapse-<?php echo $orderDashboardItem["reqNumber"];?>">
          <div class="card card-block">
            <?php
            $cart=array();
            $cart = DB::query("SELECT * FROM tblorder_items WHERE orderID=%s", $orderDashboardItem['orderID']);

            ?>
            <table class="table shopping-cart black-border">
            <thead>
            	<tr>
            			<th>Product</th>
            			<th>Description</th>
            			<th style="text-align:right">Price</th>
            			<th style="text-align:center">Qty</th>
            			<th style="text-align:right" nowrap>Ext. Price</th>
            			<th>Availability</th>
            	</tr>
            </thead>
            <tbody>
            	<?php

            			//get cart items from query

            			foreach($cart as $item){
            	?>
            	<tr>
            			<td style="text-align:right;" nowrap><?php echo $item['product']; ?></td>
            			 <td><?php echo $item["description"]; ?></td>
            			<td style="text-align:right" nowrap><?php echo money_format('%(#5.2n', $item["actual_price"]); ?></td>
            			<td style="text-align:center"><?php echo $item["actual_quantity"]; ?></td>
            			<td style="text-align:right" nowrap><?php echo money_format('%(#5.2n', $item["actual_quantity"] * $item["actual_price"]); ?></td>
            			<td nowrap><?php echo ($circled  >= 3)  ? '<span class="cart badge">'.$item['item_availability'].'</span>' : '---'; ?></td>
            	</tr>
            	<?php } ?>


            </tbody>
            <tfoot>
            																<tr>

            																		<td colspan="5"></td>
            																		<?php if($orderDashboardItem['ordertotal'] > 0){ ?>
            																		<td class="text-center large" style="color:#111111; font-weight:bold;" nowrap>TOTAL: <?php echo money_format('%(#5.2n', $orderDashboardItem['ordertotal']); ?></td>


            																		<?php } ?>
            																</tr>
            														</tfoot>
            </table>
          </div>


        </div>
        <!-- Modal -->
        <div class="modal fade" id="<?php echo $orderDashboardItem["requisitionID"];?>-ModalLong" tabindex="-1" role="dialog" aria-labelledby="<?php echo $orderDashboardItem["reqNumber"];?>-ModalLongTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5>Business Office Notes</h5>
              </div>
              <div class="modal-body">
                <?php echo $orderDashboardItem["AdminNotes"];?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

              </div>
            </div>
          </div></div>
      </td></tr>
    </div>
       <?php
    } ?>
    </tbody>
  </table>
<?php
} else {
    print '<div class="ui error message"><strong>No Active Orders Found:</strong> Your search query did not return any results, or you have no open requisition requests</div>';
}?>

  <div class="ui divider"></div>
  <div class="ui buttons">
  <?php
          if ($id>1) {
              echo "<a href='?id=".($id-1)."' class='ui labeled icon button'><i class='left chevron icon'></i>Previous</a>";
          }
                if ($id!=$total) {
                    echo "<a href='?id=".($id+1)."' class='ui right labeled icon button'>Next<i class='right chevron icon'></i></a>";
                }
                echo " </div>";
                echo "<ul class='page'>";
                for ($i=1;$i<=$total;$i++) {
                    if ($i==$id) {
                        echo "<li class='current'>".$i."</li>";
                    } else {
                        echo "<li><a href='?id=".$i."'>".$i."</a></li>";
                    }
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
