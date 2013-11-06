<div class='title'>

	Constellations Unknown

</div>

<div class='subtitle'>

	Your home for pretentiosity...

</div>

<div class='plusone'>
	
	NOW FEATURING: Profile Editing! and Password Reset!

</div>


<?php if ($user): ?>

<div class="landing">
	
	Hello <?=$user->first_name;?>

</div>


<?php else: ?>

<div class="nouser">

	Please <a href='/users/signup'>Sign Up</a> or <a href='/users/login'>Log In</a>
					
</div>


<?php endif; ?>