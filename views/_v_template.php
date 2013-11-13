<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	
	<link rel="stylesheet" type="text/css" href="/css/style.css" media="screen">
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	

<div id="main_container">
	<div id="header">
    	<div id="logo"><a href="/"><img src="/images/logo.png" height = "50px" alt="" title="" border="0"></a></div>
        
        
          <div id="menu">
            <ul>      
            	
            		<li><a href = '/'> Home</a></li>                                   
                <?php if($user):?>  
<!--                 	<li><a href = '/'> Home</a>              	 -->
					<li><a href = '/posts/add'> Add Post</a></li>
					<li><a href = '/posts'> View Posts</a></li>
					<li><a href = '/posts/users'> Follow Users</a></li>
					<li><a href = '/users/reset'> Reset Password</a></li>
					<li><a href = '/users/logout'> Logout</a></li>
				<?php else: ?>
					<li><a href = '/users/signup'> Sign up</a></li>
					<li><a href = '/users/login'> Login</a></li>
				<?php endif; ?>

            </ul>
        </div>
      
    </div>

   <div class="green_box">
   <div class="text_content">



	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
	
	</div>
	</div>
</div>
</body>
</html>