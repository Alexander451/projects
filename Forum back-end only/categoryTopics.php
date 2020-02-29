<?php
include 'header.php';
include 'database/database.php';



$catID = $_GET['cat_id'];
$sql = "SELECT cat_id, cat_name, cat_description FROM categories WHERE cat_id = " . mysqli_real_escape_string($connect, $catID);
$result = mysqli_query($connect, $sql);


	if(!$result){
		echo 'There was a problem with displaying the category!';
	} else {
		while ($row = mysqli_fetch_assoc($result)){
			echo '<h2>Topics in ' . $row['cat_name'] . ' category</h2>';
		}
		
		$sql = "SELECT topic_id, topic_subject, topic_date, topic_cat FROM topics WHERE topic_cat = " . mysqli_real_escape_string($connect, $_GET['cat_id']);
		$result = mysqli_query($connect, $sql);
		
		if(!$result){
			echo 'Topics could not be displayed!';
		} else {
			if(mysqli_num_rows($result) == 0){
				echo 'There are no topics in this category yet!';
			} else {
				echo '<table border="1">
				<tr>
					<th> Topic </th>
					<th> Created at </th>
				</tr>';
				
				while ($row = mysqli_fetch_assoc($result)){
					echo '<tr>';
						echo '<td class = "leftpart">';
							echo '<h3><a href="topic.php?topic_id=' . $row['topic_id'] . '&topic_date= '.$row['topic_date'].'">' . $row['topic_subject'] . '</a><h3>';
						echo '</td>';
						echo '<td class="rightpart">';
							echo date('d-m-Y', strtotime($row['topic_date']));
						echo '</td>';
					echo '</tr>';
				}
			}
		}
	}

include 'footer.php';
?>
