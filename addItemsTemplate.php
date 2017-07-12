<?php
  require_once('inserts/setUpSession.php');
  require_once('inserts/setUpDB.php');
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	date_default_timezone_set('America/New_York');
	$id = isset($_GET['id']) ? $_GET['id'] : -1 ;
	
	$getOrderDetails = DB::queryFirstRow("SELECT * FROM tblorders WHERE requisitionID =  %i", $id);
	
	$getShoppingCart = DB::query("SELECT * FROM tblorder_items WHERE orderID =  %i", $id);

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
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<script src="http://getfuelux.com/assets/vendor/requirejs/require.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<link href="css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<link href="assets/css/bootstrap-datepicker.css" rel="stylesheet" />
<link rel="stylesheet" href="dist/css/animate.css">
<link rel="stylesheet" href="dist/css/custom.css">
<script type="text/javascript" src="js/tabbedcontent.min.js"></script>
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
<body class="hold-transition skin-red sidebar-mini fuelux" id="viewOrderDetails" is="dmx-app">
<div class="wrapper">
  <!-- Main Header -->
  <?php include_once dirname(__FILE__) . '/dist/includes/header.inc';?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel"> <img src="dist/img/chem_logo.png" alt="Chemistry & Biochemistry" style="width:180px; padding-left:40px"></div>
      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span></div>
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
    <section class="content-header">
      <h1> Requisition & Order Management System </h1>
      <small class="opt-desc">REQUISITION ID | <?php echo $getOrderDetails['reqNumber'];?></small> </section>
    <!-- Main content -->
    <section class="content">
      <!-- Your Page Content Here -->
      <!-- Your Page Content Here -->
      <!-- Begin: life time stats -->
      <div class="portlet light portlet-fit portlet-datatable bordered">
        <div class="portlet-title"></div>
        <div class="portlet-body">
          <div class="tabbable-line">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="portlet yellow-crusta box">
                      <div class="portlet-title">
                        <div class="caption">  Order Details </div>
                        <div class="actions"> <a href="javascript:;" class="btn btn-default btn-sm"> <i class="fa fa-pencil"></i> Edit </a></div>
                      </div>
                      <div class="portlet-body">
                        <div class="row static-info">
                          <div class="col-md-5 name"> Order #: </div>
                          <div class="col-md-7 value"><?php echo $getOrderDetails['requisitionID'];?></div>
                        </div>
                        <div class="row static-info">
                          <div class="col-md-5 name"> Vendor: </div>
                          <div class="col-md-7 value"><?php echo $getOrderDetails['VENDOR_NAME'];?>  </div>
                        </div>
                        <div class="row static-info">
                          <div class="col-md-5 name"> Order Status: </div>
                          <div class="col-md-7 value"> <span class="label label-success"> <?php echo $getOrderDetails['orderStatus'];?>  </span></div>
                        </div>
                        <div class="row static-info">
                          <div class="col-md-5 name"> KFS Account: </div>
                          <div class="col-md-7 value"><?php echo $getOrderDetails['frsNumber'];?>  </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="portlet blue-hoki box">
                      <div class="portlet-title">
                        <div class="caption">  Customer Information </div>
                        <div class="actions"> <a href="javascript:;" class="btn btn-default btn-sm"> <i class="fa fa-pencil"></i> Edit </a></div>
                      </div>
                      <div class="portlet-body">
                        <div class="row static-info">
                          <div class="col-md-5 name"> Requestor Name: </div>
                          <div class="col-md-7 value"><?php echo $getOrderDetails['requestor'];?> </div>
                        </div>
                        <div class="row static-info">
                          <div class="col-md-5 name"> Email: </div>
                          <div class="col-md-7 value"><?php echo $getOrderDetails['REQUESTOR_EMAIL'];?> </div>
                        </div>
                        <div class="row static-info">
                          <div class="col-md-5 name"> Approver Email: </div>
                          <div class="col-md-7 value"><?php echo $getOrderDetails['approver_email'];?> </div>
                        </div>
                        <div class="row static-info">
                          <div class="col-md-5 name"> Other Approver Email: </div>
                          <div class="col-md-7 value"><?php echo $getOrderDetails['pre_approver_email'];?> </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <div class="portlet grey-cascade box">
                      <div class="portlet-title">
                        <div class="caption">  Shopping Cart </div>
                        <div class="actions"> <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#myCartModal"><i class="fa fa-plus" aria-hidden="true"></i>  ADD TO CART</button></div>
                      </div>
                      <div class="portlet-body">
                        <div class="table-responsive">
                         
                         <!-- Shopping Cart -->
                               
                                                
                         <!-- Shopping Cart -->
                            
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6"> </div>
                  <div class="col-md-6">
                    <div class="well">
                      <div class="row static-info align-reverse">
                        <div class="col-md-8 name"> Sub Total: </div>
                        <div class="col-md-3 value"> $ <?php echo $getOrderDetails['ordertotal'];?> </div>
                      </div>
                      <div class="row static-info align-reverse">
                        <div class="col-md-8 name"> Shipping: </div>
                        <div class="col-md-3 value"> --- </div>
                      </div>
                      <div class="row static-info align-reverse">
                        <div class="col-md-8 name"> Grand Total: </div>
                        <div class="col-md-3 value"> $ <?php echo $getOrderDetails['ordertotal'];?></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Modal -->
