<?php //проверка за логин

if (isset($_POST['login-submit'])){
	
	include 'database.php';
	
	$mailuid = $_POST['email'];
	$password = $_POST['pass'];
	
	if (empty($mailuid) || empty($password)){ //проверява за празни полета
		header("Location: ../index.php?error=emptyfields");
		exit();
	}
	else {
		$sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
		$stmt = mysqli_stmt_init($connect);
		if(!mysqli_stmt_prepare($stmt, $sql)){  //проверява дали има регистрирани, ако няма дава еррор
			header("Location: ../index.php?error=sqlerror"); //
			exit();
		}
		else {
			mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			
			if ($row = mysqli_fetch_assoc($result)){ //проверка за въведената парола
				$passCheck = password_verify($password, $row['passUsers']);
				if ($passCheck == false){
					header("Location: ../index.php?error=wrongpassword");	
					exit();
				} 
				else if ($passCheck == true) {
					session_start();						// започва сесия
					$_SESSION['userId'] = $row['idUsers'];
					$_SESSION['userUid'] = $row['uidUsers'];
					
					header("Location: ../index.php?login=success");	
					exit();
				}
				else {
					header("Location: ../index.php?error=nouser");	
					exit();
				}
			}
			else {
				header("Location: ../index.php?error=nouser");	
				exit();
			}
		}
	}
	
}
else {
	header("Location: ../index.php");	
	exit();
}



?>