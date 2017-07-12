<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Department of Chemistry & Biochemistry | Purchasing System</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="shortcut icon" href="assets/img/favicon.ico" />
<link href="webapps/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="assets/foundation-icons/foundation-icons.css" rel="stylesheet" type="text/css" media="all" />
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<link rel="stylesheet" href="webapps/base_files/css/normalize.css">
<link rel="stylesheet" href="webapps/base_files/css/foundation.css">
<link href='http://fonts.googleapis.com/css?family=Abril+Fatface|Open+Sans:300,400,600,700,800|Gentium+Book+Basic:400,400italic|Vollkorn:400italic,400' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="semantic/dist/semantic.css">
<link rel="stylesheet" type="text/css" href="webapps/base_files/css/wrapper.css">
<style>
body p{font: 13px/19px font-family:Lato, "Lucida Grande", "Lucida Sans Unicode", Helvetica, sans-serif !important; color: #404039;}
h1, h2, h3, h4, h5 {
    line-height: 1.2857em;
    margin: calc(2rem - .14285em) 0 1rem;
    font-family: 'Open Sans Condensed', sans-serif;
}

h1 {
    
    text-transform: capitalize;
    font-size: 40px;
    font-weight: normal;
    color: #000;
    border-bottom: 1px dashed #222D32;
    padding-bottom: 13px;
}

h2 {padding-left: 0px;padding-top: 13px;font-size:180%;}
h3 {font-size:140%; margin-bottom:-10px}
#menu-wrap{color:white;line-height:20px;padding:8px;font-family:"open sans" !important;float:left; background:black;}
#identify{float:right; width:50%; margin-left:450px; margin-top:-60px;margin-left:806px;text-align:right;font-size:90%;}
#logo{float:left; width:50%; background:transparent;margin-top:-50px;text-transform:capitalize;font-size:28px;color: #fbb040;font-family: 'Open Sans Condensed', sans-serif;}
.columns {overflow:hidden;}
#column1 {text-align:left;}
.button, button	{		display: inline-block;		margin-top: 1.5em;		padding: 0.50em 3em 0.50em 2em;		background: #9B0808 !important;		letter-spacing: 0.20em;		text-decoration: none;		text-transform: uppercase;		font-weight: 400;		font-size: 0.90em;		color: #FFF;	}			.button:before		{			display: inline-block;			width: 40px;			height: 40px;			line-height: 40px;			border-radius: 20px;			text-align: center;			color: #FFF;		}a {color: black;text-decoration: none;line-height: inherit;}
fieldset {
    border: 1px solid #dddddd;
   
    padding: 2px;
     padding-left: 10px;
    margin: 10px;
}

#sidebar .title h2, .title h2, h2.title {font-size: 18.4px;}
h5 {text-transform:uppercase;
color: #9B0808;letter-spacing: 0.10em;
font-weight: 700;display: block;font: 15px/19px Arial, Helvetica, sans-serif;}
a:hover {color: red;text-decoration:underline;
}
#menu {height: 50px;margin-bottom:10px;}
.side_links{font-size:14px;}
.footer {border-top-style:solid;border-top-width:1px;padding:20px;}


</style>
<script src="webapps/base_files/js/vendor/modernizr.js"></script>
</head>
<body>
  <div id="wrapper">
    <div id="header">
      <a href="http://www.umd.edu/" id="umd-logo" style="margin-left:-800px;"><img src="webapps/base_files/img/umd-logo.png" alt="University of Maryland" /></a>
    </div>

    <div id="main">
      <!-- YOUR CONTENT HERE -->
      <!-- Header and Nav -->
 
 <!-- Nav Bar -->
 		<div id="menu">
    		<div id="menu-wrap">
    		<div id="logo"> 
Requisition Management System (REQSYS)
</div>
        		<div id="identify">
        		    		</div>
			</div>
		</div>
  		<!-- End Nav -->

 
 
  <!-- Main Page Content and Sidebar -->
 
<div class="row">
 
    <!-- Main Blog Content -->
<div class="large-12 columns" role="content">
 <hr>
<!--BEGIN TOP DIV---!-->

  <hr>  
<div class="row">
  <div class="large-5 columns">
<p style="margin-top:10px;">
<img src="webapps/images/mall.jpg"></p>
   <p><strong>Login To This Application Using your Directory ID and Password.</strong> By logging in, you agree to respect all applicable laws regarding course content, and to abide by the University of Maryland's Policy on the Acceptable Use of Information Technology Resources.</p>

      <br/>
  </div>
  <div class="large-7 columns"><fieldset>
 <h5>Purchasers</h5>
<hr /><p>If your role requires someone else to approve your order, please login here as a purchaser</p>
<!--<form id="form_student" method="get" action="https://login.umd.edu/cas/login?service=">!-->
<form id="form_student" method="get" action="login.php">
  <input type="submit" value="Login"   class="icon icon-arrow-right button"  id="btnAuth" name="btnAuth" />
  <input name="service" type="hidden" id="service" value="http://portal.chem.umd.edu/undergradoffice/stdnAUTH.php">
</form></fieldset>
<fieldset>


  <h5>Approvers</h5>
  <hr /><p>Please click here to initiate purchases as a self-approver, or to approve purchases for your group</p>
  <form id="form_admins" method="get" action="https://login.umd.edu/cas/login?service=">
    <input type="submit" value="Login"  class="icon icon-arrow-right button"  id="btnAuth" name="btnAuth" />
    <input name="service" type="hidden" id="service" value="http://portal.chem.umd.edu/undergradoffice/facAUTH.php">
  </form>  </fieldset>
  </div>
  <div class="large-2 columns">
</div>    </div> 
    
    
 
  </div><!--END TOP DIV---!-->   

</div>
    <!-- End Main Content -->
 
 
    <!-- Sidebar -->
  
    <!-- End Sidebar -->
 
 
  <!-- End Main Content and Sidebar -->
 
 
  <!-- Footer -->

   
   <footer class="row">
    <div class="large-12 columns">
   <hr>  
      <div class="row">
        <div class="large-12 columns footer">
          <p>&copy; <?php echo date("Y"); ?> Copyright Department of Chemistry &amp; Biochemistry.<br/> Issues & Help Desk - Contact chem-busserv@umd.edu</p>
        </div>
        
      </div>
    </div>
  </footer>  
    </div>
  </div>
  <script src="webapps/base_files/js/vendor/jquery.js"></script>
  <script src="webapps/base_files/js/foundation.min.js"></script>
  <script>
    $(document).foundation();
  </script>
  </body>
</html>
