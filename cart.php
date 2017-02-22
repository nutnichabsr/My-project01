<?php
session_start();
require 'connect.php';

$action = isset($_GET['a']) ? $_GET['a'] : "";
$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
if (isset($_SESSION['qty']))
{
    $meQty = 0;
    foreach ($_SESSION['qty'] as $meItem)
    {
        $meQty = $meQty + $meItem;
    }
} else
{
    $meQty = 0;
}
if (isset($_SESSION['cart']) and $itemCount > 0)
{
    $itemIds = "";
    foreach ($_SESSION['cart'] as $itemId)
    {
        $itemIds = $itemIds . $itemId . ",";
    }
    $inputItems = rtrim($itemIds, ",");
    $meSql = "SELECT * FROM products WHERE id in ({$inputItems})";
    $meQuery = mysqli_query($sqlConnect,$meSql);
    $meCount = mysqli_num_rows($meQuery);
} else
{

    $meCount = 0;
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
			<div id="tlogo"><img src="image/ther.jpg" width="300" height="100">
			</div>
			<nav>
			<ul>
				<li><a href="index.php">HOME</a></li>
				<li class="active">MENU</li>
				<li><a href="#news">PROMOTION</a></li>
				<li><a href="#news">BOOKING</a></li>
				
			</ul>
			 </nav>
		</div> <!-- menu -->
		 <center><br><br><b>Your Order</b></center>


		 <div class="wrapperorder">
		 <?php
           
            if ($meCount == 0)
            {
                echo "<div class=\"cart-pay\">ไม่มีสินค้าอยู่ในตะกร้า</div>";
            } else
            {
                ?>
            <form action="updatecart.php" method="post" name="fromupdate">    
             <?php
                            $total_price = 0;
                            $num = 0;
                            while ($meResult = mysqli_fetch_assoc($meQuery))
                            {
                                $key = array_search($meResult['id'], $_SESSION['cart']);
                                $total_price = $total_price + ($meResult['product_price'] * $_SESSION['qty'][$key]);
                                ?>
	    	<div class="order">
	    		
	    		<div class="order-img">
	    			<img src="image/<?php echo $meResult['product_img_name']; ?>" width="150" height="150">
	    		</div>
	    		<div class="order-name">
	    			<?php echo $meResult['product_name']; ?>
	    		</div>
	    		<div class="order-name">
	    			<input type="text" name="qty[<?php echo $num; ?>]" value="<?php echo $_SESSION['qty'][$key]; ?>" class="form-control" style="width: 60px;text-align: center;">
                                        <input type="hidden" name="arr_key_<?php echo $num; ?>" value="<?php echo $key; ?>">
	    		</div>
	    		<div class="order-name">
	    			<?php echo number_format(($meResult['product_price'] * $_SESSION['qty'][$key]),2); ?>
	    		</div>
	    		<div class="order-name">
	    			
	    			<a href="removecart.php?itemId=<?php echo $meResult['id']; ?>"><img src="image/d.png" width="105" height="30"></a>
	    			
	    		</div>
	    		<div class="line"></div>

	    	</div>
	    	<?php
                                $num++;
                            }
                            ?>	
         <div class="order-price">
         	รวมทั้งสิ้น:&nbsp<?php echo number_format($total_price,2); ?>  บาท
         	
         	<button class="bgy"><a href="order.php">สั่งซื้อเลย</a></button>
			<button type="submit" class="btn" class="bgw">คำนวณราคาใหม่</button>
         </div> 
         		</form>
 <?php
            }
            ?>            

	    </div>




</div> <!-- wrapper -->





</body>
</html>
<?php
mysqli_close($sqlConnect);
?>