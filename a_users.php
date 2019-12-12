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
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <meta charset="UTF-8">
            <title>Users</title>
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

            <table border='1' align="center">
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Company Name</th>
                    <th>Admin</th>
                    <th>Driver</th>
                    <th>Active</th>
                    <th>Action</th>
                </tr>

                <?php
                    require ('db.php');
                $query = "SELECT id, username, email, admin, company_name, active, driver  FROM `users`";
                $result = mysqli_query($con, $query);
                while ($row = mysqli_fetch_assoc($result)) {

                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['company_name'] . "</td>";
                    if($row['admin']==true)
                        echo "<td><input type='checkbox' disabled checked></td>";
                    else
                        echo "<td><input type='checkbox' disabled></td>";
                    
                    if($row['driver']==true)
                        echo "<td><input type='checkbox' disabled checked></td>";
                    else
                        echo "<td><input type='checkbox' disabled></td>";
                    if($row['active']==true)
                        echo "<td><input type='checkbox' disabled checked></td>";
                    else
                        echo "<td><input type='checkbox' disabled></td>";
                    echo "<td><a href='a_edit_user.php?id=".$row['id']."'>Edit</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </body>
    </html>
<?php } ?>
