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
	include 'functions.php';
	if(isset($_POST['submit'])== 'Submit'){
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
	<?php 
	if(!empty($_GET['delete']))
	{
		Delete('video_category','category_id',$_GET['delete']);
		header('Location: video-category.php');
	}
	$query="SELECT category_id, category_name, date, status FROM video_category WHERE user_id=:user_id";
	$res=$dbh->prepare($query);
	$res->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
	$res->execute();
	$sn=1;
	?>
	<table border="1" width="100%">
	<tr><th>S.N.</th><th>Name</th><th>Date</th><th>Status</th><th>Edit</th><th>Delete</th></tr>
	<?php 
	while($row=$res->fetch(PDO::FETCH_ASSOC)){
		echo "<tr><td>$sn</td><td>".$row['category_name']."</td><td>".$row['date']."</td><td>".$row['status']."</td><td><a href=\"video-category.php?edit=".$row['category_id']."\">edit</a></td><td><a onclick=\"return confirm('Are you sure you want to delete?')\" href=\"video-category.php?delete=".$row['category_id']."\">Delete</a></td></tr>";
		$sn++;
	}
	?>
	</table>
</div>
</div><!--END CONTENT-->
</div><!--END CONTAINER-->
<?php include 'footer.php';