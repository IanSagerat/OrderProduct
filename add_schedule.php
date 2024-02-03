<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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
            margin-bottom: 5px;
        }
        #status{
            width:50%;
            height:30px;
        }
        input {
            width: 50%;
            padding: 8px;
            margin-bottom: 10px;
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

        a {
            color: #4caf50;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        a:hover {
            text-decoration: none;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<?php
include_once 'welcome.php';
?>

<div id="container">
    <h2 style="text-align: center;">Add Schedule</h2>

    <form action="includes/insert_schedule.php" method="post">
        <label for="sched_date">Date:</label>
        <input type="Date" name="sched_date" id="sched_date" required>

        <label for="status">Status:</label>
        <select name="status" id="status" required>
            <option value="Available">Available</option>
            <option value="NotAvailable">Not Available</option>
        </select>

        <div class="button-container">
            <button type="submit">Add Schedule</button>
        </div>
    </form>

    <div class="button-container">
        <a href="schedulelist.php">Back to Schedule List</a>
    </div>
</div>

</body>
</html>
