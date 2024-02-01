<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u_name = $_POST['customer'];
    $p_id = $_POST['selectProduct'];
    $o_date = $_POST['date'];
    $quantity = $_POST['quantity'];

    try {
        $conn = connectDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch available stock
        $stockQuery = $conn->prepare("SELECT product_stock FROM producttable WHERE product_id = :product_id");
        $stockQuery->bindParam(':product_id', $p_id);
        $stockQuery->execute();
        $availableStock = $stockQuery->fetchColumn();

        // Check if the ordered quantity is greater than available stock
        if ($quantity > $availableStock) {
            echo "<script>alert('Insufficient stock!')</script>";
        } else {
            $userQuery = $conn->prepare("SELECT id FROM users WHERE name = :user_name");
            $userQuery->bindParam(':user_name', $u_name);
            $userQuery->execute();
            $u_id = $userQuery->fetchColumn();

            // Insert into orders table with quantity
            $sql = "INSERT INTO ordertable (user_id, product_id, order_date, order_quantity) 
                    VALUES (:user_id, :product_id, :order_date, :order_quantity)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':user_id', $u_id);
            $stmt->bindParam(':product_id', $p_id);
            $stmt->bindParam(':order_date', $o_date);
            $stmt->bindParam(':order_quantity', $quantity);
            $stmt->execute();

            // Update product stock based on quantity
            $sqlUpdateStock = "UPDATE producttable SET product_stock = product_stock - :order_quantity 
                               WHERE product_id = :product_id";
            $stmtUpdateStock = $conn->prepare($sqlUpdateStock);
            $stmtUpdateStock->bindParam(':order_quantity', $quantity);
            $stmtUpdateStock->bindParam(':product_id', $p_id);
            $stmtUpdateStock->execute();

            // Redirect back to the orders page after successful insertion
            header("Location: ../index.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        if ($conn) {
            $conn = null;
        }
    }
}
?>
