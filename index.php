<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieve Data</title>
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
        
        #container h2{
            text-transform:uppercase;
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

        .action {
            display: flex;
            flex-direction: row;
            gap: 5px;
        }
    </style>
</head>
<body>

<?php
include_once 'welcome.php';
?>

<div id="container">
    <h2 style="text-align: center;">Patient Data</h2>
<?php
include 'includes/db_connection.php';

try {
    $conn = connectDB();

    if ($conn) {
        $sql = "SELECT patient_id, patient_name, patient_email FROM patienttable";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<table>
                <tr>
                    <th>Patient ID</th>
                    <th>Patient Name</th>
                    <th>Patient Email</th>
                    <th>Action</th>
                </tr>";
        foreach ($result as $row) {
            echo "<tr>
                    <td>{$row['patient_id']}</td>
                    <td>{$row['patient_name']}</td>
                    <td>{$row['patient_email']}</td>
                    <td class='action'>
                        <form action='edit.php' method='post'>
                            <input type='hidden' name='edit_id' value='{$row['patient_id']}'>
                            <button type='submit' class='edit-button'>Edit</button>
                        </form>
                        <form action='schedule.php' method='post'>
                            <input type='hidden' name='app_id' value='{$row['patient_id']}'>
                            <button type='submit' class='edit-button'>Make a Schedule</button>
                        </form>
                    </td>
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


<div class="button-container">
    <a href="insert.php" class="add-button">Add Patient</a>
</div>

</div>

</body>
</html>
