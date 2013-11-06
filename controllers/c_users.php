<?php
class users_controller extends base_controller {

	public function __construct() {
		parent::__construct();
	} 


	public function signup($error = NULL) {

		// set up the views
		$this->template->content = View::instance('v_users_signup');
		$this->template->content->error = $error;

		// render the view
		echo $this->template;

	}

	public function p_signup() {

		//check input for blank fields, if blanks exist, die and show error message
		foreach($_POST as $field => $value) {
			if(empty($value)) {
				die("<h2>Please, No blank fields</h2><br><a href=/'/users/signup/'>Sign Up</a>");
			}
		}

		//check if email already exists
		$exists = DB::instance(DB_NAME)->select_field('SELECT email FROM users WHERE email = "'.$_POST['email'].'"');

		//if email exists, die and show an error message
		if($exists){
			die("<h2>Please, that email is already in use</h2><br><a href=/'/users/signup/'>Sign Up</a>");
		}

		else {

		//add a created time to users
		$_POST['created']= Time::now();

		//encode the password and create a token
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

		//add form info and time/token to DB
		DB::instance(DB_NAME)->insert_row('users',$_POST);

		//route user to the login page
		Router::redirect('/users/login');

		}
		
	}

	public function login() {

		//set up the view
		$this->template->content = View::instance('v_users_login');
		$this->template->title   = "Login";

		//Render Template
		echo $this->template;

	}

	public function p_login() {

		//encode the password following the signup procedure
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

		//establish a query to check password and email match in the DB to generate a cookie based on corresponding token
		$q = 
			'SELECT token
			FROM users
			WHERE email = "'.$_POST['email'].'"
			AND password = "'.$_POST['password'].'"';


		$token = DB::instance(DB_NAME)->select_field($q);

		//if token is generated, set a cookie
		if($token) {
			setcookie('token',$token,strtotime('+1 year'),'/');

			//Route back to homepage
			Router::redirect('/');

		}

		//if failure, then try again
		else {
			echo "<h2>login fail <a href='/users/login'>would you like to try again?</a></h2>";
		}

	}

	public function logout() {

		$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

		$data = Array('token'=>$new_token);

		//change to token based on loged out status
		DB::instance(DB_NAME)->update('users',$data,'Where user_id ='.$this->user->user_id);

		//set expiration date of cookie
		setcookie('token','',strtotime('-1 year'),'/');

		//redirect user to homepage
		Router::redirect('/');

	}

	public function profile($user_name = NULL) {

		//if user is not logged in, they cannot see the page
		if(!$this->user){
			die('Please, <a href="/users/login">Login</a>');
		}

		//set up the view
		$this->template->content = View::instance('v_users_profile');
		$this->template->title = "Profile";

		//pass the data to the view
		$this->template->content->user_name = $user_name;

		//display the view
		echo $this->template;

	}

	public function profileedit($user_name = NULL) {

		//if user is not logged in, they cannot see the page
		if(!$this->user){
			die('Please, <a href="/users/login">Login</a>');
		}

		//set up the view
		$this->template->content = View::instance('v_users_profileedit');
		$this->template->title = "Profile Edit";

		//pass the data to the view
		$this->template->content->user_name = $user_name;

		//pass error data to the view
		$this->template->content->error = $error;

		//display the view
		echo $this->template;

	}

	public function p_profileedit() {

		//accept the information from the field
		$new_home = $_POST['home'];
		$new_season = $_POST['season'];
		$new_favorite = $_POST['favorite'];
		$new_friends = $_POST['friends'];

		//set incoming data as an array
		$prodata = Array('home'=>$new_home,'season'=>$new_season,'favorite'=>$new_favorite,'friends'=>$new_friends);

		//use sql to update the DB with the information stored in the array above
		DB::instance(DB_NAME)->update('users',$prodata,'Where user_id ='.$this->user->user_id);

		//route the user back to the profile page
		Router::redirect('/users/profile');


	}

	public function p_password() {

		//encode posted password
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

		//generate query to match password and email
		$q = 
			'SELECT password
			FROM users
			WHERE email = "'.$_POST['email'].'"
			AND password = "'.$_POST['password'].'"';

		//generte var for selecting fields matching the query
		$pwd = DB::instance(DB_NAME)->select_field($q);

		//if var is true carry out these commands to generate a new password
		if($pwd) {

			//encode the new posted password
			$new_password = sha1(PASSWORD_SALT.$_POST['newpassword']);

			//set var for changing password to new password
			$pwdset = Array('password'=>$new_password);

			//update the users table with the above array where the logged in user equals the user_id
			DB::instance(DB_NAME)->update('users',$pwdset,'Where user_id ='.$this->user->user_id);

			//logout process same as above
			$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

			$data = Array('token'=>$new_token);

			DB::instance(DB_NAME)->update('users',$data,'Where user_id ='.$this->user->user_id);

			setcookie('token','',strtotime('-1 year'),'/');

			//route the user back to the home page
			Router::redirect('/');
		}

	}

} # end of the class

