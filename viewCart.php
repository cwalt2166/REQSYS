<?php
  date_default_timezone_set('America/New_York');
  setlocale(LC_MONETARY, 'en_US');
  if(session_id() == ''){
    //session has not started
    session_start();
  }
  //unset($_SESSION['cart_contents']);
  require_once('inserts/setUpDB.php');
  // initialize shopping cart class
  include'inserts/Cart.php';

	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");


	$ref_ = $_SERVER['HTTP_REFERER'];


	if (isset($_GET['ref']) && ($ref_!== null)) {
    $_SESSION['requisitionID'] = $_GET['ref'];
	}

	if (!(isset($_SESSION['requisitionID']))){
	    header("Location: newOrder.php");
	}

	$id = isset($_SESSION['requisitionID']) ? $_SESSION['requisitionID'] : -1 ;

	$getOrderDetails = DB::queryFirstRow("SELECT * FROM tblorders WHERE requisitionID =  %i", $id);

  $cart = new Cart;


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
<link rel="stylesheet" type="text/css" href="dist/css/normalize.css" />
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
<script src="http://getfuelux.com/assets/vendor/requirejs/require.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
<script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
<link href="css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
<link href="assets/css/bootstrap-datepicker.css" rel="stylesheet" />
<link rel="stylesheet" href="dist/css/animate.css">
<link rel="stylesheet" type="text/css" href="dist/css/component.css" />
<link rel="stylesheet" href="dist/css/custom.css">
<script type="text/javascript" src="js/tabbedcontent.min.js"></script>
<!-- remove this if you use Modernizr -->
<script>(function(e,t,n){var r=e.querySelectorAll("html")[0];r.className=r.className.replace(/(^|\s)no-js(\s|$)/,"$1js$2")})(document,window,0);</script>
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

      <?php include_once dirname(__FILE__) . '/dist/includes/top_menu.inc';?>
    <!-- Main content -->
    <section class="content">
      <!-- Your Page Content Here -->
       <h1><i class="fa fa-shopping-bag" aria-hidden="true"></i>    Order Details</h1>

      <!-- Your Page Content Here -->
		<div class="panel panel-default">

		<div class="panel-body no-margin-bottom ui form">
			<div class="row">
				<div class="col-lg-4">
				<h4 class="header">
						Requestor
					</h4>
					<div class="billing-address">
				<i class="user icon"></i><?php echo $getOrderDetails['requestor']; ?>
				<div class="billing_email">
				<i class="mail icon"></i><a href="mailto:<?php echo $getOrderDetails['REQUESTOR_EMAIL']; ?>"><?php echo $getOrderDetails['REQUESTOR_EMAIL']; ?></a>
				</div>
				<br><i class="call icon"></i><?php echo $_SESSION['telephone'];?>



				</div>


				</div>
				<div class="col-md-6 col-lg-4">
					<h4 class="header">
						Account/Billing
					</h4>
					<div class="billing-address">
					<i class="credit card alternative icon"></i> <strong>Charge To: </strong><?php echo $getOrderDetails['frsNumber']; ?><br/>
					<i class="building icon"></i> <strong>Project Code: </strong><?php echo $getOrderDetails['projectCode']; ?><br/>
					<i class="mail icon"></i> <strong>Approver Email: </strong><a href="mailto:<?php echo $getOrderDetails['approver_email']; ?>"><?php echo $getOrderDetails['approver_email']; ?></a><br/>
					<i class="mail icon"></i> <strong>Alternate Email: </strong><a href="mailto:<?php echo $getOrderDetails['pre_approver_email']; ?>"><?php echo $getOrderDetails['pre_approver_email']; ?></a><br/>
													</div>
				</div>
				<div class="col-md-6 col-lg-4">
				<h4 class="header">
						Delivery
					</h4>
					<div class="shipping-address">
					<strong>Required By: </strong><?php echo date("m/d/Y", strtotime($getOrderDetails["dateRequiredBy"])); ?><br/>
					<strong>Shipping: </strong><?php echo $getOrderDetails['shipping_type']; ?><br/>
					<strong>Confirmation #: </strong><?php echo $getOrderDetails['confirmation_number']; ?><br/>
					<strong>Tracking #: </strong><?php echo $getOrderDetails['tracking_number']; ?><br/>
																												</div>

				</div>
			</div>
      <!-- Begin: life time stats -->


        </div>

      <!-- Modal -->
