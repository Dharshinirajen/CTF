<?php 
// Include your database connection and functions file
include_once 'Register_database.php';

// Validate required fields
if (empty($_POST['team_name']) || empty($_POST['team_id']) || empty($_POST['member1']) || empty($_POST['Department']) || empty($_POST['Year']) || empty($_POST['phone'])) {
    // Redirect back to the registration page if any required field is empty
    header("Location: register.html");
    exit();
}

// Make a connection to the database
Databases::make_conn();

// Insert data into the database
$inserted = Databases::insert_data(
    $_POST['team_name'],
    $_POST['team_id'],
    $_POST['member1'],
    $_POST['member2'] ?? null,  // Optional field
    $_POST['member3'] ?? null,  // Optional field
    $_POST['Department'],
    $_POST['Year'],
    $_POST['phone']
);

// Check if the insertion was successful
if ($inserted) {
    // Set a cookie with the team_id
    $cookie_name = "team_id";
    $cookie_value = $_POST['team_id'];
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

    // Redirect to login page after successful registration
    header("Location: login.html");
    exit();
} else {
    // Handle database insertion error
    echo "Error: Unable to register. Please try again later.";
}
?>
