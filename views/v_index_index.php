

<?php if($user): ?>
	<h1>Welcome <?=$user->first_name;?></h1>
<?php

else:?>
	
	<h1>Welcome to the SeaBird Blog! </h1>
	<p class="white">
	"Please Sign Up or Login to get started!" 
	</p>
	<!--
<div class="read_more"><a href = '/users/signup'>Sign Up</a></div>
	<div class="read_more"><a href = '/users/login'>Login</a></div>
-->
	

<?php endif; ?>

	 
 