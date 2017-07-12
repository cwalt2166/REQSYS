<?php
	if(session_id() == ''){
    //session has not started
    session_start();
}
	header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

	$r = isset($_GET['r']) ? $_GET['r'] : 0 ;
	$v = isset($_GET['v']) ? $_GET['v'] : '' ;

require_once('inserts/setUpDB.php');

$edit_id = isset($_SESSION['requisitionID']) ? $_SESSION['requisitionID'] : -1 ;
$getOrderDetails = DB::queryFirstRow("SELECT * FROM tblorders WHERE requisitionID =  %i", $edit_id);

	switch ($r) {
    case 1:
        $r_msg = '<div class="ui success message">
								  <i class="close icon"></i>
								  <div class="header">
								    Your vendor submission was successful!
								  </div>
								  <p>Vendor added to our database. You may begin using it immediately</p>
								</div>';

        break;
    case 2:
        $r_msg = "Vendor already exists in our database! Please check the list carefully. A minimum of (3) characters are required to begin a vendor query";
        break;

    default:
        $r_msg = '';

}


function getDefault($array, $key, $default) {

    return isset($array[$key]) ? $array[$key] : $default;
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
 <link rel="stylesheet" href="plugins/iCheck/square/red.css">
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

      <h1><i class="fa fa-shopping-bag" aria-hidden="true"></i>    Edit Order</h1>

     <div id='messagebox'><?php print $r_msg;?></div>
      <!-- Your Page Content Here -->


<form action="inserts/editOrderController.php" method="post" enctype="multipart/form-data" name="orderForm"  id="orderForm" data-dmx-validate="true" class="ui form">

<div class="row">
  <div class="col-md-3"><div class="form-group">
  <label class="control-label required" for="BSOApprover">Business Services Specialist</label>
  <div class="controls ">
    <select id="BSOApprover" name="BSOApprover" class='ui fluid dropdown' required="true">
        <option value="<?php echo getDefault($getOrderDetails, 'BSOApprover', 'Choose One');?>"><?php echo getDefault($getOrderDetails, 'BSOApprover', '');?></option>
        <option value="jborrome">Joseph Borromeo</option>
        <option value="sespinal">Sandra Espinal</option>
        <option value="jmahaffy">Judith Mahaffy</option>
        <option value="mprince1">Monique Prince</option>
        <option value="cwomack">Carl Womack</option>
    </select>

  </div>
</div></div>
  <div class="col-md-3"><div class="form-group">
  <label class="control-label required"  for="VENDOR_NAME"><button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#addVendorModal"><span  class="fa fa-plus-circle fa-lg"></span></button> Vendor/Supplier</label>
  <div id="the-basics">
      <input id="VENDOR_NAME" name="VENDOR_NAME" value="<?php echo getDefault($getOrderDetails, 'VENDOR_NAME', '');?>" class="form-control" type="text" required="true" style="text-transform:capitalize" autocomplete="off" />
  </div>
<p></p>



</div>
</div>

<div class="col-md-3"><div class="form-group">
  <label for="frsNumber" class="control-label required">KFS Account Number</label>

    <input type="text" class="form-control" id="frsNumber" name="frsNumber" value="<?php echo getDefault($getOrderDetails, 'frsNumber', '');?>" required="true"  data-rule-minlength="7" data-rule-maxlength="9">
     <span class="err error"></span>
</div></div>

     <div class="col-md-3"><div class="form-group">
  <label for="dateRequiredBy" class="control-label required">Date Required By</label>

 <div class="controls">
        <input class="datepicker form-control" name="dateRequiredBy" id="dateRequiredBy" type="text" value="<?php echo getDefault($getOrderDetails, '', date("m/d/Y", strtotime($getOrderDetails['dateRequiredBy'])));?>" required="" format="date"/>
 </div>

</div></div>

</div>

<div class="row" id="approver_sel">


  <div class="col-md-3"><div class="form-group">
  			<label class="control-label required" for="approver"><i class="fa fa-question-circle" aria-hidden="true"   data-toggle="popover" data-content="Your group approver is selected by default, to have someone else approve the order, select OTHER"></i> Approver</label>
  					<div class="controls">

      				<?php include_once dirname(__FILE__) . '/inserts/getEditApprovers.php';?>

				</div>
		</div>
</div>

<div class="col-md-3"><div class="form-group">
  			<label for="preapprover" class="control-label"><i class="fa fa-question-circle" aria-hidden="true"   data-toggle="popover" data-content="If OTHER was selected as approver, select an alternate approver here"></i> Approver (Other)</label>
  				<div class="controls">

					<?php include_once dirname(__FILE__) . '/inserts/getEditAllApprovers.php';?>


				</div>
		</div>
</div>


</div>


 <div class="row">

 <div class="col-md-3">
 	<div class="form-group">
  <label class="control-label required" for="shipping_type"><i class="fa fa-question-circle" aria-hidden="true"   data-toggle="popover" data-content="Any premium shipping selection outside of ground, courier or mail requires justification. Please state the need for expedited shipping inside the comment box"></i> Shipping Type</label>
  <div class="controls ">
    <select id="shipping_type" name="shipping_type" class='ui fluid dropdown' required="">
      <option value="<?php echo getDefault($getOrderDetails, 'shipping_type', 'Cheapest Available');?>" selected="selected" ><?php echo getDefault($getOrderDetails, 'shipping_type', 'Cheapest Available');?></option>

                <option value="Cheapest Available">Cheapest Available</option>

                <option value="Overnight" >Overnight</option>

                <option value="Next day" >Next day</option>

                <option value="2-Day" >2-Day</option>

                <option value="FedexSaver" >Fedex Saver</option>

                <option value="Ground" >Ground</option>

                <option value="US Mail" >US Mail</option>
                <option value="Courier/Freight" >Courier/Freight</option>

                <option value="Other" >Other</option>
    </select>

  </div>
</div>
</div>

     <div class="col-md-3">
     	<div class="form-group">
  <label class="control-label required" for="shipping_location">Shipping Location</label>
  <div class="controls ">
    <select id="shipping_location" name="shipping_location" class='ui fluid dropdown' required="">
    	order_notes
      <option value="<?php echo getDefault($getOrderDetails, 'shipping_location', 'Chem-091');?>" selected="selected" ><?php echo getDefault($getOrderDetails, 'shipping_location', 'Chem-091');?></option>
      <option value="Chem-091">Chem-091</option>
      <option value="Biomolecular Sci. Bldg.">Biomolecular Sciences Bldg</option>
        <option value="Other" >Other</option>
    </select>

  </div> </div>
</div>

<div class="col-md-3">
  	<div class="form-group">
  <label class="control-label required" for="orderpriority">Order Priority</label>
  <div class="controls ">
    <select id="orderpriority" name="orderpriority" class='ui fluid dropdown' required="">
                 <option value="<?php echo getDefault($getOrderDetails, 'orderpriority', 'Normal');?>"><?php echo getDefault($getOrderDetails, 'sorderpriority', 'Normal');?></option>
            <option value="High">High</option>
            <option value="Urgent">Urgent</option>
    </select>

  </div>
</div>
</div>

 <div class="col-md-3">
 	<div class="form-group">
  <label for="RadioActive" class="control-label required">Radio Active</label>

  <div class="radio">
       <label class="radio-custom radio-inline" data-initialize="radio" id="RadioActive-0">
        <input name="RadioActive" type="radio" value="No" <?php strStr($getOrderDetails['RadioActive'], "No")?print"checked=true":print "";?>> <span class="radio-label">No</span>
      </label>
      <label class="radio-custom radio-inline" data-initialize="radio" id="RadioActive-1">
        <input name="RadioActive" type="radio" value="Yes" <?php strStr($getOrderDetails['RadioActive'], "Yes")?print"checked=true":print "";?>> <span class="radio-label">Yes</span>

</div>
</div>

</div>
</div>

 <div class="row">
 <div class="col-md-6">

     <div class="form-group">
  <label for="order_attachment" class="control-label"><i class="fa fa-question-circle" aria-hidden="true"   data-toggle="popover" data-content="Add any attachments to your requisition here: Permitted file types (image, excel spreadsheet, word document or pdf)"></i> Add Attachment [multiple files should be collated into one document]</label>

  <input type="file" id="order_attachment" name="order_attachment">


		 <br/>

	 	<label for="order_quote" class="control-label">Have an equote number or  promotion code?</label>
	   <input type="text" id="orderQuote" name="orderQuote" value="<?php echo getDefault($getOrderDetails, 'orderQuote',NULL);?>">
  </div>

   <?php if(!empty($getOrderDetails['order_attachment'])) {?>
        <p><div class="media">
					  <div class="media-left">
					    <a href="#"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>

					    </a>
					  </div>
					  <div class="media-body">
					    <h4 class="media-heading">Order Attachment</h4>
					    <a href="attachments_uploads/<?php echo $getOrderDetails['order_attachment']; ?>" target="_blank" class="link-icon">
					    	<?php echo substr_replace($getOrderDetails['order_attachment'],$getOrderDetails['reqNumber'],0,-4); ?>
					    	</a>
					  </div>
				</div></p>
			<?php } ?>

</div>

  <div class="col-md-6"><div class="form-group">
  <label class="control-label" for="order_notes">Purchaser Comments</label>

    <textarea class="form-control" id="order_notes" name="order_notes" rows="3"><?php echo getDefault($getOrderDetails, 'order_notes',NULL);?></textarea>


</div></div>

 <!-- Indicates caution should be taken with this action -->
<button type="submit" class="btn btn-primary right-button" id="exsbm">Save and Continue</button>
</div>
        <input type="hidden" name="old_filename" value="<?php echo getDefault($getOrderDetails, 'order_attachment',NULL);?>">


 </form>




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
<script>
// object to validate form fields when they lose focus, via Ajax
// receives the ID of the Submit button, and an Array with the IDs of the fields which to validate
  var checkFormElm = function(id_sbm, fields) {
  // from: http://coursesweb.net/ajax/
  var phpcheck = 'inserts/checkAccount.php';  // Here add the php file that validate the form element
  var elm_sbm = document.getElementById(id_sbm);  // the submit button
  var fields = fields || [];  // store the fields ID
  var elm_v = {};  // store items with "elm_name:value" (to know when it is changed)
  var err = {};  // stores form elements name, with value of -1 for invalid, value 1 for valid, and 0 for not checked

  // change the css class of elm
  var setelm = function(elm, val) {
    // if val not empty, sets in err an item with element name, and value of 1
    // sets border to this form element,
    // else, sets in err an item with element name, and value of 0, and removes the border
    if(val != '') {
      err[elm.name] = -1;
      elm.className = 'form-control';
      if(elm_sbm) elm_sbm.setAttribute('disabled', 'disabled');  // disables the submit
      elm.parentNode.querySelector('.err').innerHTML = val;  //  adds the error message
      document.getElementById ("frsNumber").value = '';
    }
    else {
      err[elm.name] = 1;
      elm.className = 'form-control';
      elm.parentNode.querySelector('.err').innerHTML = '';  //  removes the error message

      // check if invalid or not checked items in $err (with value not 1)
      var inv = 0;
      for(var key in err) {
        if(err[key] != 1) {
          inv = 1;
          break;
        }
      }

      // if not invalid element, enables the submit button
      if(inv == 0 && elm_sbm) {
        elm_sbm.removeAttribute('disabled');

      }
    }
  }

  // sends data to a php file, via POST, and displays the received answer
  var checkAjax = function(elm) {
    if(elm.value != '' && (!elm_v[elm.name] || elm_v[elm.name] != elm.value)) {
      elm_v[elm.name] = elm.value;  // store name:value to know if was modified
      var xmlHttp =  (window.ActiveXObject) ? new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest();  // gets the XMLHttpRequest instance

      // create pairs index=value with data that must be sent to server
      var  datatosend = elm.name +'='+ elm.value;
      xmlHttp.open("POST", phpcheck, true);      // set the request to php file

      // adds  a header to tell the PHP script to recognize the data as is sent via POST
      xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlHttp.send(datatosend);     // calls the send() method with datas as parameter

      // Check request status
      xmlHttp.onreadystatechange = function() {
        if(xmlHttp.readyState == 4) setelm(elm, xmlHttp.responseText);
      }
    }
    else if(elm.value =='') setelm(elm, 'This field must be completed.');
  }

  // register onchange event to form elements that must be validated with PHP via Ajax
  for(var i=0; i<fields.length; i++) {
    if(document.getElementById(fields[i])) {
      var elm = document.getElementById(fields[i]);
      err[elm.name] = 0;  //store fields-name in $err with value 0 (not checked)
      elm.addEventListener('change', function(e){ checkAjax(e.target);});
    }
  }
}

/* USAGE */
// array with IDs of the fields to validate
var fields = ['frsNumber'];

// create an object instance of checkFormElm(), passing the ID of the submit button, and the $fields
var chkF = new checkFormElm('exsbm', fields);
</script>

<script type="text/javascript">
$(function() {

    $( "#VENDOR_NAME" ).autocomplete({
        minLength: 3, source: "inserts/getVendorsJson.php"
    });
  });


$(function () {
        //Format the date for datapicker widget
		$('#dateRequiredBy').mask("99/99/9999");
        $('.datepicker').datepicker({ weekStart:1, color: 'red'});

		//Add the red asterisk to required fields
		$('label.required').append('&nbsp;<strong style="color:red">*</strong>&nbsp;');

        // file upload control : provides styling and permitted extentions
        $('#order_attachment').fileinput({'showUpload':false, 'showPreview' : false,
            'allowedFileExtensions' : ['jpg', 'png','gif','doc','xls','docx','xlsx','pdf'],
            'msgInvalidFileExtension' : 'Invalid extension for file "{name}". Only "{extensions}" files are supported.',
            'elErrorContainer': '#errorBlock'});

    });

</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->


 <!-- Modal -->
<div id="addVendorModal" class="modal fade" role="dialog">
  <div  id="modal-dialog" class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="font-size:11pt !important;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-truck" aria-hidden="true"></i>   Add New Vendor</h4>
      </div>
      <div id="modal-body" class="modal-body">
     <div id="modal-message"></div>
          <form id="frmAddVendor"  name="frmAddVendor" action="inserts/newVendorController.php" method="post">

                <!-- Form Name -->

                <!-- Text input http://getbootstrap.com/css/#forms -->
                <div class="form-group">
                    <label class="control-label required" for="VENDOR_NAME">Company/Organization</label>
                    <input class="form-control" id="VENDOR_NAME" name="VENDOR_NAME"
                    placeholder="" required="" type="text">
                </div><!-- Text input http://getbootstrap.com/css/#forms -->
                <div class="form-group">
                    <label class="control-label" for="VENDOR_EMAIL">
                    Email Address</label>
                    <input class="form-control" id="VENDOR_EMAIL" name="VENDOR_EMAIL"
                    placeholder="" type="email">
                     <p class="help-block">A valid sales contact email address is required for vendors outside the US</p>
                </div><!-- Text input http://getbootstrap.com/css/#forms -->
                <div class="form-group">
                    <label class="control-label required" for="VENDOR_PHONE">
                    Telephone Number</label>
                    <input class="form-control" id="VENDOR_PHONE" name="VENDOR_PHONE"
                    placeholder="" required="" type="text">
                </div><!-- Text input http://getbootstrap.com/css/#forms -->
                <div class="form-group">
                    <label class="control-label required" for="VENDOR_URL">
                    Website URL</label>
                    <input class="form-control" id="VENDOR_URL" name="VENDOR_URL"
                    placeholder="http://www.websiteurl.com" required="" type="url">
                </div><!-- Button http://getbootstrap.com/css/#buttons -->

              <div class="modal-footer">
           <button class="btn btn-primary" name="sbtAddVendor" id="sbtAddVendor">Submit</button>
           <button type="submit" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
        </form>

      </div>

    </div>

<script type="text/javascript">
// change the dependancy and required attribute of approvers

$(document).ready( function() {

        $(document.body).on('change', '#approver', function() {
            var selectedText = $(this).find("option:selected").text();
            var selectedValue = $(this).val();
            var d = document.getElementById("preapprover");


			          if (selectedValue == "other"){



				            document.getElementById ("approver_email").value = '';
						        document.getElementById ("approver_email").setAttribute('disabled','disabled');
						        document.getElementById ("preapprover").setAttribute('required','');
						        document.getElementById ("pre_approver_email").setAttribute('required','');
						        document.getElementById ("preapprover").removeAttribute('disabled','disabled');
						        document.getElementById ("pre_approver_email").removeAttribute('disabled','disabled');
				   }else{
				   	        document.getElementById ("approver_email").removeAttribute('disabled','disabled');
				   	        document.getElementById ("approver_email").value = selectedValue +'@umd.edu';
				   	        document.getElementById ("preapprover").value = '';
				   	        document.getElementById ("pre_approver_email").value = '';
				   	        document.getElementById ("preapprover").removeAttribute('required','');
						        document.getElementById ("pre_approver_email").removeAttribute('required','');
						        document.getElementById ("preapprover").setAttribute('disabled','disabled');
						        document.getElementById ("pre_approver_email").setAttribute('disabled','disabled');


							   	}

        });
});




$(document).ready( function() {

        $(document.body).on('change', '#preapprover', function() {
            var selectedText2 = $(this).find("option:selected").text();
            var selectedValue2 = $(this).val();



             $('input[name="pre_approver_email"]').val(selectedValue2 +'@umd.edu');



        });

 });


var my_msg = <?php echo json_encode($r_msg); ?>;

$(document).ready( function() {
    $(".box").text(my_msg);

});

$(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_square-red',
    radioClass: 'iradio_square-red',
    increaseArea: '20%' // optional
  });
});


/***CLOSE THE MESSAGE BOX  ****/
$('.message .close')
  .on('click', function() {
    $(this)
      .closest('.message')
      .transition('fade')
    ;
  })
;

$(function () {
  $('[data-toggle="popover"]').popover()
})

</script>
  </div>
</div>
</body>
</html>
