<?php

try {
    $conn = mysqli_connect("localhost", "root", "", "project1_db");

    // Check connection
    if (!$conn) {
        throw new Exception("Connection failed: " . mysqli_connect_error());
    }

    // If connection is successful, you can proceed with your code here
    // echo "Connected successfully";
    

} catch (Exception $e) {
    // Handle connection error
    echo "Connection failed: " . $e->getMessage();
}

// Close the connection (optional, depending on your needs)
// mysqli_close($conn);
?>
