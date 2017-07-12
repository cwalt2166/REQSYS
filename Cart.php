<?php

$id = 2000;
//WA eCart Include
require_once("WA_eCart/eCartProms_PHP.php");
?>
<?php
$eCartProms->GetContent();
?>
<?php
// WA eCart Update
if (isset($_POST["eCartProms_Update_100"]) || isset($_POST["eCartProms_Update_100_x"]))     {
  $eCartProms->CartUpdate();
  $Redirect_redirStr="";
  if ($Redirect_redirStr != "")     {
    $eCartProms->redirStr = $Redirect_redirStr;
  }
  $eCartProms->cartAction = "Update";
}
?>

<?php
// WA eCart AddToCart
if (isset($_POST["eCartProms_1_ATC"]) || isset($_POST["eCartProms_1_ATC_x"]))     {
  $ATC_itemID = $_POST["eCartProms_1_ID_Add"];
  $ATC_AddIfIn = 0;
  $ATC_RedirectAfter = "";
  $ATC_RedirectIfIn  = "";
    $ATC_itemName = "".((isset($_POST["product"]))?$_POST["product"]:"")  ."";// column binding
    $ATC_itemDescription = "".((isset($_POST["description"]))?$_POST["description"]:"")  ."";// column binding
    $ATC_itemThumbnail = "";// column binding
    $ATC_itemWeight = floatval("0");// column binding
    $ATC_itemQuantity = "".$_POST["eCartProms_1_Quantity_Add"]  ."";// column binding
    $ATC_itemPrice = floatval("".((isset($_POST["price"]))?$_POST["price"]:"")  ."");// column binding
    $ATC_itemProductID = "";// column binding
  $ATC_itemQuantity = floatval($ATC_itemQuantity);
  if (is_numeric($ATC_itemQuantity) && $ATC_itemQuantity != 0)     {
    $eCartProms->AddToCart($ATC_AddIfIn, $ATC_RedirectIfIn, $ATC_itemID, $ATC_itemName, $ATC_itemDescription, $ATC_itemThumbnail, $ATC_itemWeight, $ATC_itemQuantity, $ATC_itemPrice, $ATC_itemProductID);
    if ($ATC_RedirectAfter != "" && $eCartProms->redirStr == "")     {
      $eCartProms->redirStr = $ATC_RedirectAfter;
    }
    if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != "")  {
      $_SESSION['WAEC_ContinueRedirect'] = $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
    }
    else  {
      $_SESSION['WAEC_ContinueRedirect'] = $_SERVER['PHP_SELF'];
    }
  }
}
?>
<?php
// WA eCart Continue Shopping
if (isset($_POST["eCartProms_Continue_100"]) || isset($_POST["eCartProms_Continue_100_x"]))     {
  $Redirect_redirStr="";
  if (true && isset($_SESSION['WAEC_ContinueRedirect'])) {
    $Redirect_redirStr=siteToPageRel($_SESSION['WAEC_ContinueRedirect']);
  }
  if ($Redirect_redirStr != "")     {
    $eCartProms->redirStr = $Redirect_redirStr;
  }
  $eCartProms->cartAction = "Continue";
}
?>
<?php
// WA eCart Clear Cart
if (isset($_POST["eCartProms_Clear_100"]) || isset($_POST["eCartProms_Clear_100_x"]))     {
  $eCartProms->ClearCart();
  $Redirect_redirStr="";
  if ($Redirect_redirStr != "")     {
    $eCartProms->redirStr = $Redirect_redirStr;
  }
  $eCartProms->cartAction = "ClearCart";
}
?>
<?php
//WA eCart Redirect Check Out
if (isset($_POST["eCartProms_Checkout"]) || isset($_POST["eCartProms_Checkout_x"]))     {
  $Redirect_redirStr="";
  if ($Redirect_redirStr != "")     {
    if (isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != "")     {
      if (strpos($Redirect_redirStr, "?") === false)     {
        $Redirect_redirStr .= "?".$_SERVER['QUERY_STRING'];
      }
      else     {
        $Redirect_redirStr .= "&".$_SERVER['QUERY_STRING'];
      }
    }

    $eCartProms->redirStr = $Redirect_redirStr;
  }
  $eCartProms->cartAction = "Checkout";
}
?>
<?php
// WA eCart Redirect
if ($eCartProms->redirStr != "")     {
  if (function_exists("rel2abs")) $eCartProms->redirStr = rel2abs($eCartProms->redirStr,dirname(__FILE__));
  header("Location: ".$eCartProms->redirStr);
  die();
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<link href="WA_eCart/CSS/eC_Crisp_Pacifica_Arial.css" rel="stylesheet" type="text/css" />
</head>

<body>
 <form action="<?php echo $_SERVER["PHP_SELF"]; ?><?php echo (isset($_SERVER["QUERY_STRING"]) && $_SERVER["QUERY_STRING"] != "")?"?".htmlentities($_SERVER["QUERY_STRING"]):""; ?>" method="post" name="eCartProms_1_ATC_X" >
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
    <label for="eCartProms_1_Quantity_Add">Item Quantity</label>
    <input type="number" class="form-control" id="eCartProms_1_Quantity_Add" name="eCartProms_1_Quantity_Add" placeholder="Item Quantity" step="0.25"  min="1" required>
  </div>
  <input type="hidden" name="eCartProms_1_ID_Add" value="<?php echo $id; ?>">
  <button type="submit" class="btn btn-default"><i class="fa fa-check-circle" aria-hidden="true" id="eCartProms_1_ATC" name="eCartProms_1_ATC"></i> Add to Cart</button>
</form>


<div class="eC_Crisp_Pacifica_Arial">
  <?php
//WA eCart Show If Start
if (!$eCartProms->IsEmpty())     {
?>
    <div id="eC_Crisp_Pacifica_Arial" class="eC_Display">
      <form action="<?php echo ($_SERVER["PHP_SELF"].(isset($_SERVER["QUERY_STRING"])?"?".htmlentities($_SERVER["QUERY_STRING"]):""));?>" method="post" >
        <h2>Your Shopping Cart</h2>
        <table cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td><table class="eC_ShoppingCart" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <th class="spacer">&nbsp;</th>
                <th >&nbsp;</th>
                <th class="eC_PriceItem desktop_only">Price</th>
                <th class="eC_FormItem">Quantity</th>
                <th class="eC_PriceItem desktop_only">Total</th>
                <th class="spacer">&nbsp;</th>
              </tr>
              <?php
while (!$eCartProms->EOF())      {
?>
                <tr class="eC_DataRow">
                  <td class="spacer">&nbsp;</td>
                  <td  class="eC_GroupColumn"><p id="eCartProms_JSON_Display_Name_<?php echo $eCartProms->DisplayInfo("WAUID"); ?>" class="eC_ItemName"><?php echo $eCartProms->DisplayInfo("Name"); ?></p>
                    <p id="eCartProms_JSON_Display_Description_<?php echo $eCartProms->DisplayInfo("WAUID"); ?>" class="eC_ItemDescription min_tablet"><?php echo $eCartProms->DisplayInfo("Description"); ?></p>
                    <p id="eCartProms_JSON_Display_Price_<?php echo $eCartProms->DisplayInfo("WAUID"); ?>" class="eC_ItemPrice max_tablet"><?php echo WA_eCart_DisplayMoney($eCartProms, $eCartProms->DisplayInfo("Price")); ?></p>
                    <p class="eC_ItemDelete_Checkbox desktop_only">
                      <input type="checkbox" value="<?php echo $eCartProms->DisplayInfo("ID"); ?>" name="eCartProms_Delete_<?php echo $eCartProms->DisplayInfo("WAUID"); ?>" />
                      &nbsp;Remove</p>
                    <p class="eC_ItemRemove_Link max_tablet"><a href="#" onclick="waec_update('Remove','eCartProms_Quantity_<?php echo $eCartProms->DisplayInfo("WAUID"); ?>',this);">Remove</a></p></td>
                  <td class="eC_PriceItem desktop_only" id="eCartProms_JSON_Display_Price_<?php echo $eCartProms->DisplayInfo("WAUID"); ?>"><?php echo WA_eCart_DisplayMoney($eCartProms, $eCartProms->DisplayInfo("Price")); ?></td>
                  <td  class="eC_GroupColumn"><p class="eC_FormItem eC_ItemQuantity_AJAX max_tablet">
                    <input type="text" id="eCartProms_Quantity_link_<?php echo $eCartProms->DisplayInfo("WAUID"); ?>" name="eCartProms_Quantity_link_<?php echo $eCartProms->DisplayInfo("WAUID"); ?>" size="3" value="<?php echo $eCartProms->DisplayInfo("Quantity"); ?>" onkeypress="waec_showUpdate('eCartProms_Update_Quantity_<?php echo $eCartProms->DisplayInfo("WAUID"); ?>',this);" />
                    <br />
                    <a href="#" id="eCartProms_Update_Quantity_<?php echo $eCartProms->DisplayInfo("WAUID"); ?>" onclick="waec_update('Quantity','eCartProms_Quantity_link_<?php echo $eCartProms->DisplayInfo("WAUID"); ?>',this);" style="display:none;">Update</a></p>
                    <p class="eC_FormItem eC_ItemQuantity_Edit desktop_only">
                      <input type="text" id="eCartProms_Quantity_<?php echo $eCartProms->DisplayInfo("WAUID"); ?>" name="eCartProms_Quantity_<?php echo $eCartProms->DisplayInfo("WAUID"); ?>" size="3" value="<?php echo $eCartProms->DisplayInfo("Quantity"); ?>" onkeypress="waec_showUpdate('eCartProms_Update_Quantity_<?php echo $eCartProms->DisplayInfo("WAUID"); ?>',this);" />
                    </p></td>
                  <td class="eC_PriceItem desktop_only" id="eCartProms_JSON_Display_TotalPrice_<?php echo $eCartProms->DisplayInfo("WAUID"); ?>"><?php echo WA_eCart_DisplayMoney($eCartProms, $eCartProms->DisplayInfo("TotalPrice")); ?></td>
                  <td class="spacer">&nbsp;</td>
                </tr>
                <tr class="eC_overline">
                  <td colspan="100%"><table cellpadding="0" cellspacing="0" border="0" width="100%">
                    <tr>
                      <td class="spacer">&nbsp;</td>
                      <td class="eC_overline">&nbsp;</td>
                      <td class="spacer">&nbsp;</td>
                    </tr>
                  </table></td>
                </tr>
                <?php
  $eCartProms->MoveNext();
}
$eCartProms->MoveFirst();
?>
            </table></td>
          </tr>
          <tr>
            <td><div class="eC_OrderSummary">
              <table border="0" cellpadding="0" cellspacing="0" class="eC_CartSummary">
                <?php
//WA eCart Merchandizing Show Start
//ecart="eCartProms"
if ($eCartProms->GetDiscounts() > 0 || $eCartProms->GetCharges() > 0 || $eCartProms->GetShipping() > 0 || $eCartProms->GetTax() > 0)     {
?>
                <tr>
                  <td colspan="2" class="eC_Subtotal_Main"><table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td class="eC_Subtotal eC_SummaryLabel">Sub-total:</td>
                      <td class="eC_Subtotal" id="eCartProms_JSON_Display_SubTotal"><?php echo WA_eCart_DisplayMoney($eCartProms, $eCartProms->TotalColumn("TotalPrice")); ?></td>
                    </tr>
                  </table></td>
                </tr>
                <?php
//WA eCart Merchandizing Show End
//ecart="eCartProms"
}
?>
                <tr>
                  <td colspan="2" class="eC_Subtotal_Bottom">&nbsp;</td>
                </tr>
                <?php
//WA eCart Merchandizing Show Start
//ecart="eCartProms"
if ($eCartProms->GetDiscounts() > 0)     {
?>
                <?php
//WA eCart Merchandizing Show End
//ecart="eCartProms"
}
?>
                <?php
//WA eCart Merchandizing Show Start
//ecart="eCartProms"
if ($eCartProms->GetCharges() > 0)     {
?>
                <?php
//WA eCart Merchandizing Show End
//ecart="eCartProms"
}
?>
                <?php
//WA eCart Merchandizing Show Start
//ecart="eCartProms"
if ($eCartProms->GetShipping() > 0)     {
?>
                <?php
//WA eCart Merchandizing Show End
//ecart="eCartProms"
}
?>
                <?php
//WA eCart Merchandizing Show Start
//ecart="eCartProms"
if ($eCartProms->GetTax() > 0)     {
?>
                <?php
//WA eCart Merchandizing Show End
//ecart="eCartProms"
}
?>
                <tr class="eC_SummaryFooter">
                  <td class="eC_SummaryLabel">Grand Total</td>
                  <td id="eCartProms_JSON_Display_GrandTotal"><?php echo WA_eCart_DisplayMoney($eCartProms, $eCartProms->GrandTotal()); ?></td>
                </tr>
              </table>
            </div>
              <table class="eC_ButtonWrapper" cellpadding="0" cellspacing="0">
                <tr>
                  <td><input type="submit" name="eCartProms_Continue_100" id="eCartProms_Continue_100" value="Continue Shopping" class="eC_FormButton" />
                    <input type="submit" name="eCartProms_Clear_100" id="eCartProms_Clear_100" value="Clear Cart" class="eC_FormButton desktop_only" />
                    <input type="submit" name="eCartProms_Update_100" id="eCartProms_Update_100" value="Update" class="eC_FormButton desktop_only" />
                    <input type="submit" name="eCartProms_Checkout" id="eCartProms_Checkout" value="Checkout" class="eC_FormButton" /></td>
                </tr>
              </table></td>
          </tr>
        </table>
      </form>
    </div>
    <?php
//WA eCart Show If Middle
}
else     {
?>

    
    
    
    <?php
//WA eCart Show If End
}
?>
<table id="eC_Crisp_Pacifica_Arial_Empty" style="<?php echo(!$eCartProms->IsEmpty()?'display:none;':''); ?>">
    <tr>
      <td>The cart is empty</td>
    </tr>
  </table>
</div>
<script>
var ecart_json = "WA_eCart/eCartProms_JSON.php";
</script>
<script src="WA_eCart/js/eC_Display.js"></script>
</body>
</html>