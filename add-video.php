<?php
include 'config.inc.php';
session_start();
include 'header.php';
?>
<script language="javascript">
function validform(){
//var y=document.forms["myForm"]["category"].value;
//if(y==null || y=="" || y.length<3)
//{
//alert('please enter your First name which is more than 3 character');
//document.forms["myForm"]["category"].focus();
//return false;
//}
var p=document.forms["myForm"]["url"].value;
if(p==null || p=="" || p.length<15)
{
alert('please enter valid URL');
document.forms["myForm"]["url"].focus();
return false;
}
var p = p.match(/https:\/\/(?:www\.)?youtube.*watch\?v=([a-zA-Z0-9\-_]+)/);
if(!p){
alert('please enter valid URL');
document.forms["myForm"]["url"].focus();
return false;
}
var p=document.forms["myForm"]["title"].value;
if(p==null || p=="" || p.length<4)
{
alert('please enter title name of the video which is more than 4 character');
document.forms["myForm"]["title"].focus();
return false;
}

var p=document.forms["myForm"]["tags"].value;
if(p==null || p=="" || p.length<4)
{
alert('please enter few tags which is more than 4 character');
document.forms["myForm"]["tags"].focus();
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
				$form_data = array(
				'video_library_id' => 0,
				'user_id'          => $_SESSION['id'],
				'category_id'      => mysql_real_escape_string($_POST['category']),
				'video_url'        => mysql_real_escape_string($_POST['url']),
				'video_title'      => mysql_real_escape_string($_POST['title']),
				'video_tag'        => mysql_real_escape_string($_POST['tags']),
				'status'           => 1,
				'date'             => date('Y-m-d')
				);
				InsertPDO('video_library', $form_data);
			}else{ ?>
				<form name="myForm" method="post" onSubmit="return validform();">
					<label for="utype"><span>Select Category:</span><select name="category" size="1">
					<?php 
					$sql = "SELECT category_id, category_name FROM video_category WHERE user_id=:user_id";
					$res=$dbh->prepare($sql);
					$res->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
					$res->execute();
					while($row = $res->fetch(PDO::FETCH_ASSOC)){ ?>
					<option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></option>
					<?php } ?>
					</select></label>
					<label for="fname"><span>video URL:</span><input type="text" name="url" value="" /></label>
					<label for="lname"><span>Title:</span><input type="text" name="title" value="" /></label>
					<label for="lname"><span>Tags:</span><input type="text" name="tags" value="" /></label>
					<label for="btn"><span></span><input type="submit" name="submit" value="Submit" /></label>
				</form>
			<?php } ?>
			</div>
		</div><!--END CONTENT-->
	</div><!--END CONTAINER-->
<?php include 'footer.php';