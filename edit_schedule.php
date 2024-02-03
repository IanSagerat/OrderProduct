<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        form {
            padding-top:20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-bottom: 8px;
        }

        input, select {
            padding: 10px;
            margin-bottom: 16px;
            width: 50%;
            box-sizing: border-box;
        }

        .button-container {
            text-align: center;
        }

        .update-button {
            background-color: #2196f3;
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
    <h2 style="text-align: center;">EDIT SCHEDULE</h2>

    <?php
    include 'includes/db_connection.php';

    try {
        $conn = connectDB();

        if ($conn && isset($_POST['edit_schedule_id'])) {
            $prodID = $_POST['edit_schedule_id'];
            $sql = "SELECT sched_id, sched_date, sched_status FROM scheduletable WHERE sched_id = :sdid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':sdid', $prodID);
            $stmt->execute();

            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userData) {
                // User data found, render the edit form
    ?>
                <form action="includes/update_sched.php" method="post">
                    <input type="hidden" name="sdid" value="<?php echo $userData['sched_id']; ?>">
                    <label for="name">Date:</label>
                    <input type="date" name="sched_date" id="sched_date" value="<?php echo $userData['sched_date']; ?>">

                    <label for="status">Status:</label>
                    <select name="sched_status" id="sched_status">
                        <option value="Available" <?php echo ($userData['sched_status'] == 'Available') ? 'selected' : ''; ?>>Available</option>
                        <option value="NotAvailable" <?php echo ($userData['sched_status'] == 'NotAvailable') ? 'selected' : ''; ?>>Not Available</option>
                    </select>

                    <div class="button-container">
                        <button type="submit" class="update-button">Update Schedule</button>
                    </div>
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