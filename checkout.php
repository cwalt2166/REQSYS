<?php
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
  setlocale(LC_MONETARY, 'en_US');
	// include database configuration file
	include 'inserts/dbConfig.php';

	// initializ shopping cart class
	include 'inserts/Cart.php';
	$cart = new Cart;

	// redirect to home if cart is empty
	if($cart->total_items() <= 0){
	    header("Location: viewCart.php");
	}


	// get customer details by session customer ID
	 $query = $db->query("SELECT * FROM tblorders WHERE requisitionID = ".$_SESSION['requisitionID']);
   $custRow = $query->fetch_assoc();
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
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
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
 <link href="https://fonts.googleapis.com/css?family=Raleway:800" rel="stylesheet">
 <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxFormValidator.js"></script>
<link href="css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<link href="assets/css/bootstrap-datepicker.css" rel="stylesheet" />
<link rel="stylesheet" href="dist/css/animate.css">
<link rel="stylesheet" href="dist/css/custom.css">
<link rel="stylesheet" href="dist/css/file_format_icons.css">
<style>
    .container{width: 100%;padding: 20px;}
    .table{width: 100%;float: left;}
    .shipAddr{width: 30%;float: left;margin-left: 30px;}
    .footBtn{width: 95%;float: left;}
    .orderBtn {float: right;}
</style>
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
<body class="hold-transition skin-red sidebar-mini fuelux">
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

    	<h1><i class="fa fa-shopping-bag" aria-hidden="true"></i>    Order Checkout</h1>
	<div class="row">
		<div class="col-md-8">
    			<div class="panel panel-default">

		<div class="panel-body no-margin-bottom ui form">
			<div class="row">
				<div class="col-lg-4">
				<h4 class="header">
						Requestor
					</h4>
					<div class="billing-address">
				<i class="user icon"></i><?php echo $custRow['requestor']; ?>
				<div class="billing_email">
				<i class="mail icon"></i><a href="mailto:<?php echo $custRow['REQUESTOR_EMAIL']; ?>"><?php echo $custRow['REQUESTOR_EMAIL']; ?></a>
				</div>
				<br><i class="call icon"></i><?php echo $_SESSION['telephone'];?>



				</div>


				</div>
				<div class="col-md-6 col-lg-4">
					<h4 class="header">
						Account/Billing
					</h4>
					<div class="billing-address">
					<i class="credit card alternative icon"></i> <strong>Charge To: </strong><?php echo $custRow['frsNumber']; ?><br/>
					<i class="building icon"></i> <strong>Project Code: </strong><?php echo $custRow['projectCode']; ?><br/>
					<i class="mail icon"></i> <strong>Approver: </strong><a href="mailto:<?php echo $custRow['approver_email']; ?>"><?php echo $custRow['approver_email']; ?></a><br/>
					<i class="mail icon"></i> <strong>Alternate: </strong><a href="mailto:<?php echo $custRow['pre_approver_email']; ?>"><?php echo $custRow['pre_approver_email']; ?></a><br/>
													</div>
				</div>
				<div class="col-md-6 col-lg-4">
				<h4 class="header">
						Delivery
					</h4>
					<div class="shipping-address">
					<strong>Required By: </strong><?php echo date("m/d/Y", strtotime($custRow["dateRequiredBy"])); ?><br/>
					<strong>Shipping: </strong><?php echo $custRow['shipping_type']; ?><br/>
					<strong>Confirmation #: </strong><?php echo $custRow['confirmation_number']; ?><br/>
					<strong>Tracking #: </strong><?php echo $custRow['tracking_number']; ?><br/>
																												</div>

				</div>
			</div>
      <!-- Begin: life time stats -->


        </div>

      <!-- Modal -->
<div class="modal fade" id="myCartModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content" style="padding: 20px; padding-top: 0px">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">ADD TO CART</h4>
      </div>
   <form action="inserts/cartAction.php?action=addToCart" method="post" class="add-to-cart-form">
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
   <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Close</button>
  <button type="submit" class="btn btn-default"><i class="fa fa-check-circle" aria-hidden="true" id="sbtOrderItem"></i> Save</button>
</form>
      </div>

    </div>

  </div>
</div>
<div class="row">
	<div class="col-md-12">

		                        <div class="actions" style="margin-bottom:20px; float:right;">




																<a href="editOrder.php" type="button" class="btn btn-secondary" style="margin-left:10px;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modify Order</a>
		                            <a href="viewCart.php" type="button" class="btn btn-secondary" style="margin-left:10px;"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Edit Cart</a>
		                            <a href="inserts/cartAction.php?action=placeOrder&id=<?php echo $custRow['orderID'];?>" class="btn btn-secondary btn-checkout" style="margin-left:10px;">Place Order <i class="glyphicon glyphicon-menu-right"></i></a>


		                        	</div>
<table class="table shopping-cart">
<thead>
		<tr>
				<th>Product</th>
				<th>Description</th>
				<th style="text-align:right">Price</th>
				<th>Qty</th>
				<th style="text-align:right">Ext. Price</th>
		</tr>
