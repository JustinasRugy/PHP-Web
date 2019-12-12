<?php
session_start();
if ($_SESSION['valid'] != true)
    header("Location: login.php");

if ($_SESSION['admin'] == false)
    header("Location: meniu.php");
else {
    include ('db.php');
    if (isset($_POST['update'])) {
        $id = stripslashes($_POST['id']);

        $driver = stripslashes($_POST['driver']);
        $driver = mysqli_real_escape_string($con, $driver);
        $sql = "UPDATE orders SET driver_id  = $driver ,status = 'Driver Assinged' WHERE id = $id";
        $result = mysqli_query($con, $sql);
        header("Location: a_orders.php");
    }
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT id, owner_id, load_city, discharge_city, volume, weight, quantity, type, status, price FROM orders WHERE id = $id LIMIT 1";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
    }
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Edit Order</title>
        </head>
        <body>
            <h2>Edit Order</h2>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                Id:<br>
                <input type="text" value="<?php echo $row['id']; ?>" disabled><br>
                Owner id:<br>
                <input type="text" value="<?php echo $row['owner_id']; ?>" disabled><br>
                City of Load:<br>
                <input type="text" value="<?php echo $row['load_city']; ?>" disabled><br>
                City of Discharge:<br>
                <input type="text" value="<?php echo $row['discharge_city']; ?>" disabled><br>
                Volume (m3):<br>
                <input type="numer" value="<?php echo $row['volume']; ?>" disabled><br>
                Weight (kg):<br>
                <input type="number" value="<?php echo $row['weight']; ?>" disabled><br>
                Quantity:<br>
                <input type="number" value="<?php echo $row['quantity']; ?>" disabled><br>
                Type:<br>
                <input type="text" value="<?php echo $row['type']; ?>" disabled><br><br>
                Price €:<br>
                <input type="number" name="price" value="<?php echo $row['price']; ?>" disabled ><br>
                Status:<br>
                <input type="text" value="<?php echo $row['status']; ?>" disabled><br>
                Driver:<br>
                <select name="driver">
                    <?php
                    $sql = "SELECT id, username FROM users WHERE driver = true";
                    $result = mysqli_query($con, $sql);
                     while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['username']; ?></option>
                     <?php } ?>
                </select>


                <br>
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <input type="submit" name="update" value="Update">
                <input type="button" value="Back" onclick="history.back()">
            </form> 
        </body>
    </html>
<?php } ?>