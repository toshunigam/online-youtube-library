<div id="main-menu">
	<ul>
	<?php if(empty($_SESSION['id'])){ ?>
		<li><a href="index.php">Login</a></li>
		<li><a href="create-account.php">Create account</a></li>
		<?php }else{ ?>
		
		<li><a href="profile.php">Profile</a></li>
		<li><a href="video-category.php">Category</a></li>
		<li><a href="add-video.php">Add Video</a></li>
		<li><a href="changepassword.php">Change Password</a></li>
		<li><a href="logout.php">Logout</a></li>
	<?php } ?>
	</ul>	
	
	<div class="search">
	<form method="post" action="search-result.php">
	<input type="text" name="search" value="" /><input type="submit" name="submit" value="Search" />
	</form>
	</div>
</div>