<?php
include 'db.php';
// Database configuration
$servername = "localhost";
$username = "sugus"; // Change as per your DB username
$password = "Dk@123"; // Change as per your DB password
$dbname = "OP";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_GET['id']; // Assuming user ID is passed via GET
$sql = "SELECT * FROM profile WHERE id=profile_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "No user found.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        .profile-container {
            width: 50%;
            margin: auto;
            text-align: center;
        }
        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
        }
        .profile-details {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <img src="<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile Image" class="profile-image">
        <div class="profile-details">
            <h2><?php echo htmlspecialchars($user['username']); ?></h2>
            <p><?php echo htmlspecialchars($user['email']); ?></p>

        </div>
    </div>
</body>
</html>
