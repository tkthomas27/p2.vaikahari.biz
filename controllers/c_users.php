<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 


    public function signup() {

        // set up the view
        $this->template->content = View::instance('v_users_signup');

        // render the view
        echo $this->template;

    }

    public function p_signup() {

        $_POST['created']= Time::now();
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
        $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

        DB::instance(DB_NAME)->insert_row('users',$_POST);

        Router::redirect('/users/login');
        
    }

    public function login() {

        $this->template->content = View::instance('v_users_login');
        $this->template->title   = "Login";

        //Render Template
        echo $this->template;

    }

    public function p_login() {

        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        $q = 
            'SELECT token
            FROM users
            WHERE email = "'.$_POST['email'].'"
            AND password = "'.$_POST['password'].'"';

        $token = DB::instance(DB_NAME)->select_field($q);

        //success
        if($token) {
            setcookie('token',$token,strtotime('+1 year'),'/');
            /////////////experiment with this below
            // echo "you are logged in";

            //Route back to homepage
            Router::redirect('/');

        }

        //fail
        else {
            echo "login fail <a href='/users/login'>would you like to try again?</a>";
        }

    }

    public function logout() {

        $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

        $data = Array('token'=>$new_token);

        DB::instance(DB_NAME)->update('users',$data,'Where user_id ='.$this->user->user_id);

        setcookie('token','',strtotime('-1 year'),'/');

        Router::redirect('/');

    }

    public function profile($user_name = NULL) {

        if(!$this->user){
            die('Members only. <a href="/users/login">Login</a>');
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

        if(!$this->user){
            die('Members only. <a href="/users/login">Login</a>');
        }

        //set up the view
        $this->template->content = View::instance('v_users_profileedit');
        $this->template->title = "Profile Edit";

        //pass the data to the view
        $this->template->content->user_name = $user_name;

        //display the view
        echo $this->template;

    }

    public function p_profileedit() {

        $new_home = $_POST['home'];
        $new_season = $_POST['season'];
        $new_favorite = $_POST['favorite'];
        $new_friends = $_POST['friends'];

        $prodata = Array('home'=>$new_home,'season'=>$new_season,'favorite'=>$new_favorite,'friends'=>$new_friends);

        DB::instance(DB_NAME)->update('users',$prodata,'Where user_id ='.$this->user->user_id);

        Router::redirect('/users/profile');

    }

} # end of the class


