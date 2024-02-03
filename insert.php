<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <style>
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top:20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            padding: 10px;
            margin-bottom: 16px;
            width: 50%;
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
    </style>
</head>
<body>

<?php
include_once 'welcome.php';
?>

<div id="container">
    <h2 style="text-align: center;">Add User</h2>

    <form action="includes/insertion.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
    
        <button type="submit">Insert</button>
    </form>
</div>

</body>
</html>
