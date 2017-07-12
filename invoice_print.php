<?php
	
  date_default_timezone_set('America/New_York');
  
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
	
  require_once('inserts/setUpDB.php');
	
	function time_formatter($createdate){
		$oDate = new DateTime($createdate);
    $sDate = $oDate->format("m/d/y g:i A");
    echo ($createdate != '0000-00-00 00:00:00') ? $sDate : '---';
	
		}
	
	if(session_id() == ''){
    //session has not started
    session_start();
    $requestorID = $_SESSION['sessCustomerID'];
  }
  
	// get customer details by session customer ID
	
	$where = new WhereClause('and'); // create a WHERE statement of pieces joined by ANDs
	$where->add('orderID =%s', $_GET['ref']);
	$where->add('requestorID=%s', $_SESSION['sessCustomerID']);
	
	$row_getInvoice_rs = DB::queryFirstRow("SELECT * FROM tblorders WHERE %l", $where);
	
	$mysqli_result = DB::queryRaw("SELECT * FROM tblorder_items WHERE orderID=%s", $row_getInvoice_rs['orderID']);
	$shoppingCart = $mysqli_result->fetch_assoc();
  $totalRows_getInvoice_rs = DB::count();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Requisition Management System</title>
<link href="dist/css/invoice_print.css" rel="stylesheet" type="text/css" media="print"/>
<style type="text/css">
<!--
.style2 {font-weight: bold}
-->
</style>
<script language="Javascript1.2">
  <!--
  function printpage() {
  window.print();
  }
  //-->
</script>

</head>
<body onload="printpage()">
  <table border="0" cellpadding="1" cellspacing="1" align="center">
    <tr>
      <td><h2 align="center" class="pagetitles" ><strong>DEPARTMENT OF CHEMISTRY &amp; BIOCHEMISTRY</strong></h2>
        <h2 align="center" class="pagetitles" ><strong>COLLEGE PARK, MARYLAND 20742</strong></h2>
        <p align="center" ><strong><span style='font-size:12.0pt;
font-family:Helvetica'>&nbsp;</span></strong></p>
        <p align="center" ><strong><span
