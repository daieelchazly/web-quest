<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Food</title>
</head>
<body>
    <form action="order-submit.php" method="POST">
        <label for="food">Food item:</label>
        <select name="food" id="food">
            <?php
            
            $conn = new mysqli('localhost', 'root', '', 'inventory');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

       
            $sql = "SELECT name FROM items";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['name']}'>{$row['name']}</option>";
                }
            }
            $conn->close();
            ?>
        </select>
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" min="1" required>
        <button type="submit">Order</button>
    </form>
</body>
</html>
