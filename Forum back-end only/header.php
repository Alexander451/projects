<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
	
	<link rel="stylesheet" href="style.css" type="text/css">
	
	<meta charset="utf-8">
	<meta name="description" content="EXAMPLE">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<title>
		Forum
	</title>
		
	</head>
	<body>
		
		<header>
		
			<nav>
			
			<a href="index.php">
			<img src="logo.png" alt="logo"> 
			</a>
			
			
			<a class="item" href="index.php">Home</a> 
			<a class="item" href="aboutUs.php">About us</a> 
			<?php
				if(isset($_SESSION['userId'])) {
					
			echo '<a class="item" href="categories.php">Create a category </a>'; 
			echo '<a class="item" href="createTopic.php">Create a topic </a>'; 
					
			}
			?>
						
			<div id="buttons">
			<?php
				if(isset($_SESSION['userId'])){
					echo '<form action="database/logout.php" method="post">
						  <button type="submit" name="logout-submit"> Logout </button>
						  </form>';
				} else {
					echo '<form action="database/login.php" method="post">
						  <input type="text" name="email" placeholder="Username/E-mail">
						  <input type="password" name="pass" placeholder="Password">
						  <button type="submit" name="login-submit"> Login </button>
						  </form>
						  <a href="signup.php"> Register </a>';
			}
			?>
					
			</div>
			</nav>
		</header>