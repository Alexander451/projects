<?php

	if (isset($_POST['signup_btn'])){ //проверява ако идваш от 'signup_btn'
	
		include 'database.php';
		
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['pass'];
		$passRepeat = $_POST['pass_repeat'];
		
		if (empty($username) || empty($email) || empty($password) || empty($passRepeat)){ //проверка за празни полета
			header("Location: ../signup.php?error=emptyfields&username".$username."&email=".$email);	
				exit();
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) { //проверява символи за юзърнейм и дали е валиден и-мейл
		header("Location: ../signup.php?error=invalidemailusername");	
				exit();
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //не помня защо тва се повтаря
		header("Location: ../signup.php?error=invalidemail&username".$username);	
				exit();
		}
		else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) { //проверява за валидни символи за юзър, пак??
		header("Location: ../signup.php?error=invalidusername&email".$email);	
				exit();
		}
		else if ($password !== $passRepeat){ //проверява 2те полета за парола дали съвпадат
		header("Location: ../signup.php?error=passwordcheck&username".$username."&email=".$email);	
				exit();
		} else {
		
			$sql = "SELECT uidUsers FROM users WHERE uidUsers=?"; //взимаме информацията от базата за да може да не съвпадат бъдещи юзър и-мейли
			$stmt = mysqli_stmt_init($connect);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("Location: ../signup.php?error=sqlerror");	
				exit();
			}
			else {
				mysqli_stmt_bind_param($stmt, "s", $username);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$results = mysqli_stmt_num_rows($stmt);
				if($results > 0){ 						//проверява дали е зает и-мейла
					header("Location: ../signup.php?error=usertaken&email".$email);	
				exit();
				}
				else {
					
					$sql = "INSERT INTO users (uidUsers, emailUsers, passUsers) VALUES (?, ?, ?)"; //вкарва те в базата
					$stmt = mysqli_stmt_init($connect);
					if (!mysqli_stmt_prepare($stmt, $sql)){
						header("Location: ../signup.php?error=sqlerror".$email);	
				exit();
					}
					else {
			
						$hashedPass = password_hash($password, PASSWORD_DEFAULT);	//хаш за парола
						
						mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPass);
						mysqli_stmt_execute($stmt);
						mysqli_stmt_store_result($stmt);
						header("Location: ../signup.php?signup=success");
				exit();
					}
				}
			}
		
		}
		mysqli_stmt_close($stmt);
		mysqli_close($connect);
	}
	else {
		header("Location: ../signup.php");	
				exit();
	}
	
?>