

<?php if($user): ?>
	<h1>Welcome <?=$user->first_name;?></h1>
<?php

else:?>
	
	<h1>Welcome to the SeaBird Blog! </h1>
	<p class="white">
	"Please Sign Up or Login to get started!" 
	</p>
	
<?php endif; ?>

<br><br>
<img src="images/birds.png" width = "860px" alt="" title=""> 

<p>
	+1 Feature - Reset Password <br>
	+1 Feature - Email confirmation upon successful signup
	</p> 
	

	 
 