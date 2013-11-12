

<h1> Reset Password </h1>
<form method='POST' action='/users/p_reset'>

    Old Password<br>
    <input type='password' name='password'>    
    <br><br>

    New Password<br>
    <input type='password' name='new_password'>
    <br><br>

    <?php if(isset($error)): ?>
        <div class='error'>
            Reset failed. Please double check your old password and insert a non-empty new password.
        </div>
        <br>
    <?php endif; ?>

    <input type='submit' value='Reset Password'>

</form>

