
<?php if($user): ?>
	<h1>Profile for <?=$user->first_name;?>  <?=$user->last_name;?> </h1>
<?php

else:?>
	
	<h1>Welcome to the SeaBird Blog! </h1>
	<p class="white">
	"Please Sign Up or Login to get started!" 
	</p>
	

<?php endif; ?>