<?php

include 'db_connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $pid = $_POST["sdid"];
    $pname = $_POST["sched_date"];
    $pstock = $_POST["sched_status"];

    // Perform database update
    try {

        $conn = connectDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE scheduletable SET sched_date = :sched_date, sched_status = :sched_status WHERE sched_id = :sdid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':sdid', $pid);
        $stmt->bindParam(':sched_date', $pname);
        $stmt->bindParam(':sched_status', $pstock);

        $stmt->execute();

        // Redirect to the page displaying the updated user or any other page
        header("Location: ../schedulelist.php?error=success");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}
?>
