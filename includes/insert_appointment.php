<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u_name = $_POST['patientname'];
    $p_id = $_POST['selectschedule'];

    try {
        $conn = connectDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch schedule status and date
        $scheduleQuery = $conn->prepare("SELECT patient_id FROM patienttable WHERE patient_name = :user_name");
        $scheduleQuery->bindParam(':user_name', $u_name);
        $scheduleQuery->execute();
        $schedulestatus = $scheduleQuery->fetchColumn();

        $sql = "INSERT INTO appointmenttable (sched_id, patient_id) VALUES (:sched_id, :patient_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':patient_id', $schedulestatus);            
        $stmt->bindParam(':sched_id', $p_id);
        $stmt->execute();

        // Update schedule status to 'Booked'
        $sqlUpdateStatus = "UPDATE scheduletable SET sched_status = 'Not Available' WHERE sched_id = :sched_id";
        $stmtUpdateStatus = $conn->prepare($sqlUpdateStatus);
        $stmtUpdateStatus->bindParam(':sched_id', $p_id);
        $stmtUpdateStatus->execute();

        // Redirect back to the index page after successful insertion
        header("Location: ../transaction.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        if ($conn) {
            $conn = null;
        }
    }
}
?>