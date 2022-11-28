<?php
session_start();
include_once("config.php");
if (isset($_SESSION['err'])) {
	if ($_SESSION['err'] != '') {
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $_SESSION['err'] . '
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	  </div>';
	}
}
$err = "";
$_SESSION['err'] = "";
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql = "DELETE FROM `paymentdetails` WHERE `orderid` = '$id'";
  $result1 = mysqli_query($conn, $sql);
  if (!$result1) {
    $_SESSION['err'] = "cannot delete the record due to some internal network error";
  }
  unset($_GET['id']);
  header("location: orders.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>user details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
    crossorigin="anonymous"></script>
  <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
    }

    .container {
      margin-top: 4rem;
    }
  </style>
</head>

<body>
  <div class="container">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S. No.</th>
          <th scope="col">Name</th>
          <th scope="col">Address</th>
          <th scope="col">Phone</th>
          <th scope="col">Order ID</th>
          <th scope="col">Customer ID</th>
          <th scope="col">Item</th>
          <th scope="col">Price</th>
          <th scope="col">Payment Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "select * from `paymentdetails`";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result); 
        $sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $sno += 1;
          $msg = "
              <tr>
              <th scope = 'row'>" . $sno . "</th>
              <td>" . $row["name"] . "</td>
              <td>" . $row["address"] . "</td>
              <td>" . $row["phone"] . "</td>
              <td>" . $row["orderid"] . "</td>
              <td>" . $row["customerid"] . "</td>
              <td>" . $row["item"] . "</td>
              <td>" . $row["price"] . "</td>
              <td>" . $row["paymentstatus"] . "</td>
              <td>" . '<button type="button" class="delete btn btn-danger">Delete</button>' . "</td>
              </tr>
              ";
          echo $msg;
        }
        ?>
      </tbody>
    </table>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"> </script>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
  <script>
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener('click', (e) => {
        tr = e.target.parentNode.parentNode;
        id = tr.getElementsByTagName('td')[3].innerText;
        if (confirm("Do you really want to delete this payment record?")) {
          window.location = `orders.php?id=${id}`;
        }
      })
    })
  </script>
</body>

</html>