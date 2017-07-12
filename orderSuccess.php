<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('inserts/secureApp.php');
require_once('inserts/dbConfig.php');

	  if(!isset($_REQUEST['id'])){
    		header("Location: dashboard.php");
		}

		$orderID = $_REQUEST['id'];
		$sql = '';
		$sql = "SELECT * FROM tblorders INNER JOIN tblorder_items ON tblorders.orderID = tblorder_items.orderID WHERE tblorders.orderID = '".$orderID."'";
		$result = $db->query($sql);
		$row_getInvoice_rs = $result->fetch_assoc();

		function KT_formatDate($inputdate) {

			$myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $inputdate);
			if ($inputdate != '0000-00-00 00:00:00')
			return $formatteddate = $myDateTime->format('m/d/y g:i A');

		}
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
<link rel="stylesheet" href="dist/css/print.css" media="print">
    <style>
    .container{width: 100%;padding: 10px;}
    p{color: #34a853;font-size: 18px;}
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
      <div class="user-panel">

          <img src="dist/img/chem_logo.png" alt="Chemistry & Biochemistry" style="width:180px; padding-left:40px">

      </div>

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
<h1><i class="fa fa-qrcode" aria-hidden="true"></i>   Order Invoice: REQ#<?php echo $row_getInvoice_rs['reqNumber']; ?></h1>

<button type="button" class="btn btn-secondary" onclick="printDiv('printableArea')" ><i class="fa fa-print" aria-hidden="true"></i> Print Invoice</button>
      <!-- Your Page Content Here -->
			<div id="printableArea">
			<table border="0" cellpadding="1" cellspacing="1" align="center">
		     <tr>
		       <td><p style='font-size:12.0pt;color:#374850; font-weight:700; text-align: center;'>DEPARTMENT OF CHEMISTRY &amp; BIOCHEMISTRY<br/>
		           COLLEGE PARK, MARYLAND 20742</p>
		         <p style='font-size:11.0pt;color:#374850; font-weight:700; text-align: center;'>PRE-REQUISITION FOR SUPPLIES, EQUIPMENT AND SERVICES </p></td>
		     </tr>


		     <tr>
		       <td colspan="4" style="min-height:600px">
		           <table id="main-container-table" align="center">
		             <tbody>
		               <tr>
		                 <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
		                     <tbody>
		                       <tr>
		                         <td valign="top"><br />
		                           <br /></td>
		                   <td width="100%"><table width="100%" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" >
		                             <tbody>

		                               <tr>
		                                 <td colspan="3" align="right" valign="top" bgcolor="#FFFFFF">&nbsp;&nbsp;</td>
		                               </tr>

		                               <tr>
		                                 <td colspan="3" valign="top"></td>
		                               </tr>
		                               <tr>
		                                 <td colspan="3" valign="top"><p style='font-size:12.0pt;font-family:Helvetica; color: #374850;'>Requisition&nbsp;#:<?php echo $row_getInvoice_rs['reqNumber']; ?></p></td>
		                               </tr>
		                               <tr>
		                                 <td colspan="3" valign="top"><hr></td>
		                               </tr>
		                               <tr>
		                                 <td valign="top" class="text_print_small"><strong>Date Submitted:</strong> <?php echo KT_formatDate($row_getInvoice_rs['dateSubmitted']); ?><br />

		                                   <strong>Confirmation #:</strong> <?php echo $row_getInvoice_rs['confirmation_number']; ?><br />

		                                   <strong>Order Status:&nbsp;</strong><?php echo $row_getInvoice_rs['orderStatus']; ?><br />

		                                   <strong>FRS Account :</strong> <?php echo $row_getInvoice_rs['frsNumber']; ?><br />

		                                   <strong>Courier :</strong><?php echo $row_getInvoice_rs['Courier']; ?><br />

		                                   <strong> Shipping Method:</strong> <?php echo $row_getInvoice_rs['shipping_type']; ?><br />
																			 <strong> Project Code:</strong><?php echo $row_getInvoice_rs['projectCode']; ?><br />

																			 <strong> Object Code:&nbsp;</strong><?php echo $row_getInvoice_rs['ObjectCode']; ?>

		                                   </td>
		                                 <td align="right" valign="top"><strong>Requestor:&nbsp;</strong><?php echo $row_getInvoice_rs['requestor']; ?><br />
		                                   <?php echo $row_getInvoice_rs['REQUESTOR_EMAIL']; ?><br />
		                                   <?php echo $row_getInvoice_rs['REQUESTOR_PHONE']; ?><br />
		                                   <br />
		                                   <strong>Approver:</strong><?php echo $row_getInvoice_rs['approver_email']; ?> <br />
																			  <strong>Alternate Approver:</strong> <?php echo $row_getInvoice_rs['pre_approver_email']; ?><br />

		                                   <strong>Business Office Agent:</strong>&nbsp;<?php echo $row_getInvoice_rs['BSOApproverFull']; ?><br /><br />



		                                   </td>
		                                 <td width="10" align="right" valign="bottom" bgcolor="#FFFFFF">&nbsp;</td>
		                               </tr>
		                             </tbody>
		                         </table></td>
		                       </tr>
		                     </tbody>
		                   </table>
		                   <table border="0" cellpadding="0" cellspacing="0" width="100%">
		                     <tbody>
		                       <tr>
		                         <td></td>
		                       </tr>
		                       <tr>
		                         <td><hr></td>
		                       </tr>
		                       <tr>
		                         <td></td>
		                       </tr>
		                     </tbody>
		                   </table>
		                   <br />
		                   <table border="0" cellpadding="2" cellspacing="0" width="45%" style="margin-left:10px">
		                     <tbody>
		                       <tr>
		                         <td nowrap="nowrap"><strong>Vendor:</strong></td>
		                         <td nowrap="nowrap"><?php echo $row_getInvoice_rs['VENDOR_NAME']; ?></td>
		                       </tr>
		                       <tr>
		                         <td nowrap="nowrap"><strong>Address:</strong></td>
		                         <td nowrap="nowrap"><?php echo $row_getInvoice_rs['VENDOR_ADDRESS']; ?></td>
		                       </tr>
		                       <tr>
		                         <td nowrap="nowrap"><strong>Phone:</strong></td>
		                         <td nowrap="nowrap"><?php echo $row_getInvoice_rs['VENDOR_PHONE']; ?></td>
		                       </tr>
		                       <tr>
		                         <td nowrap="nowrap"><strong>Fax:</strong></td>
		                         <td nowrap="nowrap"><?php echo $row_getInvoice_rs['VENDOR_FAX']; ?></td>
		                       </tr>
		                       <tr>
		                         <td nowrap="nowrap"><strong>Contact:</strong></td>
		                         <td nowrap="nowrap"><?php echo $row_getInvoice_rs['VENDOR_CONTACT']; ?></td>
		                       </tr>
		                       <tr>
		                         <td nowrap="nowrap"><strong>URL:</strong></td>
		                         <td nowrap="nowrap"><?php echo $row_getInvoice_rs['VENDOR_URL']; ?></td>
		                       </tr>
		                       <tr>
		                         <td nowrap="nowrap" class="HeadText">&nbsp;</td>
		                         <td nowrap="nowrap"></td>
		                       </tr>
		                       <tr>
		                         <td nowrap="nowrap"><strong>Date Approved: </strong></td>
		                         <td nowrap="nowrap"><?php echo KT_formatDate($row_getInvoice_rs['dateApproverAction']); ?></td>
		                       </tr>
		                       <tr>
		                         <td nowrap="nowrap"><strong>Date Ordered: </strong></td>
		                         <td nowrap="nowrap"><?php echo KT_formatDate($row_getInvoice_rs['dateOrdered']); ?></td>
		                       </tr>
		                       <tr>
		                         <td nowrap="nowrap"><strong>Date Received:</strong></td>
		                         <td nowrap="nowrap"><?php echo KT_formatDate($row_getInvoice_rs['dateReceived']); ?></td>
		                       </tr>
		                       <tr>
		                         <td nowrap="nowrap"><strong>Date Delivered:</strong></td>
		                         <td nowrap="nowrap"><?php echo KT_formatDate($row_getInvoice_rs['dateDelivered']); ?></td>
		                       </tr>
		                     </tbody>
		                   </table>
		                   <br />
		                   <hr>

		                   <table border="0" cellpadding="2" cellspacing="0" width="560pt">
		                     <tbody>
		                       <tr>
		                         <td align="left" class="style2">&nbsp;</td>
		                       </tr>
		                     </tbody>
		                   </table>
		                   <table width="100%" border="1" cellpadding="3" cellspacing="0">
		                     <tbody>
		                       <tr>
		                         <th width="30" bgcolor="#cccccc">SKU</th>
		                         <th bgcolor="#cccccc">Product</th>
		                         <th align="right" nowrap="nowrap" bgcolor="#cccccc">Est. price </th>
		                         <th align="right" nowrap="nowrap" bgcolor="#cccccc">Final price</th>
		                         <th align="center" nowrap="nowrap" bgcolor="#cccccc">Qty. </th>
		                         <th align="center" nowrap="nowrap" bgcolor="#cccccc">Actual Qty</th>
		                         <th align="right" bgcolor="#cccccc">Total<br />
		                          </th>
		                       </tr>
		                       <?php
		 							$pn = $row_getInvoice_rs['order_notes'];
		 							$apn = $row_getInvoice_rs['Notes'];
		 							$bson = $row_getInvoice_rs['AdminNotes'];
		 					   $st = 0;
		 						  do {

		 						  $ap = 0;
		 						  $as = 0;
		 						  $aq = 0;
		 						  $ap = ($row_getInvoice_rs['actual_price'] != 0) ? $row_getInvoice_rs['actual_price'] : $row_getInvoice_rs['price'];
		 						  $aq = ($row_getInvoice_rs['actual_quantity'] != 0 ) ? $row_getInvoice_rs['actual_quantity'] : $row_getInvoice_rs['quantity'];
		 						  $as = $row_getInvoice_rs['actual_shipping_cost'];

		 							if (  ($row_getInvoice_rs['quantity'] != 0) &&   (($row_getInvoice_rs['price'] / $row_getInvoice_rs['quantity']) == 1.00) ) 								{

		 						   		$row_getInvoice_rs['quantity'] = $row_getInvoice_rs['actual_quantity'];
		 						   		$row_getInvoice_rs['price'] = $row_getInvoice_rs['actual_price'];
		 								}

		 						  $st = $st +($aq*$ap);

		 			  ?>
		                       <tr>
		                         <td align="center" nowrap="nowrap"><?php echo $row_getInvoice_rs['product']; ?></td>
		                         <td><?php echo $row_getInvoice_rs['description']; ?></td>
		                         <td align="right" nowrap="nowrap">$<?php echo $row_getInvoice_rs['price']; ?>&nbsp;&nbsp;</td>
		                         <td align="right" nowrap="nowrap"><span class="CustomerMessage">$<?php echo $ap; ?></span>&nbsp;&nbsp;</td>
		                         <td align="center"><?php echo $row_getInvoice_rs['quantity']; ?></td>
		                         <td align="center" class="CustomerMessage"><?php echo $aq; ?></td>
		                         <td align="right" nowrap="nowrap">$<?php echo $aq*$ap; ?>&nbsp;&nbsp;</td>
		                       </tr>
		                       <?php } while ($row_getInvoice_rs = $result->fetch_assoc()); ?>

		                     </tbody>
		                   </table>
		                   <table border="0" align="right" cellpadding="0" cellspacing="0">
		                     <tbody>
		                       <tr>
		                         <td align="right" height="20"><strong>Subtotal:</strong>&nbsp;</td>
		                         <td align="right" valign="middle" nowrap="nowrap">$<?php echo number_format($st,2); ?>&nbsp;&nbsp;&nbsp;</td>
		                       </tr>
		                       <tr>
		                         <td height="20" align="right" valign="top"><strong>Shipping cost:</strong>&nbsp;</td>
		                         <td align="right" valign="top">
		                         <?php echo '$ '.(isset($as)?true:false?$as:'0:00'); ?>

		                         &nbsp;&nbsp;&nbsp;</td>
		                       </tr>
		                       <tr>
		                         <td colspan="2" bgcolor="#000000"></td>
		                       </tr>
		                       <tr>
		                         <td height="25" align="right" valign="top" bgcolor="#cccccc"><strong>Total:</strong>&nbsp;</td>
		                         <td align="right" valign="top" nowrap="nowrap" bgcolor="#cccccc"><strong>$</strong>&nbsp;<?php echo number_format($as+$st,2); ?>&nbsp;&nbsp;</td>
		                       </tr>
		                     </tbody>
		                   </table></td>
		               </tr>
		               <tr>
		                 <td align="left"><div id="order_notes"><em>Requestor Notes:</em> <?php echo $pn; ?></div>
		                   <br />
		                   <div id="Notes"><em>Approver Notes:</em> <?php echo $apn; ?></div>
		                   <br />
		                 <div id="Admin_Notes"><em>BSO Purchaser Notes:</em> <?php echo $bson; ?></div>

		                 </td>
		               </tr>
		             </tbody>
		           </table></td>
		     </tr>
		   </table>

			 <!-- Your Page Content Here -->
		 </div>
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
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="js/jquery-ui.min.js"></script>
<script src="responsive/responsive-nav.min.js" type="text/javascript"></script>
</div>
</div>
</body>
</html>
