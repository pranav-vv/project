<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Payment Status</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
		crossorigin="anonymous"></script>
</head>
<body>
	<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your applications MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum); //will return TRUE or FALSE string.

?>
	<div class="container mt-5">
		<?php
if ($isValidChecksum == "TRUE") {
	// echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		// echo "<b>Transaction status is success</b>" . "<br/>";
		//Process your transaction here as success transaction.
		//Verify amount & order id received from Payment gateway with your application's order id and amount.
	} else {
		echo "<b>Transaction status is failure</b>" . "<br/>";
	}
	if (isset($_POST) && count($_POST) > 0) {
		echo '<p>' . 'Your transaction for order id ' . '<b>' . $_POST['ORDERID'] . '</b>' . ' is successfully completed and you have paid $' . '<b>' . $_POST['TXNAMOUNT'] . '</b>' . ' on ' . '<b>' . $_POST['TXNDATE'] . '<b>' . '</p>';
		require_once('../config.php');
		$orderid = $_POST['ORDERID'];
		$sql = "UPDATE `paymentdetails` SET `paymentstatus`='done' WHERE `orderid` = '$orderid'";
		$result = mysqli_query($conn, $sql);
		$to_email = "pranav2577@gmail.com";
		$subject = "New Order From Nike Store";
		$body = "you have received a new order from your Nike Store. Please check your database to see the details";
		$headers = "From: ms772254@gmail.com";
		mail($to_email, $subject, $body, $headers);
	}
} else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}
?>
		<button class="btn btn-primary" onclick="window.open('../index.php','_self')">Go Back</button>
	</div>
</body>

</html>