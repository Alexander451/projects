<?php
include 'database/database.php';
include 'header.php';



if(isset($_SESSION['userUid']) == false){
	echo 'You must be signed in to post!';
} else {
	$sql = "INSERT INTO posts(post_content, post_date, post_topic, post_by)
	VALUES ('" . $_POST['reply-content'] . "',
                  NOW(),
              " . mysqli_real_escape_string($connect, $_GET['post_id']) . ",
              " . $_SESSION['userUid'] . ")";
			  
			  $result = mysqli_query($connect, $sql);
			  
			  if (!$result){
				  echo 'Your reply was not posted, please try again later!';
			  } else {
				  echo 'Your reply was saved!';
			  }
}

include 'footer.php';
?>