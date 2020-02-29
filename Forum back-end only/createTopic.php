<?php
include 'database/database.php';
include 'header.php';

echo '<h2> Create a topic. </h2>';

if(isset($_SESSION['userId']) == false){
	echo "Sorry, you have to be logged in to post a topic.";
} else {
	if(isset($_SESSION['userId'])){
		$sql = "SELECT cat_id, cat_name, cat_description FROM categories";
		$result = mysqli_query($connect, $sql);
		
		if (!$result){
			echo "There was an error while loading topics.";
		} else {
			if(mysqli_num_rows($result) == 0){
				echo "No categories yet.";
			} else {
				echo '<form method = "post" action ="">
				Subject: <input type = "text" name = "topic_subject"/> <br>
				Category: ';
				
				echo '<select name = "topic_cat">';
					while($row = mysqli_fetch_assoc($result)){
						echo '<option value = "' . $row['cat_id'] . '">' . $row['cat_name'] . ' </option>';
					}
				echo '</select>';
				echo '<br> Post: <textarea name = "post_content" /></textarea>
				<input type = "submit" name = "addTopic" value = "Create Topic"/>
				</form>';				
			}
		}
	} 
	
	$query = "BEGIN WORK;";
	$result = mysqli_query($connect, $query);
	
	if(isset($_POST['topic_subject']) && isset($_POST['topic_cat'])){
		
	$topicSubject = $_POST['topic_subject'];
	$topicCat = $_POST['topic_cat'];
	
		if(!$result){
			echo "An error occured - could not load query!";
		} else {
			
			$sql = "INSERT INTO topics(topic_subject, topic_date, topic_cat, topic_by)
			VALUES('" . mysqli_real_escape_string($connect, $topicSubject) . "', NOW(),'" 
					  . mysqli_real_escape_string($connect, $topicCat) . "','" . $_SESSION['userId'] . "')";
					  
			$result = mysqli_query($connect, $sql);
			
			if(!$result){
				echo 'An error has occured ' . mysql_error();
				$sql = "ROLLBACK;";
				$result = mysqli_query($connect, $sql);
		} else {
				$topicid = mysqli_insert_id($connect);
				
				$sql = "INSERT INTO posts(post_content, post_date, post_topic, post_by)
				VALUES ('" . mysqli_real_escape_string($connect, $_POST['post_content']) 
						   . "', NOW() , " 
						   . $topicid . ", " 
						   . $_SESSION['userId'] . ")";
						   
					$result = mysqli_query($connect, $sql);
					
			if(!$result){
				echo 'An error has occured while inserting post' . mysqli_error();
				$sql = "ROLLBACK;";
				$result = mysqli_query($connect, $sql);
						} else {
				$sql = "COMMIT;";
				$result = mysqli_query($connect, $sql);
				
				echo 'You have created a <a href="categoryTopics.php?id=' . $topicid . '"> new topic </a>';
					}
				}
			}
		}
	}
?>