<div class="modal fade" id="myCartModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-plus-square" aria-hidden="true"></i>   Add Item To Cart</h4>
      </div>
   <form action="inserts/cartAction.php?action=addToCart" method="post" class="add-to-cart-form"  style="padding: 20px; padding-top: 10px">
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
      <!-- End: life time stats -->
    </section>
    <!-- /.content -->
                    <div class="row">

                  <div class="col-md-11 col-sm-12 center-div">
                    <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Bulk Item Upload </a></li>
                  <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Instructions</a></li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="home">
                    <form id="multiform" method="post" action="inserts/cartAction.php" enctype="multipart/form-data" name="multiform">

                      <div>
                        <input type="hidden" name="action" id="action" value="addToCartCSV">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="file" name="file-3" id="file-3" class="inputfile inputfile-3" data-multiple-caption="{count} files selected" style="display:none"/>
                        <label for="file-3"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose a file to bulk upload a shopping list:</span></label>

                        </div>
                        <button type="submit" id="uploadButton" data-loading-text="Loading..." class="btn btn-secondary" autocomplete="off">
                          <i class="fa fa-upload" aria-hidden="true"></i> Upload Template
                        </button>

                      </form>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="profile">
                    <?php include 'dist/includes/upload_instructions.inc';?>

                  </div>

                </div>

              </div>

                    <div class="portlet">

                      <div class="portlet-title">










                        <div class="actions" style="margin-bottom:20px;">



                          <div class="btn-group" role="group" aria-label="Cart Actions">
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#myCartModal" style="margin-left:10px;">

  													  <strong><i class="fa fa-plus" aria-hidden="true"></i> Add Item</strong></button>
                            <a href="inserts/cartAction.php?action=clearCart" type="button" class="btn btn-secondary" style="margin-left:10px;"><i class="fa fa-times" aria-hidden="true"></i> Clear Cart</a>
                            <a href="checkout.php" class="btn btn-secondary btn-checkout" style="margin-left:10px;"><i class="fa fa-check" aria-hidden="true"></i> Checkout</a>
                          </div>
                        	</div>
                      </div>
                      <div class="portlet-body">
                        <div class="table-responsive">

                         <!-- Shopping Cart -->
													   <table class="table">
															    <thead>
															        <tr>
															            <th>PRODUCT</th>
															            <th>PRODUCT DESCRIPTION</th>
															            <th nowrap class="text-right">UNIT PRICE</th>
															            <th class="text-center">QUANTITY</th>
															            <th class="text-right">SUBTOTAL</th>
															            <th></th>
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
															            <td nowrap class="text-right"><?php echo money_format('%(#5.2n', $item["price"]); ?></td>
															            <td>
															            	<form action="inserts/cartAction.php" method="get" id="qty_<?php echo $item["rowid"]; ?>">
															            		<input name="qty" type="number" class="form-control text-center w-95-pct" value="<?php echo $item["qty"]; ?>" min="0" onkeypress="return isNumberKey(event);" onBlur="document.getElementById('qty_<?php echo $item["rowid"]; ?>').submit();">
															            		<input type="hidden" name="action" value="updateCartItem">
															            		<input type="hidden" name="id" value="<?php echo $item["rowid"]; ?>">
															            		</form>
															            		</td>
															            <td nowrap class="text-right w-1-pct"><?php echo money_format('%(#5.2n', $item["subtotal"]); ?></td>
															            <td>


																							  <a href="inserts/cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>"  class="ui blank button" onclick="return confirm('Are you sure you want to delete this item?')"><i class="fa fa-trash-o" aria-hidden="true"></i></a>



															            </td>
															        </tr>
															        <?php } }else{ ?>
															        <tr><td colspan="6"><h3 class="empty-cart">Your shopping cart is empty</h3></td></tr>
															        <?php } ?>
															    </tbody>
															    <tfoot>
															        <tr>

															            <td colspan="6" style="text-align:right; font-weight: 700; color:#000; font-size: 13px;">
															            <?php if($cart->total_items() > 0){ ?>
                                            <br/>

                                         SHOPPING CART TOTAL
                                           <hr>

                                         <p>Shipping:<?php echo money_format('%(#5.2n', $item["actual_shipping_cost"]); ?></p>
                                         <p class="text-right large" style="color:#111111; font-weight:bold;">Total: <?php echo money_format('%(#5.2n', $cart->total()); ?></p>

                                         <?php } ?>
															         </td>

															        </tr>
															    </tfoot>
														</table>

                         <!-- Shopping Cart -->

                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
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
<script src="semantic/dist/semantic.min.js"></script>
<script src="dist/js/jquery.custom-file-input.js"></script>
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
<script>
    function updateCartItem(obj,id){
        $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
            if(data == 'ok'){
                location.reload();
            }else{
                alert('Cart update failed, please try again.');
            }
        });
    }

    function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode;
    return !(charCode > 31 && (charCode < 48 || charCode > 57));
		}

function clearThisCart(){

  var item ='clearCart';
    $.ajax({

              url: 'inserts/cartAction.php',
              type: 'POST',
              datatype : 'html',
              data: "action="+ item,
              success: function(response) {
                  if (response.status === "success") {
                      $('.result').text("Success!!");
                  } else if (response.status === "error") {
                      $('.result').text("Error!!");
                  }
              }
          });
  }
</script>


</body>
</html>
