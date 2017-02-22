<?php
session_start();
require 'connect.php';

$meSql = "SELECT * FROM products ";
$meQuery = mysqli_query($sqlConnect,$meSql);

$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
if(isset($_SESSION['qty'])){
    $meQty = 0;
    foreach($_SESSION['qty'] as $meItem){
        $meQty = $meQty + $meItem;
    }
}else{
    $meQty=0;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ther bar & bistro</title>
	<meta charset="utf-8">
	<!-- <link rel="stylesheet" type="text/css" href="css/ther.css"> -->
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
</head>
<body>
	<div id="wrapper">
		<div id="menu">
			<div id="tlogo"><img src="image/ther.jpg" width="300" height="100"></div>
			<nav>
			<ul>
				<li><a href="index.php">HOME</a></li>
				<li class="active">MENU</li>
				<li><a href="#news">PROMOTION</a></li>
				<li><a href="#news">BOOKING</a></li>
				
			</ul>
			 </nav>
			 <div id="num-cart"></div>
			<div class="icon">
				<a href="login.php"><img src="image/user.png" width="100" height="100"></a>
			</div>
			<div class="icon">
				<a href="cart.php"><img src="image/cart.png" width="100" height="100"></a>
			</div>
			<div class="cart-num">(<?php echo $meQty; ?>)</div>
	    </div>
	    <center><br><br><b>OUR LASTEST  MENU</b></center>
	    <div class="m-2">
	    	<button class="bgy">Food</button>
	    	<button class="btn" class="bgw">Drink</button>
	    </div>

	    
	    <div class="wrapproduct">
	    	<?php
        while ($meResult = mysqli_fetch_assoc($meQuery))
            {
                ?>
	    	<div class="product">
	    	
		    	<div class="img-menu"><img src="image/<?php echo $meResult['product_img_name']; ?>">
		    	</div>
		    	<div class="content">
		    	<h2><?php echo $meResult['product_price']; ?> BATH</h2 >
		    	<?php echo $meResult['product_name']; ?>
		    	<h3><?php echo $meResult['product_detail']; ?></h3>
		    	</div>
		    	<a href="updatecart.php?itemId=<?php echo $meResult['id']; ?>" role="button">
		    	<div class="btn-pro">Add to cart</div></a>
		    	
	    	</div>
	    	<?php
		          }
		       ?>


	    	

	    </div>
	    <footer>© 2017 create by | nutnicha beawsiri<br>For education only</footer>

	   
		

			
					

	</div><!-- end wrapper -->

</body>
</html>
<?php
mysqli_close($sqlConnect);
?>