<?php if(isset($user)): ?>


	<div class="prohead">
		<?=$user->first_name?> <?=$user->last_name?>
	</div>

	<span class="note">NOTE: your profile information is viewable by EVERYONE in the follow tab</span>

<div class='prodetail'>
	Home: <?=$user->home?><br>
	Favorite Season: <?=$user->season?><br>
	Favorite Thing: <?=$user->favorite?><br>
	Best Friends: <?=$user->friends?><br>
</div>

<div class='edit'>
	<a href="/users/profileedit">Edit Profile</a>
</div>

<?php else: ?>

	<h1>No user specified</h1>

<?php endif; ?>