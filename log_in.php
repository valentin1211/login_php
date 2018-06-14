<!DOCTYPE html>
<?php
  $con = mysqli_connect("localhost","root","","Test_log") or die("Connection was not established");
?>
<html lang='en'>

  <head>
    <meta charset='UTF-8'/>
    <title>Log in</title>
    <link rel='stylesheet' href='log_in-style.css'/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  </head>
<body>

  <form class="login" method="post" action="log_in.php">

    <h3>Email</h3>
    <input type="text" name="email" required="required"/><br/>
    <div class="email"></div>
    <h3>Password</h3>
    <input type="password" name="password" required="required"/><br/>
    <p class="password"></p>
    <input type="submit" name="login" value="Log in"/><br/>

  </form>

  <a href="signup.php">Signup here</a>
<?php
  if ( isset($_POST['login'])){
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $sel = "Select * from users_log where email='$email'";
    $run=mysqli_query($con,$sel);
    $check_email= mysqli_num_rows($run);

    if($check_email == 0) {
      echo "<script>
      $( '.email' ).append('<p>This email does not exist.</p>');
      </script>";

      exit();
    }

    $sel = "Select password from users_log where email='$email'";
    $run=mysqli_query($con,$sel);
    $row = $run->fetch_assoc();
    $check = $row['password'];
    echo password_verify($password,$check);

    if(!password_verify($password,$check)) {
      echo "<script>
      $( '.password' ).append('<p>Your password is incorrect.</p>');
      </script>";

      exit();
    }
    else {
      $_SESSION['email']=$email;
      echo "<script>
      window.open('home.php', '_self');
      </script>";
    }
  }

?>


  </body>


</html>
