<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();

include('server/connection.php');

if(isset($_POST['register'])){
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
$confirmPassword = $_POST['confirm_password'];

if($password !== $confirmPassword){
  header('location: register.php?error=password donot match');
}
else if(strlen($password < 6)){
  header('location: register.php?error=password must be at least 6 characters');
}
  // check if the user already exists
  $stmt1= $conn->prepare("SELECT count(*) FROM users   where user_email=?");
  $stmt1->bind_param('s', $email);
  $stmt1->execute();
  $stmt1->bind_result($num_rows);
  $stmt1->store_result();
  $stmt1->fetch();

  // if there is a user already registered with this email
  if($num_rows != 0){
    header('location: register.php?error=user with email already exists');

    // if user registered with this email before

  }
else{
      // create a new user
  $stmt = $conn->prepare("INSERT INTO users(user_name, user_email, user_password) VALUES(?,?,?)");
  $stmt->bind_param('sss', $name, $email, md5($password));
  if($stmt->execute()){
    $user_id = $stmt->insert_id;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_name'] = $name;
    $_SESSION['logged_in'] = true;
    header('location: account.php?register_success= You registered successfully');
  }
  // else{
  //   header('location: register.php?error= could not registered');
  // }
  // $stmt->fetch();
}

}
// if the user already exists go to account page ratehr than a register page
else if(isset($_SESSION['logged_in'])){
    header('location: account.php');
    exit;
}

?>
<?php
include('layouts/header.php');
include('layouts/navbar.php');

?>
 <div class="container form-container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2 class="text-center">Register</h2>
        <form action="register.php" method="POST">
          <p style="color:red"><?php echo  $_GET['error'];?></p>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter your name">
          </div>
          <div class="form-group">
            <label for="email">Email address</label>
            <input type="text" class="form-control" name="email" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>
          <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
          </div>
          <input type="submit" class="btn btn-primary btn-block mt-3" name="register" value="Register">
        </form>
        <div class="text-center mt-3">
          <span>Already registered? </span><a href="#">Login</a>
        </div>
      </div>
    </div>
  </div>