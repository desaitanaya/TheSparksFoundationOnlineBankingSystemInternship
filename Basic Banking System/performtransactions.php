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
			<a class="nav-link" href="index.php">Home</a>
		</li>
      
		<li class="nav-item">
			<a class="nav-link" href="transaction_history.php">Transaction history</a>
		</li> 
	</ul>	  
	  
	<ul class="navbar-nav ml-auto">
		<li class="nav-item ">
			<a class="nav-link  " href="index.php"  >About</a>
		</li> 
 	</ul>
  
</div>  
</nav>


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

$sql = "SELECT * FROM perform_transactions";
$result = mysqli_query($conn, $sql);
?>
   
<div class="container" style="background-image:url('https://png.pngtree.com/thumb_back/fw800/background/20190216/pngtree-simple-light-color-and-fresh-background-image_3250.jpg');background-size:cover;  background-repeat:no-repeat; ">
<br/>
	<div class="row">
	<div class="col">

    <div class="container-fluid table-responsive-sm">
        <table class="table table-hover table-sm table-striped table-condensed table-bordered">
            <thead>
                <tr>
                    <th>CLIENT ID</th>
                    <th>FIRST NAME</th>
                    <th>LAST NAME</th>
                    <th>EMAIL ID</th>
					<th>BALANCE</th>
                    <th>PERFORM TRANSACTION</th>
                </tr>
            </thead>
        <tbody>
                            
<?php
if (isset($result)) {
	while ($rows = mysqli_fetch_assoc($result)) {
		?>
                                    
				<tr>
                    <td><?php echo (isset($rows['Id']) ? $rows['Id'] : ''); ?></td>
                    <td><?php echo (isset($rows['First_name']) ? $rows['First_name'] : ''); ?></td>
					<td><?php echo (isset($rows['Last_name']) ? $rows['Last_name'] : ''); ?></td>
                    <td><?php echo (isset($rows['Email_id']) ? $rows['Email_id'] : ''); ?></td>
                    <td><?php echo (isset($rows['Balance']) ? $rows['Balance'] : ''); ?></td>
                    <td><a href="transfermoney.php?Id=<?php echo $rows['Id']; ?>"> <button type="button" class="btn btn-primary">Transfer Money  <i class="fa fa-plus-square" style="font-size:20px;"></i></button></a></td>
                </tr>
                            
<?php
    }
 }
?>

        </tbody>
	</table>
</div>
</div>
</div>
</div>
 
</body>

</html>