</thead>
<tbody>
		<?php
		if($cart->total_items() > 0){
				//get cart items from session
				$cartItems = $cart->contents();
				foreach($cartItems as $item){
		?>
		<tr>
				<td><?php echo $item["name"]; ?></td>
				 <td><?php echo $item["desc"]; ?></td>
				<td style="text-align:right" nowrap><?php echo money_format('%(#5.2n', $item["price"]); ?></td>
				<td style="text-align:center"><?php echo $item["qty"]; ?></td>
				<td style="text-align:right" nowrap><?php echo money_format('%(#5.2n', $item["subtotal"]); ?></td>
		</tr>
		<?php } }else{ ?>
		<tr><td colspan="4"><p>No items in your cart......</p></td>
		<?php } ?>
</tbody>
<tfoot>
																	<tr>
																			<td></td>
																			<td colspan="3"></td>
																			<?php if($cart->total_items() > 0){ ?>
																			<td class="text-center large" nowrap><strong>Total:</strong> <?php echo money_format('%(#5.2n', $cart->total()); ?></td>


																			<?php } ?>
																	</tr>
															</tfoot>
</table>



<div class="footBtn">


</div>
</div>


</div>



</div>

<div class="col-md-3 center-div">
	<a href="inserts/cartAction.php?action=cancelOrder&id=<?php echo $custRow['orderID'];?>" type="button" id="cancelbutton" name="cancelbutton" class="btn btn-block btn-danger cancel" aria-label="Cancel Button" onclick="return confirm('Are you sure you want to cancel this order?');"><i class="fa fa-times-circle" aria-hidden="true"></i>   Cancel Requisition</a>

		<div class="panel-group" id="accordion">

			<div class="panel panel-default">
					<div class="panel-heading">
							<h4 class="panel-title">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapseZero">Order WorkFlow</a>
							</h4>
					</div>
					<div id="collapseZero" class="panel-collapse collapse in">
							<div class="panel-body">
									<div class="row">
											<div class="col-md-12">
												<div style="padding-bottom: 5px;"><?php echo ($custRow["orderStatus"] > 0)  ? '  <a class="ui" href="#" style="color: black; font-weight: 700; display: block;"><img src="images/icon-check-circle.png"> Request Pending</a>' : '<img src="images/icon-empty-circle.png"> Request Pending</a>'; ?></div>
												<div style="padding-bottom: 5px;"><?php echo ($custRow["orderStatus"] > 1)  ? '  <a class="ui" href="#" style="color: black; font-weight: 700; display: block;"><img src="images/icon-check-circle.png"> Order Approved</a>' : '<img src="images/icon-empty-circle.png"> Order Approved</a>'; ?></div>
												<div style="padding-bottom: 5px;"><?php echo ($custRow["orderStatus"] > 2)  ? '  <a class="ui" href="#" style="color: black; font-weight: 700; display: block;"><img src="images/icon-check-circle.png"> Order Processed</a>' : '<img src="images/icon-empty-circle.png"> Order Processed</a>'; ?></div>
												<div style="padding-bottom: 5px;"><?php echo ($custRow["orderStatus"] > 3)  ? '  <a class="ui" href="#" style="color: black; font-weight: 700; display: block;"><img src="images/icon-check-circle.png"> In Receiving</a>' : '<img src="images/icon-empty-circle.png"> In Receiving</a>'; ?></div>
												</td>

											</div>
									</div>


							</div>
					</div>
			</div>

			<?php if(!empty($custRow['order_attachment'])) {?>
				<div class="panel panel-default">
						<div class="panel-heading">
								<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Order Attachment</a>
								</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse">
								<div class="panel-body">
										<div class="row">
												<div class="col-md-12">
													<a href="attachments_uploads/<?php echo $custRow['order_attachment']; ?>" target="_blank" class="link-icon">
				<?php echo substr_replace($custRow['order_attachment'],$custRow['reqNumber'],0,-4); ?>
				</a>

												</div>
										</div>


								</div>
						</div>
				</div>

				<?php }?>

				<?php if(!empty($custRow['order_notes'])) {?>
				<div class="panel panel-default">
						<div class="panel-heading">
								<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Purchaser Comments</a>
								</h4>
						</div>
						<div id="collapseTwo" class="panel-collapse collapse">
								<div class="panel-body">
										<div class="row">
												<div class="col-md-12">
														<?php echo $custRow['order_notes']; ?>
												</div>
										</div>

								</div>
						</div>
				</div><?php }?>
		</div>
</div>

</div>


      <!-- Your Page Content Here -->

			 <!-- Your Page Content Here -->

    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->

  <!-- Main Footer -->
    <?php include_once dirname(__FILE__) . '/dist/includes/footer.inc';?>


  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

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
<script src="semantic/dist/semantic.min.js"></script>
<script>

	var updateClock = function() {
    function pad(n) {
        return (n < 10) ? '0' + n : n;
    }

    var now = new Date();
    var s = pad(now.getUTCHours()) + ':' +
            pad(now.getUTCMinutes()) + ':' +
            pad(now.getUTCSeconds());

    $('#clock').html(s);

    var delay = 1000 - (now % 1000);
    setTimeout(updateClock, delay);
};

</script>
</div>
</div>
</body>
</html>
