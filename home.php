<!DOCTYPE html>
<?php
  session_start();
  if(!$_SESSION['email']) {
    header("Location: log_in.php");
  }
  else {
?>
<html lang='en'>

  <head>
    <meta charset='UTF-8'/>
    <title>HOME</title>
    <link rel='stylesheet' href='home-style.css'/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  </head>
<body>

WELCOME TO HOME PAGE

<a href="log_out.php">Log out</a>

<?php

 ?>

</body>

<?php } ?>
</html>
