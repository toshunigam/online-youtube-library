<?php
include 'config.inc.php';
session_start();
include 'header.php';
include 'functions.php';
?>
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
			<?php 
			$str = "";
			if(!empty($_GET['cat'])){
				$cat = $_GET['cat'];
				$query = "SELECT video_url, video_title FROM video_library WHERE user_id=:user_id AND category_id=:cat_id";
			}else{
				$query = "SELECT video_url, video_title FROM video_library WHERE user_id=:user_id";
			}
			//echo $_SESSION['user'];
			$res=$dbh->prepare($query);
			
			$res->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
			if(isset($cat))
				$res->bindValue(':cat_id', $cat, PDO::PARAM_INT);
			$res->execute();
			$dbh=null;//it is good practice to null $dbh db connection
			while($row = $res->fetch(PDO::FETCH_ASSOC)){ ?>
				<div class="profile-page-video">
					<?php 
					if(!empty($row['video_url']) && !empty($row['video_title']))	
						ViewVideo($row['video_url'], $row['video_title']);
					else
						echo "<h1>There is no more video available.</h1>";
					?>
				</div>
			<?php } //end while loop ?>
		</div><!--END CONTENT-->
	</div><!--END CONTAINER-->
<?php include 'footer.php'; ?>