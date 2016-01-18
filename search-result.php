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
		if(isset($_POST['submit']) == 'Search'){
			$search = mysql_real_escape_string($_POST['search']);
			$fileds=array('video_url','video_title');
			$match=array('video_url','video_title');
			$res = FullTextSearch('video_library',$fields, $match, $search, $_SESSION['id']);
			$rows = $res->rowCount();
			if($rows == 0){
				echo '<em style="color:#FFAEAE;font-size:24px;">There is no match found in database.</em>';
			}else{
				echo $rows.' Record found in database.<br/>';
					while($row = $res->fetch(PDO::FETCH_ASSOC)){ ?>
						<div class="profile-page-video">
						<?php ViewVideo($row['video_url'], $row['video_title']); ?>
						</div>
				<?php }//end while loop here
			}//($rows == 0) endif here
		}else{ ?>
			<em style="color:#FFAEAE;font-size:24px;">Please provide some value into search feild. </em>
		<?php } ?>
		</div><!--END CONTENT-->
	</div><!--END CONTAINER-->
<?php include 'footer.php'; ?>