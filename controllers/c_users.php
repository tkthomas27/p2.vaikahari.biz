<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
    } 

    public function index() {
        echo "This is the index page";
    }

    public function signup() {

        // set up the view
        $this->template->content = View::instance('v_users_signup');

        // render the view
        echo $this->template;

    }

    public function p_signup() {

        // echo "<pre>";
        // print_r($_POST);
        // echo "<pre>";

        $_POST['created']= Time::now();
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
        $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

        DB::instance(DB_NAME)->insert_row('users',$_POST);

        Router::redirect('/users/login');
        
    }

    public function login() {

        $this->template->content = View::instance('v_users_login');
        echo $this->template;

    }

    public function p_login() {

        // echo "<pre>";
        // print_r($_POST);
        // echo "<pre>";

        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

        $q = 
            'SELECT *
            FROM users
            WHERE email = "'.$_POST['email'].'"
            AND password = "'.$_POST['password'].'"';

        $token = DB::instance(DB_NAME)->select_field($q);

        //success
        if($token) {
            setcookie('token',$token,strtotime('+1 year'),'/');
            echo "you are logged in";

        }

        //fail
        else {
            echo "login fail";
        }

    }

    public function logout() {
        echo "This is the logout page";
    }

    public function profile($user_name = NULL) {

        //set up the view
        $this->template->content = View::instance('v_users_profile');
        $this->template->title = "Profile";

        $client_files_head = Array('/css/profile.css');

        $this->template->client_files = Utils::load_client_files($client_files_head);

        //pass the data to the view
        $this->template->content->user_name = $user_name;

        //display the view
        echo $this->template;

        //$view = View::instance('v_users_profile');

        //$view->user_name = $user_name;

        //echo $view;

    }

} # end of the class