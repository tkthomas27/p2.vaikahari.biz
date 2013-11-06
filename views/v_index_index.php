<div class='title'>

	Welcome to App

</div>

<div class='plusone'>
	
	NOW FEATURING: Profile Editing! and Password Reset!

</div>


<?php if ($user): ?>

<div class="landing">
	
	Hello <?=$user->first_name;?>

</div>


<?php else: ?>

<div class="landing">
<!-- fix this -->
	Please sign up or log in

</div>


<?php endif; ?>