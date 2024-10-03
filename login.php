<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="login.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $servername = "localhost";
        $username = "root"; // Change if you have another username
        $password = ""; // Enter the password for the root user
        $dbname = ""; // Your database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get user data
        $name = $_POST['username'];
        $pass = $_POST['password'];

        // Fetch user from the database
        $sql = "SELECT * FROM users WHERE name='$name'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($pass, $row['password'])) {
                echo "Login successful!";
            } else {
                echo "Invalid password!";
            }
        } else {
            echo "No user found with that username!";
        }

        // Close the connection
        $conn->close();
    }
    ?>
</body>
</html>
