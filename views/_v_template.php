<!DOCTYPE html>
<html>

<head>

	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
																											 
	<!-- Controller Specific JS/CSS -->
	<link rel="stylesheet" href="/css/sample-app.css" type="text/css">
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
					
</head>

<body>	

	<div class='wrap'>
	<!-- main menu at the top of the screen-->
	<nav>
		<menu class="nav">
			<li><a href='/'>Home</a></li>       
				 <?php if($user): ?>
					<li><a href='/users/profile'>Profile</a></li>
					<li><a href='/posts/add'>Add Post</a></li>
					<li><a href='/posts/'>View Posts</a></li>
					<li><a href='/posts/users'>Follow</a></li>
					<li><a href='/users/logout'>Logout</a></li>
				<?php else: ?>
					<li><a href='/users/signup'>Sign Up</a></li>
					<li><a href='/users/login'>Log In</a></li>
				<?php endif; ?>
		</menu>
	</nav>


	<!-- log confirming user is logged in -->
	<?php if($user): ?>
		<p class="log">You are logged in as <?=$user->first_name?> <?=$user->last_name?></p><br>
	<?php endif; ?>

	<br><br>

	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
	
	</div>
	
</body>
</html>