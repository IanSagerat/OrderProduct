<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if 'sched_date' and 'status' keys exist in the $_POST array
    if (isset($_POST['sched_date']) && isset($_POST['status'])) {
        $sdate = $_POST['sched_date'];
        $sstatus = $_POST['status'];

        // Check if 'sched_date' is not null
        if ($sdate !== null) {
            try {
                // Use the function to get a PDO connection
                $conn = connectDB();

                // Set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "INSERT INTO scheduletable (sched_date, sched_status) VALUES (:sdate, :sstatus)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':sdate', $sdate);
                $stmt->bindParam(':sstatus', $sstatus);
                $stmt->execute();

                // Redirect back to the user data page after successful insertion
                header("Location: ../schedulelist.php");
                exit();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            } finally {
                // Always close the connection
                if ($conn) {
                    $conn = null;
                }
            }
        } else {
            // Handle the case where 'sched_date' is null
            echo "Error: 'sched_date' cannot be null.";
        }
    } else {
        // Handle the case where 'sched_date' or 'status' is not set in $_POST
        echo "Error: 'sched_date' or 'status' not set in POST request.";
    }
}
?>