style='font-size:12.0pt;font-family:Helvetica'>PRE-REQUISITION FOR SUPPLIES,
      EQUIPMENT AND SERVICES </span></strong></p></td>
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
                                <td colspan="3" valign="top"><h1 style='font-size:12.0pt;font-family:Helvetica'>Requisition&nbsp;#:<?php echo $row_getInvoice_rs['reqNumber']; ?></h1></td>
                              </tr>
                              <tr>
                                <td colspan="3"><hr></td>
                              </tr>
                              <tr>
                                <td valign="top" class="textblack01"><strong>Date Submitted:</strong> <?php time_formatter($row_getInvoice_rs['dateSubmitted']); ?><br />
                                  <br />
                                  <strong>Confirmation #:</strong> <?php echo $row_getInvoice_rs['confirmation_number']; ?><br />
                                  <br />
                                  <strong>Order Status:&nbsp;</strong><?php echo $row_getInvoice_rs['orderStatus']; ?><br />
                                  <br />
                                  <strong>FRS Account :</strong> <?php echo $row_getInvoice_rs['frsNumber']; ?><br />
                                  <br />
                                  <strong>Courier :</strong><?php echo $row_getInvoice_rs['Courier']; ?><br />
                                  <br />
                                  <strong> Shipping Method:</strong> <?php echo $row_getInvoice_rs['shipping_type']; ?>

                                  
                                  </td>
                                <td align="right" valign="top"><strong>Requestor:&nbsp;</strong><?php echo $row_getInvoice_rs['requestor']; ?><br />
                                  <?php echo $row_getInvoice_rs['REQUESTOR_EMAIL']; ?><br />
                                  <?php echo $row_getInvoice_rs['REQUESTOR_PHONE']; ?><br />
                                  <br />
                                  <strong>Approver:</strong> <?php echo $row_getInvoice_rs['approver']; ?><br />
                                  <?php echo $row_getInvoice_rs['approver_email']; ?> <br />
                                  <?php echo $row_getInvoice_rs['approver_phone']; ?><br />
                                  <strong>Business Office Agent:</strong>&nbsp;<?php echo $row_getInvoice_rs['BSOApproverFull']; ?><br /><br />
                                  
                                  <strong> Project Code:</strong><?php echo $row_getInvoice_rs['projectCode']; ?><br />
                               
                                  <strong> Object Code:&nbsp;</strong><?php echo $row_getInvoice_rs['ObjectCode']; ?>
                                  
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
                        <td nowrap="nowrap"><?php time_formatter($row_getInvoice_rs['dateApproverAction']); ?></td>
                      </tr>
                      <tr>
                        <td nowrap="nowrap"><strong>Date Ordered: </strong></td>
                        <td nowrap="nowrap"><?php time_formatter($row_getInvoice_rs['dateOrdered']); ?></td>
                      </tr>
                      <tr>
                        <td nowrap="nowrap"><strong>Date Received:</strong></td>
                        <td nowrap="nowrap"><?php time_formatter($row_getInvoice_rs['dateReceived']); ?></td>
                      </tr>
                      <tr>
                        <td nowrap="nowrap"><strong>Date Delivered:</strong></td>
                        <td nowrap="nowrap"><?php time_formatter($row_getInvoice_rs['dateDelivered']); ?></td>
                      </tr>
                    </tbody>
                  </table>
                  <br />
                  <hr>
                  
                  <table border="0" cellpadding="0" cellspacing="0" width="560pt">
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
                        <th width="10" align="right" nowrap="nowrap" bgcolor="#cccccc">Est. price </th>
                        <th width="10" align="right" nowrap="nowrap" bgcolor="#cccccc">Actual. Item price</th>
                        <th width="10" align="center" nowrap="nowrap" bgcolor="#cccccc">Requested Quant. </th>
                        <th width="10" align="center" nowrap="nowrap" bgcolor="#cccccc">Actual Quantity</th>
                        <th width="10" align="right" bgcolor="#cccccc">Total<br />
                          <img src="img/spacer.gif" alt="1" border="0" height="1" width="50" /></th>
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
						  $ap = ($shoppingCart['actual_price'] != 0) ? $shoppingCart['actual_price'] : $shoppingCart['price'];
						  $aq = ($shoppingCart['actual_quantity'] != 0 ) ? $shoppingCart['actual_quantity'] : $shoppingCart['quantity'];	
						  $as = $row_getInvoice_rs['actual_shipping_cost'];	
						  
							if (  ($shoppingCart['quantity'] != 0) &&   (($shoppingCart['price'] / $shoppingCart['quantity']) == 1.00) ) 								{
						  
						   		$shoppingCart['quantity'] = $$shoppingCart['actual_quantity'];
						   		$shoppingCart['price'] = $shoppingCart['actual_price'];
								}						  

						  $st = $st +($aq*$ap);  

			  ?>
                      <tr>
                        <td align="center" nowrap="nowrap"><?php echo $shoppingCart['product']; ?></td>
                        <td><?php echo $shoppingCart['description']; ?></td>
                        <td align="right" nowrap="nowrap">$<?php echo $shoppingCart['price']; ?>&nbsp;&nbsp;</td>
                        <td align="right" nowrap="nowrap"><span class="CustomerMessage">$<?php echo $ap; ?></span>&nbsp;&nbsp;</td>
                        <td align="center"><?php echo $shoppingCart['quantity']; ?></td>
                        <td align="center" class="CustomerMessage"><?php echo $aq; ?></td>
                        <td align="right" nowrap="nowrap">$<?php echo $aq*$ap; ?>&nbsp;&nbsp;</td>
                      </tr>
                      <?php } while ($shoppingCart = $mysqli_result->fetch_assoc()); ?>
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

</body>

</html>