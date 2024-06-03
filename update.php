<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the username, user_id, and password fields are not empty
    if (!empty($_POST['username']) && !empty($_POST['user_id']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $user_id = $_POST['user_id'];
        $password = $_POST['password'];

        // Check if the username already exists
        $check_username_sql = "SELECT * FROM users WHERE username = ?";
        $stmt_check = $conn->prepare($check_username_sql);
        $stmt_check->bind_param("s", $username);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            echo "Error: Username already exists!";
            $stmt_check->close();
        } else {
            // Password validation
            if (strlen($password) < 8 ||
                !preg_match('/[A-Z]/', $password) ||
                !preg_match('/[a-z]/', $password) ||
                !preg_match('/[0-9]/', $password) ||
                !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
                echo "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.";
            } else {
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Update query
                $sql_update = "UPDATE users SET username=?, password=? WHERE id=?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("ssi", $username, $hashed_password, $user_id);

                // Execute the statement
                if ($stmt_update->execute()) {
                    header("location:homepage.php");
                } else {
                    echo "Error updating username and password: " . $conn->error;
                }
                $stmt_update->close();
            }
        }
    } else {
        echo "Please fill all fields.";
    }
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Update Username and Password</title>

</head>
<body>
<h2>Update Username and Password</h2>
<form action="update.php" method="POST">
    <p>User Name</p>
    <input type="text" id="username" name="username" required><br><br>
    <p>ID</p>
    <input type="number" id="user_id" name="user_id" required><br><br>
    <p>Password</p>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Update">
</form>
</body>
</html>
