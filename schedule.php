<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Appointment</title>
    <style>
        form {
            padding-top:20px;
            margin-top: 20px;
            display:flex;
            flex-direction:column;
            align-items:center;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: 50%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<?php
include_once 'welcome.php';
?>

<div id="container">
    <h2 style="text-align: center;">Create Appointment</h2>

    <?php
    include 'includes/db_connection.php';

    try {
        $conn = connectDB();

        if ($conn && isset($_POST['app_id'])) {
            $userId = $_POST['app_id'];
            $sql = "SELECT patient_id, patient_name, patient_email FROM patienttable WHERE patient_id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $userId);
            $stmt->execute();

            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($userData) {
                ?>
                <form method="post" action="includes/insert_appointment.php">
                    <label for="patient">Patient's Name:</label>
                    <input type="text" id="patient" name="patientname" value="<?php echo htmlspecialchars($userData['patient_name']); ?>" required readonly>

                    <label for="selectDate">Select Available Date:</label>
                    <select name="selectschedule" id="selectDate" required>
                        <option value="">Select Date</option>
                        <?php
                        try {
                            $stmt = $conn->query("SELECT * FROM scheduletable WHERE sched_status = 'Available'");
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($result as $row) {
                                $sched_name = htmlspecialchars($row['sched_date']);
                                echo "<option value='{$row['sched_id']}'>$sched_name</option>";
                            }
                        } catch (PDOException $e) {
                            die("Query failed: " . $e->getMessage());
                        }
                        ?>
                    </select>
                    <br>
                    <br>
                    <button type="submit">Insert</button>
                </form>
                <?php
            } else {
                echo "<p>User not found.</p>";
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        if ($conn) {
            $conn = null;
        }
    }
    ?>
</div>

</body>
</html>