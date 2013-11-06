<?php if(isset($user)): ?>

	<div class='proedithead'>
	Profile Editor: <?=$user->first_name?> <?=$user->last_name?>
	</div>


<form class='profileedit' method='POST' action='/users/p_profileedit'>

	Home <input type='text' name='home'><br>
	Favorite Season <input type='text' name='season'><br>
	Favorite Thing <input type='text' name='favorite'><br>
	Best Friends<input type='text' name='friends'><br>

	<input type='submit' value='Submit Edit' class='proeditsubmit'>

</form>

<div class='proedithead'>
	Password Reset
</div>

<form class='profileedit' method='POST' action='/users/p_password'>
	
	Email: <input type='text' name='email'><br>
	Current Password <input type='password' name='password'><br>
	New Password <input type="password" name='newpassword'><br>

	<input type='submit' value='Submit Change' class='proeditsubmit'>

</form>


<?php else: ?>

<div class="nouser">

	Please sign up or log in

</div>

<?php endif; ?>