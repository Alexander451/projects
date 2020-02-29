<?php
include 'database/database.php';
include 'header.php';


?>
<div>
<h1>Create Category</h1>
<form method='post' action=''>
        Category name: <input type='text' name='cat_name' />
        Category description: <textarea name='cat_description' /></textarea>
        <input type='submit' name='addCat_btn' value="Add category" />
</form>
</div>
<?php
if(isset($_POST['cat_name']) && isset($_POST['cat_description'])){
	$catName = $_POST['cat_name'];
	$catDesc = $_POST['cat_description'];
	
}	if (isset($_POST['addCat_btn'])){
		if (empty($catName) || empty($catDesc)){
			header("Location: ../Projects/categories.php?error=emptyfields");	
		exit();
		} else {			
	$sql = "INSERT INTO categories(cat_name, cat_description)
                VALUES('" . mysqli_real_escape_string($connect, $catName)."',
					   '" . mysqli_real_escape_string($connect, $catDesc)."')";
	$result = mysqli_query($connect, $sql);
		}
	if (!$result){
		echo 'Error' . mysql_error();
	} else {
		echo 'New category added.';
	}
} else {
	echo " ";
}
include 'footer.php';
?>

