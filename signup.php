<!DOCTYPE html>
<?php
  session_start();
  $con = mysqli_connect("localhost","root","","Test_log") or die("Connection was not established");
?>
<html lang='en'>

  <head>
    <meta charset='UTF-8'/>
    <title>Sign up</title>
    <link rel='stylesheet' href='signup-style.css'/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  </head>



  <body>

    <?php
    if(isset($_COOKIE['sign_up_cookie'])){
      if($_COOKIE['sign_up_cookie'] == 1){
        echo "<script>
        alert();
        $('.signup').css('display','none');
        </script>";
        echo "<script>
        $( '.Add_one_more' ).css('display','inline');
        </script>";
      }
    }
     ?>



    <form class="signup" method="post" action="signup.php">

      <h3>Username</h3>
      <input type="text" name="username" required="required"/><br/>
      <div class="username"></div>
      <h3>Email</h3>
      <input type="text" name="email" required="required"/><br/>
      <div class="email"></div>
      <h3>Password</h3>
      <input type="password" name="password" required="required"/><br/>
      <p class="password"></p>
      <input type="submit" name="sub" value="Create user"/><br/>

    </form>

    <a href="#" class="Add_one_more">Add one more user</a>
    <script>$( '.Add_one_more').click(function(){
    $( '.signup' ).css('display','in line');
    });</script>
    <a href="log_in.php">Login here</a>


    <?php
      for($x=1; $x<2; $x++){


      if ( isset($_POST['sub'])){
        $username = mysqli_real_escape_string($con, $_POST['username']);
        check_field($username,"username",$con);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        check_email($email);
        check_field($email,"email",$con);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        check_password($password);
        $password = password_hash($password, PASSWORD_DEFAULT);


        $insert="insert into users_log (username,email,password) values ('$username', '$email', '$password')";

        $run = mysqli_query($con,$insert);
        if ($run)
          {
            echo "REGISTARTION SUCCESSFUL THANKS";
            $_SESSION['email']=$email;
            setcookie("Test", "true", time() + (60), "/");
          }
        }
      }
      function check_field($field,$s,$con){
        $temp=$s . "='" . $field ."'";
        $sel_field="select * from users_log where ". $temp;
        $run_field= mysqli_query($con,$sel_field);
        $check_field= mysqli_num_rows($run_field);
        if($check_field==1)
        {
          /*echo "<script>
          $( '." . $s . "' ).css('display','inline');
          </script>";*/
          echo "<script>
          $( '." . $s . "' ).append('<p>Your " . $s . " is already taken.</p>');
          </script>";

          exit();
        }
        else if(strlen($field)>40) {
          echo "<script>
          $( '." . $s . "' ).append('<p>Your " . $s . " should be less than 40 characters.</p>');
          </script>";

          exit();
        }
        else if(strlen($field)<3) {
          echo "<script>
          $( '." . $s . "' ).append('<p>Your " . $s . " should be at least 4 characters.</p>');
          </script>";

          exit();
        }
      }
      function check_email($email) {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
          echo "<script>
          $( '.email' ).append('<p>Your email is not valid.</p>');
          </script>";
          exit();
        }

      }
      function check_password($password) {

          if (strlen($password) < 7 or !preg_match("#[0-9]+#", $password) or !preg_match("#[a-zA-Z]+#", $password)) {
            echo "<script>
            $( '.password' ).append('<p>Your password must contain at least 8 characters, one letter and one number.</p>');
            </script>";
            exit();
          }
        }

         ?>




  </body>


</html>
