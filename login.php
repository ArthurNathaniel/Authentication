<?php
// Include the database connection file
include 'db.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch admin details from database
    $admin_sql = "SELECT * FROM admin_users WHERE username='$username'";
    $admin_result = mysqli_query($conn, $admin_sql);
    $admin_row = mysqli_fetch_assoc($admin_result);

    // Fetch user details from database
    $user_sql = "SELECT * FROM users WHERE username='$username'";
    $user_result = mysqli_query($conn, $user_sql);
    $user_row = mysqli_fetch_assoc($user_result);

    // Verify password for admin
    if ($admin_row && password_verify($password, $admin_row['password'])) {
        // Admin login successful
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = 'admin';
        header("Location: admin_dashboard.php"); // Redirect to admin dashboard
        exit;
    }
    // Verify password for user
    elseif ($user_row && password_verify($password, $user_row['password'])) {
        // User login successful
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = 'user';
        header("Location: user_dashboard.php"); // Redirect to user dashboard
        exit;
    } else {
        // Invalid username or password
        $login_error = "Invalid username or password.";
    }

    // Close database connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <?php if (isset($login_error)) : ?>
        <p><?php echo $login_error; ?></p>
    <?php endif; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>
        <label>Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>

</html>