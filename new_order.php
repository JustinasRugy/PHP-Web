<?php
session_start();
if ($_SESSION['valid'] != true)
    header("Location: login.php");

if ($_SESSION['admin'] == true)
    header("Location: a_meniu.php");
if (isset($_POST['submit'])) {
        include ('db.php');
        $load = stripslashes($_POST['load']);
        $load = mysqli_real_escape_string($con, $load);
        $discharge = stripslashes($_POST['discharge']);
        $discharge = mysqli_real_escape_string($con, $discharge);
        $volume = stripslashes($_POST['volume']);
        $volume = mysqli_real_escape_string($con, $volume);
        $weight = stripslashes($_POST['weight']);
        $weight = mysqli_real_escape_string($con, $weight);
        $quantity = stripslashes($_POST['quantity']);
        $quantity = mysqli_real_escape_string($con, $quantity);
        $type = stripslashes($_POST['type']);
        $type = mysqli_real_escape_string($con, $type);
        
        $sql = "INSERT INTO `orders`(`owner_id`, `load_city`, `discharge_city`, `volume`, `weight`, `quantity`, `type`, `status` ) VALUES (".$_SESSION['id'].",'$load','$discharge',$volume,$weight,$quantity,'$type','Quote')";
        $result = mysqli_query($con, $sql);
        //var_dump($sql);
        header("Location: orders.php");
}
else {
    ?>
    <html>
        <head>
						<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

            <meta charset="UTF-8">
            <title>Menu</title>
            <style>
                ul {
                    list-style-type: none;
                    margin: 0;
                    padding: 0;
                }
                li {
                    display: inline;
                }
            </style>
        </head>
        <body>
            		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="meniu.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="new_order.php">New Order</a></li>
                <li class="nav-item"><a class="nav-link" href="orders.php">Orders</a></li>
                <li class="nav-item"><a class="nav-link" href="auth.php">Logout</a></li>
            </ul>
			</nav>
            <div style="text-align: center;">
            <h2>New Order</h2>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                
                City of Load:<br>
                <input type="text" name="load" ><br>
                City of Discharge:<br>
                <input type="text" name="discharge" ><br>
                Volume (m3):<br>
                <input type="number" name="volume" ><br>
                Weight (kg):<br>
                <input type="number" name="weight"><br>
                Quantity:<br>
                <input type="number" name="quantity"><br>
                Type:<br>
                <input type="text" name="type"><br><br>
                <br>
                <input type="submit" name="submit" value="Create">
                <input type="button" value="Back" onclick="history.back()">
            </form> 
            </div>
        </body>
    </html>
<?php } ?>