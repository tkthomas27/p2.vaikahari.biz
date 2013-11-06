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

	Please sign up or log in

</div>


<?php endif; ?>