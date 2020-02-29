<?php
	include 'header.php';
	include 'database/database.php';
?>

	<main>
		<?php
		if(isset($_SESSION['userUid'])){
			echo '<p> You are logged in! Hello '. mysqli_real_escape_string($connect, $_SESSION['userUid']) . '!</p>';
		} else {
			echo '<p> You are logged out! </p>';
		}
		
		$sql = "SELECT cat_id, cat_name, cat_description FROM categories";// това е
		$result = mysqli_query($connect, $sql); 						// друга база
																		// с категории и
if(!$result){															// страници за форум
	echo "Could not display categories!";
} else { 
	if(mysqli_num_rows($result) == 0){
		echo "No categories defined yet.";
	} else {
	echo '<table border = "1">
		  <tr>
			<th>Category</th>
			<th>Last Topic</th>
		  </tr>';
		  
			$sqlT = "SELECT topic_cat FROM topics";
			$resultT = mysqli_query($connect, $sqlT);
			
			
		  while($row = mysqli_fetch_assoc($result)){
			  $row2 = mysqli_fetch_assoc($resultT);
			  echo '<tr>';
				echo '<td class="leftpart">';
					echo '<h3> <a href="categoryTopics.php?cat_id=' . $row['cat_id'] . '&topic_cat= '.$row2['topic_cat'].'">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
				echo '</td>';
				echo '<td class = "rightpart">';
					echo '<a href="topic.php?topic_id= "> Last Topic</a>';
				echo '</td>';
			echo '</tr>'; // до тук е излишно
				
		  }
		
	}
}
		?>
		
		
	</main>
	
<?php
	include "footer.php";
?>