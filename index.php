<?php
// Include the database connection file
include('server/connection.php');

// Fetch data from the products table
$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$products = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>



<?php
include('layouts/header.php');
include('layouts/navbar.php');
?>

<div class="container">
    <h1 class="my-4">Featured Products</h1>
    <div class="row">
      <?php foreach ($products as $product): ?>
  
      <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="card product-card h-100">
      
          <img class="card-img-top" src="assets/imgs/<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_name']; ?>">
          <div class="card-body">
            <h5 class="card-title"><?php echo $product['product_name']; ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo '$' .$product['product_price'] ?></h6>
            <p class="card-text"><?php echo $product['product_description']; ?></p>
            
          </div>
          <div class="card-footer">
            <a href="<?php echo "single_product.php?product_id=".$product['product_id'];?>" class="btn btn-primary">Buy Now</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

<?php
include('footer.php');
