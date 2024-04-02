<?php

include('server/connection.php');
if(isset($_POST['search'])){

  $category = $_POST['category'];
  $price = $_POST['price'];    
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_category=? AND product_price<=?");
 
    $stmt->bind_param("si", $category, $price);
    $stmt->execute();
    $products = $stmt->get_result();

}
else{
    $stmt = $conn->prepare("SELECT * FROM products");
    $stmt->execute();
    $products = $stmt->get_result();
}

?>
<?php
include('layouts/header.php');
include('layouts/navbar.php');
?>

<div class="container">
        <div class="row">
        <div class="col-md-2">
                <!-- Sidebar with Search and Filters -->
                <div class="sidebar">
                    <!-- Product Search Section -->
                    <h2>Search Products</h2>
                    <form action="shop.php" method="POST">
                   
                    <h4>Filter by Category</h4>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="category" id="shoes" value="shoes">
                        <label class="form-check-label" for="shoes">Shoes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="category" id="coats" value="coats">
                        <label class="form-check-label" for="coats">Coats</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="category" id="watches" value="watches">
                        <label class="form-check-label" for="watches">Watches</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="category" id="bags" value="bags">
                        <label class="form-check-label" for="bags">Bags</label>
                    </div>
                    <!-- Price Range Filter Section -->
                    <h2>Price Range</h2>
                    <input type="range" class="form-control-range" id="priceRange" name="price" min="1" max="1000" value="1">
                    <p id="priceValue">$1 - $1000</p>

                   
                        <!-- <div class="form-group">
                            <input type="text" class="form-control" name="search" placeholder="Search">
                        </div> -->
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
            </div>
            <div class="col-md-10 ">
            
                <h2>Products</h2>
                <div class="row mx-auto">
                     <!-- Display Products -->
                    <?php while($row = $products->fetch_assoc()): ?>
                        <div class="col-md-4 p-3">
                            <div class="card">
                            <img class="card-img-top" src="assets/imgs/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">

                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                    <p class="card-text">Category: <?php echo $row['category']; ?></p>
                                    <p class="card-text">Price: $<?php echo $row['product_price']; ?></p>
                                  <a href="<?php echo "single_product.php?product_id=".$row['product_id']?>"class="btn btn-primary">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            
        </div>
    </div>