<div class="modal fade" id="myCartModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">ADD TO CART</h4>
      </div>
      <div class="modal-body">
       <form action="inserts/newShoppingCartController.php" method="post">
  <div class="form-group">
    <label for="product">Product ID</label>
    <input type="text" class="form-control" id="product" name="product" placeholder="Product ID/Catalog Number" required>
  </div>
  <div class="form-group">
    <label for="description">Product Description</label>
    <input type="textarea" class="form-control" id="description" name="description" placeholder="" required>
  </div>
   <div class="form-group">
    <label for="price">Price</label>
    <input type="number" class="form-control" id="price" name="price" placeholder="Item Price"   step="0.01"  min="0.01" required>
  </div>
  <div class="form-group">
    <label for="quantity">Item Quantity</label>
    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Item Quantity" step="0.25"  min="1" required>
  </div>
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <button type="submit" class="btn btn-default"><i class="fa fa-check-circle" aria-hidden="true" id="sbtOrderItem"></i> Save</button>
</form>
      </div>
      
    </div>
  </div>
</div>    
      <!-- End: life time stats -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.1/jquery.form.min.js"></script>
<script src="js/jquery.maskedinput.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/notify.min.js"></script>
<script src="js/ct-navbar.js"></script>
<script type="text/javascript">
  /* dmxServerAction name "getOrder" */
       jQuery.dmxServerAction(
         {"id": "getOrder", "url": "dmxConnect/api/Orders/orderDetails.php", "method": "GET", "sendOnSubmit": false, "sendOnLoad": true, "data": {}}
       );
  /* END dmxServerAction name "getOrder" */
  /* END dmxServerAction name "getOrder" */
  /* END dmxServerAction name "getOrder" */
  /* END dmxServerAction name "getOrder" */
</script>
<script>
        var tabs;
        jQuery(function($) {
            tabs = $('.tabscontent').tabbedContent({loop: true}).data('api');

            // switch to tab...
            $('a[href=#click-to-switch]').on('click', function(e) {
                var tab = prompt('Tab to switch to (number or id)?');
                if (!tabs.switchTab(tab)) {
                    alert('That tab does not exist :\\');
                }
                e.preventDefault();
            });

            // Next and prev actions
            $('.controls a').on('click', function(e) {
                var action = $(this).attr('href').replace('#', '');
                tabs[action]();
                e.preventDefault();
            });
        });
</script>
</body>
</html>
