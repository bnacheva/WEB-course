<?php 
	session_start();
	$email    = "";
	$firstname = "";
	$lastname = "";
	$password = "";
	$errors = array(); 
	$_SESSION['success'] = "";
	$db = mysqli_connect('localhost', 'root', '', 'users_db');

	if (isset($_POST['reg_user'])) {
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$firstname = mysqli_real_escape_string($db, $_POST['firstname']);
		$lastname = mysqli_real_escape_string($db, $_POST['lastname']);
		$password = mysqli_real_escape_string($db, $_POST['password']);
		if (empty($email)) { array_push($errors, "Email is required."); }
		if (empty($firstname)) { array_push($errors, "Firstname is required."); }
		if (empty($lastname)) { array_push($errors, "Lastname is required."); }
		if (empty($password)) { array_push($errors, "Password is required."); }
		if (strlen($password) < 6) { array_push($errors, "Password should be at least six symbols."); }

		if (count($errors) == 0) {
			$sql = "SELECT * FROM USERS where email='$email'";
			$res = mysqli_query($db, $sql);
			if (mysqli_num_rows($res) > 0) {
				$row = mysqli_fetch_assoc($res);
				if($email == $row['email']) {
					array_push($errors, "User with this email already exists.");
				}
			}
			else {
				$password = md5($password);
				$query = "INSERT INTO users (email, firstname, lastname, password) 
					  VALUES('$email', '$firstname', '$lastname', '$password')";
				mysqli_query($db, $query);

				$_SESSION['email'] = $email;
				$_SESSION['success'] = "Successful registration.";
				header('location: index.php');
			}
		}

	}

	if (isset($_POST['login_user'])) {
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($email)) {
			array_push($errors, "Email is required.");
		}
		if (empty($password)) {
			array_push($errors, "Password is required.");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['email'] = $email;
				$_SESSION['success'] = "Successful login.";
				header('location: index.php');
			}else {
				array_push($errors, "Wrong email or password.");
			}
		}
	}

?>