<?php
class practice_controller extends base_controller {


// insert practice
	public function test_db() {

		// $q = 'INSERT INTO users
		// 	SET first_name = "Albert",
		// 	last_name = "Einstein"';


	// $q = 'UPDATE users
	// 	SET email = "albert@aol.com"
	// 	WHERE first_name = "Albert"';

	// 	echo $q;

	// 	DB::instance(DB_NAME)->query($q);

		// $new_user = Array(
		// 	'first_name'=>'Albert',
		// 	'last_name'=> 'Einstein',
		// 	'email'=>'albert@gmail.com',
		// 	);

		// DB::instance(DB_NAME)->insert('users',$new_user);


// post data example
		// $_POST = DB::instance(DB_NAME)->sanitize($_POST);

		// $q = 'SELECT email
		// 	FROM users
		// 	WHERE first_name= "'.$_POST['first_name'].'"';

		// echo DB::instance(DB_NAME)->select_field($q);

	}





	public function test1() {

		require(APP_PATH.'/libraries/image.php');

		$imageObj = new Image('http://placekitten.com/1000/1000');

		$imageObj->resize(200,200);

		$imageObj->display();
	}

	public function test2() {

		echo Time::now();
	}

}

?>