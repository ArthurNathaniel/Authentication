<?php
// Start the session to access session variables
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'admin') {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit;
}

// Get the username from the session
$username = $_SESSION['username'];

// Get current hour
$current_hour = date('G');

// Define greeting based on the time of the day
if ($current_hour >= 5 && $current_hour < 12) {
    $greeting = 'Good morning';
} elseif ($current_hour >= 12 && $current_hour < 18) {
    $greeting = 'Good afternoon';
} else {
    $greeting = 'Good evening';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Add any CSS or additional meta tags here -->
</head>

<body>
    <h1 id="greeting"><?php echo $greeting . ', ' . $username . '!'; ?></h1>
    <p>This is your admin dashboard. You can add your content here.</p>
    <p><a href="logout.php">Logout</a></p> <!-- Link to logout script -->

    <script>
        // Get current hour using JavaScript
        var currentHour = (new Date()).getHours();

        // Define greeting based on the time of the day
        var greeting;
        if (currentHour >= 5 && currentHour < 12) {
            greeting = 'Good morning';
        } else if (currentHour >= 12 && currentHour < 18) {
            greeting = 'Good afternoon';
        } else {
            greeting = 'Good evening';
        }

        // Update the greeting message in the HTML
        document.getElementById('greeting').innerText = greeting + ', <?php echo $username; ?>!';
    </script>
</body>

</html>