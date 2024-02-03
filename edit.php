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

        input {
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
    <h2 style="text-align: center;">Edit User</h2>

    <?php
        include 'includes/db_connection.php';

        try {
            $conn = connectDB();

            if ($conn && isset($_POST['edit_id'])) {
                $userId = $_POST['edit_id'];
                $sql = "SELECT patient_id, patient_name, patient_email FROM patienttable WHERE patient_id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $userId);
                $stmt->execute();

                $userData = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($userData) 
                {
                    // User data found, render the edit form
    ?>
                <form action="includes/update.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $userData['patient_id']; ?>">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" value="<?php echo $userData['patient_name']; ?>">

                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" value="<?php echo $userData['patient_email']; ?>">

                    <div class="button-container">
                        <button type="submit" class="update-button">Update Patient</button>
                    </div>
                </form>
    <?php
            } 
            else 
            {
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
