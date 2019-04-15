<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<div class="header">
		<h2>Registration page</h2>
	</div>
	<form method="post" action="register.php">
		<?php include('errors.php'); ?>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" maxlength="255" value="<?php echo $email; ?>">
		</div>
		<div class="input-group">
			<label>Firstname</label>
			<input type="text" name="firstname" maxlength="100" value="<?php echo $firstname; ?>">
		</div>
		<div class="input-group">
			<label>Lastname</label>
			<input type="text" name="lastname" maxlength="100" value="<?php echo $lastname; ?>">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password" minlength="6">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="reg_user">Register</button>
		</div>
		<p>
			Already have a registration? <a href="login.php">Login</a>
		</p>
	</form>
</body>

</html>