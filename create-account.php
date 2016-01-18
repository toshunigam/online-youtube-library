<?php
include 'config.inc.php';
require_once 'functions.php';
if(isset($_POST['submit'])=='Submit'){
	$fname = mysql_real_escape_string($_POST['fname']);
	$lname = mysql_real_escape_string($_POST['lname']);
	$email = mysql_real_escape_string($_POST['email']);
	$pass  = mysql_real_escape_string($_POST['pass']);
	$utype = mysql_real_escape_string($_POST['utype']);
	$data=array(
		'firstname' => $fname,
		'lastname'  => $lname,
		'email'     => $email,
		'password'  => $pass,
		'user_type' => $utype,
		'status'    => 1,
		'date'      => curdate()
	);
	InsertPDO('library_user', $data);
	header("Location: index.php");
}
include 'header.php';
?>
<script language="javascript">
function validform(){
var y=document.forms["myForm"]["fname"].value;
if(y==null || y=="" || y.length<3)
{
alert('please enter your First name which is more than 3 character');
document.forms["myForm"]["fname"].focus();
return false;
}
var p=document.forms["myForm"]["lname"].value;
if(p==null || p=="" || p.length<2)
{
alert('please enter your Last name which is more than 2 character');
document.forms["myForm"]["lname"].focus();
return false;
}
var x=document.forms["myForm"]["email"].value;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<2 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
  alert("Not a valid e-mail address");
  document.forms["myForm"]["email"].focus();
  return false;
  }
  var v=document.forms["myForm"]["pass"].value;
if(v==null || v=="" || v.length<4)
{
alert('please enter passwors which is more than 4 in length');
document.forms["myForm"]["pass"].focus();
return false;
}
}
</script>
</head>

<body>
<div id="wrapper">
	<?php include 'main-menu.php'; ?>
<div id="header">
<?php if(!empty($_SESSION['id'])){ ?>
	<h2 class="user">Welcome : <?php echo ucfirst($_SESSION['user']) ?></h2>
	<?php } ?>
</div>

<div id="container">
<?php include 'sidebar.php'; ?>
<div id="content">
<div class="login">
<form name="myForm" method="post" onSubmit="return validform();">
<label for="fname"><span>First name:</span><input type="text" name="fname" value="" /></label>
<label for="lname"><span>Last name:</span><input type="text" name="lname" value="" /></label>
<label for="email"><span>Email : </span><input type="text" name="email" value="" /></label>
<label for="password"><span>Password :</span><input type="password" name="pass" value="" /></label>
<label for="utype"><span>User Type:</span><select name="utype" >
<option value="Only user">Only user</option>
<option value="Modarator">Modarator</option>
<option value="Admin">Admin</option>
</select></label>
<label for="btn"><span></span><input type="submit" name="submit" value="Submit" /></label>
</form>
</div>
</div><!--END CONTENT-->
</div><!--END CONTAINER-->
<?php include 'footer.php';