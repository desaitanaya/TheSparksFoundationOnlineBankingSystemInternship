<!DOCTYPE html>
<html lang="en">
<head>
  <title>BASIC BANKING SYSTEM</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/92ad78f9ca.js" crossorigin="anonymous"></script>
  
</head>
<body>



<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
	<a class="navbar-brand" href="#"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>
  
<div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" href="index.php" >Home</a>
		</li>
     
		<li class="nav-item">
			<a class="nav-link" href="performtransactions.php" >Perform Transactions</a>
		</li>	 
    </ul>	  
	  
	<ul class="navbar-nav ml-auto">
		<li class="nav-item ">
			<a class="nav-link  " href="#"  >About</a>
		</li> 
 	</ul>
  </div>  
</nav>
<body>

<div class="container" style="background-image:url('https://i.pinimg.com/originals/bb/34/32/bb34322867bac537177e88978908da7e.jpg');">
<br>
    <div class="container-fluid table-responsive-sm" >
        <table class="table table-hover table-striped table-condensed table-bordered">
            <thead>
                <tr>
                    <th>Sr No.</th>
                    <th>Sender</th>
                    <th>Recipient</th>
                    <th>Amount</th>
                    <th>Timestamp</th>
                    </tr>
            </thead>
        <tbody>
                    
<?php

$servername = "localhost";
$username = "root";
$password = "abcd1234";
$dbname = "bank";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * from transaction_history";
$query = mysqli_query($conn, $sql);
while ($rows = mysqli_fetch_assoc($query)) {
?>

            <tr>
                <td><?php echo $rows['Sr_no']; ?></td>
                <td ><?php echo $rows['Sender']; ?></td>
                <td><?php echo $rows['Receiver']; ?></td>
                <td><?php echo $rows['Balance']; ?> </td>
                <td><?php echo $rows['Date_time']; ?> </td>

<?php
}
mysqli_close($conn);
?>
                </tbody>
            </table>
	    </div>
    </div>
    
</body>
</html>