<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

/*
    public function index() {
        echo "This is the index page";
    }
*/

    public function signup($error = NULL) {
    
    	#Set up the view
        $this->template->content = View::instance('v_users_signup');
        
        # Pass data to the view
	    $this->template->content->error = $error;
	
        
        #Render the view
        echo $this->template;
    }


	public function p_signup() {

		# Checking for empty fields
		if("" == trim($_POST['first_name']) || "" == trim($_POST['last_name']) || "" == trim($_POST['email']) || "" == trim($_POST['password'])){
			Router::redirect("/users/signup/error");
		} 
		
		
		
		#Checking for duplicate emails
				
		$q = "SELECT * FROM users WHERE email = '".$_POST['email']."'";
		
		# Query Database
		$user_exists = DB::instance(DB_NAME)->select_rows($q);
		
		# If email exists in database
		if(!empty($user_exists)){
		
		# Send to Login page
		Router::redirect('/users/login');
		}
		
		$_POST['created'] = Time::now();
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
		

		
		DB::instance(DB_NAME)->insert_row('users',$_POST);
		
		#Send confirmation email upon signup
		
		$to[]    = Array("name" => $_POST['first_name'], "email" => $_POST['email']);
		$from    = Array("name" => APP_NAME, "email" => APP_EMAIL);
		$subject = "Successful Signup to SeaBird Blog!";	
		
 		$body = View::instance('v_email'); 
	
	    # Send email
 		Email::send($to, $from, $subject, $body, true, ''); 
		
		/* REDIRECT TO HOME PAGE*/ 
		
 		ROUTER::redirect('/'); 
		
		
	}
	
    public function login($error = NULL) {

	    # Set up the view
	    $this->template->content = View::instance("v_users_login");
	
	    # Pass data to the view
	    $this->template->content->error = $error;
	
	    # Render the view
	    echo $this->template;

	}   
	 
    public function p_login(){
	    
		
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		
		# Checking for empty fields
		if("" == trim($_POST['email']) || "" == trim($_POST['password'])){
			Router::redirect("/users/login/error");
		} 

		else{
		
			$q = 'SELECT token
			FROM users
			WHERE email = "'.$_POST['email'].'" 
			AND password = "'.$_POST['password'].'"' ;
			
		    
		    $token = DB::instance(DB_NAME)-> select_field($q);
		    
		    #Success
		    if($token){
		    	setcookie('token',$token,strtotime('+5 days'),'/');
			    Router::redirect('/');
			    
		    }
		    #Fail
		    else{
			    Router::redirect("/users/login/error");
			    
		    }
		}
		
    }


public function reset($error = NULL) {

	    # Set up the view
	    $this->template->content = View::instance("v_users_reset");
	
	    # Pass data to the view
	    $this->template->content->error = $error;
	
	    # Render the view
	    echo $this->template;

	}   
	 
    public function p_reset(){
	    
	    # Checking for empty fields
	    if("" == trim($_POST['password']) || "" == trim($_POST['new_password'])){
			Router::redirect("/users/reset/error");
		} 
		
	   		
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		$new_password = sha1(PASSWORD_SALT.$_POST['new_password']);
		
		$d = Array("password" => $new_password);
		$where_condition = 'WHERE user_id = '.$this->user->user_id;
		$insert  = DB::instance(DB_NAME)->update("users", $d, $where_condition);
		
   				    
	    #Success
	    if($insert){
		    Router::redirect('/');
		    
	    }
	    #Fail
	    else{
		    Router::redirect("/users/reset/error");
		    
	    }
	    
/* 	    echo($token); */
    }



    public function logout() {
        $new_token =sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
        
        $data = Array ('token'=> $new_token);
        
        DB::instance(DB_NAME)->update('users',$data,'WHERE user_id ='. $this->user->user_id);
        
        setcookie('token','',strtotime('-1 year'),'/');
        
        Router::redirect('/');
    }

    public function profile(){
    
    
       $this->template->content = View::instance('v_users_profile');
       $this->template->title = 'Profile';
     
/*        $this ->template -> content ->user_name = $user->first_name;; */
       echo $this->template;
      
    }

} # end of the class