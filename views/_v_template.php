<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	

	<!-- JS/CSS File we want on every page -->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>                                
                                                                                
    <!-- Controller Specific JS/CSS -->
    <link rel="stylesheet" href="/css/sample-app.css" type="text/css">
    <?php if(isset($client_files_head)) echo $client_files_head; ?>
					
	
</head>

<body>	

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


	<?php if($user): ?>
		<p class="log">You are logged in as <?=$user->first_name?> <?=$user->last_name?></p><br>
	<?php endif; ?>

	<br><br>
	<!-- insert image that goes across the page -->

	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
	
</body>
</html>