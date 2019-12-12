<?php
session_start();
if ($_SESSION['valid'] != true)
    header("Location: login.php");

if ($_SESSION['admin'] == false)
    header("Location: meniu.php");
else {
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
                <li class="nav-item"><a class="nav-link" href="a_users.php">Users</a></li>
                <li class="nav-item"><a class="nav-link" href="a_orders.php">Orders</a></li>
                <li class="nav-item"><a class="nav-link" href="auth.php">Logout</a></li>
            </ul>
			</nav>
            <br><br>

            <table border='1' align="center" style="text-align:center;">
                <tr>
                    <th>Id</th>
                    <th>Owner id</th>
                    <th>Load City</th>
                    <th>Discharge City</th>
                    <th>Volume (m3)</th>
                    <th>Weight (kg)</th>
                    <th>Quantity</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Driver Id</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>

                <?php
                    require ('db.php');
                $query = "SELECT id, owner_id, load_city, discharge_city, volume, weight, quantity, type, status, price, driver_id FROM orders";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_assoc($result)) {

                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['owner_id'] . "</td>";
                    echo "<td>" . $row['load_city'] . "</td>";
                    echo "<td>" . $row['discharge_city'] . "</td>";
                    echo "<td>" . $row['volume'] . "</td>";
                    echo "<td>" . $row['weight'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['type'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td>" . $row['driver_id'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    if($row['status']== 'Quote')
                        echo "<td><a href='a_edit_order.php?id=".$row['id']."'>Edit</a></td>";
					else
						echo "<td></td>";
					
                    if($row['status']== 'Approved By Client')
                        echo "<td><a href='a_assign_driver.php?id=".$row['id']."'>Assign Driver</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </body>
    </html>
<?php } ?>
