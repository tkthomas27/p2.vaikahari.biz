
	<!-- landing page title -->
	<div class='title'>

		Constellations Unknown

	</div>

	<!-- landing page subtitle -->
	<div class='subtitle'>

		Your home for pretentiosity...

	</div>

	<!-- plusone announcement -->
	<div class='plusone'>
		
		NOW FEATURING: Profile Editing! and Password Reset!

	</div>

	<!-- if user is logged in, then display welcome message -->
	<?php if ($user): ?>

		<div class="landing">
			
			Hello <?=$user->first_name;?>

		</div>

	<!-- if user is not logged ask them to login or signup -->
	<?php else: ?>

		<div class="nouser">

			Please <a href='/users/signup'>Sign Up</a> or <a href='/users/login'>Log In</a>
							
		</div>

	<?php endif; ?>