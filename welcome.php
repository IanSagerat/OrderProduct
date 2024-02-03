<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Website</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        #container h2{
            text-transform:uppercase;
        }

        #container{
          background:linear-gradient(0deg, rgba(94,255,107,1) 0%, rgba(35,255,0,1) 100%);
          height:68px;
          padding-top:10px;
          border-bottom:2px solid gray;
        }

        nav {
            background: linear-gradient(0deg, rgba(73,66,254,1) 0%, rgba(49,50,255,1) 100%);
            color: #fff;
            padding: 10px;
            text-align: left;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
            transition: 0.5s ease-in-out;
        }

        .nav a:hover{
            background-color: #fff;
            color: black;
        }



        label {
            display: block;
            margin-bottom: 8px;
        }

        .header{
            align-items: center;
            text-align:center;
            background: linear-gradient(0deg, rgba(51,51,51,1) 0%, rgba(21,243,249,1) 100%);
            height:100px;
            color: #fff;
            padding-top:10px;
        }
    </style>
</head>
<body>

<div class="header">
  <?php 
  $headerTitle = "Patient";

  $currentHeader = basename($_SERVER['PHP_SELF']);
  if($currentHeader == "schedulelist.php")
  {
    $headerTitle = "Schedule Appointment";
  }
  else if($currentHeader == "transaction.php")
  {
    $headerTitle = "List Appointments";
  }

  else if($currentHeader == "add_schedule.php")
  {
    $headerTitle = "Add Schedule";
  }

  else if($currentHeader == "edit.php")
  {
    $headerTitle = "Edit Patient Data";
  }

  else if($currentHeader == "schedule.php")
  {
    $headerTitle = "Make a Schedule";
  }
  echo"<h1> $headerTitle </h1>";
  ?>
</div>

<nav>
  <a href="index.php">Patient</a>
  <a href="schedulelist.php">Schedule Appointment</a>
  <a href="transaction.php">List Appointments</a>
</nav>
</body>
</html>