<!DOCTYPE html>
<html>
<head>
	<title>Ther bar & bistro</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/loginstyle.css">
	<link rel="stylesheet" type="text/css" href="fonts/awe/font-awesome.min.css">
</head>
<body>
	<div id="wrapper">
	<center><img src="image/logo.png" width="600" height="200"></center>
			<div id="log-in-box"><br>
				
				<form action="order.php" method="POST">
  					<input type="text" placeholder='ชื่อ - นามสกุล' required='' type='text' name="name_member" pattern="^[a-zA-Z0-9-_\.]{1,20}$">
  					<input type="text" placeholder='เบอร์โทรติดต่อ' required='' type='text' name="password">
  					<br>
  					<br>
  					<center><input type="submit" id="login-btn" value="Login">
  					</center>
  					<br>	
				</form>
			</div>

					

	</div><!-- end wrapper -->

</body>
</html>