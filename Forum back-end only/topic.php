<?php
include 'database/database.php';
include 'header.php';

$sql = "SELECT
    topic_id,
    topic_subject,
	topic_date
FROM
    topics	
WHERE
    topics.topic_id = " . mysqli_real_escape_string($connect, $_GET['topic_id']);

$result = mysqli_query($connect,$sql);
	
				
while ($row = mysqli_fetch_assoc($result)){
	
			echo '<table border="1">
				<tr>
					<th> Topic </th>
					<th> Created at </th>
				</tr>';
					echo '<tr>';
						echo '<td class = "leftpart">';
							echo '<h3>' . $row['topic_subject'] . '<h3>';
						echo '</td>';
						echo '<td class="rightpart">';
							echo date('d-m-Y', strtotime($row['topic_date']));
						echo '</td>';
					echo '</tr>';
				}
			
$sql2 = "SELECT
    posts.post_topic,
    posts.post_content,
    posts.post_date,
    posts.post_by,
    users.user_id,
    users.user_name
FROM
    posts
LEFT JOIN
    users
ON
    posts.post_by = users.user_id
WHERE
    posts.post_topic = " . mysqli_real_escape_string($connect, $_GET['topic_id']);
		
$result2 = mysqli_query 
($connect, $sql2);

while ($row2 = mysqli_fetch_assoc($result2)){
	echo '<p>'. $row2['post_content'] .'</p>';
}		
?>

<form method="post" action="reply.php?post_id=5">
    <textarea name="reply-content"></textarea>
    <input type="submit" value="Submit reply" />
</form>