<?php if(isset($user)): ?>

	<h1>This is the profile editor for <?=$user->first_name?> <?=$user->last_name?></h1>

	<h2>Edit Profile</h2>

<form method='POST' action='/users/p_profileedit'>
	
	Home <input type='text' name='home'><br>
	Favorite Season <input type='text' name='season'><br>
	Favorite Thing <input type='text' name='favorite'><br>
	Best Friends<input type='text' name='friends'><br>

	<input type='submit' value='Submit Edit'>

</form>

	<a href="/users/profile">Back to Profile</a>

<?php else: ?>

	<h1>No user specified</h1>

<?php endif; ?>