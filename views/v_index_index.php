<?php if($user): ?>

Hello <?=$user->first_name;?>



<pre>
<?php 
	print_r($user)
	
?>
</pre>

<?php

else:?>


Welcome to my app. Please sign up or Log in

<?php endif; ?>