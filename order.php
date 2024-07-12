<?php
    $pageTitle = "Order";
    include_once "layout/header.php";
?>

<main>
    <div class="container">

        <?php
            // Include file to connect to the database
            require_once "utils/DatabaseUtil.php";
            $dbUtil = new DatabaseUtil();

            // Get a connection to the database
            $conn = $dbUtil->getConnection();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['Checkout'])) {
                    $total_price = 0;
                    $sql = "SELECT quantity * price as total_price FROM tbl_cart WHERE status = 0";
                    $result = $dbUtil->getQueryResult($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $total_price += $row['total_price'];
                    }
                    
                    $sql = "INSERT INTO tbl_order (total_price, transaction_status) VALUES ($total_price, 'Confirmed')";
                    $dbUtil->insertData($conn, $sql);

                    $sql = "SELECT MAX(id) as id FROM tbl_order";
                    $result = $dbUtil->getQueryResult($conn, $sql);
                    $id = 0;

                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                    }

                    $sql = "UPDATE tbl_cart SET status = 1, orderId = $id WHERE status = 0";
                    $dbUtil->updateData($conn, $sql);

                    echo "$" . $total_price . " Orders have been confirmed.";
                } elseif (isset($_POST['Delete'])) {
                    $id = $_POST['id'];
                    $sql = "DELETE FROM tbl_cart WHERE id = $id";
                    $dbUtil->updateData($conn, $sql);
                    echo "Item has been deleted from the cart.";
                } elseif (isset($_POST['Update'])) {
                    $qty = $_POST['quantity'];
                    $id = $_POST['id'];
                    $sql = "UPDATE tbl_cart SET quantity = $qty WHERE id = $id";
                    $dbUtil->updateData($conn, $sql);
                    echo "Item has been updated in the cart.";
                }
            } else {
                $sql = "SELECT o.id as id, c.productId, c.quantity, c.price, o.total_price
                        FROM tbl_cart c
                        JOIN tbl_order o ON c.orderId = o.id";
                
                $result = $dbUtil->getQueryResult($conn, $sql);
                $id = -1;
                $total_price = -1;

                if ($result->num_rows > 0) {
        ?>
                    <table width="100%" border="1">
                        <thead>
                            <tr>
                                <th class="p-2">Order ID</th>
                                <th class="p-2">Product ID</th>
                                <th class="p-2">Quantity</th>
                                <th class="p-2">Price</th>
                            </tr>
                        </thead>
                        <tbody>
        <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($id != $row['id'] && $id != -1) {
        ?>
                            <tr>
                                <td class="p-2" colspan="3" align="center">Total Price for Order ID: <?php echo $id; ?></td>
                                <td class="p-2" align="center"><?php echo $total_price; ?></td>
                            </tr>
        <?php
                        }
                        
                        $id = $row['id'];
                        $total_price = $row['total_price'];
        ?>
                        <tr>
                            <td class="p-2" align="center"><?php echo $id; ?></td>
                            <td class="p-2" align="center"><a href="product.php?productId=<?php echo $row['productId']; ?>"><?php echo $row['productId']; ?></a></td>
                            <td class="p-2" align="center"><?php echo $row['quantity']; ?></td>
                            <td class="p-2" align="center"><?php echo $row['price']; ?></td>
                        </tr>
        <?php
                    }
        ?>
                    <tr>
                        <td class="p-2" colspan="3" align="center">Total Price for Order ID: <?php echo $id; ?></td>
                        <td class="p-2" colspan="3" align="center"><?php echo $total_price; ?></td>
                    </tr>
                </tbody>
            </table>
        <?php
                } else {
                    echo '<p class="text-center">No results found.</p>';
                }
            }
        ?>

    </div>
</main>

<?php include_once "layout/footer.php"; ?>