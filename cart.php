<?php
    $pageTitle = "Cart";
    include_once "layout/header.php";
?>

<main>
    <div class="container">
        <?php
            // Include file to connect to the database
            require_once "utils/DatabaseUtil.php";
            $dbUtils = new DatabaseUtil();
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['Add'])) {
                    // Handle adding item to cart
                    $productId = $_POST['productId']; // Assuming productId is posted from the form
                    $quantity = $_POST['quantity']; // Assuming quantity is posted from the form
                    $price = $_POST['price']; // Assuming price is posted from the form
                    
                    // SQL query to insert item into the cart table
                    $sql = "INSERT INTO tbl_cart (productId, quantity, price) VALUES ('$productId', '$quantity', '$price')";
                    
                    // Execute SQL Query and store result in a variable
                    $result = $dbUtils->insertData($dbUtils->getConnection(), $sql);
                    
                    if ($result) {
                        echo "Item has been added to cart.";
                    } else {
                        echo "Failed to add item to cart.";
                    }
                } elseif (isset($_POST['Delete'])) {
                    // Handle deleting item from cart
                    $id = $_POST['id']; // Assuming id is posted from the form
                    
                    // SQL query to delete item from the cart table
                    $sql = "DELETE FROM tbl_cart WHERE id = '$id'";
                    
                    // Execute SQL Query and store result in a variable
                    $result = $dbUtils->deleteData($dbUtils->getConnection(), $sql);
                    
                    if ($result) {
                        echo "Item has been deleted from cart.";
                    } else {
                        echo "Failed to delete item from cart.";
                    }
                } elseif (isset($_POST['Update'])) {
                    // Handle updating item in cart
                    $id = $_POST['id']; // Assuming id is posted from the form
                    $quantity = $_POST['quantity']; // Assuming quantity is posted from the form
                    
                    // SQL query to update quantity of item in the cart table
                    $sql = "UPDATE tbl_cart SET quantity = '$quantity' WHERE id = '$id'";
                    
                    // Execute SQL Query and store result in a variable
                    $result = $dbUtils->updateData($dbUtils->getConnection(), $sql);
                    
                    if ($result) {
                        echo "Item quantity has been updated in cart.";
                    } else {
                        echo "Failed to update item quantity in cart.";
                    }
                }
            } else {
                // Display items in the cart
                $sql = "SELECT * FROM tbl_cart WHERE status = 0";
                $result = $dbUtils->getQueryResult($dbUtils->getConnection(), $sql);

                // If result contains data, display data
                if ($result->num_rows > 0) {
        ?>
                    <table width="100%" border="1">
                        <thead>
                            <tr>
                                <th class="p-2">ID</th>
                                <th class="p-2">ProductId</th>
                                <th class="p-2">Price</th>
                                <th class="p-2">Quantity</th>
                                <th class="p-2">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php foreach ($result as $row) { ?>
                                <tr>
                                    <td class="p-2" align="center"><?php echo $row['id']; ?></td>
                                    <td class="p-2" align="center"><a href="product.php?productId=<?php echo $row['productId']; ?>"><?php echo $row['productId']; ?></a></td>
                                    <td class="p-2" align="center"><?php echo $row['price']; ?></td>
                                    <td class="p-2" align="center">
                                        <form method="POST">
                                            <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <input type="submit" name="Update" value="Update">
                                        </form>
                                    </td>
                                    <td class="p-2" align="center">
                                        <form method="POST">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <input type="submit" name="Delete" value="Delete">
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td class="p-2" align="center" colspan="5">
                                    <form action="order.php" method="POST">
                                        <input type="submit" name="Checkout" value="Check out">
                                    </form>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
        <?php
                } else {
        ?>
                <p class="text-center">Sorry, there are no items in your shopping cart.</p>
        <?php   
                }
            }
        ?>
    
    </div>
</main>

<?php include_once "layout/footer.php"; ?>