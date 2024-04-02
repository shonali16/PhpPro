<?php
include('server/connection.php');
if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];

    $stmt = $conn->prepare("SELECT * FROM  products WHERE product_id=?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product = $stmt->get_result();

}
else{
    header('location: index.php');
}
?>

<?php
include('layouts/header.php');
include('layouts/navbar.php');
?>

<div class="container">
  <div class="row justify-content-center">
    <?php while($row = $product->fetch_assoc() ){?>
    <form method="POST" action="cart.php">
    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>"/>
      <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>"/>
      <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>"/>
      <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>"/>
      <div class="col-lg-6">
        <div class="product-wrapper">
          <img src="assets/imgs/<?php echo $row['product_image'];?>" class="img-fluid product-image" alt="Product Image">
        </div>
        <!-- <div class="additional-images"> -->
          
    <img src="assets/imgs/<?php echo $row['product_image2'];?>" class="img-fluid" alt="Product Image" height="10px" width="50px";>          
     
        <!-- </div> -->
      </div>
      <div class="col-lg-6">
        <h2 class="mb-3"><?php echo $row['product_name'];?></h2>
        <h2></h2>
        <p class="lead mb-4"><?php echo $row['product_description'];?></p>
        <p><strong>Price:</strong> <?php echo $row['product_price'];?></p>
        <input type="number" name="product_quantity" value="1">
        <p><strong>Color:</strong> <span class="color-box" style="background-color: <?php echo $row['product_color'];?>"></span><?php echo $row['product_color'];?></p>
        <p><strong>Special Offer:</strong> <span class="text-success">25% OFF with code SPECIAL25</span></p> <!-- Placeholder for special coupon -->
        <button type="submit" class="btn btn-primary" name="add_to_cart">Add to Cart</button>
      </div>
    </form>
    <?php }?>
  </div>
</div>
<?php
// include('footer.php');