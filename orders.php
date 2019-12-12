<?php
session_start();
if ($_SESSION['valid'] != true)
    header("Location: login.php");

if ($_SESSION['admin'] == true)
    header("Location: a_meniu.php");
else {
    ?>
    <html>
        <head>
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

            <meta charset="UTF-8">
            <title>Edit Order</title>
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
            <br><br>
			<div style="text-align: center;">
            <table border='1' align="center">
                <tr>
                    <th>Id</th>
                    <th>Load City</th>
                    <th>Discharge City</th>
                    <th>Volume (m3)</th>
                    <th>Weight (kg)</th>
                    <th>Quantity</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>

                <?php
                    require ('db.php');
                $query = "SELECT id, owner_id, load_city, discharge_city, volume, weight, quantity, type, status, price, driver_id FROM orders WHERE owner_id =".$_SESSION['id'];
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_assoc($result)) {

                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['load_city'] . "</td>";
                    echo "<td>" . $row['discharge_city'] . "</td>";
                    echo "<td>" . $row['volume'] . "</td>";
                    echo "<td>" . $row['weight'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['type'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    if($row['status'] == 'Price Declined')
						echo "<td><a href='confirm_order.php?id=".$row['id']."'>Confirm</a></td>";
					else
						echo "<td></td>";
                    echo "</tr>";
                }
                ?>
            </table>
			</div>
        </body>
    </html>
<?php } ?>
