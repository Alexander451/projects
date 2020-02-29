<?php
	include "header.php"; //форми за регистрация
?>

	<main>
		<h1>Signup</h1>
		<form action="database/userReg.php" method="post">
			<input type="text" name="username" placeholder="Username">
			<input type="text" name="email" placeholder="E-mail">
			<input type="password" name="pass" placeholder="Password">
			<input type="password" name="pass_repeat" placeholder="Repeat Password">
			<button type="submit" name="signup_btn"> Signup </button> 
		</form>
	</main>
	
<?php
	include "footer.php";
?>