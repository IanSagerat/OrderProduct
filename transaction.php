<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieve Products</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .add-button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .edit-button {
            background-color: #2196f3;
            color: white;
            border: none;
            padding: 6px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
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
    <h2 style="text-align: center;">APPOINTMENT LIST</h2>

    <?php
include 'includes/db_connection.php';

try {
    $conn = connectDB();

    if ($conn) {
        $sql = "SELECT appointmenttable.app_id, patienttable.patient_name, scheduletable.sched_date, scheduletable.sched_status
                FROM appointmenttable
                INNER JOIN patienttable ON appointmenttable.patient_id = patienttable.patient_id
                INNER JOIN scheduletable ON appointmenttable.sched_id = scheduletable.sched_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<table>
                <tr>
                    <th>Appointment ID</th>
                    <th>Patient Name</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>";
        foreach ($result as $row) {
            echo "<tr>
                    <td>{$row['app_id']}</td>
                    <td>{$row['patient_name']}</td>
                    <td>{$row['sched_date']}</td>
                    <td>{$row['sched_status']}</td>
                </tr>";
        }
        echo "</table>";
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