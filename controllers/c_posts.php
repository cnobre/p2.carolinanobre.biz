<?php

class posts_controller extends base_controller {

	public function __construct() {
        parent::__construct();
    } 
	
	public function add(){
		
		$this->template->content = View::instance("v_posts_add");
		
		echo $this->template;
	}
	
	public function p_add() {
		

		$_POST['user_id'] = $this->user->user_id;
		$_POST['created'] = Time::now();
		$_POST['modified'] =Time::now();
		
		if("" == trim($_POST['content'])){
			Router::redirect("/posts/add");
		} 
		else{
		
			DB::instance(DB_NAME)->insert('posts',$_POST);
		
		    Router::redirect("/posts");	
		}	
	
	}
	
	
public function index() {

    
# Set up the View
    $this->template->content = View::instance('v_posts_index');
    $this->template->title   = "All Posts";

    # Query
    $q = 'SELECT 
            posts.content,
            posts.created,
            posts.user_id AS post_user_id,
            users_users.user_id AS follower_id,
            users.first_name,
            users.last_name
			FROM posts
			INNER JOIN users_users 
            	ON posts.user_id = users_users.user_id_followed
			INNER JOIN users 
            	ON posts.user_id = users.user_id
			WHERE users_users.user_id = '.$this->user->user_id;

    # Run the query, store the results in the variable $posts
    $posts = DB::instance(DB_NAME)->select_rows($q);

    # Pass data to the View
    $this->template->content->posts = $posts;

    # Render the View
    echo $this->template;


}
	
	public function users(){
	
		$this->template->content = View::instance("v_posts_users");
		
		$q = 'SELECT *
			FROM users';
			
		$users = DB::instance(DB_NAME)->select_rows($q);
		
		$q = 'SELECT *
			FROM users_users
			WHERE user_id = '.$this->user->user_id;
			
		$connections = DB::instance(DB_NAME)->select_array($q,'user_id_followed');
		
		$this->template->content->users = $users;
		$this->template->content->connections = $connections;
		
		echo $this->template;
	}
	
	public function follow($user_id_followed) {

    # Prepare the data array to be inserted
    $data = Array(
        "created" => Time::now(),
        "user_id" => $this->user->user_id,
        "user_id_followed" => $user_id_followed
        );

    # Do the insert
    DB::instance(DB_NAME)->insert('users_users', $data);

    # Send them back
    Router::redirect("/posts/users");

}

public function unfollow($user_id_followed) {

    # Delete this connection
    $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
    DB::instance(DB_NAME)->delete('users_users', $where_condition);

    # Send them back
    Router::redirect("/posts/users");

}
	
}

