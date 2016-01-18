<?php
include 'config.inc.php';
if(isset($_POST['submit'])=='Submit'){
	session_start();
	$email = mysql_real_escape_string($_POST['email']);
	$pass  = mysql_real_escape_string($_POST['pass']);
	$sql   = "SELECT * FROM library_user WHERE email=? AND password=?";
	$res   = $dbh->prepare($sql);
	
	$res->execute(array($email,$pass));
	
	$dbh=null;//it is good practice to null $dbh db connection
	if($res->rowCount() > 0){

		while($row = $res->fetch(PDO::FETCH_ASSOC)){
			$_SESSION['user']  = $row['firstname'];
			$_SESSION['utype'] = $row['user_type'];
			$_SESSION['id']    = $row['user_id'];
			header("location: profile.php");
		}
	}else{
		echo "user or password not match.";
		exit;
	}
}
include 'header.php';
?>
<script language="javascript">
function validform(){
	var x=document.forms["myform"]["email"].value;
	var atpos=x.indexOf("@");
	var dotpos=x.lastIndexOf(".");
	if (atpos<2 || dotpos<atpos+2 || dotpos+2>=x.length)
	{
		alert("Not a valid e-mail address");
		document.forms["myform"]["email"].focus();
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
			<form name="myform" method="post" onSubmit="return validform();">
			<label for="email"><span>Email : </span><input type="text" name="email" value="" /></label>
			<label for="password"><span>Password :</span><input type="password" name="pass" value="" /></label>
			<label><span></span><input type="submit" name="submit" value="Submit" /> <input type="reset" name="reset" value="Cancel" /></label>
			</form>
		</div>
	</div><!--END CONTENT-->
</div><!--END CONTAINER-->
<?php include 'footer.php';