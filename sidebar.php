<div id="sidebar">
	<?php
	if(!empty($_SESSION['id'])){
		$sql = "SELECT category_id, category_name FROM video_category WHERE user_id=:user_id";
		$res=$dbh->prepare($sql);
		$res->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
		$res->execute();
		?>
		<h3>Your Category <a href="#"><img src="images/16x16-ios7-settings-icon.png" border="0" alt="setting" style="float:right" /></a></h3>
		<ul class="sidemenu">
		<?php
		while($row = $res->fetch(PDO::FETCH_ASSOC)){
			echo "<li><a href=\"profile.php?cat=$row[category_id]\">$row[category_name]</a></li>";
		}
		?>
		</ul>
		<?php
		if(!empty($_GET['cat'])){
			echo "<br/><a href=\"profile.php\">Clear</a><br/>";
		}
	}else{
	echo "<p>No C ategory yet.</p>";
	}
	?>
</div>