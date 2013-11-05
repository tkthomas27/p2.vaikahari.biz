<?php if(isset($user)): ?>


	<h1 id="prohead"><?=$user->first_name?> <?=$user->last_name?></h1>

	<span id="note">NOTE: your profile information is viewable by EVERYONE in the follow tab</span>


	<div id="home" class="prodetail">Home: <?=$user->home?></div>
	<div id="season" class="prodetail">Favorite Season: <?=$user->season?></div>
	<div id="thing" class="prodetail">Favorite Thing: <?=$user->favorite?></div>
	<div id="freinds" class="prodetail">Best Friends: <?=$user->friends?></div>

<div class='edit'>
	<a href="/users/profileedit">Edit Profile</a>
</div>

<?php else: ?>

	<h1>No user specified</h1>

<?php endif; ?>