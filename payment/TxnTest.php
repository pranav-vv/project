<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
include_once('../config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta name="GENERATOR" content="Evrsoft First Page">
	<title>Merchant Check Out Page</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
    crossorigin="anonymous"></script>
</head>
<script> 
	if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
	</script>
<body>
	<?php
		if(isset($_POST['name'])){
			$name = $_POST['name'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];
		$title = $_POST['title'];
		$price = $_POST['price'];
		$color = $_POST['color'];
		$size = $_POST['size'];
		$title = ($title." ".$color." ".$size);
		$orderid = "ORD".$_POST['phone'].str_replace(' ','',strtoupper($_POST['title'])).rand(1000, 9999);
		$customerid = 'CUST'.rand(10000, 99999);
		$query = "insert into `paymentdetails` (`name`,`address`,`phone`,`orderid`,`customerid`,`item`,`price`,`paymentstatus`)values('$name','$address','$phone','$orderid','$customerid','$title','$price','not done')";
    	$result = mysqli_query($conn, $query);
		}
		else{
			header('Location: ../index.php');
		}
	?>
	<div class="container mt-2">
	<form action="pgRedirect.php" method="post">
		<div class="payment" id="mypayment" style="height: 400px;">
			<h1 class="payTitle">Payment Page</h1>
			<p><i>(Please do not refresh this page)</i></p>
			<label for="ORDER_ID" class="form-label">Order ID</label>
			<input readonly id="ORDER_ID" class="form-control" tabindex="1" maxlength="30" size="30" name="ORDER_ID"
				autocomplete="off" value="<?php echo $orderid; ?>">
			<label for="CUST_ID" class = "form-label">CUSTOMER ID</label>
			<input readonly class = "form-control" id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID"
				autocomplete="off" value="<?php echo $customerid; ?>">
			<label for='desc' class = "form-label">Item Description</label>
			<input id='desc' readonly class="form-control" value="<?php echo $title; ?>">
			<label for="amnt" class="form-label">Amount</label>
			<input readonly class="form-control" tabindex="10" type="number" name="TXN_AMOUNT"
				value="<?php echo $_POST['price']; ?>" id='amnt'>
			<input type="hidden""id=" INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID"
				autocomplete="off" value="Retail">

			<input type="hidden" id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID"
				autocomplete="off" value="WAP">
			<input value="Pay Now!" type="submit" class="btn btn-primary mt-2">
		</div>
	</form>
	</div>
	
</body>

</html>