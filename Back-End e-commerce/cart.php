<?php
session_start();
$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
	foreach($_SESSION["shopping_cart"] as $key => $value) {
		if($_POST["code"] == $key){
		unset($_SESSION["shopping_cart"][$key]);
		$status = "<div class='box' style='color:red;'>
		Product is removed from your cart!</div>";
		}
		if(empty($_SESSION["shopping_cart"]))
		unset($_SESSION["shopping_cart"]);
			}		
		}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['code'] === $_POST["code"]){
        $value['quantity'] = $_POST["quantity"];
        break; // Stop the loop after we've found the product
    }
}
  	
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>	
        <meta charset="UTF-8">
        <title>Seafood Shop</title>
        <link href="css/productsstyle.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="css/styleCard.css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/4e93d54e94.js" crossorigin="anonymous"></script>
    </head>
	<body>
			
		<div class="topnav-centeredimg">
                <img src="css/seafoodd.png" class="avatar1"/>
              </div>
           
            <div class="topnav">
              <div class="topnav-centered">
                  <a href="index.php">
                <i class="fas fa-fish"></i>
                  </a>
              </div>

              <!-- Left-aligned links (default) -->
              <a href="products.php">Онлайн Магазин</a>
              <a href="aboutus.php">За нас</a>
              <a href="contacts.php">Контакти</a>
                <a href="cart.php">
              <i class="fas fa-shopping-cart fa-1x"></i>  
                </a>
              <!-- Right-aligned links -->
              <div class="topnav-right">
                <a href="homepage.php">Блог</a>
                <a href="login1.php">Влез</a>
                <a href="register.php">Регистрация</a>
              </div>
        </div>	
            
        <div style="width:700px; margin:50 auto;">

        <?php
        if(!empty($_SESSION["shopping_cart"])) {
        $cart_count = count(array_keys($_SESSION["shopping_cart"]));
        ?>
        <?php
        }
        ?>

        <div class="cart">
        <?php
        if(isset($_SESSION["shopping_cart"])){
            $total_price = 0;
        ?>	
        <table class="table">
        <tbody>
        <tr>
        <td></td>
        <td>ПРОДУКТ</td>
        <td>КОЛИЧЕСТВО</td>
        <td>ЦЕНА ЗА БРОЙ</td>
        <td>ЦЕНА ЗА ВСИЧКИ</td>
        </tr>	
        <?php		
        foreach ($_SESSION["shopping_cart"] as $product){
        ?>
        <tr>
        <td><img src='<?php echo $product["image"]; ?>' width="100" height="80" /></td>
        <td><?php echo $product["name"]; ?><br />
        <form method='post' action=''>
        <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
        <input type='hidden' name='action' value="remove" />
        <button type='submit' class='remove'>Премахни продукт</button>
        </form>
        </td>
        <td>
        <form method='post' action=''>
        <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
        <input type='hidden' name='action' value="change" />
        <select name='quantity' class='quantity' onchange="this.form.submit()">
        <option <?php if($product["quantity"]==1) echo "selected";?> value="1">1</option>
        <option <?php if($product["quantity"]==2) echo "selected";?> value="2">2</option>
        <option <?php if($product["quantity"]==3) echo "selected";?> value="3">3</option>
        <option <?php if($product["quantity"]==4) echo "selected";?> value="4">4</option>
        <option <?php if($product["quantity"]==5) echo "selected";?> value="5">5</option>
        </select>
        </form>
        </td>
        <td style="background-color:white;"><?php echo $product["price"]."лв."; ?></td>
        <td style="background-color:white;"><?php echo $product["price"]*$product["quantity"]."лв."; ?></td>
        </tr>
        <?php
        $total_price += ($product["price"]*$product["quantity"]);
        }
        ?>
        <tr>
        <td colspan="5" align="right">
        <hr>
        <strong>ОБЩО: <?php echo $total_price."лв."; ?></strong>
		<form action="getcreditcard.php" method="POST">
		<input type="hidden" value= "id" name="id">
		<center><input type="submit" id="buynow" value="Pay with credit card"></center>
		</form>
        </td>
        </tr>
        </tbody>
        </table>		
          <?php
        }else{
            echo "<h3>Your cart is empty!</h3>";
            }
        ?>
        </div>

        <div style="clear:both;"></div>

        <div class="message_box" style="margin:10px 0px;">
        <?php echo $status; ?>
        </div>

        </div>
			
	</body>
</html>