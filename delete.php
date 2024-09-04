<?php
// Establish a database connection

include("connection.php");
// Check if the ID is provided in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Sanitize the ID to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Delete row with the specified ID
    $sql = "DELETE FROM tickets WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
               window.location.href = 'history.php';
               alert('Data has been successfully deleted..');
        </script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid or missing ID.";
}

// Close the database connection
$conn->close();
?>
