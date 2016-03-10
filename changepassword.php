<?php
session_start();
include 'config.inc.php';
require_once 'functions.php';
if(isset($_POST['submit'])=='Change Password'){
	$old = mysql_real_escape_string($_POST['old']);
	$new = mysql_real_escape_string($_POST['newpass']);
	$confirm = mysql_real_escape_string($_POST['confirm']);
	$sql="SELECT password FROM library_user WHERE user_id=:id AND password=:pwd LIMIT 1";
	$res=$dbh->prepare($sql);
	$res->bindValue(':id', $_SESSION['id'], PDO::PARAM_INT);
	$res->bindValue(':pwd', $old);
	$res->execute();
	//$dbh=null;//it is good practice to null $dbh db connection
	$data=$res->fetch(PDO::FETCH_ASSOC);
	//print_r($data);die;
 	if($data['password']===$old)
	{
		$data=array('password'=>$new);
		$filter=array('user_id'=>$_SESSION['id']);
		/* $query="UPDATE library_user SET password=:pwd WHERE user_id=:user_id";
		$res=$dbh->prepare($query);
		$res->bindValue(':pwd',$new);
		$res->bindValue(':user_id',$_SESSION['id']);
		$res->execute();
		 */
		UpdatePDO('library_user',$data,$filter);
		header("Location: logout.php");
	}else
	{
		header("Location: changepassword.php?error=yes");
	}
}

include 'header.php';
?>
<script language="javascript">
function validform(){
	var y=document.forms["myForm"]["old"].value;
	if(y==null || y=="" || y.length<3)
	{
		alert('please enter old password');
		document.forms["myForm"]["old"].focus();
		return false;
	}
	var p=document.forms["myForm"]["newpass"].value;
	var q=document.forms["myForm"]["confirm"].value;
	if(p!===q)
	{
		alert('Your password not matched');
		document.forms["myForm"]["newpass"].focus();
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
<?php if(isset($_GET['error'])){ echo "<p>Your Old password not matched, Please provide valid password.</p>";} ?>
<div class="login">
<form name="myForm" method="post" onSubmit="return validform();">
<label for="password"><span>Old Password :</span><input type="password" name="old" value="" /></label>
<label for="password"><span>New Password :</span><input type="password" name="newpass" value="" /></label>
<label for="password"><span>Confirm Password :</span><input type="password" name="confirm" value="" /></label>
<label for="btn"><span></span><input type="submit" name="submit" value="Change Password" /></label>
</form>
</div>
</div><!--END CONTENT-->
</div><!--END CONTAINER-->
<?php include 'footer.php';