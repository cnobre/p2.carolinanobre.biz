<h1> Sign Up</h1>

<form method ='POST' action = '/users/p_signup' id="contact_form">
	<div class="form_row">
		<label>First Name:</label><input type="text" name="first_name" class="contact_input" />
	</div>
	
	<div class="form_row">
		<label>Last Name:</label><input type="text" name="last_name" class="contact_input" />
	</div>
	
	<div class="form_row">
		<label>Email:</label><input type="text" name="email" class="contact_input" />
	</div>                    
	
	 <div class="form_row">
		 <label>Password:</label><input type="text" name="password" class="contact_input" />
	</div>      
	
	<br><br>
	
	<input type ='submit' class = "send" value = 'Sign Up'>
</form>
 
<br><br>
<?php if(isset($error)): ?>
	<div class='error'>
		Signup failed. Please make sure all fields have values!
	</div>
<br>
<?php endif; ?>

