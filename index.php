<?php
    $pageTitle = "Home";
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
            
            // Declare variable to store SQL query
            $sql = "SELECT * FROM tbl_products";
            
            // Execute SQL query and store the result in a variable
            $result = $dbUtil->getQueryResult($conn, $sql);
            
            // Check if we have results
            if ($result->num_rows > 0) {
                echo '<div class="grid">';
                
                while($row = $result->fetch_assoc()) {
        ?>
                        <div class="w-full">
                            <form action="cart.php" method="POST">
                                <input type="hidden" name="productId" value="<?php echo $row['id']; ?>">
                                <input type="hidden" name="price" value="<?php echo $row['price']; ?>">    
                                
                                <a class="flex flex-col" href="product.php?productId=<?php echo $row['id']; ?>">
                                    <img class="mb-4 h-50 object-contain" src="<?php echo $row['preview_source']; ?>" alt="<?php echo $row['name']; ?>">
                                </a>

                                <h3 class="mb-2 text-center"><?php echo $row['name']; ?></h3>
                                <p class="mb-4 text-center">$<?php echo $row['price']; ?></p>
                                
                                <div class="flex flex-row justify-between gap-2">
                                    <input class="flex-1 h-10" type="number" name="quantity" min="1" value="1">
                                    <input class="h-10 w-10" type="submit" name="Add" value="Add">
                                </div>
                            </form>
                        </div>
        <?php
                }
                
                echo '</div>';
            } else {
                echo '<p class="text-center">No results found.</p>';
            }
            
            // Close the database connection
            $dbUtil->closeConnection($conn)
        ?>
        
    </div>
</main>

<?php include_once "layout/footer.php"; ?>