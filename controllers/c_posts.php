<?php

class posts_controller extends base_controller {

 	public function __construct() {
 		parent::__construct();

 		if(!$this->user) {
 			die('Please, <a href="/users/login">Login</a>');
 		}
 	}

 	public function add() {

 		$this->template->content = View::instance("v_posts_add");
        $this->template->title = "New Post";

 		echo $this->template;
 	}

 	public function p_add() {

 		$_POST['user_id']=$this->user->user_id;
 		$_POST['created']=Time::now();
 		$_POST['modified']=Time::now();

 		DB::instance(DB_NAME)->insert('posts',$_POST);

 		Router::redirect('/posts/');

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
            WHERE users_users.user_id = '.$this->user->user_id.'
            ORDER BY posts.created DESC';

        # Run the query, store the results in the variable $posts
        $posts = DB::instance(DB_NAME)->select_rows($q);

        # Pass data to the View
        $this->template->content->posts = $posts;

        # Render the View
        echo $this->template;

    }

    public function users() {

    # Set up the View
    $this->template->content = View::instance("v_posts_users");
    $this->template->title   = "Users";

    # Build the query to get all the users
    $q = "SELECT *
        FROM users";

    # Execute the query to get all the users. 
    # Store the result array in the variable $users
    $users = DB::instance(DB_NAME)->select_rows($q);

    # Build the query to figure out what connections does this user already have? 
    # I.e. who are they following
    $q = "SELECT * 
        FROM users_users
        WHERE user_id = ".$this->user->user_id;

    # Execute this query with the select_array method
    # select_array will return our results in an array and use the "users_id_followed" field as the index.
    # This will come in handy when we get to the view
    # Store our results (an array) in the variable $connections
    $connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

    # Pass data (users and connections) to the view
    $this->template->content->users       = $users;
    $this->template->content->connections = $connections;

    # Render the view
    echo $this->template;
}

 	public function follow($user_id_followed) {

 		$data = Array(
 			"created" => Time::now(),
 			"user_id"=> $this->user->user_id,
 			"user_id_followed" => $user_id_followed
 			);

 		DB::instance(DB_NAME)->insert('users_users',$data);

 		Router::redirect("/posts/users");
 	}

 	public function unfollow($user_id_followed) {

 		$where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;

 		DB::instance(DB_NAME)->delete('users_users',$where_condition);

 		Router::redirect("/posts/users");
 	}
 }
      