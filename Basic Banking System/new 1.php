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
  <style>
  
 
 


  </style>
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
	<img src="tsf.jpg" href="index.php" style="width:50px; height:50px;">
	</li>
      
      
      <li class="nav-item">
        <a class="nav-link" href="#">Transaction history</a>
      </li> 
	  
	  

</ul>	  
	  <ul class="navbar-nav ml-auto">
	  <li class="nav-item ">
        <a class="nav-link  " href="#"  >About</a>
      </li> 
<li class="nav-item navbar-right">
        <a class="nav-link " href="#" >Contact</a>
      </li> 	  
	  
    </ul>
  </div>  
</nav>

<body>
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
    ?>
    
    <div class="container-fluid">

        <?php
       
        if (isset($_REQUEST['Id'])) {
            $sid = $_GET['Id'];
            $sql = "SELECT * FROM  perform_transactions where Id=$sid";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                echo "Error : " . $sql . "<br>" . mysqli_error($conn);
            }
            $rows = mysqli_fetch_assoc($result);
        }
        ?>
        <form method="post" name="tcredit" class="tabletext"><br>

            <div class="container-fluid">
                <table class="table table-sm table-striped table-condensed table-bordered">
                    <tr>
                        <th class="text-center">Client Id</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">E-mail</th>
                        <th class="text-center">Bank Balance</th>
                    </tr>
                    <tr>
                        <td class="center py-2"><?php echo (isset($rows['Id']) ? $rows['Id'] : ''); ?></td>
                        <td class="center py-2"><?php echo (isset($rows['First_name']) ? $rows['First_name'] : ''); ?></td>
						<td class="center py-2"><?php echo (isset($rows['Last_name']) ? $rows['Last_name'] : ''); ?></td>
                        <td class="center py-2"><?php echo (isset($rows['Email_id']) ? $rows['Email_id'] : ''); ?></td>
                        <td class="center py-2"><?php echo (isset($rows['Balance']) ? $rows['Balance'] : ''); ?></td>
                    </tr>
                </table>
            </div>

            <div class="container">
                <br><br><br>
                <label for="to">Transfer To:</label>
                <select id="to" name="to" class="form-control" required>
                    <option value="" disabled selected>Choose</option>
                    <?php
                   
                    $sid = $_REQUEST['Id'];
                    $sql = "SELECT * FROM perform_transactions where Id!=$sid";
                    $result = mysqli_query($conn, $sql);
                    if (!$result) {
                        echo "Error " . $sql . "<br>" . mysqli_error($conn);
                    }
                    while ($rows = mysqli_fetch_assoc($result)) {
                    ?>
                        <option class="table" value="<?php echo $rows['Id']; ?>">

                            <?php echo $rows['First_name']; ?> 
							<?php echo $rows['Last_name']; ?> (Balance:
                            <?php echo $rows['Balance']; ?> )

                        </option>
                    <?php
                    }
                    ?>
            </div>
            </select>
            <br>
            <label for="amount">Amount:</label>
            <input type="number" class="form-control" name="amount" id="amount" required>
            <div class="text-center">
                <button class="btn mt-3 waves-effect waves-light" name="submit" type="submit" id="myBtn">Transfer</button>
            </div>
            <br>
        </form>
    </div>
    </div>
   
</body>

</html>
<?php


if (isset($_POST['submit'])) {

    $from = $_GET['Id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from clients where Id=$from";
    $query = mysqli_query($conn, $sql);
    $sql1 = mysqli_fetch_array($query); // returns array from which the amount is to be transferred.

    // check input of negative value by user
    if (($amount) < 0) {
        echo '<script>';
        echo ' alert("Please enter correct amount.")';  // showing an alert box.
        echo '</script>';
    }

    // check insufficient balance.
    else if ($amount > $sql1['Balance']) {
        echo '<script>';
        echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }

    // constraint to check zero values
    else if ($amount == 0) {

        echo "<script>";
        echo "alert('Oops! Zero value cannot be transferred')";
        echo "</script>";
    } else {
        $sql = "SELECT * from clients where Id=$to";
        $query = mysqli_query($conn, $sql);
        $sql2 = mysqli_fetch_array($query);

        $sender = $sql1['c_name'];
        $receiver = $sql2['c_name'];

        // deducting amount from sender's account
        $newbalance = $sql1['c_balance'] - $amount;
        $sql = "UPDATE clients set c_balance=$newbalance where c_id=$from";
        mysqli_query($conn, $sql);

        // adding amount to reciever's account
        $newbalance = $sql2['c_balance'] + $amount;
        $sql = "UPDATE clients set c_balance=$newbalance where c_id=$to";
        mysqli_query($conn, $sql);


        $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amount')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo "<script> alert('Transaction Successful !!');
                                     window.location='transactionhistory.php';
                           </script>";
        }

        $newbalance = 0;
        $amount = 0;
    }
}
?>