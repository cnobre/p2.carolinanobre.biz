<h1> Sign Up</h1>

<form method ='POST' action = '/users/p_signup'>

	First Name <input type ='text' name = 'first_name'><br>
	Last Name <input type ='text' name = 'last_name'><br>
	Email <input type ='text' name = 'email'><br>
	Password <input type ='password' name = 'password'><br>
	
	<br><br>
	
	<?php if(isset($error)): ?>
        <div class='error'>
            Signup failed. Please make sure all fields have values!
        </div>
        <br>
    <?php endif; ?>

	
	<input type ='submit' value = 'Sign Up'>
	
</form>

