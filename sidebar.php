<div id="sidebar">
	<?php
	if(!empty($_SESSION['id'])){
		$sql = "SELECT category_id, category_name FROM video_category WHERE user_id=:user_id";
		$res=$dbh->prepare($sql);
		$res->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);
		$res->execute();
		echo "<h3>Your Category</h3>";
		echo "<ul class=\"sidemenu\">";
		while($row = $res->fetch(PDO::FETCH_ASSOC)){
			echo "<li><a href=\"profile.php?cat=$row[category_id]\">$row[category_name]</a></li>";
		}
		echo "</ul>";
		if(!empty($_GET['cat'])){
			echo "<br/><a href=\"profile.php\">Clear</a><br/>";
		}
	}else{
	echo "<p>No C ategory yet.</p>";
	}
	?>
</div>