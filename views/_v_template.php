<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	

	<nav>
		<menu>
			<li><a href='/'>Home</a></li>       
				 <?php if($user): ?>
					<li><a href='/posts/add'>Add Post</a></li>
					<li><a href='/posts/'>View Posts</a></li>
					<li><a href='/posts/users'>Follow Users</a></li>
					<li><a href='/users/logout'>Logout</a></li>
				<?php else: ?>
					<li><a href='/users/signup'>Sign Up</a></li>
					<li><a href='/users/login'>Log In</a></li>
				<?php endif; ?>
		</menu>
	</nav>


	<?php if($user): ?>
		You are logged in as <?=$user->first_name?> <?=$user->last_name?><br>
	<?php endif; ?>

	<br><br>

	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
	
</body>
</html>