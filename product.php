<?php
    $pageTitle = "Product";
    include_once "layout/header.php";
?>

<main>
    <div class="container">

        <?php
            // Include file to connect to the database
            require_once "utils/DatabaseUtil.php";

            // Check if productId is set in GET parameters
            if (isset($_GET['productId'])) {
                // Get productId from GET parameters
                $productId = $_GET['productId'];

                // Instantiate DatabaseUtils class
                $dbUtils = new DatabaseUtil();

                // SQL query to fetch product details by productId
                $sql = "SELECT * FROM tbl_products WHERE id = $productId";

                // Execute SQL Query and store result in a variable
                $result = $dbUtils->getQueryResult($dbUtils->getConnection(), $sql);

                // If result contains data, display product details
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
        ?>
                        <table width="100%" border="1">
                            <thead>
                                <tr>
                                    <th class="p-2">Product</th>
                                    <th class="p-2">Name</th>
                                    <th class="p-2">Description</th>
                                    <th class="p-2">Price</th>
                                    <th class="p-2">Category</th>
                                    <th class="p-2">Average Rating</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td class="p-2" align="center"><img src="<?php echo $row['preview_source']; ?>"></td>
                                    <td class="p-2" align="center"><?php echo $row["name"]; ?></td>
                                    <td class="p-2" align="center"><?php echo $row["desc"]; ?></td>
                                    <td class="p-2" align="center"><?php echo $row["price"]; ?></td>
                                    <td class="p-2" align="center"><?php echo $row["category"]; ?></td>
                                    <td class="p-2" align="center"><?php echo $row["average_rating"]; ?></td>
                                </tr>
                            </tbody>
                        </table>
        <?php
                    }
                } else {
                    echo '<p class="text-center">No product found with the provided ID.</p>';
                }
            } else {
                echo '<p class="text-center">No product ID provided.</p>';
            }
        ?>
    </div>
</main>

<?php include_once "layout/footer.php"; ?>