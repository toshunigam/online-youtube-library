<?php
include 'config.inc.php';
session_start();
include 'header.php';

?>
<script language="javascript">
function validform(){
	var x = document.forms["myform"]["category"].value;
	if(x==null || x=="" || x.length<3){
	alert('please enter your category name which is more than 3 character');
	document.forms["myform"]["category"].focus();
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
	<?php
	if(isset($_POST['submit'])== 'Submit'){
		include 'functions.php';
		$data = array(
			'category_id' => 0,
			'user_id'	=>	$_SESSION['id'],
			'category_name'	=>	mysql_real_escape_string($_POST['category']),
			'status'	=>	1,
			'date'	=>	date('Y-m-d')
		);
		//dbRowInsert('video_category', $data);
		$output=InsertPDO('video_category', $data);
	}else{
	?>
	<form method="post" name="myform" onSubmit="return validform();">
	<label for="email"><span>Category Name: </span><input type="text" name="category" value="" /></label>
	<label><span></span><input type="submit" name="submit" value="Submit" /> <input type="reset" name="reset" value="Cancel" /></label>
	</form>
	<?php } ?>
</div>
</div><!--END CONTENT-->
</div><!--END CONTAINER-->
<?php include 'footer.php';