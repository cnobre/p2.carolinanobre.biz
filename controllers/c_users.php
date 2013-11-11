<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        echo "This is the index page";
    }

    public function signup() {
    
    	#Set up the view
        $this->template->content = View::instance('v_users_signup');
        
        #Render the view
        echo $this->template;
    }


	public function p_signup() {
	
		/*echo "<pre>";
		print_r($_POST);
		echo "<pre>";
		*/
		
		$_POST['created'] = Time::now();
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
		
		echo "<pre>";
		print_r($_POST);
		echo "<pre>";
		
		
		DB::instance(DB_NAME)->insert_row('users',$_POST);
		
		/* REDIRECT TO HOME PAGE*/ 
		
		//ROUTER::redirect('/users/login');
		
		
	}
    public function login() {
        #Set up the view
        $this->template->content = View::instance('v_users_login');
        
        #Render the view
        echo $this->template;

    }
    
    public function p_login(){
	    
		
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		
		/*
		echo "<pre>";
		print_r($_POST);
		echo "<pre>";
		*/
		
		$q = 'SELECT token
		FROM users
		WHERE email = "'.$_POST['email'].'" 
		AND password = "'.$_POST['password'].'"' ;
		
/* 		echo $q; */
		
/* 		DB::instance(DB_NAME)->select_row($q); */
	    
	    $token = DB::instance(DB_NAME)-> select_field($q);
	    
	    #Success
	    if($token){
	    	setcookie('token',$token,strtotime('+5 minutes'),'/');
		    Router::redirect('/');
		    
	    }
	    #Fail
	    else{
		    echo "Login failed!";
		    
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

    public function profile($user_name = NULL) {
    
    	if (!$this->user){
/* 	    	Router::redirect('/'); */
			die ('Members only');	    	
	    	
    	}
    	else {
	    	die('Members only. <a href="/users/login"> Login </a>');
    	}
    
       $this->template->content = View::instance('v_users_profile');
       $this->template->title = 'Profile';
       
       $client_files_head = Array(
       '/css/profile.css'
       );
       
       $this->template->client_files_head = Utils::load_client_files($client_files_head);
       
       $client_files_body = Array(
       '/js/profile.js'
       );
       
       $this->template->client_files_body = Utils::load_client_files($client_files_body);
       
       $this ->template -> content ->user_name = $user_name;
       echo $this->template;
      
    }

} # end of the class