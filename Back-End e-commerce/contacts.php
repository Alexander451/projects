
<!DOCTYPE html>
<html lang="en">
    <head>
	
        <meta charset="UTF-8">
        <title>Seafood Shop</title>
        <link href="css/styleindex.css" rel="stylesheet" type="text/css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/4e93d54e94.js" crossorigin="anonymous"></script>
        <script> 
        function checklink(e){ 
            return confirm('Going to: ' + e.href + ' ?'); 
        } 
        </script> 
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
    <div class="containercontacts">
        <div class="contacts">
            <a>Телефон:</a><br>
            <a>089621323</a><br>
            <a>E-mail:</a><br>
            <a>seafoodshop@gmail.com</a><br>
            <a>Адрес:</a><br>
            <a>ул.Искър 26</a><br>
        </div>

        <div class="contactsicons">
            <i class="fab fa-facebook-square fa-4x"></i><br>
            <i class="fab fa-instagram fa-4x"></i><br>
            <i class="fas fa-envelope-square fa-4x"></i><br>
        </div>
        
        <div class="contactsicons1">
            <p style="font-size: 30px;">Запитване за продукт</p>
            <form action="contacts.php" method="post" enctype="multipart/form-data">
		<input placeholder="Относно" type="text" autofocus size="48"><br /><br />
		<textarea placeholder="Въпрос" name="content" rows="20" cols"50"></textarea><br />
		<input name="post" type="submit" value="Запитване">
	</form>
        </div>
    </div>
    
    <footer>&copy; Seafood Shop, 2019</footer>


         <script> 
    document.getElementById("TOURNAMENTS").addEventListener("click", function(event){ 
            if(!confirm('Going to: ' + event.target.href + " ?")){event.preventDefault();} 
});
</script>
</body>
</html>