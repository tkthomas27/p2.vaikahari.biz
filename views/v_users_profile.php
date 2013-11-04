<?php if(isset($user)): ?>

	<h1>This is the profile for <?=$user->first_name?> <?=$user->last_name?></h1>

	<h2>Profile</h2>

	Home: <?=$user->home?><br><br>
	Favorite Season: <?=$user->season?><br><br>
	Favorite Thing: <?=$user->favorite?><br><br>
	Best Friends: <?=$user->friends?><br><br>

	<a href="/users/profileedit">Edit Profile</a>

<?php else: ?>

	<h1>No user specified</h1>

<?php endif; ?>