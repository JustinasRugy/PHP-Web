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

        if (isset($_POST['admin'])) {
            $admin = stripslashes($_POST['admin']);
            $admin = mysqli_real_escape_string($con, $admin);
        } else
            $admin = 0;

        if (isset($_POST['active'])) {
            $active = stripslashes($_POST['active']);
            $active = mysqli_real_escape_string($con, $active);
            $sql = "SELECT active, username, email FROM users WHERE id = $id";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            if ($row['active'] == false) {
                sendEmail($row['email'], 'Your Customer Account Activated', 'Dear ' . $row['username'] . ',<br><br> Your Account Activated. Now you can login.<br><br>Thank you for using our service,<br>Digital Enterprice.');
            }
        } else
            $active = 0;

        if (isset($_POST['driver'])) {
            $driver = stripcslashes($_POST['driver']);
            $driver = mysqli_real_escape_string($con, $driver);
            $sql = "SELECT driver, username, email FROM users WHERE id = $id";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            if ($row['driver'] == false) {
                sendEmail($row['email'], 'Your Driver Account Activated', 'Dear ' . $row['username'] . ',<br><br> Your Account Activated. Now you can login.<br><br>Thank you for using our service,<br>Digital Enterprice.');
            }
        } else
            $driver = 0;

        $sql = "UPDATE users SET active = $active ,admin = $admin ,driver = $driver WHERE id = $id";
        $result = mysqli_query($con, $sql);
        header("Location: a_users.php");
    }
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT id, username, email, admin, company_name, active, driver  FROM `users` WHERE id = $id LIMIT 1";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($result);
    }
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>Edit User</title>
        </head>
        <body>
            <h2>Edit User</h2>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                Id:<br>
                <input type="text" value="<?php echo $row['id']; ?>" disabled><br>
                UserName:<br>
                <input type="text" value="<?php echo $row['username']; ?>" disabled><br>
                Email:<br>
                <input type="text" value="<?php echo $row['email']; ?>" disabled><br>
                Company name:<br>
                <input type="text" value="<?php echo $row['company_name']; ?>" disabled><br>
                Active:<br>
                <input type="checkbox" name="active" value="true" <?php if ($row['active'] == 1) {
        echo 'checked';
    } ?> ><br><br>
                Admin:<br>
                <input type="checkbox" name="admin" value="true" <?php if ($row['admin'] == 1) {
        echo 'checked';
    } ?> ><br>
                Driver:<br>
                <input type="checkbox" name="driver" value="true" <?php if ($row['driver'] == 1) {
        echo 'checked';
    } ?> ><br>

                <br>
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                <input type="submit" name="update" value="Update">
                <input type="button" value="Back" onclick="history.back()">
            </form> 
    <?php ?>
        </body>
    </html>
<?php } ?>